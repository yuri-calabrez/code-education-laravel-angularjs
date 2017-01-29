<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectNoteRepositoryInterface;
use CodeProject\Services\ProjectNoteService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProjectNoteController extends Controller
{

    /**
     * @var ProjectNoteRepositoryInterface
     */
    private $repository;
    /**
     * @var ProjectNoteService
     */
    private $service;

    public function __construct(ProjectNoteRepositoryInterface $repository, ProjectNoteService $service)
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $noteId)
    {
        $data = $this->repository->findWhere(['project_id' => $id, 'id' => $noteId]);
        if(isset($data['data']) && count($data['data']) == 1) {
            return $data['data'][0];
        } else{
            return ["error" => true, "message" => "Nota nao encontrada"];
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $noteId)
    {
        return $this->service->update($noteId, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $noteId)
    {
        try {
            $this->repository->delete($noteId);
            return ["error" => false, "message" => "Nota removida com sucesso"];
        } catch (ModelNotFoundException $e) {
            return ["error" => true, "message" => "Nota nao encontrada"];
        }
    }
}
