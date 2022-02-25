<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ConfigDatabase
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->id()) {
            $db_name = auth()->user()->default_database;
            Config::set('database.connections.organization.database', $db_name);
        }
        return $next($request);
    }
}
