<?php

namespace CodeProject\Transformers;

use League\Fractal\TransformerAbstract;
use CodeProject\Entities\User;

/**
 * Class MemberTransformer
 * @package namespace CodeProject\Transformers;
 */
class MemberTransformer extends TransformerAbstract
{

    /**
     * Transform the \Member entity
     * @param \Member $model
     *
     * @return array
     */
    public function transform(User $member)
    {
        return [
           'member_id' => $member->id
        ];
    }
}
