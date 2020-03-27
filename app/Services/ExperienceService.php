<?php


namespace App\Services;


use App\Models\Experience;
use Illuminate\Database\Eloquent\Collection;

class ExperienceService
{
    protected $errorResponse;

    public function __construct() {
        $this->errorResponse = [
            'success' => false,
            'message' => 'Something went wrong'
        ];
    }

    /**
     * @return Experience[]|Collection
     */
    public function experiences () {
        return Experience::all();
    }

    /**
     * @param int $experienceId
     * @return array
     */
    public function experience (int $experienceId) :array {
       try {
           $experience = Experience::find($experienceId);
           if (is_null($experience)){
               return ['success' => false, 'message' => 'Experience not found'];
           }
           return ['success' => true, 'data' => $experience];
       } catch (\Exception $e){
           return ['success' => false, 'message' => 'Experience not found'];
       }

    }

    /**
     * @param string $title
     * @param string $company
     * @param string $city
     * @param string $country
     * @param string $companyDescription
     * @param string $achievement
     * @param string $startedAt
     * @param string $endedAt
     * @param string $stillWorking
     * @return array
     */
    public function create (string $title, string $company, string $startedAt, string $endedAt, string $city, string $country, string $companyDescription, string $achievement, string $stillWorking) :array {
        try {
            Experience::create([
                'title' => $title,
                'company'=>$company,
                'started_at'=>$startedAt,
                'ended_at' =>$endedAt,
                'city'=> $city,
                'country'=>$country,
                'company_description' => $companyDescription,
                'achievement'=>$achievement,
                'still_working'=>$stillWorking
            ]);
            return [
                'success' => true,
                'message' => 'Experience has been created successfully'
            ];

        } catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param int $experienceId
     * @param string $title
     * @param string $company
     * @param string $startedAt
     * @param string $endedAt
     * @param string $city
     * @param string $country
     * @param string $companyDescription
     * @param string $achievement
     * @param string $stillWorking
     * @return array
     */
    public function update (int $experienceId,string $title, string $company, string $startedAt, string $endedAt, string $city, string $country, string $companyDescription, string $achievement, string $stillWorking) :array {
        try {
            $experienceUpdateResponse = Experience::where('id', $experienceId)->update([
                'title' => $title,
                'company'=>$company,
                'started_at'=>$startedAt,
                'ended_at' =>$endedAt,
                'city'=> $city,
                'country'=>$country,
                'company_description' => $companyDescription,
                'achievement'=>$achievement,
                'still_working'=>$stillWorking
            ]);
            if (!$experienceUpdateResponse){
                return $this->errorResponse;
            }
            return [
                'success' => true,
                'message' => 'Experience has been updated successfully'
            ];

        } catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param int $experienceId
     * @return array
     */
    public function delete (int $experienceId) :array {
            $experienceDeleteResponse = Experience::where('id', $experienceId)->delete();
            if (!$experienceDeleteResponse){
                return $this->errorResponse;
            }
            return [
                'success' => true,
                'message' => 'Experience has been deleted successfully'
            ];
    }
}
