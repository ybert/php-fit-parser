<?php

namespace Ybert\PhpFitParser;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Mime\MimeTypes;
use Ybert\PhpFitParser\Exception\InvalidFITFileException;
use Ybert\PhpFitParser\Mime\FitMimeTypeGuesser;
use Ybert\PhpFitParser\Model\Fit;

class FITParser
{
    public function decode(string $filePath) : Fit
    {
        if (!$this->isFitFile($filePath)) {
            throw new InvalidFITFileException('File is not a valid FIT file');
        }
        $fit = new Fit((new File($filePath))->getContent());

        return $fit;
    }

    private function isFitFile(string $filePath) : bool
    {
        $guesser = new MimeTypes();
        $guesser->registerGuesser(new FitMimeTypeGuesser());
        if ($guesser->guessMimeType($filePath) !== 'application/vnd.ant.fit') {
            return false;
        }

        return true;
    }
}
