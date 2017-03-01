<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 28/02/2017
 * Time: 18:00
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectMemberRepositoryInterface;
use CodeProject\Validators\ProjectMemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectMemberService
{
    /**
     * @var ProjectMemberRepositoryInterface
     */
    private $repository;
    /**
     * @var ProjectMemberValidator
     */
    private $validator;

    public function __construct(ProjectMemberRepositoryInterface $repository, ProjectMemberValidator $validator)
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

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

}