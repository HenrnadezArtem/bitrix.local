<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses(
    'currencyrates',
    [
        'Currencyrates\\CurrencyTable' => 'lib/currencytable.php',
    ]
); 