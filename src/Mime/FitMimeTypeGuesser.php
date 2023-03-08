<?php

namespace Ybert\PhpFitParser\Mime;

use Symfony\Component\Mime\MimeTypeGuesserInterface;
use Ybert\PhpFitParser\Model\FitHeader;

class FitMimeTypeGuesser implements MimeTypeGuesserInterface
{
    public function guessMimeType(string $path): ?string
    {
        $header = new FitHeader(file_get_contents($path));
        if ($header->size !== 12 && $header->size !== 14) {

            return null;
        }
        if ($header->dataType !== '.FIT') {
            return null;
        }

        return 'application/vnd.ant.fit';
    }

    public function isGuesserSupported(): bool
    {
        return true;
    }
}
