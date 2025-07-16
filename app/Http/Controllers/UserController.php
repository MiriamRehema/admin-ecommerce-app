<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;

use App\Models\User;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
      
         return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=Role::all();
         dd($roles);
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        //dd($request->all());
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|string|email|max:255|unique:users',
            'password'=>'required|string|min:8',
            
        ]

        );
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
            // 'email_verified_at'=>now(),
            // 'remember_token'=>null,
            // 'created_at'=>now(),
            // 'updated_at'=>now(),
        ]);
        $user->syncRoles($request->roles);
        return redirect()->route('users.index')
               ->with("success","User created successfully");
        //,dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user =User::find($id);
        $roles =$user->roles;
        return view('users.show',compact('user','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user =User::find($id);
        $roles=Role::all();

        return view('users.edit',compact("user","roles"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required'
            
        ]
        );
        $user = User::find($id);

        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();

         return redirect()->route('users.index')
               ->with("success","User updated successfully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $user=User::find($id);
        $user->delete();
        return redirect()->route('users.index')
               ->with("success","Successfully Deleted");
    }
}
