<?php

namespace app\Services;

use App\Models\Author;
use App\Models\Category;
use App\Models\News;

class NewsService
{
    public function getAllNews($perPage = 9)
    {
        return News::with(['author', 'category'])
            ->select('id', 'title', 'content', 'author_id', 'category_id', 'created_at')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getNewById($id)
    {
        return News::findOrFail($id);
    }

    public function getAllListNews($perPage = 10)
    {
        return News::paginate($perPage);
    }

    public function getFormOptions()
    {
        $authors = Author::all();
        $categories = Category::all();

        return [
            'authors' => $authors,
            'categories' => $categories
        ];
    }

    public function createNews(array $data)
    {
        $news = News::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'author_id' => $data['author_id'],
            'category_id' => $data['category_id'],
        ]);

        return $news;
    }

    public function updateNews($id, array $data)
    {
        $news = News::findOrFail($id);
        $news->update($data);
        return $news;
    }

    public function deleteNews($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
    }

    public function getNewsBySearch(string $query)
    {
        return News::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('title', 'like', "%{$query}%")
                ->orWhereHas('category', function ($queryBuilder) use ($query) {
                    $queryBuilder->where('name', 'like', "%{$query}%");
                });
        });
    }
}
