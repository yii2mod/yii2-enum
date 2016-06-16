<?php

namespace yii2mod\enum\helpers;

/**
 * Class BooleanEnum
 * @package yii2mod\enum\helpers
 */
class BooleanEnum extends BaseEnum
{
    const YES = 1;
    const NO = 0;

    public static $list = [
        self::YES => 'Yes',
        self::NO => 'No'
    ];
}
