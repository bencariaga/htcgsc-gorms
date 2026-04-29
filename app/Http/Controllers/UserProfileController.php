<?php

namespace App\Http\Controllers;

use App\{Data\PasswordResetData, Http\Requests\UpdateUserProfile, Models\User};
use App\Services\Miscellaneous\{OTPService, ProfileService};
use Exception;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function update(UpdateUserProfile $request, OTPService $otpService, ProfileService $profileService, User $user): JsonResponse|RedirectResponse
    {
        try {
            $redirectRoute = $profileService->handleUpdate($user, $request->validated(), $otpService, $request->file('profilePicture'), $request->input('remove_picture') === '1');

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['status' => 'success', 'message' => 'User profile updated successfully!', 'redirect' => $redirectRoute ? route($redirectRoute) : null]);
            }

            if ($redirectRoute) {
                return redirect()->route($redirectRoute);
            }

            return redirect()->back()->with('success', 'User profile updated successfully!');
        } catch (Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
            }

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updatePassword(Request $request, ProfileService $profileService, User $user): RedirectResponse
    {
        $validated = $request->validate(['full_name' => 'required', 'newPassword' => ['required', 'min:8', 'confirmed']]);

        try {
            if ($validated['full_name'] !== $user->person->full_name) {
                throw new Exception('The full name does not match.');
            }

            $shouldLogout = $profileService->resetPassword(new PasswordResetData(identifier: $user->person->email_address ?? $user->person->phone_number, newPassword: $validated['newPassword']), $user);

            if ($shouldLogout) {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->to('/')->with('success', 'Password updated successfully! Please log in again.');
            }

            return redirect()->back()->with('success', 'Password updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['newPassword' => $e->getMessage()])->withInput();
        }
    }
}
