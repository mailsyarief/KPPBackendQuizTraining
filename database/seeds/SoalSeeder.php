<?php

use App\Soal;
use App\JawabanPilihanGanda;
use App\JawabanMencocokan;
use App\JawabanBenarSalah;
use App\PilihanJawabanMencocokan;
use Illuminate\Database\Seeder;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Arti code 200 pada PC 200-8 adalah……';
        $soal->tipe_soal = 'PILIHANGANDA';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanPilihanGanda;
        $pilgan->pilihan_a = 'Berat unit total 20 ton';
        $pilgan->pilihan_b = 'Berat unit siap operasi 20 ton';
        $pilgan->pilihan_c = 'Kapasitas bucket max 2 ton';
        $pilgan->pilihan_d = 'Kemampuan pengangkatan material 20 ton';
        $pilgan->jawaban = 'pilihan_b';
        $pilgan->soal_id = $soal->id;
        $pilgan->save();

        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Engine model yang digunakan pada PC 200-8 adalah…….';
        $soal->tipe_soal = 'PILIHANGANDA';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanPilihanGanda;
        $pilgan->pilihan_a = 'SAA6D107-1';
        $pilgan->pilihan_b = 'SAA6D107E-3';
        $pilgan->pilihan_c = 'SAA6D114E-2';
        $pilgan->pilihan_d = 'SAA6D107E-1';
        $pilgan->jawaban = 'pilihan_d';
        $pilgan->soal_id = $soal->id;
        $pilgan->save();

        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Tipe cylinder yang digunakan pada engine PC 200-8 adalah…….';
        $soal->tipe_soal = 'PILIHANGANDA';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanPilihanGanda;
        $pilgan->pilihan_a = 'Over stroke';
        $pilgan->pilihan_b = 'Over bore';
        $pilgan->pilihan_c = 'Over lap';
        $pilgan->pilihan_d = 'Square';
        $pilgan->jawaban = 'pilihan_a';
        $pilgan->soal_id = $soal->id;
        $pilgan->save();
        
        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Fuel system pada engine PC 200-8 menggunakan type……';
        $soal->tipe_soal = 'PILIHANGANDA';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanPilihanGanda;
        $pilgan->pilihan_a = 'Denso CRI';
        $pilgan->pilihan_b = 'Denso HPCR';
        $pilgan->pilihan_c = 'Bosch CRI';
        $pilgan->pilihan_d = 'Bosch HPCR';
        $pilgan->jawaban = 'pilihan_d';
        $pilgan->soal_id = $soal->id;
        $pilgan->save();        

        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Micron dari main fuel filter pada PC 200-8 adalah…..';
        $soal->tipe_soal = 'PILIHANGANDA';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanPilihanGanda;
        $pilgan->pilihan_a = '3µ';
        $pilgan->pilihan_b = '5µ';
        $pilgan->pilihan_c = '2µ';
        $pilgan->pilihan_d = '4µ';
        $pilgan->jawaban = 'pilihan_d';
        $pilgan->soal_id = $soal->id;
        $pilgan->save();

        $pilihanjawaban = New PilihanJawabanMencocokan;
        $pilihanjawaban->pilihan_jawaban = '8.5 Detik';
        $pilihanjawaban->paket_id = 1;
        $pilihanjawaban->save();
        $pilihanjawaban = New PilihanJawabanMencocokan;
        $pilihanjawaban->pilihan_jawaban = 'LS Valve';
        $pilihanjawaban->paket_id = 1;
        $pilihanjawaban->save();
        $pilihanjawaban = New PilihanJawabanMencocokan;
        $pilihanjawaban->pilihan_jawaban = 'PC Valve';
        $pilihanjawaban->paket_id = 1;
        $pilihanjawaban->save();
        $pilihanjawaban = New PilihanJawabanMencocokan;
        $pilihanjawaban->pilihan_jawaban = 'External gear pump';
        $pilihanjawaban->paket_id = 1;
        $pilihanjawaban->save();
        $pilihanjawaban = New PilihanJawabanMencocokan;
        $pilihanjawaban->pilihan_jawaban = '10µ';
        $pilihanjawaban->paket_id = 1;
        $pilihanjawaban->save();
        $pilihanjawaban = New PilihanJawabanMencocokan;
        $pilihanjawaban->pilihan_jawaban = 'Relief valve';
        $pilihanjawaban->paket_id = 1;
        $pilihanjawaban->save();
        $pilihanjawaban = New PilihanJawabanMencocokan;
        $pilihanjawaban->pilihan_jawaban = 'PSIG';
        $pilihanjawaban->paket_id = 1;
        $pilihanjawaban->save();
        $pilihanjawaban = New PilihanJawabanMencocokan;
        $pilihanjawaban->pilihan_jawaban = '5µ';
        $pilihanjawaban->paket_id = 1;
        $pilihanjawaban->save();
        $pilihanjawaban = New PilihanJawabanMencocokan;
        $pilihanjawaban->pilihan_jawaban = 'Waste Gate';
        $pilihanjawaban->paket_id = 1;
        $pilihanjawaban->save();
        $pilihanjawaban = New PilihanJawabanMencocokan;
        $pilihanjawaban->pilihan_jawaban = 'Internal gear pump';
        $pilihanjawaban->paket_id = 1;
        $pilihanjawaban->save();
        $pilihanjawaban = New PilihanJawabanMencocokan;
        $pilihanjawaban->pilihan_jawaban = 'PC valve';
        $pilihanjawaban->paket_id = 1;
        $pilihanjawaban->save();   
        $pilihanjawaban = New PilihanJawabanMencocokan;
        $pilihanjawaban->pilihan_jawaban = '7 detik';
        $pilihanjawaban->paket_id = 1;
        $pilihanjawaban->save();    
        $pilihanjawaban = New PilihanJawabanMencocokan;
        $pilihanjawaban->pilihan_jawaban = 'Unload valve';
        $pilihanjawaban->paket_id = 1;
        $pilihanjawaban->save();     
        $pilihanjawaban = New PilihanJawabanMencocokan;
        $pilihanjawaban->pilihan_jawaban = '280 Kg/cm2';
        $pilihanjawaban->paket_id = 1;
        $pilihanjawaban->save();    
        $pilihanjawaban = New PilihanJawabanMencocokan;
        $pilihanjawaban->pilihan_jawaban = '395 Kg/cm2';
        $pilihanjawaban->paket_id = 1;
        $pilihanjawaban->save(); 


        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Micron elemen fuel pre filter.';
        $soal->tipe_soal = 'MENCOCOKAN';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanMencocokan;
        $pilgan->jawaban = '10µ';
        $pilgan->soal_id = $soal->id;
        $pilgan->save();

        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Tipe feed pump PC 200-8.';
        $soal->tipe_soal = 'MENCOCOKAN';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanMencocokan;
        $pilgan->jawaban = 'External gear pump';
        $pilgan->soal_id = $soal->id;
        $pilgan->save();

        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Membatasi tekanan pada intake manifold.';
        $soal->tipe_soal = 'MENCOCOKAN';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanMencocokan;
        $pilgan->jawaban = 'Waste gate';
        $pilgan->soal_id = $soal->id;
        $pilgan->save();

        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Membatasi tekanan pada sistem ketika attachment netral.';
        $soal->tipe_soal = 'MENCOCOKAN';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanMencocokan;
        $pilgan->jawaban = 'Unload valve';
        $pilgan->soal_id = $soal->id;
        $pilgan->save();

        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Yang diubah adjusmentnya ketika power max ON.';
        $soal->tipe_soal = 'MENCOCOKAN';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanMencocokan;
        $pilgan->jawaban = 'Relief valve';
        $pilgan->soal_id = $soal->id;
        $pilgan->save();

        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Meminimalkan sudut pompa saat netral.';
        $soal->tipe_soal = 'MENCOCOKAN';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanMencocokan;
        $pilgan->jawaban = 'LS valve';
        $pilgan->soal_id = $soal->id;
        $pilgan->save();

        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Meminimalkan sudut pompa saat mendekati relief.';
        $soal->tipe_soal = 'MENCOCOKAN';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanMencocokan;
        $pilgan->jawaban = 'PC valve';
        $pilgan->soal_id = $soal->id;
        $pilgan->save();

        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Output LS EPC';
        $soal->tipe_soal = 'MENCOCOKAN';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanMencocokan;
        $pilgan->jawaban = 'PSIG';
        $pilgan->soal_id = $soal->id;
        $pilgan->save();
        
        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Power max akan reset otomstis setelah penggunaan selama….';
        $soal->tipe_soal = 'MENCOCOKAN';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanMencocokan;
        $pilgan->jawaban = '8.5 detik';
        $pilgan->soal_id = $soal->id;
        $pilgan->save();

        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Setting safety valve travel motor';
        $soal->tipe_soal = 'MENCOCOKAN';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanMencocokan;
        $pilgan->jawaban = '280 Kg/cm2';
        $pilgan->soal_id = $soal->id;
        $pilgan->save();

        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Pompa yang digunakan pada PC 200-8 adalah HPV 95 + 95, ini berarti pompa tersebut merupakan pompa tandem dengan displacement 95 cc per revolution pada masing-masing pompa.';
        $soal->tipe_soal = 'BENARSALAH';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanBenarSalah;
        $pilgan->jawaban = 1;
        $pilgan->soal_id = $soal->id;
        $pilgan->save();

        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'KMF125ABE-6 adalah tipe motor yang digunakan pada travel motor PC 200-8.';
        $soal->tipe_soal = 'BENARSALAH';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanBenarSalah;
        $pilgan->jawaban = 0;
        $pilgan->soal_id = $soal->id;
        $pilgan->save();

        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Spesific capacity hydraulic tang PC 200-8 adalah 135 liter.';
        $soal->tipe_soal = 'BENARSALAH';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanBenarSalah;
        $pilgan->jawaban = 0;
        $pilgan->soal_id = $soal->id;
        $pilgan->save();

        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Sistem hydraulic pada PC 200-8 adalah Electronic CLSS.';
        $soal->tipe_soal = 'BENARSALAH';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanBenarSalah;
        $pilgan->jawaban = 1;
        $pilgan->soal_id = $soal->id;
        $pilgan->save();

        $soal = New Soal;
        $soal->soal_gambar = null;
        $soal->soal = 'Swing machinary PC 200-8 menggunakan tipe planetary gear 2 kali reduksi.';
        $soal->tipe_soal = 'BENARSALAH';
        $soal->paket_id = 1; //PK PC 200
        $soal->save();
        $pilgan = New JawabanBenarSalah;
        $pilgan->jawaban = 1;
        $pilgan->soal_id = $soal->id;
        $pilgan->save();



        
    }
}
