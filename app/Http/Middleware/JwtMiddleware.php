<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Support\Facades\Log;


class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            Log::error('Token expired: ' . $e->getMessage());
            return response()->json(['error' => 'Token has expired'], 401);
        } catch (TokenInvalidException $e) {
            Log::error('Token invalid: ' . $e->getMessage()); // Log the error
            return response()->json(['error' => 'Token is invalid'], 401);
        } catch (JWTException $e) {
            Log::error('Token not provided: ' . $e->getMessage()); // Log the error
            return response()->json(['error' => 'Token not provided'], 401);
        } catch (\Exception $e) {
            Log::critical('Unexpected error: ' . $e->getMessage()); // Log unexpected errors
            return response()->json(['error' => 'An unexpected error occurred'], 500);
        }

        return $next($request);
    }

}
