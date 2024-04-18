<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSocial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialiteController extends Controller
{
    private array $drivers = ['skolkovo'];

    public function redirect(string $service, Request $request): RedirectResponse
    {
        abort_if(!in_array($service, $this->drivers, true), 404);

        return Socialite::driver($service)->redirect();
    }

    /**
     * @throws Throwable
     */
    public function callback(string $service, Request $request): RedirectResponse
    {
        abort_if(!in_array($service, $this->drivers, true), 404);

        $socialiteUser = Socialite::driver($service)->user();

        try {
            $user = User::query()->firstWhere('email', $socialiteUser->getEmail());

            if (!$user) {
                $user = User::create([
                    'email' => $socialiteUser->getEmail(),
                    'name' => $socialiteUser->getName(),
                    'password' => Hash::make(Str::random(6)),
                ]);
            }

            $user->userSocials()->updateOrCreate(
                ['service' => $service],
                ['service_id' => $socialiteUser->getId()]
            );

            Auth::login($user);
        } catch (Throwable $e) {}

        return redirect()->route('welcome');
    }
}
