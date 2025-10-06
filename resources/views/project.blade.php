@extends('layout.mainlayout')

@section('name', 'Project')
@section('content')
<main class="bg-[#000000]">
    <div class="font-sans" style="background-image: url('img/logoWKM.jpg'); background-size: 70%; background-repeat: no-repeat; background-position: center; background-attachment: fixed;">
        <div class="bg-[#0f0f0f98] py-16 px-8 md:py-24 md:px-20 lg:px-40">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold text-center mb-16 text-white">Our <span class="text-[#e0bb35]">Projects</span></h1>
                
                <?php if (empty($project_data)): ?>
                    <div class="text-center text-white bg-black/50 p-10 rounded-lg">
                        <p>No projects are currently listed. Please check back later.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($project_data as $category_name => $projects_in_category): ?>
                    <div class="mb-20">
                        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-white"><?php echo htmlspecialchars($category_name); ?></h2>
                        
                        <?php if (count($projects_in_category) > 1): ?>
                            <!-- Carousel for multiple projects -->
                            <div class="relative">
                                <div class="siema-carousel-<?php echo str_replace(' ', '-', strtolower($category_name)); ?> overflow-hidden">
                                    <?php foreach ($projects_in_category as $item): ?>
                                        <div class="px-2">
                                            <a href="project-detail.php?id=<?php echo $item['project_id']; ?>" class="block">
                                                <div class="bg-[#0F0F0F] rounded-lg shadow-2xl p-8 flex flex-col md:flex-row items-center gap-8 h-full">
                                                    <div class="md:w-1/2">
                                                        <img src="<?php echo htmlspecialchars($item['image'] ?? 'https://placehold.co/600x400/1F2937/FFFFFF?text=No+Image'); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="rounded-lg w-full h-64 object-cover shadow-lg">
                                                    </div>
                                                    <div class="text-white md:w-1/2">
                                                        <h3 class="text-2xl font-bold mb-4 text-[#e0bb35]"><?php echo htmlspecialchars($item['name']); ?></h3>
                                                        <p class="text-gray-300"><?php echo htmlspecialchars($item['description']); ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button class="carousel-prev-<?php echo str_replace(' ', '-', strtolower($category_name)); ?> absolute top-1/2 left-0 -translate-y-1/2 bg-white/20 text-white p-3 rounded-full hover:bg-white/40 transition-colors z-10 text-2xl leading-none">&lt;</button>
                                <button class="carousel-next-<?php echo str_replace(' ', '-', strtolower($category_name)); ?> absolute top-1/2 right-0 -translate-y-1/2 bg-white/20 text-white p-3 rounded-full hover:bg-white/40 transition-colors z-10 text-2xl leading-none">&gt;</button>
                            </div>
                        <?php else: ?>
                            <!-- Single project display -->
                            <?php $item = $projects_in_category[0]; ?>
                            <a href="project-detail.php?id=<?php echo $item['project_id']; ?>" class="block">
                                <div class="bg-[#0F0F0F] rounded-lg shadow-2xl p-8 md:p-12 flex flex-col md:flex-row items-center gap-8">
                                    <div class="md:w-1/2">
                                        <img src="<?php echo htmlspecialchars($item['image'] ?? 'https://placehold.co/600x400/1F2937/FFFFFF?text=No+Image'); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="rounded-lg w-full h-auto object-cover shadow-lg">
                                    </div>
                                    <div class="text-white md:w-1/2">
                                        <h3 class="text-3xl font-bold mb-4 text-[#e0bb35]"><?php echo htmlspecialchars($item['name']); ?></h3>
                                        <p class="text-gray-300"><?php echo htmlspecialchars($item['description']); ?></p>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</main>
@endsection