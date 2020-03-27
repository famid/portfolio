<?php

namespace App\Http\Controllers\Admin;

use App\Services\ResumeService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ResumeController extends Controller
{
    protected $resumeService;

    /**
     * ResumeController constructor.
     */
    public function __construct(){
        $this->resumeService = new ResumeService();
    }

    /**
     * @return Factory|View
     */
    public function resumeList () {
        return view('admin.resume.resumes');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function createResume (Request $request) {
        $rules = [
            'title' => 'required|max:50',
            'file' => 'required|file|mimes:jpeg'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
            return redirect()->route('resumeList')->with('error',$validator->errors()->first());
        }
        //Get the file name with With the extension
        $fileNameWithExtension = $request->file('file')->getClientOriginalName();
        //Get just file name
        $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
        //Get just extension
        $fileExtension = $request->file('file')->getClientOriginalExtension();
        //File name to store
        $fileNameToStore = $fileName.'_'.time().'_'.$fileExtension;
        //upload file
        $path = $request->file('file')->storeAs('public/resume_files', $fileNameToStore);
        $createResumeResponse = $this->resumeService->create(
            $request->title,
            $fileNameToStore
        );
        if (!$createResumeResponse['success']){
            return redirect()->route('resumeList')->with('error',$createResumeResponse['message']);
        }
        return redirect()->route('resumeList')->with('success',$createResumeResponse['message']);
    }
}
