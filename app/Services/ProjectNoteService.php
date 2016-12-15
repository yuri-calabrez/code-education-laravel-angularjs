<?php

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectNoteRepositoryInterface;
use CodeProject\Validators\ProjectNoteValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteService
{
    protected $repository;

    protected $validator;

    public function __construct(ProjectNoteRepositoryInterface $repository, ProjectNoteValidator $validator)
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
        } catch (QueryException $e){
            return ['error' => true, 'message' => "Projeto não encontrado"];
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
            return ["error" => true, "message" => "Nota não encontrada"];
        } catch (QueryException $e){
            return ["error" => true, "message" => "Projeto não encontrado"];
        }
    }
}