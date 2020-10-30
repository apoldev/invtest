<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ItemFactory extends Factory
{

    protected $model = Item::class;

    public static $IMAGES = [
        "https://avatars.mds.yandex.net/get-mpic/1642819/img_id4084633023519379720.jpeg/6hq",
        "https://avatars.mds.yandex.net/get-mpic/1860966/img_id1637650940979850376.jpeg/6hq",
        "https://avatars.mds.yandex.net/get-mpic/1923922/img_id3485673576547289781.jpeg/6hq",
        "https://avatars.mds.yandex.net/get-mpic/2008455/img_id8334595496725266885.jpeg/6hq",
        "https://avatars.mds.yandex.net/get-mpic/1687058/img_id4020855627421849641.jpeg/6hq",
        "https://avatars.mds.yandex.net/get-mpic/1864685/img_id3402628980077528742.jpeg/6hq"
    ];

    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'price' => round(mt_rand(1000, 999999)/100, 2),
            'image' => $this->faker->randomElement(self::$IMAGES)
        ];
    }
}
