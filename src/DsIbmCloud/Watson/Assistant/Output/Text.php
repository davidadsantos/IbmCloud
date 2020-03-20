<?php

namespace DsIbmCloud\Watson\Assistant\Output;

use DsIbmCloud\Contracts\Watson\Assistant\Output\Generic as GenericContract;

class Text implements GenericContract
{
    private $type = GenericContract::TYPE_TEXT;
    private $text;

    public function __construct(?string $text = null)
    {
        $this->text = $text;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'response_type' => $this->getType(),
            'text' => $this->getText()
        ];
    }

    public static function create(?string $text = null): self
    {
        return new static($text);
    }
}
