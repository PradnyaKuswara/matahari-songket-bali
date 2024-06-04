<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Visitor;
use App\Services\ArticleService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WhatsNewController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(Request $request): View | JsonResponse
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

    public function detail(Article $article): View
    {
        visits(Visitor::TYPE_ARTICLE, $article)->increment();

        return view('pages.whats-new-detail', [
            'article' => $article,
            'articles' => $this->articleService->all()->where('slug', '!=', $article->slug)
                ->inRandomOrder()
                ->take(3)
                ->get(),
        ]);
    }
}