--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = transfo, pg_catalog;

--
-- Data for Name: ei_dimension; Type: TABLE DATA; Schema: transfo; Owner: -
--

COPY ei_dimension (ei_dimension_id, ref, len_a, len_b, len_c, diameter, average_h) FROM stdin;
1	EI66-H	66	55	44	4.5	22
2	EI78-H	78	65	52	4.5	26
3	EI84-H	84	70	56	4.5	28
4	EI96-H	96	80	64	5.5	32
5	EI108-H	108	90	72	5.5	36
6	EI126-H	126	105	84	6.5	42
7	EI150-H	150	125	100	9.0	50
\.


--
-- Name: ei_dimension_ei_dimension_id_seq; Type: SEQUENCE SET; Schema: transfo; Owner: -
--

SELECT pg_catalog.setval('ei_dimension_ei_dimension_id_seq', 1, false);


--
-- Data for Name: inductance; Type: TABLE DATA; Schema: transfo; Owner: -
--

COPY inductance (transformer_id, ref, ei_dimension_id, weight, height, meta, is_online, is_on_top, is_advertised, display_order, pri, inductance, hook_phrase_i18n, description_i18n) FROM stdin;
\.


--
-- Data for Name: opt_pp; Type: TABLE DATA; Schema: transfo; Owner: -
--

COPY opt_pp (transformer_id, ref, ei_dimension_id, weight, height, meta, is_online, is_on_top, is_advertised, display_order, pri_idc, power, z_pri, z_secs, flo, fhi, ul, hook_phrase_i18n, description_i18n) FROM stdin;
\.


--
-- Data for Name: opt_se; Type: TABLE DATA; Schema: transfo; Owner: -
--

COPY opt_se (transformer_id, ref, ei_dimension_id, weight, height, meta, is_online, is_on_top, is_advertised, display_order, pri_idc, power, z_pri, z_secs, flo, fhi, hook_phrase_i18n, description_i18n) FROM stdin;
\.


--
-- Data for Name: psu; Type: TABLE DATA; Schema: transfo; Owner: -
--

