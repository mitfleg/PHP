<?php

namespace Repository;

use Helper\DatabaseConnection;
use Model\BaseModel;
use ReflectionObject;
use PDO;

class BaseRepository
{
    protected $db;
    private string $class_name;

    public function __construct()
    {
        $db = new DatabaseConnection(DB_PATH);
        $this->db = $db->connect();
    }

    public function initClass(string $class_name): void
    {
        if (!is_subclass_of($class_name, BaseModel::class)) {
            throw new \InvalidArgumentException("Класс должен быть наследником BaseModel");
        }
        $this->class_name = $class_name;
    }

    public function getById(int $id): BaseModel
    {
        $table_name = $this->class_name::TABLE; 
        $stmt = $this->db->prepare("SELECT * FROM {$table_name} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();

        if (!$result) {
            throw new \RuntimeException("Запись не найдена");
        }
        
        $class = new $this->class_name($result);
        return $class;
    }

    public function persist(BaseModel $object): BaseModel
    {
        $table_name = $object::getTable();
        $ref_object = new ReflectionObject($object);
        $properties = $ref_object->getProperties();
        $data = [];

        foreach ($properties as $property) {
            if ($property->isPublic() && $property->class == get_class($object)) {
                $property->setAccessible(true);
                $value = $property->getValue($object);

                if (is_bool($value)) {
                    $data[$property->getName()] = $value ? 1 : 0;
                } elseif (!is_array($value) && !is_object($value)) {
                    $data[$property->getName()] = $value;
                }
            }
        }

        unset($data['id']);

        if ($object->id) {
            $set_part = implode(', ', array_map(fn ($k) => "`$k` = :$k", array_keys($data)));
            $sql = "UPDATE `$table_name` SET $set_part WHERE `id` = :id;";
            $stmt = $this->db->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->bindValue(':id', $object->id);
        } else {
            $columns = implode(', ', array_map(fn ($k) => "`$k`", array_keys($data)));
            $values = implode(', ', array_map(fn ($k) => ":$k", array_keys($data)));
            $sql = "INSERT INTO `$table_name` ($columns) VALUES ($values);";
            $stmt = $this->db->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
        }

        $stmt->execute();

        if (!$object->id) {
            $object->setId($this->db->lastInsertId());
        }

        return $object;
    }
}
