# IBM Cloud SDK for PHP - Watson Assistant V2

## Usage

Simple Usage.

```php
require_once __DIR__ . '/vendor/autoload.php';

$assistant = \DsIbmCloud\IbmCloudFactory::watsonAssistant(
    'https://api.us-south.assistant.watson.cloud.ibm.com/instances/<INSTANCE ID>',
    '<APIKEY>',
    '<ASSISTANT ID>'
);

$assistantData = $assistant->send('hello');

$generic = $assistantData->getData()->getOutput()->getGeneric();

//Show Messages
foreach ($generic as $item) {
    if ($item instanceof \DsIbmCloud\Watson\Assistant\Output\Text) {
        echo "<p>{$item->getText()}</p>";
    }

    if ($item->getType() === \DsIbmCloud\Contracts\Watson\Assistant\Output\Generic::TYPE_OPTION) {
        
        echo "<h3>{$item->getTitle()}</h3>";
        
        $options = array_map(function (\DsIbmCloud\Watson\Assistant\Output\Options\Option $option) {
            return "<li>Label: {$option->getLabel()} - Value: {$option->getValue()->getText()}</li>";
        }, $item->getOptions());
        
        echo "<ul>" . implode('', $options) . "</ul>";

    }
}
```
Saving to your database or cache

```php
$sessionId = $assistantData->getSessionId();
$array = $assistantData->toArray();
$json = json_encode($array);
```

Retrieving from database or cache and using `fromArray`

```php
$array = json_decode($json, true);

//AssistantData Object
$assistantData = \DsIbmCloud\Watson\Assistant\AssistantData::fromArray($array);

$assistantData->getSessionId();
```

Reply

```php
$assistantData = $assistant->send("what's your name", $assistantData->getSessionId());
```

Using context

```php
// Set Context
$context = \DsIbmCloud\Watson\Assistant\Context\Context::create(
    null, //Global
    \DsIbmCloud\Watson\Assistant\Context\ContextSkills::create(
        \DsIbmCloud\Watson\Assistant\Context\MainSkill::create(
            [
                'name' => 'David',
                'email' => 'david@dsinove.com.br'
            ]
        )
    )
);
//OR
$context = \DsIbmCloud\Watson\Assistant\Context\Context::create(
    null, //Global
    \DsIbmCloud\Watson\Assistant\Context\ContextSkills::create(
        \DsIbmCloud\Watson\Assistant\Context\MainSkill::create()
            ->addUserDefined('name', 'David')
            ->addUserDefined('email', 'david@dsinove.com.br')
    )
);

$input = \DsIbmCloud\Watson\Assistant\Input\Input::create("what's your name");

$assistantData = $assistant->send(
    \DsIbmCloud\Watson\Assistant\Data::create($input, null, $context),
    $assistantData->getSessionId()
);

// Using Context
$context = $assistantData->getData()->getContext();

$context->getGlobal()->getSystem();
$context->getSkills()->getMainSkill()->getUserDefined();

// Update Context
$context->getSkills()->getMainSkill()
    ->addUserDefined('name', 'Jhon')
    ->addUserDefined('email', 'dsinove@gmail.com')
    ->addUserDefined('phone', '+9999999999');

$assistantData = $assistant->send(
    \DsIbmCloud\Watson\Assistant\Data::create($input, null, $context),
    $assistantData->getSessionId()
);
```