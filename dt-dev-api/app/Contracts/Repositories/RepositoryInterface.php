<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\RepositoryInterface as L5RepositoryInterface;

interface RepositoryInterface extends L5RepositoryInterface
{
    public function getFillableFields(): array;

    public function save(Model $model, array $options = []): bool;

    public function upsert(array $values, array $uniqueBy, $update = null): int;

    public function deleteWhereIn(string $field, array $values): int;

    public function exists(array $where = []): bool;

    public function updateWhereIn(string $field, array $values, array $data): int;
}
