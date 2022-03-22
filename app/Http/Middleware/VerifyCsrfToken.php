<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     * 
     */
    protected $addHttpCookie = true;
    
    protected $except = [
        'http://localhost:8000/api/blog/post',
        'http://localhost:8000/api/blog/update/*',
        'http://localhost:8000/api/blog/delete/*',
    ];
}
