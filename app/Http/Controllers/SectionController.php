<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use DB;

class SectionController extends Controller
{
    public function LihatSection(){
        return response()->json(['error' => 0,'message' => Section::all() ], 200);
    }
    public function HapusSection(Request $request){
        Section::find($request->id)->delete();
        return response()->json(['error' => 0,'message' => array() ], 200);
    }
    public function EditSection(Request $request){
        $section = Section::find($id)->first();
        $section->nama = $request->nama;
        $section->keterangan = $request->keterangan;
        $section->save();
        return Redirect::back();
    }
    public function TambahSection(Request $request){
        $section = New Section;
        $section->nama = $request->nama;
        $section->keterangan = $request->keterangan;
        $section->save();
        return Redirect::back();
    }
}
