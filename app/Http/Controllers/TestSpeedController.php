<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestSpeedResource;
use App\TestSpeed;
use Illuminate\Http\Request;

class TestSpeedController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return TestSpeedResource::collection(TestSpeed::all());
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
            'name' => 'required|unique:test_speeds,name',
        ]);
        $data = $request->all();
        $form = new TestSpeed();
        $form->name = $data['name'];
        $form->save();
        return TestSpeedResource::collection(TestSpeed::all());
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
            'name' => 'required|unique:test_speeds,name,' . $id,
        ]);
        $data = $request->all();
        $form = TestSpeed::find($id);
        $form->name = $data['name'];
        $form->save();
        return TestSpeedResource::collection(TestSpeed::all());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function destroy($id)
    {
        TestSpeed::find($id)->delete();
        return TestSpeedResource::collection(TestSpeed::all());
    }
}
