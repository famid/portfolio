<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['admin'])->namespace('Admin')->prefix('AQ76la03Ww27y2K0OXyFQW4DbwoLBROFKEzuxuiqE=')->group(function () {
    /*
     * ------------------------------------------------------------------------
     * HOME ROUTES
     * ------------------------------------------------------------------------
     * */
    Route::get('/home', 'HomeController@index')->name('home');

    /*
     * ------------------------------------------------------------------------
     * SKILL ROUTES
     * ------------------------------------------------------------------------
     * */
    Route::get('/skill-list', 'SkillController@skillList')->name('skillList');
    Route::post('/create-skill', 'SkillController@createSkill')->name('createSkill');
    Route::get('/delete-skill/id', 'SkillController@deleteSkill')->name('deleteSkill');
    Route::get('/edit-skill/id', 'SkillController@editSkill')->name('editSkill');
    Route::post('/update-skill/id', 'SkillController@updateSkill')->name('updateSkill');

    /*
     * --------------------------------------------------------
     * EXPERIENCE ROUTES
     * --------------------------------------------------------
     * */
    Route::get('/experience-list', 'ExperienceController@experienceList')->name('experienceList');
    Route::get('/create-experience', 'ExperienceController@showCreateExperience')->name('createExperience');
    Route::post('/create-experience', 'ExperienceController@createExperience')->name('createExperience');
    Route::get('/delete-experience/id', 'ExperienceController@deleteExperience')->name('deleteExperience');
    Route::get('/edit-experience/id', 'ExperienceController@editExperience')->name('editExperience');
    Route::post('/update-experience/id', 'ExperienceController@updateExperience')->name('updateExperience');

    /*
     * -----------------------------------------------------
     * BLOG ROUTES
     * -----------------------------------------------------
     * */
    Route::get('/blog-list', 'BlogController@blogList')->name('blogList');
    Route::get('/create-blog', 'BlogController@showCreateBlog')->name('createBlog');
    Route::post('/create-blog', 'BlogController@createBlog')->name('createBlog');
    Route::get('/delete-blog/id', 'BlogController@deleteBlog')->name('deleteBlog');
    Route::get('/edit-blog/id', 'BlogController@editBlog')->name('editBlog');
    Route::post('/update-blog/id', 'BlogController@updateBlog')->name('updateBlog');

    /*
     * ------------------------------------------------
     * MY STORY ROUTES
     * ------------------------------------------------
     * */
    Route::get('/myStory-list', 'MyStoryController@myStoryList')->name('myStoryList');
    Route::post('/create-myStory', 'MyStoryController@createMyStory')->name('createMyStory');
    Route::get('/edit-myStory/id', 'MyStoryController@editMyStory')->name('editMyStory');
    Route::post('/update-myStory/id', 'MyStoryController@updateMyStory')->name('updateMyStory');

    /*
     * -------------------------------------------------------
     * ACHIEVEMENT  ROUTES
     * -------------------------------------------------------
     * */
    Route::get('/achievement-list', 'AchievementController@achievementList')->name('achievementList');
    Route::get('/create-achievement', 'AchievementController@showCreateAchievement')->name('createAchievement');
    Route::post('/create-achievement', 'AchievementController@createAchievement')->name('createAchievement');
    Route::get('/delete-achievement/id', 'AchievementController@deleteAchievement')->name('deleteAchievement');
    Route::get('/edit-achievement/id', 'AchievementController@editAchievement')->name('editAchievement');
    Route::post('/update-achievement/id', 'AchievementController@updateAchievement')->name('updateAchievement');
    /*
     * -------------------------------------------------
     * RESUME ROUTES
     * -------------------------------------------------
     * */
    Route::get('/resume-list', 'ResumeController@resumeList')->name('resumeList');
    Route::post('/create-resume', 'ResumeController@createResume')->name('createResume');
    /*
        * -------------------------------------------------
        * EDUCATION ROUTES
        * -------------------------------------------------
        * */
    Route::get('/education-list', 'EducationController@educationList')->name('educationList');
    Route::get('/create-education', 'EducationController@showCreateEducation')->name('createEducation');
    Route::post('/create-education', 'EducationController@createEducation')->name('createEducation');
    Route::get('/delete-education/id', 'EducationController@deleteEducation')->name('deleteEducation');
    Route::get('/edit-education/id', 'EducationController@editEducation')->name('editEducation');
    Route::post('/update-education/id', 'EducationController@updateEducation')->name('updateEducation');
    /*
        * -------------------------------------------------
        * PROJECT ROUTES
        * -------------------------------------------------
        * */
    Route::get('/project-list','ProjectController@projectList')->name('projectList');
    Route::get('/create-project','ProjectController@showCreateProject')->name('createProject');
    Route::post('/create-project','ProjectController@createProject')->name('createProject');
    Route::get('/edit-project/id','ProjectController@editProject')->name('editProject');
    Route::post('/update-project/id','ProjectController@updateProject')->name('updateProject');
    Route::get('/delete-project/id','ProjectController@deleteProject')->name('deleteProject');
});

