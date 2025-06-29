<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

<form action="<?= $APPLICATION->GetCurPage(); ?>" method="get" class="currencyrates-filter">
    <div class="currencyrates-filter__group">
        <div class="currencyrates-filter__row">
            <div class="currencyrates-filter__field">
                <label for="CODE"><?= $arResult['FILTER']['CODE']['NAME']; ?>:</label>
                <input type="text" name="CODE" id="CODE" value="<?= htmlspecialchars($_REQUEST['CODE'] ?? ''); ?>" placeholder="<?= Loc::getMessage('CURRENCYRATES_FILTER_CODE_PLACEHOLDER'); ?>" class="currencyrates-filter__input">
            </div>
        </div>

        <div class="currencyrates-filter__row">
            <div class="currencyrates-filter__field">
                <label for="DATE_FROM"><?= $arResult['FILTER']['DATE_FROM']['NAME']; ?>:</label>
                <?= CalendarDate('DATE_FROM', $_REQUEST['DATE_FROM'] ?? '', 'currencyrates_filter_form', 'class="currencyrates-filter__input"'); ?>
            </div>
            <div class="currencyrates-filter__field">
                <label for="DATE_TO"><?= $arResult['FILTER']['DATE_TO']['NAME']; ?>:</label>
                <?= CalendarDate('DATE_TO', $_REQUEST['DATE_TO'] ?? '', 'currencyrates_filter_form', 'class="currencyrates-filter__input"'); ?>
            </div>
        </div>

        <div class="currencyrates-filter__row">
            <div class="currencyrates-filter__field">
                <label for="COURSE_FROM"><?= $arResult['FILTER']['COURSE_FROM']['NAME']; ?>:</label>
                <input type="text" name="COURSE_FROM" id="COURSE_FROM" value="<?= htmlspecialchars($_REQUEST['COURSE_FROM'] ?? ''); ?>" class="currencyrates-filter__input">
            </div>
            <div class="currencyrates-filter__field">
                <label for="COURSE_TO"><?= $arResult['FILTER']['COURSE_TO']['NAME']; ?>:</label>
                <input type="text" name="COURSE_TO" id="COURSE_TO" value="<?= htmlspecialchars($_REQUEST['COURSE_TO'] ?? ''); ?>" class="currencyrates-filter__input">
            </div>
        </div>
    </div>

    <div class="currencyrates-filter__buttons">
        <button type="submit" class="currencyrates-filter__button"><?= Loc::getMessage('CURRENCYRATES_FILTER_SUBMIT'); ?></button>
        <button type="reset" class="currencyrates-filter__button"><?= Loc::getMessage('CURRENCYRATES_FILTER_RESET'); ?></button>
    </div>
</form> 