<?php

namespace Ybert\PhpFitParser\Model;

class FitHeader
{
    public readonly int $size;
    public readonly int $protocolVersion;
    public readonly int $profileVersion;
    public readonly int $dataSize;
    public readonly string $dataType;
    public readonly ?int $crc;

    public function __construct(string $fileContent)
    {
        $data = unpack('C1headerSize/C1protocolVersion/v1profileVersion/V1dataSize/C4dataType', $fileContent);
        $this->size = $data['headerSize'];
        $this->protocolVersion = $data['protocolVersion'];
        $this->profileVersion = $data['profileVersion'];
        $this->dataSize = $data['dataSize'];
        $this->dataType = chr($data['dataType1']).chr($data['dataType2']).chr($data['dataType3']).chr($data['dataType4']);
        if ($this->size > 12) {
            $this->crc = unpack('v1', $fileContent, 12)[1];
        }
    }
}
