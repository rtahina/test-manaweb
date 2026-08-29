<?php

declare(strict_types=1);

namespace App\Domain\Task;

use App\Infrastructure\Task\Persistence\TaskModel;

interface TaskRepositoryInterface
{
    public function save(Task $task): TaskModel;

    public function findById(int $id): ?Task;

    /**
     * @return Task[]
     */
    public function all(): array;

    public function delete(int $id): int;
}
