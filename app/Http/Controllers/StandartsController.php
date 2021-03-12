<?php

namespace App\Http\Controllers;

use App\Http\Resources\StandartsResource;
use App\Standart;
use Illuminate\Http\Request;
use Validator;

class StandartsController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        $standarts = new Standart();
        if(isset($data['profession_id']) && !empty($data['profession_id'])) {
            $standarts = $standarts->where('profession_id',$data['profession_id']);
        }
        if(isset($data['search']) && !empty($data['search'])) {
            $standarts = $standarts->where('fault','LIKE','%'.$data['search'].'%');
        }
        $standarts = $standarts->get();
        return StandartsResource::collection($standarts);
    }

    public function store(Request $request)
    {
        $rules = [
            'profession_id' => 'required',
            'fault' => 'required|min:3',
            'what_to_do' => 'required|min:3',
            'standart' => 'required|min:3',
            'image' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $data = $request->all();
        $fileName = $this->__files_control_block($data['image']);
        $standart = new Standart();
        $standart->profession_id = $data['profession_id'];
        $standart->fault = $data['fault'];
        $standart->what_to_do = $data['what_to_do'];
        $standart->standart = $data['standart'];
        $standart->image = $fileName;
        $standart->save();
        return response()->json(['message' => 'success'], 200);
    }

    private function __files_control_block($file)
    {
        $fileName = time() . '.' . $file->extension();
        $file->move(storage_path('app/public/standarts/images'), $fileName);
        return $fileName;
    }
}
