<?php

namespace CodeProject\Http\Middleware;

use Closure;
use CodeProject\Http\Controllers\Auth\AuthProjectPermission;
use CodeProject\Services\ProjectService;

class CheckProjectPermission
{

    /**
     * @var AuthProjectPermission
     */
    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
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
        if($this->projectService->checkProjectPermissions($projectId) == false){
            return ["message" => "Você não possui permissão para acessar este projeto"];
        }
        return $next($request);
    }
}
