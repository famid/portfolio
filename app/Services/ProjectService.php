<?php


namespace App\Services;


use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    protected $errorResponse;

    /**
     * ProjectService constructor.
     */
    public function __construct()
    {
        $this->errorResponse = [
            'success' => false,
            'message' => 'something went wrong'
        ];
    }

    /**
     * @return Project[]|Collection
     */
    public function projects()
    {
        return Project::all();
    }

    /**
     * @param int $projectId
     * @return array
     */
    public function project(int $projectId) :array {
        try {
            $project = Project::find($projectId);
            if (is_null($project)) {
                return [
                    'success' => false,
                    'message' => 'project id not found'
                ];
            }
            return ['success'=>true,'data'=>$project];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'project id not found'
            ];
        }
    }

    /**
     * @param string $title
     * @param string $description
     * @param string $projectLink
     * @return array
     */
    public function create(string $title, string $description, string $projectLink) :array {
        try {
            Project::create([
                'title'=> $title,
                'description' => $description,
                'project_link' => $projectLink
            ]);
            return [
                'success' => ture,
                'message' =>'project has been created successfully'
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param int $projectId
     * @param string $title
     * @param string $description
     * @param string $projectLink
     * @return array
     */
    public function update(int $projectId, string $title, string $description, string $projectLink) :array {
        try {
            $updateProjectResponse = Project::where('id',$projectId)->update([
                'title'=> $title,
                'description' => $description,
                'project_link' => $projectLink
            ]);
            if (!$updateProjectResponse){
                return $this->errorResponse;
            }
            return [
                'success' => true,
                'message' =>'project has been updated successfully'
            ];
        }catch(\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $projectId
     * @return array
     */
    public function delete ($projectId) :array {
        $deleteProjectResponse =Project::where('id',$projectId)->delete();
        if (!$deleteProjectResponse){
            return $this->errorResponse;
        }
        return [
            'success' => true,
            'message' => 'project has been deleted '
        ];
    }
}
