<?php

namespace myfrm;

class ServiceContainer
{
    public array $services = [];

    public function setService(string $service, callable $function): void
    {
        $this->services[$service] = $function;
    }

    public function getService(string $service)
    {
        if (!isset($this->services[$service])) {
            throw new  \Exception('Service not found: ' . $service);
        }
        return call_user_func($this->services[$service]);
    }
}