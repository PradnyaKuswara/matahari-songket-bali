<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Services\ArticleService;
use App\Services\ReturnRedirectService;
use Illuminate\Http\Request;
use Masmerise\Toaster\Toaster;

class ArticleController extends Controller
{
    protected $articleService;

    protected $returnRedirectService;

    public function __construct(ArticleService $articleService, ReturnRedirectService $returnRedirectService)
    {
        $this->articleService = $articleService;
        $this->returnRedirectService = $returnRedirectService;
    }

    public function index(Request $request)
    {
        return view('pages.admin-seller.articles.index', [
            'articles' => $this->articleService->search($request, new Article, ['name', 'title'], ['user']),
        ]);
    }

    public function create()
    {
        return view('pages.admin-seller.articles.create');
    }

    public function store(ArticleRequest $request)
    {
        $this->articleService->create($request);

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.articles.index'));
    }

    public function edit(Article $article)
    {
        return view('pages.admin-seller.articles.edit', [
            'article' => $this->articleService->find($article),
        ]);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $this->articleService->update($request, $article);

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.articles.index'));
    }

    public function toggleActive(Request $request, Article $article)
    {
        $this->articleService->toggleActive($article);

        Toaster::success('Article update successfully');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.articles.index'));
    }

    public function destroy(Request $request, Article $article)
    {
        $this->articleService->delete($article);

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.articles.index'));
    }

    public function search(Request $request)
    {
        return view('pages.admin-seller.articles.table', [
            'articles' => $this->articleService->search($request, new Article, ['name', 'title'], ['user']),
        ]);
    }
}
