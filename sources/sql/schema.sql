--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: transfo; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA transfo;


--
-- Name: SCHEMA transfo; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON SCHEMA transfo IS 'standard public schema';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: hstore; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS hstore WITH SCHEMA public;


--
-- Name: EXTENSION hstore; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION hstore IS 'data type for storing sets of (key, value) pairs';


--
-- Name: ltree; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS ltree WITH SCHEMA public;


--
-- Name: EXTENSION ltree; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION ltree IS 'data type for hierarchical tree-like structures';


--
-- Name: pgcrypto; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS pgcrypto WITH SCHEMA public;


--
-- Name: EXTENSION pgcrypto; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION pgcrypto IS 'cryptographic functions';


--
-- Name: uuid-ossp; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS "uuid-ossp" WITH SCHEMA public;


--
-- Name: EXTENSION "uuid-ossp"; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION "uuid-ossp" IS 'generate universally unique identifiers (UUIDs)';


SET search_path = transfo, pg_catalog;

--
-- Name: special_offer; Type: TYPE; Schema: transfo; Owner: -
--

CREATE TYPE special_offer AS (
	discount_pct smallint,
	apply_btw tstzrange
);


--
-- Name: winding; Type: TYPE; Schema: transfo; Owner: -
--

CREATE TYPE winding AS (
	current integer,
	impedance integer,
	voltage integer[]
);


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: ei_dimension; Type: TABLE; Schema: transfo; Owner: -; Tablespace: 
--

CREATE TABLE ei_dimension (
    ei_dimension_id integer NOT NULL,
    ref character varying NOT NULL,
    len_a integer NOT NULL,
    len_b integer NOT NULL,
    len_c integer NOT NULL,
    diameter numeric(2,1) NOT NULL,
    average_h integer NOT NULL
);


--
-- Name: ei_dimension_ei_dimension_id_seq; Type: SEQUENCE; Schema: transfo; Owner: -
--

CREATE SEQUENCE ei_dimension_ei_dimension_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: ei_dimension_ei_dimension_id_seq; Type: SEQUENCE OWNED BY; Schema: transfo; Owner: -
--

ALTER SEQUENCE ei_dimension_ei_dimension_id_seq OWNED BY ei_dimension.ei_dimension_id;


--
-- Name: transformer; Type: TABLE; Schema: transfo; Owner: -; Tablespace: 
--

CREATE TABLE transformer (
    transformer_id uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    ref character varying NOT NULL,
    ei_dimension_id integer NOT NULL,
    weight numeric(3,1) NOT NULL,
    height integer,
    meta json,
    is_online boolean DEFAULT true NOT NULL,
    is_on_top boolean DEFAULT false NOT NULL,
    is_advertised boolean DEFAULT false NOT NULL,
    display_order integer NOT NULL,
    hook_phrase_i18n public.hstore,
    description_i18n public.hstore
);


--
-- Name: inductance; Type: TABLE; Schema: transfo; Owner: -; Tablespace: 
--

CREATE TABLE inductance (
    pri winding NOT NULL,
    inductance numeric(5,3) NOT NULL,
    pri_idc numeric(3,2) NOT NULL
)
INHERITS (transformer);
ALTER TABLE ONLY inductance ALTER COLUMN height SET NOT NULL;


--
-- Name: opt_pp; Type: TABLE; Schema: transfo; Owner: -; Tablespace: 
--

CREATE TABLE opt_pp (
    pri_idc numeric(3,2) NOT NULL,
    power integer NOT NULL,
    z_pri integer NOT NULL,
    z_secs integer[] NOT NULL,
    flo integer NOT NULL,
    fhi integer NOT NULL,
    ul numeric(2,0),
    CONSTRAINT transformer_opt_pp_ul_check CHECK (((ul >= (0)::numeric) AND (ul <= (100)::numeric)))
)
INHERITS (transformer);
ALTER TABLE ONLY opt_pp ALTER COLUMN height SET NOT NULL;


--
-- Name: opt_se; Type: TABLE; Schema: transfo; Owner: -; Tablespace: 
--

