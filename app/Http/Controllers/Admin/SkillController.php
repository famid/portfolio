<?php

namespace App\Http\Controllers\Admin;

use App\Services\SkillService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    protected $skillService;

    public function __construct() {
        $this->skillService = new SkillService();
    }

    public function skillList () {
        $data['skills'] = $this->skillService->skills();
        return view('admin.skill.skills', $data);
    }

    public function createSkill (Request $request) {
        $rules = [
            'name' => 'required|max:50'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            return redirect()->back()->with('error', $validator->errors()->first());
        }
        $createSkillResponse = $this->skillService->create($request->name);
        if (!$createSkillResponse['success']) {

            return redirect()->back()->with('error', $createSkillResponse['message']);
        }

        return redirect()->back()->with('success', $createSkillResponse['message']);
    }

    public function deleteSkill(Request $request) {
        $rules = [
            'id' => 'required|integer'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            return redirect()->back()->with('error', $validator->errors()->first());
        }
        $deleteSkillResponse = $this->skillService->delete($request->id);
        if (!$deleteSkillResponse['success']) {

            return redirect()->back()->with('error', $deleteSkillResponse['message']);
        }

        return redirect()->back()->with('success', $deleteSkillResponse['message']);
    }

    public function editSkill(Request $request) {
        try {
            $skill = $this->skillService->skill(decrypt($request->id));
            if (!$skill['success']) {
                return redirect()->back()->with('error', $skill['message']);
            }
            $data['skill'] = $skill['data'];
            return view('admin.skill.edit', $data);
        } catch (\Exception $e) {
            return redirect()->route('skillList')->with('error', 'Invalid decryption');
        }
    }

    public function updateSkill (Request $request) {
        $rules = [
            'name' => 'required|max:50'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            return redirect()->back()->with('error', $validator->errors()->first());
        }
        $createSkillResponse = $this->skillService->update($request->id, $request->name);
        if (!$createSkillResponse['success']) {

            return redirect()->back()->with('error', $createSkillResponse['message']);
        }

        return redirect()->route('skillList')->with('success', $createSkillResponse['message']);
    }
}
