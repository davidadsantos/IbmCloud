<?php

namespace DsIbmCloud\Watson\Assistant\Input;

use DsIbmCloud\Contracts\Arrayable as ArrayableContract;

class Options implements ArrayableContract
{
    private $returnContext;

    public function __construct(bool $returnContext = true)
    {
        $this->returnContext = $returnContext;
    }

    public function setReturnContext(bool $returnContext): self
    {
        $this->returnContext = $returnContext;
        return $this;
    }

    public function isReturnContext(): bool
    {
        return $this->returnContext;
    }

    public function toArray(): array
    {
        return [
            'return_context' => $this->isReturnContext()
        ];
    }

    public static function create(bool $returnContext = true): self
    {
        return new static($returnContext);
    }
}
