<?php

namespace Bobinaudio;

use \Model\Type\Transfo\Winding;

abstract class CSVParserTransfo extends CSVParser
{
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

