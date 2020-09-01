<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/YHr1bq5qGFPYBzaWYc51ajt0sIQ2DcGQhNkPKMSjZ0DPzMLJlOOGUXxX0mbYZKxxF3ihX5dkMLtKo3t1JgJNSjhn6hv6ZqlryPBZcwNL2NsKrcQ8F3kMXRW8kCG64Nbd/webhook/'
    ];
}
