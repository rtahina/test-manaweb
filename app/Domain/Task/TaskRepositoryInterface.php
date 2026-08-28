<?php

declare(strict_types=1);

namespace App\Domain\Task;

interface TaskRepositoryInterface
{
    public function save(Task $task): void;

    public function findById(int $id): ?Task;

    /**
     * @return Task[]
     */
    public function all(): array;

    public function delete(int $id): void;
}
