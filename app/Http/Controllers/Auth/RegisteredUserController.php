<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Http\UploadedFile;

class RegisteredUserController extends Controller
{

    public function index(){
        $d['model']=User::get();
        return view('Renter.index',$d); //folder Renter+index.blade
    }
    public function view($id){
        if(User::where('id',$id)->exists()){
            $d['model']=User::where('id',$id)->first();
            return view('Renter.view',$d); //folder Renter+view.blade
        }
    }
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required', 'string', 'max:255'],
            'renterIC' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'studNo' => ['nullable', 'string', 'max:255'], // Not required the field
            'licenseNo' => ['required', 'string', 'max:255'],
            'phoneNo' => ['required', 'string', 'max:255'], 
            'icImg' => ['required', 'image', 'max:2048'], // Assuming icImg is an image upload
            'icImg2' => ['required', 'image', 'max:2048'],
            'licImg' => ['required', 'image', 'max:2048'],
            'licImg2' => ['required', 'image', 'max:2048'],
            'role' => ['required', 'string', 'max:255'],
            'status_message' => ['required', 'string', 'max:255'],
        ]);
        $model=new User;
        if($request->hasFile('icImg')){
            $file=$request->file('icImg');
            $extension=$file->getClientOriginalExtension(); //generate unique filename
            $filename = time().'.'.$extension;
            $path = $file->move('uploads/renter/ic1/', $filename);
            $model->icImg = $filename;
        }
        if($request->hasFile('icImg2')){
            $file=$request->file('icImg2');
            $extension=$file->getClientOriginalExtension(); //generate unique filename
            $filename = time().'.'.$extension;
            $path = $file->move('uploads/renter/ic2/', $filename);
            $model->icImg2 = $filename;
        }
        if($request->hasFile('licImg')){
            $file=$request->file('licImg');
            $extension=$file->getClientOriginalExtension(); //generate unique filename
            $filename = time().'.'.$extension;
            $path = $file->move('uploads/renter/lic1/', $filename);
            $model->licImg = $filename;
        }
        if($request->hasFile('licImg2')){
            $file=$request->file('licImg2');
            $extension=$file->getClientOriginalExtension(); //generate unique filename
            $filename = time().'.'.$extension;
            $path = $file->move('uploads/renter/lic2/', $filename);
            $model->licImg2 = $filename;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'renterIC' => $request->renterIC,
            'address' => $request->address,
            'studNo' => $request->studNo,
            'licenseNo' => $request->licenseNo,
            'phoneNo' => $request->phoneNo,
            'icImg' => $model->icImg, // Store the path to the uploaded image
            'icImg2' => $model->icImg,
            'licImg' => $model->icImg,
            'licImg2' => $model->icImg,
            'role' => $request->role,
            'status_message' => $request->status_message,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    //untuk status
    public function show(int $id)
    {
        $user = User::where('id', $id)->first();

        if ($user) { 
            return view('Renter.view2', compact('user'));
        } else {    
            return redirect('/users')->with('message', 'User ID not found');
        }
    } 

    //untuk status 
    public function updateRenterStatus (int $id, Request $request) {
        $user = User::where('id', $id)->first();
        if($user){
    
            $user->update([
                'status_message' => $request->user_status
            ]);
            return redirect()->route('index-renter')->with('message', 'Book Status Updated');
        }else{
    
            return redirect()->route('index-renter')->with('message', 'Book ID not found');
        }
    }
}
