<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $authorization;

    public function transform(User $user)
    {
        // return $user->attributesToArray();

        $formattedUser = [
            'id'                    => $user->id,
            'name'                  => $user->name,
            'email'                 => $user->email,
            'role'                  => $user->role,
            'birthdate'             => $user->birthdate,
            'active'                => (bool)$user->active,
            'createdAt'             => (string) $user->created_at,
            'updatedAt'             => (string) $user->updated_at
        ];
        return $formattedUser;
    }

    public function setAuthorization($authorization)
    {
        $this->authorization = $authorization;

        return $this;
    }

    public function includeAuthorization(User $user)
    {
        if (! $this->authorization) {
            return $this->null();
        }

        return $this->item($this->authorization, new AuthorizationTransformer());
    }
}
