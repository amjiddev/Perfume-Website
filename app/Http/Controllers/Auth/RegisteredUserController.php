<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{

    public function changePassword()
    {
        return view('pages.auth.change-password');
    }

    public function updatePassword(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'old_password' => 'required',
                'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()->symbols()],
            ]);

            $user = Auth::user();

            // Check if the old password matches the user's current password
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->withErrors([
                    'old_password' => __('The provided old password does not match our records.'),
                ]);
            }

            // Update the user's password
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('success',  __('Password updated successfully!'));
        } catch (ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            // Handle any other exceptions
            return redirect()->back()->with('error', __('An error occurred while updating the password. Please try again later.'));
        }
    }
}
