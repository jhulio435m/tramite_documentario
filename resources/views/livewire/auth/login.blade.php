<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
{
    $this->validate([
        'email' => ['required', 'string'], // Cambiado: ya no valida como email
        'password' => ['required', 'string']
    ]);

    $this->ensureIsNotRateLimited();

    // Determina si el input es email o DNI
    $credentials = $this->getCredentials();

    if (!Auth::attempt($credentials, $this->remember)) {
        RateLimiter::hit($this->throttleKey());
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    RateLimiter::clear($this->throttleKey());
    Session::regenerate();
    $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
}

protected function getCredentials(): array
{
    // Si es exactamente 8 dígitos, usa DNI, de lo contrario usa email
    return (strlen($this->email) === 8 && ctype_digit($this->email))
        ? ['dni' => $this->email, 'password' => $this->password]
        : ['email' => $this->email, 'password' => $this->password];
}

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Inicia Sesión')" :description="__('Accede a tu cuenta para continuar')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Correo Electrónico / DNI')"
            type="text  "
            required
            autofocus
            autocomplete="email"
            placeholder="email@uncp.edu.pe"
        />

        <!-- Password -->
        <div class="relative">
            <flux:input
                wire:model="password"
                :label="__('Contraseña')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Contraseña')"
                viewable
            />

            @if (Route::has('password.request'))
                <flux:link class="absolute end-0 top-0 text-sm text-green-800" :href="route('password.request')" wire:navigate>
                    {{ __('¿Olvidaste tu contraseña?') }}
                </flux:link>
            @endif
        </div>

        <!-- Remember Me -->
        <flux:checkbox wire:model="remember" :label="__('Recordarme')" />

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full bg-yellow-500 text-black hover:bg-yellow-600">{{ __('Iniciar Sesión') }}</flux:button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600">
            <span>{{ __('¿No tienes una cuenta?') }}</span>
            <flux:link class="text-green-800 hover:underline" :href="route('register')" wire:navigate>{{ __('Registrarse') }}</flux:link>
        </div>
    @endif
</div>
