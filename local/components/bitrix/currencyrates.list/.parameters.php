<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentParameters = [
    'GROUPS' => [
        'SETTINGS' => [
            'NAME' => Loc::getMessage('CURRENCYRATES_LIST_SETTINGS'),
            'SORT' => 100,
        ],
        'COLUMNS' => [
            'NAME' => Loc::getMessage('CURRENCYRATES_LIST_COLUMNS'),
            'SORT' => 200,
        ],
        'PAGINATION' => [
            'NAME' => Loc::getMessage('CURRENCYRATES_LIST_PAGINATION'),
            'SORT' => 300,
        ],
    ],
    'PARAMETERS' => [
        'FILTER_NAME' => [
            'PARENT' => 'SETTINGS',
            'NAME' => Loc::getMessage('CURRENCYRATES_LIST_FILTER_NAME'),
            'TYPE' => 'STRING',
            'DEFAULT' => 'currencyFilter',
        ],
        'SHOW_ID' => [
            'PARENT' => 'COLUMNS',
            'NAME' => Loc::getMessage('CURRENCYRATES_LIST_SHOW_ID'),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y',
        ],
        'SHOW_CODE' => [
            'PARENT' => 'COLUMNS',
            'NAME' => Loc::getMessage('CURRENCYRATES_LIST_SHOW_CODE'),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y',
        ],
        'SHOW_DATE' => [
            'PARENT' => 'COLUMNS',
            'NAME' => Loc::getMessage('CURRENCYRATES_LIST_SHOW_DATE'),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y',
        ],
        'SHOW_COURSE' => [
            'PARENT' => 'COLUMNS',
            'NAME' => Loc::getMessage('CURRENCYRATES_LIST_SHOW_COURSE'),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y',
        ],
        'ELEMENTS_PER_PAGE' => [
            'PARENT' => 'PAGINATION',
            'NAME' => Loc::getMessage('CURRENCYRATES_LIST_ELEMENTS_PER_PAGE'),
            'TYPE' => 'STRING',
            'DEFAULT' => '20',
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
    ],
]; 