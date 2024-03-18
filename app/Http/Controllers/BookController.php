<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reserve;
use App\Models\Vehicle;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 

class BookController extends Controller
{
    public function updateform2($id){
        $d['model']=Vehicle::where('veID',$id)->first();
        return view('Vehicle.update2',$d); //folder Vehicle+update2.blade
    }

    public function index2(){
        $d = [];
    
        if (Auth::check()) {
            $id = Auth::user()->id; 
            $d['model'] = Book::where('user_id', $id)->get();
        }
    
        // Assuming you want the latest Reserve record based on some criteria
        $reserve = Reserve::latest()->first();
    
        if ($reserve) {
            $reserveID = $reserve->reserveID; 
            $d['model'] = Book::where('reserve_id', $reserveID)->get();
        }
    
        return view('Vehicle.index2', $d); //folder Vehicle+index2.blade
    }
    
    public function afterCreate(Request $request){
        $user = Auth::user();

        $model = new Book; 
        $model->vePlateNo = $request->vePlateNo; 
        $model->veType = $request->veType; 
        $model->veBrand = $request->veBrand;
        $model->veModel = $request->veModel;
        $model->vePrice = $request->vePrice; 

        // Handle file upload (for deposit)
        if ($request->hasFile('file')){
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('assets', $filename);
            $model->file = $filename;
        }

        $model->user_id = $user->id;

        // Save the model first
        $model->save();

        // Retrieve the latest Reserve record after saving it
        $reserve = Reserve::latest()->first();

        if ($reserve) {
        $model->reserve_id = $reserve->reserveID;
        $model->save();
        }

        return redirect()->route('index2'); 
    }

    public function delete($id){
        Book::where('bookID',$id)->delete();   
        return redirect()->route('dashboard');
    }

    public function index3(){ 
        $d['model']=Book::get();
        return view('Vehicle.index3',$d); //folder Vehicle+index3.blade
    }

    //untuk status
    public function show(int $bookID)
    {
        $book = Book::where('bookID', $bookID)->first();

        if ($book) { 
            return view('Vehicle.view2', compact('book'));
        } else {    
            return redirect('/books')->with('message', 'Book ID not found');
        }
    } 

    //untuk status 
    public function updateBookStatus(int $bookID, Request $request)
    {
        $book = Book::where('bookID', $bookID)->first();
    
        if ($book) {
            $book->update([
            'status_message' => $request->book_status
        ]);
            return redirect()->route('index3')->with('message', 'Book Status Updated');
        } else {
            return redirect()->route('index3')->with('message', 'Book ID not found');
        }
    }

    public function index4(){
        if (Auth::id()){  
            $id=Auth::User()->id;
            $d['model']=Book::where('user_id','=', $id)->get();
        }
        return view('Vehicle.index4',$d); //folder Reserve+index4.blade
    }
    
    //untuk DEPOSIT
    public function shows() { //untuk SHOW
 
        $data=Book::all();
        return view('Deposit.showdeposit',compact('data')); 
 
    }
 
    public function download(Request $request,$file) { //untuk DOWNLOAD
 
        return response()->download(public_path('assets/'.$file));
 
    }
 
    public function view($id) { //untuk VIEW
 
        $data=Book::find($id);
        return view('Deposit.viewdeposit',compact('data')); 
 
    } 
}

