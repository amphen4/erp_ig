<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Adminevento;
use Illuminate\Support\Facades\Auth;

class AdminCalendarioController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function enviarEventos()
    {

        return Adminevento::all()->toJson();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardarEvento(Request $request)
    {
        $this->validate($request, ['title' => 'required|string|max:100',
        							'start' => 'required',
        							'end' => 'required',
                                  ]);
        $wow = new Adminevento;
        $wow->title = $request->title;
        $wow->start = $request->start;
        $wow->end = $request->end;
        $wow->save();

        return response()->json([
		    'wow' => 'Wow'
		]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request, $id)
    {
        $wow = Adminevento::findOrFail($id);
        $this->validate($request, ['title' => 'required|string|max:100',
        							'start' => 'required',
        							'end' => 'required',
                                  ]);
        $wow->title = $request->title;
        $wow->start = $request->start;
        $wow->end = $request->end;
        $wow->save();
        return response()->json([
		    'wow' => 'Wow'
		]);
    }
    public function eliminar(Request $request,$id)
    {
    	$this->validate($request, ['method' => 'required|in:DELETE',
                                  ]);
    	Adminevento::findOrFail($id);
        Adminevento::destroy($id);
        return response()->json([
		    'wow' => 'Wow'
		]);
    }
}
