<?php

namespace app\Services;

use App\Models\Category;
use Exception;

class CategoryService
{
    public function getAllCategories($perPage = 5)
    {
        return Category::paginate($perPage);
    }

    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }

    public function updateCategory($id, $data)
    {
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        if ($category->news()->count() > 0) {
            throw new Exception('Não é possível deletar a categoria porque ela está vinculada a uma ou mais notícias.');
        }

        $category->delete();
    }

    public function createCategory(array $data)
    {
        return Category::create([
            'name' => $data['name']
        ]);
    }

    public function getCategoriesBySearch(string $query)
    {
        return Category::where('name', 'like', "%{$query}%");
    }
}
