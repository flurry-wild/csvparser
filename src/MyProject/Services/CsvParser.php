<?php

namespace MyProject\Services;

use http\Exception\InvalidArgumentException;

class CsvParser implements Parser
{
    const MAX_STRING_LENGTH = 1000;
    const SEPARATOR = ';';

    private $handle;
    private $result = [];

    private function init($fileName)
    {
        $handle = fopen($fileName, 'r');

        if ($handle == false) {
            throw new InvalidArgumentException(self::class . ':Файл ' . $fileName . ' не найдет');
        }

        $this->handle = $handle;
    }

    private function parse()
    {
        $row = 0;
        while (($data = fgetcsv($this->handle, self::MAX_STRING_LENGTH, self::SEPARATOR)) !== false) {
            $num = count($data);
            if ($num !== 7) {
                continue;
            }

            for ($c=0; $c < $num; $c++) {
                $this->result[$row][] = $data[$c];
            }

            $row++;
        }
    }

    private function close()
    {
        fclose($this->handle);
    }

    public function getResult($fileName)
    {
        $this->init($fileName);
        $this->parse();

        $this->close();

        return $this->result;
    }
}