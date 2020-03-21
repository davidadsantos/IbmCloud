<?php

namespace DsIbmCloud\Watson\Assistant;

use DsIbmCloud\Http\AssistantRequest;
use DsIbmCloud\Watson\Assistant\Input\Input;

class Assistant
{
    private $url;
    private $apiKey;
    private $assistantId;

    public function __construct(string $url, string $apiKey, string $assistantId)
    {
        $this->url = $url;
        $this->apiKey = $apiKey;
        $this->assistantId = $assistantId;
    }

    private function createSession(): string
    {
        return AssistantRequest::createSession($this->url, $this->apiKey, $this->assistantId)['session_id'];
    }

    private function sendData(Data $data, string $sessionId): Data
    {
        $response = AssistantRequest::sendData($this->url, $this->apiKey, $this->assistantId, $sessionId, $data->toArray());

        $data->setContext(DataFactory::createContext($response));
        $data->setOutput(DataFactory::createOutput($response));

        return $data;
    }

    /**
     * @param string|Data $data
     * @param string|null $sessionId
     * @return AssistantData
     */
    public function send($data, string $sessionId = null): AssistantData
    {

        $data = $data instanceof Data ? $data : Data::create(Input::create($data));

        $data->setOutput(null);

        $sessionId = $sessionId ?? $this->createSession();

        $data = $this->sendData($data, $sessionId);

        return AssistantData::create($sessionId, $data);
    }

    public static function create(string $url, string $apiKey, string $assistantId): self
    {
        return new static($url, $apiKey, $assistantId);
    }
}
