<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [1,'Adana'],
            [2,'Adıyaman'],
            [3,'Afyonkarahisar'],
            [4,'Ağrı'],
            [5,'Aksaray'],
            [6,'Amasya'],
            [7,'Ankara'],
            [8,'Antalya'],
            [9,'Ardahan'],
            [10,'Artvin'],
            [11,'Aydın'],
            [12,'Balıkesir'],
            [13,'Bartın'],
            [14,'Batman'],
            [15,'Bayburt'],
            [16,'Bilecik'],
            [17,'Bingöl'],
            [18,'Bitlis'],
            [19,'Bolu'],
            [20,'Burdur'],
            [21,'Bursa'],
            [22,'Çanakkale'],
            [23,'Çankırı'],
            [24,'Çorum'],
            [25,'Denizli'],
            [26,'Diyarbakır'],
            [27,'Düzce'],
            [28,'Edirne'],
            [29,'Elazığ'],
            [30,'Erzincan'],
            [31,'Erzurum'],
            [32,'Eskişehir'],
            [33,'Gaziantep'],
            [34,'Giresun'],
            [35,'Gümüşhane'],
            [36,'Hakkari'],
            [37,'Hatay'],
            [38,'Iğdır'],
            [39,'Isparta'],
            [40,'İstanbul'],
            [41,'İzmir'],
            [42,'Kahramanmaraş'],
            [43,'Karabük'],
            [44,'Karaman'],
            [45,'Kars'],
            [46,'Kastamonu'],
            [47,'Kayseri'],
            [48,'Kırıkkale'],
            [49,'Kırklareli'],
            [50,'Kırşehir'],
            [51,'Kilis'],
            [52,'Kocaeli'],
            [53,'Konya'],
            [54,'Kütahya'],
            [55,'Malatya'],
            [56,'Manisa'],
            [57,'Mardin'],
            [58,'Mersin'],
            [59,'Muğla'],
            [60,'Muş'],
            [61,'Nevşehir'],
            [62,'Niğde'],
            [63,'Ordu'],
            [64,'Osmaniye'],
            [65,'Rize'],
            [66,'Sakarya'],
            [67,'Samsun'],
            [68,'Siirt'],
            [69,'Sinop'],
            [70,'Sivas'],
            [71,'Şanlıurfa'],
            [72,'Şırnak'],
            [73,'Tekirdağ'],
            [74,'Tokat'],
            [75,'Trabzon'],
            [76,'Tunceli'],
            [77,'Uşak'],
            [78,'Van'],
            [79,'Yalova'],
            [80,'Yozgat'],
            [81,'Zonguldak']
        ];


        $current_cities = DB::table('cities')->select('id')->get();
        if($current_cities->count()==0){
            DB::table('cities')->delete();
            foreach ($cities as $city){
                DB::table('cities')->insert(['id'=>$city[0],'name'=>$city[1]]);
            }
        }
    }
}
