<?php

// app/Repositories/TaskRepository.php

namespace App\Repository;

use App\Models\Task;

    class TaskRepository
    {
        public function all($userId)
        {
            return Task::where('users_id', $userId)->orderBy('order')->get();
        }

        public function find($id, $userId)
        {
            return Task::where('id', $id)->where('users_id', $userId)->firstOrFail();
        }

        public function create(array $data)
        {
            // return dd($data);
            return Task::create($data);
        }

        public function update($id, array $data, $userId)
        {
            $task = Task::where('id', $id)->where('users_id', $userId)->firstOrFail();
            $task->update($data);
            return $task;
        }

        public function delete($id, $userId)
        {
            $task = Task::where('id', $id)->where('users_id', $userId)->firstOrFail();
            $task->delete();
            return $task;
        }
    }
