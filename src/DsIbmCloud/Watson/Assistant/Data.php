<?php

namespace DsIbmCloud\Watson\Assistant;

use DsIbmCloud\Contracts\Arrayable as ArrayableContract;
use DsIbmCloud\Watson\Assistant\Context\Context;
use DsIbmCloud\Watson\Assistant\Input\Input;
use DsIbmCloud\Watson\Assistant\Output\Output;

class Data implements ArrayableContract
{
    private $input;
    private $output;
    private $context;

    public function __construct(?Input $input = null, ?Output $output = null, ?Context $context = null)
    {
        $this->input = $input;
        $this->output = $output;
        $this->context = $context;
    }

    public function setInput(?Input $input): self
    {
        $this->input = $input;
        return $this;
    }

    public function getInput(): ?Input
    {
        return $this->input;
    }

    public function setOutput(?Output $output): self
    {
        $this->output = $output;
        return $this;
    }

    public function getOutput(): ?Output
    {
        return $this->output;
    }

    public function setContext(Context $context): self
    {
        $this->context = $context;
        return $this;
    }

    public function getContext(): ?Context
    {
        return $this->context;
    }

    public function toArray(): array
    {
        $data = [];

        if ($input = $this->getInput()) {
            $data['input'] = $input->toArray();
        }

        if ($context = $this->getContext()) {
            $data['context'] = $context->toArray();
        }

        if ($output = $this->getOutput()) {
            $data['output'] = $output->toArray();
        }

        return $data;
    }

    public static function create(?Input $input = null, ?Output $output = null, ?Context $context = null): self
    {
        return new static($input, $output, $context);
    }
}
