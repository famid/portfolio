<?php

namespace App\Http\Controllers\Admin;

use App\Services\MyStoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class MyStoryController extends Controller
{
    protected $myStoryService;

    /**
     * MyStoryController constructor.
     */
    public function __construct() {
        $this->myStoryService = new MyStoryService();
    }

    /**
     * @return Factory|View
     */
    public function myStoryList () {
        $data['myStories'] = $this->myStoryService->allStory();
        return view('admin.mystory.mystory',compact('data'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function createMyStory (Request $request) {
        $rules = [
            'description' => 'required|max:255'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        $createMyStoryResponse = $this->myStoryService->create($request->description);
       if(!$createMyStoryResponse['success']) {
            return redirect()->route('myStoryList')->with('error', $createMyStoryResponse['message']);
        }
        return redirect()->route('myStoryList')->with('error', $createMyStoryResponse['message']);
    }

    /**
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    public function editMyStory (Request $request) {
        try{
            $myStory = $this->myStoryService->myStory($request->id);
            if(!$myStory['success']) {
                return redirect()->route('myStoryList')->with('error',$myStory['message']);
            }
            $data['myStory'] = $myStory['data'];
            return view('admin.mystory.editMyStory',$data);
        } catch (\Exception $e) {

        }
        return redirect()->route('myStoryList')->with('error', 'Invalid decryption');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateMyStory (Request $request) {
        $rules = [
            'description' => 'required|max:300'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        $updateMyStoryResponse = $this->myStoryService->update(
            $request->id,
            $request->description
        );
       if(!$updateMyStoryResponse['success']) {
           return redirect()->route('myStoryList')->with('error', $updateMyStoryResponse['message']);
       }
        return redirect()->route('myStoryList')->with('error', $updateMyStoryResponse['message']);
    }
}
