<?php
namespace App\Presentation\Controller\Task;

use App\UseCase\Interactor\Task\UpdateTaskUseCase;
use App\Presentation\Presenter\Task\UpdateTaskPresenter;
use App\UseCase\Input\Task\UpdateTaskInput;

class UpdateTaskController
{
    private UpdateTaskUseCase $updateTaskUseCase;
    private UpdateTaskPresenter $updateTaskPresenter;

    public function __construct(UpdateTaskUseCase $updateTaskUseCase, UpdateTaskPresenter $updateTaskPresenter)
    {
        $this->updateTaskUseCase = $updateTaskUseCase;
        $this->updateTaskPresenter = $updateTaskPresenter;
    }

    public function handle(array $requestData): void
    {
        // リクエストデータを元にUpdateTaskInputを作成
        $input = new UpdateTaskInput(
            $requestData['id'],
            $requestData['category_id'],
            $requestData['contents'],
            $requestData['deadline'],
            $requestData['user_id']
        );

        // UseCaseを実行し、結果を取得
        $output = $this->updateTaskUseCase->execute($input);

        // Presenterを使ってビューに渡すデータを準備
        $viewData = $this->updateTaskPresenter->view();

        // 更新が成功した場合はindex.phpにリダイレクトする
        if (empty($viewData['errors'])) {
            header('Location: ../index.php');
            exit();
        } else {
            // エラーがある場合はedit.phpに戻る
            $_SESSION['errors'] = $viewData['errors'];
            header('Location: edit.php?id=' . $requestData['id']);
            exit();
        }
    }
}
?>
