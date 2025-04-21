<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes): mixed
    {
        return $this->model->create($attributes);
    }

    /**
     * @return mixed
     */
    public function update(array $attributes, int|string $id): object
    {
        return tap($this->model->find($id))->update($attributes);
    }

    public function updateWhere(array $where, array $attributes): int
    {
        return $this->model->where($where)->update($attributes);
    }

    public function updateWhereIn(string $column, array $values, array $attributes): int
    {
        return $this->model->whereIn($column, $values)->update($attributes);
    }

    public function updateOrCreate(array $search, array $attributes): mixed
    {
        return $this->model->updateOrCreate($search, $attributes);
    }

    public function all(array $columns = ['*'], array $with = [], string $orderBy = 'id', string $sortBy = 'asc'): mixed
    {
        return $this->model->with($with)->orderBy($orderBy, $sortBy)->get($columns);
    }

    public function allWhere(
        array $columns = ['*'],
        \Closure|string|array|\Illuminate\Database\Query\Expression $where = [],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): mixed {
        return $this->model->query()->select($columns)->where($where)->with($with)->orderBy($orderBy, $sortBy)->get();
    }

    /**
     * @param  array  $with
     */
    public function find(int|string $id, $with = []): mixed
    {
        return $this->model->with($with)->find($id);
    }

    /**
     * @throws ModelNotFoundException
     */
    public function findOneOrFail(int|string $id): mixed
    {
        return $this->model->findOrFail($id);
    }

    public function findBy(array $data, array $with = [], string $orderBy = 'id', string $sortBy = 'asc'): mixed
    {
        return $this->model->where($data)->with($with)->orderBy($orderBy, $sortBy)->get();
    }

    public function findOneBy(
        \Closure|string|array|\Illuminate\Database\Query\Expression $data,
        array $with = [],
        array $withCount = [],
        array $select = ['*']
    ): mixed {
        return $this->model->query()->select($select)->where($data)->with($with)->withCount($withCount)->first();
    }

    public function findOneSoftDeletedRecordBy(array $data, array $with = [], array $withCount = []): mixed
    {
        return $this->model->withTrashed()->where($data)->with($with)->withCount($withCount)->first();
    }

    public function hasOneEntry(string $lookingFor, string $lookingAt, string|int $value): int
    {
        return $this->model->select($lookingFor)->where($lookingAt, $value)->count() > 0 ? 1 : 0;
    }

    /**
     * @throws ModelNotFoundException
     */
    public function findOneByOrFail(array $data): mixed
    {
        return $this->model->where($data)->firstOrFail();
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function paginateArrayResults(array $data, int $perPage = 50): LengthAwarePaginator
    {
        $page = request()->get('page', 1);
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(
            array_slice($data, $offset, $perPage, false),
            count($data),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    public function delete(int|string $id): bool
    {

        $entry = $this->model->query()->find($id);

        if (filled($entry)) {
            return $entry->delete();
        }

        return true;
    }

    public function deleteWhere(array $data): bool
    {
        return $this->model->where($data)->delete();
    }

    public function deleteWhereIn(string $column, array $data): bool
    {
        return $this->model->whereIn($column, $data)->delete();
    }

    /**
     * @param  string[]  $select
     */
    public function whereIn(string $column, array $data, array $with = [], string $orderBy = 'id', string $sortBy = 'asc',
                                   $select = ['*']
    ): mixed {
        return $this->model->query()->select($select)->whereIn($column, $data)->with($with)->orderBy($orderBy, $sortBy)->get();
    }

    public function firstOrCreate(array $data): mixed
    {
        return $this->model->firstOrCreate($data);
    }

    /**
     * @return Collection<Model>
     */
    public function findWhereLike(string $attribute, int|string $value, int|string $limit = 10): Collection
    {
        $collection = $this->model->query();

        if (! blank($value)) {
            $collection->where($attribute, 'LIKE', "%{$value}%");
        }

        // bring back all results
        if ($limit != 0) {
            $collection->limit($limit);
        }

        return $collection->orderBy($attribute)->get();
    }

    public function findWhereLikeAndWhere(
        string $attribute,
        int|string $value,
        array $columns = ['*'],
        array $where = [],
        int|string $limit = 10
    ): Collection|array {
        $collection = $this->model->query()->select($columns);

        if (! blank($value)) {
            $collection->where($attribute, 'LIKE', "%{$value}%");
        }

        // bring back all results
        if ($limit != 0) {
            $collection->limit($limit);
        }

        if (! blank($where)) {
            $collection->where($where);
        }

        return $collection->orderBy($attribute)->get();
    }

    public function findLatestOneBy(array $data, array $with = [], string $checkBy = 'created_at'): mixed
    {
        return $this->model->where($data)->with($with)->latest($checkBy)->first();
    }

    public function insert(array $attributes): mixed
    {
        return $this->model->query()->insert($attributes);
    }

    public function recordExists(array $data): bool
    {
        return $this->model->query()->where($data)->exists();
    }

    public function newModelInstance(): mixed
    {
        return new $this->model;
    }
}
