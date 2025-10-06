@extends('layout.mainlayout')

@section('name', 'Product')
@section('content')
<div class="flex bg-[#000000]">
    <div id="main-content" class="flex-1 transition-all duration-300 ease-in-out">
        <main>
            <div class="font-sans" style="background-image: url('{{ asset('img/logoWKM.jpg') }}'); background-size: 70%; background-repeat: no-repeat; background-position: center; background-attachment: fixed;">
                <div class="bg-[#0f0f0f98] py-16 px-8 md:py-24 md:px-20 lg:px-40">
                    <div class="max-w-7xl mx-auto">
                        <h1 class="text-4xl md:text-5xl font-bold text-center mb-16 text-white">Our Innovative <span class="text-[#e0bb35]">Products & Solutions</span></h1>
                        
                        <?php if (empty($product_data)): ?>
                            <div class="text-center text-white bg-black/50 p-10 rounded-lg">
                                <p>No products are currently listed. Please check back later.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($product_data as $category_name => $products_in_category): ?>
                            <div class="mb-20">
                                <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-white"><?php echo htmlspecialchars($category_name); ?></h2>
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                    <?php foreach ($products_in_category as $item): ?>
                                        <a href="product-detail.php?id=<?php echo $item['product_id']; ?>" class="block h-full product-card" data-name="<?php echo strtolower(htmlspecialchars($item['name'])); ?>" data-category="<?php echo strtolower(htmlspecialchars($item['second_category_name'])); ?>">
                                            <div class="bg-black/90 p-6 rounded-lg shadow-lg flex flex-col md:flex-row gap-6 h-full hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                                                <div class="flex-1">
                                                    <p class="text-sm font-semibold text-white mb-2"><?php echo htmlspecialchars($item['second_category_name']); ?></p>
                                                    <h3 class="text-2xl font-bold mb-2 text-[#e0bb35]"><?php echo htmlspecialchars($item['name']); ?></h3>
                                                    <p class="text-white text-sm"><?php echo htmlspecialchars($item['description']); ?></p>
                                                </div>
                                                <div class="md:w-2/5 flex-shrink-0">
                                                    <img src="<?php echo htmlspecialchars($item['image'] ?? 'https://placehold.co/600x400/CCCCCC/FFFFFF?text=No+Image'); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="rounded-lg w-full h-48 object-contain">
                                                </div>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection