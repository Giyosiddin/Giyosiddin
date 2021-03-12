<?php

namespace App\Http\Controllers;

use App\Area;
use App\AreaProblem;
use App\Http\Resources\ReportResource;
use App\Http\Resources\SimpleTableResource;
use App\Problems;
use App\ProjectArea;
use App\Report;
use App\ReportArea;
use App\System;
use App\TestSpeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
class ProjectsController extends Controller
{
    protected $project;

    public function getInfo()
    {
        return response()->json([
            'statuses' => [],
            'test_speeds' => SimpleTableResource::collection(TestSpeed::all()),
            'forms' => [],
            'floors' => $this->getNumberList(100, 1),
            'technical_floors' => $this->getNumberList(100, 0),
            'systems' => SimpleTableResource::collection(System::all()),
            'number_of_shared_buildings' => $this->getNumberList(20, 1),
            'parking_levels' => $this->getNumberList(20, 0),
            'roof_levels' => $this->getNumberList(20, 1),
            'upper_reservoir' => ['יש', 'אין'],
            'bottom_reservoir' => ['יש', 'אין'],
            'shared_systems_with_additional_buildings' => ['כן', 'לא'],
            'commercial_areas_integrated_with_test_structure' => ['כן', 'לא'],
            'examination_of_commercial_areas' => ['כן', 'לא'],

        ]);
    }

    public function show($id)
    {
        $report = Report::find($id);
        if (!$report) {
            abort(404);
        }
        return new ReportResource($report);
    }

