<?php

namespace App\Http\Controllers\Admin;

use App\Services\AchievementService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AchievementController extends Controller
{
    protected $achievementService;

    /**
     * AchievementController constructor.
     */
    public function __construct(){
        $this->achievementService = new AchievementService();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function achievementList () {
        $data['achievements'] = $this->achievementService->achievements();
        return view ('admin.achievement.achievements',compact('data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCreateAchievement () {
        return view('admin.achievement.createAchievement');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAchievement (Request $request) {
        $rules = [
            'title'=>'required|max:50',
            'date' =>'required|date|date_format:Y-m-d',
            'description'=> 'required:max:300',
             'file'=>'nullable'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->route('achievementList')->with('error', $validator->errors()->first());
        }
        $date = Carbon::parse($request->date);
        $createAchievementResponse = $this->achievementService->create(
            $request->title,
            $date,
            $request->description,
            $request->file ? $request->file:''
        );
        if(!$createAchievementResponse['success']){
            return redirect()->route('achievementList')->with('error',$createAchievementResponse['message']);
        }
        return redirect()->route('achievementList')->with('error',$createAchievementResponse['message']);
    }
    public function editAchievement (Request $request) {
        try {
            $achievement = $this->achievementService->achievement($request->id);
            if(!$achievement['success']) {
                return redirect(route('achievementList'))->with('error',$achievement['message']);
            }
            $data['achievement'] = $achievement['data'];
            return view('admin.achievement.editAchievement', $data);
        } catch (\Exception $e) {
            return redirect()->route('achievementList')->with('error', 'Invalid decryption');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAchievement (Request $request) {
        $rules = [
            'title'=>'required|max:50',
            'date' =>'required|date|date_format:Y-m-d',
            'description'=> 'required:max:300',
            'file'=>'nullable'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->route('achievementList')->with('error', $validator->errors()->first());
        }
        $date = Carbon::parse($request->date);

        $updateAchievementResponse = $this->achievementService->update (
            $request->id,
            $request->title,
            $date,
            $request->description,
            $request->file ? $request->file:''
        );
        if(!$updateAchievementResponse['success']){
            return redirect()->route('achievementList')->with('error',$updateAchievementResponse['message']);
        }
        return redirect()->route('achievementList')->with('error',$updateAchievementResponse['message']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAchievement(Request $request) {
        $rules = [
            'id' => 'required|integer'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            return redirect()->back()->with('error', $validator->errors()->first());
        }
        $deleteAchievementResponse = $this->achievementService->delete($request->id);
        if(!$deleteAchievementResponse['success']) {
            return redirect()->back()->with('error',$deleteAchievementResponse['message']);
        }
        return redirect()->route('achievementList')->with('success',$deleteAchievementResponse['message']);

    }
}
