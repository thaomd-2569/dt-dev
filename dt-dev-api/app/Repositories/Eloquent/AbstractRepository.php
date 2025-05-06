<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Eloquent\BaseRepository as L5EloquentRepository;

abstract class AbstractRepository extends L5EloquentRepository implements RepositoryInterface
{
    public function getFillableFields(): array
    {
        return $this->model->getFillable();
    }

    public function save(Model $model, array $options = []): bool
    {
        return $model->save($options);
    }

    public function upsert(array $values, array $uniqueBy, $update = null): int
    {
        return $this->model->newQuery()->upsert($values, $uniqueBy, $update);
    }

    public function deleteWhereIn(string $field, array $values): int
    {
        return $this->model->newQuery()->whereIn($field, $values)->delete();
    }

    public function exists(array $where = []): bool
    {
        $query = $this->model->newQuery();

        if (! empty($where)) {
            $query = $query->where($where);
        }

        return $query->exists();
    }

    public function updateWhereIn(string $field, array $values, array $data): int
    {
        return $this->model->whereIn($field, $values)->update($data);
    }
}
