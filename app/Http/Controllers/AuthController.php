<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RequestOtpRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Services\AuthService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = $this->authService->registerUser($request->validated());

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if ($this->authService->login($request->validated())) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'identifier' => __('main.credentials-error'),
        ])->onlyInput('identifier');
    }

    public function showOTPForm(): View
    {
        return view('auth.otp');
    }

    public function requestCode(RequestOtpRequest $request): RedirectResponse
    {
        $identifier = $request->validated('identifier');

        $this->authService->sendOtp($identifier);

        return redirect()->route('otp.login')
            ->with('otp_identifier', $identifier)
            ->with('success_message', __('main.otp-success'));
    }

    public function verify(VerifyOtpRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $identifier = $validatedData['identifier'];

        $user = $this->authService->verifyAndLogin($identifier, $validatedData['otp_code']);

        if (!$user) {

            return redirect()->route('otp.login')
                ->with('otp_identifier', $identifier)
                ->withErrors(['otp_code' => __('main.otp-invalid')]);
        }

        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }
}
