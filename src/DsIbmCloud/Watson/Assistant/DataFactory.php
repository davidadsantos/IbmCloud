<?php

namespace DsIbmCloud\Watson\Assistant;

use DsIbmCloud\Contracts\Watson\Assistant\Output\Generic;
use DsIbmCloud\Watson\Assistant\Context\Context;
use DsIbmCloud\Watson\Assistant\Context\ContextGlobal;
use DsIbmCloud\Watson\Assistant\Context\ContextSkills;
use DsIbmCloud\Watson\Assistant\Context\MainSkill;
use DsIbmCloud\Watson\Assistant\Input\Input;
use DsIbmCloud\Watson\Assistant\Output\ConnectToAgent;
use DsIbmCloud\Watson\Assistant\Output\Entity;
use DsIbmCloud\Watson\Assistant\Output\Image;
use DsIbmCloud\Watson\Assistant\Output\Intent;
use DsIbmCloud\Watson\Assistant\Output\Options;
use DsIbmCloud\Watson\Assistant\Output\Output;
use DsIbmCloud\Watson\Assistant\Output\Pause;
use DsIbmCloud\Watson\Assistant\Output\Text;
use \DsIbmCloud\Watson\Assistant\Input\Options as InputOptions;

class DataFactory
{
    private static function createContextGlobal(Context &$context, array $data)
    {
        $dataGlobal = $data['global'] ?? null;

        if (!$dataGlobal) {
            return;
        }

        $global = ContextGlobal::create();

        $dataGlobalSystem = $dataGlobal['system'] ?? null;

        if ($dataGlobalSystem) {
            $global->setSystem($dataGlobalSystem);
        }

        $context->setGlobal($global);
    }

    private static function createContextSkills(Context &$context, array $data)
    {
        $dataSkills = $data['skills'] ?? null;

        if (!$dataSkills) {
            return;
        }

        $skills = ContextSkills::create();

        $dataSkillsMain = $dataSkills['main skill'] ?? null;

        if ($dataSkillsMain) {
            $mainSkill = MainSkill::create();

            $dataSkillsMainUser = $dataSkillsMain['user_defined'] ?? null;

            if ($dataSkillsMainUser) {
                $mainSkill->setUserDefined($dataSkillsMainUser);
            }

            $dataSkillsMainSystem = $dataSkillsMain['system'] ?? null;

            if ($dataSkillsMainSystem) {
                $mainSkill->setSystem($dataSkillsMainSystem);
            }

            $skills->setMainSkill($mainSkill);
        }

        $context->setSkills($skills);
    }

    public static function createContext(array $data): ?Context
    {
        $data = $data['context'] ?? null;

        if (!$data) {
            return null;
        }

        $context = Context::create();

        self::createContextGlobal($context, $data);
        self::createContextSkills($context, $data);

        return $context;
    }

    private static function createOutputGenericOption(Options &$options, array $data)
    {
        foreach ($data as $item) {
            $input = Options\Input::create($item['value']['input']['text'] ?? null);
            $options->addOption(Options\Option::create($item['label'], $input));
        }
    }

    private static function createOutputGeneric(Output &$output, array $data)
    {
        $genericData = $data['generic'] ?? null;

        if (!$genericData) {
            return;
        }

        $generic = array_map(function ($item) {
            if ($item['response_type'] === Generic::TYPE_TEXT) {
                return Text::create($item['text']);
            }

            if ($item['response_type'] === Generic::TYPE_OPTION) {
                $options = Options::create($item['title'], $item['description']);
                self::createOutputGenericOption($options, $item['options']);
                return $options;
            }

            if ($item['response_type'] === Generic::TYPE_IMAGE) {
                return Image::create($item['title'], $item['source'], $item['description']);
            }

            if ($item['response_type'] === Generic::TYPE_PAUSE) {
                return Pause::create($item['time'], (bool)$item['typing']);
            }

            if ($item['response_type'] === Generic::TYPE_CONNECT_TO_AGENT) {
                return ConnectToAgent::create($item['message_to_human_agent'], $item['topic'], $item['dialog_node']);
            }

        }, $genericData);

        $output->setGeneric($generic);
    }

    private static function createOutputIntents(Output &$output, array $data)
    {
        $intentsData = $data['intents'] ?? null;

        if (!$intentsData) {
            return;
        }

        $intents = array_map(function ($item) {
            return Intent::create($item['intent'], $item['confidence']);
        }, $intentsData);

        $output->setIntents($intents);
    }

    private static function createOutputEntities(Output &$output, array $data)
    {
        $entitiesData = $data['entities'] ?? null;

        if (!$entitiesData) {
            return;
        }

        $entities = array_map(function ($item) {
            return Entity::create($item['entity'], $item['location'], $item['value'], (float)$item['confidence']);
        }, $entitiesData);

        $output->setEntities($entities);
    }

    public static function createOutput(array $data): ?Output
    {
        $data = $data['output'] ?? null;

        if (!$data) {
            return null;
        }

        $output = Output::create();

        self::createOutputGeneric($output, $data);
        self::createOutputIntents($output, $data);
        self::createOutputEntities($output, $data);

        return $output;
    }

    public static function createInput(array $data): ?Input
    {
        $data = $data['input'] ?? null;

        if (!$data) {
            return null;
        }

        $input = Input::create($data['text'] ?? null);

        if (!empty($data['options'])) {
            $input->setOptions(InputOptions::create((bool)$data['options']['return_context']));
        }

        return $input;
    }
}
