<div class="container mt-4">
    <h1 class="text-center mb-4">Your Shopping Basket</h1>

    <table class="table table-hover table-bordered">
        <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Item Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Total</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($items as $index => $basketItem)
            <tr>
                <th scope="row">{{ $index + 1 }}</th>
                <td>{{ $basketItem->item->name }}</td>
                <td>
                    <div class="input-group">
                        <button wire:click="decreaseQty({{ $basketItem->item_id }})" class="btn btn-danger btn-sm">-</button>
                        <input type="text" class="form-control text-center" value="{{ $basketItem->quantity }}" readonly>
                        <button wire:click="increaseQty({{ $basketItem->item_id }})" class="btn btn-success btn-sm">+</button>
                    </div>
                </td>
                <td>${{ number_format($basketItem->item->price, 2) }}</td>
                <td>${{ number_format($basketItem->item->price * $basketItem->quantity, 2) }}</td>
                <td>
                    <button wire:click="decreaseQty({{ $basketItem->item_id }})" class="btn btn-danger btn-sm">Remove</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Your basket is empty.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    @if($items->isNotEmpty())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <h4>Total: ${{ number_format($items->sum(fn($basketItem) => $basketItem->item->price * $basketItem->quantity), 2) }}</h4>
            <div>
                <button wire:click="emptyBasket" class="btn btn-danger me-2">Empty Basket</button>
                <button wire:click="placeOrder" class="btn btn-primary">Place Order</button>
            </div>
        </div>
    @endif
</div>
