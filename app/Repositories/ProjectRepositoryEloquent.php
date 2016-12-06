<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 06/12/2016
 * Time: 19:12
 */

namespace CodeProject\Repositories;


use CodeProject\Entities\Project;
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
}