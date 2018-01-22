<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Itens;

class ItensController extends Controller
{
    public function cadastrar(Request $request)
    {

        $get_discpl = DB::table('disciplines')->select('id','name', 'code', 'load')
            ->where('name', '=', [$request->atvc])
            ->where('load', '=', [$request->ch])->get();
        $get_id_curso = DB::table('courses')->select('id')
            ->where('name', '=', [$request->curso])->get();
        $get_natureza = DB::table('course_disciplines')->select('nature')
            ->where('course_id', '=', $get_id_curso[0]->id)
            ->where('discipline_id', '=', $get_discpl[0]->id)->get();

            //dd($get_natureza);
        return view("Itens.itensdispensa",
            compact("get_discpl", "get_natureza"));
    }
    public function MostrarView(){
        return view('Itens.itens');
    }
}