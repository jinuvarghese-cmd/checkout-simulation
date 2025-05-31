<!DOCTYPE html>
<html>
<head>
    <title>Order Approved</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f9fafb;">
    <div style="max-width: 600px; margin: 2rem auto; background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); overflow: hidden;">
        
        <!-- Header -->
        <div style="background-color: #4f46e5; padding: 1rem 1.5rem;">
            <h1 style="font-size: 1.5rem; font-weight: 700; color: #ffffff;">Your Order Has Been Approved!</h1>
        </div>

        <!-- Content -->
        <div style="padding: 1.5rem;">
            <p style="color: #374151; margin-bottom: 1.5rem;">
                Hi <span style="font-weight: 500;">{{ $order->full_name }}</span>, thank you for your purchase! Your order 
                <span style="font-weight: 700;">#{{ $order->order_number }}</span> has been approved and is being processed.
            </p>

            <!-- Order Summary -->
            <div style="margin-bottom: 2rem;">
                <h2 style="font-size: 1.125rem; font-weight: 700; color: #111827; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem; margin-bottom: 1rem;">
                    Order Summary
                </h2>

                <div style="margin-top: 1rem;">
                    @foreach($order->items as $item)
                        <div style="display: flex; align-items: flex-start; border-bottom: 1px solid #e5e7eb; padding-bottom: 1rem; margin-bottom: 1rem;">
                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" style="width: 64px; height: 64px; object-fit: cover; border-radius: 0.375rem; margin-right: 1rem; flex-shrink: 0;">
                            <div style="flex: 1;">
                                <h3 style="font-weight: 500; color: #111827;">{{ $item->product->name }}</h3>
                                
                                @if($item->variant_options && is_array($item->variant_options))
                                    <div style="font-size: 0.875rem; color: #6b7280; margin-top: 0.25rem;">
                                        <strong>Options:</strong><br>
                                        @foreach($item->variant_options as $key => $value)
                                            • {{ $key }}: {{ $value }}<br>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div style="margin-left: 1rem; text-align: right;">
                                <p style="color: #374151;">${{ number_format($item->price, 2) }}</p>
                                <p style="font-size: 0.875rem; color: #6b7280;">Qty: {{ $item->quantity }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top: 1rem; border-top: 1px solid #e5e7eb; padding-top: 1rem;">
                    <div style="display: flex; justify-content: space-between; font-weight: 700; color: #111827;">
                        <span>Total</span>
                        <span>${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Shipping Info -->
            <div style="margin-bottom: 2rem;">
                <h2 style="font-size: 1.125rem; font-weight: 700; color: #111827; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem; margin-bottom: 1rem;">
                    Shipping Information
                </h2>
                <div style="background-color: #f9fafb; padding: 1rem; border-radius: 0.5rem;">
                    <p style="font-weight: 500;">{{ $order->full_name }}</p>
                    <p style="color: #374151;">{{ $order->address }}</p>
                    <p style="color: #374151;">{{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}</p>
                </div>
            </div>

            <!-- Footer -->
            <div style="border-top: 1px solid #e5e7eb; padding-top: 1.5rem; text-align: center;">
                <p style="color: #4b5563; font-size: 0.875rem;">If you have any questions, please contact our support team.</p>
                <div style="margin-top: 1rem;">
                    <a href="#" style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: #4f46e5; color: #ffffff; font-weight: 500; font-size: 0.875rem; border-radius: 0.375rem; text-decoration: none; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);">
                        Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
