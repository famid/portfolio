<?php

namespace App\Http\Controllers\Admin;

use App\Services\AchievementService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

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
     * @return Factory|View
     */
    public function achievementList () {
        $data['achievements'] = $this->achievementService->achievements();
        return view ('admin.achievement.achievements',compact('data'));
    }

    /**
     * @return Factory|View
     */
    public function showCreateAchievement () {
        return view('admin.achievement.createAchievement');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function createAchievement (Request $request) {
        $rules = [
            'title'=>'required|max:50',
            'date' =>'required|date|date_format:Y-m-d',
            'description'=> 'required:max:300',
            'file'=>'nullable|max:10000|mimes:doc,docx,pdf' // max 10000kb, doc or docx or pdf file'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->route('achievementList')->with('error', $validator->errors()->first());
        }
        if ($request->has('file') && is_file($request->file)) {
            $file = $request->file('file');
            $fileUploadResponse = fileUpload($file);
            if (!$fileUploadResponse['success']) {
                return redirect()->back();
            } else {
                $fileNameToStore = $fileUploadResponse['fileName'];
                $path = $file->storeAs('public/achievement_files', $fileNameToStore);
            }
        } else {
            $fileNameToStore = null;
        }
        $date = Carbon::parse($request->date);
        $createAchievementResponse = $this->achievementService->create(
            $request->title,
            $date,
            $request->description,
            $fileNameToStore
        );
        if(!$createAchievementResponse['success']){
            return redirect()->route('achievementList')->with('error',$createAchievementResponse['message']);
        }
        return redirect()->route('achievementList')->with('error',$createAchievementResponse['message']);
    }

    /**
     * @param Request $request
     * @return Factory|RedirectResponse|Redirector|View
     */
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
     * @return RedirectResponse
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
     * @return RedirectResponse
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

    public function downloadAchievementFile(Request $request) {
        $fileNameResponse = $this->achievementService->getAchievementFile($request->id);
        if (!$fileNameResponse['success']) {
            return redirect()->back()->with('error', $fileNameResponse['message']);
        }
        $fileName = $fileNameResponse['data'];
        $filePath= storage_path().'/app/public/achievement_files/'.$fileName;

        return response()->download($filePath);
    }
}