COPY psu (transformer_id, ref, ei_dimension_id, weight, height, meta, is_online, is_on_top, is_advertised, display_order, power, pri, secs, hook_phrase_i18n, description_i18n) FROM stdin;
3ec3189e-649f-403a-a1ce-9c3e126a3b2e	DA10	3	1.2	28	\N	t	f	f	50	40	(190,,{2300})	{"(2000,,{63})","(120,,{2200})"}	"fr"=>""	\N
f430ca8a-08dc-455b-9503-9d208b10090d	DA11	3	1.2	28	\N	t	f	f	51	40	(190,,{2300})	{"(2000,,{63})","(120,,{2350})"}	"fr"=>""	\N
35885311-9c4b-499a-93df-cdf4d38fe5fd	DA18	3	1.8	44	\N	t	f	f	52	60	(230,,{2300})	{"(1400,,{63})","(1400,,{63})","(160,,{2070})","(100,,{126})"}	"fr"=>"PPECL86"	\N
fd7b0c84-5d1d-4685-bef5-9563c3a854c4	DA100	4	2.5	45	\N	t	f	f	53	80	(330,,{2300})	{"(2000,,{63})","(2000,,{63})","(150,,{3120})","(50,,{320})"}	"fr"=>"SE6L6"	\N
6a0f158e-686a-48f4-989b-6f7d0876e930	DA105	4	2.5	45	\N	t	f	f	54	120	(550,,{2300})	{"(300,,{4100})"}	"fr"=>"SE845"	\N
e2a23eef-ec31-46cf-9d5e-4edbe1b35f82	DA116	3	1.8	44	\N	t	f	f	55	65	(270,,{2300})	{"(2700,,{63})","(200,,{970})","(200,,{970})","(100,,{280})"}	"fr"=>"Circlotron"	\N
de3cba28-b11e-4a08-a9d2-464a103b8461	DA118	3	1.8	44	\N	t	f	f	56	70	(320,,{2300})	{"(3000,,{63})","(200,,{1280})","(200,,{1280})"}	"fr"=>"SE6080/6AS7G"	\N
d8d89115-7cbb-45bf-8905-ff907e309be1	DA140	6	6.8	70	\N	t	f	f	57	430	(1800,,"{2310,2450}")	{"(3000,,{100})","(3000,,{100})","(3000,,{100})","(3000,,{100})","(400,,\\"{3900,4300}\\")","(100,,{1500})","(2000,,{63})","(2000,,{63})"}	"fr"=>""	\N
d7e77d45-9d2c-4971-8228-0f347c0521dc	DA141	5	3.5	50	\N	t	f	f	58	195	(800,,"{2300,2450}")	{"(3000,,{63})","(3000,,{63})","(400,,{3200})","(100,,{1100})"}	"fr"=>""	\N
ed7ffce6-7874-4882-8889-6c2567ffea7c	DA145	4	2.2	40	\N	t	f	f	59	90	(360,,"{2300,2450}")	{"(2000,,{55})","(2000,,{63})","(200,,{2700})","(50,,{700})"}	"fr"=>"SE300B mono"	\N
f250d114-1bc0-4c83-b935-138a00301370	DA155	5	5.0	70	\N	t	f	f	60	260	(1130,,"{2300,2350}")	{"(3200,,{63})","(3200,,{63})","(300,,{4600})","(3200,,{63})","(220,,{2400})","(150,,{500})"}	"fr"=>"PP829b x 2"	\N
be0e89d8-d779-48c8-b0c9-8f63243485bf	DA171a	4	2.5	44	\N	t	f	f	61	150	(700,,{2300})	{"(4000,,{63})","(4000,,{63})","(500,,\\"{2350,2000}\\")","(50,,{120})"}	"fr"=>"DPPEL84"	\N
5048a7d7-70b2-408b-8184-bd0b98bd9335	DA171b	4	2.5	44	\N	t	f	f	62	165	(700,,{2300})	{"(4000,,{63})","(4000,,{63})","(500,,\\"{2350,1180}\\")","(50,,{120})"}	"fr"=>"DPP6S19P"	\N
cbfc0e17-78a3-4a95-8f92-274eda3622d6	DA171c	4	2.5	44	\N	t	f	f	63	165	(700,,{2300})	{"(4000,,{63})","(4000,,{63})","(400,,{2000})","(400,,{2000})","(100,,{120})","(100,,{2000})"}	"fr"=>""	\N
d121e822-6424-4ab5-a24c-736f534c99bd	DA173	1	0.9	34	\N	t	f	f	64	25	(120,,{2300})	{"(1000,,{130})","(100,,{1250})"}	"fr"=>"DACBOX"	\N
99e978e4-db32-49f6-a816-bfd2d8b8af41	DB33	6	7.0	70	\N	t	f	f	65	562	(2300,,"{2300,2400}")	{"(650,,{8500})"}	"fr"=>"2 x SE845"	\N
c54665c1-5582-4929-ba0d-01a2c9fa6688	DB39	4	2.8	47	\N	t	f	f	66	185	(800,,"{2300,2400}")	{"(4000,,{63})","(4000,,{63})","(500,,{2550})","(100,,{120})"}	"fr"=>""	\N
92db2865-7fd2-4db8-8e09-c5a9f383dae6	DB158	3	2.0	32	\N	t	f	f	67	72	(300,,"{2300,2400}")	{"(3300,,{63})","(130,,{3250})"}	"fr"=>"G5 v3 Ampli guitare"	\N
a1535a21-6ad3-4cf8-957b-c485794a4ed4	DB161	6	6.0	70	\N	t	f	f	68	335	(1500,,"{2300,2400}")	{"(3000,,{63})","(3000,,{63})","(3000,,{50})","(4000,,{200})","(100,,{3300})","(200,,{8200})"}	"fr"=>"SE GM70"	\N
b9a507ee-9333-4b0b-8a0b-662c60b611d6	DB176	5	6.0	72	\N	t	f	f	69	383	(1700,,"{2300,2400}")	{"(500,,\\"{7200,300}\\")"}	"fr"=>"Antique sound lab PP845"	\N
\.


--
-- Data for Name: supported_culture; Type: TABLE DATA; Schema: transfo; Owner: -
--

COPY supported_culture (culture, label) FROM stdin;
fr	français
en	englais
\.


--
-- Data for Name: transformer; Type: TABLE DATA; Schema: transfo; Owner: -
--

COPY transformer (transformer_id, ref, ei_dimension_id, weight, height, meta, is_online, is_on_top, is_advertised, display_order, hook_phrase_i18n, description_i18n) FROM stdin;
\.


--
-- Name: transformer_display_order_seq; Type: SEQUENCE SET; Schema: transfo; Owner: -
--

SELECT pg_catalog.setval('transformer_display_order_seq', 69, true);


--
-- PostgreSQL database dump complete
--

