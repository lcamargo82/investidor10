<?php

namespace App\Http\Controllers;

use App\Models\News;
use app\Services\NewsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
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
     * @param Request $request
     * @return RedirectResponse
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
            return redirect()->route('news.listNews')->with('error', 'Erro ao criar notícia: ' . $exception->getMessage());
        }
    }

    /**
     * @param $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
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
     * @param $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function showNews($id)
    {
        try {
            $new = $this->newsService->getNewById($id);

            return view('news.admin.news.show', compact('new'));
        } catch (\Exception $exception) {
            return view('news.admin.news.index', ['error' => $exception->getMessage(), 'news' => collect()]);
        }
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function listNews()
    {
        try {
            $perPage = 10;

            $news = $this->newsService->getAllListNews($perPage);

            return view('news.admin.news.index', compact('news'));
        } catch (\Exception $exception) {
            return view('news.admin.news.index', ['error' => $exception->getMessage()]);
        }
    }

    /**
     * @param $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
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
     * @param Request $request
     * @param $id
     * @return RedirectResponse
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
     * @param $id
     * @return RedirectResponse
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

    /**
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function searchListNews(Request $request)
    {
        try {
            $query = $request->input('q', '');

            $news = $query
                ? $this->newsService->getNewsBySearch($query)->paginate(9)
                : News::paginate(9);

            return view('news.admin.news.index', compact('news'));
        } catch (\Exception $exception) {
            return view('news.admin.news.index', [
                'news' => collect(),
                'error' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
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
