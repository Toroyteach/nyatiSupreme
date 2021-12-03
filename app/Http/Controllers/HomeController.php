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
        $topItems = Product::orderBy('updated_at')->with('images')->take(12)->get();
        //$topItems = Product::orderBy('name')->take(10)->get();

        $topCats = Category::orderBy('updated_at', 'DESC')->take(3)->get();
        //dd($topItems->all());
        return view('frontend.pages.homepage', compact('topItems', 'topCats'));
    }

    public function shop()
    {
        $cats = Category::orderByRaw('-name ASC')->where('featured', 1)->get();
        $products = Product::orderBy('updated_at')->where('status', 1)->with('images')->paginate(6);

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
    public function getInformation()
    {

        return view('frontend.pages.information');
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

    public function search(Request $request)
    {
        $searchItem = $request->item;
        $cats = Category::orderByRaw('-name ASC')->get()->nest();
        $products = Product::where('name', $searchItem)->where('status', 1)->get();
        //dd($products);

        return view('frontend.pages.productshow', compact('cats', 'products'));
    }

    public function autocomplete(Request $request)
    {
        $item = $request->get('term');
        $data = Product::where('name', 'LIKE', '%'. $item. '%')->get();

        return response()->json($data);
    }

    public function itemShow($slug)
    {
        //dd('$slug');
        $cats = Category::orderByRaw('-name ASC')->get();
        $catItems = Category::orderByRaw('-name ASC')->where('slug', $slug)->with('products')->get();
        $title = $slug;
        //dd('this');
        //$images = '';// =  

        return view('frontend.pages.itemshow', compact('cats', 'catItems', 'title'));   
    }

    public function unavailableItems()
    {

        return view('frontend.pages.unavailableitems');   
    }

    public function privacy()
    {
        return view('frontend.policy');
    }
}
