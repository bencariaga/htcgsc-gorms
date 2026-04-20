<?php

namespace App\Http\Controllers;

use App\{Actions\User\ResetUserPassword, Data\PasswordResetData, Models\User};
use App\Http\Requests\{UpdateUserPassword, UpdateUserProfile};
use App\Services\{ListType\UserService, Miscellaneous\OTPService, Miscellaneous\ProfileService};
use Illuminate\Http\{JsonResponse, RedirectResponse};
use Illuminate\Support\Facades\{Auth, Log};

class UserProfileController extends Controller
{
    public function index(?User $user = null)
    {
        $targetUser = $user ?? Auth::user();
        $targetUser->load('person');

        return view('livewire.pages.user-profile', ['user' => $targetUser, 'person' => $targetUser->person, 'fullName' => $targetUser->person->full_name]);
    }

    public function update(UpdateUserProfile $request, OTPService $otpService, ProfileService $profileService, UserService $userService, ?User $user = null): JsonResponse|RedirectResponse
    {
        try {
            $targetUser = $user ?? Auth::user();
            $redirectRoute = $profileService->handleUpdate($targetUser, $request->validated(), $otpService);
            /** @var mixed $request */
            $profileService->handleProfilePicture($targetUser, $request);

            if ($redirectRoute) {
                return redirect()->route($redirectRoute);
            }

            return $this->success($this->getUpdatedMessage());
        } catch (\Exception $e) {
            return $this->error("User profile update failed: {$e->getMessage()}");
        }
    }

    public function updatePassword(UpdateUserPassword $request, ResetUserPassword $resetAction, ?User $user = null): JsonResponse|RedirectResponse
    {
        try {
            $targetUser = $user ?? Auth::user();
            $targetUser->load('person');
            $identifier = $targetUser->person->email_address ?? $targetUser->person->phone_number;
            $newPassword = $request->validated()['newPassword'];

            $resetAction->execute(new PasswordResetData(identifier: $identifier, newPassword: $newPassword));

            $message = $this->getUpdatedMessage();
            $loginMessage = 'Please log in again.';
            $lineBreak = '<br>';

            if ($targetUser->user_id === Auth::id()) {
                Auth::guard('web')->logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->to('/')->with('success', "{$message}{$lineBreak}{$loginMessage}");
            }

            return $this->success($message);
        } catch (\Exception $e) {
            Log::error("Password update failed: {$e->getMessage()}");

            return back()->withErrors(['error' => 'Something went wrong while updating the password. Please try again.']);
        }
    }

    public function otpEmail()
    {
        return view('livewire.authentication.one-time-password-eac');
    }

    public function otpPhone()
    {
        return view('livewire.authentication.one-time-password-pnc');
    }
}
