<!-- resources/views/emails/order-failed.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Order Failed</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #fef9c3;">
    <div style="max-width: 600px; margin: 2rem auto; background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); overflow: hidden;">

        <!-- Header -->
        <div style="background-color: #f59e0b; padding: 1rem 1.5rem;">
            <h1 style="font-size: 1.5rem; font-weight: 700; color: #ffffff;">Order Failed</h1>
        </div>

        <!-- Content -->
        <div style="padding: 1.5rem;">
            <p style="color: #374151; margin-bottom: 1.5rem;">
                Hi <strong>{{ $order->full_name }}</strong>, we encountered an issue while processing your order 
                <strong>#{{ $order->order_number }}</strong>.
            </p>

            <p style="color: #6b7280; margin-bottom: 1rem;">
                This may be due to a technical error or a network problem. Please try again after some time.
            </p>

            <div style="text-align: center; margin-top: 2rem;">
                <a href="{{ url('/') }}" style="background-color: #f59e0b; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; font-weight: 500; text-decoration: none;">
                    Retry Order
                </a>
            </div>

            <!-- Footer -->
            <div style="border-top: 1px solid #e5e7eb; padding-top: 1.5rem; margin-top: 2rem; text-align: center;">
                <p style="color: #4b5563; font-size: 0.875rem;">Need help? Contact our support team for assistance.</p>
            </div>
        </div>
    </div>
</body>
</html>
