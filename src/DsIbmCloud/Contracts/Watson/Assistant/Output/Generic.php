<?php


namespace DsIbmCloud\Contracts\Watson\Assistant\Output;

use Illuminate\Contracts\Support\Arrayable as ArrayableContract;

interface Generic extends ArrayableContract
{
    const TYPE_TEXT = 'text';
    const TYPE_OPTION = 'option';
    const TYPE_PAUSE = 'pause';
    const TYPE_IMAGE = 'image';
    const TYPE_CONNECT_TO_AGENT = 'connect_to_agent';

    public function getType();
}
