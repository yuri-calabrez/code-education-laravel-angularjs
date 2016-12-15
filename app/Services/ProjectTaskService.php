<?php

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectTaskRepositoryInterface;
use CodeProject\Validators\ProjectTaskValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectTaskService
{
    protected $repository;

    protected $validator;

    public function __construct(ProjectTaskRepositoryInterface $repository, ProjectTaskValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidatorException $e) {
            return ['error' => true, 'message' => $e->getMessageBag()];
        } catch (QueryException $e) {
            return ['error' => true, 'message' => "Projeto não encontrado"];
        }
    }

    public function update($id, array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch (ValidatorException $e) {
            return ['error' => true, 'message' => $e->getMessageBag()];
        } catch (ModelNotFoundException $e) {
            return ["error" => true, "message" => "Tarefa não encontrada"];
        } catch (QueryException $e) {
            return ["error" => true, "message" => "Projeto não encontrado"];
        }
    }
}