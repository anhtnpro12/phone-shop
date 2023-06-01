<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = $this->userRepository->paginate();
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', User::class);
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits_between:9,11|unique:users,phone',
            'address' => 'required',
            'password' => 'required|min:8|confirmed',
            'role_as' => 'required|numeric'
        ]);

        $user = $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as
        ]);

        $users = $this->userRepository->paginate();
        return to_route('users.index', [
            'page' => $users->lastPage(),

        ])->with('success', 'Create User Successful');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->userRepository->find($id);
        $this->authorize('update', $user);

        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = $this->userRepository->find($id);
        $this->authorize('update', $user);

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|digits_between:9,11|unique:users,phone,'.$id,
            'address' => 'required',
            'role_as' => 'required|numeric|min:1'
        ]);

        /*$validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|digits_between:9,11|unique:users,phone,'.$id,
            'address' => 'required',
            'password' => 'required',
            'role_as' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }*/

        $this->userRepository->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role_as' => $request->role_as
        ], $id);

        if (Auth::user()->role_as === 2) {
            return to_route('users.edit', [
                'user' => $id,
            ])->with('success', 'Update Profile Successful');
        }

        return to_route('users.index', [
            'user' => $id,
        ])->with('success', 'Update User Successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $this->authorize('forceDelete', User::class);

        $user = $this->userRepository->find($id);

        if($user->orders->count() > 0) {
            return to_route('users.index', [
                'page' => $request->page,
            ])->with('error', 'Delete Failed. ' . $user->name .' has orders');
        }

        $this->userRepository->delete($id);
        return to_route('users.index', [
            'page' => $request->page,
        ])->with('success', 'Delete Successful');
    }

    public function changePassword(Request $request, $id)
    {
        $user = $this->userRepository->find($id);
        $this->authorize('update', $user);

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            $validator->getMessageBag()->add('old_password', 'Wrong password');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->userRepository->update([
            'password' => Hash::make($request->password)
        ], $id);

        if (Auth::user()->role_as === 2) {
            return to_route('users.edit', [
                'user' => $id,
            ])->with('success', 'Change Password Successful');
        }

        return to_route('users.index', [
            'user' => $id,
        ])->with('success', 'Change Password Successful');
    }
}
