<?php

namespace yii2mod\enum\tests;

use yii2mod\enum\tests\data\PostStatus;

/**
 * Class EnumTest
 *
 * @package yii2mod\enum\tests
 */
class EnumTest extends TestCase
{
    public function testEnumMethods()
    {
        $this->assertEquals(['PENDING', 'APPROVED', 'REJECTED', 'POSTPONED'], PostStatus::getConstantsByValue());
        $this->assertEquals(['PENDING' => 0, 'APPROVED' => 1, 'REJECTED' => 2, 'POSTPONED' => 3], PostStatus::getConstantsByName());
        $this->assertEquals(['Pending', 'Approved', 'Rejected', 'Postponed'], PostStatus::listData());
        $this->assertEquals('Pending', PostStatus::getLabel(PostStatus::PENDING));
        $this->assertEquals(1, PostStatus::getValueByName('Approved'));
    }

    public function testValidation()
    {
        $this->assertFalse(PostStatus::isValidName(1));
        $this->assertTrue(PostStatus::isValidName('APPROVED'));
        $this->assertTrue(PostStatus::isValidValue(1));
        $this->assertFalse(PostStatus::isValidValue('APPROVED'));
    }

    public function testCreateByName()
    {
        $enum = PostStatus::createByName('APPROVED');

        $this->assertEquals(PostStatus::APPROVED, $enum->getValue());
        $this->assertTrue(array_key_exists($enum->getName(), PostStatus::getConstantsByName()));
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testFailedCreateByName()
    {
        PostStatus::createByName('not existing name');
    }

    public function testCreateByValue()
    {
        $enum = PostStatus::createByValue(PostStatus::APPROVED);

        $this->assertEquals(PostStatus::APPROVED, $enum->getValue());
        $this->assertTrue(array_key_exists($enum->getName(), PostStatus::getConstantsByName()));
    }

    public function testCreateByStaticFunction()
    {
        $enum = PostStatus::APPROVED();

        $this->assertEquals(PostStatus::APPROVED, $enum->getValue());
        $this->assertTrue(array_key_exists($enum->getName(), PostStatus::getConstantsByName()));
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testFailedCreateByValue()
    {
        PostStatus::createByValue('not existing value');
    }
}
