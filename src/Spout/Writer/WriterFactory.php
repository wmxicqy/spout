<?php

namespace Box\Spout\Writer;

use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Common\Helper\GlobalFunctionsHelper;
use Box\Spout\Common\Type;

/**
 * Class WriterFactory
 * This factory is used to create writers, based on the type of the file to be read.
 * It supports CSV and XLSX formats.
 *
 * @package Box\Spout\Writer
 */
class WriterFactory
{
    /**
     * This creates an instance of the appropriate writer, given the type of the file to be read
     *
     * @param  string $writerType Type of the writer to instantiate
     * @return \Box\Spout\Writer\CSV\Writer|\Box\Spout\Writer\XLSX\Writer
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     */
    public static function create($writerType)
    {
        $writer = null;

        switch ($writerType) {
            case Type::CSV:
                $writer = new CSV\Writer();
                break;
            case Type::XLSX:
                $writer = new XLSX\Writer();
                break;
            default:
                throw new UnsupportedTypeException('No writers supporting the given type: ' . $writerType);
        }

        $writer->setGlobalFunctionsHelper(new GlobalFunctionsHelper());

        return $writer;
    }
}
