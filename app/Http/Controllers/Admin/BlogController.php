<?php

namespace App\Http\Controllers\Admin;

use App\Services\BlogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    protected $blogService;
    public function __construct() {
        $this->blogService = new BlogService();
    }
    public function blogList () {
       $data['blogs'] = $this->blogService->allBlog();
        return view('admin.blog.showBlog',compact('data'));
    }
    public function showCreateBlog () {
       return view('admin.blog.createBlog');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function createBlog (Request $request){
       $rules= [
           'title'=>'required|max:50',
           'description'=>'required|max:255',
           'link'=>'required|max:100',
           'tags'=>'required|max:50'
       ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return redirect()->route('blogList')->with('error',$validator->errors()->first());
        }
        $createBlogResponse = $this->blogService->create(
            $request->title,
            $request->description,
            $request->link,
            $request->tags,

        );
        if(!$createBlogResponse['success']){
            return redirect()->back()->with('error', $createBlogResponse['message']);
        }
        return redirect()->route('blogList')->with('success', $createBlogResponse['message']);

    }
    public function editBlog (Request $request) {
        try {
            $blog = $this->blogService->blog($request->id);
            if(!$blog['success']) {
                return redirect(route('blogList'))->with('error',$blog['message']);
            }
            $data['blog'] = $blog['data'];
            return view('admin.blog.editBlog', $data);
        } catch (\Exception $e) {
            return redirect()->route('blogList')->with('error', 'Invalid decryption');
        }
    }
    public function updateBlog (Request $request) {
        $rules= [
            'title'=>'required|max:50',
            'description'=>'required|max:255',
            'link'=>'required|max:100',
            'tags'=>'required|max:50'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return redirect()->route('blogList')->with('error',$validator->errors()->first());
        }
        $updateBlogResponse = $this->blogService->update(
            $request->id,
            $request->title,
            $request->description,
            $request->link,
            $request->tags,

        );
        if(!$updateBlogResponse['success']){
            return redirect()->back()->with('error', $updateBlogResponse['message']);
        }
        return redirect()->route('blogList')->with('success', $updateBlogResponse['message']);
    }
    public function deleteBlog (Request $request) {
        $deleteBlogResponse = $this->blogService->delete($request->id);
        if(!$deleteBlogResponse['success']){
            return redirect()->back()->with('error', $deleteBlogResponse['message']);
        }
        return redirect()->route('blogList')->with('success', $deleteBlogResponse['message']);
    }

}
