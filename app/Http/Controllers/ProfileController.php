<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\freelancer_profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'ic' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('profile_picture')) {
            $profileImage = $request->file('profile_picture');
            $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
            $profileImage->move(public_path('images/profile_pictures'), $profileImageName);

            // Save the new profile picture path in the user profile
            $user->profile_picture = 'images/profile_pictures/' . $profileImageName;
        }

        // Update user profile details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->ic = $request->ic;
        $user->phone_number = $request->phone_number;
        $user->location = $request->location;
        $user->save();

        return redirect()->back()->with('status', 'Profile updated successfully.');
    }

    public function updateFreelancerProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'work_experience' => 'required|string|max:255',
            'edu_quality' => 'required|string',
            'nickname' => 'required|string',
        ]);

        if ($user->freelancerProfile) {
            // Update existing profile
            $freelancerProfile = $user->freelancerProfile;
            $freelancerProfile->work_experience = $request->work_experience;
            $freelancerProfile->edu_quality = $request->edu_quality;
            $freelancerProfile->nickname = $request->nickname;
            $user->location = $request->location;
            $user->average_rating = 0.00;
            $user->rating_count = 0;
            $freelancerProfile->update();
        } else {
            // Create new profile
            $freelancerProfile = new freelancer_profile($request->all());
            $freelancerProfile->user_id = $user->id;
            $freelancerProfile->work_experience = $request->work_experience;
            $freelancerProfile->edu_quality = $request->edu_quality;
            $freelancerProfile->nickname = $request->nickname;
            $user->location = $request->location;
            $user->average_rating = 0.00;
            $user->rating_count = 0;
            $freelancerProfile->save();
        }

        return redirect()->back()->with('status', 'Freelancer profile updated successfully.');
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
