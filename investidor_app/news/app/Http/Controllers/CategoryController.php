<?php

namespace App\Http\Controllers;

use App\Models\Category;
use app\Services\CategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }


    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        try {
            $perPage = 5;

            $categories = $this->categoryService->getAllCategories($perPage);

            return view('news.admin.category.index', compact('categories'));
        } catch (\Exception $exception) {
            return view('news.admin.category.index', [
                'error' => $exception->getMessage(),
                'categories' => collect(),
            ]);
        }
    }


    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        try {
            return view('categories.create');
        } catch (\Exception $exception) {
            return view('news.admin.category.index', ['error' => $exception->getMessage(), 'categories' => collect()]);
        }
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $this->categoryService->createCategory($validated);

            return redirect()->route('categories.index')->with('success', 'Categoria criada com sucesso');
        } catch (\Exception $exception) {
            return view('news.admin.category.index', ['error' => $exception->getMessage(), 'categories' => collect()]);
        }
    }

    /**
     * @param $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function show($id)
    {
        try {
            $category = $this->categoryService->getCategoryById($id);

            return view('news.admin.category.show', compact('category'));
        } catch (\Exception $exception) {
            return redirect()->route('admin.category')->with('error', $exception->getMessage());
        }
    }

    /**
     * @param $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit($id)
    {
        try {
            $category = $this->categoryService->getCategoryById($id);

            return view('categories.edit', compact('category'));
        } catch (\Exception $exception) {
            return view('news.admin.category.index', ['error' => $exception->getMessage(), 'categories' => collect()]);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $this->categoryService->updateCategory($id, $request->all());

            return redirect()->route('admin.category')->with('success', 'Categoria atualizada com sucesso');
        } catch (\Exception $exception) {
            return view('news.admin.category.index', ['error' => $exception->getMessage(), 'categories' => collect()]);
        }
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $this->categoryService->deleteCategory($id);

            return redirect()->route('admin.category')->with('success', 'Categoria deletada com sucesso');
        } catch (\Exception $exception) {
            return redirect()->route('admin.category')->with('error', $exception->getMessage());
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

            $categories = $query
                ? $this->categoryService->getCategoriesBySearch($query)->paginate(5)
                : Category::paginate(5);

            return view('news.admin.category.index', compact('categories'));
        } catch (\Exception $exception) {
            return view('news.admin.category.index', [
                'categories' => collect(),
                'error' => $exception->getMessage(),
            ]);
        }
    }
}
