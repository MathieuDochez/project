<div>
    <x-dk.basket-log/>

    @if(Cart::isEmpty())
        <p>Your basket is empty.</p>
    @else
        <table>
            <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach(Cart::items() as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                    <td>
                        <button wire:click="decreaseQty({{ $item->id }})">-</button>
                        <button wire:click="increaseQty({{ $item->id }})">+</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p>Total: {{ Cart::total() }}</p>
        @if(auth()->check())
            <button wire:click="placeOrder()">Place Order</button>
        @else
            <p>Please login to place an order.</p>
        @endif
    @endif
</div>
