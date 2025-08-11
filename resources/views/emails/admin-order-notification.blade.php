<h1>🔔 New Order Received - Order #{{ $order->id }}</h1>

<h2>📋 Order Details</h2>
<ul>
    <li><strong>Order ID:</strong> #{{ $order->id }}</li>
    <li><strong>Customer:</strong> {{ $customer->name }} ({{ $customer->email }})</li>
    <li><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}</li>
    <li><strong>Total Value:</strong> €{{ number_format($order->getTotalPriceAttribute(), 2) }}</li>
</ul>

<h2>🛒 Ordered Items</h2>
<table border="1" style="border-collapse: collapse; width: 100%;">
    <thead>
    <tr style="background-color: #f8f9fa;">
        <th style="padding: 10px; text-align: left;">Item</th>
        <th style="padding: 10px; text-align: center;">Qty</th>
        <th style="padding: 10px; text-align: right;">Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orderItems as $item)
        <tr>
            <td style="padding: 8px;">{{ $item['name'] }} - {{ $item['description'] }}</td>
            <td style="padding: 8px; text-align: center;">{{ $item['qty'] }}</td>
            <td style="padding: 8px; text-align: right;">€{{ number_format($item['price'], 2) }}</td>
        </tr>
    @endforeach
    <tr style="background-color: #f8f9fa; font-weight: bold;">
        <td style="padding: 10px;" colspan="2">Total</td>
        <td style="padding: 10px; text-align: right;">€{{ number_format($order->getTotalPriceAttribute(), 2) }}</td>
    </tr>
    </tbody>
</table>

@if(!empty($shippingDetails))
    <h2>🚚 Shipping Information</h2>
    <p>
        <strong>{{ $customer->name }}</strong><br>
        {{ $shippingDetails['address'] }}<br>
        {{ $shippingDetails['zip'] }} {{ $shippingDetails['city'] }}<br>
        {{ $shippingDetails['country'] }}
    </p>
    @if(!empty($shippingDetails['notes']))
        <p><strong>Notes:</strong> {{ $shippingDetails['notes'] }}</p>
    @endif
@endif

@if(!empty($backorderItems))
    <h2>⚠️ Backorder Alert</h2>
    <p>The following items are out of stock:</p>
    <ul>
        @foreach($backorderItems as $item)
            <li style="color: red;">{{ $item }}</li>
        @endforeach
    </ul>
@endif

<hr>
<p><em>This is an automated admin notification from The Dog Kennel.</em></p>
<p><em>Email sent: {{ now()->format('M d, Y H:i:s T') }}</em></p>
