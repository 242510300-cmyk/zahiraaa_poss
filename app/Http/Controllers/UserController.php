<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $keyword = $request->input('search');

        if ($keyword) {
            $users = User::whereRaw(
                "MATCH(name, email) AGAINST (? IN BOOLEAN MODE)",
                [$keyword]
            )->paginate(10)->withQueryString();
        } else {
            $users = User::paginate(10)->withQueryString();
        }

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id'  => $data['role_id'],
        ]);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil dibuat');
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the resource.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role_id = $data['role_id'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('success', 'User berhasil diupdate');
    }

    /**
     * Remove the resource.
     */
    public function destroy(User $user)
    {
        // Cek apakah user masih memiliki data penjualan
        if ($user->penjualan()->exists()) {
            return redirect()
                ->route('admin.users')
                ->with('error', 'User tidak dapat dihapus karena masih memiliki data penjualan.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil dihapus.');
    }
}
