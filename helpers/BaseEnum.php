<?php
namespace yii2mod\enum\helpers;


use ReflectionClass;
use yii\web\BadRequestHttpException;

/**
 * Class BaseEnum
 * @author  Dmitry Semenov <disemx@gmail.com>
 * @see     https://github.com/php-mountain/Enum/
 * @package yii2mod\enum\helpers
 */
abstract class BaseEnum
{
    /**
     * The cached list of constants by name.
     *
     * @var array
     */
    private static $byName = array();

    /**
     * The cached list of constants by value.
     *
     * @var array
     */
    private static $byValue = array();

    /**
     * The value managed by this type instance.
     *
     * @var mixed
     */
    private $value;

    /**
     * @var array list of properties
     */
    private static $list;

    /**
     * Sets the value that will be managed by this type instance.
     *
     * @param mixed $value The value to be managed.
     *
     * @throws BadRequestHttpException If the value is not valid.
     */
    public function __construct($value)
    {
        if (!self::isValidValue($value)) {
            throw new BadRequestHttpException;
        }

        $this->value = $value;
    }

    /**
     * Creates a new type instance for a called name.
     *
     * @param string $name      The name of the value.
     * @param array  $arguments An ignored list of arguments.
     *
     * @return $this The new type instance.
     */
    public static function __callStatic($name, array $arguments = array())
    {
        return self::createByName($name);
    }

    /**
     * Creates a new type instance using the name of a value.
     *
     * @param string $name The name of a value.
     *
     * @throws \yii\web\BadRequestHttpException
     * @return $this The new type instance.
     *
     */
    public static function createByName($name)
    {
        $constants = self::getConstantsByName();

        if (!array_key_exists($name, $constants)) {
            throw new BadRequestHttpException;
        }

        return new static($constants[$name]);
    }

    /**
     * get constant key by value(label)
     * @param $value
     * @return mixed
     */
    public static function getValueByName($value){
        $list = self::listData();
        return array_search($value, $list);
    }
    /**
     * Creates a new type instance using the value.
     *
     * @param mixed $value The value.
     *
     * @throws \yii\web\BadRequestHttpException
     * @return $this The new type instance.
     *
     */
    public static function createByValue($value)
    {
        $constants = self::getConstantsByValue();

        if (!array_key_exists($value, $constants)) {
            throw new BadRequestHttpException;
        }

        return new static($value);
    }

    /**
     * @static
     * @return mixed
     */
    public static function listData()
    {
        $class = get_called_class();
        if (!isset(self::$list[$class])) {
            $reflection = new ReflectionClass($class);
            self::$list[$class] = $reflection->getStaticPropertyValue('list');
        }
        return self::$list[$class];
    }

    /**
     * @var string value
     * @return string label
     * @author Gladchenko Oleg
     */
    public static function getLabel($value)
    {
        $list = self::listData();
        if (isset($list[$value])) {
            return \Yii::t('enum', $list[$value]);
        }
        return false;
    }

    /**
     * Returns the list of constants (by name) for this type.
     *
     * @return array The list of constants by name.
     */
    public static function getConstantsByName()
    {
        $class = get_called_class();

        if (!isset(self::$byName[$class])) {
            $reflection = new ReflectionClass($class);
            self::$byName[$class] = $reflection->getConstants();
            while (false !== ($reflection = $reflection->getParentClass())) {
                if (__CLASS__ === $reflection->getName()) {
                    break;
                }

                self::$byName[$class] = array_replace(
                    $reflection->getConstants(),
                    self::$byName[$class]
                );
            }
        }

        return self::$byName[$class];
    }

    /**
     * Returns the list of constants (by value) for this type.
     *
     * @return array The list of constants by value.
     */
    public static function getConstantsByValue()
    {
        $class = get_called_class();

        if (!isset(self::$byValue[$class])) {
            self::getConstantsByName();

            self::$byValue[$class] = array();

            foreach (self::$byName[$class] as $name => $value) {
                if (array_key_exists($value, self::$byValue[$class])) {
                    if (!is_array(self::$byValue[$class][$value])) {
                        self::$byValue[$class][$value] = array(
                            self::$byValue[$class][$value]
                        );
                    }
                    self::$byValue[$class][$value][] = $name;;
                } else {
                    self::$byValue[$class][$value] = $name;
                }
            }
        }

        return self::$byValue[$class];
    }

    /**
     * Returns the name of the value.
     *
     * @return array|string The name, or names, of the value.
     */
    public function getName()
    {
        $constants = self::getConstantsByValue();

        return $constants[$this->value];
    }

    /**
     * Unwraps the type and returns the raw value.
     *
     * @return mixed The raw value managed by the type instance.
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Checks if a name is valid for this type.
     *
     * @param string $name The name of the value.
     *
     * @return boolean If the name is valid for this type, `true` is returned.
     *                 Otherwise, the name is not valid and `false` is returned.
     */
    public static function isValidName($name)
    {
        $constants = self::getConstantsByName();

        return array_key_exists($name, $constants);
    }

    /**
     * Checks if a value is valid for this type.
     *
     * @param string $value The value.
     *
     * @return boolean If the value is valid for this type, `true` is returned.
     *                 Otherwise, the value is not valid and `false` is returned.
     */
    public static function isValidValue($value)
    {
        $constants = self::getConstantsByValue();

        return array_key_exists($value, $constants);
    }
}