<?php

namespace App\Http\Controllers\Admin;

use App\Services\ProjectService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProjectController extends Controller
{
    protected $projectService;

    /**
     * ProjectController constructor.
     */
    public function __construct(){
        $this->projectService = new ProjectService();
    }

    /**
     * @return Factory|View
     */
    public function projectList (){
        $data['projects'] = $this->projectService->projects();
        return view('admin.project.projects', compact('data'));
    }

    /**
     * @return Factory|View
     */
    public function showCreateProject (){
          return view('admin.project.createProject');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function createProject (Request $request){
        $rules = [
          'title'=> 'required|max:50',
          'description' => 'required',
          'project_link' => 'required'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->route('projectList')->with('error',$validator->errors()->first());
        }
        $createProjectResponse = $this->projectService->create(
            $request->title,
            $request->description,
            $request->project_link,
        );
        if (!$createProjectResponse['success']) {
            return redirect()->route('projectList')->with('error', $createProjectResponse['message']);
        }
        return redirect()->route('projectList')->with('success', $createProjectResponse['message']);
    }
    public function editProject (Request $request) {
        try{
            $project = $this->projectService->project($request->id);
            if (!$project['success']){
                return redirect()->route('projectList')->with('error',$project['message']);
            }
            $data['project'] = $project['data'];
            return view('admin.project.editProject',$data);

        }catch (\Exception $e){
            return redirect()->route('projectList')->with('error','invalid id');
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateProject (Request $request){
        $rules = [
            'title'=> 'required|max:50',
            'description' => 'required',
            'project_link' => 'required'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->route('projectList')->with('error',$validator->errors()->first());
        }
        $updateProjectResponse = $this->projectService->update(
            $request->id,
            $request->title,
            $request->description,
            $request->project_link,
        );
        if (!$updateProjectResponse['success']) {
            return redirect()->route('projectList')->with('error', $updateProjectResponse['message']);
        }
        return redirect()->route('projectList')->with('success', $updateProjectResponse['message']);
    }
    public function deleteProject (Request $request) {
        $rules =[
            'id'=>'integer'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->route('projectList')->with('error',$validator->errors()->first());
        }
        $deleteProjectResponse = $this->projectService->delete($request->id);
        if (!$deleteProjectResponse['success']){
            return redirect()->route('projectList')->with('error',$deleteProjectResponse['message']);
        }
        return redirect()->route('projectList')->with('success',$deleteProjectResponse['message']);

    }

}
