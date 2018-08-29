<?php

namespace App\Controllers;

use App\Models\Task;

class TaskController extends JsonController
{
    private $task;

    /**
     * Construct function.
     */
    public function __construct()
    {
        parent::__construct();
        $this->task = new Task;
    }

    /**
     * Index function. List all records
     *
     * @return json
     */
    public function index()
    {
        echo json_encode($this->task->all());
    }


    /**
     * Show a task
     *
     * @param int $id Task ID
     *
     * @return json
     */
    public function show($id)
    {
        echo json_encode($this->task->find($id));
    }

    /**
     * Create a task
     *
     * @return json
     */
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            return $this->failedResponse("Incorrect method!");
        }
        $task = $this->task->create($_POST);

        if (!$task) {
            return $this->failedResponse("Cannot create!");
        }
        return $this->successResponse("Created new task!");
    }

    /**
     * Update a task
     *
     * @return json
     */
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            return $this->failedResponse("Incorrect method!");
        }

        $task = $this->task->update($_POST);

        if (!$task) {
            return $this->failedResponse("Cannot update!");
        }
        return $this->successResponse("Updated task!");
    }

    /**
     * Delete a task
     *
     * @param int $id Task ID
     *
     * @return json
     */
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] != "DELETE") {
            return $this->failedResponse("Incorrect method!");
        }

        $task = $this->task->delete($id);

        if (!$task) {
            return $this->failedResponse("Cannot delete!");
        }
        return $this->successResponse("Deleted task!");
    }
}
