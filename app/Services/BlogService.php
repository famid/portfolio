<?php


namespace App\Services;


use App\Models\Blog;
use Illuminate\Database\Eloquent\Collection;

class BlogService
{
    protected $errorResponse;

    /**
     * BlogService constructor.
     */
    public function  __construct() {
        $this->errorResponse = [
          'success' => false,
          'message' => 'something went wrong'
        ];
    }

    /**
     * @return Blog[]|Collection
     */
    public function allBlog () {
        return Blog::all();
    }

    /**
     * @param $blogId
     * @return array
     */
    public function blog ($blogId) :array{
        try {
            $blog = Blog::find($blogId);
            if (is_null($blog)){
                return ['success' => false, 'message' => 'Blog not found'];
            }
            return ['success' => true, 'data' => $blog];
        } catch (\Exception $e){

            return ['success' => false, 'message' => 'Blog not found'];
        }

    }

    /**
     * @param string $title
     * @param string $description
     * @param string $link
     * @param string $tags
     * @return array
     */
    public function create(string $title, string $description, string $link, string $tags) :array {
        try {
            Blog::create([
                'title' => $title,
                'description' => $description,
                'link'=> $link,
                'tags'=> $tags
            ]);
            return [
                'success' => true,
                'message'=> 'Blog has been created successfully'
            ];
        } catch (\Exception $e){
            return $this->errorResponse;
        }

    }

    /**
     * @param int $blogId
     * @param string $title
     * @param string $description
     * @param string $link
     * @param string $tags
     * @return array
     */
    public function update(int $blogId, string $title, string $description, string $link, string $tags) :array {
        try {
            $blog = Blog::where('id',$blogId)->update([
                'title' => $title,
                'description' => $description,
                'link'=> $link,
                'tags'=> $tags
            ]);
            if (!$blog){
                return $this->errorResponse;
            }
            return [
                'success' => true,
                'message'=> 'Blog has been updated successfully'
            ];
        } catch (\Exception $e){
            return $this->errorResponse;
        }

    }

    /**
     * @param int $blogId
     * @return array
     */
    public function delete(int $blogId) :array {
            $blog = Blog::where('id',$blogId)->delete();
            if (!$blog){
                return $this->errorResponse;
            }
            return [
                'success' => true,
                'message'=> 'Blog has been deleted successfully'
            ];
    }

}
