<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;

Loc::loadMessages(__FILE__);

class CurrencyratesFilterComponent extends CBitrixComponent
{
    /**
     * Проверяем, загружены ли необходимые модули
     * @return bool
     * @throws \Bitrix\Main\LoaderException
     */
    protected function checkModules()
    {
        if (!Loader::includeModule('currencyrates')) {
            ShowError(Loc::getMessage('CURRENCYRATES_MODULE_NOT_INSTALLED'));
            return false;
        }

        return true;
    }

    /**
     * Подготавливает входные параметры
     * @param array $arParams
     * @return array
     */
    public function onPrepareComponentParams($arParams)
    {
        $arParams['FILTER_NAME'] = isset($arParams['FILTER_NAME']) ? trim($arParams['FILTER_NAME']) : 'currencyFilter';
        if (empty($arParams['FILTER_NAME'])) {
            $arParams['FILTER_NAME'] = 'currencyFilter';
        }

        // Устанавливаем имя массива фильтра в глобальной области видимости
        global ${$arParams['FILTER_NAME']};
        if (!is_array(${$arParams['FILTER_NAME']})) {
            ${$arParams['FILTER_NAME']} = [];
        }

        return $arParams;
    }

    /**
     * Выполнение компонента
     */
    public function executeComponent()
    {
        if (!$this->checkModules()) {
            return;
        }

        // Получаем фильтр из формы
        $this->arResult['FILTER'] = $this->getFilter();

        // Устанавливаем фильтр в глобальную переменную для использования в других компонентах
        global ${$this->arParams['FILTER_NAME']};
        ${$this->arParams['FILTER_NAME']} = $this->getFilterValues();

        $this->includeComponentTemplate();
    }

    /**
     * Получает структуру фильтра
     * @return array
     */
    protected function getFilter()
    {
        return [
            'CODE' => [
                'NAME' => Loc::getMessage('CURRENCYRATES_FILTER_CODE'),
                'TYPE' => 'STRING',
                'DEFAULT' => '',
            ],
            'DATE_FROM' => [
                'NAME' => Loc::getMessage('CURRENCYRATES_FILTER_DATE_FROM'),
                'TYPE' => 'DATE',
                'DEFAULT' => '',
            ],
            'DATE_TO' => [
                'NAME' => Loc::getMessage('CURRENCYRATES_FILTER_DATE_TO'),
                'TYPE' => 'DATE',
                'DEFAULT' => '',
            ],
            'COURSE_FROM' => [
                'NAME' => Loc::getMessage('CURRENCYRATES_FILTER_COURSE_FROM'),
                'TYPE' => 'NUMBER',
                'DEFAULT' => '',
            ],
            'COURSE_TO' => [
                'NAME' => Loc::getMessage('CURRENCYRATES_FILTER_COURSE_TO'),
                'TYPE' => 'NUMBER',
                'DEFAULT' => '',
            ],
        ];
    }

    /**
     * Получает значения фильтра на основе входных данных
     * @return array
     */
    protected function getFilterValues()
    {
        $result = [];
        $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

        // Получаем значение фильтра по коду валюты
        if ($request->get('CODE')) {
            $result['CODE'] = $request->get('CODE');
        }

        // Получаем значения фильтра по дате
        if ($request->get('DATE_FROM')) {
            $dateFrom = new DateTime($request->get('DATE_FROM') . ' 00:00:00');
            $result['>=DATE'] = $dateFrom;
        }

        if ($request->get('DATE_TO')) {
            $dateTo = new DateTime($request->get('DATE_TO') . ' 23:59:59');
            $result['<=DATE'] = $dateTo;
        }

        // Получаем значения фильтра по курсу
        if ($request->get('COURSE_FROM')) {
            $result['>=COURSE'] = $request->get('COURSE_FROM');
        }

        if ($request->get('COURSE_TO')) {
            $result['<=COURSE'] = $request->get('COURSE_TO');
        }

        return $result;
    }
} 