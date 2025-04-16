<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserve;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return Inertia::render('Admin/ReserveManagment', [
            'reserves' => Reserve::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/ReserveCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'reservationer' => 'required',
        'user_id'=> 'required',
        'reservation_datetime'=> 'required',
        'ambient_id'=> 'required',
    ]);

    Reserve::create([
        'reservationer' => $request -> reservationer,
        'user_id' => $request -> user_id,
        'reservation_datetime' => $request -> reservation_datetime,
        'ambient_id' => $request -> ambient_id 
    ]);

    return redirect()->route('reserves.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   $reserves = Reserve::find($id);
        return Inertia::render('Admin/ReserveEdit', [
            'reserves' => $reserves
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required', 
            'password' => "required", 
            'email' => "required",
            "cpf" => "required", 
            "cep" => "required",
            "telephone" => "required",
            "user_type" => "required"
        ]);
    
       $reserve = Reserve::find($id);
    
       $reserve->name = $request->name;
       $reserve->password = $request->password;
       $reserve->email = $request->email;
       $reserve->cep = $request->cep;
       $reserve->cpf = $request->cpf;
       $reserve->telephone = $request->telephone;
       $reserve->user_type = $request->user_type;
    
       $reserve->save();
    
        return redirect()->route('reserves.index')->with('success', 'Reserva atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        Reserve::destroy($id);
        return redirect()->route('reserves.index');
    }
}