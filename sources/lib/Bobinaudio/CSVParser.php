<?php

namespace Bobinaudio;

abstract class CSVParser
{
    static public function validate($line)
    {
        $parser = new self();

        return $parser->clean($line);
    }

    abstract public function clean($line);

    protected function checkField(Array $fields, $position)
    {
        if (!isset($fields[$position]))
        {
            throw new \Exception(sprintf("No field at pos %d in {%s}.", $position, join('~', $fields)));
        }

        return trim($fields[$position]);
    }

    protected function validateNumber($value)
    {
        return str_replace(',', '.', $value) + 0;
    }
}

