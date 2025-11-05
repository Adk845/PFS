<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Models\Categories;

class UserController extends Controller
{
   public function index()
{
    $users = User::latest()->paginate(10);

    $todayLogins = User::whereDate('last_login_at', now()->toDateString())->get();

    return view('admin.users.index', compact('users', 'todayLogins'));
}

public function create()
{
    $categories = Categories::all();
    return view('admin.users.create', compact('categories'));
}

//  public function store(Request $request)
//     {
//         $request->validate([
//             'name'     => 'required|string|max:255',
//             'email'    => 'required|string|email|max:255|unique:users',
//             'password' => 'required|string|confirmed|min:8',
//             'role'     => 'required|in:user,admin',
//         ]);

//         User::create([
//             'name'     => $request->name,
//             'email'    => $request->email,
//             'password' => Hash::make($request->password),
//             'role'     => $request->role, 
//         ]);

//          if ($request->filled('categories')) {
//         $user->categories()->sync($request->categories);
//     }

//         return redirect()->route('admin.users')->with('success', 'User created successfully.');
//     }



public function store(Request $request)
{
    try {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|confirmed|min:8',
            'role'       => 'required|in:user,admin',
            'categories' => 'array|nullable',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

      if ($request->filled('categories')) {
    $user->categories()->sync($request->categories);
}

     return redirect()->route('admin.users')
            ->with('success', 'User created successfully and categories linked.');

    } catch (QueryException $e) {
        Log::error('SQL Error:', ['message' => $e->getMessage()]);
        return back()->withErrors(['database' => $e->getMessage()])->withInput();
    } catch (\Exception $e) {
        Log::error('General Error:', ['message' => $e->getMessage()]);
        return back()->withErrors(['general' => $e->getMessage()])->withInput();
    }
}



  public function edit($id)
    {
        $user = User::findOrFail($id);
        $categories = Categories::all();
        return view('admin.users.edit', compact('user', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password'   => 'nullable|string|confirmed|min:8',
            'role'       => 'required|in:user,admin',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->role  = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $user->categories()->sync($request->categories ?? []);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
}


    public function destroy($id)
{
    $user = User::findOrFail($id);

    
    if (auth()->id() === $user->id) {
        return redirect()->route('admin.users')->with('error', 'Tidak bisa menghapus akun Anda sendiri.');
    }

    $user->delete();

    return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
}

}
