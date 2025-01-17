<?php

namespace App\Services;

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
}
