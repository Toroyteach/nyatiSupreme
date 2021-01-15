<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\CategoryContract;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function show()
    {
        //$category = $this->categoryRepository->findBySlug($slug);
        $cats = Category::orderByRaw('-name ASC')->get()->nest();

        return view('frontend.pages.category', compact('cats'));
    }
}
