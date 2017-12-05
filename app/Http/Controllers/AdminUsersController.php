<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Adminuser;
use App\Facturacionuser;
use App\Ventasuser;
use App\Produccionuser;

class AdminUsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['adminuser','auth:adminuser']);
    }
    public function listarUsuarios($tipo)
    {
    	switch ($tipo)
    	{
		    case "admin":
		    	if(Auth::user()->tipo == 'all')
		    	{
		    		return view('adminuser.users.tabla_admins',['lista' => Adminuser::all()]);
		    	}
		        abort(404);
		        break;
		    case "ventas":
			    if(Auth::user()->tipo == 'all' || Auth::user()->tipo == 'ventas')
			    {
			    	return view('adminuser.users.tabla_ventasusers',['lista' => Ventasuser::all()]);
			    }
		        abort(404);
		        break;
		    case "produccion":
		    	if(Auth::user()->tipo == 'all' || Auth::user()->tipo == 'produccion')
		    	{
		    		return view('adminuser.users.tabla_produccionusers',['lista' => Produccionuser::all()]);
		    	}
		        abort(404);
		        break;
		    case "facturacion":
		    	if(Auth::user()->tipo == 'all' || Auth::user()->tipo == 'facturacion')
		    	{
		    		return view('adminuser.users.tabla_facturacionusers',['lista' => Facturacionuser::all()]);
		    	}
		        abort(404);
		        break;
		}
		abort(404);
    }
    public function nuevoUsuario(Request $request, $tipo)
    {
    	switch ($tipo)
    	{
    		case "admin":
		    	if(Auth::user()->tipo == 'all')
		    	{
		    		$this->validate($request, ['name' => 'required|max:100', 'email' => 'required|email|unique:adminusers,email', 'password' => 'required|max:100|min:4|confirmed', 'tipo' => 'required|in:ventas,facturacion,produccion,all']);
		    		$nuevo = new Adminuser(['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password), 'tipo' => $request->tipo]);
		    		$nuevo->save();
		    		return redirect('/adminuser/users/'.$tipo)->with('mensaje','Usuario creado exitosamente');

		    	}
		        abort(404);
		        break;
		    case "ventas":
			    if(Auth::user()->tipo == 'all' || Auth::user()->tipo == 'ventas')
			    {
			    	$this->validate($request, ['name' => 'required|max:100', 'email' => 'required|email|unique:ventasusers,email', 'password' => 'required|max:100|min:4|confirmed']);
			    	$nuevo = new Ventasuser(['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password)]);
			    	$nuevo->save();
			    	return redirect('/adminuser/users/'.$tipo)->with('mensaje','Usuario creado exitosamente');
			    }
		        abort(404);
		        break;
		    case "produccion":
		    	if(Auth::user()->tipo == 'all' || Auth::user()->tipo == 'produccion')
		    	{
		    		$this->validate($request, ['name' => 'required|max:100', 'email' => 'required|email|unique:produccionusers,email', 'password' => 'required|max:100|min:4|confirmed']);
		    		$nuevo = new Produccionuser(['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password)]);
		    		$nuevo->save();
		    		return redirect('/adminuser/users/'.$tipo)->with('mensaje','Usuario creado exitosamente');
		    	}
		        abort(404);
		        break;
		    case "facturacion":
		    	if(Auth::user()->tipo == 'all' || Auth::user()->tipo == 'facturacion')
		    	{
		    		$this->validate($request, ['name' => 'required|max:100', 'email' => 'required|email|unique:facturacionusers,email', 'password' => 'required|max:100|min:4|confirmed']);
		    		$nuevo = new Facturacionuser(['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password)]);
		    		$nuevo->save();
		    		return redirect('/adminuser/users/'.$tipo)->with('mensaje','Usuario creado exitosamente');
		    	}
		        abort(404);
		        break;
    	}
    	abort(404);
    }
    public function eliminarUsuario(Request $request, $tipo)
    {
    	switch ($tipo)
    	{
    		case "admin":
		    	if(Auth::user()->tipo == 'all')
		    	{
		    		$this->validate($request, ['id' => 'required|exists:adminusers']);
		    		Adminuser::destroy($request->id);
		    		return redirect('/adminuser/users/'.$tipo)->with('mensaje','Usuario Eliminado exitosamente');

		    	}
		        abort(404);
		        break;
		    case "ventas":
			    if(Auth::user()->tipo == 'all' || Auth::user()->tipo == 'ventas')
			    {
			    	$this->validate($request, ['id' => 'required|exists:ventasusers']);
		    		Ventasuser::destroy($request->id);
		    		return redirect('/adminuser/users/'.$tipo)->with('mensaje','Usuario Eliminado exitosamente');
			    }
		        abort(404);
		        break;
		    case "produccion":
		    	if(Auth::user()->tipo == 'all' || Auth::user()->tipo == 'produccion')
		    	{
		    		$this->validate($request, ['id' => 'required|exists:produccionusers']);
		    		Produccionuser::destroy($request->id);
		    		return redirect('/adminuser/users/'.$tipo)->with('mensaje','Usuario Eliminado exitosamente');
		    	}
		        abort(404);
		        break;
		    case "facturacion":
		    	if(Auth::user()->tipo == 'all' || Auth::user()->tipo == 'facturacion')
		    	{
		    		$this->validate($request, ['id' => 'required|exists:facturacionusers']);
		    		Facturacionuser::destroy($request->id);
		    		return redirect('/adminuser/users/'.$tipo)->with('mensaje','Usuario Eliminado exitosamente');
		    	}
		        abort(404);
		        break;
    	}
    	abort(404);
    }
}
