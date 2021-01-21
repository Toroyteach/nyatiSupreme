<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RequestProduct;

class RequestProductController extends Controller
{
    //
    public function index()
    {
            $productsRequest = RequestProduct::all()->sortByDesc('created_at');

            return view('admin.requestproducts.index', compact('productsRequest'));
    }

    public function show($id)
    {
            $productsRequests = RequestProduct::find($id);

            return view('admin.requestproducts.show', compact('productsRequests'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:20',
            'quantity' => 'required|numeric|min:1',
            'email_number' => 'required|max:50'
        ]);

        //dd($request->all());

        RequestProduct::create($request->except('_token'));

        return redirect()->back()->with('message', 'We have receved your Request. We shall get back to you soon!');
    }
    
}
