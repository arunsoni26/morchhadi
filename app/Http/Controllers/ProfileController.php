<?php

namespace App\Http\Controllers;

use App\Models\bannerImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $userInfo = Auth::user();
        return view('admin.users.profile', compact('userInfo'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $user = Auth::user();
        $user->name  = $request->name;

        if ($request->hasFile('image')) {
            $image   = $request->file('image');
            $userId  = $user->id;

            $imageName = "profile_pic." . $image->getClientOriginalExtension();
            $path = "profile/$userId/$imageName";

            if (!empty($user->image) && Storage::disk('s3')->exists($user->image)) {
                Storage::disk('s3')->delete($user->image);
            }

            Storage::disk('s3')->putFileAs("profile/$userId", $image, $imageName);

            $user->image = $path;
        }

        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
    }


    // update password
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password'     => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.profile')
                ->withErrors($validator)
                ->withInput()
                ->with('active_tab', 'password');
        }

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('admin.profile')
                ->withErrors(['current_password' => 'Current password does not match'])
                ->with(['active_tab' => 'password']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('admin.profile')
            ->with('success', 'Password updated successfully!')
            ->with('active_tab', 'password');
    }
}
