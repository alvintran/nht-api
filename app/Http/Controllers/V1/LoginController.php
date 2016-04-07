<?php

namespace App\Http\Controllers\V1;

use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\Hocs\GroupMembers\GroupMemberRepository;

class LoginController extends Controller
{
	private $jwtAuth;
	private $gm;

	public function __construct(JWTAuth $jwtAuth, GroupMemberRepository $gm)
	{
	    $this->jwtAuth = $jwtAuth;
	    $this->gm = $gm;
	}

	public function index()
	{return $this->gm->index();
		$credentials = ['email' => 'neverback88@gmail.com', 'password' => '4ever1love'];
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
