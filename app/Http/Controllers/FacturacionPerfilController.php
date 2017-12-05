<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Validation\Rule;

class FacturacionPerfilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['facturacionuser','auth:facturacionuser']);
    }
    public function mostrarPerfil()
    {
        return view('facturacionuser.perfil.perfil');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mostrarImagenPerfil($id)
    {
    	$filename = 'facturacion-'.$id.'.jpg';
        if(Storage::disk('perfiles')->exists($filename))
        {
            $file = Storage::disk('perfiles')->get($filename);
            return new Response($file,200);
        }
        $file = Storage::disk('perfiles')->get('sin_foto.jpg');
        return new Response($file,200);
    }
    public function guardarPerfil(Request $request)
    {
        $this->validate($request, ['name' => 'required|string|max:100',
                                   'email' => ['required','string','email','max:100', Rule::unique('facturacionusers')->ignore(Auth::user()->id)],
                                   'password' => 'nullable|string|min:4|confirmed', 
                                   'perfil' => 'nullable|image|max:2000|mimes:jpeg'
                                  ]);
        $usuario = Auth::user();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if(!empty($request->password))
        {
            $usuario->password = bcrypt($request->password);
        }
        if($request->perfil)
        {
            $file = $request->file('perfil');
            $filename = 'facturacion-'.Auth::user()->id.'.jpg';
            if($file)
            {
                Storage::disk('perfiles')->put($filename, File::get($file));
            }
        }
        $usuario->save();

        return redirect(url('/facturacionuser/perfil'))->with('mensaje','Perfil actualizado correctamente!');
    }
}
