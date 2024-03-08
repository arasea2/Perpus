<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        if(Auth::user()) {
            $roles = $request->user()->roles;
        } else {
            $roles = null;
        }
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'roles' => $roles,
                
            ],
            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
        ];
    }
}
