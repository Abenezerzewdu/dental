<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RoleAssignController extends Controller
{
    //
    public function index(){
        return Inertia::render('Admin/Roles',[
           'users'=>User::with('roles')->get(),
           'roles'=>Role::all(),
        ]);
    }

    public function assignRole(Request $request){
      //validate the users 
       $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);
      //get user based on id 
        $user = User::findOrFail($request->user_id);
      // assign or change existing role of user that we found
        $user->syncRoles([$request->role]);

        return back()->with('success', 'Role assigned successfully.');
    
    }
}
