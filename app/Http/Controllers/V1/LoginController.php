<?php
/**
 * Authenticate user
 */
namespace App\Http\Controllers\V1;

use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Tymon\JWTAuth\JWTAuth;

class LoginController extends Controller
{
	use Helpers;

	private $jwtAuth;

	public function __construct(JWTAuth $jwtAuth)
	{
	    $this->jwtAuth = $jwtAuth;
	}

	/**
	 * Login to api
	 *
	 * @Post("/login")
     * @Request({"email": "foo@bar.com", "password": "bar"})
	 * @param  Request $request
	 * @return json
	 */
	public function index(Request $request)
	{
		$credentials = $request->only(['email', 'password']);
		try {
		    if (! $token = $this->jwtAuth->attempt($credentials)) {
		        return $this->response->errorUnauthorized();
		    }
		} catch (JWTException $e) {
		    return $this->response->error('could_not_create_token', 500);
		}
		return response()->json(compact('token'));
	}
}
