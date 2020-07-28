<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

abstract class Repository implements RepositoryInterface
{
    /**
     * @var App
     */
    private $app;

    /**
     * @var $model
     */
    protected $model;

    /**
     * Repository constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract protected function model();

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function allDesc($columns = ['*'])
    {
        return $this->model->orderBy('id', 'DESC')->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function updateOrCreate(array $uniqueData, array $data)
    {
        return $this->model->updateOrCreate($uniqueData, $data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->delete($id);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = ['*'])
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws \Exception
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * @param $attribute
     * @return mixed
     */
    public function whereIsNull($attribute)
    {
        return $this->model->whereNull($attribute)->get();
    }

    /**
     * @param $attribute
     * @return mixed
     */
    public function whereNotNull($attribute)
    {
        return $this->model->whereNotNull($attribute)->get();
    }

    /**
     * Find data by multiple values in one field
     *
     * @param       $field
     * @param array $values
     * @param array $columns
     *
     * @return mixed
     */
    public function whereIn($field, array $values, $columns = ['*'])
    {
        return $this->model->whereIn($field, $values)->get($columns);
    }

    /**
     * deleting records with where condition
     *
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function whereDelete($attribute, $value)
    {
        return $this->model->where($attribute, '=', $value)->delete();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * Build Query to catch resources by an array of attributes and params
     * @param  array $attributes
     * @param  null|string $orderBy
     * @param  string $sortOrder
     * @param  null|string $orderByRaw
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function buildQueryByAttributes(array $attributes, $orderBy = null, $sortOrder = 'asc', $orderByRaw = null)
    {
        $query = $this->model;
        foreach ($attributes as $field => $value) {
            $query = $query->where($field, $value);
        }

        if (null !== $orderBy) {
            $query->orderBy($orderBy, $sortOrder);
        }

        if (!empty($orderByRaw)) {
            $query->orderByRaw($orderByRaw);
        }

        return $query;
    }

    /**
     * Find a resource by an array of attributes
     * @param  array $attributes
     * @return $model
     */
    public function findByAttributes(array $attributes)
    {
        $query = $this->buildQueryByAttributes($attributes);

        return $query->first();
    }

    /**
     * Get resources by an array of attributes
     * @param  array $attributes
     * @param  null|string $orderBy
     * @param  string $sortOrder
     * @param  null|string $orderByRaw
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByAttributes(array $attributes, $orderBy = null, $sortOrder = 'asc', $orderByRaw = null)
    {
        $query = $this->buildQueryByAttributes($attributes, $orderBy, $sortOrder, $orderByRaw);

        return $query->get();
    }

    /**
     * delete multiple condition
     * @param array $attributes
     * @return mixed
     */
    public function destroy(array $attributes)
    {
        return $this->model->where($attributes)->delete();
    }

    /**
     * delete multiple condition
     * @param array $attributes
     * @return mixed
     */
    public function destroyAll(array $attributes)
    {
        return $this->model->whereIn('id', $attributes)->delete();
    }

    /**
     * Eager load database relationships
     * @param $relations
     * @return mixed
     */
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    /**
     * Limit data condition
     * @param $value
     * @return mixed
     */
    public function limit($value)
    {
        return $this->model->limit($value);
    }

    /**
     * Count data condition
     * @param $value
     * @return mixed
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * deleting records with where condition
     *
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function where($attribute, $value)
    {
        return $this->model->where($attribute, '=', $value);
    }
    
    public function whereNull($attribute)
    {
        return $this->model->where($attribute, '=', null);
    }

    public function latest($column = 'created_at')
    {
        return $this->model->orderBy($column, 'desc');
    } 

    public function whereNotIn($column, array $values)
    {
        return $this->model->whereNotIn($column, $values);
    } 
}