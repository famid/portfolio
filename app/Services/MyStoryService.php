<?php


namespace App\Services;


use App\Models\MyStory;

class MyStoryService
{
    protected $errorResponse;

    /**
     * MyStoryService constructor.
     */
    public function __construct() {
        $this->errorResponse = [
            'success' => false,
            'message' => 'Something went wrong'
        ];
    }

    /**
     *
     */
    public function allStory () {
        return MyStory::all();
    }

    /**
     * @param int $myStoryId
     * @return array
     */
    public function myStory (int $myStoryId) :array {
        try {
            $myStory=MyStory::find($myStoryId);
            if (is_null($myStory)){
                return['success'=>false , 'message'=>'Story not found'];
            }
            return ['success'=> true , 'data'=>$myStory];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'story not found'
            ];
        }
    }

    /**
     * @param string $description
     * @return array
     */
    public function create (string $description) :array {
        try {
            MyStory::create(['description' => $description]);
            return [
                'success' => true,
                'message' => 'My story has been created successfully'
            ];
        } catch (\Exception $e) {
            return $this->errorResponse;
        }
    }

    /**
     * @param int $myStoryId
     * @param string $description
     * @return array
     */
    public function update (int $myStoryId, string $description){
        try {
            $myStoryUpdateResponse = MyStory::where('id',$myStoryId)->update(['description' => $description]);
            if (!$myStoryUpdateResponse){
                return $this->errorResponse;
            }
            return [
              'success' => true,
              'message' => 'story has been updated '
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }
}
