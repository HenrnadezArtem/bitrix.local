<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\ModuleManager;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Entity\Base;

Loc::loadMessages(__FILE__);

/**
 * Class currencyrates
 * Установщик модуля
 */
class currencyrates extends CModule
{
    public $MODULE_ID = 'currencyrates';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $MODULE_GROUP_RIGHTS;
    public $PARTNER_NAME;
    public $PARTNER_URI;

    protected $eventManager;

    /**
     * currencyrates constructor.
     */
    public function __construct()
    {
        $arModuleVersion = [];
        include(__DIR__ . '/../.description.php');

        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];

        $this->MODULE_NAME = $arModuleInfo['NAME'];
        $this->MODULE_DESCRIPTION = $arModuleInfo['DESCRIPTION'];
        $this->PARTNER_NAME = $arModuleInfo['PARTNER_NAME'];
        $this->PARTNER_URI = $arModuleInfo['PARTNER_URI'];

        $this->MODULE_GROUP_RIGHTS = 'N';
    }

    /**
     * Устанавливает модуль
     */
    public function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->InstallFiles();
        $this->InstallDB();
        
        return true;
    }

    /**
     * Удаляет модуль
     */
    public function DoUninstall()
    {
        $this->UnInstallFiles();
        $this->UnInstallDB();
        ModuleManager::unRegisterModule($this->MODULE_ID);
        
        return true;
    }

    /**
     * Устанавливает базу данных модуля
     */
    public function InstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            try {
                $connection = Application::getConnection();
                $entity = Base::getInstance('Currencyrates\CurrencyTable');
                $entity->createDbTable();
            } catch (\Exception $e) {
                // ошибка создания таблицы
            }
        }
        
        return true;
    }

    /**
     * Удаляет базу данных модуля
     */
    public function UnInstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            try {
                $connection = Application::getConnection();
                $connection->dropTable('currencyrates_currency');
            } catch (\Exception $e) {
                // ошибка удаления таблицы
            }
        }
        
        return true;
    }

    /**
     * Копирует файлы модуля
     */
    public function InstallFiles()
    {
        // Копируем компонент фильтра
        CopyDirFiles(
            __DIR__ . '/components/bitrix/currencyrates.filter',
            $_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/bitrix/currencyrates.filter',
            true, true
        );
        
        // Копируем компонент списка
        CopyDirFiles(
            __DIR__ . '/components/bitrix/currencyrates.list',
            $_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/bitrix/currencyrates.list',
            true, true
        );
        
        return true;
    }

    /**
     * Удаляет файлы модуля
     */
    public function UnInstallFiles()
    {
        // Удаляем компоненты
        DeleteDirFilesEx('/bitrix/components/bitrix/currencyrates.filter');
        DeleteDirFilesEx('/bitrix/components/bitrix/currencyrates.list');
        
        return true;
    }
} 