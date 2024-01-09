<?php
namespace Router;

interface RouterInterface {
    public function addRoute($method, $path, $callback);
    public function dispatch();
}