<?php

namespace JorisRos\LibraryProductExporter\Utils;

class ValuePlacer
{
    public function __construct(private string $seperator = '.')
    {
    }
    public function stringToMultiArrayWithValue($string, $value): array
    {
        $levels = explode($this->seperator, $string);
        $result = [];
        $current = &$result;

        foreach ($levels as $level) {
            if (str_ends_with($level, '[]')) {
                $key = substr($level, 0, -2);
                $current[$key] = [];
                $current[$key][] = [];
                $current = &$current[$key][0];
            } else {
                $current[$level] = [];
                $current = &$current[$level];
            }
        }

        $current = $value;

        return $result;
    }
}
