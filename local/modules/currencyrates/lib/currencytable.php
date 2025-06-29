<?php
namespace Currencyrates;

use Bitrix\Main\Entity;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/**
 * Class CurrencyTable
 * ORM-сущность для таблицы курсов валют
 * 
 * @package Currencyrates
 */
class CurrencyTable extends Entity\DataManager
{
    /**
     * Возвращает имя таблицы в базе данных
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'currencyrates_currency';
    }

    /**
     * Возвращает карту сущности
     *
     * @return array
     */
    public static function getMap()
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('CURRENCYRATES_FIELD_ID'),
            ]),
            new Entity\StringField('CODE', [
                'required' => true,
                'title' => Loc::getMessage('CURRENCYRATES_FIELD_CODE'),
                'validation' => function() {
                    return [
                        new Entity\Validator\Length(null, 10),
                    ];
                }
            ]),
            new Entity\DatetimeField('DATE', [
                'required' => true,
                'title' => Loc::getMessage('CURRENCYRATES_FIELD_DATE'),
                'default_value' => function() {
                    return new DateTime();
                }
            ]),
            new Entity\FloatField('COURSE', [
                'required' => true,
                'title' => Loc::getMessage('CURRENCYRATES_FIELD_COURSE'),
            ]),
        ];
    }
} 