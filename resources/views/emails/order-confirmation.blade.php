<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f5f5f5; }
        .container { max-width: 600px; margin: 20px auto; background: white; padding: 20px; }
        h2 { color: #333; margin-top: 0; }
        .info { background: #f9f9f9; padding: 15px; margin: 15px 0; }
        .info-row { display: flex; justify-content: space-between; margin: 8px 0; }
        .label { font-weight: bold; color: #333; }
        .value { color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Order Confirmation</h2>
        
        <p>Dear {{ $order->customer_name }},</p>
        
        <p>Thank you for your order. Your order has been successfully received and is being processed.</p>
        
        <div class="info">
            <div class="info-row">
                <span class="label">Order ID:</span>
                <span class="value">#{{ $order->id }}</span>
            </div>
            <div class="info-row">
                <span class="label">Order Date:</span>
                <span class="value">{{ $order->created_at->format('M d, Y') }}</span>
            </div>
            <div class="info-row">
                <span class="label">Email:</span>
                <span class="value">{{ $order->email }}</span>
            </div>
            <div class="info-row">
                <span class="label">Phone:</span>
                <span class="value">{{ $order->phone }}</span>
            </div>
        </div>
        
        <h3>Order Items</h3>
        @if(is_array($order->products))
            @foreach($order->products as $product)
                <div class="info-row">
                    <span>{{ $product['name'] ?? 'Product' }} x{{ $product['quantity'] ?? 1 }}</span>
                    <span>Rs {{ number_format($product['price'] ?? 0) }}</span>
                </div>
            @endforeach
        @endif
        
        <div class="info">
            <div class="info-row">
                <span class="label">Total:</span>
                <span class="value" style="font-weight: bold;">Rs {{ number_format($order->total) }}</span>
            </div>
        </div>
        
        <h3>Shipping Address</h3>
        <div class="info">
            <p>{{ $order->address }}<br>
            {{ $order->city }}, {{ $order->state }} {{ $order->zip }}</p>
        </div>
        
        <p>Our team will contact you shortly to confirm your order.</p>
        
        <p>Best regards,<br>Almukhtar Perfume</p>
    </div>
</body>
</html>
