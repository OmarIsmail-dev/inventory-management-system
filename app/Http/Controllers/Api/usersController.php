<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Validation\Rule;

class usersController extends Controller
{
  public function users()
  {

    $users = User::all();

    return view("users.users", compact("users"));


  }

  public function AddUsers()
  {

    return view("users.AddUser");

  }



  public function CreateUsers(Request $request)
  {



    $createImg = $request->except("image");
    if ($request->hasFile("image")) {
      $image = $request->image;
      $oldImage = $image->getClientOriginalName();
      $newimage = uniqid() . $oldImage;
      $image->move("image", $newimage);
      $imgUrl = "image/$newimage";
      $createImg['image'] = $imgUrl;
    }


    $request->validate(
      [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required|string',
        'supplierType' => 'required|string',
      ],
      [
        'name.required' => 'Name required.',
        'email.required' => 'email required',
        'email.email' => 'You must enter a valid email.',
        'email.unique' => 'Email is already registered.',
        'password.min' => 'Password must contain at least 6 characters.',
        'role.required' => 'Roles are required.',
        'supplierType.required' => 'supplierType are required.',


      ]
    );


    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
      'role' => $request->role,
      'supplierType' =>$request->supplierType,
      'image' => $imgUrl ?? "https://www.pngkit.com/png/detail/126-1262807_instagram-default-profile-picture-png.png"

    ]);



    return redirect()->route("home");


  }


  public function DeleteUser($id)
  {

    $userId = User::find($id);

    if ($userId->role == "admin") {

      session()->flash('error', 'This admin cannot be deleted ');

    } else {

      $userId->delete();

    }


    return redirect()->route("users")->with("success", "Your $userId->name has been deleted");


  }

  public function EditUser($id)
  {

    $user = User::find($id);

    return view("users.edit", compact("user"));

  }


  public function UpdateUser($id, Request $request)
  {

    $user = User::findOrFail($id);
    $createImg = $request->except("image");
    $imgUrl = $user->image;
    if ($request->hasFile("image")) {
      $image = $request->file('image');
      $oldImage = $image->getClientOriginalName();
      $newimage = uniqid() . '_' . $oldImage;
      $image->move(public_path('image'), $newimage);
      $imgUrl = "image/$newimage";
      $createImg['image'] = $imgUrl;

    }

    $request->validate([
      'name' => 'required|string|max:255',
      'email' => [
       'required',
        'email',
        Rule::unique('users')->ignore($user->id),
      ],
      'password' => 'nullable|min:6',
      'role' => 'required|string',
   'supplierType' => 'required|string',
    ], [
      'name.required' => 'Name required.',
      'email.required' => 'email required',
      'email.email' => 'You must enter a valid email.',
      'email.unique' => 'Email is already registered.',
      'password.min' => 'Password must contain at least 6 characters.',
      'role.required' => 'Roles are required.',
      'supplierType.required' => 'supplierType are required.',

    ]);

    if ($request->filled('password')) {

      $createImg['password'] = bcrypt($request->password);

    }

    else {

      $createImg['password'] = $user->password;

    }




    $user->update($createImg);
    return redirect()->route("users")->with('success', 'User updated successfully!');



  }
// API endpoint to fetch employees (Managers and workers)
    public function getEmployees()
    {
        $employees = User::whereIn('role', ['Manager', 'worker'])
            ->get(['id', 'name', 'email', 'role', 'last_login']);
        return response()->json($employees);
    }

    // API endpoint to fetch suppliers
    public function getSuppliers()
    {
        $suppliers = User::where('role', 'supplier')
            ->get(['id', 'name', 'email', 'supplierType']);
        return response()->json($suppliers);
    }


}
