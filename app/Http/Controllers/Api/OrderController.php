<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderApproved;
use App\Mail\OrderDeclined;
use App\Mail\OrderFailed;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variant_options' => 'nullable|array',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'card_number' => 'required|string|size:16',
            'expiry_date' => 'required|date|after:today',
            'cvv' => 'required|string|size:3',
            'simulate_result' => 'required|in:1,2,3', // 1=approved, 2=declined, 3=failed
        ]);


        $product = Product::findOrFail($validated['product_id']);
        if ($product->inventory < $validated['quantity']) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough inventory available',
            ], 400);
        }

        // Create order
        $order = new Order();
        $order->order_number = 'ORD-' . Str::upper(Str::random(8));
        $order->full_name = $validated['full_name'];
        $order->email = $validated['email'];
        $order->phone = $validated['phone'];
        $order->address = $validated['address'];
        $order->city = $validated['city'];
        $order->state = $validated['state'];
        $order->zip_code = $validated['zip_code'];
        $order->card_last_four = substr($validated['card_number'], -4);

        // Get product
        $subtotal = $product->price * $validated['quantity'];
        $order->total = $subtotal;

        // Simulate transaction result
        $simulateResult = $validated['simulate_result'];
        if ($simulateResult == '1') {
            $order->status = 'approved';
        } elseif ($simulateResult == '2') {
            $order->status = 'declined';
        } else {
            $order->status = 'failed';
        }

        $order->save();

        // Update inventory if approved
        if ($order->status === 'approved') {
            $product->decrement('inventory', $validated['quantity']);
        }

        // Create order item
        $orderItem = new OrderItem();
        $orderItem->order_id = $order->id;
        $orderItem->product_id = $product->id;
        $orderItem->quantity = $validated['quantity'];
        $orderItem->price = $product->price;
        $orderItem->variant_options = $validated['variant_options'];
        $orderItem->save();

        // Send appropriate email
        try {
            if ($order->status === 'approved') {
                Mail::to($order->email)->send(new OrderApproved($order));
            } elseif ($order->status === 'declined') {
                Mail::to($order->email)->send(new OrderDeclined($order));
            } else {
                Mail::to($order->email)->send(new OrderFailed($order));
            }
        } catch (\Exception $e) {
            // Log email error but don't fail the order
            Log::error('Email sending failed: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'order_number' => $order->order_number,
            'status' => $order->status,
        ]);
    }


    public function show($orderNumber)
    {
        $order = Order::with(['items.product'])->where('order_number', $orderNumber)->firstOrFail();
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