CREATE TABLE opt_se (
    pri_idc numeric(3,2) NOT NULL,
    power integer NOT NULL,
    z_pri integer NOT NULL,
    z_secs integer[] NOT NULL,
    flo integer NOT NULL,
    fhi integer NOT NULL
)
INHERITS (transformer);
ALTER TABLE ONLY opt_se ALTER COLUMN height SET NOT NULL;


--
-- Name: psu; Type: TABLE; Schema: transfo; Owner: -; Tablespace: 
--

CREATE TABLE psu (
    power integer NOT NULL,
    pri winding NOT NULL,
    secs winding[] NOT NULL
)
INHERITS (transformer);
ALTER TABLE ONLY psu ALTER COLUMN height SET NOT NULL;


--
-- Name: supported_culture; Type: TABLE; Schema: transfo; Owner: -; Tablespace: 
--

CREATE TABLE supported_culture (
    culture character(2) NOT NULL,
    label character varying NOT NULL
);


--
-- Name: transformer_display_order_seq; Type: SEQUENCE; Schema: transfo; Owner: -
--

CREATE SEQUENCE transformer_display_order_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: transformer_display_order_seq; Type: SEQUENCE OWNED BY; Schema: transfo; Owner: -
--

ALTER SEQUENCE transformer_display_order_seq OWNED BY transformer.display_order;


--
-- Name: ei_dimension_id; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY ei_dimension ALTER COLUMN ei_dimension_id SET DEFAULT nextval('ei_dimension_ei_dimension_id_seq'::regclass);


--
-- Name: transformer_id; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY inductance ALTER COLUMN transformer_id SET DEFAULT public.uuid_generate_v4();


--
-- Name: is_online; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY inductance ALTER COLUMN is_online SET DEFAULT true;


--
-- Name: is_on_top; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY inductance ALTER COLUMN is_on_top SET DEFAULT false;


--
-- Name: is_advertised; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY inductance ALTER COLUMN is_advertised SET DEFAULT false;


--
-- Name: display_order; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY inductance ALTER COLUMN display_order SET DEFAULT nextval('transformer_display_order_seq'::regclass);


--
-- Name: transformer_id; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY opt_pp ALTER COLUMN transformer_id SET DEFAULT public.uuid_generate_v4();


--
-- Name: is_online; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY opt_pp ALTER COLUMN is_online SET DEFAULT true;


--
-- Name: is_on_top; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY opt_pp ALTER COLUMN is_on_top SET DEFAULT false;


--
-- Name: is_advertised; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY opt_pp ALTER COLUMN is_advertised SET DEFAULT false;


--
-- Name: display_order; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY opt_pp ALTER COLUMN display_order SET DEFAULT nextval('transformer_display_order_seq'::regclass);


--
-- Name: transformer_id; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY opt_se ALTER COLUMN transformer_id SET DEFAULT public.uuid_generate_v4();


--
-- Name: is_online; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY opt_se ALTER COLUMN is_online SET DEFAULT true;


--
-- Name: is_on_top; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY opt_se ALTER COLUMN is_on_top SET DEFAULT false;


--
-- Name: is_advertised; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY opt_se ALTER COLUMN is_advertised SET DEFAULT false;


--
-- Name: display_order; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY opt_se ALTER COLUMN display_order SET DEFAULT nextval('transformer_display_order_seq'::regclass);


--
-- Name: transformer_id; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY psu ALTER COLUMN transformer_id SET DEFAULT public.uuid_generate_v4();


--
-- Name: is_online; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY psu ALTER COLUMN is_online SET DEFAULT true;


--
-- Name: is_on_top; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY psu ALTER COLUMN is_on_top SET DEFAULT false;


--
-- Name: is_advertised; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY psu ALTER COLUMN is_advertised SET DEFAULT false;


--
-- Name: display_order; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY psu ALTER COLUMN display_order SET DEFAULT nextval('transformer_display_order_seq'::regclass);


--
-- Name: display_order; Type: DEFAULT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY transformer ALTER COLUMN display_order SET DEFAULT nextval('transformer_display_order_seq'::regclass);


--
-- Name: ei_dimension_pkey; Type: CONSTRAINT; Schema: transfo; Owner: -; Tablespace: 
--

