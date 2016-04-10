<?php

namespace App\Hocs\ClientGroups;

interface ClientGroupRepository
{
	public function getUsersOfGroup($group_id);
}
