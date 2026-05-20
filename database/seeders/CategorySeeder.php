<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Цветочные', 'slug' => 'floral', 'description' => 'Изысканные ароматы с нежными цветочными нотами — воплощение женственности и романтики.'],
            ['name' => 'Древесные', 'slug' => 'woody', 'description' => 'Тёплые, глубокие ароматы с нотами благородной древесины — элегантность и сила.'],
            ['name' => 'Восточные', 'slug' => 'oriental', 'description' => 'Чувственные и таинственные ароматы Востока — пряности, смолы, амбра.'],
            ['name' => 'Свежие', 'slug' => 'fresh', 'description' => 'Лёгкие и бодрящие ароматы — цитрус, морской бриз, зелёные ноты.'],
            ['name' => 'Фужерные', 'slug' => 'fougere', 'description' => 'Классические мужественные ароматы с папоротником, лавандой и дубовым мхом.'],
            ['name' => 'Шипровые', 'slug' => 'chypre', 'description' => 'Утончённые ароматы с дубовым мхом, ладанником и бергамотом.'],
        ];

        DB::table('categories')->insert(array_map(fn($c) => array_merge($c, [
            'created_at' => now(),
            'updated_at' => now(),
        ]), $categories));
    }
}
