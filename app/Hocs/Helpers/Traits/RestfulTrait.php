<?php

namespace App\Hocs\Helpers\Traits;

use Illuminate\Http\Request;

trait RestfulTrait
{
    /**
     * Display a listing of the resource.
     *
     * @return Dingo\Api\Http\Response\Format
     */
    public function index()
    {
        $m = self::MODEL;
        return $this->listResponse($m::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Dingo\Api\Http\Response\Format
     */
    public function show($id)
    {
        $m = self::MODEL;
        if($data = $m::find($id))
        {
            return $this->showResponse($data);
        }
        return $this->notFoundResponse();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Dingo\Api\Http\Response\Format
     */
    public function store(Request $request)
    {
        $m = self::MODEL;
        try
        {
            $v = \Validator::make($request->all(), $this->validationRules);

            if($v->fails())
            {
                throw new \Exception("ValidationException");
            }
            $data = $m::create($request->all());
            return $this->createdResponse($data);
        }catch(\Exception $ex)
        {
            $data = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($data);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Dingo\Api\Http\Response\Format
     */
    public function update(Request $request, $id)
    {
        $m = self::MODEL;

        if(!$data = $m::find($id))
        {
            return $this->notFoundResponse();
        }

        try
        {
            $v = \Validator::make($request->all(), $this->validationRules);

            if($v->fails())
            {
                throw new \Exception("ValidationException");
            }
            $data->fill($request->all());
            $data->save();
            return $this->showResponse($data);
        }catch(\Exception $ex)
        {
            $data = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Dingo\Api\Http\Response\Format
     */
    public function destroy($id)
    {
        $m = self::MODEL;
        if(!$data = $m::find($id))
        {
            return $this->notFoundResponse();
        }
        $data->delete();
        return $this->deletedResponse();
    }

    protected function createdResponse($data)
    {
        return [
        'code' => 201,
        'status' => 'succcess',
        'data' => $data
        ];
    }

    protected function showResponse($data)
    {
        return [
        'code' => 200,
        'status' => 'succcess',
        'data' => $data
        ];
    }

    protected function listResponse($data)
    {
        return [
        'code' => 200,
        'status' => 'succcess',
        'data' => $data
        ];
    }

    protected function notFoundResponse()
    {
        return [
        'code' => 404,
        'status' => 'error',
        'data' => 'Resource Not Found',
        'message' => 'Not Found'
        ];
    }

    protected function deletedResponse()
    {
        return [
        'code' => 204,
        'status' => 'success',
        'data' => [],
        'message' => 'Resource deleted'
        ];
    }

    protected function clientErrorResponse($data)
    {
        return [
        'code' => 422,
        'status' => 'error',
        'data' => $data,
        'message' => 'Unprocessable entity'
        ];
    }

}
