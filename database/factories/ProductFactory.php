<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->sentence(2),
            'description' => fake()->text(),
            'price'=>fake()->randomFloat(2, 2000, 100000),
            'path_img'=>fake()->imageUrl(640, 480, 'animals', true),
            'count'=>fake()->randomNumber(3, false),
            'created_at'=>now(),
            'category_id'=>Category::inRandomOrder()->first()->id ,
            'slug' => fn(array $attributes) => Str::slug($attributes['title']),
            'page_title' => fn(array $attributes) => $attributes['title'],
            'page_description' => fn(array $attributes) => $attributes['title'],
            'keywords' => fn(array $attributes) => $attributes['title'],
        ];
    }}
