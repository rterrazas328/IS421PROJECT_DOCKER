<?php namespace App\Http\Middleware;

use Auth;
use Illuminate\Http\RedirectResponse;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class RedirectIfAdmin {

    /**
     * The Guard implementation.
     *
     * Used for:
     * When you want page to redirect to login if the user is not authenticated
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()['userlevel'] == 0)
        {
            return new RedirectResponse(url('/'));
        }

        //lets request through if user is authenticated
        return $next($request);
    }

}
