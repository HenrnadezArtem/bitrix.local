<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = [
    'NAME' => Loc::getMessage('CURRENCYRATES_LIST_NAME'),
    'DESCRIPTION' => Loc::getMessage('CURRENCYRATES_LIST_DESCRIPTION'),
    'ICON' => '/images/icon.gif',
    'SORT' => 20,
    'CACHE_PATH' => 'Y',
    'PATH' => [
        'ID' => 'currencyrates',
        'NAME' => Loc::getMessage('CURRENCYRATES_SECTION_NAME')
    ],
]; 