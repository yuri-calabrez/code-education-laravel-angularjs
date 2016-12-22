<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepositoryInterface;
use CodeProject\Services\ProjectService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * @var ProjectRepositoryInterface
     */
    private $repository;
    /**
     * @var ProjectService
     */
    private $service;

    public function __construct(ProjectRepositoryInterface $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->middleware('check-project-permission', ['except' => ['index', 'store']]);
    }

    public function index()
    {
        //return $this->repository->with(['client', 'user'])->all();
        return $this->repository->findWhere(['owner_id' => \Authorizer::getResourceOwnerId()]);
    }


    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }


    public function show($id)
    {
        try {
            return $this->repository->find($id);
        } catch (ModelNotFoundException $e) {
            return ["error" => true, "message" => "Projeto não encontrado"];
        }

    }


    public function update(Request $request, $id)
    {
        return $this->service->update($id, $request->all());
    }


    public function destroy($id)
    {
        return $this->service->delete($id);
    }

    public function members($id)
    {
        return $this->service->showMembers($id);
    }

    public function addMember($id, $memberId)
    {
        return $this->service->addMember($id, $memberId);
    }

    public function removeMember($id, $memberId)
    {
        return $this->service->removeMember($id, $memberId);
    }

    public function isMember($id, $memberId)
    {
        return $this->service->isMember($id, $memberId);
    }

    /*private function checkProjectOwner($projecId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($projecId, $userId);
    }

    private function checkProjectMember($projecId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($projecId, $userId);
    }

    private function checkProjectPermissions($projectId)
    {
        if($this->checkProjectOwner($projectId) or $this->checkProjectMember($projectId)){
            return true;
        }
        return false;
    }*/
}
