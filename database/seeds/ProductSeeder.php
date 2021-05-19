<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
                'id' => Str::uuid(),
                'name' => "Cua Hoàng Đế",
                'description' => 'Cua đông lạnh',
                'price' => 1900000,
                'status' => STATUS_ACTIVE,
            ],  [
                'id' => Str::uuid(),
                'name' => "Cua đồng",
                'description' => 'Cua tươi lắm',
                'price' => 20000,
                'status' => STATUS_ACTIVE,
            ],
        ]);
    }
}
