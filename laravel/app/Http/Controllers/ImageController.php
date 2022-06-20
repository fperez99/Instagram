<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;;
use App\images;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class imageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_id' => ['required', 'integer', 'max:255'],
            'description' => ['required', 'string'],
            'image_path' => ['required', 'string', 'max:255'],
            
        ]);
    }

    public function formy(){
        return view('image.crearImage');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Image
     */
    protected function create(Request $request)
    {   $usuario = \Auth::user();
        $id = $usuario->id;
        $user = $request->input('user_id');
        $description =$request->input('description');
        $image_path = $request->file('image_path');

        $image_path_name = time().$image_path->getClientOriginalName();
        Storage::disk('images')->put($image_path_name, File::get($image_path));
        
        $image =images::create([
            'user_id' => $user,
            'image_path' => $image_path_name,
            'description' => $description,
        ]);
        return redirect('/')->with('message', 'Usuario actualizado correctamente');
    }


    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }
}