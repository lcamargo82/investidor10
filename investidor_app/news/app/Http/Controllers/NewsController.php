<?php

namespace App\Http\Controllers;

use App\Models\News;
use app\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 9);

            $options = $this->newsService->getFormOptions();
            $news = $this->newsService->getAllNews($perPage);

            return view('news.index', [
                'news' => $news,
                'authors' => $options['authors'],
                'categories' => $options['categories']
            ]);
        } catch (\Exception $exception) {
            return view('news.index', ['error' => $exception->getMessage(), 'news' => collect()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'author_id' => 'required|exists:authors,id',
                'category_id' => 'required|exists:categories,id',
            ]);

            $this->newsService->createNews($validated);

            return redirect()->route('news.index')->with('success', 'Notícia criada com sucesso!');
        } catch (\Exception $exception) {
            return redirect()->route('news.index')->with('error', 'Erro ao criar notícia: ' . $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $new = $this->newsService->getNewById($id);
            return view('news.show', compact('new'));
        } catch (\Exception $exception) {
            return view('news.index', ['error' => $exception->getMessage(), 'news' => collect()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        //
    }

    public function search(Request $request)
    {
        try {
            $query = $request->input('q', '');

            $news = $query
                ? $this->newsService->getNewsBySearch($query)->paginate(9)
                : News::paginate(9);

            return view('news.index', compact('news'));
        } catch (\Exception $exception) {
            return view('news.index', ['error' => $exception->getMessage(), 'news' => collect()]);
        }
    }
}
