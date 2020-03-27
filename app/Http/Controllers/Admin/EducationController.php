<?php

namespace App\Http\Controllers\Admin;

use App\Services\EducationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EducationController extends Controller
{

    /**
     * EducationController constructor.
     */
    public function __construct(){
        $this->educationService = new EducationService();
    }

    public function educationList () {
        $data['education'] = $this->educationService->allEducation();
        return view('admin.education.education',compact('data'));
    }
    public function showCreateEducation() {
        return view('admin.education.createEducation');
    }
    public function createEducation(Request $request) {
        $rules = [
            'institution'=>'required|max:50',
            'subject'=>'required|max:50',
            'started_at' => 'required|date|date_format:Y-m-d',
            'ended_at' =>'required|date|date_format :Y-m-d',
            'educational_status'=> 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->route('educationList')->with('error', $validator->errors()->first());
        }

        $startedAt = Carbon::parse($request->started_at);
        $endedAt = Carbon::parse($request->ended_at);
        $createEducationResponse = $this->educationService->create(
            $request->institution,
            $request->subject,
            $startedAt,
            $endedAt,
            $request->educational_status
        );
        if(!$createEducationResponse['success']){
            return redirect()->route('educationList')->with('error',$createEducationResponse['message']);
        }
        return redirect()->route('educationList')->with('error',$createEducationResponse['message']);
    }

    public function editEducation(Request $request) {
        try {
            $education = $this->educationService->education($request->id);
            if(!$education['success']) {
                return redirect(route('educationList'))->with('error',$education['message']);
            }
            $data['education'] = $education['data'];
            return view('admin.education.editEducation', $data);
        } catch (\Exception $e) {
            return redirect()->route('educationList')->with('error', 'Invalid decryption');
        }
    }
    public function updateEducation(Request $request) {
        $rules = [
            'institution'=>'required|max:50',
            'subject'=>'required|max:50',
            'started_at' => 'required|date|date_format:Y-m-d',
            'ended_at' =>'required|date|date_format :Y-m-d',
            'educational_status'=> 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->route('educationList')->with('error', $validator->errors()->first());
        }

        $startedAt = Carbon::parse($request->started_at);
        $endedAt = Carbon::parse($request->ended_at);
        $updateEducationResponse = $this->educationService->update(
            $request->id,
            $request->institution,
            $request->subject,
            $startedAt,
            $endedAt,
            $request->educational_status
        );

        if(!$updateEducationResponse['success']){
            return redirect()->route('educationList')->with('error',$updateEducationResponse['message']);
        }
        return redirect()->route('educationList')->with('error',$updateEducationResponse['message']);
    }
    public function deleteEducation (Request $request) {
        $rules = [
            'id' => 'required|integer'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return redirect(route('educationList'))->with('error',$validator->errors()->first());
        }
        $deleteEducationResponse = $this->educationService->delete($request->id);
        if (!$deleteEducationResponse['success']) {
            return redirect(route('educationList'))->with('error',$deleteEducationResponse['message']);
        }

        return redirect(route('educationList'))->with('success',$deleteEducationResponse['message']);
    }
}
