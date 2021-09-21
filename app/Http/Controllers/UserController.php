<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Tag;
use App\Models\CourseUser;
use App\Models\Lesson;
use App\Models\Document;
use App\Models\DocumentUser;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function profile()
    {
        $user = User::find(Auth::id());
        $courses = $user->courses;

        return view('users.profile', compact(['user', 'courses']));
    }

    public function upload(UpdateProfileRequest $request)
    {
        $user = User::find(Auth::id());
        $data = $request->all();

        if (isset($data['birthday_input'])) {
            $day = substr($data['birthday_input'], 0, 2);
            $month = substr($data['birthday_input'], 3, 2);
            $year = substr($data['birthday_input'], -4);
            $unformatBirhday = $day . '-' . $month . '-' . $year;
            $formatBirhday = date('Y-m-d', strtotime($unformatBirhday));

            $user->birthday = $formatBirhday;
        }

        if (isset($data['avatar_input'])) {
            $path = $request->file('avatar_input')->store('public');
            $avatar = 'storage/' . substr($path, 7);

            if (File::exists($user->avatar)) {
                unlink($user->avatar);
            }

            $user->avatar = $avatar;
        }

        if (isset($data['username_input'])) {
            $user->name = $data['username_input'];
        }

        if (isset($data['email_input'])) {
            $user->email = $data['email_input'];
        }

        if (isset($data['phone_input'])) {
            $user->phone = $data['phone_input'];
        }

        if (isset($data['address_input'])) {
            $user->address = $data['address_input'];
        }

        if (isset($data['aboutme_input'])) {
            $user->aboutMe = $data['aboutme_input'];
        }

        $user->save();

        return redirect()->back()->with('success', 'Update profile success');
    }
}
