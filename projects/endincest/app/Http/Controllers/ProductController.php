<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\User;
use App\Wishlist;
use Auth;
use Illuminate\Http\Request;

use Srmklive\PayPal\Services\ExpressCheckout;

class ProductController extends Controller {

	protected $provider;
	public function __construct() {

		$this->provider = new ExpressCheckout();

	}

	//Method to show the products to users

	public function product_view() {

		$user = Auth::User();

		if ($user) {
			$user_id   = Auth::User()->id;
			$carts     = Cart::where('user_id', $user_id)->get();
			$wishlists = Wishlist::where('user_id', $user_id)->get();
			$count     = 0;
			$number    = 0;
			if (!$carts->isEmpty()) {

				foreach ($carts as $cart) {
					$product_id = $cart->product_id;
					$count      = $count+1;
					$ids[]      = $product_id;
				}

				$questions = Product::where(function ($q) use ($ids) {
						foreach ($ids as $key => $value) {
							$key = 'id';
							$q->where($key, '!=', $value);
						}
					})->get();
			}

			if (!$wishlists->isEmpty()) {
				foreach ($wishlists as $wishlist) {

					$number = $number+1;
				}

			}

		}

		$products = Product::orderBy('created_at', 'DESC')->paginate(6);

		$Allproducts = Product::all();
		if (!$Allproducts->isEmpty()) {
			$Allproducts_count = $Allproducts->count();
		}

		return view('products.productview', compact('products', 'user', 'carts', 'count', 'number', 'Allproducts_count', 'questions'));
	}

	//Method to add products to cart

	public function add_to_cart($id) {

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

			}
		}
		$carts = new Cart;

		$carts->user_id    = $user_id;
		$carts->product_id = $id;
		$carts->save();
		return redirect('/cart');
	}

	//Method to view products of cart

	public function cart_view() {
		$user = Auth::User();

		if ($user) {
			$user_id = Auth::user()->id;

			$carts     = Cart::where('user_id', $user_id)->get();
			$wishlists = Wishlist::where('user_id', $user_id)->get();
			$number    = 0;
			$count     = 0;
			if (!$wishlists->isEmpty()) {
				foreach ($wishlists as $wishlist) {

					$number = $number+1;
				}
			}
			if (!$carts->isEmpty()) {
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

	public function add_to_wish_list($id) {

		$user_id   = Auth::user()->id;
		$wishlists = Wishlist::where('product_id', $id)->get();

		foreach ($wishlists as $Wishlist) {

			if ($id == $Wishlist->product_id && $user_id == $Wishlist->user_id) {

				return redirect('/wish_list');
			}
		}

		$wishlists = new Wishlist;

		$wishlists->user_id    = $user_id;
		$wishlists->product_id = $id;
		$wishlists->save();
		return redirect('/wish_list');

	}

	//Method to view Products of wishlist

	public function wish_list_view() {
		$user = Auth::User();

		if ($user) {

			$user_id = Auth::user()->id;

			$wishlists = Wishlist::where('user_id', $user_id)->get();
			$carts     = Cart::where('user_id', $user_id)->get();
			$count     = 0;
			$number    = 0;
			if (!$carts->isEmpty()) {
				foreach ($carts as $cart) {
					;
					$count = $count+1;
				}
			}
			if (!$wishlists->isEmpty()) {
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

	public function remove_cart($id) {
		$user_id = Auth::User()->id;
		$carts   = Cart::select('*')->where([
				['product_id', '=', $id], ['user_id', '=', $user_id]
			])->get();

		$products = Product::where('id', $id)->get();

		foreach ($carts as $cart) {

			$cart->delete();
		}

		return redirect('/cart');
	}

	//Method to destroy products from Wishlist

	public function remove_wish($id) {
		$user_id   = Auth::User()->id;
		$wishlists = Wishlist::select('*')->where([
				['product_id', '=', $id], ['user_id', '=', $user_id]
			])->get();

		foreach ($wishlists as $wishlist) {

			$wishlist->delete();
		}

		return redirect('/wish_list');
	}

	//Method to filter products

	public function search(Request $request) {

		$query = $request->input('query');
		$user  = Auth::User();

		if ($user) {
			$user_id   = Auth::User()->id;
			$carts     = Cart::where('user_id', $user_id)->get();
			$wishlists = Wishlist::where('user_id', $user_id)->get();
			$count     = 0;
			$number    = 0;
			if (!$carts->isEmpty()) {
				foreach ($carts as $cart) {
					$product_id     = $cart->product_id;
					$cart_product[] = Product::findOrFail($product_id);
					$count          = $count+1;
					$ids[]          = $product_id;
				}

				$questions = Product::where(function ($q) use ($ids) {
						foreach ($ids as $key => $value) {
							$key = 'id';
							$q->where($key, '!=', $value);
						}
					})->get();
			}

			if (isset($wishlists)) {
				foreach ($wishlists as $wishlist) {

					$number = $number+1;
				}

			}

		}

		$productlist = Product::all();
		if (!$productlist->isEmpty()) {

			$productcount = $productlist->count();

			$products = Product::where('name', 'like', "%$query%")
				->orWhere('price', 'like', "%$query%")
				->orWhere('category', 'like', "%$query%")
				->orWhere('description', 'like', "%$query%")
				->paginate($productcount);

		}

		return view('products.search_result', compact('products', 'user', 'carts', 'count', 'number', 'cart_product', 'questions'));
	}

	//Method for payment with  paypal

	public function paypal_payment($id) {

		$product = Product::findOrFail($id);

		if (isset($product)) {

			$product_price = $product->price;

			$data          = [];
			$data['items'] = [
				[
					'name'  => 'endincest',
					'price' => $product_price,
					'desc'  => 'Description of endincest',
					'qty'   => 1
				]
			];
			$invoice_id = rand();

			$data['invoice_id']          = $invoice_id;
			$data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
			$data['return_url']          = route('payment.success');
			$data['cancel_url']          = route('payment.cancel');
			$data['total']               = $product_price;

			$response = $this->provider->setExpressCheckout($data);

			$response = $this->provider->setExpressCheckout($data, true);

			return redirect($response['paypal_link']);
		}

	}

	//Method to cancel payment

	public function cancel() {

		return redirect()->back()->with(['error' => "Your Payment is successfully canceled"]);

	}

	//Method for succcess transaction

	public function success(Request $request) {
		$token = $this->provider->getExpressCheckoutDetails($request->token);

		$response = $this->provider->getExpressCheckoutDetails($request->token);

		if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESS'])) {

			return redirect()->back()->with(['success' => "Your Payment is successfully done"]);

		}
		return redirect()->back()->with(['error' => "Something is wrong with your paymaent"]);

	}

}
