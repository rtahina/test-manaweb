<?php

declare(strict_types=1);

namespace App\Actions\Task;

use App\Actions\Task\DTO\TaskData;
use App\Domain\Task\Task;
use App\Domain\Task\TaskRepositoryInterface;
use App\Infrastructure\Task\Persistence\TaskMapper;

final class CreateTask
{
    public function __construct(private readonly TaskRepositoryInterface $repository) {}

    public function handle(string $title): TaskData
    {
        $task = Task::create($title);
        $taskModel = $this->repository->save($task);
        $taskDomain = (new TaskMapper)->toDomain($taskModel);

        return TaskData::fromEntity($taskDomain);
    }
}
