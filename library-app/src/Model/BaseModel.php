<?php

namespace Model;
use Exception\ModelException;

class BaseModel{
    protected const TABLE = '';
    protected static array $defaults = [];
    protected static array $typeDefaults = [];
    protected array $properties = [];
    protected array $_old_values = [];
    public ?int $id = null;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? null;
        $names = $this->properties();

        foreach($names as $name) {
            $this->$name = $data[$name] ?? static::defaults($name);

            $this->_old_values[$name] = static::typeDefaults($name);

            if( isset($data['id']) && $data['id'] > 0 ) {
                $this->_old_values[$name] = $this->$name;
            }
        }
    }

    protected static function defaults($name) {
        if( empty(static::$defaults[static::class]) ) {
            $reflect = new \ReflectionClass(static::class);
            $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);

            $defaults = [];

            foreach($props as $prop) {
                if( $prop->isDefault() && $prop->hasDefaultValue() ) {
                    $defaults[$prop->name] = $prop->getDefaultValue();
                }
            }

            static::$defaults[static::class] = $defaults;
        }

        if( !array_key_exists($name, static::$defaults[static::class]) ) {
            throw new ModelException('EMPTY[' . $name . ']');
        }

        return static::$defaults[static::class][$name];
    }

    protected static function typeDefaults($name) {
        if( empty(static::$typeDefaults[static::class]) ) {
            $reflect = new \ReflectionClass(static::class);
            $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);

            $defaults = [];

            foreach($props as $prop) {
                if( $prop->isDefault() ) {
                    $defaults[$prop->name] = $prop->getDefaultValue();
                }
            }

            static::$typeDefaults[static::class] = $defaults;
        }

        return static::$typeDefaults[static::class][$name];
    }

    protected function properties() {
        if( !empty($this->properties) ) {
            return $this->properties;
        }

        $reflect = new \ReflectionClass($this);
        $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);

        $properties = [];

        foreach($props as $refl_prop) {
            $properties[] = $refl_prop->name;
        }

        $this->properties = $properties;

        return $properties;
    }

    public static function getTable() {
        return static::TABLE;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }
}