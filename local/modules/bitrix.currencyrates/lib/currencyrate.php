<?php
namespace Bitrix\Currencyrates;

use Bitrix\Main\Entity;

class CurrencyRateTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'b_currency_rates';
    }

    public static function getMap()
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new Entity\StringField('CODE', [
                'required' => true,
                'size' => 10,
                'title' => 'Код валюты',
            ]),
            new Entity\DatetimeField('DATE', [
                'required' => true,
                'title' => 'Дата курса',
            ]),
            new Entity\FloatField('COURSE', [
                'required' => true,
                'title' => 'Курс',
            ]),
        ];
    }
} 