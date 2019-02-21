<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use Redirect;
use DB;

class SectionController extends Controller
{
    public function LihatSection()
    {
        $data = [
            'title' => 'Section',
            'section' => Section::all()
        ];
        return view('section')->with(compact('data'));
    }
    public function HapusSection($id)
    {
        Section::find($id)->delete();
    	return Redirect::back()->with('pesan_sukses', 'Section berhasil dihapus');
    }
    public function EditSection(Request $request){
        $validator  = $request->validate([
            'nama'      => 'required'
        ]);
        DB::BeginTransaction();
        try{
            $section = Section::find($id);
            $section->nama = $request->nama;
            $section->keterangan = $request->keterangan;
            $section->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return Redirect::back()->with('pesan_sukses', 'Section berhasil diubah');
    }
    public function TambahSection()
    {
        $data = [
            'title' => 'Tambah Section'
        ];
        return view('tambahsection')->with(compact('data'));
    }

    public function TambahSectionSubmit(Request $request){
        $validator  = $request->validate([
            'nama'      => 'required'
        ]);
        DB::BeginTransaction();
        try{
            $section = New Section;
            $section->nama = $request->nama;
            $section->save();
            DB::commit(); 
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect('section')->with('pesan_sukses', 'Section berhasil ditambah');
    }
}
