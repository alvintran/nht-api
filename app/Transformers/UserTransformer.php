<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
	public function transform(User $user)
	{
		return [
			'id'         => (int) $user->id,
			'email'      => $user->email,
			'name'       => $user->getName(),
			'phone'      => $user->phone,
			'gender'     => $user->gender == 0 ? 'Nam' : 'Nữ',
			'address'    => $user->address,
			'avatar'     => $user->avatar,
			'active'     => $user->active == 0 ? true : false,
			'last_login' => $user->last_login ? date("d/m/Y H:i:s", strtotime($user->last_login)) : null,
			'created_at' => date("d/m/Y H:i:s", strtotime($user->created_at)),
			'updated_at' => date("d/m/Y H:i:s", strtotime($user->updated_at)),
		];
	}
}
