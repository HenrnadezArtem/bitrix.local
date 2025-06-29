<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Currencyrates\CurrencyRateTable;
use Bitrix\Main\UI\PageNavigation;

Loader::includeModule('bitrix.currencyrates');

// Получаем фильтры из запроса
$filter = [];
if (!empty($_GET['filter_code'])) {
    $filter['=CODE'] = $_GET['filter_code'];
}
if (!empty($_GET['filter_date_from'])) {
    $filter['>=DATE'] = $_GET['filter_date_from'];
}
if (!empty($_GET['filter_date_to'])) {
    $filter['<=DATE'] = $_GET['filter_date_to'];
}
if (!empty($_GET['filter_course_from'])) {
    $filter['>=COURSE'] = floatval($_GET['filter_course_from']);
}
if (!empty($_GET['filter_course_to'])) {
    $filter['<=COURSE'] = floatval($_GET['filter_course_to']);
}

// Колонки для вывода (по умолчанию все)
$allColumns = ['ID', 'CODE', 'DATE', 'COURSE'];
if (!empty($_GET['columns']) && is_array($_GET['columns'])) {
    $columns = array_intersect($allColumns, $_GET['columns']);
    if (empty($columns)) {
        $columns = $allColumns;
    }
} else {
    $columns = $arParams['COLUMNS'] ?? $allColumns;
    if (!is_array($columns) || empty($columns)) {
        $columns = $allColumns;
    }
}

// Постраничная навигация
$nav = new PageNavigation('currencyrates_nav');
$nav->allowAllRecords(false)
    ->setPageSize($arParams['PAGE_SIZE'] ?? 10)
    ->initFromUri();

// Получаем данные
$result = CurrencyRateTable::getList([
    'select' => $columns,
    'filter' => $filter,
    'order' => ['DATE' => 'DESC', 'ID' => 'DESC'],
    'limit' => $nav->getLimit(),
    'offset' => $nav->getOffset(),
    'count_total' => true,
]);

$arResult['ITEMS'] = [];
while ($row = $result->fetch()) {
    $arResult['ITEMS'][] = $row;
}
$arResult['COLUMNS'] = $columns;
$arResult['ALL_COLUMNS'] = $allColumns;
$arResult['NAV'] = $nav;
$arResult['TOTAL_COUNT'] = $result->getCount();
$nav->setRecordCount($arResult['TOTAL_COUNT']);

$this->IncludeComponentTemplate(); 