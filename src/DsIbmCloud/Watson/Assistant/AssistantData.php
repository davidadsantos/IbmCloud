<?php

namespace DsIbmCloud\Watson\Assistant;

use DsIbmCloud\Contracts\Arrayable as ArrayableContract;

class AssistantData implements ArrayableContract
{
    private $sessionId;
    private $data;

    public function __construct(string $sessionId, Data $data)
    {
        $this->sessionId = $sessionId;
        $this->data = $data;
    }

    public function setSessionId(string $sessionId): self
    {
        $this->sessionId = $sessionId;
        return $this;
    }

    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    public function setData(Data $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function getData(): Data
    {
        return $this->data;
    }

    public function toArray(): array
    {
        return [
            'session_id' => $this->getSessionId(),
            'data' => $this->getData()->toArray()
        ];
    }

    public static function create(string $sessionId, Data $data): self
    {
        return new static($sessionId, $data);
    }

    public static function fromArray(array $data): self
    {
        $sessionId = $data['session_id'] ?? null;
        $data = $data['data'] ?? [];
        return self::create(
            $sessionId,
            Data::create(
                DataFactory::createInput($data),
                DataFactory::createOutput($data),
                DataFactory::createContext($data)
            )
        );
    }
}
