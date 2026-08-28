<?php

declare(strict_types=1);

namespace App\Actions\Task;

use App\Actions\Task\DTO\TaskData;
use App\Domain\Task\TaskRepositoryInterface;

final class ToggleTaskStatus
{
    public function __construct(private readonly TaskRepositoryInterface $repository) {}

    public function handle(int $id): TaskData
    {
        $task = $this->repository->findById($id);
        $toggledTask = $task::toggleStatus($task);
        $this->repository->save($toggledTask);
        
        return TaskData::fromEntity($toggledTask);
    }
}
