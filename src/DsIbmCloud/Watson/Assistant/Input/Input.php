<?php

namespace DsIbmCloud\Watson\Assistant\Input;

use DsIbmCloud\Contracts\Arrayable as ArrayableContract;

class Input implements ArrayableContract
{
    private $text;
    private $options;

    public function __construct(?string $text = null)
    {
        $this->text = $text;
        $this->options = Options::create();
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setOptions(Options $options): self
    {
        $this->options = $options;
        return $this;
    }

    public function getOptions(): ?Options
    {
        return $this->options;
    }

    public function toArray(): array
    {
        $data = [
            'text' => $this->getText()
        ];

        if ($options = $this->getOptions()) {
            $data['options'] = $options->toArray();
        }

        return $data;
    }

    public static function create(?string $text): self
    {
        return new static($text);
    }
}
