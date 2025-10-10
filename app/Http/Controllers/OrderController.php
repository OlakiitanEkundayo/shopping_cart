<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

    public function store(Request $request)
    {

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'notes' => 'nullable|string|max:1000',
        ]);


        $cart = session()->get('cart', []);


        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }


        $subtotal = $this->calculateSubtotal($cart);
        $shipping = $subtotal > 50 ? 0 : 10;
        $tax = $subtotal * 0.10;
        $total = $subtotal + $shipping + $tax;

        try {

            DB::beginTransaction();

            // Create the order
            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'zip' => $validated['zip'],
                'country' => $validated['country'] ?? 'US',
                'notes' => $validated['notes'] ?? null,
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'tax' => $tax,
                'total' => $total,
                'status' => 'pending',
            ]);

            // Create order items
            foreach ($cart as $item) {

                $product = Product::find($item['id']);

                if (!$product) {
                    throw new \Exception("Product {$item['name']} no longer exists.");
                }

                if ($product->stock_quantity < $item['quantity']) {
                    throw new \Exception("Not enough stock for {$item['name']}.");
                }

                // Create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Decrease product stock (optional - uncomment if you want to track inventory)
                // $product->decrement('stock_quantity', $item['quantity']);
            }


            DB::commit();


            session()->forget('cart');


            return redirect()->route('order.confirmation', $order->id)
                ->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {

            DB::rollBack();


            Log::error('Order creation failed: ' . $e->getMessage());


            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }


    public function confirmation($orderId)
    {

        $order = Order::with('orderItems.product')->findOrFail($orderId);

        return view('orders.confirmation', compact('order'));
    }


    private function calculateSubtotal($cart)
    {
        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return $subtotal;
    }
}
