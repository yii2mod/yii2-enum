<?php
namespace yii2mod\enum\helpers;



/**
 * @author  Kravchuk Dmitry
 * @package yii2mod\cms\models\enumerables
 */
class BooleanEnum extends BaseEnum
{
    const YES = 1;
    const NO = 0;

    public static $list = [
        self::NO => 'No',
        self::YES => 'Yes'
    ];
}