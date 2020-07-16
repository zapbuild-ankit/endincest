<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;

use App\Wishlist;

use Illuminate\Http\Request;
use Image;

class ShoppingController extends Controller {

	public function __construct() {
		$this->middleware('auth:admin');

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$products = Product::all();
		return view('products.index', compact('products'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('products.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		$validatedData = $request->validate([
				'name'        => 'required',
				'description' => 'required',
				'category'    => 'required',
				'price'       => 'required',
				'image'       => 'required',

			]);

		if ($request->hasFile('image')) {

			$file     = $request->file('image');
			$filename = time().'.'.$file->getClientOriginalExtension();
			Image::make($file)->resize(300, 300)->save(public_path('/dist/img/products/'.$filename));

		}

		$product = new Product;

		$product->name        = $request->name;
		$product->description = $request->description;
		$product->category    = $request->category;
		$product->price       = $request->price;
		$product->image       = $filename;
		$product->save();

		return redirect('/products')->with('success', 'Product is successfully saved');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$product = Product::findOrFail($id);

		return view('products.edit')->with('product', $product);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$product = Product::findOrFail($id);

		if ($product->image == "") {
			$this->validate($request, ['image' => 'required']);
		}

		$this->validate($request, ['name' => 'required', 'description' => 'required', 'category' => 'required', 'price' => 'required']);
		if ($request->hasFile('image')) {

			$file     = $request->file('image');
			$filename = time().'.'.$file->getClientOriginalExtension();

			Image::make($file)->resize(300, 300)->save(public_path('/dist/img/products/'.$filename));
			$product->image = $filename;
			$product->save();

		}

		$input = $request->only('name', 'description', 'category', 'price');

		$product->update($input);
		return redirect('/products')->with('success', 'Product is successfully edited');
		;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$product = Product::findOrFail($id);

		$carts = Cart::where('product_id', $id)->get();
		foreach ($carts as $cart) {
			$cart->delete();
		}

		$wishlists = Wishlist::where('product_id', $id)->get();
		foreach ($wishlists as $wishlist) {
			$wishlist->delete();
		}

		$product->delete();

		return redirect('/products')->with('success', 'Product is successfully deleted');

	}
}