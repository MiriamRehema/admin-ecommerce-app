
@extends('layouts.app')


@section('content')
<section class="bg-gray-50 py-16 px-6 lg:px-20">
    <div class="max-w-7xl mx-auto">
        <!-- About -->
        <h2 class="text-4xl font-bold text-gray-800 mb-6">Who We Are</h2>
        <p class="text-lg text-gray-700 leading-relaxed mb-8">
            At <strong>Afrinet Telecom</strong>, we don’t just send messages — we help businesses build real connections. For over 12 years, we’ve worked alongside startups, SMEs, and large organizations, providing easy-to-use <strong>bulk SMS</strong> and <strong>customer feedback tools</strong> that drive engagement and growth. Whether you're a local brand or a national enterprise, we help you reach your customers where they are — fast, reliably, and affordably.
        </p>

        <!-- Mission & Vision -->
        <div class="grid md:grid-cols-2 gap-12 mb-14">
            <div>
                <h3 class="text-2xl font-semibold text-green-700 mb-3">Our Mission</h3>
                <p class="text-gray-700">
                    To enable African businesses to communicate better, grow stronger customer relationships, and make smarter decisions through our trusted SMS and survey platforms.
                </p>
            </div>
            <div>
                <h3 class="text-2xl font-semibold text-green-700 mb-3">Our Vision</h3>
                <p class="text-gray-700">
                    To lead Africa in digital communication tools, making business-to-customer interactions simpler, faster, and more human.
                </p>
            </div>
        </div>

        <!-- Core Values -->
        <h3 class="text-2xl font-semibold text-green-700 mb-4">What We Stand For</h3>
        <ul class="list-disc list-inside text-gray-700 mb-12 space-y-2">
            <li><strong>Professionalism:</strong> We deliver quality work, on time, every time.</li>
            <li><strong>Integrity:</strong> We believe in honesty, transparency, and earning our clients’ trust.</li>
            <li><strong>Creativity:</strong> We think outside the box, bringing fresh ideas to help your business grow.</li>
        </ul>

        <!-- Testimonials -->
        <h3 class="text-2xl font-semibold text-green-700 mb-6">What Our Clients Say</h3>
        <div class="space-y-8">
            <div class="border-l-4 border-green-500 pl-4 italic text-gray-600">
                “Switching to Afrinet Telecom was a game-changer. Their SMS platform is reliable, and the support team actually listens.”<br>
                <span class="block font-bold text-gray-800 mt-2">– James O., Horizon Logistics</span>
            </div>
            <div class="border-l-4 border-green-500 pl-4 italic text-gray-600">
                “Patient reminders used to be a nightmare. Afrinet made it simple — now we’re more efficient and patients are happier.”<br>
                <span class="block font-bold text-gray-800 mt-2">– Dr. Amina K., MedCare Hospital</span>
            </div>
            <div class="border-l-4 border-green-500 pl-4 italic text-gray-600">
                “They really understand small businesses. Their tools are simple, powerful, and actually affordable.”<br>
                <span class="block font-bold text-gray-800 mt-2">– Grace N., BrightStart Academy</span>
            </div>
            <div class="border-l-4 border-green-500 pl-4 italic text-gray-600">
                “With Afrinet’s surveys, we discovered insights that helped us redesign our customer service entirely.”<br>
                <span class="block font-bold text-gray-800 mt-2">– David T., FinTrust Bank</span>
            </div>
        </div>
    </div>
</section>
@endsection
