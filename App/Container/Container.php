<?php

class Container
{
    private $services = [];

    public function addService($name, $service): void
    {
        $this->services[$name] = $service;
    }

    public function getService($name) {
        if (!array_key_exists($name, $this->services)) {
            throw new Exception("Service not found: " . $name);
        }
        return $this->services[$name];
    }

    /**
     * @throws ReflectionException
     */
    public function create($className) {
        $reflection = new ReflectionClass($className);
        $constructor = $reflection->getConstructor();
        if ($constructor === null) {
            return new $className();
        }
        $params = [];
        foreach ($constructor->getParameters() as $param) {
            $class = $param->getClass();
            if ($class !== null) {
                $params[] = $this->getService($class->name);
            } else {
                $params[] = $param->getDefaultValue();
            }
        }
        return $reflection->newInstanceArgs($params);
    }
}