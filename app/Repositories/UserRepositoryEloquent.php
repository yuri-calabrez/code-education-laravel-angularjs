<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 20/12/2016
 * Time: 22:38
 */

namespace CodeProject\Repositories;


use CodeProject\Entities\User;
use CodeProject\Presenters\UserPresenter;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepositoryInterface
{
    protected $fieldSearchable = ['name'];

    public function model()
    {
       return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return UserPresenter::class;
    }

}