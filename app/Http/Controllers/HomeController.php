<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Peserta;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'title' => 'Home',
            'peserta' => Peserta::all()->count(),
            'kkm' => Peserta::where('nilai','>=',70 )->count(),
            'section' => Section::all()->count()
        ];
        return view('home')->with(compact('data'));
    }
}
