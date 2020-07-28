<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface {

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'));

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'));

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'));

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($field, $value, $columns = array('*'));

    /**
     * @return mixed
     */
    public function makeModel();

    /**
     * @param $attribute
     * @return mixed
     */
    public function whereIsNull($attribute);

    /**
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function whereDelete($attribute, $value);

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function findByAttributes(array $attributes);

    /**
     * @param array $attributes
     * @param $orderBy
     * @param $sortOrder
     * @return mixed
     */
    public function getByAttributes(array $attributes, $orderBy, $sortOrder);

    /**
     * @param $relations
     * @return mixed
     */
    public function with($relations);
}