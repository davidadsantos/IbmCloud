<?php

namespace DsIbmCloud\Watson\Assistant\Context;

use DsIbmCloud\Contracts\Factory as FactoryContract;
use Illuminate\Contracts\Support\Arrayable as ArrayableContract;

class MainSkill implements ArrayableContract, FactoryContract
{
    private $userDefined;

    public function __construct(array $userDefined = [])
    {
        $this->userDefined = $userDefined;
    }

    public function setUserDefined(array $userDefined): self
    {
        $this->userDefined = $userDefined;
        return $this;
    }

    public function getUserDefined(): array
    {
        return $this->userDefined;
    }

    public function addUserDefined($key, $value): self
    {
        $this->userDefined[$key] = $value;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'user_defined' => $this->getUserDefined()
        ];
    }

    public static function create(array $userDefined = []): self
    {
        return new static($userDefined);
    }
}
