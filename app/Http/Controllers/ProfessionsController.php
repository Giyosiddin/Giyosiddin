<?php

namespace App\Http\Controllers;

use App\Http\Resources\SimpleTableResource;
use App\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfessionsController extends Controller
{
    public function index()
    {
        return SimpleTableResource::collection(Profession::orderBy('created_at', 'DESC')->get());
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:areas,name',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $data = $request->all();
        $area = new Profession();
        $area->name = $data['name'];
        $area->save();
        return SimpleTableResource::collection(Profession::orderBy('created_at', 'DESC')->get());
    }
}
