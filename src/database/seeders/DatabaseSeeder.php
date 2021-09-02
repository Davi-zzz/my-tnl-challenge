<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $user = \App\Models\User::factory()->create();
        for ($i =0; $i < 5; $i++) {
            $restaurant = \App\Models\Restaurant::factory()->create();
            $restaurant->responsible_id = $user->id;
            $restaurant->save();
            $menus = \App\Models\Menu::factory(3)->create();
            $dishes = \App\Models\Dishe::factory(10)->create();
            foreach ($menus as $menu) {
                $menu->restaurant_id = $restaurant->id;
                $menu->save();
            }
        }

    

    }
}
