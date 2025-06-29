<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

<?php if (!empty($arResult['ITEMS'])): ?>
    <div class="currencyrates-list">
        <div class="currencyrates-list__header">
            <div class="currencyrates-list__row">
                <?php foreach ($arResult['HEADERS'] as $code => $header): ?>
                    <div class="currencyrates-list__col currencyrates-list__col--<?= strtolower($code); ?>">
                        <?= $header['NAME']; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="currencyrates-list__body">
            <?php foreach ($arResult['ITEMS'] as $item): ?>
                <div class="currencyrates-list__row">
                    <?php foreach ($arResult['COLUMNS'] as $column): ?>
                        <div class="currencyrates-list__col currencyrates-list__col--<?= strtolower($column); ?>">
                            <?php if ($column === 'DATE' && isset($item[$column])): ?>
                                <?= $item[$column]->toString(); ?>
                            <?php elseif ($column === 'COURSE' && isset($item[$column])): ?>
                                <?= number_format($item[$column], 4, '.', ' '); ?>
                            <?php else: ?>
                                <?= htmlspecialchars($item[$column] ?? ''); ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php
    // Выводим постраничную навигацию
    $APPLICATION->IncludeComponent(
        'bitrix:main.pagenavigation',
        '',
        [
            'NAV_OBJECT' => $arResult['NAV'],
            'SEF_MODE' => 'N',
        ],
        false
    );
    ?>

    <div class="currencyrates-list__total">
        <?= Loc::getMessage('CURRENCYRATES_LIST_TOTAL_ITEMS', ['#COUNT#' => $arResult['TOTAL_ITEMS']]); ?>
    </div>
<?php else: ?>
    <div class="currencyrates-list__empty">
        <?= Loc::getMessage('CURRENCYRATES_LIST_EMPTY'); ?>
    </div>
<?php endif; ?> 