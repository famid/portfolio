<?php


namespace App\Services;


use App\Models\Skill;
use Illuminate\Database\Eloquent\Collection;

class SkillService
{
    protected $errorResponse;

    /**
     * SkillService constructor.
     */
    public function __construct() {
        $this->errorResponse = [
            'success' => false,
            'message' => 'Something went wrong'
        ];
    }

    /**
     * @return Skill[]|Collection
     */
    public function skills () {
        return Skill::all();
    }

    /**
     * @param int $skillId
     * @return array
     */
    public function skill (int $skillId) :array {
        try {
            $skill = Skill::find($skillId);
            if(is_null($skill)) {
                return ['success' => false, 'message' => 'Skill not found'];
            }
            return ['success' => true, 'data' => $skill];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Skill not found'];
        }
    }

    /**
     * @param string $name
     * @return array
     */
    public function create (string $name) :array {
        try {
            Skill::create(['name' => $name]);
            return [
                'success' => true,
                'message' => 'Skill has been created successfully'
            ];
        } catch (\Exception $e) {
            return $this->errorResponse;
        }
    }

    /**
     * @param int $skillId
     * @param string $name
     * @return array
     */
    public function update (int $skillId, string $name) :array {
        try {
            $skillUpdateResponse = Skill::where('id', $skillId)->update(['name' => $name]);
            if (!$skillUpdateResponse) {
                return $this->errorResponse;
            }
            return [
                'success' => true,
                'message' => 'Skill has been updated successfully'
            ];
        } catch (\Exception $e) {
            return $this->errorResponse;
        }
    }

    /**
     * @param int $skillId
     * @return array
     */
    public function delete (int $skillId) :array {
        $skillDeleteResponse = Skill::where('id', $skillId)->delete();
        if (!$skillDeleteResponse) {
            return $this->errorResponse;
        }
        return [
            'success' => true,
            'message' => 'Skill has been deleted successfully'
        ];
    }


}
