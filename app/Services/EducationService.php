<?php


namespace App\Services;


use App\Models\Education;
use Illuminate\Database\Eloquent\Collection;

class EducationService
{
    protected $errorResponse;

    /**
     * AchievementService constructor.
     */
    public function __construct() {
        $this->errorResponse =[
            'success' =>false,
            'message'=> 'something went wrong'
        ];
    }


    /**
     * @return Education[]|Collection
     */
    public function allEducation () {
        return Education::all();
    }

    /**
     * @param int $educationId
     * @return array
     */
    public function education (int $educationId) :array {
        try{
            $education = Education::find($educationId);
            if(is_null($education)){
                return ['success'=>false,'message'=>'Education status not found'];
            }
            return ['success'=>true ,'data'=>$education];
        }catch (\Exception $e){
            return ['success'=>false,'message'=>'Education status not found'];

        }
    }


    public function create (string $institution, string $subject, string $startedAt,string $endedAt, string $educationalStatus) :array {
        try{
            Education::create([
                'institution'=>$institution,
                'subject'=> $subject,
                'started_at' => $startedAt,
                'ended_at' => $endedAt,
                '$educational_status'=> $educationalStatus
            ]);
            return [
                'success'=>true,
                'message' => 'education has been created successfully'
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }


    /**
     * @param int $educationId
     * @param string $institution
     * @param string $subject
     * @param string $startedAt
     * @param string $endedAt
     * @param string $educationalStatus
     * @return array
     */
    public function update (int $educationId, string $institution, string $subject, string $startedAt, string $endedAt, string $educationalStatus) :array {
        try{

            $education =Education::where('id',$educationId)->update([
                'institution'=>$institution,
                'subject'=> $subject,
                'started_at' => $startedAt,
                'ended_at' => $endedAt,
                'educational_status'=> $educationalStatus
            ]);
            if(!$education){
                return $this->errorResponse;
            }
            return [
                'success'=>true,
                'message' => 'education status has been created successfully'
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $educationId
     * @return array
     */
    public function delete ($educationId) :array {
        $education = Education::where('id',$educationId)->delete();
        if(!$education){
            return $this->errorResponse;
        }
        return [
            'success'=>true,
            'message' => 'education status has been deleted successfully'
        ];
    }

}
