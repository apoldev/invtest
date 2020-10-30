<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\AttrGroup;
use App\Models\Attr;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $default = [
            "Размер" => [
                "1,5 спальный",
                "2,0 спальный",
                "2,0 спальный с евро",
                "детский",
                "евро",
                "семейный",
            ],
            "Ткань" => [
                "поплин",
                "искусственный шелк",
                "микросатин",
                "полиэфирнохлопковая",
                "перкаль",
                "сатин-жаккард"
            ]
        ];

        foreach($default as $group_name => &$values){
            $group = AttrGroup::firstOrCreate(["title" => $group_name]);

            foreach($values as &$value){

                $attr = new Attr();
                $attr->title = $value;
                $attr->save();

                $group->attrs()->save($attr);

                $value = $attr;
            }

        }

        Item::factory(100)->create()->each(function($item) use ($default) {

            foreach($default as $valuesOfOneGroup){
                $item->attrs()->save($valuesOfOneGroup[array_rand($valuesOfOneGroup)]);
            }

            
        });
    }
}
