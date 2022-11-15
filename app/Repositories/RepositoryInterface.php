<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface RepositoryInterface
{
    public function create(array $attributes);

    public function findOne(int $id);

    public function findMany(array $ids): Collection;

    public function update($id, array $attributes);

    public function count();
}
