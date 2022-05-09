<?php

namespace App\Http\Controllers;

use App\Models\Juegos;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JuegosController extends Controller
{
    public function max_scores(){
        $max_scores = DB::table('tbl_ranita')
        ->orderBy('MAX_SCORE', 'desc')
        ->limit(5)
        ->get();
        return response()->json($max_scores);
    }
    public function new_score(Request $request){
        try {
            DB::beginTransaction();
            DB::insert('insert into tbl_ranita (user,max_score) values (?,?)',
            [$request['new_user'],$request['level']]);
            DB::commit();
            return response()->json("OK");
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        
    }
    
}
