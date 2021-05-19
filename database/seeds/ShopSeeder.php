<?php

use Illuminate\Database\Seeder;
use App\Models\Shop;
use Illuminate\Support\Str;
class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shop::insert([
            [
                'id' => Str::uuid(),
                'address' => "123 Bạch Đằng, P2 , Bình Thạnh, HCM",
                'zalo_phone' => '0978533952',
                'latitude' => '10.802910149705028',
                'longitude' => '106.70893645674538',
                'status' => STATUS_ACTIVE,
            ],  [
                'id' => Str::uuid(),
                'address' => "265 Hoàng Hoa Thám, Phường 15, Tân Bình, Thành phố Hồ Chí Minh",
                'zalo_phone' => '0966624896',
                'latitude' => '10.808776169705743',
                'longitude' => '106.64798054023494',
                'status' => STATUS_ACTIVE,
            ],
        ]);
    }
}
