<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required_if:user_id,null|string|max:255',
            'customer_email' => 'required_if:user_id,null|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'customer_address' => 'nullable|string|max:500',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock_quantity < $request->quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        $orderData = [
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $product->price * $request->quantity,
            'status' => 'pending',
            'customer_name' => $request->customer_name ?? Auth::user()->name,
            'customer_email' => $request->customer_email ?? Auth::user()->email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
        ];

        if (Auth::check()) {
            $orderData['user_id'] = Auth::id();
        }

        $order = $this->orderService->create($orderData);

        // Update product stock
        $product->decrement('stock_quantity', $request->quantity);

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Order placed successfully!');
    }

    public function show(Order $order)
    {
        if (Auth::check() && Auth::user()->id !== $order->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    public function index()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            $orders = $this->orderService->all();
        } else {
            $orders = $this->orderService->getUserOrders(Auth::id());
        }

        return view('orders.index', compact('orders'));
    }
}
