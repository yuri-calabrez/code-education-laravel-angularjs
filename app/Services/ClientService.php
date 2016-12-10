<?php

namespace CodeProject\Services;


use CodeProject\Repositories\ClientRepositoryInterface;
use CodeProject\Validators\ClientValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Mockery\CountValidator\Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientService
{

    /**
     * @var ClientRepositoryInterface
     */
    protected $repository;
    /**
     * @var ClientValidator
     */
    private $validator;

    public function __construct(ClientRepositoryInterface $repository, ClientValidator $validator)
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
        }

    }

    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch (ValidatorException $e) {
            return ['error' => true, 'message' => $e->getMessageBag()];
        }catch (ModelNotFoundException $e){
            return ['error' => true, 'message' => 'Cliente não encontrado'];
        }
    }

    public function delete($id)
    {
        try{
            $this->repository->delete($id);
            return ["error" => false, "message" => "Cliente removido com sucesso!"];
        }catch (QueryException $e){
            return ["error" => false, "message" => "Cliente não pode ser apagado pois existe um ou mais projetos vinculados a ele."];
        } catch (ModelNotFoundException $e){
            return ['error' => true, 'message' => 'Cliente não encontrado'];
        } catch (Exception $e){
            return ['error' => true, 'message' => 'Ocorreu algum erro ao excluir o cliente'];
        }
    }
}