<?php

namespace DsIbmCloud\Watson\Assistant\Output;

use DsIbmCloud\Contracts\Watson\Assistant\Output\Generic as GenericContract;
use DsIbmCloud\Contracts\Arrayable as ArrayableContract;

class Output implements ArrayableContract
{
    /**
     * @var GenericContract[]
     */
    private $generic = [];

    /**
     * @var Intent[]
     */
    private $intents = [];

    /**
     * @var Entity[]
     */
    private $entities = [];

    /**
     * @return GenericContract[]
     */
    public function getGeneric(): array
    {
        return $this->generic;
    }

    /**
     * @param GenericContract[] $generic
     */
    public function setGeneric(array $generic): self
    {
        $this->generic = $generic;
        return $this;
    }

    public function addGeneric(GenericContract $generic): self
    {
        $this->generic[] = $generic;
        return $this;
    }

    /**
     * @return Intent[]
     */
    public function getIntents(): array
    {
        return $this->intents;
    }

    /**
     * @param Intent[] $intents
     */
    public function setIntents(array $intents): self
    {
        $this->intents = $intents;
        return $this;
    }

    public function addIntent(Intent $intent): self
    {
        $this->intents[] = $intent;
        return $this;
    }

    /**
     * @return Entity[]
     */
    public function getEntities(): array
    {
        return $this->entities;
    }

    /**
     * @param Entity[] $entities
     */
    public function setEntities(array $entities): self
    {
        $this->entities = $entities;
        return $this;
    }

    public function addEntity(Entity $entity): self
    {
        $this->entities[] = $entity;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'generic' => array_map(function (GenericContract $generic) {
                return $generic->toArray();
            }, $this->getGeneric()),
            'intents' => array_map(function (Intent $intent) {
                return $intent->toArray();
            }, $this->getIntents()),
            'entities' => array_map(function (Entity $entity) {
                return $entity->toArray();
            }, $this->getEntities())
        ];
    }

    public static function create(): self
    {
        return new static();
    }
}
