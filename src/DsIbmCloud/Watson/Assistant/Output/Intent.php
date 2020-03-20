<?php

namespace DsIbmCloud\Watson\Assistant\Output;

use Illuminate\Contracts\Support\Arrayable as ArrayableContract;

class Intent implements ArrayableContract
{
    private $intent;
    private $confidence;

    public function __construct(string $intent, float $confidence)
    {
        $this->intent = $intent;
        $this->confidence = $confidence;
    }

    public function getIntent(): string
    {
        return $this->intent;
    }

    public function setIntent(string $intent): self
    {
        $this->intent = $intent;
        return $this;
    }

    public function getConfidence(): float
    {
        return $this->confidence;
    }

    public function setConfidence(float $confidence): self
    {
        $this->confidence = $confidence;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'intent' => $this->getIntent(),
            'confidence' => $this->getConfidence()
        ];
    }

    public static function create(string $intent, float $confidence)
    {
        return new static($intent, $confidence);
    }
}
