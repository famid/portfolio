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
        $data['resumes'] = $this->resumeService->allResume();
        return view('admin.resume.resumes',compact('data'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function createResume (Request $request) {
        $rules = [
            'title' => 'required|max:50',
            'file' => 'required|file|max:10000|mimes:doc,docx,pdf'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
            return redirect()->route('resumeList')->with('error',$validator->errors()->first());
        }
        $file = $request->file('file');
        $fileUploadResponse = fileUpload($file);
        if (!$fileUploadResponse['success']) {
            return redirect()->back()->with('error',$fileUploadResponse['message']);
        }
        $fileNameToStore = $fileUploadResponse['fileName'];
        $path = $file->storeAs('public/resume_files', $fileNameToStore);
        $createResumeResponse = $this->resumeService->create(
            $request->title,
            $fileNameToStore
        );
        if (!$createResumeResponse['success']){
            return redirect()->route('resumeList')->with('error',$createResumeResponse['message']);
        }
        return redirect()->route('resumeList')->with('success',$createResumeResponse['message']);
    }
    public function downloadResumeFile(Request $request) {
        $fileNameResponse = $this->resumeService->getResumeFile($request->id);
        if (!$fileNameResponse['success']) {
            return redirect()->back()->with('error', $fileNameResponse['message']);
        }
        $fileName = $fileNameResponse['data'];
        $filePath= storage_path().'/app/public/resume_files/'.$fileName;

        return response()->download($filePath);
    }
}
