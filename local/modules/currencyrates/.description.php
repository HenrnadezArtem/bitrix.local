<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arModuleVersion = [
    'VERSION' => '1.0.0',
    'VERSION_DATE' => '2025-06-29 18:50:00'
];

$arModuleInfo = [
    'NAME' => Loc::getMessage('CURRENCYRATES_MODULE_NAME'),
    'DESCRIPTION' => Loc::getMessage('CURRENCYRATES_MODULE_DESCRIPTION'),
    'VERSION' => $arModuleVersion['VERSION'],
    'PARTNER_NAME' => Loc::getMessage('CURRENCYRATES_PARTNER_NAME'),
    'PARTNER_URI' => Loc::getMessage('CURRENCYRATES_PARTNER_URI')
]; 