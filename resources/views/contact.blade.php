<x-project-layout>
    <x-slot name="title">Contact Us</x-slot>
    <x-slot name="subtitle"></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Office Information Section -->
                <div class="mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Our Office</h3>
                    <p class="text-gray-600">Kleinhoefstraat 4, 2440 Geel</p>
                    <p class="text-gray-600">Phone: (123) 456-7890</p>
                    <p class="text-gray-600">Email: info@example.com</p>
                </div>

                <div class="mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">About Us</h3>
                    <p class="text-gray-600">
                        At <strong>Our Company</strong>, we believe in delivering exceptional experiences to our clients. Founded in 2010, our team of passionate professionals has been dedicated to providing high-quality services with a focus on integrity, creativity, and customer satisfaction. Over the years, we've had the privilege of working with a diverse range of clients, helping them achieve their goals with innovative solutions and personalized attention.
                    </p>
                    <p class="text-gray-600 mt-4">
                        Our mission is to make a positive impact on the businesses and communities we serve. We value collaboration, transparency, and continuous improvement, striving to exceed expectations in everything we do. Whether you’re looking for expert advice, reliable service, or a team that truly understands your needs, we’re here to help.
                    </p>
                    <p class="text-gray-600 mt-4">
                        Located in the heart of Geel, we’re always open to new ideas and opportunities. Feel free to reach out to us for any inquiries, suggestions, or simply to say hello. We look forward to working with you!
                    </p>
                </div>

                <!-- Map Section -->
                <div class="mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Find Us Here</h3>
                    <div class="relative overflow-hidden pb-[56.25%] mb-4 rounded-lg shadow-lg">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7749.780630994091!2d4.958026512381927!3d51.1618776376221!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c14c011b4bcb87%3A0xb5b970e9f2a6ce42!2sThomas%20More%20-%20Campus%20Geel!5e1!3m2!1snl!2sbe!4v1734525717096!5m2!1snl!2sbe"
                                width="100%" height="100%" style="position: absolute; top: 0; left: 0; border: 0;" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                {{--<div>
                    <h3 class="text-2xl font-semibold mb-4">Contact Form</h3>
                    @livewire('contact-form')
                </div>--}}
            </div>
        </div>
    </div>
</x-project-layout>
