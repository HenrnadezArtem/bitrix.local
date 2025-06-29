<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$MESS = $GLOBALS['MESS'];
IncludeTemplateLangFile(__FILE__);
?>
<form method="get">
    <div>
        <label><?=$MESS['CURRENCYRATES_FILTER_CODE']?>:
            <input type="text" name="filter_code" value="<?= htmlspecialchars(
                isset($_GET['filter_code']) ? $_GET['filter_code'] : ''
            ) ?>">
        </label>
    </div>
    <div>
        <label><?=$MESS['CURRENCYRATES_FILTER_DATE_FROM']?>:
            <input type="date" name="filter_date_from" value="<?= htmlspecialchars(
                isset($_GET['filter_date_from']) ? $_GET['filter_date_from'] : ''
            ) ?>">
        </label>
        <label><?=$MESS['CURRENCYRATES_FILTER_DATE_TO']?>:
            <input type="date" name="filter_date_to" value="<?= htmlspecialchars(
                isset($_GET['filter_date_to']) ? $_GET['filter_date_to'] : ''
            ) ?>">
        </label>
    </div>
    <div>
        <label><?=$MESS['CURRENCYRATES_FILTER_COURSE_FROM']?>:
            <input type="number" step="0.0001" name="filter_course_from" value="<?= htmlspecialchars(
                isset($_GET['filter_course_from']) ? $_GET['filter_course_from'] : ''
            ) ?>">
        </label>
        <label><?=$MESS['CURRENCYRATES_FILTER_COURSE_TO']?>:
            <input type="number" step="0.0001" name="filter_course_to" value="<?= htmlspecialchars(
                isset($_GET['filter_course_to']) ? $_GET['filter_course_to'] : ''
            ) ?>">
        </label>
    </div>
    <div>
        <button type="submit"><?=$MESS['CURRENCYRATES_FILTER_SUBMIT']?></button>
    </div>
</form> 