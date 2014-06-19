<?php

namespace Bobinaudio;

class CSVParserPSU extends CSVParserTransfo
{
    static public function validate($line)
    {
        $parser = new self();

        return $parser->clean($line);
    }

    public function clean($line)
    {
        $clean = [];
        $fields = str_getcsv($line, "\t");

        $clean['ref'] = $this->extractReference($fields);
        $clean['power'] = $this->extractPower($fields);
        $clean['pri'] = $this->extractPri($fields);
        $clean['secs'] = $this->extractSecs($fields);
        $clean['ei_dimension_id'] = $this->extractEIDimensionId($fields);
        $clean['height'] = $this->extractHeight($fields);
        $clean['weight'] = $this->extractWeight($fields);
        $clean['hook_phrase_i18n'] = $this->extractHook($fields);

        return $clean;
    }

    protected function extractReference(Array $fields)
    {
        return $this->checkField($fields, 0);
    }

    protected function extractPower(Array $fields)
    {
        $field = $this->checkField($fields, 3);

        return (int) $this->validateNumber($field);
    }

    protected function extractPri(Array $fields)
    {
        $field = $this->checkField($fields, 4);

        return $this->convertToWinding($field);
    }

    protected function extractSecs(Array $fields)
    {
        $field = $this->checkField($fields, 5);
        $secs = [];

        foreach(preg_split('/\|/', $field) as $elt)
        {
            $secs[] = $this->convertToWinding(trim($elt));
        }

        return $secs;
    }

    protected function extractEIDimensionId(Array $fields)
    {
        $field = $this->checkField($fields, 7);

        if (!preg_match('/EI([0-9]{2,3}).[0-9]+/', $field, $matchs))
        {
            throw new \InvalidArgumentException(sprintf("Could not parse dimension '%s'.", $field));
        }

        return constant(sprintf("\Model\Bobinaudio\Transfo\Transformer::DIMENSION_EI%d", $matchs[1]));
    }

    protected function extractHeight(Array $fields)
    {
        $field = $this->checkField($fields, 7);

        if (!preg_match('/EI[0-9]{2,3}.([0-9]+)/', $field, $matchs))
        {
            throw new \InvalidArgumentException(sprintf("Could not parse dimension '%s'.", $field));
        }

        return (int) $this->validateNumber($matchs[1]);
    }

    protected function extractWeight(Array $fields)
    {
        $field = $this->checkField($fields, 8);

        return (float) $this->validateNumber($field);
    }

    protected function extractHook(Array $fields)
    {
        try
        {
            $field = $this->checkField($fields, 9);
        }
        catch(\InvalidArgumentException $e)
        {
            return [];
        }

        return ['fr' => $field ];
    }
}
