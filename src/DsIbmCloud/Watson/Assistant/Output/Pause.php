<?php

namespace DsIbmCloud\Watson\Assistant\Output;

use DsIbmCloud\Contracts\Watson\Assistant\Output\Generic as GenericContract;

class Pause implements GenericContract
{
    private $type = GenericContract::TYPE_PAUSE;
    private $time;
    private $typing;

    public function __construct(int $time, bool $typing)
    {
        $this->time = $time;
        $this->typing = $typing;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTime(): int
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;
        return $this;
    }

    public function isTyping(): bool
    {
        return $this->typing;
    }

    public function setTyping(bool $typing): self
    {
        $this->typing = $typing;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'response_type' => $this->getType(),
            'time' => $this->getTime(),
            'typing' => $this->isTyping()
        ];
    }

    public static function create(int $time, bool $typing): self
    {
        return new static($time, $typing);
    }
}
