<?php

namespace App\Http\Controllers;

use App\Form;
use App\Http\Resources\FormResource;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FormResource::collection(Form::all());
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
            'name' => 'required|unique:forms,name',
        ]);
        $data = $request->all();
        $form = new Form();
        $form->name = $data['name'];
        $form->save();
        return FormResource::collection(Form::all());
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
            'name' => 'required|unique:forms,name,' . $id,
        ]);
        $data = $request->all();
        $form = Form::find($id);
        $form->name = $data['name'];
        $form->save();
        return FormResource::collection(Form::all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Form::find($id)->delete();
        return FormResource::collection(Form::all());
    }
}
