Enumerable helper
========================================
### Example enumerable class
```php
use yii2mod\enum\helpers\BaseEnum;
class YesNoEnumerable extends BaseEnum
{
    const YES = 1;
    const NO = 2;

    public static $list = [
        self::YES => 'Yes',
        self::NO   => 'No'
    ];
}
```
### Example usage
```php
        var_dump(YesNoEnumerable::YES);
        var_dump(YesNoEnumerable::NO);
        var_dump(YesNoEnumerable::getConstantsByValue());
        var_dump(YesNoEnumerable::getConstantsByName());
        var_dump(YesNoEnumerable::isValidName(1)); // false
        var_dump(YesNoEnumerable::isValidName('YES'));
        var_dump(YesNoEnumerable::isValidValue(1));
        var_dump(YesNoEnumerable::isValidValue('YES')); //false
        var_dump(YesNoEnumerable::listData());
        var_dump(YesNoEnumerable::getLabel(1));
        var_dump(YesNoEnumerable::getLabel('YES')); // false
```