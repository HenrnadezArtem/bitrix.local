<?php
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Loader;
use Bitrix\Main\Application;

class bitrix_currencyrates extends CModule
{
    public $MODULE_ID = 'bitrix.currencyrates';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $PARTNER_NAME;
    public $PARTNER_URI;

    public function __construct()
    {
        $arModuleVersion = [];
        include __DIR__ . '/version.php';
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_NAME = 'Курсы валют';
        $this->MODULE_DESCRIPTION = 'Модуль для хранения и отображения курсов валют.';
        $this->PARTNER_NAME = 'Тестовый разработчик';
        $this->PARTNER_URI = 'https://example.com';
    }

    public function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->installDB();
        $this->installFiles();
    }

    public function DoUninstall()
    {
        $this->uninstallFiles();
        $this->uninstallDB();
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function installDB()
    {
        Loader::includeModule($this->MODULE_ID);
        \Bitrix\Currencyrates\CurrencyRateTable::getEntity()->createDbTable();
    }

    public function uninstallDB()
    {
        Loader::includeModule($this->MODULE_ID);
        $connection = Application::getConnection();
        $tableName = \Bitrix\Currencyrates\CurrencyRateTable::getTableName();
        if ($connection->isTableExists($tableName)) {
            $connection->dropTable($tableName);
        }
    }

    public function installFiles()
    {
        CopyDirFiles(
            __DIR__ . '/../components/bitrix/currencyrates.filter',
            $_SERVER['DOCUMENT_ROOT'] . '/local/components/bitrix/currencyrates.filter',
            true, true
        );
        CopyDirFiles(
            __DIR__ . '/../components/bitrix/currencyrates.list',
            $_SERVER['DOCUMENT_ROOT'] . '/local/components/bitrix/currencyrates.list',
            true, true
        );
    }

    public function uninstallFiles()
    {
        DeleteDirFilesEx('/local/components/bitrix/currencyrates.filter');
        DeleteDirFilesEx('/local/components/bitrix/currencyrates.list');
    }
}
// Заглушка для install-скрипта. Здесь будет логика установки и удаления модуля. 