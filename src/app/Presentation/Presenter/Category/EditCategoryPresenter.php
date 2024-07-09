<?php
namespace App\Presentation\Presenter\Category;

use App\Domain\Entity\Category;
use App\UseCase\Output\Category\EditCategoryOutput;

class EditCategoryPresenter
{
    public function present(Category $category = null): array
    {
        $data = [];

        if ($category) {
            $data['category'] = [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'user_id' => $category->getUserId(),
            ];
        }

        return $data;
    }
}
