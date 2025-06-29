<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$MESS = $GLOBALS['MESS'];
IncludeTemplateLangFile(__FILE__);
?>
<div>
    <form method="get" style="margin-bottom: 10px;">
        <label><?=$MESS['CURRENCYRATES_LIST_SHOW_COLUMNS']?></label>
        <?php foreach ($arResult['ALL_COLUMNS'] as $col): ?>
            <label style="margin-right: 10px;">
                <input type="checkbox" name="columns[]" value="<?= $col ?>" <?= in_array($col, $arResult['COLUMNS']) ? 'checked' : '' ?>>
                <?= $MESS['CURRENCYRATES_LIST_' . $col] ?? htmlspecialchars($col) ?>
            </label>
        <?php endforeach; ?>
        <button type="submit"><?=$MESS['CURRENCYRATES_LIST_APPLY']?></button>
        <?php // Сохраняем фильтры при смене колонок
        foreach (["filter_code","filter_date_from","filter_date_to","filter_course_from","filter_course_to"] as $f):
            if (!empty($_GET[$f])): ?>
                <input type="hidden" name="<?= $f ?>" value="<?= htmlspecialchars($_GET[$f]) ?>">
            <?php endif;
        endforeach; ?>
    </form>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <?php foreach ($arResult['COLUMNS'] as $col): ?>
                    <th><?= $MESS['CURRENCYRATES_LIST_' . $col] ?? htmlspecialchars($col) ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($arResult['ITEMS'] as $item): ?>
                <tr>
                    <?php foreach ($arResult['COLUMNS'] as $col): ?>
                        <td>
                            <?php
                            if ($col === 'DATE' && !empty($item[$col])) {
                                echo htmlspecialchars((new \Bitrix\Main\Type\DateTime($item[$col]))->format('Y-m-d'));
                            } else {
                                echo htmlspecialchars($item[$col]);
                            }
                            ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div style="margin-top:10px;">
        <?php
        if ($arResult['NAV']->getPageCount() > 1) {
            echo $arResult['NAV']->getNavigationHtml();
        }
        ?>
    </div>
</div> 