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

    public function filter($conditions = [], $columns = ['*'], $query = null)
    {
        $k = get_class($this) . '_' . 'filter' . '_';
        $k .= serialize($conditions) . '_' . serialize($columns) . '_';
        $k .= gettype($query);

        return Cache::get($k, function () use ($k, $conditions, $columns, $query) {
            $c = $this->repository->filter($conditions, $columns, $query);
            if ($c instanceof Builder) {
                return $c;
            }
            Cache::put($k, $c, $this->cacheTimeout);

            return $c;
        });
    }

    public function find($id, $columns = ['*'])
    {
        $k = get_class($this) . '_' . 'find' . '_';
        $k .= serialize($columns);

        return Cache::get($k, function () use ($k, $id, $columns) {
            $c = $this->repository->find($id, $columns);
            if ($c instanceof Builder) {
                return $c;
            }
            Cache::put($k, $c, $this->cacheTimeout);

            return $c;
        });
    }

    public function create(array $data)
    {
        $re = $this->repository->create($data);
        Cache::flush();

        return $re;
    }

    public function update($id, array $data)
    {
        $re = $this->repository->update($id, $data);
        Cache::flush();

        return $re;
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        $re = $this->repository->updateOrCreate($attributes, $values);
        Cache::flush();

        return $re;
    }

    public function delete($id)
    {
        $re = $this->repository->delete($id);
        Cache::flush();

        return $re;
    }

    public function __call($funcName, $arguments)
    {
        if (method_exists($this->repository, $funcName)) {
            return $this->repository->$funcName(...$arguments);
        }
        return false;
    }
}
