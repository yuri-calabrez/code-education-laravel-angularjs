<?php

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectRepositoryInterface;
use CodeProject\Validators\ProjectValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
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
        try {
            $this->validator->with($dada)->passesOrFail();
            return $this->repository->create($dada);
        } catch (ValidatorException $e) {
            return ['error' => true, 'message' => $e->getMessageBag()];
        }
    }

    public function update($id, array $dada)
    {
        try {
            $this->validator->with($dada)->passesOrFail();
            return $this->repository->update($dada, $id);
        } catch (ValidatorException $e) {
            return ['error' => true, 'message' => $e->getMessageBag()];
        } catch (ModelNotFoundException $e) {
            return ["error" => true, "message" => "Projeto não encontrado"];
        }
    }

    public function delete($id)
    {
        try {
            $this->repository->delete($id);
            return ["error" => false, "message" => "Projeto removido com sucesso!"];
        } catch (ModelNotFoundException $e) {
            return ["error" => true, "message" => "Projeto não encontrado"];
        } catch (QueryException $e){
            return ["error" => true, "message" => "Projeto não pode ser removido por estar associado a outros serviços. Verifique!"];
        }
    }

    public function showMembers($id)
    {
        try{
            return $this->repository->with(['members'])->find($id);
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Projeto não encontrado'];
        }
    }

    public function addMember($id, $memberId)
    {
        try{
            $this->repository->find($id)->members()->attach($memberId);
            return ["error" => false, "message" => "Colaborador incluido"];
        } catch (ModelNotFoundException $e){
            return ['error' => true, 'message' => 'Projeto não encontrado'];
        } catch (QueryException $e){
            return ['error' => true, 'message' => 'Colaborador não encontrado'];
        }
    }

    public function removeMember($id, $memberId)
    {
        try {
            $this->repository->find($id)->members()->detach($memberId);
            return ["error" => false, "message" => "Colaborador removido"];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Projeto não encontrado'];
        } catch (QueryException $e){
            return ['error' => true, 'message' => 'Colaborador não encontrado'];
        }
    }

    public function isMember($id, $memberId)
    {
        try {
           $member = $this->repository->find($id)->members()->find($memberId);
           if(empty($member)) {
               return ["error" => false, "message" => "Colaborador não pertence a este projeto"];
           } else {
               return ["error" => false, "message" => "Colaborador pertence a este projeto"];
           }
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Projeto não encontrado'];
        } catch (QueryException $e){
            return ['error' => true, 'message' => 'Colaborador não encontrado'];
        }
    }
}