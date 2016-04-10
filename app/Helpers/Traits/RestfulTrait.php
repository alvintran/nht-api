<?php namespace App\Helpers\Traits;
/**
 * CURD functions cho restful
 */

use Illuminate\Http\Request;

trait RestfulTrait
{
    /**
     * Display a listing of the resource.
     * @Get("resources/")
     * @return json
     */
    public function index()
    {
        return $this->listResponse($this->model->all());
    }

    /**
     * Display the specified resource.
     * @Get("resources/11")
     * @param  int  $id
     * @return json
     */
    public function show($id)
    {
        if($data = $this->model->find($id))
        {
            return $this->showResponse($data);
        }
        return $this->notFoundResponse();
    }

    /**
     * Store a newly created resource in storage.
     * @Post("resources/")
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function store(Request $request)
    {
        try
        {
            $v = \Validator::make($request->all(), $this->validationRules);

            if($v->fails())
            {
                throw new \Exception("ValidationException");
            }
            $data = $this->model->create($request->all());
            return $this->createdResponse($data);
        }catch(\Exception $ex)
        {
            $data = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($data);
        }

    }

    /**
     * Update the specified resource in storage.
     * @Post("resources/11")
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return json
     */
    public function update(Request $request, $id)
    {
        if(!$data = $this->model->find($id))
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
     * @Delete("resources/")
     * @param  int  $id
     * @return json
     */
    public function destroy($id)
    {
        if(!$data = $this->model->find($id))
        {
            return $this->notFoundResponse();
        }
        $data->delete();
        return $this->deletedResponse();
    }

    protected function createdResponse($data)
    {
        $this->showResponse($data);
    }

    protected function showResponse($data)
    {
        $transformer = $this->transformer ? $this->transformer : null;
        $data = $transformer ? $this->item($data, $transformer)->setStatusCode(200) : $data;
        return $data;
    }

    protected function listResponse($data)
    {
        $transformer = $this->transformer ? $this->transformer : null;
        $data = $transformer ? $this->collection($data, $transformer)->setStatusCode(200) : $data;
        return $data;
    }

    protected function notFoundResponse()
    {
        return $this->array([
            'status' => 'error',
            'data' => 'Resource Not Found',
            'message' => 'Not Found'
        ])->setStatusCode(404);
    }

    protected function deletedResponse()
    {
        return $this->array([
            'status' => 'success',
            'data' => [],
            'message' => 'Resource deleted'
        ])->setStatusCode(204);
    }

    protected function clientErrorResponse($data)
    {
        return $this->array([
            'status' => 'error',
            'data' => $data,
            'message' => 'Unprocessable entity'
        ])->setStatusCode(422);
    }

}
