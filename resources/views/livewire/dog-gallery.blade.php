<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Our Dogs</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($dogs as $dog)
            <div class="bg-white border rounded-lg shadow hover:shadow-lg">
                <img src="{{ asset('storage/img/' . $dog->name . '.jpg') }}" alt="{{ $dog->name }}" class="w-full h-64 object-cover object-center"/>
                <div class="p-4">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $dog->name }}</h2>
                    <p class="text-sm text-gray-600">Breed: {{ $dog->breed }}</p>
                    <p class="text-sm text-gray-600">Age: {{ $dog->age }} years</p>
                    <p class="text-sm text-gray-600">Color: {{ $dog->color }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="mt-6">
        {{ $dogs->links() }}
    </div>
</div>
