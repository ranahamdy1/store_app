<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}

    public function register(RegisterRequest $request)
    {
        $data = $this->authService->register(
            $request->validated()
        );

        return api_response(
            'success',
            'User registered successfully',
            $data,
            201
        );
    }

    public function login(LoginRequest $request)
    {
        try {
            $data = $this->authService->login(
                $request->validated()
            );

            return api_response(
                'success',
                'Login successful',
                $data
            );
        } catch (ValidationException $e) {
            return api_response(
                'fail',
                'Invalid credentials',
                null,
                401
            );
        }
    }

    public function logout(Request $request)
    {
        $this->authService->logout(
            $request->user()
        );

        return api_response(
            'success',
            'Logged out successfully'
        );
    }

    public function changePassword(
        ChangePasswordRequest $request
    ) {
        try {
            $this->authService->changePassword(
                $request->user(),
                $request->current_password,
                $request->new_password
            );

            return api_response(
                'success',
                'Password updated successfully'
            );
        } catch (ValidationException $e) {
            return api_response(
                'fail',
                'Current password is incorrect',
                null,
                400
            );
        }
    }
}
