<?php

namespace App\Contracts;

class BuilderContract
{
    protected $query;

    protected $filters;

    protected $namespace;

    public function __construct($query, $filters, $namespace)
    {
        $this->query = $query;
        $this->filters = $filters;
        $this->namespace = $namespace;
    }

    public function apply()
    {
        foreach ($this->filters as $name => $value) {
            $className = ucfirst($name);
            $class = $this->namespace."\\{$className}";
            if (!class_exists($class)) {
                continue;
            }
            if (is_array($value)) {
                (new $class($this->query))->handle($value);
                continue;
            }
            if (strlen($value)) {
                (new $class($this->query))->handle($value);
            }
        }

        return $this->query;
    }
}
