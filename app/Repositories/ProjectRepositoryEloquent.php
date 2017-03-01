<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 06/12/2016
 * Time: 19:12
 */

namespace CodeProject\Repositories;


use CodeProject\Entities\Project;
use CodeProject\Presenters\ProjectPresenter;
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
        $result = $this->skipPresenter()->findWhere(['id' => $projectId, 'owner_id' => $userId]);
        if (count($result)) {
            return true;
        }

        return false;
    }

    public function hasMember($projectId, $memberId)
    {
        $project = $this->skipPresenter()->find($projectId);
        foreach ($project->members as $member) {
            if ($member->id == $memberId) {
                return true;
            }
        }

        return false;
    }

    public function findWithOwnerAndMember($userId)
    {
        return $this->scopeQuery(function ($query) use ($userId) {
            return $query->select('projects.*')
                ->leftJoin('project_members', 'project_members.project_id', '=', 'projects.id')
                ->where('project_members.member_id', '=', $userId)
                ->union($this->model->query()->getQuery()->where('owner_id', '=', $userId));
        })->all();
    }

    public function presenter()
    {
        return ProjectPresenter::class;
    }
}