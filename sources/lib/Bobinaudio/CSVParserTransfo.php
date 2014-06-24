<?php

namespace Bobinaudio;

use \Model\Type\Transfo\Winding;

abstract class CSVParserTransfo extends CSVParser
{
    protected function extractReference(Array $fields, $index)
    {
        return $this->checkField($fields, $index);
    }

    protected function extractPower(Array $fields, $index)
    {
        $field = $this->checkField($fields, $index);

        return (int) $this->validateNumber($field);
    }

    protected function extractPri(Array $fields, $index)
    {
        $field = $this->checkField($fields, $index);

        return $this->convertToWinding($field);
    }

    protected function extractSecs(Array $fields, $index)
    {
        $field = $this->checkField($fields, $index);
        $secs = [];

        foreach(preg_split('/\|/', $field) as $elt)
        {
            $secs[] = $this->convertToWinding(trim($elt));
        }

        return $secs;
    }

    protected function extractEIDimensionId(Array $fields, $index)
    {
        $field = $this->checkField($fields, $index);

        if (!preg_match('/EI([0-9]{2,3}).[0-9]+/', $field, $matchs))
        {
            throw new \InvalidArgumentException(sprintf("Could not parse dimension '%s'.", $field));
        }

        return constant(sprintf("\Model\Bobinaudio\Transfo\Transformer::DIMENSION_EI%d", $matchs[1]));
    }

    protected function extractHeight(Array $fields, $index)
    {
        $field = $this->checkField($fields, $index);

        if (!preg_match('/EI[0-9]{2,3}.([0-9]+)/', $field, $matchs))
        {
            throw new \InvalidArgumentException(sprintf("Could not parse dimension '%s'.", $field));
        }

        return (int) $this->validateNumber($matchs[1]);
    }

    protected function extractWeight(Array $fields, $index)
    {
        $field = $this->checkField($fields, $index);

        return (float) $this->validateNumber($field);
    }

    protected function extractImpedance(Array $fields, $index)
    {
        $field = $this->checkField($fields, $index);

        return (float) $this->validateNumber($field);
    }

    protected function extractHook(Array $fields, $index)
    {
        try
        {
            $field = $this->checkField($fields, $index);
        }
        catch(\InvalidArgumentException $e)
        {
            return [];
        }

        return ['fr' => $field ];
    }

    protected function convertToWinding($content)
    {
        if (!preg_match('/([0-9,]+)(?:-([0-9,]+))*[ V]*x *([0-9,]+)[ A]*/', $content, $matchs))
        {
            throw new \InvalidArgumentException(sprintf("Could not parse expression '%s'.", $content));
        }

        $voltages = [];
        for ($index = 1; $index <= count($matchs) - 2; $index++)
        {
            if ($matchs[$index] != 0)
            {
                $voltages[] = (int) ($this->validateNumber($matchs[$index]) * 10);
            }
        }
        $current = (int) ($this->validateNumber($matchs[count($matchs) - 1]) * 1000);

        return new Winding(['voltage' => $voltages, 'current' => $current ]);
    }
}

