<?php

namespace App\Repositories\Contracts;

interface BaseContract
{
    public function getModel();

    public function filter($condition = []);

    public function find($id);

    public function findOrFail($id, $with = []);

    public function findByCondition($condition, $with = []);

    public function findOrNew($id, $columns = ['*']);

    public function firstOrCreate(array $attributes, array $values = []);

    public function create(array $data);

    public function update($id, array $data);

    public function updateOrCreate(array $attributes, array $values = []);

    public function delete($model);

    public function deleteByConditions(array $conditions);
}
