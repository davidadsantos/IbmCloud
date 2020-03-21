<?php

namespace DsIbmCloud\Watson\Assistant\Context;

use DsIbmCloud\Contracts\Arrayable as ArrayableContract;

class ContextSkills implements ArrayableContract
{
    private $mainSkill;

    public function __construct(MainSkill $mainSkill = null)
    {
        $this->mainSkill = $mainSkill;
    }

    public function setMainSkill(MainSkill $mainSkill): self
    {
        $this->mainSkill = $mainSkill;
        return $this;
    }

    public function getMainSkill(): ?MainSkill
    {
        return $this->mainSkill;
    }

    public function toArray(): array
    {
        $data = [];

        if ($mainSkill = $this->getMainSkill()) {
            $data['main skill'] = $mainSkill->toArray();
        }

        return $data;
    }

    public static function create(MainSkill $mainSkill = null): self
    {
        return new static($mainSkill);
    }
}

