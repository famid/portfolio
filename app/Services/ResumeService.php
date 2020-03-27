<?php


namespace App\Services;


use App\Models\Resume;
use Illuminate\Database\Eloquent\Collection;
use Mockery\Exception;

class ResumeService
{
    protected $errorResponse;

    /**
     * ResumeService constructor.
     */
    public function __construct(){
        $this->errorResponse = [
            'success' => true,
            'message' => 'someting went wrong'
        ];
    }

    /**
     * @return Resume[]|Collection
     */
    public function allResume () {
       return Resume::all();
    }

    /**
     * @param int $resumeId
     * @return array
     */
    public function resume (int $resumeId) :array {
        try{
            $resume = Resume::find($resumeId);
            if(is_null($resume)){
                return ['success'=>false, 'message'=>'resume not found'];
            }
            return ['success'=>true, 'data'=>$resume];
        }catch (\Exception $e){
            return ['success'=>false, 'message'=>'resume not found'];
        }
    }
    public function create (string $title, string $file) :array {
        try{
            Resume::create([
                'title'=> $title,
                'file' => $file
            ]);
            return [
              'success'=>true,
              'message' =>'file has been created successfully'
            ];

        }catch (\Exception $e) {
            return $this->errorResponse;
        }
    }

}
