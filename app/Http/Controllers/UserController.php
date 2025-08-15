<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Collection;

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
        //dd($user, $user?->roles);
        // dd($roles);
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
            'is_active'=>'required|boolean', // Assuming active is a boolean field
            
        ]

        );
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'is_active'=>$request->is_active, // Assuming active is a boolean field
            // 'email_verified_at'=>now(),
            // 'remember_token'=>null,
            // 'created_at'=>now(),
            // 'updated_at'=>now(),
        ]);
        $roles = $request->roles;
        if (is_array($roles) && isset($roles[0]) && is_string($roles[0]) && str_starts_with($roles[0], '[')) {
            $roles = json_decode($roles[0], true);
        }
        $user->syncRoles($roles);
        //dd($request->roles);
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
      
        //dd( $user?->roles);
        return view('users.show',compact('user'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //dd($id);
         
         //dd($roles);
         
         //dd($user?->roles);
         //dd($user?->roles->pluck('name')->toArray());
        $user =User::with('roles')->find($id);
        $roles=Role::all();
        //dd($user, $user?->roles);
        //dd($user->roles);

        return view('users.edit',compact("user", "roles"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'nullable',
            'is_active'=>'required|boolean',
        ]);
        $user = User::find($id);

        $user->name=$request->name;
        $user->email=$request->email;
        $user->is_active=$request->is_active; // Assuming active is a boolean field
        $user->password=Hash::make($request->password);
        $user->save();
 

        $roles = $request->roles;
        if (is_array($roles) && isset($roles[0]) && is_string($roles[0]) && str_starts_with($roles[0], '[')) {
            $roles = json_decode($roles[0], true);
        }
        $user->syncRoles($roles);
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
   public function searchUser(Request $request): Collection
   
{
    
    return User::query()
        ->select('id', 'name')
        ->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        })
        ->when(
            $request->exists('selected'),
            fn ($query) => $query->whereIn('id', $request->input('selected', [])),
            fn ($query) => $query->limit(10)
        )
        ->get();
    //dd($request->all());
        
}
}