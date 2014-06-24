<?php

namespace Bobinaudio;

class CSVParserSelf extends CSVParserTransfo
{
    public function clean($line)
    {
        $clean = [];
        $fields = str_getcsv($line, "\t");

        $clean['ref'] = $this->extractReference($fields, 0);
        $clean['pri_idc'] = $this->extractPriIdc($fields, 2);
        $clean['inductance'] = $this->extractInductance($fields, 3);
        $clean['pri'] = $this->extractPri($fields, 4);
        $clean['pri']->impedance = $this->extractImpedance($fields, 5);
        $clean['ei_dimension_id'] = $this->extractEIDimensionId($fields, 6);
        $clean['height'] = $this->extractHeight($fields, 6);
        $clean['weight'] = $this->extractWeight($fields, 7);
        $clean['hook_phrase_i18n'] = $this->extractHook($fields, 8);
    }
}
