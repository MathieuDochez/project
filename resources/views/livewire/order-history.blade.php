<div>
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Manage Orders</h1>

    <!-- Order List Section -->
    <h2 class="text-xl font-semibold text-gray-800 mt-12 mb-4">Order List</h2>
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse bg-white rounded-lg shadow-sm">
            <thead class="bg-gray-200 text-gray-600">
            <tr>
                <th class="py-2 px-4 text-left">Client</th>
                <th class="py-2 px-4 text-left">Total Price</th>
                <th class="py-2 px-4 text-left">Date</th>
            </tr>
            </thead>
            @if(count($orders) > 0)
                <tbody>
                @foreach ($orders as $order)
                    <tr class="border-t hover:bg-gray-100">
                        <td class="py-2 px-4">{{ $order->user ? $order->user->name : 'No User' }}</td>
                        <td class="py-2 px-4">€{{ $order->getTotalPriceAttribute() }}</td>
                        <td class="py-2 px-4">{{ $order->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            @else
                <tr class="border-t hover:bg-gray-100">
                    <td class="py-2 px-4 text-red-700">No orders available at the moment.</td>
                </tr>
            @endif
        </table>
    </div>

    <!-- Pagination Controls -->
    @if($paginate)
        <div>
            {{ $paginate->links() }}
        </div>
    @endif
</div>
