<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepositoryInterface;
use CodeProject\Services\ProjectService;
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
    }

    public function index()
    {
        return $this->repository->with(['client', 'user'])->all();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }


    public function show($id)
    {
        return $this->repository->find($id);
    }


    public function update(Request $request, $id)
    {
        return $this->service->update($id, $request->all());
    }


    public function destroy($id)
    {
        return $this->repository->delete($id);
    }
}
