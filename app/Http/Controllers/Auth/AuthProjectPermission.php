<?php

namespace CodeProject\Http\Controllers\Auth;

use CodeProject\Repositories\ProjectRepositoryInterface;
use LucaDegasperi\OAuth2Server\Authorizer;


class AuthProjectPermission
{
    /**
     * @var ProjectRepositoryInterface
     */
    private $repository;
    /**
     * @var Authorizer
     */
    private $authorizer;

    public function __construct(ProjectRepositoryInterface $repository, Authorizer $authorizer)
    {

        $this->repository = $repository;
        $this->authorizer = $authorizer;
    }

    public function checkProjectOwner($projecId)
    {
        $userId = $this->authorizer->getResourceOwnerId();
        return $this->repository->isOwner($projecId, $userId);
    }

    public function checkProjectMember($projecId)
    {
        $userId = $this->authorizer->getResourceOwnerId();
        return $this->repository->hasMember($projecId, $userId);
    }

    public function checkProjectPermissions($projectId)
    {
        if($this->checkProjectOwner($projectId) or $this->checkProjectMember($projectId)){
            return true;
        }
        return false;
    }
}