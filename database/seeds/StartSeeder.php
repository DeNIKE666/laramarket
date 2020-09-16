<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'       => 'Admin User',
                'email'      => 'admin@domain.com',
                'password'   => \Illuminate\Support\Facades\Hash::make('password'),
                'role'       => 'admin',
                'phone'      => null,
                'address'    => null,
                'created_at' => \Illuminate\Support\Carbon::now(),
            ],
            [
                'name'       => 'Reviakin антон оЛеГоВиЧ',
                'email'      => 'user@domain.com',
                'password'   => \Illuminate\Support\Facades\Hash::make('password'),
                'role'       => 'buyer',
                'phone'      => '+380(95)336-16-18',
                'address'    => 'Address',
                'created_at' => \Illuminate\Support\Carbon::now(),
            ],
            [
                'name'       => 'Seller',
                'email'      => 'seller@domain.com',
                'password'   => \Illuminate\Support\Facades\Hash::make('password'),
                'role'       => 'seller',
                'phone'      => null,
                'address'    => null,
                'created_at' => \Illuminate\Support\Carbon::now(),
            ],
            [
                'name'       => 'Oleg',
                'email'      => 'oleg.a@myfbr.ru',
                'password'   => \Illuminate\Support\Facades\Hash::make('password'),
                'role'       => 'buyer',
                'phone'      => null,
                'address'    => null,
                'created_at' => \Illuminate\Support\Carbon::now(),
            ],
            [
                'name'       => 'Инспектор Гаджет',
                'email'      => 'inspektorme@gmail.com',
                'password'   => \Illuminate\Support\Facades\Hash::make('password'),
                'role'       => 'buyer',
                'phone'      => null,
                'address'    => null,
                'created_at' => \Illuminate\Support\Carbon::now(),
            ],
        ];

        DB::table('users')->insert($users);

        $categories = [
            ['id' => '1', 'user_id' => '1', 'title' => 'Электроника', 'slug' => 'elektronika', 'status' => 'active', 'content' => null, 'created_at' => '2020-07-14 21:42:37', 'updated_at' => '2020-07-14 21:42:37', '_lft' => '1', '_rgt' => '14', 'parent_id' => null],
            ['id' => '2', 'user_id' => '1', 'title' => 'Телефоны', 'slug' => 'telefony', 'status' => 'active', 'content' => null, 'created_at' => '2020-07-14 21:43:27', 'updated_at' => '2020-07-14 21:43:27', '_lft' => '2', '_rgt' => '9', 'parent_id' => '1'],
            ['id' => '3', 'user_id' => '1', 'title' => 'Смартфоны', 'slug' => 'smartfony', 'status' => 'active', 'content' => null, 'created_at' => '2020-07-14 21:43:56', 'updated_at' => '2020-07-14 21:43:56', '_lft' => '3', '_rgt' => '4', 'parent_id' => '2'],
            ['id' => '4', 'user_id' => '1', 'title' => 'Смарт-часы и фитнес-браслеты', 'slug' => 'smart-chasy-i-fitnes-braslety', 'status' => 'active', 'content' => null, 'created_at' => '2020-07-14 21:44:10', 'updated_at' => '2020-07-14 21:44:10', '_lft' => '5', '_rgt' => '6', 'parent_id' => '2'],
            ['id' => '5', 'user_id' => '1', 'title' => 'Аксессуары для смартфонов и телефонов', 'slug' => 'aksessuary-dlya-smartfonov-i-telefonov', 'status' => 'active', 'content' => null, 'created_at' => '2020-07-14 21:44:31', 'updated_at' => '2020-07-14 21:44:31', '_lft' => '7', '_rgt' => '8', 'parent_id' => '2'],
            ['id' => '6', 'user_id' => '1', 'title' => 'Ноутбуки, планшеты и электронные книги', 'slug' => 'noutbuki-planshety-i-elektronnye-knigi', 'status' => 'active', 'content' => null, 'created_at' => '2020-07-14 21:45:21', 'updated_at' => '2020-07-14 21:45:21', '_lft' => '10', '_rgt' => '13', 'parent_id' => '1'],
            ['id' => '7', 'user_id' => '1', 'title' => 'Ноутбуки', 'slug' => 'noutbuki', 'status' => 'active', 'content' => null, 'created_at' => '2020-07-14 21:45:36', 'updated_at' => '2020-07-14 21:45:36', '_lft' => '11', '_rgt' => '12', 'parent_id' => '6'],
            ['id' => '8', 'user_id' => '1', 'title' => 'Дом и сад', 'slug' => 'dom-i-sad', 'status' => 'active', 'content' => null, 'created_at' => '2020-07-14 21:46:10', 'updated_at' => '2020-07-14 21:46:10', '_lft' => '15', '_rgt' => '16', 'parent_id' => null],
            ['id' => '9', 'user_id' => '1', 'title' => 'Детские товары', 'slug' => 'detskie-tovary', 'status' => 'active', 'content' => null, 'created_at' => '2020-07-14 21:46:36', 'updated_at' => '2020-07-14 21:46:36', '_lft' => '17', '_rgt' => '18', 'parent_id' => null],
        ];

        DB::table('categories')->insert($categories);

        $payment_schedules = [
            ['id' => '1', 'percent' => '30', 'quantity_pay_every_month' => '24', 'quantity_pay_each_quarter' => '21', 'quantity_pay_every_six_months' => '17', 'quantity_pay_single' => '11'],
            ['id' => '2', 'percent' => '35', 'quantity_pay_every_month' => '21', 'quantity_pay_each_quarter' => '18', 'quantity_pay_every_six_months' => '15', 'quantity_pay_single' => '10'],
            ['id' => '3', 'percent' => '40', 'quantity_pay_every_month' => '16', 'quantity_pay_each_quarter' => '14', 'quantity_pay_every_six_months' => '13', 'quantity_pay_single' => '10'],
            ['id' => '4', 'percent' => '45', 'quantity_pay_every_month' => '16', 'quantity_pay_each_quarter' => '14', 'quantity_pay_every_six_months' => '12', 'quantity_pay_single' => '9'],
            ['id' => '5', 'percent' => '50', 'quantity_pay_every_month' => '15', 'quantity_pay_each_quarter' => '13', 'quantity_pay_every_six_months' => '11', 'quantity_pay_single' => '9'],
            ['id' => '6', 'percent' => '55', 'quantity_pay_every_month' => '13', 'quantity_pay_each_quarter' => '12', 'quantity_pay_every_six_months' => '10', 'quantity_pay_single' => '8'],
            ['id' => '7', 'percent' => '60', 'quantity_pay_every_month' => '12', 'quantity_pay_each_quarter' => '11', 'quantity_pay_every_six_months' => '9', 'quantity_pay_single' => '8'],
            ['id' => '8', 'percent' => '65', 'quantity_pay_every_month' => '11', 'quantity_pay_each_quarter' => '10', 'quantity_pay_every_six_months' => '8', 'quantity_pay_single' => '7'],
            ['id' => '9', 'percent' => '70', 'quantity_pay_every_month' => '11', 'quantity_pay_each_quarter' => '9', 'quantity_pay_every_six_months' => '8', 'quantity_pay_single' => '7'],
        ];

        DB::table('payment_schedules')->insert($payment_schedules);

        $products = [
            ['id' => '1', 'user_id' => '1', 'category_id' => '3', 'title' => 'Palit GTX 1660 Super Jet Strim', 'slug' => 'palit-gtx-1660-super-jet-strim', 'status' => 'active', 'content' => null, 'is_moderation' => '1', 'moderation_comment' => null, 'group_product' => 'real', 'price' => '1', 'created_at' => '2020-07-23 20:30:25', 'updated_at' => '2020-07-29 19:06:20', 'part_cashback' => '30', 'old_price' => null, 'views' => '6'],
            ['id' => '2', 'user_id' => '1', 'category_id' => '7', 'title' => 'Телевизоры', 'slug' => 'televizory', 'status' => 'active', 'content' => '<p>1212 q23 qe q2</p>', 'is_moderation' => '1', 'moderation_comment' => null, 'group_product' => 'real', 'price' => '1', 'created_at' => '2020-08-06 07:27:43', 'updated_at' => '2020-08-06 07:27:43', 'part_cashback' => '30', 'old_price' => null, 'views' => '0'],
        ];

        DB::table('products')->insert($products);

        $settings = [
            [
                'name'       => 'Период холда для заказов',
                'slug'       => 'orders_hold_period',
                'value'      => '{"real":3,"info":1}',
                'is_json'    => true,
                'created_at' => \Illuminate\Support\Carbon::now(),
                'updated_at' => \Illuminate\Support\Carbon::now(),
            ],
            [
                'name'       => 'Процент от заказа одноуровневой партнерской программы',
                'slug'       => 'percent_for_single_level_program',
                'value'      => '3',
                'is_json'    => false,
                'created_at' => \Illuminate\Support\Carbon::now(),
                'updated_at' => \Illuminate\Support\Carbon::now(),
            ],
        ];

        DB::table('settings')->insert($settings);
    }
}
