<?php

namespace CodeProject\Http\Middleware;

use Closure;
use CodeProject\Http\Controllers\Auth\AuthProjectPermission;

class CheckProjectPermission
{

    /**
     * @var AuthProjectPermission
     */
    private $authProjectPermission;

    public function __construct(AuthProjectPermission $authProjectPermission)
    {
        $this->authProjectPermission = $authProjectPermission;
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
        $projectId = ($request->route('id') ? $request->route('id') : $request->route('project'));
        if($this->authProjectPermission->checkProjectPermissions($projectId) == false){
            return ["message" => "Você não possui permissão para acessar este projeto"];
        }
        return $next($request);
    }
}
