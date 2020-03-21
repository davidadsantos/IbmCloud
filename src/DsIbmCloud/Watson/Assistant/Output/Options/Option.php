<?php

namespace DsIbmCloud\Watson\Assistant\Output\Options;

use DsIbmCloud\Contracts\Arrayable as ArrayableContract;

class Option implements ArrayableContract
{
    private $label;
    private $value;

    public function __construct(?string $label, ?Input $value)
    {
        $this->label = $label;
        $this->value = $value;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setValue(?Input $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function getValue(): ?Input
    {
        return $this->value;
    }

    public function toArray(): array
    {
        return [
            'label' => $this->getLabel(),
            'value' => $this->getValue()->toArray()
        ];
    }

    public static function create(?string $label, Input $value): self
    {
        return new self($label, $value);
    }
}
