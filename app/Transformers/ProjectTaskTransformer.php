<?php

namespace CodeProject\Transformers;

use League\Fractal\TransformerAbstract;
use CodeProject\Entities\ProjectTask;

/**
 * Class ProjectTaskTransformer
 * @package namespace CodeProject\Transformers;
 */
class ProjectTaskTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProjectTask entity
     * @param \ProjectTask $model
     *
     * @return array
     */
    public function transform(ProjectTask $projectTask)
    {
        return [
            'id' => $projectTask->id,
            'name' => $projectTask->name,
            'project_id' => $projectTask->project_id,
            'start_date' => $projectTask->start_date,
            'due_date' => $projectTask->due_date,
            'status' => $projectTask->status,
            'created_at' => date_format($projectTask->created_at, "Y-m-d h:m:s"),
            'updated_at' => date_format($projectTask->created_at, "Y-m-d h:m:s")
        ];
    }
}
