<?php

use PHPUnit\Framework\TestCase;
use Ybert\PhpFitParser\Exception\InvalidFITFileException;
use Ybert\PhpFitParser\FITParser;

class FITParserTest extends TestCase
{
    private FITParser $fitParser;
    protected function setUp(): void
    {
        $this->fitParser = new FITParser();
    }

    public function testDecodeSucceed(): void
    {
        $fit = $this->fitParser->decode(__DIR__.'/Fixtures/test_activity.fit');
        $this->assertEquals('.FIT', $fit->header->dataType);
    }

    public function testDecodeInvalidFitFile(): void
    {
        $this->expectException(InvalidFITFileException::class);
        $this->fitParser->decode(__DIR__.'/Fixtures/test_invalid_format.fit');
    }
}