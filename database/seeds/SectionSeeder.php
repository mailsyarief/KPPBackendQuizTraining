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
        $section->save();

        $section = New Section;
        $section->nama = 'track';
        $section->save();

        $section = New Section;
        $section->nama = 'sse/hauling';
        $section->save();
    }
}
