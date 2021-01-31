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
        // $catItems = Category::orderByRaw('-name ASC')->where('featured', 1)->get()->nest();
        //dd($cats);

        return view('frontend.pages.category', compact('cats'));
    }

    public function showProduct($slug)
    {
        //$category = $this->categoryRepository->findBySlug($slug);
        $cats = Category::orderByRaw('-name ASC')->where('featured', 1)->get();
        $catItems = Category::orderByRaw('-name ASC')->where('featured', 1)->where('slug', $slug)->with('products')->paginate(5);
        //dd($catItems->all());

        return view('frontend.pages.categoryshow', compact('cats', 'catItems'));
    }
}
