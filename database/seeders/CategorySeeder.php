<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Invitations',
                'slug' => 'invitations',
                'description' => 'Wedding invitations, party invitations, and event invitations',
                'image' => 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=500',
            ],
            [
                'name' => 'Wall Art',
                'slug' => 'wall-art',
                'description' => 'Decorative wall art prints and posters',
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=500',
            ],
            [
                'name' => 'Paper Crafts',
                'slug' => 'paper-crafts',
                'description' => 'Handmade paper crafts and DIY kits',
                'image' => 'https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?w=500',
            ],
            [
                'name' => 'Albums',
                'slug' => 'albums',
                'description' => 'Photo albums and memory books',
                'image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=500',
            ],
            [
                'name' => 'Cards',
                'slug' => 'cards',
                'description' => 'Greeting cards for all occasions',
                'image' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=500',
            ],
            [
                'name' => 'Decorations',
                'slug' => 'decorations',
                'description' => 'Party decorations and festive items',
                'image' => 'https://images.unsplash.com/photo-1512389142860-9c449e58a543?w=500',
            ],
            [
                'name' => 'Journals',
                'slug' => 'journals',
                'description' => 'Notebooks, journals, and diaries',
                'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=500',
            ],
            [
                'name' => 'Gift Wrap',
                'slug' => 'gift-wrap',
                'description' => 'Gift wrapping paper and accessories',
                'image' => 'https://images.unsplash.com/photo-1601925260368-ae2f83d121b0?w=500',
            ],
            [
                'name' => 'Frames',
                'slug' => 'frames',
                'description' => 'Photo frames and display frames',
                'image' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=500',
            ],
        ];

        foreach ($categories as $category) {
            $existingCategory = Category::where('slug', $category['slug'])->first();
            
            if ($existingCategory) {
                // Update existing category with image if it doesn't have one
                if (!$existingCategory->image) {
                    $existingCategory->update(['image' => $category['image']]);
                }
            } else {
                // Create new category
                Category::create($category);
            }
        }
    }
}
