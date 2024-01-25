<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use Session;
use Stripe;

// ================ Models ============== //

use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Contact;



// ================ Models ============== //


class HomeController extends Controller
{

    public function index()
    {

        $category = Category::all();
        $product = Product::all();
        return view('user.index', compact('category', 'product'));
    }

    public function user_search(Request $request)
    {
        $user_search = $request->search;

        $product = Product::where('product_name', 'LIKE', "%$user_search%")->orWhere('product_category', 'LIKE', "%$user_search%")->paginate(10);

        return view('user.shop', compact('product'));
    }

    public function show_order()
    {
        if (Auth::id()) {

            $user = Auth::user();

            $user_id = $user->id;

            $order = Order::where('user_id', '=', $user_id)->get();

            return view('user.show_order', compact('order'));
        } else {
            return view('auth.login');
        }
    }

    public function cancel_order($id)
    {
        $order = Order::find($id);

        $order->delivery_status = 'You cancelled the order';

        $order->save();

        return redirect()->back();
    }

    public function cart(Request $request, $id)
    {
        if (Auth::id()) {

            $user = Auth::user();

            $user_id = $user->id;
            $product = Product::find($id);

            $product_exits_id = Cart::where('product_id', '=', $id)->where('user_id', '=', $user_id)->get('id')->first();

            if ($product_exits_id) {

                $cart = Cart::find($product_exits_id)->first();

                $quantity = $cart->product_quantity;

                $cart->product_quantity = $quantity + $request->quantity;

                if ($product->product_discount_price != null) {
                    $cart->product_price = $product->product_discount_price *  $cart->product_quantity;
                } else {
                    $cart->product_price = $product->product_price *  $cart->product_quantity;
                }

                $cart->save();

                Alert::success('Success', 'We added the product to the cart');

                return redirect()->back();
            } else {

                $cart = new Cart;

                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;


                $cart->product_name = $product->product_name;

                if ($product->product_discount_price != null) {
                    $cart->product_price = $product->product_discount_price *  $request->quantity;
                } else {
                    $cart->product_price = $product->product_price *  $request->quantity;
                }

                $cart->product_image = $product->product_image;
                $cart->product_id = $product->id;
                $cart->product_quantity = $request->quantity;

                $cart->save();

                return redirect()->back();
            }
        } else {
            return view('auth.login');
        }
    }

    public function show_cart()
    {
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $show_cart = Cart::where('user_id', '=', $user_id)->get();
            return view('user.cart', compact('show_cart'));
        } else {
            return view('auth.login');
        }
    }

    public function remove_cart($id)
    {
        $remove_cart = Cart::find($id);

        $remove_cart->delete();
        return redirect()->back();
    }


    public function checkout()
    {
        $user = Auth::user();

        $user_id = $user->id;

        $checkout = cart::where('user_id', $user_id)->get();

        // Calculate subtotal
        $subtotal = $checkout->sum('product_price');

        // Calculate shipping (you can set your shipping cost here)
        $shipping = 100; // Change this value as needed

        // Calculate total
        $total = $subtotal + $shipping;

        return view('user.checkout', compact('user', 'checkout', 'subtotal', 'shipping', 'total'));
    }

    public function place_order()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $cartItems = Cart::where('user_id', $user_id)->get();

        foreach ($cartItems as $cartItem) {
            $order = new Order;

            // Assign values from cart item to the order
            $order->name = $cartItem->name;
            $order->email = $cartItem->email;
            $order->phone = $cartItem->phone;
            $order->address = $cartItem->address;
            $order->user_id = $cartItem->user_id;
            $order->product_name = $cartItem->product_name;
            $order->product_price = $cartItem->product_price;
            $order->product_quantity = $cartItem->product_quantity;
            $order->product_image = $cartItem->product_image;
            $order->product_id = $cartItem->product_id;
            $order->payment_status = 'Cash on delivery';
            $order->delivery_status = 'Processing';

            $order->save();
        }

        // After saving orders, you can clear the cart or perform any other necessary actions

        // Clear the cart
        Cart::where('user_id', $user_id)->delete();

        return redirect()->back()->with('message', 'We have successfully processed your order and will return back to you soon in 7 Days.');
    }

    public function stripe($total)
    {
        return view('user.stripe', compact('total'));
    }

    public function stripePost(Request $request, $total)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $total * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for payment to your Stripe account"
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $cartItems = Cart::where('user_id', $user_id)->get();

        foreach ($cartItems as $cartItem) {
            $order = new Order;

            // Assign values from cart item to the order
            $order->name = $cartItem->name;
            $order->email = $cartItem->email;
            $order->phone = $cartItem->phone;
            $order->address = $cartItem->address;
            $order->user_id = $cartItem->user_id;
            $order->product_name = $cartItem->product_name;
            $order->product_price = $cartItem->product_price;
            $order->product_quantity = $cartItem->product_quantity;
            $order->product_image = $cartItem->product_image;
            $order->product_id = $cartItem->product_id;
            $order->payment_status = '  Paid';
            $order->delivery_status = 'Processing';

            $order->save();
        }

        // After saving orders, you can clear the cart or perform any other necessary actions

        // Clear the cart
        Cart::where('user_id', $user_id)->delete();

        Session::flash('success', 'Payment successful!');

        return back();
    }


    public function contact()
    {
        return view('user.contact');
    }

    public function add_contact(Request $request)
    {
        // Validate the form data
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'subject' => 'required|string|max:255',
        //     'message' => 'required|string',
        // ]);

        $contact = new Contact();
        // $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        return redirect()->back()->with('message', 'Your message has been sent successfully');
    }

    public function detail($id)
    {
        $product = Product::find($id);
        return view('user.detail', compact('product'));
    }

    public function shop()
    {
        $product = Product::paginate(8);
        return view('user.shop', compact('product'));
    }


    public function redirect()
    {
        $user_type = Auth::user()->user_type;

        // $user_type = 1;
        if ($user_type == '1') {
            $total_products = Product::all()->count();
            $total_orders = Order::all()->count();
            $total_user = User::all()->count();

            $order = Order::all();

            $category = Category::all()->count();
            $total_revenue = 0;

            foreach ($order as $order) {
                $total_revenue = $total_revenue + $order->product_price;
            }

            $total_deliverd = Order::where('delivery_status', '=', 'delivered')->get()->count();

            $total_processing = Order::where('delivery_status', '=', 'processing')->get()->count();



            $total_deliverd = Order::where('delivery_status', '=', 'delivered')->get()->count();
            return view('admin.Home', compact('total_products', 'total_user', 'total_orders', 'total_revenue', 'total_deliverd', 'total_processing', 'category'));
        } else {
            $category = Category::all();
            $product = Product::all();
            return view('user.index', compact('category', 'product'));
        }
    }
}