<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoteSeeder extends Seeder
{
    public function run(): void
    {
        $notes = [
            // Top notes
            ['name' => 'Бергамот',      'slug' => 'bergamot',      'type' => 'top',    'icon' => '🍋'],
            ['name' => 'Лимон',         'slug' => 'lemon',         'type' => 'top',    'icon' => '🍋'],
            ['name' => 'Грейпфрут',     'slug' => 'grapefruit',    'type' => 'top',    'icon' => '🍊'],
            ['name' => 'Мандарин',      'slug' => 'mandarin',      'type' => 'top',    'icon' => '🍊'],
            ['name' => 'Зелёный чай',   'slug' => 'green-tea',     'type' => 'top',    'icon' => '🍵'],
            ['name' => 'Перец чёрный',  'slug' => 'black-pepper',  'type' => 'top',    'icon' => '🫚'],
            ['name' => 'Кардамон',      'slug' => 'cardamom',      'type' => 'top',    'icon' => '🌿'],
            ['name' => 'Гальбанум',     'slug' => 'galbanum',      'type' => 'top',    'icon' => '🌱'],
            ['name' => 'Водяные ноты',  'slug' => 'aqua',          'type' => 'top',    'icon' => '💧'],
            ['name' => 'Мята',          'slug' => 'mint',          'type' => 'top',    'icon' => '🌿'],

            // Heart notes
            ['name' => 'Роза',          'slug' => 'rose',          'type' => 'heart',  'icon' => '🌹'],
            ['name' => 'Жасмин',        'slug' => 'jasmine',       'type' => 'heart',  'icon' => '🌸'],
            ['name' => 'Пион',          'slug' => 'peony',         'type' => 'heart',  'icon' => '🌺'],
            ['name' => 'Лилия',         'slug' => 'lily',          'type' => 'heart',  'icon' => '🌷'],
            ['name' => 'Ирис',          'slug' => 'iris',          'type' => 'heart',  'icon' => '💜'],
            ['name' => 'Нероли',        'slug' => 'neroli',        'type' => 'heart',  'icon' => '🌼'],
            ['name' => 'Лаванда',       'slug' => 'lavender',      'type' => 'heart',  'icon' => '💜'],
            ['name' => 'Герань',        'slug' => 'geranium',      'type' => 'heart',  'icon' => '🌸'],
            ['name' => 'Фиалка',        'slug' => 'violet',        'type' => 'heart',  'icon' => '💜'],
            ['name' => 'Тубероза',      'slug' => 'tuberose',      'type' => 'heart',  'icon' => '🌺'],

            // Base notes
            ['name' => 'Мускус',        'slug' => 'musk',          'type' => 'base',   'icon' => '🌑'],
            ['name' => 'Сандаловое дерево', 'slug' => 'sandalwood','type' => 'base',   'icon' => '🪵'],
            ['name' => 'Ваниль',        'slug' => 'vanilla',       'type' => 'base',   'icon' => '🍦'],
            ['name' => 'Амбра',         'slug' => 'amber',         'type' => 'base',   'icon' => '🟡'],
            ['name' => 'Пачули',        'slug' => 'patchouli',     'type' => 'base',   'icon' => '🍂'],
            ['name' => 'Уд',            'slug' => 'oud',           'type' => 'base',   'icon' => '🌑'],
            ['name' => 'Ветивер',       'slug' => 'vetiver',       'type' => 'base',   'icon' => '🪨'],
            ['name' => 'Кедр',          'slug' => 'cedarwood',     'type' => 'base',   'icon' => '🌲'],
            ['name' => 'Бобы тонка',    'slug' => 'tonka-bean',    'type' => 'base',   'icon' => '🟤'],
            ['name' => 'Корица',        'slug' => 'cinnamon',      'type' => 'base',   'icon' => '🍂'],
        ];

        DB::table('notes')->insert(array_map(fn($n) => array_merge($n, [
            'created_at' => now(),
            'updated_at' => now(),
        ]), $notes));
    }
}
