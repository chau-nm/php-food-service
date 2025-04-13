<?php

namespace app\model\serializable;

abstract class AbstractSerializable implements \JsonSerializable
{
    public function jsonSerialize(): array
    {
        $ref = new \ReflectionClass($this);
        $props = $ref->getProperties();
        $data = [];

        foreach ($props as $prop) {
            $prop->setAccessible(true);
            $data[$prop->getName()] = $prop->getValue($this);
        }

        return $data;
    }
}