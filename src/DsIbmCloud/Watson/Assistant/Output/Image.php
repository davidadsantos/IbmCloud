<?php

namespace DsIbmCloud\Watson\Assistant\Output;

use DsIbmCloud\Contracts\Watson\Assistant\Output\Generic as GenericContract;

class Image implements GenericContract
{
    private $type = GenericContract::TYPE_IMAGE;
    private $title;
    private $source;
    private $description;

    public function __construct(?string $title, ?string $source, ?string $description = null)
    {
        $this->title = $title;
        $this->source = $source;
        $this->description = $description;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): self
    {
        $this->source = $source;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'response_type' => $this->getType(),
            'title' => $this->getTitle(),
            'source' => $this->getSource(),
            'description' => $this->getDescription()
        ];
    }

    public static function create(?string $title, ?string $source, ?string $description = null):self
    {
        return new static($title, $source, $description);
    }
}
