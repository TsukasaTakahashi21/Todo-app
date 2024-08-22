<?php
namespace App\UseCase\Output\Task;

class CreateTaskOutput {
    private $success;
    private $errors;

    public function __construct($success, $errors = []) {
        $this->success = $success;
        $this->errors = $errors;
    }

    public function isSuccess() {
        return $this->success;
    }

    public function getErrors() {
        return $this->errors;
    }
}
