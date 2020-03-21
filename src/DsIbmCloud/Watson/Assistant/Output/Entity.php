<?php

namespace DsIbmCloud\Watson\Assistant\Output;

use DsIbmCloud\Contracts\Arrayable as ArrayableContract;

class Entity implements ArrayableContract
{
    private $entity;
    private $location;
    private $value;
    private $confidence;

    public function __construct(string $entity, array $location, string $value, float $confidence)
    {
        $this->entity = $entity;
        $this->location = $location;
        $this->value = $value;
        $this->confidence = $confidence;
    }

    public function getEntity(): string
    {
        return $this->entity;
    }

    public function setEntity(string $entity): self
    {
        $this->entity = $entity;
        return $this;
    }

    public function getLocation(): array
    {
        return $this->location;
    }

    public function setLocation(array $location): self
    {
        $this->location = $location;
        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;
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
            'entity' => $this->getEntity(),
            'location' => $this->getLocation(),
            'value' => $this->getValue(),
            'confidence' => $this->getConfidence()
        ];
    }

    public static function create(string $entity, array $location, string $value, float $confidence): self
    {
        return new static($entity, $location, $value, $confidence);
    }
}
