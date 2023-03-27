<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {

        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        $temporaryFile = TemporaryFile::where('folder', $request->profileImage)->first();

        if ($temporaryFile) {

            $request->user()->addMedia(storage_path('app/public/temp/profile/' . $request->profileImage . '/' . $temporaryFile->filename))

                ->toMediaCollection('profileImages', 'profile-image');
            Storage::deleteDirectory('public/temp/profile/' .  $request->profileImage);
            $temporaryFile->delete();
        }


        return back()->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        if ($request->user()->password) {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current-password'],
            ]);
        } else {
            $request->validateWithBag('userDeletion', [
                'confirmation' => ['required', 'in:delete,Delete,DELETE'],
            ]);
        }

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
