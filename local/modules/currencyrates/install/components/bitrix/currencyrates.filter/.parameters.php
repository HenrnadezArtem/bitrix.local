<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentParameters = [
    'GROUPS' => [
        'SETTINGS' => [
            'NAME' => Loc::getMessage('CURRENCYRATES_FILTER_SETTINGS'),
            'SORT' => 100,
        ],
    ],
    'PARAMETERS' => [
        'FILTER_NAME' => [
            'PARENT' => 'SETTINGS',
            'NAME' => Loc::getMessage('CURRENCYRATES_FILTER_NAME_PARAM'),
            'TYPE' => 'STRING',
            'DEFAULT' => 'currencyFilter',
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
    ],
]; 