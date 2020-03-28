<?php


namespace App\Services;


use App\Models\Achievement;

class AchievementService
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
     * @return Achievement[]|\Illuminate\Database\Eloquent\Collection
     */
    public function achievements () {
        return Achievement::all();
    }

    /**
     * @param int $achievementId
     * @return array
     */
    public function achievement (int $achievementId) :array {
        try{
            $achievement = Achievement::find($achievementId);
            if(is_null($achievement)){
                return ['success'=>false,'message'=>'Achievement not found'];
            }
            return ['success'=>true ,'data'=>$achievement];
        }catch (\Exception $e){
            return ['success'=>false,'message'=>'Achievement not found'];

        }
    }

    public function getAchievementFile (int $achievementId) :array {
        try{
            $achievementFile = Achievement::find($achievementId)->file;
            if(is_null($achievementFile)){
                return ['success'=>false,'message'=>'Achievement file not found'];
            }
            return ['success'=>true ,'data'=>$achievementFile];
        }catch (\Exception $e){
            return $this->errorResponse;

        }
    }

    /**
     * @param string $title
     * @param string $date
     * @param string $description
     * @param string $file
     * @return array
     */
    public function create (string $title, string $date, string $description, string $file=null) :array {
        try{
            Achievement::create([
                'title'=>$title,
                'date'=> $date,
                'description' => $description,
                'file'=> $file
            ]);
           return [
               'success'=>true,
               'message' => 'achievement has been created successfully'
           ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param int $achievementId
     * @param string $title
     * @param string $date
     * @param string $description
     * @param string $file
     * @return array
     */
    public function update (int $achievementId, string $title, string $date, string $description, string $file) :array {
        try{
            $achievement =Achievement::where('id',$achievementId)->update([
                'title'=>$title,
                'date'=> $date,
                'description' => $description,
                'file'=> $file
            ]);
            if(!$achievement){
                return $this->errorResponse;
            }
            return [
                'success'=>true,
                'message' => 'achievement has been created successfully'
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $achievementId
     * @return array
     */
    public function delete ($achievementId) :array {
        $achievement = Achievement::where('id',$achievementId)->delete();
        if(!$achievement){
            return $this->errorResponse;
        }
        return [
            'success'=>true,
            'message' => 'achievement has been deleted successfully'
        ];
    }
}
