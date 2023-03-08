<?php

namespace Ybert\PhpFitParser\Model;

class Fit
{
    public FitHeader $header;

    public function __construct(string $fileContent)
    {
        $this->header = new FitHeader($fileContent);
    }
}
