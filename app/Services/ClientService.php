<?php

namespace CodeProject\Services;


use CodeProject\Repositories\ClientRepositoryInterface;
use CodeProject\Validators\ClientValidator;
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
        }
    }
}