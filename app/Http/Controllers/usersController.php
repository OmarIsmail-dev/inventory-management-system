<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\PageMessage;

use function Laravel\Prompts\search;

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
  //start for application

public function employees(Request $request)
    {
        if ($request->user()) {
            $request->user()->update(['last_active_at' => now()]);
        }

        $query = User::whereIn('role', ['Manager', 'worker','admin']);
        $searchTerms = $request->query('search');

        if (!empty($searchTerms)) {
            if (is_string($searchTerms)) {
                $searchTerms = [$searchTerms];
            }
            $query->where(function ($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $q->orWhere('name', 'LIKE', '%' . $term . '%')
                      ->orWhere('role', 'LIKE', '%' . $term . '%');
                }
            });
        }

            $employees = $query->get(['id', 'name', 'email', 'role', 'last_active_at', 'last_login', 'image'])->map(function ($user) {
            $lastActivity = $user->last_active_at ?? $user->last_login;

            if ($lastActivity) {
                $lastActivityTime = Carbon::parse($lastActivity);
                $minutesSinceLastActivity = now()->diffInMinutes($lastActivityTime);

                if ($minutesSinceLastActivity < 3) {
                    $user->status = 'Active now';
                } else {
                    $user->status = 'Offline last seen ' . $lastActivityTime->diffForHumans();
                }
            } else {
                $user->status = 'Offline last seen unknown';
            }

            return $user;
        });

        $managerCount = User::where('role', 'Manager')->count();
        $workerCount = User::where('role', 'worker')->count();

        return response()->json([
            'employees' => $employees,
            'manager_count' => $managerCount,
            'worker_count' => $workerCount,
        ]);
    }

    public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'role' => 'required|in:admin,Manager,worker',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                     ], [
                'email.unique' => 'This email is already in use. Please choose a different one.',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'supplierType' => 'none',
                'image' => '',
                       ];

            if ($request->hasFile('image')) {
                $userData['image'] = $request->file('image')->store('images', 'public');
            }

            $user = User::create($userData);

            return response()->json($user, 201);
        }
        //update an employee
    public function updateEmployee(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Build update input only from filled fields
        $input = collect([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
             'role' => $request->input('role'),
        ])
        ->filter(fn($value) => $value !== null && $value !== '')
        ->toArray();

        // Validate only what is provided
        validator($input, [
            'name' => 'sometimes|string|max:255',
            'email' => [
                'sometimes', 'email',
                Rule::unique('users')->ignore($user->id),
            ], 

            'role' => 'sometimes|string',
        ])->validate();

        // Handle password (optional)
        if ($request->filled('password')) {
            $input['password'] = bcrypt($request->password);
        }

        // Handle image upload (optional)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $newImageName = uniqid() . '_' . $image->getClientOriginalName();
            $image->move(public_path('image'), $newImageName);
            $input['image'] = 'image/' . $newImageName;
        }

        // update
        $updated = $user->update($input);

        // Return response
        return response()->json([
            'message' => 'Employee updated successfully',
            'submitted' => $input,
            'user' => $user->fresh()
        ], 200);
    }
        // Delete an employee
    public function destroy($id)
    {
        // Check if the authenticated user is an admin
        if (!Auth::check() || Auth::user()->role !== 'owner') {
            return response()->json(['message' => 'Unauthorized. Only owners can delete employees.'], 403);
        }

        $user = User::whereIn('role', ['Manager', 'worker','admin'])->findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Employee deleted successfully'], 200);
    }
