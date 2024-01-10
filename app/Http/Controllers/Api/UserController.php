<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::select('user.*','name')
            ->join('email', 'email.id', '=', 'user.email')
            ->join('password', 'password.id', '=', 'user.password')
            ->join('role', 'role.id', '=', 'user.role')
            ->get();
    return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name =$request->get('name'); 
        $email =$request->get('email');
        $password =$request->get('password');
        $role =$request->get('role');
        User::create([
        'name'=>$name,
        'email'=>$email,
        'password'=>$password,
        'role'=>$role,
        ]);
        return response()->json(['sukses create data'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $name =$request->get('name'); 
        $email =$request->get('email');
        $password =$request->get('password');
        $role =$request->get('role');
        $user->update([
        'name'=>$name,
        'email'=>$email,
        'password'=>$password,
        'role'=>$role,
        ]);
        return response()->json(['sukses update data'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['sukses delete data'], 200);
    }
}
