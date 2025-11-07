<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all users to be displayed
        $users=User::all();
       return Inertia::render('Users/Index',[
            'users'=>$users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //show user creating form
        return Inertia::render("Users/Create");
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate the form data
$validated=$request->validate(
      [
        'name'=>'required|String|max:255 ',
        'email'=>'required|email|unique:users,email',
        'password'=>'required|min:6',
        'phone'=>'nullable|String|max:15',
        'photo'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]
      );
    //handle photo uploading
    $photoPath=null;
    if($request->hasFile('photo')){
      $photoPath=$request->file('photo')->store('photos','public');
    }
        //store validated data

        User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>bcrypt($validated['password']),
            'phone'=>$validated['phone']??null,
            'photo'=>$photoPath,
        ]);
        //redirect to page we want to navigate
        return redirect()->route('users.index')->with('success',"created a user successfully !!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //use findOrFail method to get a single user
        $user=User::findOrFail($id);

        //display the editing page with current user data

        return Inertia::render('Users/Show',[
              'user'=>$user,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get the user selected
        $user=User::findOrFail($id);

        return Inertia::render('Users/Edit',[
               'user'=>$user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
{
    // Step 1: Retrieve the user
    $user = User::findOrFail($id);

    // Step 2: Validate the request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6',
        'phone' => 'nullable|string|max:20',
        'photo' => 'nullable|image|max:2048',
    ]);

    // Step 3a: Optional password
    if (!empty($validated['password'])) {
        $user->password = bcrypt($validated['password']);
    }

    // Step 3b: Optional photo
    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('users', 'public');
        $user->photo = $path;
    }

    // Step 4: Update other fields
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->phone = $validated['phone'] ?? $user->phone;

    $user->save();

    // Step 5: Redirect with success
    return redirect()->route('users.index')
                     ->with('success', 'User updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with("success","user deleted successfully");
    }
}
