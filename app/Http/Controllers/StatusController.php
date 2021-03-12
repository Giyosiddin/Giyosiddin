<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatusResource;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return StatusResource::collection(Status::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:statuses,name',
        ]);
        $data = $request->all();
        $form = new Status();
        $form->name = $data['name'];
        $form->save();
        return StatusResource::collection(Status::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     */
    public function edit($id)
    {

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:statuses,name,' . $id,
        ]);
        $data = $request->all();
        $form = Status::find($id);
        $form->name = $data['name'];
        $form->save();
        return StatusResource::collection(Status::all());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function destroy($id)
    {
        Status::find($id)->delete();
        return StatusResource::collection(Status::all());
    }
}
