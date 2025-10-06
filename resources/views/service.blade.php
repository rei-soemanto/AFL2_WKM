@extends('layout.mainlayout')

@section('name', 'Service')
@section('content')
<main class="font-sans" style="background-image: url('img/aboutpagebg.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center; background-attachment: fixed;">
    <div class="bg-[#0f0f0f98] py-16 px-8 md:py-24 md:px-20 lg:px-40">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold text-center mb-16 text-white">Our Expert <span class="text-[#e0bb35]">Services</span></h1>
            
            <div class="space-y-16">
                <?php if (empty($service_data)): ?>
                    <div class="text-center text-white bg-black/50 p-10 rounded-lg">
                        <p>No services are currently listed. Please check back later.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($service_data as $category_data): ?>
                    <div class="bg-white/95 p-8 md:p-10 rounded-lg shadow-2xl">
                        <h2 class="text-3xl md:text-4xl font-bold mb-2 text-[#0F0F0F]"><?php echo htmlspecialchars($category_data['category_name']); ?></h2>
                        <p class="text-lg text-gray-600 mb-8"><?php echo htmlspecialchars($category_data['category_description']); ?></p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <?php foreach ($category_data['services'] as $service): ?>
                                <div class="border-l-4 border-[#e0bb35] pl-4">
                                    <h3 class="text-xl font-bold text-gray-800"><?php echo htmlspecialchars($service['name']); ?></h3>
                                    <p class="text-gray-700"><?php echo htmlspecialchars($service['description']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
@endsection