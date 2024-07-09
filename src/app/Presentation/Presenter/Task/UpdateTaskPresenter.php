<?php
namespace App\Presentation\Presenter\Task;

use App\UseCase\Output\Task\UpdateTaskOutput;

class UpdateTaskPresenter
{
    private UpdateTaskOutput $output;

    public function __construct(UpdateTaskOutput $output)
    {
        $this->output = $output;
    }

    public function view(): array
    {
        return [
            'errors' => $this->output->getErrors()
        ];
    }
}
?>
