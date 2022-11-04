<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_categories = DB::table('setting_categories')->select('id')->get();
        if($current_categories->count()==0) {
            $categories = [
                ['id'=>1,'title'=>'Önyüz Ayarları','description'=>'Uygulamanın önyüzü ile ilgili ayarlar.','created_at'=>now()],
                ['id'=>2,'title'=>'Sistem Ayarları','description'=>'','created_at'=>now()]
            ];

            foreach ($categories as $category){
                DB::table('setting_categories')->insert($category);
            }
        }
    }
}
