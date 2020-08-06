<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            array('id' => '1','user_id' => '1','title' => 'Электроника','slug' => 'elektronika','status' => 'active','content' => NULL,'created_at' => '2020-07-14 21:42:37','updated_at' => '2020-07-14 21:42:37','_lft' => '1','_rgt' => '14','parent_id' => NULL),
            array('id' => '2','user_id' => '1','title' => 'Телефоны','slug' => 'telefony','status' => 'active','content' => NULL,'created_at' => '2020-07-14 21:43:27','updated_at' => '2020-07-14 21:43:27','_lft' => '2','_rgt' => '9','parent_id' => '1'),
            array('id' => '3','user_id' => '1','title' => 'Смартфоны','slug' => 'smartfony','status' => 'active','content' => NULL,'created_at' => '2020-07-14 21:43:56','updated_at' => '2020-07-14 21:43:56','_lft' => '3','_rgt' => '4','parent_id' => '2'),
            array('id' => '4','user_id' => '1','title' => 'Смарт-часы и фитнес-браслеты','slug' => 'smart-chasy-i-fitnes-braslety','status' => 'active','content' => NULL,'created_at' => '2020-07-14 21:44:10','updated_at' => '2020-07-14 21:44:10','_lft' => '5','_rgt' => '6','parent_id' => '2'),
            array('id' => '5','user_id' => '1','title' => 'Аксессуары для смартфонов и телефонов','slug' => 'aksessuary-dlya-smartfonov-i-telefonov','status' => 'active','content' => NULL,'created_at' => '2020-07-14 21:44:31','updated_at' => '2020-07-14 21:44:31','_lft' => '7','_rgt' => '8','parent_id' => '2'),
            array('id' => '6','user_id' => '1','title' => 'Ноутбуки, планшеты и электронные книги','slug' => 'noutbuki-planshety-i-elektronnye-knigi','status' => 'active','content' => NULL,'created_at' => '2020-07-14 21:45:21','updated_at' => '2020-07-14 21:45:21','_lft' => '10','_rgt' => '13','parent_id' => '1'),
            array('id' => '7','user_id' => '1','title' => 'Ноутбуки','slug' => 'noutbuki','status' => 'active','content' => NULL,'created_at' => '2020-07-14 21:45:36','updated_at' => '2020-07-14 21:45:36','_lft' => '11','_rgt' => '12','parent_id' => '6'),
            array('id' => '8','user_id' => '1','title' => 'Дом и сад','slug' => 'dom-i-sad','status' => 'active','content' => NULL,'created_at' => '2020-07-14 21:46:10','updated_at' => '2020-07-14 21:46:10','_lft' => '15','_rgt' => '16','parent_id' => NULL),
            array('id' => '9','user_id' => '1','title' => 'Детские товары','slug' => 'detskie-tovary','status' => 'active','content' => NULL,'created_at' => '2020-07-14 21:46:36','updated_at' => '2020-07-14 21:46:36','_lft' => '17','_rgt' => '18','parent_id' => NULL)
        );

        DB::table('categories')->insert($categories);

        $payment_schedules = array(
            array('id' => '1','min_percent' => '30','max_percent' => '34','quantity_pay_every_month' => '24','quantity_pay_each_quarter' => '21','quantity_pay_every_six_months' => '17','quantity_pay_single' => '11'),
            array('id' => '2','min_percent' => '35','max_percent' => '39','quantity_pay_every_month' => '21','quantity_pay_each_quarter' => '18','quantity_pay_every_six_months' => '15','quantity_pay_single' => '10'),
            array('id' => '3','min_percent' => '40','max_percent' => '44','quantity_pay_every_month' => '16','quantity_pay_each_quarter' => '14','quantity_pay_every_six_months' => '13','quantity_pay_single' => '10'),
            array('id' => '4','min_percent' => '45','max_percent' => '49','quantity_pay_every_month' => '16','quantity_pay_each_quarter' => '14','quantity_pay_every_six_months' => '12','quantity_pay_single' => '9'),
            array('id' => '5','min_percent' => '50','max_percent' => '54','quantity_pay_every_month' => '15','quantity_pay_each_quarter' => '13','quantity_pay_every_six_months' => '11','quantity_pay_single' => '9'),
            array('id' => '6','min_percent' => '55','max_percent' => '59','quantity_pay_every_month' => '13','quantity_pay_each_quarter' => '12','quantity_pay_every_six_months' => '10','quantity_pay_single' => '8'),
            array('id' => '7','min_percent' => '60','max_percent' => '64','quantity_pay_every_month' => '12','quantity_pay_each_quarter' => '11','quantity_pay_every_six_months' => '9','quantity_pay_single' => '8'),
            array('id' => '8','min_percent' => '65','max_percent' => '69','quantity_pay_every_month' => '11','quantity_pay_each_quarter' => '10','quantity_pay_every_six_months' => '8','quantity_pay_single' => '7'),
            array('id' => '9','min_percent' => '70','max_percent' => '70','quantity_pay_every_month' => '11','quantity_pay_each_quarter' => '9','quantity_pay_every_six_months' => '8','quantity_pay_single' => '7')
        );

        DB::table('payment_schedules')->insert($payment_schedules);

        $products = array(
            array('id' => '1','user_id' => '1','category_id' => '3','title' => 'Palit GTX 1660 Super Jet Strim','slug' => 'palit-gtx-1660-super-jet-strim','status' => 'active','content' => NULL,'is_moderation' => '1','moderation_comment' => NULL,'group_product' => 'fiz','price' => '1123','created_at' => '2020-07-23 20:30:25','updated_at' => '2020-07-29 19:06:20','part_cashback' => '30','old_price' => NULL,'views' => '6'),
            array('id' => '2','user_id' => '1','category_id' => '7','title' => 'Телевизоры','slug' => 'televizory','status' => 'active','content' => '<p>1212 q23 qe q2</p>','is_moderation' => '1','moderation_comment' => NULL,'group_product' => 'fiz','price' => '333','created_at' => '2020-08-06 07:27:43','updated_at' => '2020-08-06 07:27:43','part_cashback' => '30','old_price' => NULL,'views' => '0')
        );

        DB::table('products')->insert($products);
    }
}
