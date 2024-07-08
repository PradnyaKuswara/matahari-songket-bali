<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Visitor;
use App\Services\ArticleService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Masmerise\Toaster\Toaster;

class WhatsNewController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(Request $request): View|JsonResponse
    {
        $articles = $this->articleService->all()->latest()->paginate(9);

        if ($request->ajax()) {
            $view = view('pages.whats-new-data', compact('articles'))->render();

            return response()->json(['html' => $view]);
        }

        return view('pages.whats-new', [
            'articles' => $articles,
            'articlesSwiper' => $this->articleService->all()->latest()->take(3)->get(),
        ]);
    }

    public function detail(Article $article): View|RedirectResponse
    {

        if (! $article->is_active) {
            Toaster::error('Article not found');

            return redirect()->route('whats-new.index');
        }

        visits(Visitor::TYPE_ARTICLE, $article)->increment();

        return view('pages.whats-new-detail', [
            'article' => $article,
            'meta_desc' => $article->meta_desc,
            'meta_keyword' => $article->meta_keyword,
            'articles' => $this->articleService->all()->where('slug', '!=', $article->slug)
                ->inRandomOrder()
                ->take(3)
                ->get(),
        ]);
    }
}
