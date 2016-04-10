<?php namespace App\Http\Controllers\V1;
/**
 * User resource representation.
 * @Resource("Users", uri="/users")
 */

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\UserTransformer;
use Dingo\Api\Routing\Helpers;
use App\Helpers\Traits\RestfulTrait;
use App\User;

class UserController extends Controller
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

    public function __construct(User $user, UserTransformer $ut)
    {
        $this->model = $user;
        $this->transformer = $ut;
    }
}
