<?php

namespace yii2mod\enum\tests;

use yii2mod\enum\tests\data\BooleanEnum;

/**
 * Class EnumTest
 * @package yii2mod\enum\tests
 */
class EnumTest extends TestCase
{
    public function testEnumMethods()
    {
        $this->assertEquals([1 => 'YES', 0 => 'NO'], BooleanEnum::getConstantsByValue());
        $this->assertEquals(['YES' => 1, 'NO' => 0], BooleanEnum::getConstantsByName());
        $this->assertEquals([1 => 'Yes', 0 => 'No'], BooleanEnum::listData());
        $this->assertEquals('Yes', BooleanEnum::getLabel(1));
        $this->assertEquals('1', BooleanEnum::getValueByName('Yes'));
    }

    public function testValidation()
    {
        $this->assertFalse(BooleanEnum::isValidName(1));
        $this->assertTrue(BooleanEnum::isValidName('YES'));
        $this->assertTrue(BooleanEnum::isValidValue(1));
        $this->assertFalse(BooleanEnum::isValidValue('YES'));
    }
}