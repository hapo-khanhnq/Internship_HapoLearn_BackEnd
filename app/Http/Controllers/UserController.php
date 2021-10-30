<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Requests\UpdateUserInformationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{
    public function show()
    {
        $user = User::findOrFail(Auth::user()->id);
        $courses = $user->courses()->get();
        return view('user.user_profile', compact('user', 'courses'));
    }

    public function updateAvatar(UpdateAvatarRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->hasFile('avatar')) {
            $oldAvatar = $user->avatar;
            $avatar = time() . "." . $request->avatar->getClientOriginalExtension();
            if($oldAvatar) {
                unlink(public_path('storage\user/' . $oldAvatar));
            }
            $request->avatar->move('storage\user', $avatar);
            $user->update(['avatar' => $avatar]);
        }
        return redirect()->route('user.show');
    }

    public function updateInformation(UpdateUserInformationRequest $request)
    {
        $userId = Auth::user()->id;
        User::findOrFail($userId)->update($request->all());
        return redirect()->route('user.show');
    }
}
