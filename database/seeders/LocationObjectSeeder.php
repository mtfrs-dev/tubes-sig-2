<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationObjectSeeder extends Seeder
{
    public function run(): void
    {
        // SPORTS FACILITIES
        DB::table('location_objects')->insert([
            'name'          => 'Alung Pool',
            'type'          => 'Sarana Olahraga',
            'address'       => 'Umbul, Jl. Raja Tihang, Tj. Senang, Kec. Tj. Senang, Kota Bandar Lampung, Lampung 35136',
            'phone'         => '+6282280134567',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipNDDgz0RGtExYQfGFs3OCLlKpT2EcwAyZ0Mz1wE=w408-h305-k-no',
            'asset_name'    => 'Alung Pool Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.362997007585995,
            'longitude'     => 105.28168936961073,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.362997007585995, 105.28168936961073)')[0]->st_makepoint
        ]);
        
        DB::table('location_objects')->insert([
            'name'          => 'GOR Bulutangkis PB. Cempaka',
            'type'          => 'Sarana Olahraga',
            'address'       => 'Gg. Cemp. III, Way Kandis, Kec. Tj. Senang, Kota Bandar Lampung, Lampung 35131',
            'phone'         => '+62895330185182',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipNPUh7XlGr22aNXBcLWxiavB7XIQRPIUxdX9EcC=w203-h152-k-no',
            'asset_name'    => 'GOR Bulutangkis PB. Cempaka Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.353596888988232,
            'longitude'     => 105.2854659199101,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.353596888988232, 105.2854659199101)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'ISC Futsal',
            'type'          => 'Sarana Olahraga',
            'address'       => 'Jl. Airan Raya, Way Huwi, Kec. Jati Agung, Kabupaten Lampung Selatan, Lampung 35131',
            'phone'         => '+62895613370407',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipMAZWHKPANdOSy9UTseQWIWUwA-Ihlgr3pp65jL=w408-h302-k-no',
            'asset_name'    => 'ISC Futsal Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.348554608721926,
            'longitude'     => 105.29959917619759,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.348554608721926, 105.29959917619759)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'Speed Futsal',
            'type'          => 'Sarana Olahraga',
            'address'       => 'Way Huwi, Kec. Jati Agung, Kabupaten Lampung Selatan, Lampung 35131',
            'phone'         => '+6289652300150',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipMN9hWYSXTl8NMvI6tiXkURyZNt5-tKjn9UWhAi=w408-h272-k-no',
            'asset_name'    => 'Speed Futsal Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.349409177978715,
            'longitude'     => 105.30039311006736,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.349409177978715, 105.30039311006736)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'Star Futsal',
            'type'          => 'Sarana Olahraga',
            'address'       => 'JL. Gunung Rajabasa Raya, No. T.21, Way Halim, 35361, Perumnas Way Halim, Way Halim, Kota Bandar Lampung, Lampung 35132',
            'phone'         => '+6282282717002',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipNMm2vDfaKIM_7J3X0MJ38t4pkbGzPPjW7EeKkN=s451-k-no',
            'asset_name'    => 'Star Futsal Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.371947324825238,
            'longitude'     => 105.2812133929335,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.371947324825238, 105.2812133929335)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'PB. Sheva Jaya',
            'type'          => 'Sarana Olahraga',
            'address'       => 'Way Dadi, Kec. Sukarame, Kota Bandar Lampung, Lampung 35132',
            'phone'         => '+6283802416697',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipM-7t3cQIEp9Hxqs_LKWz0T-5b57MdlIkLhgs8c=w408-h544-k-no',
            'asset_name'    => 'Sarana Olahraga Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.374223623883983,
            'longitude'     => 105.2847171849671,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.374223623883983, 105.2847171849671)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'Stadion Sumpah Pemuda',
            'type'          => 'Sarana Olahraga',
            'address'       => 'Komplek PKOR, Kedaton, Way Halim, Kota Bandar Lampung, Lampung 35132',
            'phone'         => '-',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipP1vTpOYHcLa8Q0LMihmkk-KrOH-Ej-jPin3rye=w203-h152-k-no',
            'asset_name'    => 'Stadion Sumpah Pemuda Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.37747734042335,
            'longitude'     => 105.2788504209327,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.37747734042335, 105.2788504209327)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'Lapangan Softball PKOR Lampung',
            'type'          => 'Sarana Olahraga',
            'address'       => 'Jl. Cengkeh Tengah III No.185, Perumnas Way Halim, Way Halim, Kota Bandar Lampung, Lampung 35132',
            'phone'         => '-',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipNHQJiavSropmiswscbxI0vUwhLf-bexoMQtp4a=w203-h114-k-no',
            'asset_name'    => 'Lapangan Softball PKOR Lampung Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.380130599851113,
            'longitude'     => 105.27901831010534,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.380130599851113, 105.27901831010534)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'Stadion Pahoman',
            'type'          => 'Sarana Olahraga',
            'address'       => 'Jl. Ir. H. Juanda, Pahoman, Kec. Tlk. Betung Utara, Kota Bandar Lampung, Lampung 35228',
            'phone'         => '+62721267637',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipPQAroMIf0WmkSCX5Bkhdmr0k2bhE4wwIzAur6T=w408-h306-k-no',
            'asset_name'    => 'Stadion Pahoman mage',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.424012327827245,
            'longitude'     => 105.26852065809531,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.424012327827245, 105.26852065809531)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'Futsal Jangkung',
            'type'          => 'Sarana Olahraga',
            'address'       => 'Jl. Dr. Sutomo, Penengahan, Kec. Tj. Karang Pusat, Kota Bandar Lampung, Lampung 35126',
            'phone'         => '-',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipNtXNjL7QwFlVDfF4vkmwv2dIk3LeM-aqelQGjJ=w493-h240-k-no',
            'asset_name'    => 'Futsal Jangkung Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.399419390777604,
            'longitude'     => 105.25895615752343,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.399419390777604, 105.25895615752343)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'Lapangan Bola Kp. Sawah Brebes',
            'type'          => 'Sarana Olahraga',
            'address'       => 'Jl. Sugriwo No.35, Sawah Brebes, Kec. Tj. Karang Tim., Kota Bandar Lampung, Lampung 35124',
            'phone'         => '-',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipNyw9GR0tkaK0SeuvFaBC0rbPeu9Rmkt4QLYT7H=w211-h100-k-no',
            'asset_name'    => 'Lapangan Bola Kp. Sawah Brebes Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.404608990286993,
            'longitude'     => 105.26377797317458,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.404608990286993, 105.26377797317458)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'Lapangan Kalpataru',
            'type'          => 'Sarana Olahraga',
            'address'       => 'Beringin Raya, Kec. Kemiling, Kota Bandar Lampung, Lampung 35155',
            'phone'         => '-',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipNbaCNwpL6__KWpKb90SCPezOsp-FtEV9IlQlzY=w408-h272-k-no',
            'asset_name'    => 'Lapangan Kalpataru Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.399478821754892,
            'longitude'     => 105.2077241931712,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.399478821754892, 105.2077241931712)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'Lapangan Basket Dino',
            'type'          => 'Sarana Olahraga',
            'address'       => 'Jl. Nusa Indah No.44, Rw. Laut, Engal, Kota Bandar Lampung, Lampung 35213',
            'phone'         => '-',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipM0KjihdBvn-xEhyRTH9L7jRfduXTkvFUPAPqnk=w203-h152-k-no',
            'asset_name'    => 'Lapangan Basket Dino Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.425701341358925,
            'longitude'     => 105.26625218103557,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.425701341358925, 105.26625218103557)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'Kolam Renang Pahoman',
            'type'          => 'Sarana Olahraga',
            'address'       => 'Jl. KH. Ahmad Dahlan, Pahoman, Kec. Tlk. Betung Utara, Kota Bandar Lampung, Lampung 35228',
            'phone'         => '-',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipPdwvSjZWbUgSKLv-wmf6yYePvTgzmG9apP3fU8=w203-h152-k-no',
            'asset_name'    => 'Kolam Renang Pahoman Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.426406885014613,
            'longitude'     => 105.26856601263506,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.426406885014613, 105.26856601263506)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'Ifa Futsal',
            'type'          => 'Sarana Olahraga',
            'address'       => 'Jl. Darussalam No.82, Susunan Baru, Kec. Tj. Karang Bar., Kota Bandar Lampung, Lampung 35111',
            'phone'         => '+62895610001106',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipNcqi-wEzQ_bmc_YMAPOnVq_kqejzbi36TnTEGc=w203-h114-k-no',
            'asset_name'    => 'Ifa Futsal Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.403100937289046,
            'longitude'     => 105.22946554291012,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.403100937289046, 105.22946554291012)')[0]->st_makepoint
        ]);

        // LOKASI WISATA
        DB::table('location_objects')->insert([
            'name'          => 'Puncak Mas',
            'type'          => 'Pariwisata',
            'address'       => 'Jl. PB. Marga, Sukadana Ham, Kec. Tj. Karang Bar., Kota Bandar Lampung, Lampung 35215',
            'phone'         => '+6282181155115',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipO3_bNmQdPO3awiGQn1WQts9en2KCniNXkgZdtq=w203-h152-k-no',
            'asset_name'    => 'Puncak Mas Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.420206674524016,
            'longitude'     => 105.22843176769157,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.420206674524016, 105.22843176769157)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'Teropong Kota Bukit Sindy',
            'type'          => 'Pariwisata',
            'address'       => 'Jl. Tamin, Pasir Gintung, Kec. Tj. Karang Pusat, Kota Bandar Lampung, Lampung 35121',
            'phone'         => '-',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipM5q5X4a-1-Fa_h93JanfSDJT4JAU3H-AynNnLR=w203-h152-k-no',
            'asset_name'    => 'Teropong Kota Bukit Sindy Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.404235023962042,
            'longitude'     => 105.25340055462618,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.404235023962042, 105.25340055462618)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'Air Terjun Batu Putu',
            'type'          => 'Pariwisata',
            'address'       => 'Sukadana Ham, Kec. Tj. Karang Bar., Kota Bandar Lampung, Lampung 35156',
            'phone'         => '-',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipNzjfXXIQDL75UCOKH-DQUPqW3cgpjO7jxlNQEp=w203-h135-k-no',
            'asset_name'    => 'Air Terjun Batu Putu Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.426820050995387,
            'longitude'     => 105.21818017417797,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.426820050995387, 105.21818017417797)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'Lembah Hijau',
            'type'          => 'Pariwisata',
            'address'       => 'Jl. Raden Imba Kusuma Ratu No.21, Sukadana Ham, Kec. Tj. Karang Bar., Kota Bandar Lampung, Lampung 52473',
            'phone'         => '+6281379788807',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipPJy0FXVqrlvGeo9ipA2AmCaZrBXi1CAVssPX-m=w203-h203-k-no',
            'asset_name'    => 'Lembah Hijau Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.415450012116672,
            'longitude'     => 105.23070007784798,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.415450012116672, 105.23070007784798)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'Wira Garden',
            'type'          => 'Pariwisata',
            'address'       => 'Jl. Wan Abdurrahman, Batu Putuk, Kec. Tlk. Betung Utara, Kota Bandar Lampung, Lampung 35239',
            'phone'         => '+6282185514123',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipOekWtMrHPZLiJ_j2Vd3I5TbcaSiDpqn_CxMtWJ=w203-h194-k-no',
            'asset_name'    => 'Wira Garden Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.43599936746948,
            'longitude'     => 105.2295690931681,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.43599936746948, 105.2295690931681)')[0]->st_makepoint
        ]);

        DB::table('location_objects')->insert([
            'name'          => 'Lampung Elephant Park',
            'type'          => 'Pariwisata',
            'address'       => 'Jl. Jend. Sudirman No.17, Enggal, Kec. Tj. Karang Pusat, Kota Bandar Lampung, Lampung 35213',
            'phone'         => '-',
            'source'        => 'Google Maps',
            'asset_link'    => 'https://lh5.googleusercontent.com/p/AF1QipMK_pUjIU1qeinJC7TIvxT6eQ0y9wqevrzEF4UR=w408-h306-k-no',
            'asset_name'    => 'Lampung Elephan Park Image',
            'asset_source'  => 'Google Maps',
            'latitude'      => -5.421517690088855,
            'longitude'     => 105.25996009688708,
            'geometry'      => DB::select('SELECT ST_MakePoint(-5.421517690088855, 105.25996009688708)')[0]->st_makepoint
        ]);
    }
}
