<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request; 

class VehicleController extends Controller  
{
    //
    public function index(){
        $d['model']=Vehicle::get();
        return view('Vehicle.index',$d); //folder Vehicle+index.blade
    }

    public function view($id){
        if(Vehicle::where('veID',$id)->exists()){
            $d['model']=Vehicle::where('veID',$id)->first();
            return view('Vehicle.view',$d); //folder Vehicle+view.blade 
        }
    }

    public function createform(){
        return view('Vehicle.create'); //folder Vehicle+create.blade
    }

    public function create(Request $request){
        $model=new Vehicle;
        $model->vePlateNo = $request->vePlateNo;
        $model->veType = $request->veType;
        $model->veBrand = $request->veBrand;
        $model->veModel = $request->veModel;

        if($request->hasFile('veImg')){
            $file=$request->file('veImg');
            $extension=$file->getClientOriginalExtension(); //generate unique filename
            $filename = time().'.'.$extension;
            $path = $file->move('uploads/vehicle/front/', $filename);
            $model->veImg = $filename;
        }
        
        if($request->hasFile('veImg2')){
            $file=$request->file('veImg2');
            $extension=$file->getClientOriginalExtension(); //generate unique filename
            $filename = time().'.'.$extension;
            $path = $file->move('uploads/vehicle/back/', $filename);
            $model->veImg2 = $filename;
        }

        if($request->hasFile('veImg3')){
            $file=$request->file('veImg3');
            $extension=$file->getClientOriginalExtension(); //generate unique filename
            $filename = time().'.'.$extension;
            $path = $file->move('uploads/vehicle/interior/', $filename);
            $model->veImg3 = $filename;
        }

        $model->vePrice = $request->vePrice; 
        $model->condition = $request->condition;
        $model->availability = $request->availability;
        $model->carSeat = $request->carSeat;
        $model->save();
        return redirect()->route('index-vehicle'); 
    }

    public function updateform($id){
        $d['model']=Vehicle::where('veID',$id)->first();
        return view('Vehicle.update',$d); //folder Vehicle+update.blade
    }

    public function update(Request $request, $id){
        $model=Vehicle::where('veID',$id)->first();
        $model->update([
            'vePlateNo'=>$request->vePlateNo,
            'veType'=>$request->veType,
            'veBrand'=>$request->veBrand,
            'veModel'=>$request->veModel,
            'condition'=>$request->condition,
            'availability'=>$request->availability,
            'carSeat'=>$request->carSeat,
            'vePrice'=>$request->vePrice,
        ]);
        if ($request->hasFile('veImg')) {
            $file = $request->file('veImg');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = $file->move('uploads/vehicle/front/', $filename);
            $model->veImg = $filename; // Update the veImg field with the new filename
        }
        if ($request->hasFile('veImg2')) {
            $file = $request->file('veImg2');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = $file->move('uploads/vehicle/back/', $filename);
            $model->veImg2 = $filename; // Update the veImg2 field with the new filename
        }
        if ($request->hasFile('veImg3')) { 
            $file = $request->file('veImg3');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = $file->move('uploads/vehicle/interior/', $filename);
            $model->veImg3 = $filename; // Update the veImg3 field with the new filename
        }
        $model->save();
        return redirect()->route('index-vehicle'); 
    }

    public function delete($id){
        Vehicle::where('veID',$id)->delete();  
        return redirect()->route('index-vehicle');
    }

    public function updateformAv($id){
        $d['model']=Vehicle::where('veID',$id)->first();
        return view('Vehicle.updateAv',$d); //folder Vehicle+update.blade
    }

    public function updateAv(Request $request, $id){
        $model=Vehicle::where('veID',$id)->first();
        $model->update([
            'vePlateNo'=>$request->vePlateNo,
            'veType'=>$request->veType,
            'veBrand'=>$request->veBrand,
            'veModel'=>$request->veModel,
            'condition'=>$request->condition,
            'availability'=>$request->availability,
            'carSeat'=>$request->carSeat,
            'vePrice'=>$request->vePrice,
        ]);
        if ($request->hasFile('veImg')) {
            $file = $request->file('veImg');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = $file->move('uploads/vehicle/front/', $filename);
            $model->veImg = $filename; // Update the veImg field with the new filename
        }
        if ($request->hasFile('veImg2')) {
            $file = $request->file('veImg2');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = $file->move('uploads/vehicle/back/', $filename);
            $model->veImg2 = $filename; // Update the veImg2 field with the new filename
        }
        if ($request->hasFile('veImg3')) {  
            $file = $request->file('veImg3');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = $file->move('uploads/vehicle/interior/', $filename);
            $model->veImg3 = $filename; // Update the veImg3 field with the new filename
        }
        $model->save();
        return redirect()->route('updateform2-vehicle',['id'=>$model->veID]); 
    }
}

