<?php

namespace Database\Seeders;

use Database\Seeders\CurrencySeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\SocialSeed;
use Database\Seeders\PaymentSettingSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
           $this->call(SocialSeed::class);
        // \App\Models\User::factory(10)->create();

           $this->call(PaymentSettingSeeder::class);

             //  currency
           $this->call(CurrencySeeder::class);
           
           DB::insert("INSERT INTO `seo_settings` (`id`, `title`, `meta_image`, `sitemap_link`, `keyword`, `author`, `description`, `created_at`, `updated_at`) VALUES
        (1, 'Limmerz | Start Your Own Ecommerce Today', '5ed50b0000acd.jpeg', 'sitemap.com', 'Limmex Groce, grocery, ecommerce, home applience, lacommerz, lacommerz, La commerz, La commerz, Limmex ecommerce, Limmex ecommerce, Limmex Automation, Limmex Automation, limmerz', 'Limmex Automation',
        'Limmerz is an ecommerce solution for both grocery and lifestyle based on laravel and vue.js', '2020-02-09 00:05:09', '2020-06-01 08:04:49')");

            //    shop settings

        DB::insert("INSERT INTO `shop_settings` (`id`, `shop_name`, `shop_short_name`, `address`, `footer_text`, `phone`, `email`, `facebook`, `twitter`, `youtube`, `logo_header`, `logo_footer`, `favicon`, `theme_color`, `hot_deal_status`, `slider_status`, `onsale_status`,`sidemenu_status`, `created_at`, `updated_at`) VALUES
      (1, 'Limmerz', NULL, '219 muktobangla complex , Dhaka-1205', '2020 all right reserve by@LimmexAutomation', '01312447767', 'business@limmexbd.com', 'https://facebook.com', 'https://twitter.com', 'https://youtube.com', '5ed50bc056bf0.png', '5ed50bc05fd25.png', '5ed50bc066add.png', '#E3106E', 1, 0, 1,1,'2020-02-10 03:00:06', '2020-07-15 09:40:09')");

      DB::insert("INSERT INTO `google_analytics` (`id`, `app_id`, `status`, `created_at`, `updated_at`) VALUES (NULL, 'UA-1214234234', '0', NULL, NULL)");

       DB::insert("INSERT INTO `shipping_costs` (`id`, `shipping_amount`, `minimum_order_amount`, `order_amount`, `discount_amount`, `shipping_status`, `discount_status`, `created_at`, `updated_at`) VALUES
       (1, 40, 300, 1500, 20, 1, 1, '2020-04-18 20:48:42', '2020-05-18 06:32:41')");
      
    }
}
