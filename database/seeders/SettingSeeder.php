<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Önyüzün çalışması için gereken varsayılan, silinemeyen ayarlar.
         $settings = [
             [
                 'category_id'=>1,
                 'title'=>'Site Başlığı',
                 'key'=>'title',
                 'value'=>'dahi fys',
                 'type'=>'text',
                 'order'=>1,
                 'deletable'=>0,
                 'status'=>1,
                 'description'=>'Sitenin tamamında görüntülenecek site başlığı. "Sayfa - Başlık" şeklinde görünür.'
             ],
             [
                 'category_id'=>1,
                 'title'=>'Site Açıklaması',
                 'key'=>'description',
                 'value'=>'Amatör futbolun tüm paydaşlarının tüm ihtiyaçlarına cevap veren futbol yönetim sistemi.',
                 'type'=>'text',
                 'order'=>2,
                 'deletable'=>0,
                 'status'=>1,
                 'description'=>'Sitenin tamamında görüntülenecek açıklama.'
             ],
             [
                 'category_id'=>1,
                 'title'=>'Anahtar Kelimeler',
                 'key'=>'keywords',
                 'value'=>'dahi fys, dahi,fys, futbol yönetim sistemi',
                 'type'=>'text',
                 'order'=>3,
                 'deletable'=>0,
                 'status'=>1,
                 'description'=>'Sitenin tüm sayfaları için görüntülenecek anahtar kelimeler.'
             ],
             [
                 'category_id'=>2,
                 'title'=>'Aktif Sezon',
                 'key'=>'active_season',
                 'value'=>'1',
                 'type'=>'text',
                 'order'=>4,
                 'deletable'=>0,
                 'status'=>1,
                 'description'=>'Sistemde görüntülenecek aktif sezon.'
             ],
             [
                 'category_id'=>2,
                 'title'=>'İl',
                 'key'=>'city',
                 'value'=>'51',
                 'type'=>'text',
                 'order'=>5,
                 'deletable'=>0,
                 'status'=>1,
                 'description'=>"Dahi'yi kullanmakta olduğunuz il."
             ],
         ];

         foreach ($settings as $setting){
             $exists=DB::table('settings')->where($setting);
             if($exists->count()==0){
                 DB::table('settings')->insert($setting);
             }
         }

    }
}
