<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 06/12/2016
 * Time: 19:12
 */

namespace CodeProject\Repositories;


use CodeProject\Entities\Project;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function isOwner($projectId, $userId)
    {
        if (count($this->findWhere(['id' => $projectId, 'owner_id' => $userId]))) {
            return true;
        }

        return false;
    }

    public function hasMember($projectId, $memberId)
    {
        $project = $this->find($projectId);
        foreach ($project->members as $member) {
            if ($member->id == $memberId) {
                return true;
            }
        }

        return false;
    }
}