<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function insert(array $attributes);

    public function create(array $attributes);

    public function update(array $attributes, int|string $id);

    public function updateWhere(array $where, array $attributes);

    public function updateWhereIn(string $column, array $values, array $attributes): int;

    public function updateOrCreate(array $search, array $attributes);

    public function all(array $columns = ['*'], array $with = [], string $orderBy = 'id', string $sortBy = 'desc');

    public function allWhere(
        array $columns = ['*'],
        \Closure|string|array|\Illuminate\Database\Query\Expression $where = [],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'desc'
    );

    public function find(int $id, $with = []);

    public function findOneOrFail(int $id);

    public function firstOrCreate(array $data);

    public function findBy(array $data, array $with = [], string $orderBy = 'id', string $sortBy = 'asc');

    public function findOneBy(
        \Closure|string|array|\Illuminate\Database\Query\Expression $data,
        array $with = [],
        array $withCount = [],
        array $select = ['*']
    );

    public function findOneSoftDeletedRecordBy(array $data, array $with = [], array $withCount = []);

    public function hasOneEntry(string $lookingFor, string $lookingAt, string|int $value);

    public function recordExists(array $data);

    public function findLatestOneBy(array $data, array $with = [], string $checkBy = 'created_at');

    public function findOneByOrFail(array $data);

    public function paginateArrayResults(array $data, int $perPage = 50);

    public function delete(int|string $id): bool;

    public function deleteWhereIn(string $column, array $data): bool;

    public function whereIn(
        string $column,
        array $data,
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc',
        array $select = ['*']
    );

    public function findWhereLike(string $attribute, string|int $value, string|int $limit = 10);

    public function findWhereLikeAndWhere(
        string $attribute,
        string|int $value,
        array $columns = ['*'],
        array $where = [],
        string|int $limit = 10);

    public function newModelInstance();
}
