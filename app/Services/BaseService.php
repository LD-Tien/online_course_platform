<?php

namespace App\Services;

abstract class BaseService
{
    /**
     * @var mixed
     */
    protected $data;

    public function setParams($data = null)
    {
        $this->data = $data;
        return $this;
    }

    abstract function handle();
}
