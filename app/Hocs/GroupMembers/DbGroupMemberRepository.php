<?php

namespace App\Hocs\GroupMembers;

use Illuminate\Http\Request;
use App\Hocs\RestfulInterface;
use App\Hocs\Helpers\Traits\RestfulTrait;

class DbGroupMemberRepository implements GroupMemberRepository, RestfulInterface
{
	use RestfulTrait;

	const MODEL = \App\Hocs\GroupMembers\GroupMembers::class;
}
