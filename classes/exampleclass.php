<?php

class ExampleClass extends ObjectModel
{
    public $id_examplemodule_setting;
    public $name;
    public $date_add;
    public $date_upd;

    public static $definition = [
        'table' => 'exampleclass',
        'primary' => 'id_exampleclass',
        'fields' => [
            'name' => ['type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255],
            'date_add' => ['type' => self::TYPE_DATE, 'validate' => 'isDateFormat'],
            'date_upd' => ['type' => self::TYPE_DATE, 'validate' => 'isDateFormat'],
        ],
    ];
}
