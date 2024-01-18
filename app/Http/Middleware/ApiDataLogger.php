<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiDataLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    /**
     * @param $request
     * @param $response
     */
    public function terminate($request, $response)
    {
        $endTime = microtime(true);


        $filename = DIRECTORY_SEPARATOR . 'api_datalogger_' . date('d-m-Y') . '.log';

        $log = [
           'test'=>'test',
           'test'=>'test'
        ];

        \File::append(storage_path('logs' . $filename), str_replace('\"', '"', str_replace('\/', '/', str_replace(',"', "\n", json_encode($log)))));
        \File::append(storage_path('logs' . $filename), "\n" . str_repeat("=", 50) . "\n\n");
    }
}
