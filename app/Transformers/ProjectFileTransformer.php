<?php

namespace CodeProject\Transformers;

use League\Fractal\TransformerAbstract;
use CodeProject\Entities\ProjectFile;

/**
 * Class ProjectFileTransformer
 * @package namespace CodeProject\Transformers;
 */
class ProjectFileTransformer extends TransformerAbstract
{

    public function transform(ProjectFile $projectFile)
    {
        return [
            'id' => $projectFile->id,
            'name' => $projectFile->name,
            'extension' => $projectFile->extension,
            'description' => $projectFile->description,
            'project_id' => $projectFile->project_id
        ];
    }
}
