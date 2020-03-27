<?php

namespace App\Http\Controllers\Admin;

use App\Services\ExperienceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 * @property  ExperienceService
 */
class ExperienceController extends Controller
{
    protected $experienceService;
    public function __construct(){
        $this->experienceService = new ExperienceService();
    }

    public function experienceList (){
        $data['experiences'] = $this->experienceService->experiences();
        return view('admin.experience.experiences', compact('data'));
    }
    public function showCreateExperience () {
        return view('admin.experience.createExperience');

    }
    public function createExperience(Request $request){
        $rules = [
            'title' => 'required|max:50',
            'company' => 'required|max:50',
            'started_at' => 'required|date|date_format:Y-m-d',
            'ended_at' => 'required|date|date_format:Y-m-d',
            'city' => 'required|max:50',
            'country' => 'required|max:50',
            'company_description' => 'required|max:150',
            'achievement' => 'required|max:50',
            'still_working' =>'required|boolean'

        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()) {
            return redirect(route('experienceList'))->with('error',$validator->errors()->first());
        }
        $startedAt = Carbon::parse($request->started_at);
        $endedAt = Carbon::parse($request->ended_at);
        $createExperienceResponse = $this->experienceService->create(
            $request->title,
            $request->company,
            $startedAt,
            $endedAt,
            $request->city,
            $request->country,
            $request->company_description,
            $request->achievement,
            $request->still_working,
        );
        if(!$createExperienceResponse['success']){
            return redirect (route('experienceList'))->with('error',$createExperienceResponse['message']);
        }
        return redirect (route('experienceList'))->with('error',$createExperienceResponse['message']);

    }
    public function deleteExperience (Request $request) {
        $rules = [
            'id' => 'required|integer'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return redirect(route('experienceList'))->with('error',$validator->errors()->first());
        }
        $deleteExperienceResponse = $this->experienceService->delete($request->id);
        if (!$deleteExperienceResponse['success']) {
            return redirect(route('experienceList'))->with('error',$deleteExperienceResponse['message']);
        }

        return redirect(route('experienceList'))->with('success',$deleteExperienceResponse['message']);
    }

    public function editExperience (Request $request) {
        try {
            $experience = $this->experienceService->experience(decrypt($request->id));
            if(!$experience['success']) {
                return redirect(route('experienceList'))->with('error',$experience['message']);
            }
            $data['experience'] = $experience['data'];
            return view('admin.experience.editExperience', $data);
        } catch (\Exception $e) {
            return redirect()->route('experienceList')->with('error', 'Invalid decryption');
        }

    }

    public function updateExperience (Request $request) {
        $rules = [
            'title' => 'required|max:50',
            'company' => 'required|max:50',
            'started_at' => 'required|date|date_format:Y-m-d',
            'ended_at' => 'required|date|date_format:Y-m-d',
            'city' => 'required|max:50',
            'country' => 'required|max:50',
            'company_description' => 'required|max:150',
            'achievement' => 'required|max:50',
            'still_working' =>'required|boolean'

        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()) {
            return redirect(route('experienceList'))->with('error',$validator->errors()->first());
        }
        $startedAt = Carbon::parse($request->started_at);
        $endedAt = Carbon::parse($request->ended_at);
        $updateExperienceResponse = $this->experienceService->update(
            $request->id,
            $request->title,
            $request->company,
            $startedAt,
            $endedAt,
            $request->city,
            $request->country,
            $request->company_description,
            $request->achievement,
            $request->still_working,
        );
        if(!$updateExperienceResponse['success']){
            return redirect (route('experienceList'))->with('error',$updateExperienceResponse['message']);
        }
        return redirect (route('experienceList'))->with('error',$updateExperienceResponse['message']);
    }
}