public function sendMessageToManager(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:email,sms',
        ]);

        $employee = User::find($request->input('employee_id'));

        if ($employee->role !== ['Manager','admin']) {
            return response()->json(['message' => 'Messages can only be sent to managers and admins.'], 403);
        }

        $formattedTitle = trim($request->input('title'));

        $message = PageMessage::create([
            'title' => $formattedTitle,
            'AssignedTo' => $request->input('employee_id'),
            'message' => $request->input('message'),
            'type' => $request->input('type'),
            'user_id' => $request->user()->id,
        ]);

        return response()->json(['message' => 'Message sent successfully', 'message_id' => $message->id], 201);
    }
        // API endpoint to fetch suppliers
    public function suppliers(Request $request)
    {
        $query = User::where('role', 'Supplier');

        // Search functionality
    if ($request->has('search') && !empty($request->input('search'))) {
        $searchTerm = $request->input('search');
        $query->where(function ($q) use ($searchTerm) {
            $q->where('name', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('supplierType', 'LIKE', '%' . $searchTerm . '%');
        });
    }

        // Fetch suppliers and update last_active_at for the authenticated user
        if ($request->user()) {
            $request->user()->update(['last_active_at' => now()]);
        }

        $suppliers = $query->get()->map(function ($user) {
            $lastActivity = $user->last_active_at ?? $user->last_login;
            if ($lastActivity) {
                $lastActivityTime = Carbon::parse($lastActivity);
                $minutesSinceLastActivity = now()->diffInMinutes($lastActivityTime);
                $user->status = $minutesSinceLastActivity < 5 ? 'Active' : 'Offline last seen ' . $lastActivityTime->diffForHumans();
            } else {
                $user->status = 'Offline';
            }
             return $user;
        });

        $supplierCount = $query->count();

        return response()->json([
            'suppliers' => $suppliers,
            'supplier_count' => $supplierCount,
        ]);
    }

    public function sendMessageToSupplier(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:email,sms', // Example types, adjust as needed
        ]);

        $message = PageMessage::create([
            'title' => $request->input('title'),
            'AssignedTo' => $request->input('supplier_id'),
            'message' => $request->input('message'),
            'type' => $request->input('type'),
            'user_id' => $request->user()->id, // Authenticated user (owner) sending the message
        ]);

        return response()->json(['message' => 'Message sent successfully', 'message_id' => $message->id], 201);
    }

    public function storeSupplier(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'owner') {
            return response()->json(['message' => 'Unauthorized. Only owner can add suppliers.'], 403);
        }

        $categoryNames = Category::pluck('name')->toArray();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'supplierType' => ['required', 'string', 'in:' . implode(',', $categoryNames)],
                    'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'supplier',
            'supplierType' => $request->supplierType,
         ]);
        if ($request->hasFile('image')) {
        $user['image'] = $request->file('image')->store('images', 'public');
        }
        return response()->json($user, 201);
    }
//update supplier
public function updateSupplier(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Filter and get only the fields you care about
    $input = collect([
        'name' => $request->input('name'),
        'email' => $request->input('email'), 
        'role' => $request->input('role'),
        'supplierType' => $request->input('supplierType'),
    ])
    ->filter(fn($value) => $value !== null && $value !== '')
    ->toArray();

    // Validate only the fields that exist
    validator($input, [
        'name' => 'sometimes|string|max:255',
        'email' => [
            'sometimes',
            'email',
            Rule::unique('users')->ignore($user->id),
        ],

         
        'role' => 'sometimes|string',
        'supplierType' => 'sometimes|string',
    ])->validate();

    // Handle password if sent
    if ($request->filled('password')) {
        $input['password'] = bcrypt($request->password);
    }

    // Handle image if sent
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $newImageName = uniqid() . '_' . $image->getClientOriginalName();
        $image->move(public_path('image'), $newImageName);
        $input['image'] = 'image/' . $newImageName;
    }

    // Update the user with only changed data
    $user->update($input);

    return response()->json([
        'message' => 'Supplier updated successfully',
        'user' => $user->fresh(),
    ], 200);
}
    // Delete a supplier
    public function destroySupplier($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'owner') {
            return response()->json(['message' => 'Unauthorized. Only owner can delete suppliers.'], 403);
        }

        $user = User::where('role', 'supplier')->findOrFail($id);
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }
        $user->delete();
        return response()->json(['message' => 'Supplier deleted successfully'], 200);
    }
    public function categories()
    {
        $categories = Category::select('id', 'name')->get();
        return response()->json($categories);
    }
}
