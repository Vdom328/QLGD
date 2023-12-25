<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IBaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 *
 */
abstract class BaseRepository implements IBaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * AbstractRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritdoc
     */
    public function find(array $conditions = [])
    {
        return $this->model->where($conditions)->get();
    }

    /**
     * @inheritdoc
     */
    public function paginate(int $pageSize, array $conditions = [], array $relation = [])
    {
        return $this->model->with($relation)->where($conditions)->paginate($pageSize);
    }

    /**
     * @inheritdoc
     */
    public function findOne(array $conditions)
    {
        return $this->model->where($conditions)->first();
    }

    /**
     * @inheritdoc
     */
    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @inheritdoc
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @inheritdoc
     */
    public function update(Model $model, array $attributes = [])
    {
        return $model->update($attributes);
    }

    /**
     * @inheritdoc
     */
    public function save(Model $model)
    {
        return $model->save();
    }

    /**
     * @inheritdoc
     */
    public function delete(Model $model)
    {
        return $model->delete();
    }

    /**
     * @inheritdoc
     */
    public function insert($attributes)
    {
        return $this->model->insert($attributes);
    }

    /**
     * @inheritdoc
     */
    public function updateById($id, $attributes)
    {
        return $this->model->where($this->model->getKeyName(), $id)->update($attributes);

    }

    public function deleteById($id)
    {
        return $this->model->destroy($id);
    }
}
