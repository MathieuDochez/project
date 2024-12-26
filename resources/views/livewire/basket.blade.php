<div>
    @if($totalQty === 0)
        {{-- Cart is empty --}}
        <x-dk.alert type="info" class="w-full">
            Your basket is empty
        </x-dk.alert>
    @else
        {{-- Cart is not empty --}}
        @guest
            <x-dk.alert type="warning" class="w-full" dismissible="false">
                You are not logged in. Please <a href="{{ route('login') }}" class="underline">login</a> or <a
                    href="{{ route('register') }}" class="underline">register</a> to check out.
            </x-dk.alert>
        @endguest
        <x-dk.section>
            <table class="text-center w-full">
                <colgroup>
                    <col class="w-14">
                    <col class="w-20">
                    <col class="w-20">
                    <col class="w-max">
                    <col class="w-24">
                </colgroup>
                <thead>
                <tr class="border-b-4 border-gray-300 text-gray-700 [&>th]:p-2">
                    <th>Qty</th>
                    <th>Price</th>
                    <th></th>
                    <th class="text-left">Item</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach( $items as $item)
                    <tr class="border-b border-gray-300 align-top [&>td]:py-2">
                        {{--<td>{{ $item['qty'] }}</td>--}}
                        <td>€ {{ $item['price'] }}</td>
                        {{--<td>
                            <img src="{{ $item['cover'] }}" alt="{{ $item['item'] . ' - ' . $item['description'] }}"/>
                        </td>--}}
                        <td class="pl-2 text-left">
                            <p class="text-lg font-medium">{{ $item['name'] }}</p>
                            <p class="italic pb-2">{{ $item['description'] }}</p>

                        </td>
                        <td>
                            <div class="border border-gray-300 rounded-md overflow-hidden text-sm grid grid-cols-2
                                [&>*]:p-2 hover:[&>*]:bg-sky-500 hover:[&>*]:text-sky-50 [&>*]:cursor-pointer [&>*]:transition">
                                <p
                                    wire:click="decreaseQty({{ $item['id'] }})"
                                    class="border-r border-gray-300">-1</p>
                                <p
                                    wire:click="increaseQty({{ $item['id'] }})
                            ">+1</p>
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="pt-4 text-left">
                        <x-dk.form.button
                            wire:click="emptyBasket()"
                            color="danger">
                            Empty your basket
                        </x-dk.form.button>
                    </td>
                    <td>

                    </td>
                    <td class="pt-4 text-left">
                        <p class="font-medium">Total:</p>
                        <p>€ {{ $totalPrice }}</p>
                    </td>
                </tr>
                @auth
                    <tr>
                        <td colspan="4"></td>
                        <td class="pt-4 text-left">
                            <x-dk.form.button color="info">
                                Checkout
                            </x-dk.form.button>
                        </td>
                    </tr>
                @endauth
                </tbody>
            </table>
        </x-dk.section>
    @endif
</div>
