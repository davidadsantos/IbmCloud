<?php

namespace DsIbmCloud;

use DsIbmCloud\Watson\Assistant\Assistant;

class IbmCloudFactory
{
    static public function watsonAssistant(string $url, string $apiKey, string $assistantId)
    {
        return Assistant::create($url, $apiKey, $assistantId);
    }
}
