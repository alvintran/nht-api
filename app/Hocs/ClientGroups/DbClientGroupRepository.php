<?php

namespace App\Hocs\ClientGroups;

use Illuminate\Http\Request;
use App\Helpers\RestfulInterface;
use App\Helpers\Traits\RestfulTrait;
use Dingo\Api\Routing\Helpers;
use App\Hocs\ClientGroups\ClientGroup;
use App\Transformers\ClientGroupTransformer;

class DbClientGroupRepository implements ClientGroupRepository, RestfulInterface
{
	/**
     * Sử dụng RestfulTrait để nhận các CURD functions
     * Và luôn sử dụng Helpers trait cùng với RestfulTrait
     */
	use Helpers, RestfulTrait;

	/**
     * Resource model
     * @var Eloquent - required
     */
	protected $model;

	/**
     * Fratal transformer
     * @var required
     */
	protected $transformer;

	public function __construct(ClientGroup $gm, ClientGroupTransformer $transformer)
	{
		$this->model = $gm;
		$this->transformer = $transformer;
	}

	/**
	 * Lấy tất cả user trong group theo group_id
	 * @Get("/groups/11/users")
	 * @param  int $group_id [description]
	 * @return json
	 */
	public function getUsersOfGroup($group_id)
	{
		$group = $this->model->find($group_id);
		return $group->users;
	}
}
