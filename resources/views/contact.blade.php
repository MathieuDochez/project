<x-project-layout>
    <x-slot name="title">Contact Us</x-slot>
    <x-slot name="subtitle">Get in touch with The Dog Kennel</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section with Green Accent -->
            <div class="bg-gradient-to-r from-[#617457] to-[#4a5a41] rounded-lg shadow-xl mb-8 p-8 text-white">
                <div class="text-center">
                    <h2 class="text-3xl font-bold mb-4">We'd Love to Hear From You!</h2>
                    <p class="text-lg opacity-90">Whether you have questions about our services, want to schedule a visit, or just want to say hello to our furry friends, we're here to help.</p>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Contact Information -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-3">
                        <span class="text-[#617457]">📍</span> Our Information
                    </h3>

                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="bg-[#617457]/10 p-3 rounded-full">
                                <svg class="h-6 w-6 text-[#617457]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Address</h4>
                                <p class="text-gray-600">Kleinhoefstraat 4, 2440 Geel</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-[#617457]/10 p-3 rounded-full">
                                <svg class="h-6 w-6 text-[#617457]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Phone</h4>
                                <p class="text-gray-600">(123) 456-7890</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-[#617457]/10 p-3 rounded-full">
                                <svg class="h-6 w-6 text-[#617457]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Email</h4>
                                <p class="text-gray-600">info@example.com</p>
                            </div>
                        </div>
                    </div>

                    <!-- About Us Section with Alpine.js Toggle -->
                    <div x-data="{ isOpen: false }" class="mt-8 pt-6 border-t border-gray-200">
                        <h4 @click="isOpen = !isOpen" class="text-xl font-semibold text-gray-800 mb-4 cursor-pointer flex items-center justify-between hover:text-[#617457] transition-colors">
                            <span>About The Dog Kennel</span>
                            <svg class="h-5 w-5 transform transition-transform" :class="isOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </h4>
                        <div x-show="isOpen" x-transition.duration.300ms class="text-gray-600 space-y-4">
                            <p>
                                At <strong class="text-[#617457]">The Dog Kennel</strong>, we believe in delivering exceptional experiences to our furry clients and their families. Founded in 2010, our team of passionate professionals has been dedicated to providing high-quality pet care services with a focus on integrity, creativity, and customer satisfaction.
                            </p>
                            <p>
                                Our mission is to make a positive impact on the pets and communities we serve. We value collaboration, transparency, and continuous improvement, striving to exceed expectations in everything we do. Whether you're looking for expert advice, reliable service, or a team that truly understands your pet's needs, we're here to help.
                            </p>
                            <p>
                                Located in the heart of Geel, we're always open to new ideas and opportunities. Feel free to reach out to us for any inquiries, suggestions, or simply to say hello. We look forward to working with you and your beloved companion!
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-3">
                        <span class="text-[#617457]">✉️</span> Send us a Message
                    </h3>
                    @livewire('contact-form')
                </div>
            </div>

            <!-- Map Section -->
            <div class="mt-8 bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-3">
                    <span class="text-[#617457]">🗺️</span> Find Us Here
                </h3>
                <div class="relative overflow-hidden pb-[56.25%] mb-4 rounded-lg shadow-lg border-4 border-[#617457]/20">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7749.780630994091!2d4.958026512381927!3d51.1618776376221!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c14c011b4bcb87%3A0xb5b970e9f2a6ce42!2sThomas%20More%20-%20Campus%20Geel!5e1!3m2!1snl!2sbe!4v1734525717096!5m2!1snl!2sbe"
                            width="100%" height="100%" style="position: absolute; top: 0; left: 0; border: 0;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <p class="text-center text-gray-600 italic">Visit us at Thomas More Campus in the beautiful city of Geel!</p>
            </div>
        </div>
    </div>
</x-project-layout>
