<?php

namespace App\Services;

use App\Http\Requests\ArticleRequest;
use App\Interfaces\ArticleInterface;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleService
{
    protected $articleInterface;

    public function __construct(ArticleInterface $articleInterface)
    {
        $this->articleInterface = $articleInterface;
    }

    public function all()
    {
        return $this->articleInterface->all();
    }

    public function create(ArticleRequest $request)
    {
        $data = $request->validated();

        $imagePath = $data['thumbnail']->store(Article::IMAGE_PATH);
        $data['thumbnail'] = $imagePath;
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = $data['title'];

        if ($request->action == 'publish') {
            $data['published_at'] = now();
            $data['is_active'] = true;
        } else {
            $data['is_active'] = false;
        }

        if (! $data['meta_desc']) {
            $pattern = '/<(h[1-6]|p)[^>]*>.*?<\/\1>/i';
            preg_match_all($pattern, $data['content'], $matches);

            $combinedString = implode(' ', $matches[0]);
            $data['meta_desc'] = Str::limit(strip_tags($combinedString), 300);
        }

        return $this->articleInterface->create($data);
    }

    public function update(ArticleRequest $request, $article)
    {
        $data = $request->validated();

        if ($request->title !== $article->title) {
            $data['slug'] = $data['title'];
        }

        if ($request->action == 'publish') {
            $data['is_active'] = true;
            $data['published_at'] = $article->published_at ?? now();
        } else {
            $data['is_active'] = false;
        }

        if ($request->hasFile('thumbnail')) {
            Storage::delete($article->thumbnail);
            $imagePath = $data['thumbnail']->store(Article::IMAGE_PATH);
            $data['thumbnail'] = $imagePath;
        } else {
            $data['thumbnail'] = $article->thumbnail;
        }

        if (! $data['meta_desc']) {
            $pattern = '/<(h[1-6]|p)[^>]*>.*?<\/\1>/i';
            preg_match_all($pattern, $data['content'], $matches);

            $combinedString = implode(' ', $matches[0]);
            $data['meta_desc'] = Str::limit(strip_tags($combinedString), 300);
        }

        return $this->articleInterface->update($data, $article);
    }

    public function toggleActive($article)
    {
        return $this->articleInterface->toggleActive($article);
    }

    public function delete($article)
    {
        return $this->articleInterface->delete($article);
    }

    public function find($article)
    {
        return $this->articleInterface->find($article);
    }

    public function search($request, $model, $conditions, $relations)
    {
        return $this->articleInterface->search($request, $model, $conditions, $relations);
    }
}