    public function getAll()
    {
        if(Auth::user()->role_id == 1) {
            return ReportResource::collection(Report::orderBy('id','DESC')->get());
        } else {
            return ReportResource::collection(Report::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get());
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'status_id' => 'required',
            'customer_name' => 'required',
            'test_time' => 'required',
            'areas' => 'required|array',
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $this->validate($request, $rules);
        $this->__main_control_block($data);
        return new ReportResource($this->project);
    }

    public function update(Request $request, $id)
    {
        $report = Report::find($id);
        if (!$report) {
            abort(404);
        }
        $rules = [
            'status_id' => 'required',
            'customer_name' => 'required',
            'test_time' => 'required',
            'areas' => 'required|array',
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $this->validate($request, $rules);
        $this->__main_control_block($data, $report);
        return new ReportResource($this->project);
    }

    public function __main_control_block($data, $project)
    {
        if (!$project) {
            $project = new Report();
        }
        if (isset($data['form_id']))
            $project->form_id = $data['form_id'];
        if (isset($data['status_id']))
            $project->status_id = $data['status_id'];
        if (isset($data['test_speed_id']))
            $project->test_speed_id = $data['test_speed_id'];
        if (isset($data['system_id']))
            $project->system_id = $data['system_id'];
        if (isset($data['previous_test_id']))
            $project->previous_test_id = $data['previous_test_id'];
        if (isset($data['examination_date']))
            $project->examination_date = $data['examination_date'];
        if (isset($data['test_time']))
            $project->test_time = $data['test_time'];
        if (isset($data['customer_name']))
            $project->customer_name = $data['customer_name'];
        if (isset($data['tester_name']))
            $project->tester_name = $data['tester_name'];
        if (isset($data['test_address_city']))
            $project->test_address_city = $data['test_address_city'];
        if (isset($data['test_address']))
            $project->test_address = $data['test_address'];
        if (isset($data['report_address']))
            $project->report_address = $data['report_address'];
        if (isset($data['report_address_city']))
            $project->report_address_city = $data['report_address_city'];
        if (isset($data['customer_full_name']))
            $project->customer_full_name = $data['customer_full_name'];
        if (isset($data['opposite_side']))
            $project->opposite_side = $data['opposite_side'];
        if (isset($data['customer_logo']))
            $project->customer_logo = $data['customer_logo'];
        if (isset($data['is_guitar_pick']))
            $project->is_guitar_pick = $data['is_guitar_pick'];
        if (isset($data['is_program']))
            $project->is_program = $data['is_program'];
        if (isset($data['is_contract']))
            $project->is_contract = $data['is_contract'];
        if (isset($data['vat_in_percent']))
            $project->vat_in_percent = $data['vat_in_percent'];
        if (isset($data['floor']))
            $project->floor = $data['floor'];
        if (isset($data['technical_floor']))
            $project->technical_floor = $data['technical_floor'];
        if (isset($data['more_systems']))
            $project->more_systems = $data['more_systems'];
        if (isset($data['number_of_shared_buildings']))
            $project->number_of_shared_buildings = $data['number_of_shared_buildings'];
        if (isset($data['parking_levels']))
            $project->parking_levels = $data['parking_levels'];
        if (isset($data['roof_levels']))
            $project->roof_levels = $data['roof_levels'];
        if (isset($data['upper_reservoir']))
            $project->upper_reservoir = $data['upper_reservoir'];
        if (isset($data['bottom_reservoir']))
            $project->bottom_reservoir = $data['bottom_reservoir'];
        if (isset($data['shared_systems_with_additional_buildings']))
            $project->shared_systems_with_additional_buildings = $data['shared_systems_with_additional_buildings'];
        if (isset($data['com_areas_in_test']))
            $project->com_areas_in_test = $data['com_areas_in_test'];
        if (isset($data['exam_comm_areas']))
            $project->exam_comm_areas = $data['exam_comm_areas'];
        if (isset($data['resume']))
            $project->resume = $data['resume'];
        $project->user_id = Auth::user()->id;
        $project->save();
        $this->project = $project;
        $this->saveArea($data['areas']);
    }

    public function saveArea($areas)
    {
        $areaIds = [];
        foreach ($areas as $area) {
            if (!$areaRow = Area::where('name', $area['name'])->first()) {
                $areaRow = new Area();
            }
            $areaRow->name = $area['name'];
            $areaRow->save();
            $areaIds[] = $areaRow->id;
            if (!$projectAreaRow = ReportArea::where('area_id', $areaRow->id)->where('report_id', $this->project->id)->first()) {
                $projectAreaRow = new ReportArea();
            }
            $projectAreaRow->area_id = $areaRow->id;
            $projectAreaRow->report_id = $this->project->id;
            $projectAreaRow->save();
            if (isset($area['problems'])) {
                $this->saveAreaProblems($area['problems'], $projectAreaRow->id);
            }
        }
    }

    public function saveAreaProblems($problems, $projectAreaID)
    {
        foreach ($problems as $problem) {
            if (!$problemRow = Problems::where('profession_id', $problem['profession_id'])->where('details_of_eclipse', $problem['details_of_eclipse'])->first()) {
                $problemRow = new Problems();
            }
            if (isset($problem['image'])) {
                $problemRow->image = $this->__files_control_block($problem['image']);
            }
            if (isset($problem['profession_id']))
                $problemRow->profession_id = $problem['profession_id'];
            if (isset($problem['details_of_eclipse']))
                $problemRow->details_of_eclipse = $problem['details_of_eclipse'];
            if (isset($problem['solution']))
                $problemRow->solution = $problem['solution'];
            if (isset($problem['cost']))
                $problemRow->cost = $problem['cost'];
            $problemRow->save();
            if (!$areaProblem = AreaProblem::where('report_area_id', $projectAreaID)->where('problem_id', $problemRow->id)->first()) {
                $areaProblem = new AreaProblem();
            }
            $areaProblem->report_area_id = $projectAreaID;
            $areaProblem->problem_id = $problemRow->id;
            $areaProblem->save();
        }
    }

    private function __files_control_block($file)
    {
        $fileName = time() . '.' . $file->extension();
        $file->move(storage_path('app/public/problems/'), $fileName);
        return $fileName;
    }

    public function getNumberList($count = 100, $start = 0)
    {
        $data = [];
        for ($i = $start; $i <= $count; $i++) {
            $data[] = $i;
        }
        return $data;
    }
}
