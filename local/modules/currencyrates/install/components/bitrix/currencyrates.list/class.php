<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;
use Bitrix\Main\UI\PageNavigation;
use Currencyrates\CurrencyTable;

Loc::loadMessages(__FILE__);

class CurrencyratesListComponent extends CBitrixComponent
{
    /** @var array Массив активных колонок */
    private $activeColumns = [];

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
        $result = [
            'FILTER_NAME' => isset($arParams['FILTER_NAME']) ? trim($arParams['FILTER_NAME']) : 'currencyFilter',
            'SHOW_ID' => $arParams['SHOW_ID'] ?? 'Y',
            'SHOW_CODE' => $arParams['SHOW_CODE'] ?? 'Y',
            'SHOW_DATE' => $arParams['SHOW_DATE'] ?? 'Y',
            'SHOW_COURSE' => $arParams['SHOW_COURSE'] ?? 'Y',
            'ELEMENTS_PER_PAGE' => isset($arParams['ELEMENTS_PER_PAGE']) ? intval($arParams['ELEMENTS_PER_PAGE']) : 20,
            'CACHE_TIME' => isset($arParams['CACHE_TIME']) ? intval($arParams['CACHE_TIME']) : 3600,
        ];

        // Заполняем массив активных колонок
        $this->activeColumns = [];
        if ($result['SHOW_ID'] === 'Y') {
            $this->activeColumns[] = 'ID';
        }
        if ($result['SHOW_CODE'] === 'Y') {
            $this->activeColumns[] = 'CODE';
        }
        if ($result['SHOW_DATE'] === 'Y') {
            $this->activeColumns[] = 'DATE';
        }
        if ($result['SHOW_COURSE'] === 'Y') {
            $this->activeColumns[] = 'COURSE';
        }

        // Если нет ни одной активной колонки, показываем все колонки
        if (empty($this->activeColumns)) {
            $this->activeColumns = ['ID', 'CODE', 'DATE', 'COURSE'];
        }

        return $result;
    }

    /**
     * Выполнение компонента
     */
    public function executeComponent()
    {
        if (!$this->checkModules()) {
            return;
        }

        // Подготавливаем фильтр
        $filter = $this->getFilter();

        // Подготавливаем навигацию
        $nav = $this->getNavigation();

        // Получаем список валют
        $currencies = $this->getCurrencies($filter, $nav);

        $this->arResult = [
            'ITEMS' => $currencies,
            'COLUMNS' => $this->activeColumns,
            'NAV' => $nav,
            'TOTAL_ITEMS' => $this->getTotalCount($filter),
            'HEADERS' => $this->getHeaders(),
        ];

        $this->includeComponentTemplate();
    }

    /**
     * Получает заголовки колонок
     * @return array
     */
    protected function getHeaders()
    {
        $headers = [
            'ID' => [
                'NAME' => Loc::getMessage('CURRENCYRATES_LIST_HEADER_ID'),
                'SORT' => 'ID',
            ],
            'CODE' => [
                'NAME' => Loc::getMessage('CURRENCYRATES_LIST_HEADER_CODE'),
                'SORT' => 'CODE',
            ],
            'DATE' => [
                'NAME' => Loc::getMessage('CURRENCYRATES_LIST_HEADER_DATE'),
                'SORT' => 'DATE',
            ],
            'COURSE' => [
                'NAME' => Loc::getMessage('CURRENCYRATES_LIST_HEADER_COURSE'),
                'SORT' => 'COURSE',
            ],
        ];

        return array_intersect_key($headers, array_flip($this->activeColumns));
    }

    /**
     * Получает фильтр для выборки
     * @return array
     */
    protected function getFilter()
    {
        global ${$this->arParams['FILTER_NAME']};
        
        $filter = [];
        if (is_array(${$this->arParams['FILTER_NAME']})) {
            $filter = ${$this->arParams['FILTER_NAME']};
        }

        return $filter;
    }

    /**
     * Получает объект навигации
     * @return PageNavigation
     */
    protected function getNavigation()
    {
        $nav = new PageNavigation('nav-currencies');
        $nav->allowAllRecords(true)
            ->setPageSize($this->arParams['ELEMENTS_PER_PAGE'])
            ->initFromUri();

        return $nav;
    }

    /**
     * Получает общее количество элементов
     * @param array $filter
     * @return int
     */
    protected function getTotalCount($filter)
    {
        return CurrencyTable::getCount($filter);
    }

    /**
     * Получает список валют
     * @param array $filter
     * @param PageNavigation $nav
     * @return array
     */
    protected function getCurrencies($filter, PageNavigation $nav)
    {
        $result = [];

        $select = $this->activeColumns;

        $rs = CurrencyTable::getList([
            'select' => $select,
            'filter' => $filter,
            'order' => ['ID' => 'DESC'],
            'limit' => $nav->getLimit(),
            'offset' => $nav->getOffset(),
            'count_total' => true,
        ]);

        $nav->setRecordCount($rs->getCount());

        while ($currency = $rs->fetch()) {
            $result[] = $currency;
        }

        return $result;
    }
} 