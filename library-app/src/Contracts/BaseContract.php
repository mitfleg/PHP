<?php

namespace Contracts;

use ReflectionClass;
use ReflectionProperty;
use Exception\ContractException;

abstract class BaseContract
{
    public function validate(array $data): self
    {
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($properties as $property) {
            $name = $property->getName();
            $type = $property->getType();
            $typeName = $type ? $type->getName() : null;
            $is_optional = $type ? $type->allowsNull() : false;

            if (!$is_optional && !array_key_exists($name, $data)) {
                throw new ContractException("Отсутствует обязательное поле: $name", 400);
            }

            if (array_key_exists($name, $data)) {
                if ($type && gettype($data[$name]) !== $typeName && gettype($data[$name]) !== 'integer') {
                    throw new ContractException("Неверный тип данных для поля: $name", 400);
                }
                $this->$name = $data[$name];
            } else {
                $this->$name = null;
            }
        }

        return $this;
    }

    public function toArray(): array
    {
        $array = [];
        foreach (get_object_vars($this) as $name => $value) {
            $array[$name] = $value;
        }
        return $array;
    }
}
