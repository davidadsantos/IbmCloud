<?php

namespace DsIbmCloud\Watson\Assistant\Context;

use DsIbmCloud\Contracts\Arrayable as ArrayableContract;

class ContextGlobal implements ArrayableContract
{
    private $system;

    public function __construct(array $system = [])
    {
        $this->system = $system;
    }

    public function setSystem(array $system): self
    {
        $this->system = $system;
        return $this;
    }

    public function getSystem(): array
    {
        return $this->system;
    }

    public function addSystem($key, $value): self
    {
        $this->system[$key] = $value;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'system' => $this->getSystem()
        ];
    }

    public static function create(array $system = []): self
    {
        return new static($system);
    }
}