<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\images;


class UserController extends Controller
{
    //
    public function config()
    {
        $user = \Auth::user();
        $name = $user->name;
        $surname = $user->surname;
        $nick = $user->nick;
        $email = $user->email;
        $avatar = $user->image;
        return view('user.config', compact('name', 'surname', 'nick', 'email', 'avatar'));
        
        //return view( 'user.config', array('user' => array('user' => $user)) ) ;
    }
    public function update(Request $request)
    {
        //
        $user = \Auth::user();
        $id = $user->id;
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');
        if (! $password)
        {
            $password=$user->password;
        }

        $avatar = $request->file('avatar');
        $image_path = $avatar;
        if($image_path)
        {   // poner nombre único
            $image_path_name = time().$image_path->getClientOriginalName();

            //Guardar la imagen en la carpeta (storage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            // Seteo el nombre de la imagen en el objeto
            $user->image = $image_path_name;
        }
        $user->update([
            'name' => $name,
            'surname' => $surname,
            'nick' => $nick,
            'email' => $email,
            'password' => Hash::make($password),
            'image' => $image_path,
        ]);
       // $user->save();

        return redirect('/')->with('message', 'Usuario actualizado correctamente');
    }
    public function profile()
    {   
        $user = \Auth::user();
        $id = $user->id;

        $images = images::where('user_id', '=', $id)->paginate();
        return view('home',compact('images'));
    }
}

