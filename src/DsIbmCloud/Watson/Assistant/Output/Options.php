<?php

namespace DsIbmCloud\Watson\Assistant\Output;

use DsIbmCloud\Contracts\Watson\Assistant\Output\Generic as GenericContract;
use DsIbmCloud\Watson\Assistant\Output\Options\Option;

class Options implements GenericContract
{
    private $type = GenericContract::TYPE_OPTION;
    private $title;
    private $description;

    /**
     * @var Option[]
     */
    private $options;

    public function __construct(?string $title, ?string $description, array $options = [])
    {
        $this->title = $title;
        $this->description = $description;
        $this->options = $options;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param Option[] $options
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return Option[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    public function addOption(Option $option): self
    {
        $this->options[] = $option;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'response_type' => $this->getType(),
            'options' => array_map(function (Option $option) {
                return $option->toArray();
            }, $this->getOptions())
        ];
    }

    public static function create(?string $title, ?string $description, array $options = []): self
    {
        return new static($title, $description, $options);
    }
}
