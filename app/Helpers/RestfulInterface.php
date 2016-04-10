<?php

namespace App\Helpers;

interface RestfulInterface {
    /**
     * Display a listing of the resource.
     *
     * @return \Dingo\Api\Http\Response\Format
     */
    public function index();

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Dingo\Api\Http\Response\Format
     */
    public function store(\Illuminate\Http\Request $request);

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Dingo\Api\Http\Response\Format
     */
    public function show($id);

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Dingo\Api\Http\Response\Format
     */
    public function update(\Illuminate\Http\Request $request, $id);

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Dingo\Api\Http\Response\Format
     */
    public function destroy($id);
}
