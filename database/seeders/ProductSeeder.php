<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'brand_id' => 1,
                'category_id' => 1,
                'name' => 'PDC TieBox',
                'description' => 'PDC TieBox is a revolutionary, one-stop integrated edge application architecture designed with data processing at its core. It seamlessly combines Edge Computing, HMI Configuration, PLC Programming, and advanced Network Management into a single, powerful platform. By simplifying complex operations and interfacing with existing systems, PDC TieBox delivers efficient, intelligent, and comprehensive application services for the modern industrial landscape.',
                'image' => 'uploads/TieBox Product.png',
                'pdf_path' => 'uploads/pdfs/PDC Tiebox brochure.pdf'
            ],
            [
                'brand_id' => 1,
                'category_id' => 2,
                'name' => 'PDC mini Tiebox',
                'description' => 'PDC miniTieBox is a revolutionary, one-stop integrated edge application architecture designed with data processing at its core. It seamlessly combines Edge Computing, HMI Configuration, PLC Programming, and advanced Network Management into a single, powerful platform. By simplifying complex operations and interfacing with existing systems, PDC miniTieBox delivers efficient, intelligent, and comprehensive application services for the modern industrial landscape.',
                'image' => 'uploads/miniTieBox product.png',
                'pdf_path' => 'uploads/pdfs/PDC mini Tiebox brochure.pdf'
            ],
            [
                'brand_id' => 2,
                'category_id' => 3,
                'name' => 'PDN-LG206-C',
                'description' => 'The PDN-LG206-C is a half-duplex serial server designed to connect your existing RS232 or RS485 equipment to a modern LoRa network. It simplifies wireless adoption by handling the complexities of LoRa communication, allowing your devices to transmit data over vast distances with high interference immunity. Ideal for industrial IoT, smart agriculture, metering, and asset tracking.',
                'image' => 'uploads/PDN-LG206 product image.png',
                'pdf_path' => 'uploads/pdfs/PDN-LG206 brochure.pdf'
            ],
            [
                'brand_id' => 2,
                'category_id' => 3,
                'name' => 'PDN-FQ610',
                'description' => 'The PDN-FQ610 is a powerful wireless client that leverages Swarm ad hoc networking to create a dynamic, self-organizing, and self-repairing network without a central controller. It seamlessly converts between serial (RS232/RS485), Ethernet, and the Swarm wireless network, providing a highly flexible and resilient communication solution. It is perfectly suited for complex, mobile, and large-scale applications such as swarm UAVs, unmanned systems, industrial data links, smart transportation, and the fire Internet of Things.',
                'image' => 'uploads/PDN-FQ610 product image.png',
                'pdf_path' => 'uploads/pdfs/PDN-FQ610 brochure.pdf'
            ]
        ]);
    }
}
