<?php

use Illuminate\Database\Seeder;
use App\Models\Config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Config::insert([
            [
                'key' => Config::KEY_LINK_REGISTER,
                'value' => 'https://stackoverflow.com/questions/21495502/laravel-hashcheck-always-return-false',
                'description' => 'Link đăng ký mở quán sup, pp hải sản, quán ăn'
            ],[
                'key' => Config::KEY_LINK_WEB,
                'value' => 'https://www.youtube.com/watch?v=VQ9jjbt5SKU',
                'description' => 'Link trang web'
            ],
        ]);
    }
}
