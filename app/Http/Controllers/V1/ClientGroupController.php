<?php namespace App\Http\Controllers\V1;
/**
 * ClientGroup resource representation.
 * @Resource("cgroups", uri="/cgroups")
 */

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hocs\ClientGroups\ClientGroupRepository;
use Dingo\Api\Routing\Helpers;
use App\Helpers\Traits\RestfulTrait;

class ClientGroupController extends Controller
{
    use Helpers, RestfulTrait;

	protected $clientGroup;

	public function __construct(ClientGroupRepository $clientGroup)
	{
		$this->clientGroup = $clientGroup;
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->clientGroup->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->clientGroup->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->clientGroup->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->clientGroup->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->clientGroup->destroy($id);
    }

    /**
     * Lấy tất cả user trong client group theo group_id
     * @Get("/cgroups/11/users")
     * @param  int $group_id [description]
     * @return json
     */
    public function getUsersOfGroup($group_id)
    {
        return $this->clientGroup->getUsersOfGroup($group_id);
    }
}
