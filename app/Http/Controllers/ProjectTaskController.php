<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectTaskRepositoryInterface;
use CodeProject\Services\ProjectTaskService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{
    /**
     * @var ProjectTaskRepositoryInterface
     */
    private $repository;
    /**
     * @var ProjectTaskService
     */
    private $service;

    public function __construct(ProjectTaskRepositoryInterface $repository, ProjectTaskService $service)
    {

        $this->repository = $repository;
        $this->service = $service;
    }

    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        return $this->service->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $taskId)
    {
        $data = $this->repository->findWhere(['project_id' => $id, 'id' => $taskId]);
        if(isset($data['data']) && count($data['data']) == 1) {
            return $data['data'][0];
        } else{
            return ["error" => true, "message" => "Tarefa nao encontrada"];
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $taskId)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        return $this->service->update($taskId, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $taskId)
    {
        try {
            $this->repository->delete($taskId);
            return ["error" => false, "message" => "Tarefa removida com sucesso"];
        } catch (ModelNotFoundException $e) {
            return ["error" => true, "message" => "Tarefa nao encontrada"];
        }
    }
}