ALTER TABLE ONLY ei_dimension
    ADD CONSTRAINT ei_dimension_pkey PRIMARY KEY (ei_dimension_id);


--
-- Name: supported_culture_pkey; Type: CONSTRAINT; Schema: transfo; Owner: -; Tablespace: 
--

ALTER TABLE ONLY supported_culture
    ADD CONSTRAINT supported_culture_pkey PRIMARY KEY (culture);


--
-- Name: transformer_opt_pp_pkey; Type: CONSTRAINT; Schema: transfo; Owner: -; Tablespace: 
--

ALTER TABLE ONLY opt_pp
    ADD CONSTRAINT transformer_opt_pp_pkey PRIMARY KEY (transformer_id);


--
-- Name: transformer_opt_pp_reference_uniq; Type: CONSTRAINT; Schema: transfo; Owner: -; Tablespace: 
--

ALTER TABLE ONLY opt_pp
    ADD CONSTRAINT transformer_opt_pp_reference_uniq UNIQUE (ref);


--
-- Name: transformer_opt_se_pkey; Type: CONSTRAINT; Schema: transfo; Owner: -; Tablespace: 
--

ALTER TABLE ONLY opt_se
    ADD CONSTRAINT transformer_opt_se_pkey PRIMARY KEY (transformer_id);


--
-- Name: transformer_opt_se_reference_uniq; Type: CONSTRAINT; Schema: transfo; Owner: -; Tablespace: 
--

ALTER TABLE ONLY opt_se
    ADD CONSTRAINT transformer_opt_se_reference_uniq UNIQUE (ref);


--
-- Name: transformer_psu_pk; Type: CONSTRAINT; Schema: transfo; Owner: -; Tablespace: 
--

ALTER TABLE ONLY psu
    ADD CONSTRAINT transformer_psu_pk PRIMARY KEY (transformer_id);


--
-- Name: transformer_psu_reference_uniq; Type: CONSTRAINT; Schema: transfo; Owner: -; Tablespace: 
--

ALTER TABLE ONLY psu
    ADD CONSTRAINT transformer_psu_reference_uniq UNIQUE (ref);


--
-- Name: transformer_self_pk; Type: CONSTRAINT; Schema: transfo; Owner: -; Tablespace: 
--

ALTER TABLE ONLY inductance
    ADD CONSTRAINT transformer_self_pk PRIMARY KEY (transformer_id);


--
-- Name: transformer_self_reference_uniq; Type: CONSTRAINT; Schema: transfo; Owner: -; Tablespace: 
--

ALTER TABLE ONLY inductance
    ADD CONSTRAINT transformer_self_reference_uniq UNIQUE (ref);


--
-- Name: ei_dimension_fk; Type: FK CONSTRAINT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY inductance
    ADD CONSTRAINT ei_dimension_fk FOREIGN KEY (ei_dimension_id) REFERENCES ei_dimension(ei_dimension_id);


--
-- Name: ei_dimension_fk; Type: FK CONSTRAINT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY psu
    ADD CONSTRAINT ei_dimension_fk FOREIGN KEY (ei_dimension_id) REFERENCES ei_dimension(ei_dimension_id);


--
-- Name: transformer_ei_dimension_id_fkey; Type: FK CONSTRAINT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY transformer
    ADD CONSTRAINT transformer_ei_dimension_id_fkey FOREIGN KEY (ei_dimension_id) REFERENCES ei_dimension(ei_dimension_id);


--
-- Name: transformer_opt_pp_ei_dimension_id_fkey; Type: FK CONSTRAINT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY opt_pp
    ADD CONSTRAINT transformer_opt_pp_ei_dimension_id_fkey FOREIGN KEY (ei_dimension_id) REFERENCES ei_dimension(ei_dimension_id);


--
-- Name: transformer_opt_se_ei_dimension_id_fkey; Type: FK CONSTRAINT; Schema: transfo; Owner: -
--

ALTER TABLE ONLY opt_se
    ADD CONSTRAINT transformer_opt_se_ei_dimension_id_fkey FOREIGN KEY (ei_dimension_id) REFERENCES ei_dimension(ei_dimension_id);


--
-- Name: public; Type: ACL; Schema: -; Owner: -
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

