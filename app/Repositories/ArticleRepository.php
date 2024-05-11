<?php

namespace App\Repositories;

use App\Interfaces\ArticleInterface;
use App\Models\Article;
use App\Services\SearchService;

class ArticleRepository implements ArticleInterface
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function all()
    {
        return Article::where('is_active', true);
    }

    public function create(array $data)
    {
        return Article::create($data);
    }

    public function update(array $data, $article)
    {
        return $article->update($data);
    }

    public function toggleActive($article)
    {
        return $article->update(['is_active' => ! $article->is_active, 'published_at' => $article->published_at ?? now()]);
    }

    public function delete($article)
    {
        return $article->delete();
    }

    public function find($article)
    {
        return $article;
    }

    public function search($request, $model, $conditions, $relations)
    {
        return $this->searchService->handle($request, $model, $conditions, $relations)->paginate(10)->withQueryString()->withPath('articles');
    }
}
