Enumerable helper
========================================
An enumeration implementation for Yii Framework 2.0

[![Latest Stable Version](https://poser.pugx.org/yii2mod/yii2-enum/v/stable)](https://packagist.org/packages/yii2mod/yii2-enum) [![Total Downloads](https://poser.pugx.org/yii2mod/yii2-enum/downloads)](https://packagist.org/packages/yii2mod/yii2-enum) [![License](https://poser.pugx.org/yii2mod/yii2-enum/license)](https://packagist.org/packages/yii2mod/yii2-enum)
[![Build Status](https://travis-ci.org/yii2mod/yii2-enum.svg?branch=master)](https://travis-ci.org/yii2mod/yii2-enum)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yii2mod/yii2-enum "*"
```

or add

```
"yii2mod/yii2-enum": "*"
```

to the require section of your `composer.json` file.

## Available Methods:

- `createByName()` - Creates a new type instance using the name of a value.
- `getValueByName()` - Returns the constant key by value(label)
- `createByValue()` - Creates a new type instance using the value.
- `listData()` - Returns the associative array with constants values and labels
- `getLabel()`- Returns the constant label by key
- `getConstantsByName()` - Returns the list of constants (by name) for this type.
- `getConstantsByValue()` - Returns the list of constants (by value) for this type.
- `isValidName()` - Checks if a name is valid for this type.
- `isValidValue()` - Checks if a value is valid for this type.

## Declaration

```php
use yii2mod\enum\helpers\BaseEnum;

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
        self::NO => 'No'
    ];
}
```
## Usage
```php
BooleanEnum::getConstantsByValue() // [1 => 'YES', 0 => 'NO']
BooleanEnum::getConstantsByName() // ['YES' => 1, 'NO' => 0]
BooleanEnum::isValidName(1) // false
BooleanEnum::isValidName('YES') // true
BooleanEnum::isValidValue(1) // true
BooleanEnum::isValidValue('Yes') // false
BooleanEnum::listData() // [1 => 'Yes', 0 => 'No']
BooleanEnum::getLabel(1) // Yes
BooleanEnum::getValueByName('Yes') // 1
```
