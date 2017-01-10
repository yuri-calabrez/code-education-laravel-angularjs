<?php

namespace CodeProject\Http\Controllers;


use CodeProject\Repositories\ClientRepositoryInterface;
use CodeProject\Services\ClientService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    /**
     * @var ClientRepositoryInterface
     */
    private $repository;
    /**
     * @var ClientService
     */
    private $service;

    public function __construct(ClientRepositoryInterface $repository, ClientService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    public function index()
    {
        return $this->repository->skipPresenter()->all();
    }


    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id)
    {
        try{
            return $this->repository->skipPresenter()->find($id);
        }catch (ModelNotFoundException $e){
            return ["error" => true, "message" => "Cliente não encontrado"];
        }

    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->delete($id);
    }
}
