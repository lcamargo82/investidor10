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

            $news = $this->newsService->getAllNews($perPage);

            return view('news.index', compact('news'));
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

            return redirect()->route('news.listNews')->with('success', 'Notícia criada com sucesso!');
        } catch (\Exception $exception) {
            return redirect()->route('news.listNewsß')->with('error', 'Erro ao criar notícia: ' . $exception->getMessage());
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

    public function showNews($id)
    {
        try {
            $new = $this->newsService->getNewById($id);

            return view('news.admin.show', compact('new'));
        } catch (\Exception $exception) {
            return view('news.admin.index', ['error' => $exception->getMessage(), 'news' => collect()]);
        }
    }

    public function listNews()
    {
        try {
            $perPage = 10;

            $news = $this->newsService->getAllListNews($perPage);

            return view('news.admin.list', compact('news'));
        } catch (\Exception $exception) {
            return view('news.admin.index', ['error' => $exception->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $news = News::findOrFail($id);

            return view('news.list', compact('news'));
        } catch (\Exception $exception) {
            return redirect()->route('news.list')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'author_id' => 'required|exists:authors,id',
                'category_id' => 'required|exists:categories,id',
            ]);

            $this->newsService->updateNews($id, $data);

            return redirect()->route('news.listNews')->with('success', 'Notícia editada com sucesso!');
        } catch (\Exception $exception) {
            return redirect()->route('news.listNews')->with('error', 'Erro ao editar notícia: ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->newsService->deleteNews($id);

            return redirect()->route('news.listNews')->with('success', 'Notícia deletada com sucesso!');
        } catch (\Exception $exception) {
            return redirect()->route('news.listNews')->with('error', 'Erro ao deletar notícia: ' . $exception->getMessage());
        }
    }

    public function searchListNews(Request $request)
    {
        try {
            $query = $request->input('q', '');

            $news = $query
                ? $this->newsService->getNewsBySearch($query)->paginate(9)
                : News::paginate(9);

            return view('news.admin.list', compact('news'));
        } catch (\Exception $exception) {
            return view('news.admin.list', [
                'news' => collect(),
                'error' => $exception->getMessage()
            ]);
        }
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
            return view('news.index', [
                'news' => collect(),
                'error' => $exception->getMessage()
            ]);
        }
    }
}
