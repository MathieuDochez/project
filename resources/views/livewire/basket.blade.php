<div>
    <x-dk.basket-log/>

    @if($items->isEmpty())
        <p>Your basket is empty.</p>
    @else
        <table>
            <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $basketItem)
                <tr>
                    <td>{{ $basketItem->item->name }}</td>
                    <td>{{ $basketItem->quantity }}</td>
                    <td>{{ $basketItem->item->price }}</td>
                    <td>
                        <button wire:click="decreaseQty({{ $basketItem->item_id }})">-</button>
                        <button wire:click="increaseQty({{ $basketItem->item_id }})">+</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p>Total: ${{ $items->sum(fn($i) => $i->item->price * $i->quantity) }}</p>

        @if(auth()->check())
            <button wire:click="placeOrder()">Place Order</button>
        @else
            <p>Please login to place an order.</p>
        @endif
    @endif
</div>
