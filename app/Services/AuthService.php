<?php

namespace App\Services;

use App\Contracts\SmsProviderInterface;
use App\Mail\SendOtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Tzsk\Otp\Facades\Otp;

class AuthService
{

    protected UserService $userService;
    protected SmsProviderInterface $smsService;

    public function __construct(UserService $userService, SmsProviderInterface $smsService)
    {
        $this->userService = $userService;
        $this->smsService = $smsService;
    }

    public function registerUser(array $data): User
    {
        return $this->userService->createUser($data);
    }

    public function login(array $credentials): bool
    {
        $field = filter_var($credentials['identifier'], FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

        $authCredentials = [
            $field => $credentials['identifier'],
            'password' => $credentials['password'],
        ];

        $remember = $credentials['remember'] ?? false;

        return Auth::attempt($authCredentials, $remember);
    }

    public function sendOtp(string $identifier): ?User
    {
        $field = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        $user = User::where($field, $identifier)->first();

        if ($user) {
            $otpCode = Otp::generate($identifier);

            $message = "Your one-time login code is: " . $otpCode;

            if ($field === 'email') {
                Mail::to($user->email)->send(new SendOtpMail($otpCode));
            } elseif ($field === 'mobile') {
                $this->smsService->send($user->mobile, $message);
            }
        }

        return $user;
    }

    public function verifyAndLogin(string $identifier, string $otpCode): ?User
    {

        $isValid = Otp::match($otpCode, $identifier);

        if (!$isValid) {
            return null;
        }

        $field = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        $user = User::where($field, $identifier)->first();

        if ($user) {
            Auth::login($user);

            $verificationField = "{$field}_verified_at";
            if (is_null($user->$verificationField)) {
                $user->update([$verificationField => now()]);
            }
        }

        return $user;
    }

}
