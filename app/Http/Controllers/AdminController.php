<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Database\Eloquent\SoftDeletes;

// ================ Controllers ============== //
use App\Http\Controllers\Controller;

// ================ Controllers ============== //


// ================ Models ============== //

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Contact;
use PDF;
use Notification;

use App\Notifications\SendEmailNotification;

// ================ Models ============== //

class AdminController extends Controller
{
    public function view_category()
    {
        if (Auth::id()) {
            return view('admin.category');
        } else {
            return view('auth.login');
        }
    }

    public function add_category(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories|alpha',
        ]);


        $category = new Category();

        $category->category_name = $request->category_name;

        $category->save();

        return redirect()->back()->with('message', 'category added successfully');
    }

    public function show_category()
    {
        $category = Category::all();

        return view('admin.show_all_category', compact('category'));
    }

    public function delete_category($id)
    {
        $category = Category::find($id);

        $category->delete();

        return redirect()->back()->with('message', 'category deleted successfully');
    }

    //Product Started

    public function view_product()
    {
        $category = Category::all();
        return view('admin.product', compact('category'));
    }

    public function add_product(Request $request)
    {
        $request->validate([
            'product_category' => 'required',
            'product_name' => 'required',
            'product_quantity' => 'required|numeric',
            'product_price' => 'required|numeric',
            'product_discount_price' => 'nullable|numeric',
            'product_description' => 'required|string',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product();

        $product->product_category = $request->product_category;
        $product->product_name = $request->product_name;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;
        $product->product_discount_price = $request->product_discount_price;
        $product->product_description = $request->product_description;

        $image = $request->product_image;
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $request->product_image->move('Product_Images', $image_name);
        $product->product_image = $image_name;

        $product->save();

        return redirect()->back()->with('message', 'Product Added Successfully');
    }

    public function show_product()
    {
        $product = Product::all();

        return view('admin.show_all_product', compact('product'));
    }
    

    public function delete_product($id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->back()->with('message', 'Product deleted successfully');
    }

    public function force_product($id)
    {
        $product = Product::withTrashed()->find($id);

        $product->forceDelete();

        return redirect()->back()->with('message', 'Product delete Permenant successfully');
    }

    public function restore_product($id)
    {
        $product = Product::withTrashed()->find($id);

        $product->restore();

        return redirect()->back()->with('message', 'Product Restore successfully');
    }

    public function trash_product()
    {
        $product = Product::onlyTrashed()->get(); // Use 'get()' instead of 'all()'

        return view('admin.product_trash', compact('product'));
    }


    public function update_product($id)
    {
        $product = Product::find($id);

        $category = Category::all();

        return view('admin.update_product', compact('product', 'category'));
    }

    public function view_update_product(Request $request, $id)
    {
        $product = Product::find($id);

        $product->product_category = $request->product_category;
        $product->product_name = $request->product_name;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;
        $product->product_discount_price = $request->product_discount_price;
        $product->product_description = $request->product_description;

        $image = $request->product_image;

        if ($image) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $request->product_image->move('Product_Images', $image_name);
            $product->product_image = $image_name;
        }


        $product->save();

        return redirect()->back()->with('message', 'Product successfully updated');
    }
    //Product ended

    //Orders Started
    public function orders()
    {
        $orders = Order::paginate(5);

        return view('admin.order', compact('orders'));
    }

    public function deliverd_order($id)
    {
        $order = Order::find($id);

        $order->delivery_status = "delivered";
        $order->payment_status = "paid";

        $order->save();

        return redirect()->back();
    }

    public function print_pdf($id)
    {
        try {
            $order = Order::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the order with the given $id is not found
            return abort(404); // or return a custom error response
        }

        $pdf = PDF::loadView('admin.pdf', compact('order'));
        $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);
        $pdf->getDomPDF()->set_option('isPhpEnabled', true);

        return $pdf->download('orders_detail.pdf');
    }

    public function notify($id)
    {
        $order = Order::find($id);

        return view('admin.notify', compact('order'));
    }

    public function sent_notify(Request $request, $id)
    {
        $order = Order::find($id);

        $details = [

            'greeting' => $request->greeting,
            'first_line' => $request->first_line,
            'email_body' => $request->email_body,
            'email_button' => $request->email_button,
            'email_url'  => $request->email_url,
            'last_line' => $request->last_line,
        ];

        Notification::send($order, new SendEmailNotification($details));
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $orders = Order::where('name', 'LIKE', "%$search%")->orwhere('email', 'LIKE', "%$search%")->orwhere('phone', 'LIKE', "%$search%")->get();

        return view('admin.order', compact('orders'));
    }
    //Order ended

    // User Message Start
    public function message()
    {
        $messages = Contact::all();

        return view('admin.message', compact('messages'));
    }
    // user Message End
}
