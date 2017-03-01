<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectMemberRepositoryInterface;
use CodeProject\Services\ProjectMemberService;
use Illuminate\Http\Request;

class ProjectMemberController extends Controller
{
    /**
     * @var ProjectMemberRepositoryInterface
     */
    private $repository;
    /**
     * @var ProjectMemberService
     */
    private $service;

    public function __construct(ProjectMemberRepositoryInterface $repository, ProjectMemberService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }

    public function store(Request $request, $id)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        return $this->service->create($data);
    }

    public function show($id, $idProjectMember)
    {
        return $this->repository->find($idProjectMember);
    }

    public function destroy($id, $idProjectMember)
    {
        $this->service->delete($idProjectMember);
    }
}
