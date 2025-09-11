<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    return view('admin.users.create');
}

 public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role'     => 'required|in:user,admin',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role, 
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

  public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update User
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|confirmed|min:8',
            'role'     => 'required|in:user,admin',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->role  = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

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
