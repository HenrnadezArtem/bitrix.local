<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Курсы валют");
?>

<?php
// Подключаем модуль
if (!\Bitrix\Main\Loader::includeModule('currencyrates')) {
    ShowError('Модуль курсов валют не установлен');
    return;
}

// Добавляем пример данных, если таблица пуста
$count = \Currencyrates\CurrencyTable::getCount();
if ($count === 0) {
    $currencies = [
        [
            'CODE' => 'USD',
            'DATE' => new \Bitrix\Main\Type\DateTime(),
            'COURSE' => 93.45,
        ],
        [
            'CODE' => 'EUR',
            'DATE' => new \Bitrix\Main\Type\DateTime(),
            'COURSE' => 102.73,
        ],
        [
            'CODE' => 'GBP',
            'DATE' => new \Bitrix\Main\Type\DateTime(),
            'COURSE' => 119.82,
        ],
        [
            'CODE' => 'JPY',
            'DATE' => new \Bitrix\Main\Type\DateTime(),
            'COURSE' => 0.63,
        ],
        [
            'CODE' => 'CNY',
            'DATE' => new \Bitrix\Main\Type\DateTime(),
            'COURSE' => 13.15,
        ],
    ];

    foreach ($currencies as $currency) {
        \Currencyrates\CurrencyTable::add($currency);
    }
}
?>

<div class="currency-rates-page">
    <h2>Фильтр курсов валют</h2>

    <?php $APPLICATION->IncludeComponent(
        "bitrix:currencyrates.filter",
        ".default",
        [
            "FILTER_NAME" => "currencyFilter",
            "CACHE_TIME" => "3600",
        ]
    ); ?>

    <h2>Список курсов валют</h2>

    <?php $APPLICATION->IncludeComponent(
        "bitrix:currencyrates.list",
        ".default",
        [
            "FILTER_NAME" => "currencyFilter",
            "SHOW_ID" => "Y",
            "SHOW_CODE" => "Y",
            "SHOW_DATE" => "Y",
            "SHOW_COURSE" => "Y",
            "ELEMENTS_PER_PAGE" => "20",
            "CACHE_TIME" => "3600",
        ]
    ); ?>
</div>

<style>
.currency-rates-page {
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
}
</style>

<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?> 