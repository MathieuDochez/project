<x-project-layout>
    <x-slot name="subtitle"></x-slot>

    <div class="space-y-16">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-green-600 via-green-700 to-green-800 rounded-3xl overflow-hidden shadow-2xl">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, white 2px, transparent 2px); background-size: 50px 50px;"></div>
            </div>

            <div class="relative px-8 py-16 lg:py-24 text-white">
                <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Hero Content -->
                    <div class="text-center lg:text-left">
                        <div class="flex items-center justify-center lg:justify-start mb-6">
                            <x-dk.logo class="w-16 h-16 mr-4"/>
                            <div class="text-left">
                                <h1 class="text-2xl font-bold">The Dog Kennel</h1>
                                <p class="text-green-200 text-sm">Premium Care & Products</p>
                            </div>
                        </div>

                        <h2 class="text-4xl lg:text-6xl font-bold mb-6 leading-tight">
                            Where Every Dog is
                            <span class="text-yellow-300">Family</span>
                        </h2>

                        <p class="text-xl text-green-100 mb-8 leading-relaxed">
                            Welcome to The Dog Kennel, your trusted partner in providing exceptional care and premium products for your beloved companion. We're passionate about dogs and dedicated to their happiness and wellbeing.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="{{ route('shop') }}"
                               class="inline-flex items-center px-8 py-4 bg-yellow-400 hover:bg-yellow-300 text-green-800 font-bold rounded-xl transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <x-heroicon-o-shopping-bag class="w-5 h-5 mr-2"/>
                                Shop Now
                            </a>
                            <a href="{{ route('dog-gallery') }}"
                               class="inline-flex items-center px-8 py-4 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-semibold rounded-xl transition duration-200 border border-white/30">
                                <x-heroicon-o-photo class="w-5 h-5 mr-2"/>
                                Meet Our Dogs
                            </a>
                        </div>
                    </div>

                    <!-- Hero Image/Stats -->
                    <div class="relative">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                            <div class="text-center mb-6">
                                <h3 class="text-2xl font-bold mb-2">Trusted by Dog Lovers</h3>
                                <p class="text-green-200">Join our growing community</p>
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-yellow-300 mb-2">500+</div>
                                    <div class="text-green-200 text-sm">Happy Dogs</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-yellow-300 mb-2">24/7</div>
                                    <div class="text-green-200 text-sm">Care Available</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-yellow-300 mb-2">5★</div>
                                    <div class="text-green-200 text-sm">Average Rating</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-yellow-300 mb-2">10+</div>
                                    <div class="text-green-200 text-sm">Years Experience</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Our Premium Services</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    From boarding to grooming, training to walking - we provide comprehensive care
                    that keeps your furry friend happy, healthy, and loved.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Dog Boarding -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-green-200 transition duration-300">
                        <x-heroicon-o-home class="w-8 h-8 text-green-600"/>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Dog Boarding</h3>
                    <p class="text-gray-600 mb-6">Safe, comfortable overnight stays with personalized care and attention for your peace of mind.</p>
                    <div class="flex items-center text-green-600 font-semibold">
                        <span>Learn More</span>
                        <x-heroicon-o-arrow-right class="w-4 h-4 ml-2 group-hover:translate-x-1 transition duration-200"/>
                    </div>
                </div>

                <!-- Dog Grooming -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-green-200 transition duration-300">
                        <x-heroicon-o-sparkles class="w-8 h-8 text-green-600"/>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Dog Grooming</h3>
                    <p class="text-gray-600 mb-6">Professional grooming services to keep your dog looking and feeling their absolute best.</p>
                    <div class="flex items-center text-green-600 font-semibold">
                        <span>Learn More</span>
                        <x-heroicon-o-arrow-right class="w-4 h-4 ml-2 group-hover:translate-x-1 transition duration-200"/>
                    </div>
                </div>

                <!-- Dog Training -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-green-200 transition duration-300">
                        <x-heroicon-o-academic-cap class="w-8 h-8 text-green-600"/>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Dog Training</h3>
                    <p class="text-gray-600 mb-6">Expert training programs to help your dog learn good behavior and strengthen your bond.</p>
                    <div class="flex items-center text-green-600 font-semibold">
                        <span>Learn More</span>
                        <x-heroicon-o-arrow-right class="w-4 h-4 ml-2 group-hover:translate-x-1 transition duration-200"/>
                    </div>
                </div>

                <!-- Dog Walking -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-green-200 transition duration-300">
                        <x-heroicon-o-map class="w-8 h-8 text-green-600"/>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Dog Walking</h3>
                    <p class="text-gray-600 mb-6">Regular exercise and outdoor adventures to keep your dog active, social, and healthy.</p>
                    <div class="flex items-center text-green-600 font-semibold">
                        <span>Learn More</span>
                        <x-heroicon-o-arrow-right class="w-4 h-4 ml-2 group-hover:translate-x-1 transition duration-200"/>
                    </div>
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section class="bg-gray-50 rounded-3xl p-8 lg:p-16">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Premium Products</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Carefully curated, high-quality products to enhance your dog's comfort, health, and happiness.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Dog Food -->
                    <div class="bg-white rounded-xl p-6 text-center shadow-lg hover:shadow-xl transition duration-300">
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-heroicon-o-gift class="w-6 h-6 text-yellow-600"/>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">Premium Dog Food</h3>
                        <p class="text-gray-600 text-sm">Nutritious, delicious meals for optimal health</p>
                    </div>

                    <!-- Dog Toys -->
                    <div class="bg-white rounded-xl p-6 text-center shadow-lg hover:shadow-xl transition duration-300">
                        <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-heroicon-o-puzzle-piece class="w-6 h-6 text-pink-600"/>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">Interactive Toys</h3>
                        <p class="text-gray-600 text-sm">Fun and engaging toys for mental stimulation</p>
                    </div>

                    <!-- Dog Beds -->
                    <div class="bg-white rounded-xl p-6 text-center shadow-lg hover:shadow-xl transition duration-300">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-heroicon-o-moon class="w-6 h-6 text-blue-600"/>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">Comfort Beds</h3>
                        <p class="text-gray-600 text-sm">Cozy, supportive beds for perfect rest</p>
                    </div>

                    <!-- Dog Accessories -->
                    <div class="bg-white rounded-xl p-6 text-center shadow-lg hover:shadow-xl transition duration-300">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-heroicon-o-star class="w-6 h-6 text-purple-600"/>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">Stylish Accessories</h3>
                        <p class="text-gray-600 text-sm">Collars, leashes, and fashion items</p>
                    </div>
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('shop') }}"
                       class="inline-flex items-center px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <x-heroicon-o-shopping-bag class="w-5 h-5 mr-2"/>
                        Browse All Products
                    </a>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-gray-800 mb-6">About The Dog Kennel</h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        At The Dog Kennel, we are passionate about dogs and understand the special bond between you and your furry family member. Our team of experienced professionals is dedicated to providing the highest quality care and products for your beloved pet.
                    </p>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Whether you need a safe, loving environment for your dog while you're away, high-quality products to keep them happy and healthy, or professional services to enhance their wellbeing, we've got you covered with personalized care and attention.
                    </p>

                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <x-heroicon-o-shield-check class="w-5 h-5 text-green-600"/>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800">Licensed & Insured</div>
                                <div class="text-gray-600 text-sm">Fully certified facility</div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <x-heroicon-o-heart class="w-5 h-5 text-green-600"/>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800">Passionate Team</div>
                                <div class="text-gray-600 text-sm">Dog lovers at heart</div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200">
                        <x-heroicon-o-chat-bubble-left-right class="w-5 h-5 mr-2"/>
                        Get in Touch
                    </a>
                </div>

                <div class="relative">
                    <div class="bg-green-100 rounded-2xl p-8 relative overflow-hidden">
                        <div class="absolute top-4 right-4 text-green-600">
                            <x-dk.logo class="w-20 h-20 opacity-20"/>
                        </div>
                        <div class="space-y-6">
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-gray-800">Experience</span>
                                    <span class="text-green-600 font-bold">10+ Years</span>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-gray-800">Happy Customers</span>
                                    <span class="text-green-600 font-bold">500+</span>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-gray-800">5-Star Reviews</span>
                                    <span class="text-green-600 font-bold">98%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials/Reviews Preview -->
        <section class="bg-gradient-to-r from-green-600 to-green-700 rounded-3xl p-8 lg:p-16 text-white">
            <div class="max-w-6xl mx-auto text-center">
                <h2 class="text-4xl font-bold mb-4">What Dog Owners Say</h2>
                <p class="text-xl text-green-100 mb-12">Don't just take our word for it - hear from our happy customers</p>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                        <div class="flex justify-center mb-4">
                            @for($i = 1; $i <= 5; $i++)
                                <x-heroicon-s-star class="w-5 h-5 text-yellow-400"/>
                            @endfor
                        </div>
                        <p class="text-green-100 mb-4 italic">"The Dog Kennel has been amazing for our Golden Retriever. The staff truly cares about every dog!"</p>
                        <div class="font-semibold">Sarah M.</div>
                    </div>

                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                        <div class="flex justify-center mb-4">
                            @for($i = 1; $i <= 5; $i++)
                                <x-heroicon-s-star class="w-5 h-5 text-yellow-400"/>
                            @endfor
                        </div>
                        <p class="text-green-100 mb-4 italic">"Professional service, clean facilities, and my dog actually gets excited to visit!"</p>
                        <div class="font-semibold">Mike D.</div>
                    </div>

                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                        <div class="flex justify-center mb-4">
                            @for($i = 1; $i <= 5; $i++)
                                <x-heroicon-s-star class="w-5 h-5 text-yellow-400"/>
                            @endfor
                        </div>
                        <p class="text-green-100 mb-4 italic">"High-quality products and exceptional customer service. Highly recommended!"</p>
                        <div class="font-semibold">Lisa K.</div>
                    </div>
                </div>

                <div class="mt-12">
                    <a href="{{ route('reviews') }}"
                       class="inline-flex items-center px-6 py-3 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-semibold rounded-lg transition duration-200 border border-white/30">
                        <x-heroicon-o-chat-bubble-left-ellipsis class="w-5 h-5 mr-2"/>
                        Read All Reviews
                    </a>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="text-center bg-yellow-50 rounded-3xl p-8 lg:p-16 border border-yellow-200">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Ready to Give Your Dog the Best?</h2>
                <p class="text-xl text-gray-600 mb-8">
                    Join hundreds of happy dog owners who trust The Dog Kennel for premium care and products.
                    Your furry friend deserves nothing but the best!
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <x-heroicon-o-phone class="w-5 h-5 mr-2"/>
                        Schedule a Visit
                    </a>
                    <a href="{{ route('shop') }}"
                       class="inline-flex items-center px-8 py-4 bg-yellow-400 hover:bg-yellow-300 text-green-800 font-bold rounded-xl transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <x-heroicon-o-shopping-bag class="w-5 h-5 mr-2"/>
                        Start Shopping
                    </a>
                </div>
            </div>
        </section>
    </div>
</x-project-layout>
