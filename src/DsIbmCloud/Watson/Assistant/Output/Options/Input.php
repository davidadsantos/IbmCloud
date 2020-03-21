<?php

namespace DsIbmCloud\Watson\Assistant\Output\Options;

use DsIbmCloud\Contracts\Arrayable as ArrayableContract;

class Input implements ArrayableContract
{
    private $text;

    public function __construct(?string $text = null)
    {
        $this->text = $text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;
        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function toArray(): array
    {
        return [
            'input' => [
                'text' => $this->getText()
            ]
        ];
    }

    public static function create(?string $text = null): self
    {
        return new static($text);
    }
}
