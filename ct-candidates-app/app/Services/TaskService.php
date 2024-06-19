<?php

namespace App\Services;

use App\Repository\TaskRepository;

    class TaskService
    {
        protected $taskRepository;

        public function __construct(TaskRepository $taskRepository)
        {
            $this->taskRepository = $taskRepository;
        }

        public function getAllTasks($userId)
        {
            return $this->taskRepository->all($userId);
        }

        public function getTaskById($id, $userId)
        {
            return $this->taskRepository->find($id, $userId);
        }

        public function createTask(array $data)
        {
            return $this->taskRepository->create($data);
        }

        public function updateTask($id, array $data, $userId)
        {
            return $this->taskRepository->update($id, $data, $userId);
        }

        public function deleteTask($id, $userId)
        {
            return $this->taskRepository->delete($id, $userId);
        }
    }
