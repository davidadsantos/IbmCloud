<?php

namespace DsIbmCloud\Watson\Assistant\Output;

use DsIbmCloud\Contracts\Watson\Assistant\Output\Generic as GenericContract;

class ConnectToAgent implements GenericContract
{
    private $type = GenericContract::TYPE_CONNECT_TO_AGENT;
    private $messageToHumanAgent;
    private $topic;
    private $dialogNode;

    public function __construct(?string $messageToHumanAgent, ?string $topic, ?string $dialogNode)
    {
        $this->messageToHumanAgent = $messageToHumanAgent;
        $this->topic = $topic;
        $this->dialogNode = $dialogNode;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getMessageToHumanAgent(): ?string
    {
        return $this->messageToHumanAgent;
    }

    public function setMessageToHumanAgent(?string $messageToHumanAgent): self
    {
        $this->messageToHumanAgent = $messageToHumanAgent;
        return $this;
    }

    public function getTopic(): ?string
    {
        return $this->topic;
    }

    public function setTopic(?string $topic): self
    {
        $this->topic = $topic;
        return $this;
    }

    public function getDialogNode(): ?string
    {
        return $this->dialogNode;
    }

    public function setDialogNode(?string $dialogNode): self
    {
        $this->dialogNode = $dialogNode;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'response_type' => $this->getType(),
            'message_to_human_agent' => $this->getMessageToHumanAgent(),
            'topic' => $this->getTopic(),
            'dialog_node' => $this->getDialogNode()
        ];
    }

    public static function create(?string $messageToHumanAgent, ?string $topic, ?string $dialogNode): self
    {
        return new static($messageToHumanAgent, $topic, $dialogNode);
    }
}
