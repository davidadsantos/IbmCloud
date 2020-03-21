<?php

namespace DsIbmCloud\Watson\Assistant\Context;

use DsIbmCloud\Contracts\Arrayable as ArrayableContract;

class Context implements ArrayableContract
{
    private $global;
    private $skills;

    public function __construct(?ContextGlobal $global = null, ?ContextSkills $skills = null)
    {
        $this->global = $global;
        $this->skills = $skills;
    }

    public function setGlobal(?ContextGlobal $global): self
    {
        $this->global = $global;
        return $this;
    }

    public function getGlobal(): ?ContextGlobal
    {
        return $this->global;
    }

    public function setSkills(?ContextSkills $skills): self
    {
        $this->skills = $skills;
        return $this;
    }

    public function getSkills(): ?ContextSkills
    {
        return $this->skills;
    }

    public function toArray(): array
    {
        $data = [];

        if ($global = $this->getGlobal()) {
            $data['global'] = $global->toArray();
        }

        if ($skills = $this->getSkills()) {
            $data['skills'] = $skills->toArray();
        }

        return $data;
    }

    public static function create(ContextGlobal $global = null, ContextSkills $skills = null): self
    {
        return new static($global, $skills);
    }
}
