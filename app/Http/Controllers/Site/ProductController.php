<?php

namespace App\Http\Controllers\Site;

use Cart;
use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Http\Controllers\Controller;
use App\Contracts\AttributeContract;

class ProductController extends Controller
{
    protected $productRepository;

    protected $attributeRepository;

    public function __construct(ProductContract $productRepository, AttributeContract $attributeRepository)
    {
        $this->productRepository = $productRepository;
        $this->attributeRepository = $attributeRepository;
    }

    public function show($slug)
    {
        $product = $this->productRepository->findProductBySlug($slug);
        $attributes = $this->attributeRepository->listAttributes();

        return view('frontend.pages.product', compact('product', 'attributes'));
    }

    public function addToCart(Request $request)
    {
        //dd('here');
        $product = $this->productRepository->findProductById($request->input('productId'));
        $options = $request->except('_token', 'productId', 'price', 'qty');
        //dd($product->toArray());

        //$discountConditions = $this->productRepository->getProductCountDiscount();

        $arrayParams = array(
            'id' => uniqid(), // inique row ID
            'name' => $product->name,
            'price' => $request->input('price'),
            'quantity' => $request->input('qty'),
            'attributes' => $options,
            //'conditions' => $discountConditions
        );
        //dd($arrayParams);

        Cart::add($arrayParams);

        return redirect()->back()->with('message', 'Item added to cart successfully.');
    }
}
