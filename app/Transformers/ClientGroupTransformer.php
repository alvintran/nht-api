<?php

namespace App\Transformers;

use App\Hocs\ClientGroups\ClientGroup;
use League\Fractal\TransformerAbstract;

class ClientGroupTransformer extends TransformerAbstract
{
	public function transform(ClientGroup $gm)
	{
		return [
			'id'          => (int) $gm->id,
			'name'        => $gm->name,
			'description' => $gm->description,
			'is_creator'     => $gm->creator->getName(),
			'created_at'  => date('d/m/Y H:i:s', $gm->time_create)
		];
	}
}
