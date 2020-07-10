<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\User;
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

	//Method to show the products to users

	public function productview() {

		$user = Auth::User();

		if ($user) {
			$user_id   = Auth::User()->id;
			$carts     = Cart::where('user_id', $user_id)->get();
			$wishlists = Wishlist::where('user_id', $user_id)->get();
			$count     = 0;
			$number    = 0;
			if (isset($carts)) {
				foreach ($carts as $cart) {
					$product_id     = $cart->product_id;
					$cart_product[] = Product::findOrFail($product_id);
					$count          = $count+1;
				}

			}

			if (isset($cart_product)) {

				foreach ($cart_product as $cart_products) {

					$cart_products->status = 0;
					$cart_products->save();

				}

			}

			if (isset($wishlists)) {
				foreach ($wishlists as $wishlist) {

					$number = $number+1;
				}

			}

			$products = Product::all();
			if ($carts->isEmpty() && !$products->isEmpty()) {
				foreach ($products as $product) {
					$product->status = 1;
					$product->save();
				}
			}
		}
		$products = Product::all();

		return view('products.productview', compact('products', 'user', 'carts', 'count', 'number', 'cart_product'));
	}

	//Method to add products to cart

	public function addtocart($id) {

		$user_id  = Auth::user()->id;
		$carts    = Cart::where('product_id', $id)->get();
		$products = Product::where('id', $id)->get();
		if (isset($carts)) {
			foreach ($carts as $cart) {

				if ($id == $cart->product_id && $user_id == $cart->user_id) {
					$quantity       = $cart->quantity;
					$cart->quantity = $quantity+1;
					$cart->update();
					return redirect('/cart');
				}
				if (isset($products)) {
					foreach ($products as $product) {
						$product->status = 0;
						$product->save();
					}
				}
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
		$user = Auth::User();

		if ($user) {
			$user_id = Auth::user()->id;

			$carts     = Cart::where('user_id', $user_id)->get();
			$wishlists = Wishlist::where('user_id', $user_id)->get();
			$number    = 0;
			$count     = 0;
			if (isset($wishlists)) {
				foreach ($wishlists as $wishlist) {

					$number = $number+1;
				}
			}
			if (isset($carts)) {
				foreach ($carts as $cart) {
					$product_id = $cart->product_id;

					$quantity[] = $cart->quantity;

					$products[] = Product::find($product_id);

					$count = $count+1;

				}
			}

		}

		return view('products.cartview', compact('products', 'quantity', 'count', 'number'));

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
		$user = Auth::User();

		if ($user) {

			$user_id = Auth::user()->id;

			$wishlists = Wishlist::where('user_id', $user_id)->get();
			$carts     = Cart::where('user_id', $user_id)->get();
			$count     = 0;
			$number    = 0;
			if (isset($carts)) {
				foreach ($carts as $cart) {
					;
					$count = $count+1;
				}
			}
			if (isset($wishlists)) {
				foreach ($wishlists as $wishlist) {
					$product_id = $wishlist->product_id;
					$products[] = Product::find($product_id);

					$number = $number+1;

				}
			}

		}

		return view('products.wishlist', compact('products', 'number', 'count'));
	}

	//Method to destroy products from cart

	public function removecart($id) {
		$user_id = Auth::User()->id;
		$carts   = Cart::select('*')->where([
				['product_id', '=', $id], ['user_id', '=', $user_id]
			])->get();

		$products = Product::where('id', $id)->get();

		foreach ($carts as $cart) {

			$cart->delete();
		}

		foreach ($products as $product) {

			$product->status = 1;
			$product->save();
		}

		return redirect('/cart');
	}

	//Method to destroy products from Wishlist

	public function removewish($id) {
		$user_id   = Auth::User()->id;
		$wishlists = Wishlist::select('*')->where([
				['product_id', '=', $id], ['user_id', '=', $user_id]
			])->get();

		foreach ($wishlists as $wishlist) {

			$wishlist->delete();
		}

		return redirect('/wishlist');
	}

}
