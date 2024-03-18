<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    // 
    public function index(){
        if (Auth::id()){  
            $id=Auth::User()->id;
            $d['model']=Reserve::where('user_id','=', $id)->get();
        }
        return view('Reserve.index',$d); //folder Reserve+index.blade
    } 

    public function createform(){
    return view('Reserve.create');   
    }

    public function create(Request $request)
    {
        $user=Auth::User();
        $model = new Reserve;
        $model->date = $request->date;
        $model->startTime = $request->startTime;
        $model->endTime = $request->endTime;
        $model->termCond = $request->termCond; 
        $model->user_id = $user->id; 

    $model->save();
    return redirect()->route('index-reserve');
    }

    public function updateform($id){
        $d['model']=Reserve::where('reserveID',$id)->first();
        return view('Reserve.update',$d); //folder Reserve+update.blade
    }

    public function update(Request $request, $id){
        $model=Reserve::where('reserveID',$id);
        $model->update([
            'date'=>$request->date,
            'startTime'=>$request->startTime,
            'endTime'=>$request->endTime,
            'termCond'=>$request->termCond,
        ]);
        return redirect()->route('index-reserve');
    }
}

