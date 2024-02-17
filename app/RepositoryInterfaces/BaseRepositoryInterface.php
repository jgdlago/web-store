<?php

namespace App\RepositoryInterfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function getAllModel(): Collection;
    public function getModelById(int|Model $modelId): Model;
    public function createModel(array $modelDetails): Model;
    public function updateModel(array $modelDetails, Model|int $modelId): Model;
    public function deleteModel(Model|int $modelOrId): ?bool;
}
