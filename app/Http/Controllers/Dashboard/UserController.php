<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use App\Traits\UploadImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Dashboard\Users\CreateRequest;
use App\Http\Requests\Dashboard\Users\UpdateRequest;
use App\Http\Requests\Dashboard\Users\changePasswordRequest;

class UserController extends Controller
{

    use UploadImages;

    public function __construct()
    {
        $this->middleware('permission:read_users')->only('index');
        $this->middleware('permission:create_users')->only('create');
        $this->middleware('permission:update_users')->only('edit');
        $this->middleware('permission:delete_users')->only('destroy');
    }

    public function index(Request $request)
    {
        $users = User::whereRoleIs('admin')->search($request)->latest()->paginate(10);

        return view('dashboard.users.index', compact('users'));
    }


    public function create()
    {
        $user = new user();
        return view('dashboard.users.create', compact('user'));
    }

    public function store(CreateRequest $request)
    {

        $data = $request->except('image', 'password', 'password_confirmation',);
        $data['password'] = bcrypt($request->password);
        if ($request->image != '') {
            $data['image'] = $this->uploadImage($request->image);
        }
        $user = User::create($data);
        $user->attachRole('Admin');
        $user->syncPermissions($request->permission);
        return redirect()->route('dashboard.users.index')->with('message', __('dashboard.added_successfullu'));
    }

    public function show(User $user)
    {
        if ($user->id != Auth::user()->id) {
            return redirect()->back();
        }
        return view('dashboard.users.profile', compact('user'));
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->except(['image', 'permission']);
        if ($request->image != '') {
            if ($user->image != 'default.png') {
                Storage::disk('public_upload')->delete('/user_images/' . $user->image);
            }
            $data['image'] = $this->uploadImage($request->image);
        }
        $user->update($data);
        $user->syncPermissions($request->permission);
        return redirect()->route('dashboard.users.index')->with('message', __('dashboard.updated_successfullu'));
    }

    public function destroy(User $user)
    {
        if ($user->image != 'default.png') {
            Storage::disk('public_upload')->delete('/user_images/' . $user->image);
        }
        $user->delete();
        return back()->with('message', __('dashboard.deleted_successfullu'));
    }

    public function changePassword(changePasswordRequest $request, User $user)
    {
        $user = $user->find($request->user_id);
        if (!(Hash::check($request->old_password, $user->password))) {
            throw ValidationException::withMessages([
                'old_password' => __('dashboard.uncorrect_password'),
            ]);
        } elseif (strcmp($request->old_password, $request->new_password) == 0) {
            throw ValidationException::withMessages([
                'new_password' => __('dashboard.same_password'),
            ]);
        }
        $user->password = bcrypt($request->new_password);
        $user->save();
        return redirect()->back()->with('message', __('dashboard.updated_successfullu'));
    }
}
