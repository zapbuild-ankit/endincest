<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Wishlist;
use Auth;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller {
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
		return view('products.edit', compact('product'));
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

		$this->validate($request, ['name' => 'required', 'description' => 'required', 'category' => 'required', 'price' => 'required', 'image' => 'required']);
		if ($request->hasFile('image')) {

			$file     = $request->file('image');
			$filename = time().'.'.$file->getClientOriginalExtension();

			Image::make($file)->resize(300, 300)->save(public_path('/dist/img/products/'.$filename));

		}

		$product->image = $filename;
		$input          = $request->only('name', 'description', 'category', 'price');
		$product->save();
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

		$product->delete();

		return redirect('/products')->with('success', 'Product is successfully deleted');

	}

	//Method to show the products to users

	public function productview() {

		$products = Product::all();

		return view('products.productview', compact('products'));
	}

	//Method to add products to cart

	public function addtocart($id) {

		$user_id = Auth::user()->id;
		$carts   = Cart::where('product_id', $id)->get();

		foreach ($carts as $cart) {

			if ($id == $cart->product_id && $user_id == $cart->user_id) {
				$quantity       = $cart->quantity;
				$cart->quantity = $quantity+1;
				$cart->update();
				return redirect('/cart');
			}
		}

		$carts = new Cart;

		$carts->user_id    = $user_id;
		$carts->product_id = $id;
		$carts->save();
		return redirect('/cart');
	}

	//Method to view products of cart

	public function cartview() {
		$user_id = Auth::user()->id;

		$carts = Cart::where('user_id', $user_id)->get();

		foreach ($carts as $cart) {
			$product_id = $cart->product_id;

			$quantity[] = $cart->quantity;

			$products[] = Product::findOrFail($product_id);

		}

		return view('products.cartview', compact('products', 'quantity'));

	}

	//Method to add Products to Wishlist

	public function addtowishlist($id) {

		$user_id   = Auth::user()->id;
		$wishlists = Wishlist::where('product_id', $id)->get();

		foreach ($wishlists as $Wishlist) {

			if ($id == $Wishlist->product_id && $user_id == $Wishlist->user_id) {

				return redirect('/wishlist');
			}
		}

		$wishlists = new Wishlist;

		$wishlists->user_id    = $user_id;
		$wishlists->product_id = $id;
		$wishlists->save();
		return redirect('/wishlist');

	}

	//Method to view Products of wishlist

	public function wishlistview() {

		$user_id = Auth::user()->id;

		$wishlists = Wishlist::where('user_id', $user_id)->get();
		foreach ($wishlists as $wishlist) {
			$product_id = $wishlist->product_id;

			$products[] = Product::findOrFail($product_id);

		}

		return view('products.wishlist', compact('products'));
	}

	//Method to destroy products from cart

	public function removecart($id) {

		$carts = Cart::where('product_id', $id)->get();

		foreach ($carts as $cart) {

			$cart->delete();
		}

		return redirect('/cart');
	}

	//Method to destroy products from Wishlist

	public function removewish($id) {

		$wishlists = Wishlist::where('product_id', $id)->get();

		foreach ($wishlists as $wishlist) {

			$wishlist->delete();
		}

		return redirect('/wishlist');
	}

}
