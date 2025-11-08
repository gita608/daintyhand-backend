<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductFeature;
use App\Models\ProductImage;
use App\Models\ProductSpecification;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'title' => 'Floral Wedding Invitation Set',
                'description' => 'Complete wedding suite with RSVP cards, elegant floral designs, and premium cardstock.',
                'price' => 10000.00,
                'image' => 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=500',
                'category' => 'Invitations',
                'rating' => 5,
                'reviews_count' => 24,
                'in_stock' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=500',
                    'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=500',
                ],
                'features' => [
                    'Premium 300gsm cardstock',
                    'Hand-painted watercolor florals',
                    'Matching RSVP cards included',
                ],
                'specifications' => [
                    'Size' => '5" x 7"',
                    'Paper Weight' => '300gsm',
                    'Finish' => 'Matte',
                ],
            ],
            [
                'title' => 'Vintage Botanical Wall Art',
                'description' => 'Beautiful botanical prints perfect for home decoration, printed on high-quality paper.',
                'price' => 2500.00,
                'image' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=500',
                'category' => 'Wall Art',
                'rating' => 4,
                'reviews_count' => 18,
                'in_stock' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=500',
                ],
                'features' => [
                    'Premium paper quality',
                    'Fade-resistant inks',
                    'Ready to frame',
                ],
                'specifications' => [
                    'Size' => 'A4',
                    'Paper Type' => 'Art Paper',
                ],
            ],
            [
                'title' => 'Handmade Paper Craft Kit',
                'description' => 'Complete kit for creating beautiful paper crafts with all materials included.',
                'price' => 1500.00,
                'image' => 'https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?w=500',
                'category' => 'Paper Crafts',
                'rating' => 5,
                'reviews_count' => 32,
                'in_stock' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?w=500',
                ],
                'features' => [
                    'All materials included',
                    'Step-by-step guide',
                    'Eco-friendly paper',
                ],
                'specifications' => [
                    'Kit Contents' => 'Paper, glue, scissors, guide',
                ],
            ],
            [
                'title' => 'Custom Photo Album',
                'description' => 'Premium photo album with custom cover design and acid-free pages.',
                'price' => 3500.00,
                'image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=500',
                'category' => 'Albums',
                'rating' => 5,
                'reviews_count' => 15,
                'in_stock' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=500',
                ],
                'features' => [
                    'Acid-free pages',
                    'Custom cover design',
                    'Holds 100 photos',
                ],
                'specifications' => [
                    'Pages' => '50',
                    'Size' => '8" x 10"',
                ],
            ],
            [
                'title' => 'Elegant Greeting Cards Set',
                'description' => 'Set of 12 beautifully designed greeting cards for all occasions.',
                'price' => 800.00,
                'image' => 'https://images.unsplash.com/photo-1586773860418-d37222d8fce3?w=500',
                'category' => 'Cards',
                'rating' => 4,
                'reviews_count' => 28,
                'in_stock' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1586773860418-d37222d8fce3?w=500',
                ],
                'features' => [
                    'Set of 12 cards',
                    'Matching envelopes',
                    'Blank inside',
                ],
                'specifications' => [
                    'Quantity' => '12 cards',
                    'Size' => '5" x 7"',
                ],
            ],
            [
                'title' => 'Party Decoration Pack',
                'description' => 'Complete party decoration set with banners, streamers, and confetti.',
                'price' => 2000.00,
                'image' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=500',
                'category' => 'Decorations',
                'rating' => 4,
                'reviews_count' => 20,
                'in_stock' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=500',
                ],
                'features' => [
                    'Complete decoration set',
                    'Colorful designs',
                    'Easy to set up',
                ],
                'specifications' => [
                    'Contents' => 'Banners, streamers, confetti',
                ],
            ],
            [
                'title' => 'Leather Bound Journal',
                'description' => 'Premium leather-bound journal with lined pages, perfect for writing.',
                'price' => 1800.00,
                'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=500',
                'category' => 'Journals',
                'rating' => 5,
                'reviews_count' => 22,
                'in_stock' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=500',
                ],
                'features' => [
                    'Genuine leather cover',
                    'Lined pages',
                    '200 pages',
                ],
                'specifications' => [
                    'Pages' => '200',
                    'Size' => 'A5',
                ],
            ],
            [
                'title' => 'Premium Gift Wrap Set',
                'description' => 'Luxurious gift wrapping paper set with ribbons and bows.',
                'price' => 1200.00,
                'image' => 'https://images.unsplash.com/photo-1600891964092-4316c288032e?w=500',
                'category' => 'Gift Wrap',
                'rating' => 4,
                'reviews_count' => 16,
                'in_stock' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1600891964092-4316c288032e?w=500',
                ],
                'features' => [
                    'Premium quality paper',
                    'Matching ribbons',
                    'Multiple designs',
                ],
                'specifications' => [
                    'Rolls' => '3',
                    'Width' => '30"',
                ],
            ],
            [
                'title' => 'Photo Frame Set',
                'description' => 'Set of 3 elegant photo frames in different sizes.',
                'price' => 2200.00,
                'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea8?w=500',
                'category' => 'Frames',
                'rating' => 4,
                'reviews_count' => 19,
                'in_stock' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1618221195710-dd6b41faaea8?w=500',
                ],
                'features' => [
                    'Set of 3 frames',
                    'Wooden finish',
                    'Glass front',
                ],
                'specifications' => [
                    'Sizes' => '4x6, 5x7, 8x10',
                ],
            ],
        ];

        foreach ($products as $productData) {
            $images = $productData['images'] ?? [];
            $features = $productData['features'] ?? [];
            $specifications = $productData['specifications'] ?? [];
            
            unset($productData['images'], $productData['features'], $productData['specifications']);

            $product = Product::create($productData);

            foreach ($images as $index => $imageUrl) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $imageUrl,
                    'is_primary' => $index === 0,
                    'order' => $index,
                ]);
            }

            foreach ($features as $feature) {
                ProductFeature::create([
                    'product_id' => $product->id,
                    'feature' => $feature,
                ]);
            }

            foreach ($specifications as $key => $value) {
                ProductSpecification::create([
                    'product_id' => $product->id,
                    'key' => $key,
                    'value' => $value,
                ]);
            }
        }
    }
}
