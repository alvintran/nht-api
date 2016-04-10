<?php

namespace App\Hocs\ClientGroups;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ClientGroup extends Model
{
	public function members()
	{
		return $this->belongsToMany(User::class, "group_members", "group_id", "member_id");
	}

	public function creator()
	{
		return $this->belongsTo(User::class, "creator_id");
	}
}
