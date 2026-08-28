<?php

declare(strict_types=1);

namespace App\Domain\Task;

use Illuminate\Database\Eloquent\Model;

interface TaskRepositoryInterface
{
    public function save(Task $task): Model;

    public function findById(int $id): ?Task;

    /**
     * @return Task[]
     */
    public function all(): array;

    public function delete(int $id): void;
}
