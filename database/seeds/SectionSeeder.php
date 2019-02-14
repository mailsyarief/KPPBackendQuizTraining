<?php

use Illuminate\Database\Seeder;
use App\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $section = New Section;
        $section->nama = 'wheel';
        $section->keterangan = '-';
        $section->save();

        $section = New Section;
        $section->nama = 'track';
        $section->keterangan = '-';
        $section->save();

        $section = New Section;
        $section->nama = 'sse';
        $section->keterangan = '-';
        $section->save();

        $section = New Section;
        $section->nama = 'hauling';
        $section->keterangan = '-';
        $section->save();
    }
}
