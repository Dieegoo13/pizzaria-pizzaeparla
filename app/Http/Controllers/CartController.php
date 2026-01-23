<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $id = uniqid();

        $cart[$id] = [
            'name'     => $request->pizza,
            'border'   => $request->border,
            'beverage' => $request->beverage,
            'price'    => $request->price,
            'quantity' => 1,
        ];

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'count' => count($cart)
        ]);
    }

    public function index()
    {
        return response()->json(session('cart', []));
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->id]);
        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }

    public function clear()
    {
        session()->forget('cart');
        return response()->json(['success' => true]);
    }

    public function checkout()
    {
        $cart = session('cart', []);

        $total = collect($cart)->sum(fn($item) => $item['price']);

        return view('site.checkout', compact('cart', 'total'));
    }
}   