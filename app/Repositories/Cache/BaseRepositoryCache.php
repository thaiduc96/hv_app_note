<?php

namespace App\Repositories\Cache;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class BaseRepositoryCache
{
    protected $repository;
    protected $cacheTimeout = 5; // seconds

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function __call($funcName, $arguments)
    {
        if (method_exists($this->repository, $funcName)) {
            return $this->repository->$funcName(...$arguments);
        }
        return false;
    }
}
