@extends('layout.mainlayout')

@section('name', 'About')
@section('content')
<main class="main-background" style="background-image: url('{{ asset('img/aboutpagebg.jpg') }}')">
    <div class="bg-overlay">
        <section id="about" class="py-5">
            <div class="container text-center">
                <h2 class="display-5 fw-bold mb-4 text-white">About <span class="text-gold">PT. Wraksa Kencana Mukti</span></h2>
                <p class="lead text-light mb-5 mx-auto fw-normal" style="max-width: 720px;">
                    Established in 2024, <span class="text-gold">PT. Wraksa Kencana Mukti</span> is a system integrator with deep expertise in the automation industry. We are dedicated to delivering smart, efficient solutions by integrating cutting-edge technology and fostering collaboration.
                </p>

                <div class="row g-5 text-start">
                    <div class="col-md-6">
                        <div class="card h-100 p-4 shadow-sm custom-card">
                            <div class="card-body">
                                <h3 class="card-title h2 fw-bold mb-4 text-gold">Our Vision & Mission</h3>
                                <p class="card-text mb-4">We are committed to becoming a great tree that provides shelter for new ideas, helping them grow and deliver real benefits. We aim to inspire the younger generation to create innovative solutions by leveraging the latest technologies within industrial systems.</p>
                                <p class="card-text">Our core focus is aligning market needs with technological advancements while maintaining cost efficiency to advance Indonesia's industrial sector.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 p-4 shadow-sm custom-card">
                            <div class="card-body">
                                <h3 class="card-title h2 fw-bold mb-4 text-gold">Our History</h3>
                                <ul class="list-unstyled">
                                    <li class="d-flex mb-2"><strong class="me-3" style="min-width: 90px;">Feb 2024:</strong> Established as a System Integrator.</li>
                                    <li class="d-flex mb-2"><strong class="me-3" style="min-width: 90px;">Jul 2024:</strong> Began developing IoT solutions.</li>
                                    <li class="d-flex mb-2"><strong class="me-3" style="min-width: 90px;">Oct 2024:</strong> Launched the flagship product, TieBox.</li>
                                    <li class="d-flex"><strong class="me-3" style="min-width: 90px;">Feb 2025:</strong> Began marketing TieBox in Indonesia.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="products" class="py-5">
            <div class="container">
                <h2 class="display-5 fw-bold text-center mb-5 text-white">Products & Solutions</h2>
                <div class="row g-5 align-items-center">
                    <div class="col-lg-4 text-light">
                        <div class="mb-5">
                            <h3 class="h2 fw-bold mb-3">Solutions</h3>
                            <ul class="fw-semibold list-unstyled">
                                <li class="mb-2">✓ Auto Logging Reporting</li>
                                <li class="mb-2">✓ Automation Design & Development</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="h2 fw-bold mb-3">Spare Parts</h3>
                            <ul class="fw-semibold list-unstyled">
                                <li class="mb-2">✓ PLC Automation Spare Parts</li>
                                <li class="mb-2">✓ Automation Software</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card bg-custom-dark text-white p-4 p-lg-5 shadow-lg rounded-3 custom-card">
                            <div class="card-body">
                                <h3 class="card-title display-6 fw-bold mb-3 text-gold">Flagship Product: TieBox</h3>
                                <p class="lead fw-semibold mb-4">The smart solution for real-time plant data collection.</p>
                                <p class="card-text text-light mb-3">
                                    Built with IoT (Internet of Things) technology, TieBox enables seamless connectivity between your machines, equipment, and cloud systems. It creates a continuous data flow to support predictive maintenance, improve process efficiency, and enable smarter, data-driven decision-making.
                                </p>
                                <p class="card-text text-light">
                                    Gain full visibility over your operations. Monitor temperatures, track machine performance, detect anomalies, and respond instantly to issues through a centralized platform, helping you advance your Industry 4.0 transformation.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="services" class="py-5">
            <div class="container">
                <h2 class="display-5 fw-bold text-center mb-5 text-white">Our Expert Services</h2>
                <div class="row g-5">
                    <div class="col-md-6">
                        <div class="card h-100 p-4 shadow-sm custom-card">
                            <div class="card-body">
                                <h3 class="card-title h2 fw-bold mb-4">1. Maintenance</h3>
                                <ul class="list-unstyled">
                                    <li class="mb-2">✓ PLC & SCADA Programming</li>
                                    <li class="mb-2">✓ System Upgrading (PLC & SCADA)</li>
                                    <li class="mb-2">✓ System Migration (PLC & SCADA)</li>
                                    <li class="mb-2">✓ Custom IoT Solutions</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 p-4 shadow-sm custom-card">
                            <div class="card-body">
                                <h3 class="card-title h2 fw-bold mb-4">2. Engineering</h3>
                                <ul class="list-unstyled">
                                    <li class="mb-2">✓ Electrical Panel Enclosure Maintenance</li>
                                    <li class="mb-2">✓ Operator Station Maintenance</li>
                                    <li class="mb-2">✓ General Equipment Maintenance</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection