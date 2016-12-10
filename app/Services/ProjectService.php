<?php

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectRepositoryInterface;
use CodeProject\Validators\ProjectValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{
    protected $repository;

    protected $validator;

    public function __construct(ProjectRepositoryInterface $repository, ProjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $dada)
    {
        try{
            $this->validator->with($dada)->passesOrFail();
            return $this->repository->create($dada);
        }catch (ValidatorException $e){
            return ['error' => true, 'message' => $e->getMessageBag()];
        }
    }

    public function update($id, array $dada)
    {
        try{
            $this->validator->with($dada)->passesOrFail();
            return $this->repository->update($dada, $id);
        }catch (ValidatorException $e){
            return ['error' => true, 'message' => $e->getMessageBag()];
        } catch (ModelNotFoundException $e){
            return ["error" => true, "message" => "Projeto não encontrado"];
        }
    }
}