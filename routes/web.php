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
// Route::get('/', function () {
//   return view('welcome');
// });

Route::get('/cv','pouyaController@indexCv');
Route::get('/project','ProjectController@index');
Route::get('/login/login',[ 'as' => 'login.login', 'uses' => 'Auth\LoginController@index']);
Route::post('/post-login', 'Auth\LoginController@store');   
Route::get('/','pouyaController@indexHome');
Route::post('/','pouyaController@storeEmail');

Route::group(['middleware' => 'auth'], function () {
  // Experience
  Route::get('/experience/newExperience','ExperienceController@new');
  Route::post('/experience/newExperience', 'ExperienceController@store');
  Route::get('/experience/experienceList', 'ExperienceController@index');
  Route::get('/experience/experienceList/search', 'ExperienceController@search');
  Route::get('/experience/eachExperience/{id}', 'ExperienceController@show');
  Route::delete('/experience/experienceList/{id}', 'ExperienceController@destroy')->name('experience.destroy'); 
  Route::get('/experience/editExperience/{id}', 'ExperienceController@edit'); 
  Route::post('/experience/editExperience/{id}', 'ExperienceController@update'); 
  // Education
  Route::get('/education/newEducation/', 'EducationController@new'); 
  Route::post('/education/newEducation/', 'EducationController@store'); 
  Route::get('/education/educationList/', 'EducationController@index'); 
  Route::get('/education/educationList/search', 'EducationController@search');  
  Route::delete('/education/educationList/{id}', 'EducationController@destroy')->name('education.destroy'); 
  Route::get('/education/editEducation/{id}', 'EducationController@edit'); 
  Route::post('/education/editEducation/{id}', 'EducationController@update'); 
  Route::get('/education/eachEducation/{id}', 'EducationController@show');
  // Publication
  Route::get('/publication/newPublication/', 'PublicationController@new');
  Route::post('/publication/newPublication/', 'PublicationController@store');
  Route::get('/publication/publicationList/', 'PublicationController@index'); 
  Route::get('/publication/eachPublication/{id}', 'PublicationController@show'); 
  Route::get('/publication/editPublication/{id}', 'PublicationController@edit'); 
  Route::post('/publication/editPublication/{id}', 'PublicationController@update');
  Route::delete('/publication/publicationList/{id}', 'PublicationController@destroy')->name('publication.destroy'); 
  Route::get('/publication/publicationList/search', 'PublicaionController@search');  
  // Interest
  Route::get('/interest/newInterest', 'InterestController@new');
  Route::post('/interest/newInterest/', 'InterestController@store');
  Route::get('/interest/interestList/', 'InterestController@index');
  Route::get('/interest/eachInterest/{id}', 'InterestController@show'); 
  Route::get('/interest/editInterest/{id}', 'InterestController@edit'); 
  Route::post('/interest/editInterest/{id}', 'InterestController@update');
  Route::delete('/interest/interestList/{id}', 'InterestController@destroy')->name('interest.destroy'); 
  Route::get('/interest/interestList/search', 'InterestController@search');  
  // Skill
  Route::get('/skill/newSkill', 'SkillController@new');
  Route::post('/skill/newSkill/', 'SkillController@store');
  Route::get('/skill/skillList/', 'SkillController@index');
  Route::get('/skill/eachSkill/{id}', 'SkillController@show'); 
  Route::get('/skill/editSkill/{id}', 'SkillController@edit'); 
  Route::post('/skill/editSkill/{id}', 'SkillController@update');
  Route::delete('/skill/skillList/{id}', 'SkillController@destroy')->name('skill.destroy'); 
  Route::get('/skill/skillList/search', 'SkillController@search');  
  // Refree
  Route::get('/refree/newRefree', 'RefreeController@new');
  Route::post('/refree/newRefree/', 'RefreeController@store');
  Route::get('/refree/refreeList/', 'RefreeController@index');
  Route::get('/refree/eachRefree/{id}', 'RefreeController@show'); 
  Route::get('/refree/editRefree/{id}', 'RefreeController@edit'); 
  Route::post('/refree/editRefree/{id}', 'RefreeController@update');
  Route::delete('/refree/refreeList/{id}', 'RefreeController@destroy')->name('refree.destroy'); 
  Route::get('/refree/refreeList/search', 'RefreeController@search');
  // Admin Page
  Route::get('/adminHome',function(){ $user = auth()->user(); return view('/adminHome');});
  Route::get('/admin/newAdmin', 'AdminController@new'); 
  Route::post('/admin/newAdmin', 'AdminController@store'); 
  Route::get('/admin/adminList', 'AdminController@index'); 
  Route::get('/admin/editAdmin/{id}', 'AdminController@edit');
  Route::post('/admin/editAdmin/{id}', 'AdminController@update');
  Route::get('/admin/adminList/search', 'AdminController@search');
  Route::delete('/admin/adminList/{id}', 'AdminController@destroy')->name('admin.destroy'); 
  Route::get('/logout', 'AdminController@logout');
  // Setting
  Route::get('/setting/homeSetting', 'SettingController@index');
  Route::post('/setting/homeSetting', 'Settingontroller@update');
  // Project
  Route::get('/project/newProject', 'ProjectController@new');
  Route::post('/project/newProject', 'ProjectController@store');
  Route::get('/project/projectList','ProjectController@index');
  Route::get('/project/projectList/search','ProjectController@search');
  Route::get('/project/editProject/{id}','ProjectController@edit');
  Route::post('/project/editProject/{id}','ProjectController@update');
  Route::delete('/project/destroyProject/{id}', 'ProjectController@destroy')->name('project.destroy'); 
  // Description
  Route::get('/description/newDescription', 'DescriptionController@new');
  Route::post('/description/newDescription', 'DescriptionController@store');
  Route::get('/description/descriptionList', 'DescriptionController@index');
  Route::get('/description/descriptionList/search', 'DescriptionController@search');
  Route::get('/description/editDescription/{id}', 'DescriptionController@editDescription');
  Route::post('/description/editDescription/{id}', 'DescriptionController@update');
  Route::delete('/description/descriptionList/{id}', 'DescriptionController@destroy')->name('description.destroy'); 
  // Media
  Route::get('/media/newMedia', 'MediaController@new');
  Route::post('/media/newMedia', 'MediaController@store');
  Route::get('/media/mediaList', 'MediaController@index');
  Route::get('/media/mediaList/search', 'MediaController@search');
  Route::get('/media/editMedia/{id}', 'MediaController@edit');
  Route::post('/media/editMedia/{id}', 'MediaController@update'); 
  Route::delete('/media/mediaList/{id}', 'MediaController@destroy')->name('media.destroy'); 
  // Media Text
  Route::get('/media/newMediaText', 'MediaTextController@new');
  Route::post('/media/newMediaText', 'MediaTextController@store');
  Route::get('/media/mediaTextList', 'MediaTextController@index');
  Route::get('/media/mediaTextList/search', 'MediaTextController@search');
  Route::get('/media/editMediaText/{id}', 'MediaTextController@edit');
  Route::post('/media/editMediaText/{id}', 'MediaTextController@update'); 
  Route::delete('/media/mediaTextList/{id}', 'MediaTextController@destroy')->name('mediaText.destroy');
  // Link
  Route::get('/link/newLink', 'LinkController@new');
  Route::post('/link/newLink', 'LinkController@store');
  Route::get('/link/linkList', 'LinkController@index');
  Route::get('/link/linkList/search', 'LinkController@search');
  Route::get('/link/editLink/{id}', 'LinkController@edit');
  Route::post('/link/editLink/{id}', 'LinkController@update');
  Route::delete('/link/editLink/{id}', 'LinkController@destroy')->name('link.destroy'); 
  // Project
  Route::get('/project/newProjectTitle', 'ProjectTitleController@new');
  Route::post('/project/newProjectTitle', 'ProjectTitleController@store');
  Route::get('/project/projectTitleList', 'ProjectTitleController@index');
  Route::get('/project/projectTitleList/search', 'ProjectTitleController@search');
  Route::get('/project/editProjectTitle/{id}', 'ProjectTitleController@edit');
  Route::post('/project/editProjectTitle/{id}', 'ProjectTitleController@update');
  Route::delete('/project/projectTitleList/{id}', 'ProjectTitleController@destroy')->name('projectTitle.destroy'); 
});
