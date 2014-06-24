<?php

namespace Bobinaudio;

class CSVParserPSU extends CSVParserTransfo
{
    public function clean($line)
    {
        $clean = [];
        $fields = str_getcsv($line, "\t");

        $clean['ref'] = $this->extractReference($fields, 0);
        $clean['power'] = $this->extractPower($fields, 3);
        $clean['pri'] = $this->extractPri($fields, 4);
        $clean['secs'] = $this->extractSecs($fields, 5);
        $clean['ei_dimension_id'] = $this->extractEIDimensionId($fields, 7);
        $clean['height'] = $this->extractHeight($fields, 7);
        $clean['weight'] = $this->extractWeight($fields, 8);
        $clean['hook_phrase_i18n'] = $this->extractHook($fields, 9);

        return $clean;
    }
}
