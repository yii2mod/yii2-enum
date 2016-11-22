<?php

namespace yii2mod\enum\tests\data;

use yii2mod\enum\helpers\BaseEnum;

/**
 * Class BooleanEnum
 *
 * @package yii2mod\enum\tests\data
 */
class BooleanEnum extends BaseEnum
{
    const YES = 1;
    const NO = 0;

    /**
     * @var string message category
     * You can set your own message category for translate the values in the $list property
     * Values in the $list property will be automatically translated in the function `listData()`
     */
    public static $messageCategory = 'app';

    public static $list = [
        self::YES => 'Yes',
        self::NO => 'No',
    ];
}
