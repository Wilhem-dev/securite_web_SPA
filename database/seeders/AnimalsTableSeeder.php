<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimalsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('animals')->insert([
            [
                'name' => 'Nirvana',
                'type' => 'Chat',
                'image' => 'https://image.over-blog.com/nI31Qk3GThzyFqpiEBrN_3vDimM=/filters:no_upscale()/image%2F0824838%2F20250622%2Fob_a5fd91_aos.jpg',
                'description' => 'Une chatte très joueuse et affectueuse.',
                'created_at' => '2025-12-01 12:12:39',
                'updated_at' => '2025-12-01 12:12:39'
            ],
            [
                'name' => 'Artémis',
                'type' => 'Chat',
                'image' => 'https://i.pinimg.com/736x/9a/09/ed/9a09ed259baad06fb3d3e478d8100f12.jpg',
                'description' => 'Une chatte calme qui aime les câlins.',
                'created_at' => '2025-12-01 12:12:39',
                'updated_at' => '2025-12-01 12:12:39'
            ],
            [
                'name' => 'Coco',
                'type' => 'Oiseau',
                'image' => 'https://images.ctfassets.net/b85ozb2q358o/1479311ac4db6e52f97ecb2d86ac2ead191a9cccda9580bcb75d252b56a02997/ead85c4bdd81410bfe38c59515703292/adoption-d-un-oiseau-et-responsabilite-6.jpg',
                'description' => 'Un petit oiseau sociable et curieux.',
                'created_at' => '2025-12-01 12:12:39',
                'updated_at' => '2025-12-01 12:12:39'
            ],
            [
                'name' => 'Oscar',
                'type' => 'Chien',
                'image' => 'https://cdn.shopify.com/s/files/1/0846/9728/4900/files/Golden_Retriever_croquettes_bio_et_naturelles_480x480.webp?v=1719085406',
                'description' => 'Chien doux et collant.',
                'created_at' => '2025-12-01 12:12:39',
                'updated_at' => '2025-12-01 12:12:39'
            ],
            [
                'name' => 'Flèche',
                'type' => 'Chat',
                'image' => 'https://ziggyfamily.com/cdn/shop/articles/chat-ecaille-de-tortue_36c3ff21-afa9-41d4-8d0f-824d78cf2c1a.png?v=1748335100',
                'description' => 'Chat indépendant mais adorable.',
                'created_at' => '2025-12-01 12:12:39',
                'updated_at' => '2025-12-01 12:12:39'
            ],
            [
                'name' => 'Figaro',
                'type' => 'Chat',
                'image' => 'https://www.peuple-animal.com/wp-content/uploads/2020/11/2476.800.jpg',
                'description' => 'Chat affectueux et joueur.',
                'created_at' => '2025-12-01 12:12:39',
                'updated_at' => '2025-12-01 12:12:39'
            ],
            [
                'name' => 'Mimine',
                'type' => 'Chat',
                'image' => 'https://www.rover.com/blog/wp-content/uploads/2020/03/cat-620030_1920.jpg',
                'description' => 'Chat calme et indépendant.',
                'created_at' => '2025-12-01 12:12:39',
                'updated_at' => '2025-12-01 12:12:39'
            ]
        ]);
    }
}