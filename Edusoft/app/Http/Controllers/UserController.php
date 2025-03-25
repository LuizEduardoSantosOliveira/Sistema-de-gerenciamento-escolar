<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return Inertia::render('Admin/UserManagment', [
            'users' => User::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/UserCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'name' => 'required', 'password' => "required" , "email" => "required",
        "cpf" => "required", "cep" => "required","telephone" => "required",
        "user_type" => "required"
    
    
    ]);

    User::create([
        'name' => $request->name,
        'password'=> $request->password,
        'email'=> $request->email,
        'cpf'=> $request->cpf,
        "cep"=> $request->cep,
        "telephone"=>$request->telephone,
        "user_type" => $request->user_type
        
    ]);

    return redirect()->route('users.index');

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
    {   $users = User::find($id);
        return Inertia::render('Admin/UserEdit', [
            'users' => $users
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
    
        $user = User::find($id);
    
        // Correção: Use a sintaxe correta para atribuição
        $user->name = $request->name;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->cep = $request->cep;
        $user->cpf = $request->cpf;
        $user->telephone = $request->telephone;
        $user->user_type = $request->user_type;
    
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        User::destroy($id);
        return redirect()->route('users.index');
    }
}
