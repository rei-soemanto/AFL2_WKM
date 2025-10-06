@extends('layout.mainlayout')

@section('name', 'About')
@section('content')
<main class="font-sans text-gray-800" style="background-image: url('img/aboutpagebg.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center; background-attachment: fixed;">
    <div class="bg-[#0f0f0f98]">
    <!-- About Section -->
        <section id="about" class="py-10 px-8 md:py-16 md:px-20 lg:px-40">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#ffffff]">About <abbr class="text-[#e0bb35]">PT. Wraksa Kencana Mukti</abbr></h2>
                <p class="text-lg text-gray-100 mb-12 max-w-3xl mx-auto">
                    Established in 2024, <abbr class="text-[#e0bb35]">PT. Wraksa Kencana Mukti</abbr> is a system integrator with deep expertise in the automation industry. We are dedicated to delivering smart, efficient solutions by integrating cutting-edge technology and fostering collaboration.
                </p>

                <div class="grid md:grid-cols-2 gap-12 text-left">
                    <!-- Vision & Mission -->
                    <div class="visionmission bg-white p-8 rounded-lg shadow-md transition-all duration-300">
                        <h3 class="text-2xl font-bold mb-4 text-[#e0bb35]">Our Vision & Mission</h3>
                        <p class="mb-4">We are committed to becoming a great tree that provides shelter for new ideas, helping them grow and deliver real benefits. We aim to inspire the younger generation to create innovative solutions by leveraging the latest technologies within industrial systems.</p>
                        <p>Our core focus is aligning market needs with technological advancements while maintaining cost efficiency to advance Indonesia's industrial sector.</p>
                    </div>
                    <!-- Company History -->
                    <div class="history bg-white p-8 rounded-lg shadow-md transition-all duration-300">
                        <h3 class="text-2xl font-bold mb-4 text-[#e0bb35]">Our History</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start"><span class="font-bold text-[#0F0F0F] w-32">Feb 2024:</span> Established as a System Integrator.</li>
                            <li class="flex items-start"><span class="font-bold text-[#0F0F0F] w-32">Jul 2024:</span> Began developing IoT solutions.</li>
                            <li class="flex items-start"><span class="font-bold text-[#0F0F0F] w-32">Oct 2024:</span> Launched the flagship product, TieBox.</li>
                            <li class="flex items-start"><span class="font-bold text-[#0F0F0F] w-32">Feb 2025:</span> Began marketing TieBox in Indonesia.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section id="products" class="py-10 px-8 md:py-16 md:px-20 lg:px-40">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-[#FFFFFF]">Products & Solutions</h2>
                <div class="grid lg:grid-cols-3 gap-10 items-start">
                    <!-- General Products -->
                    <div class="space-y-8">
                        <div>
                            <h3 class="text-2xl font-bold mb-3 text-[#FFFFFF]">Solutions</h3>
                            <ul class="list-disc list-inside space-y-2 text-gray-100">
                                <li>Auto Logging Reporting</li>
                                <li>Automation Design & Development</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-3 text-[#FFFFFF]">Spare Parts</h3>
                            <ul class="list-disc list-inside space-y-2 text-gray-100">
                                <li>PLC Automation Spare Parts</li>
                                <li>Automation Software</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Flagship Product: TieBox -->
                    <div class="tiebox lg:col-span-2 bg-[#0F0F0F] text-white p-8 rounded-lg shadow-xl transition-all duration-300">
                        <h3 class="text-3xl font-bold mb-4 text-[#e0bb35]">Flagship Product: TieBox</h3>
                        <p class="text-lg font-semibold mb-4">The smart solution for real-time plant data collection.</p>
                        <p class="text-gray-100 mb-4">
                            Built with IoT (Internet of Things) technology, TieBox enables seamless connectivity between your machines, equipment, and cloud systems. It creates a continuous data flow to support predictive maintenance, improve process efficiency, and enable smarter, data-driven decision-making.
                        </p>
                        <p class="text-gray-100">
                            Gain full visibility over your operations. Monitor temperatures, track machine performance, detect anomalies, and respond instantly to issues through a centralized platform, helping you advance your Industry 4.0 transformation.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="py-10 px-8 md:py-16 md:px-20 lg:px-40">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-[#FFFFFF]">Our Expert Services</h2>
                <div class="grid md:grid-cols-2 gap-10">
                    <!-- Maintenance Services -->
                    <div class="maintenance bg-white p-8 rounded-lg shadow-md transition-all duration-300">
                        <h3 class="text-2xl font-bold mb-4">1. Maintenance</h3>
                        <ul class="list-disc list-inside space-y-2 text-gray-800">
                            <li>PLC & SCADA Programming</li>
                            <li>System Upgrading (PLC & SCADA)</li>
                            <li>System Migration (PLC & SCADA)</li>
                            <li>Custom IoT Solutions</li>
                        </ul>
                    </div>
                    <!-- Engineering Services -->
                    <div class="engineering bg-white p-8 rounded-lg shadow-md transition-all duration-300">
                        <h3 class="text-2xl font-bold mb-4">2. Engineering</h3>
                        <ul class="list-disc list-inside space-y-2 text-gray-800">
                            <li>Electrical Panel Enclosure Maintenance</li>
                            <li>Operator Station Maintenance</li>
                            <li>General Equipment Maintenance</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<script>
    $(document).ready(function () {
        $(".visionmission, .history, .tiebox, .maintenance, .engineering").hover(
            function () {
                $(this).addClass("shadow-2xl scale-[1.05]").removeClass("shadow-md");
            },
            function () {
                $(this).removeClass("shadow-2xl scale-[1.05]").addClass("shadow-md");
            }
        );

        $('a[href^="#"]').on('click', function(event) {
            var target = $(this.getAttribute('href'));
            if( target.length ) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top
                }, 800);
            }
        });
    });
</script>
@endsection