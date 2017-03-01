<?php

namespace CodeProject\Transformers;

use League\Fractal\TransformerAbstract;
use CodeProject\Entities\ProjectMember;

/**
 * Class ProjectMemberTransformer
 * @package namespace CodeProject\Transformers;
 */
class ProjectMemberTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['user'];

    /**
     * Transform the \ProjectMember entity
     * @param \ProjectMember $model
     *
     * @return array
     */
    public function transform(ProjectMember $projectMember)
    {
        return [
            'id' => $projectMember->id,
            'project_id' => $projectMember->project_id
        ];
    }

    public function includeUser(ProjectMember $member)
    {
        return $this->item($member->member, new MemberTransformer());
    }
}
