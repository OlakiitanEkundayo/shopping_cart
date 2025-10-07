<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    // Display the shopping cart

    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = $this->calculateSubtotal($cart);

        return view('cart.index', compact('cart', 'subtotal'));
    }


    // Add product to cart

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check if product has enough stock
        if ($product->stock_quantity < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough stock available'
            ], 400);
        }

        // Get the cart from session
        $cart = session()->get('cart', []);

        // Check if product already exists in cart
        $found = false;
        foreach ($cart as $key => $item) {
            if ($item['id'] == $product->id) {
                // Update quantity
                $cart[$key]['quantity'] += $request->quantity;
                $found = true;
                break;
            }
        }

        // If product not in cart, add it
        if (!$found) {
            $cart[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'image' => $product->image
            ];
        }

        // Save cart back to session
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully',
            'cartCount' => $this->getCartCount()
        ]);
    }


    // Update cart

    public function update(Request $request)
    {
        $request->validate([
            'cart' => 'required|array'
        ]);

        session()->put('cart', $request->cart);

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully',
            'cartCount' => $this->getCartCount()
        ]);
    }


    // Remove item from cart

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer'
        ]);

        $cart = session()->get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['id'] == $request->product_id) {
                unset($cart[$key]);
                break;
            }
        }

        // Reindex array
        $cart = array_values($cart);

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart',
            'cartCount' => $this->getCartCount()
        ]);
    }


    // Clear entire cart

    public function clear()
    {
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully',
            'cartCount' => 0
        ]);
    }

    //Get cart item count

    private function getCartCount()
    {
        $cart = session()->get('cart', []);
        $count = 0;

        foreach ($cart as $item) {
            $count += $item['quantity'];
        }

        return $count;
    }


    //Calculate cart subtotal

    private function calculateSubtotal($cart)
    {
        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return $subtotal;
    }
}
