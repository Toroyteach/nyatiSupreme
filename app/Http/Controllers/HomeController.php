<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\CustomerContact;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $topItems = Product::orderBy('updated_at', 'DESC')->take(12)->get();
        $topCats = Category::orderBy('updated_at', 'DESC')->where('featured',1)->take(3)->get();
        //dd($topCats);
        return view('frontend.pages.homepage', compact('topItems', 'topCats'));
    }

    public function shop()
    {
        $cats = Category::orderByRaw('-name ASC')->get()->nest();
        $products = $topItems = Product::orderBy('updated_at', 'DESC')->get();

        return view('frontend.pages.productlist', compact('cats', 'products'));
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }
    public function getInformation($slug)
    {

        return view('frontens.pages.information');
    }

    public function storeFeedback(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:20',
            'email'=>'required',
            'subject'=>'required|max:20',
            'description'=>'required:191'
         ]);

        CustomerContact::create($request->except('_token'));

        return redirect()->back()->with('message', 'We have recieved your contact information. We shall get back to you');
    }

    public function search()
    {

    }

    public function autocomplete(Request $request)
    {
        $data = Product::select("slug")->where("slug","LIKE","%{$request->query}%")->get();

        return response()->json($data);
    }
}
