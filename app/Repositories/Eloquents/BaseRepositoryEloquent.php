<?php

namespace App\Repositories\Eloquents;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Contracts\BaseContract;

abstract class BaseRepositoryEloquent implements BaseContract
{
    /** @var \Illuminate\Database\Eloquent\Model | \Illuminate\Database\Eloquent\QueryBuilder **/
    protected $model;

    /**
     * Limit for pagination
     */
    protected $limit = 10;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    /**
     * Function to get model. Must be implemented in child class.
     * E.g: return new Post;
     */
    abstract public function getModel(): Model;

    public function withRelationship()
    {
        return [];
    }

    public function with($relationship)
    {
        return $this->model->with(is_array($relationship) ? $relationship : [$relationship]);
    }

    public function datatables($conditions = [])
    {
        $query = $this->model->select("*")->filter($conditions);
        return $query;
    }

    /**
     * Execute the query as a "select" statement.
     *
     * @param  array|string  $columns
     * @return \Illuminate\Database\Eloquent\Collection[]
     */
    public function filter($conditions = [], $columns = ['*'], $query = null)
    {
        $query = $query ?? $this->model;
        if (!empty($conditions['order_by'])) {
            $query = $query->orderBy($conditions['order_by'], $conditions['order_direction'] ?? 'asc');
        }

        $query = $query->filter($conditions);

        if(isset($conditions['limit']) OR isset($conditions['page']) ){
            return $query->paginate($conditions['limit'] ?? $this->limit);
        }else{
            return $query->get();
        }

    }

    /**
     * Find a model by its primary key.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection[]|null
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model::find($id, $columns);
    }

    public function findOrFail($id, $columns = ['*'])
    {
        return $this->model::findOrFail($id);
    }

    public function findByCondition($conditions, $columns = ['*'])
    {
        return $this->model::filter($conditions)->first();
    }

    /**
     * Find a model by its primary key or return fresh model instance.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrNew($id, $columns = ['*'])
    {
        return $this->model::firstOrNew($id, $columns);
    }

    /**
     * Get the first record matching the attributes or create it.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrCreate(array $attributes, array $values = [])
    {
        return $this->model::firstOrCreate($attributes, $values);
    }

    /**
     * Save a new model and return the instance.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function createMultiple(array $data)
    {
        DB::beginTransaction();
        try {
            foreach ($data as $datum) {
                $this->model->create($datum);
            }
            DB::commit();

            return true;
        } catch (Exception $ex) {
            DB::rollback();

            return false;
        }

    }

    /**
     * Update a record in the database.
     *
     * @param \Illuminate\Database\Eloquent\Model|string|integer $model
     * @param array $values
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function update($model, array $data)
    {
        $db = $model instanceof Model ? $model : $this->find($model);
        if ($db) {
            foreach ($db->getFillable() as $field) {
                if (array_key_exists($field, $data)) {
                    $db->$field = $data[$field];
                }
            }
            $db->save();
            return $db;
        }

        return $db;
    }

    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->model::updateOrCreate($attributes, $values);
    }

    /**
     * Update records from the database by conditions.
     * @param array $conditions
     * @param array $update
     *
     * @return mixed
     */
    public function updateByConditions(array $conditions, array $update)
    {
        return $this->model->where($conditions)->update($update);
    }

    /**
     * Delete a record from the database by id.
     * @param string|int|Model $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $model = $id;
        if (!($id instanceof Model)) {
            $model = $this->find($id);
        }

        return $model->delete();
    }

    public function recovery($id)
    {
        $model = $id;
        if (!($id instanceof Model)) {
            $model = $this->withTrashed()->find($id);
        }

        if ($model !== null) {
            $model->restore();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete records from the database by conditions.
     * @param array $conditions
     *
     * @return mixed
     */
    public function deleteByConditions(array $conditions)
    {
        return $this->model->where($conditions)->delete();
    }

    /**
     * Get data from db by slug or id
     * @param int|string $term
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getBySlugId($term)
    {
        return $this->model
            ->where('id', $term)
            ->orWhere('slug', $term)
            ->with($this->withRelationship())
            ->first();
    }

    protected function whereLike($query, $fields, $value)
    {
        if (!$fields) {
            return $query;
        }
        if (is_string($fields)) {
            return $query->where($fields, 'like', "%$value%");
        }
        if (is_array($fields)) {
            $query = $query->where(function ($q) use ($fields, $value) {
                foreach ($fields as $field) {
                    $q->orWhere($field, 'like', "$$value%");
                }
            });

            return $query;
        }
    }
}
