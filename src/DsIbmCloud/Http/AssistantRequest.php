<?php

namespace DsIbmCloud\Http;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class AssistantRequest
{
    const VERSION = '2020-02-05';
    const URL = '{url}/v2/assistants/{assistantId}';
    const URL_SESSION = self::URL . '/sessions?version=' . self::VERSION;
    const URL_ASSISTANT = self::URL . '/sessions/{sessionId}/message?version=' . self::VERSION;

    private static function http(
        $type,
        string $url,
        string $apiKey,
        string $assistantId,
        string $sessionId = null,
        $data = null
    ): ResponseInterface
    {
        $url = strtr($url, [
            '{assistantId}' => $assistantId,
            '{sessionId}' => $sessionId
        ]);

        $options = ['auth' => ['apiKey', $apiKey]];

        if (!empty($data)) {
            $options['json'] = $data;
        }

        return (new Client())->$type($url, $options);
    }

    public static function createSession(string $url, string $apiKey, string $assistantId): array
    {
        $url = strtr(self::URL_SESSION, [
            '{url}' => $url
        ]);

        $response = self::http('post', $url, $apiKey, $assistantId);

        return json_decode($response->getBody()->getContents(), true);
    }

    public static function sendData(
        string $url,
        string $apiKey,
        string $assistantId,
        string $sessionId,
        $data
    ): array
    {
        $url = strtr(self::URL_ASSISTANT, [
            '{url}' => $url
        ]);

        $response = self::http('post', $url, $apiKey, $assistantId, $sessionId, $data);

        return json_decode($response->getBody()->getContents(), true);
    }
}
