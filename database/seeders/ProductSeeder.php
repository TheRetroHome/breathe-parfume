<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name'              => 'Velvet Rose',
                'brand'             => 'Breathe',
                'category_slug'     => 'floral',
                'gender'            => 'female',
                'price'             => 12900,
                'old_price'         => 15900,
                'volume_ml'         => 50,
                'concentration'     => 'EDP',
                'country'           => 'Франция',
                'short_description' => 'Роскошная бархатная роза с тёплым мускусным шлейфом — парфюм для тех, кто знает себе цену.',
                'description'       => "Velvet Rose — это квинтэссенция роскоши в каждой капле. Открывается ярким взрывом дамасской розы, которая постепенно смягчается нежным жасмином и ирисом. В основании — тёплый мускус, сандаловое дерево и капля ванили создают чувственный, долгоиграющий шлейф.\n\nЭтот аромат — для особых моментов. Для вечеров, которые запоминаются. Для женщин, которые оставляют след.",
                'is_new'            => false,
                'is_bestseller'     => true,
                'stock'             => 42,
                'rating'            => 4.8,
                'reviews_count'     => 127,
                'orders_count'      => 342,
                'notes'             => ['rose', 'jasmine', 'iris', 'musk', 'sandalwood', 'vanilla', 'bergamot'],
            ],
            [
                'name'              => 'Dark Oud',
                'brand'             => 'Breathe',
                'category_slug'     => 'oriental',
                'gender'            => 'male',
                'price'             => 18500,
                'old_price'         => null,
                'volume_ml'         => 100,
                'concentration'     => 'EDP Intense',
                'country'           => 'ОАЭ',
                'short_description' => 'Могущественный уд из сердца Аравии, окутанный сандалом и чёрным перцем.',
                'description'       => "Dark Oud — дань уважения великой арабской традиции парфюмерии. Это не просто аромат — это история, рассказанная в дыме ладана и тепле благородного уда.\n\nОткрытие: острый чёрный перец и кардамон создают интригующее начало. Сердце: чистый уд — мощный, смолистый, загадочный. База: ветивер, сандал и пачули дают бесконечную глубину.\n\nShilage: 24+ часа.",
                'is_new'            => false,
                'is_bestseller'     => true,
                'stock'             => 28,
                'rating'            => 4.9,
                'reviews_count'     => 89,
                'orders_count'      => 215,
                'notes'             => ['black-pepper', 'cardamom', 'oud', 'vetiver', 'sandalwood', 'patchouli'],
            ],
            [
                'name'              => 'Aqua Lumière',
                'brand'             => 'Breathe',
                'category_slug'     => 'fresh',
                'gender'            => 'unisex',
                'price'             => 8900,
                'old_price'         => 10900,
                'volume_ml'         => 50,
                'concentration'     => 'EDT',
                'country'           => 'Франция',
                'short_description' => 'Лёгкий морской бриз с нотами цитруса и белого чая — свежесть каждого утра.',
                'description'       => "Aqua Lumière создан для тех, кто ищет лёгкость и чистоту. Этот аромат — как первый вдох после шторма, как капли дождя на разогретых камнях.\n\nЦитрусовое открытие мгновенно освежает. Зелёный чай и водяные ноты в сердце создают ощущение невесомости. Мускус и кедр в базе оставляют чистый, едва уловимый след.\n\nИдеален для ежедневного использования в любое время года.",
                'is_new'            => false,
                'is_bestseller'     => false,
                'stock'             => 65,
                'rating'            => 4.5,
                'reviews_count'     => 54,
                'orders_count'      => 178,
                'notes'             => ['bergamot', 'lemon', 'aqua', 'green-tea', 'musk', 'cedarwood'],
            ],
            [
                'name'              => 'Midnight Iris',
                'brand'             => 'Breathe',
                'category_slug'     => 'floral',
                'gender'            => 'female',
                'price'             => 14200,
                'old_price'         => null,
                'volume_ml'         => 30,
                'concentration'     => 'Parfum',
                'country'           => 'Франция',
                'short_description' => 'Холодный и элегантный ирис, рождённый в полночь — парфюм для истинных ценителей.',
                'description'       => "Midnight Iris — это парфюм-высказывание. Сложный, интеллектуальный, совершенный.\n\nХолодная пудровость ириса открывается тонкой дымкой фиалки и нероли. Роза придаёт сердцу теплоту, но ирис всегда доминирует — холодный, аристократичный, вневременной. База из белого мускуса и древесных нот делает шлейф бесконечным.\n\nПарфюм для женщин, которых невозможно не заметить.",
                'is_new'            => true,
                'is_bestseller'     => false,
                'stock'             => 18,
                'rating'            => 4.7,
                'reviews_count'     => 31,
                'orders_count'      => 67,
                'notes'             => ['neroli', 'iris', 'violet', 'rose', 'musk', 'sandalwood'],
            ],
            [
                'name'              => 'Cedar & Smoke',
                'brand'             => 'Breathe',
                'category_slug'     => 'woody',
                'gender'            => 'male',
                'price'             => 11500,
                'old_price'         => 13500,
                'volume_ml'         => 100,
                'concentration'     => 'EDP',
                'country'           => 'США',
                'short_description' => 'Дымный кедр с нотами ветивера и пряностей — аромат уверенного мужчины.',
                'description'       => "Cedar & Smoke — квинтэссенция мужественности. Этот аромат пахнет как горящий камин в дорогом загородном доме, как первоклассный виски в хрустальном стакане.\n\nОткрытие агрессивное и цепкое: чёрный перец и кардамон задают тон. Сердце — чистый кедр, дымный и смолистый. В базе ветивер и пачули создают земляной, почти первобытный след.\n\nПарфюм, который помнят.",
                'is_new'            => false,
                'is_bestseller'     => true,
                'stock'             => 33,
                'rating'            => 4.6,
                'reviews_count'     => 72,
                'orders_count'      => 193,
                'notes'             => ['black-pepper', 'cardamom', 'cedarwood', 'vetiver', 'patchouli', 'musk'],
            ],
            [
                'name'              => 'Sakura Dreams',
                'brand'             => 'Breathe',
                'category_slug'     => 'floral',
                'gender'            => 'female',
                'price'             => 9800,
                'old_price'         => null,
                'volume_ml'         => 50,
                'concentration'     => 'EDT',
                'country'           => 'Япония',
                'short_description' => 'Нежное цветение сакуры над бамбуковым садом — японская поэзия в флаконе.',
                'description'       => "Sakura Dreams — это японская эстетика «моно-но аварэ»: красота мимолётного. Как цветение сакуры, этот парфюм прекрасен именно своей нежностью и лёгкостью.\n\nВерхние ноты: свежая вишня и юдзу. Сердце: пион, роза и лилия. База: нежный мускус и сандаловое дерево.\n\nЭтот аромат — как воспоминание о лучшем дне в твоей жизни.",
                'is_new'            => true,
                'is_bestseller'     => false,
                'stock'             => 47,
                'rating'            => 4.4,
                'reviews_count'     => 23,
                'orders_count'      => 89,
                'notes'             => ['grapefruit', 'peony', 'rose', 'lily', 'musk', 'sandalwood'],
            ],
            [
                'name'              => 'Amber Noir',
                'brand'             => 'Breathe',
                'category_slug'     => 'oriental',
                'gender'            => 'unisex',
                'price'             => 16800,
                'old_price'         => 19800,
                'volume_ml'         => 50,
                'concentration'     => 'Parfum',
                'country'           => 'Франция',
                'short_description' => 'Тёмная амбра с корицей и ванилью — чувственный аромат тёплых ночей.',
                'description'       => "Amber Noir — это ночной аромат. Он создан для тех моментов, когда день уступает место чему-то большему.\n\nОткрытие: острая корица и чёрный кардамон сразу захватывают внимание. Сердце: тубероза и роза добавляют неожиданную флоральность. База: тёмная амбра, ваниль и ветивер — бесконечный, почти осязаемый шлейф.\n\nUnisex парфюм, который прекрасен на любом человеке.",
                'is_new'            => false,
                'is_bestseller'     => true,
                'stock'             => 25,
                'rating'            => 4.9,
                'reviews_count'     => 108,
                'orders_count'      => 267,
                'notes'             => ['cardamom', 'cinnamon', 'tuberose', 'rose', 'amber', 'vanilla', 'vetiver'],
            ],
            [
                'name'              => 'Green Escapade',
                'brand'             => 'Breathe',
                'category_slug'     => 'fresh',
                'gender'            => 'unisex',
                'price'             => 7600,
                'old_price'         => null,
                'volume_ml'         => 100,
                'concentration'     => 'EDT',
                'country'           => 'Великобритания',
                'short_description' => 'Зелёные ноты и свежесть травы под утренней росой — побег на природу.',
                'description'       => "Green Escapade — аромат для тех, кто живёт в городе, но мечтает о лесе. Свежий, живой, наполненный кислородом.\n\nВерхние ноты: мята, зелёный чай и гальбанум — как первый вдох на рассвете. Сердце: герань и лаванда. База: ветивер и белый мускус.\n\nЛёгкий, но запоминающийся — идеален для офиса и прогулок.",
                'is_new'            => false,
                'is_bestseller'     => false,
                'stock'             => 82,
                'rating'            => 4.3,
                'reviews_count'     => 41,
                'orders_count'      => 134,
                'notes'             => ['mint', 'galbanum', 'green-tea', 'geranium', 'lavender', 'vetiver', 'musk'],
            ],
            [
                'name'              => 'Lavender Fields',
                'brand'             => 'Breathe',
                'category_slug'     => 'fougere',
                'gender'            => 'male',
                'price'             => 8200,
                'old_price'         => 9800,
                'volume_ml'         => 100,
                'concentration'     => 'EDT',
                'country'           => 'Франция',
                'short_description' => 'Прованская лаванда с берамотом и кедром — классика без компромиссов.',
                'description'       => "Lavender Fields — это оммаж вечной классике фужерных ароматов. Свежий, чистый, мужественный.\n\nПоля лаванды в Провансе под летним солнцем — вот этот аромат. Бергамот даёт яркое начало. Лаванда царит в сердце. Кедр и мускус в базе дают тёплый, чистый шлейф.\n\nАромат джентльмена.",
                'is_new'            => false,
                'is_bestseller'     => false,
                'stock'             => 54,
                'rating'            => 4.5,
                'reviews_count'     => 63,
                'orders_count'      => 158,
                'notes'             => ['bergamot', 'lavender', 'geranium', 'cedarwood', 'musk'],
            ],
            [
                'name'              => 'Golden Tuberose',
                'brand'             => 'Breathe',
                'category_slug'     => 'floral',
                'gender'            => 'female',
                'price'             => 21000,
                'old_price'         => null,
                'volume_ml'         => 30,
                'concentration'     => 'Parfum',
                'country'           => 'Франция',
                'short_description' => 'Опьяняющая тубероза с нотами бобов тонка — парфюм неотразимой женщины.',
                'description'       => "Golden Tuberose — один из самых смелых ароматов в коллекции Breathe. Тубероза здесь во всей своей мощи — сочная, почти скандальная.\n\nОткрытие: мандарин и нероли. Сердце: тубероза, жасмин — интоксикация в чистом виде. База: бобы тонка, ваниль и мускус создают мягкое, согревающее окончание.\n\nНе для тихих вечеров. Для незабываемых ночей.",
                'is_new'            => true,
                'is_bestseller'     => false,
                'stock'             => 12,
                'rating'            => 4.8,
                'reviews_count'     => 19,
                'orders_count'      => 43,
                'notes'             => ['mandarin', 'neroli', 'tuberose', 'jasmine', 'tonka-bean', 'vanilla', 'musk'],
            ],
            [
                'name'              => 'Sandalwood Suede',
                'brand'             => 'Breathe',
                'category_slug'     => 'woody',
                'gender'            => 'unisex',
                'price'             => 13400,
                'old_price'         => 15900,
                'volume_ml'         => 50,
                'concentration'     => 'EDP',
                'country'           => 'США',
                'short_description' => 'Кремовое сандаловое дерево с нежным замшевым акцентом — уют в парфюмерном флаконе.',
                'description'       => "Sandalwood Suede — это аромат-объятие. Тёплый, кремовый, обволакивающий.\n\nВерхние ноты: бергамот и кардамон создают лёгкое специйное вступление. Сердце: ирис и роза. База: сандал — главная звезда — в сопровождении мускуса, бобов тонка и крошечной капли ванили.\n\nИдеален в любое время года. Особенно — осенью.",
                'is_new'            => false,
                'is_bestseller'     => true,
                'stock'             => 38,
                'rating'            => 4.7,
                'reviews_count'     => 84,
                'orders_count'      => 221,
                'notes'             => ['bergamot', 'cardamom', 'iris', 'rose', 'sandalwood', 'musk', 'tonka-bean'],
            ],
            [
                'name'              => 'Vetiver Storm',
                'brand'             => 'Breathe',
                'category_slug'     => 'chypre',
                'gender'            => 'male',
                'price'             => 10900,
                'old_price'         => null,
                'volume_ml'         => 100,
                'concentration'     => 'EDP',
                'country'           => 'Великобритания',
                'short_description' => 'Землистый ветивер после грозы — парфюм для настоящих мужчин.',
                'description'       => "Vetiver Storm создан для мужчин, которые не боятся быть собой. Мощный, земляной, немного дикий.\n\nВерхние ноты: грейпфрут и чёрный перец — острое, электрическое начало. Сердце: лаванда и герань. База: ветивер, пачули и дубовый мох — тёмная, глубокая земля.\n\nАромат, который невозможно забыть.",
                'is_new'            => false,
                'is_bestseller'     => false,
                'stock'             => 44,
                'rating'            => 4.6,
                'reviews_count'     => 57,
                'orders_count'      => 147,
                'notes'             => ['grapefruit', 'black-pepper', 'lavender', 'geranium', 'vetiver', 'patchouli'],
            ],
            [
                'name'              => 'Citrus Celebration',
                'brand'             => 'Breathe',
                'category_slug'     => 'fresh',
                'gender'            => 'unisex',
                'price'             => 6900,
                'old_price'         => 8400,
                'volume_ml'         => 50,
                'concentration'     => 'EDT',
                'country'           => 'Италия',
                'short_description' => 'Солнечный взрыв цитрусов — как праздник в маленьком флаконе.',
                'description'       => "Citrus Celebration — праздничный аромат на каждый день. Яркий, жизнерадостный, оптимистичный.\n\nВерхние ноты: лимон, грейпфрут, бергамот и мандарин — настоящий цитрусовый взрыв. Сердце: нероли и зелёный чай. База: белый мускус и кедр.\n\nЭтот аромат заряжает энергией и поднимает настроение.",
                'is_new'            => false,
                'is_bestseller'     => false,
                'stock'             => 73,
                'rating'            => 4.2,
                'reviews_count'     => 38,
                'orders_count'      => 112,
                'notes'             => ['lemon', 'grapefruit', 'bergamot', 'mandarin', 'neroli', 'green-tea', 'musk', 'cedarwood'],
            ],
            [
                'name'              => 'Jasmine Royale',
                'brand'             => 'Breathe',
                'category_slug'     => 'floral',
                'gender'            => 'female',
                'price'             => 15600,
                'old_price'         => null,
                'volume_ml'         => 50,
                'concentration'     => 'EDP',
                'country'           => 'Индия',
                'short_description' => 'Королевский жасмин с тончайшей ванилью — роскошь из сердца Индии.',
                'description'       => "Jasmine Royale — это гимн самому известному флоральному ингредиенту в парфюмерии. Жасмин здесь — в своей лучшей, самой роскошной форме.\n\nВерхние ноты: бергамот и мандарин. Сердце: абсолют жасмина — богатый, насыщенный, цветочный. База: сандаловое дерево, ваниль и мускус.\n\nДля женщин, которые выбирают совершенство.",
                'is_new'            => false,
                'is_bestseller'     => true,
                'stock'             => 29,
                'rating'            => 4.8,
                'reviews_count'     => 96,
                'orders_count'      => 253,
                'notes'             => ['bergamot', 'mandarin', 'jasmine', 'rose', 'sandalwood', 'vanilla', 'musk'],
            ],
            [
                'name'              => 'Patchouli Underground',
                'brand'             => 'Breathe',
                'category_slug'     => 'oriental',
                'gender'            => 'unisex',
                'price'             => 11900,
                'old_price'         => 14200,
                'volume_ml'         => 100,
                'concentration'     => 'EDP',
                'country'           => 'Нидерланды',
                'short_description' => 'Тёмный пачули с розой и амброй — бунтарский аромат с богемным духом.',
                'description'       => "Patchouli Underground — это аромат для свободных людей. Он нарушает правила и при этом безупречен.\n\nВерхние ноты: чёрный перец и мандарин. Сердце: роза и тубероза создают неожиданный контраст. База: пачули, амбра и ветивер — тёмные, богатые, бесконечные.\n\nАромат, у которого есть характер.",
                'is_new'            => true,
                'is_bestseller'     => false,
                'stock'             => 36,
                'rating'            => 4.5,
                'reviews_count'     => 27,
                'orders_count'      => 78,
                'notes'             => ['black-pepper', 'mandarin', 'rose', 'tuberose', 'patchouli', 'amber', 'vetiver'],
            ],
        ];

        $categories = \App\Models\Category::pluck('id', 'slug');
        $notesMap   = \App\Models\Note::pluck('id', 'slug');

        $storageProductsPath = storage_path('app/public/products');
        if (!is_dir($storageProductsPath)) {
            mkdir($storageProductsPath, 0755, true);
        }

        foreach ($products as $data) {
            $notes        = $data['notes'];
            $categorySlug = $data['category_slug'];
            unset($data['notes'], $data['category_slug']);

            $data['category_id'] = $categories[$categorySlug];
            $slug = Str::slug($data['name']);
            $data['slug'] = $slug;

            $seederImage = database_path("seeders/images/products/{$slug}.jpg");
            if (file_exists($seederImage)) {
                copy($seederImage, "{$storageProductsPath}/{$slug}.jpg");
                $data['main_image'] = "products/{$slug}.jpg";
            } else {
                $data['main_image'] = null;
            }

            $data['views'] = rand(200, 5000);
            $data['created_at'] = now();
            $data['updated_at'] = now();

            $product = Product::create($data);

            $noteInserts = collect($notes)
                ->filter(fn($slug) => isset($notesMap[$slug]))
                ->map(fn($slug) => [
                    'product_id' => $product->id,
                    'note_id'    => $notesMap[$slug],
                    'created_at' => now(),
                    'updated_at' => now(),
                ])->values()->toArray();

            if ($noteInserts) {
                DB::table('product_note')->insert($noteInserts);
            }
        }
    }
}
