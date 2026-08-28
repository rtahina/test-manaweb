<?php

declare(strict_types=1);

namespace App\Actions\Task\DTO;

use App\Domain\Task\Task;

final class TaskData
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly bool $isCompleted,
        public readonly string $createdAt,
    ) {}

    public static function fromEntity(Task $task): self
    {
        return new self(
            id: $task->id(),
            title: $task->title(),
            isCompleted: (bool) $task->isCompleted(),
            createdAt: $task->createdAt()->format(DATE_ATOM)
        );
    }
}
