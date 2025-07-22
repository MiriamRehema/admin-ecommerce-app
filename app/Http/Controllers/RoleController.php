<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
{
    // examples:
    $this->middleware(['permission:role-list|role-create|role-edit|role-delete'])->only(['index', 'show']);
    $this->middleware(['permission:role-edit'])->only(['edit', 'update']);
    $this->middleware(['permission:role-create'])->only(['create', 'store']);
    $this->middleware(['permission:role-delete'])->only(['destroy']);
   
        
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       
        //
       
        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions=Permission::all();
        
        return view('roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name'=>'required|unique:roles,name',

            
            
        ]

        );
        $role=Role::create([
            'name'=>$request->name
           
        ]);
        $role->syncPermissions($request->permissions);
        //dd($request->permissions);

        return redirect()->route('roles.index')
               ->with("success","Role created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $role =Role::find($id);
        return view('roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role =Role::find($id);
        //dd($role);
        
        $permissions=Permission::all();
        //dd($permissions);
       return view('roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
       $request->validate([
            'name'=>'required',  
        ]
        ); 
        $role =Role::find($id);
        $role->name=$request->name;
        $role->save();

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')
               ->with("success","Role updated successfully");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role=Role::find($id);
        $role->delete();
        return redirect()->route('roles.index')
               ->with("success","Successfully Deleted");
    
    }
}
