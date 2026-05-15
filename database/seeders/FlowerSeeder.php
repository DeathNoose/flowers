<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Flower;
use Illuminate\Database\Seeder;

class FlowerSeeder extends Seeder
{
    public function run(): void
    {
        Flower::truncate();
        
        $bukety = Category::where('slug', 'bukety')->first();
        $kompozitsii = Category::where('slug', 'kompozitsii')->first();
        $poShtuchno = Category::where('slug', 'po-shtuchno')->first();
        
        // Если категории не найдены, создаем их на месте
        if (!$bukety) {
            $bukety = Category::create([
                'name' => 'Букеты',
                'slug' => 'bukety',
                'description' => 'Готовые композиции на черном фоне'
            ]);
        }
        
        if (!$kompozitsii) {
            $kompozitsii = Category::create([
                'name' => 'Композиции',
                'slug' => 'kompozitsii',
                'description' => 'Авторские работы в коробках и кашпо'
            ]);
        }
        
        if (!$poShtuchno) {
            $poShtuchno = Category::create([
                'name' => 'Цветы поштучно',
                'slug' => 'po-shtuchno',
                'description' => 'Эксклюзивные сорта для ваших идей'
            ]);
        }
        
        $flowers = [
            // Букеты
            [
                'name' => 'Букет "Королева ночи"',
                'slug' => 'koroleva-nochi',
                'description' => 'Величественный букет из 15 тюльпанов Queen of Night. Глубокий фиолетово-бордовый оттенок, который на черном фоне выглядит абсолютно черным. Дополнен эвкалиптом и аспидистрой.',
                'price' => 4990,
                'image_path' => 'https://images.pexels.com/photos/1148990/pexels-photo-1148990.jpeg',
                'category_id' => $bukety->id,
                'in_stock' => true,
            ],
            [
                'name' => 'Букет "Темная классика"',
                'slug' => 'temnaya-klassika',
                'description' => 'Эксклюзивная композиция из 7 роз Black Baccara и 5 ирисов Before the Storm. Драматичное сочетание фактур и оттенков для самых важных моментов.',
                'price' => 6850,
                'image_path' => 'https://images.pexels.com/photos/931177/pexels-photo-931177.jpeg',
                'category_id' => $bukety->id,
                'in_stock' => true,
            ],
            [
                'name' => 'Букет "Полумрак"',
                'slug' => 'polumrak',
                'description' => 'Нежный букет из пионовидных роз "Black Pearl" в сочетании с маттиолой и гипсофилой. Легкий аромат и изящная форма.',
                'price' => 5450,
                'image_path' => 'https://images.pexels.com/photos/696996/pexels-photo-696996.jpeg',
                'category_id' => $bukety->id,
                'in_stock' => true,
            ],
            [
                'name' => 'Букет "Мистический сад"',
                'slug' => 'misticheskiy-sad',
                'description' => 'Фантазийная композиция из черных калл, темных гиацинтов и ярких подсолнухов. Неожиданное сочетание создает эффект контраста и загадочности.',
                'price' => 7890,
                'image_path' => 'https://images.pexels.com/photos/792381/pexels-photo-792381.jpeg',
                'category_id' => $bukety->id,
                'in_stock' => true,
            ],
            [
                'name' => 'Букет "Кровавая луна"',
                'slug' => 'krovavaya-luna',
                'description' => 'Драматичный букет из 11 роз Black Magic и 5 хризантем темно-бордового цвета. Акценты из красных ягод гиперикума.',
                'price' => 6350,
                'image_path' => 'https://images.pexels.com/photos/56865/flowers-rose-red-rose-red-56865.jpeg',
                'category_id' => $bukety->id,
                'in_stock' => true,
            ],
            
            // Композиции
            [
                'name' => 'Композиция "Черный бархат"',
                'slug' => 'chernyy-barhat',
                'description' => 'Роскошная композиция в черной квадратной коробке. Включает 9 роз Black Baccara, обрамленных темным эвкалиптом и черной краш-бумагой.',
                'price' => 4950,
                'image_path' => 'https://images.pexels.com/photos/1595391/pexels-photo-1595391.jpeg',
                'category_id' => $kompozitsii->id,
                'in_stock' => true,
            ],
            [
                'name' => 'Композиция "Ночной эгоист"',
                'slug' => 'nochnoy-egoist',
                'description' => 'Элегантная композиция в черном кашпо из 5 черных калл и 3 веток эвкалипта. Минималистичный дизайн для ценителей современного стиля.',
                'price' => 3850,
                'image_path' => 'https://images.pexels.com/photos/1283268/pexels-photo-1283268.jpeg',
                'category_id' => $kompozitsii->id,
                'in_stock' => true,
            ],
            [
                'name' => 'Композиция "Золотой полумрак"',
                'slug' => 'zolotoy-polumrak',
                'description' => 'Эффектная композиция в черной коробке с золотыми акцентами. Включает 7 подсолнухов и декоративные золотые листья.',
                'price' => 4250,
                'image_path' => 'https://images.pexels.com/photos/1350789/pexels-photo-1350789.jpeg',
                'category_id' => $kompozitsii->id,
                'in_stock' => true,
            ],
            [
                'name' => 'Композиция "Темный кристалл"',
                'slug' => 'temnyy-kristall',
                'description' => 'Авторская композиция в стеклянной вазе на черной подставке. Сочетание темных ирисов и серебристой эвкалиптовой ветви.',
                'price' => 5650,
                'image_path' => 'https://images.pexels.com/photos/1068161/pexels-photo-1068161.jpeg',
                'category_id' => $kompozitsii->id,
                'in_stock' => true,
            ],
            
            // Цветы поштучно
            [
                'name' => 'Роза Black Baccara',
                'slug' => 'black-baccara',
                'description' => 'Бархатистые лепестки цвета запёкшейся крови. Одна из самых темных роз в мире. Длина стебля 60 см.',
                'price' => 890,
                'image_path' => 'https://images.pexels.com/photos/1097147/pexels-photo-1097147.jpeg',
                'category_id' => $poShtuchno->id,
                'in_stock' => true,
            ],
            [
                'name' => 'Роза Black Magic',
                'slug' => 'black-magic',
                'description' => 'Роза с насыщенным темно-красным, почти черным цветом. Бархатистые лепестки с легким свечением.',
                'price' => 790,
                'image_path' => 'https://images.pexels.com/photos/736230/pexels-photo-736230.jpeg',
                'category_id' => $poShtuchno->id,
                'in_stock' => true,
            ],
            [
                'name' => 'Тюльпан Queen of Night',
                'slug' => 'queen-of-night',
                'description' => 'Классический "черный" тюльпан. Глубокий фиолетово-бордовый оттенок, который на фото выглядит абсолютно черным.',
                'price' => 350,
                'image_path' => 'https://images.pexels.com/photos/1407358/pexels-photo-1407358.jpeg',
                'category_id' => $poShtuchno->id,
                'in_stock' => true,
            ],
            [
                'name' => 'Ирис Before the Storm',
                'slug' => 'before-the-storm',
                'description' => 'Бархатистые лепестки с переливами от фиолетового к черному. Очень графичный цветок.',
                'price' => 420,
                'image_path' => 'https://images.pexels.com/photos/1589712/pexels-photo-1589712.jpeg',
                'category_id' => $poShtuchno->id,
                'in_stock' => true,
            ],
            [
                'name' => 'Калла черная',
                'slug' => 'calla-black',
                'description' => 'Элегантная, минималистичная форма. Темный, почти черный цвет и глянцевый блеск.',
                'price' => 680,
                'image_path' => 'https://images.pexels.com/photos/1210487/pexels-photo-1210487.jpeg',
                'category_id' => $poShtuchno->id,
                'in_stock' => true,
            ],
            [
                'name' => 'Подсолнух классический',
                'slug' => 'podsolnukh',
                'description' => 'Яркий, светящийся подсолнух. Мощнейший контраст с черным фоном. Диаметр цветка 12-15 см.',
                'price' => 750,
                'image_path' => 'https://images.pexels.com/photos/1599152/pexels-photo-1599152.jpeg',
                'category_id' => $poShtuchno->id,
                'in_stock' => true,
            ],
            [
                'name' => 'Хризантема зеленая',
                'slug' => 'chrysanthemum-green',
                'description' => 'Неоновый оттенок зеленого. На черном фоне выглядит особенно ярко и "кислотно".',
                'price' => 520,
                'image_path' => 'https://images.pexels.com/photos/1043150/pexels-photo-1043150.jpeg',
                'category_id' => $poShtuchno->id,
                'in_stock' => true,
            ],
            [
                'name' => 'Гиацинт темный',
                'slug' => 'hyacinth-dark',
                'description' => 'Темно-фиолетовый, почти черный гиацинт. Имеет насыщенный приятный аромат.',
                'price' => 380,
                'image_path' => 'https://images.pexels.com/photos/974320/pexels-photo-974320.jpeg',
                'category_id' => $poShtuchno->id,
                'in_stock' => true,
            ],
        ];

        foreach ($flowers as $flower) {
            Flower::create($flower);
        }
        
        $this->command->info('✅ Добавлено товаров: ' . Flower::count());
    }
}