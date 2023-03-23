<?php
namespace App\Container;
use Exception;
use ReflectionClass;
use ReflectionException;

class Container
{
    private $services = [];

    public function addService($name, $service): void
    {
        $this->services[$name] = $service;
    }

    /**
     * @throws Exception
     */
    public function getService($name) {
        if (!array_key_exists($name, $this->services)) {
            throw new Exception("Service not found: " . $name);
        }
        return $this->services[$name];
    }

    /**
     * @throws ReflectionException
     * @throws ReflectionException
     */
    public function create($className, $args = []) {
        $reflection = new ReflectionClass($className);
        $constructor = $reflection->getConstructor();
        if ($constructor === null) {
            return new $className();
        }
        $params = [];
        foreach ($constructor->getParameters() as $param) {
            $type = $param->getType();
            if (isset($args[$param->name])) {
                $params[] = $args;
            } else if ($type !== null && !$type->isBuiltin()) {
                $params[] = $this->create($type->getName());
            } else if ($param->isDefaultValueAvailable()) {
                $params[] = $param->getDefaultValue();
            } else {
                $params[]=$args;
            }
        }
        return $reflection->newInstanceArgs($params);
    }
}