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
Route::get('/project','pouyaController@indexProjectHome');
Route::get('/login/login',[ 'as' => 'login.login', 'uses' => 'pouyaController@indexLogin']);
Route::post('/post-login', 'pouyaController@storeLogin');   
Route::get('/','pouyaController@indexHome');
Route::post('/','pouyaController@storeEmail');

Route::group(['middleware' => 'auth'], function () {
  Route::get('/experience/newExperience','ExperienceController@new');
  Route::post('/experience/newExperience', 'pouyaController@store');
  Route::get('/experience/experienceList', 'pouyaController@index');
  Route::get('/experience/experienceList/search', 'pouyaController@search');
  Route::get('/experience/eachExperience/{id}', 'pouyaController@show');
  Route::delete('/experience/experienceList/{id}', 'pouyaController@destroy')->name('experience.destroy'); 
  Route::get('/experience/editExperience/{id}', 'pouyaController@edit'); 
  Route::post('/experience/editExperience/{id}', 'pouyaController@update'); 

  Route::get('/education/newEducation/', 'pouyaController@newEducation'); 
  Route::post('/education/newEducation/', 'pouyaController@storeEducation'); 
  Route::get('/education/educationList/', 'pouyaController@indexEducation'); 
  Route::get('/education/educationList/search', 'pouyaController@searchEducation');  
  Route::delete('/education/educationList/{id}', 'pouyaController@destroyEducation')->name('education.destroy'); 
  Route::get('/education/editEducation/{id}', 'pouyaController@editEducation'); 
  Route::post('/education/editEducation/{id}', 'pouyaController@updateEducation'); 
  Route::get('/education/eachEducation/{id}', 'pouyaController@showEducation');

  Route::get('/publication/newPublication/', 'pouyaController@newPublication');
  Route::post('/publication/newPublication/', 'pouyaController@storePublication');
  Route::get('/publication/publicationList/', 'pouyaController@indexPublication'); 
  Route::get('/publication/eachPublication/{id}', 'pouyaController@showPublication'); 
  Route::get('/publication/editPublication/{id}', 'pouyaController@editPublication'); 
  Route::post('/publication/editPublication/{id}', 'pouyaController@updatePublication');
  Route::delete('/publication/publicationList/{id}', 'pouyaController@destroyPublication')->name('publication.destroy'); 
  Route::get('/publication/publicationList/search', 'pouyaController@searchEducation');  

  Route::get('/interest/newInterest', 'pouyaController@newInterest');
  Route::post('/interest/newInterest/', 'pouyaController@storeInterest');
  Route::get('/interest/interestList/', 'pouyaController@indexInterest');
  Route::get('/interest/eachInterest/{id}', 'pouyaController@showInterest'); 
  Route::get('/interest/editInterest/{id}', 'pouyaController@editInterest'); 
  Route::post('/interest/editInterest/{id}', 'pouyaController@updateInterest');
  Route::delete('/interest/interestList/{id}', 'pouyaController@destroyInterest')->name('interest.destroy'); 
  Route::get('/interest/interestList/search', 'pouyaController@searchInterest');  

  Route::get('/skill/newSkill', 'pouyaController@newSkill');
  Route::post('/skill/newSkill/', 'pouyaController@storeSkill');
  Route::get('/skill/skillList/', 'pouyaController@indexSkill');
  Route::get('/skill/eachSkill/{id}', 'pouyaController@showSkill'); 
  Route::get('/skill/editSkill/{id}', 'pouyaController@editSkill'); 
  Route::post('/skill/editSkill/{id}', 'pouyaController@updateSkill');
  Route::delete('/skill/skillList/{id}', 'pouyaController@destroySkill')->name('skill.destroy'); 
  Route::get('/skill/skillList/search', 'pouyaController@searchSkill');  

  Route::get('/refree/newRefree', 'pouyaController@newRefree');
  Route::post('/refree/newRefree/', 'pouyaController@storeRefree');
  Route::get('/refree/refreeList/', 'pouyaController@indexRefree');
  Route::get('/refree/eachRefree/{id}', 'pouyaController@showRefree'); 
  Route::get('/refree/editRefree/{id}', 'pouyaController@editRefree'); 
  Route::post('/refree/editRefree/{id}', 'pouyaController@updateRefree');
  Route::delete('/refree/refreeList/{id}', 'pouyaController@destroyRefree')->name('refree.destroy'); 
  Route::get('/refree/refreeList/search', 'pouyaController@searchRefree');

  Route::get('/adminHome','pouyaController@indexAdmin');
  Route::get('/admin/newAdmin', 'pouyaController@newAdmin'); 
  Route::post('/admin/newAdmin', 'pouyaController@storeAdmin'); 
  Route::get('/admin/adminList', 'pouyaController@indexAdmin2'); 
  Route::get('/admin/editAdmin/{id}', 'pouyaController@editAdmin');
  Route::post('/admin/editAdmin/{id}', 'pouyaController@updateAdmin');
  Route::get('/admin/adminList/search', 'pouyaController@searchAdmin');
  Route::delete('/admin/adminList/{id}', 'pouyaController@destroyAdmin')->name('admin.destroy'); 
  Route::get('/logout', 'pouyaController@logout');

  Route::get('/setting/homeSetting', 'pouyaController@indexSetting');
  Route::post('/setting/homeSetting', 'pouyaController@updateSetting');

  Route::get('/project/newProject', 'pouyaController@newProject');
  Route::post('/project/newProject', 'pouyaController@storeProject');
  Route::get('/project/projectList','pouyaController@indexProject');
  Route::get('/project/projectList/search','pouyaController@searchProject');
  Route::get('/project/editProject/{id}','pouyaController@editProject');
  Route::post('/project/editProject/{id}','pouyaController@updateProject');
  Route::delete('/project/destroyProject/{id}', 'pouyaController@destroyProject')->name('project.destroy'); 
  
  Route::get('/description/newDescription', 'DescriptionController@new');
  Route::post('/description/newDescription', 'DescriptionController@store');
  Route::get('/description/descriptionList', 'DescriptionController@index');
  Route::get('/description/descriptionList/search', 'DescriptionController@search');
  Route::get('/description/editDescription/{id}', 'DescriptionController@editDescription');
  Route::post('/description/editDescription/{id}', 'DescriptionController@update');
  Route::delete('/description/descriptionList/{id}', 'DescriptionController@destroy')->name('description.destroy'); 

  Route::get('/media/newMedia', 'MediaController@new');
  Route::post('/media/newMedia', 'MediaController@store');
  Route::get('/media/mediaList', 'MediaController@index');
  Route::get('/media/mediaList/search', 'MediaController@search');
  Route::get('/media/editMedia/{id}', 'MediaController@edit');
  Route::post('/media/editMedia/{id}', 'MediaController@update'); 
  Route::delete('/media/mediaList/{id}', 'MediaController@destroy')->name('media.destroy'); 

  Route::get('/media/newMediaText', 'MediaTextController@new');
  Route::post('/media/newMediaText', 'MediaTextController@store');
  Route::get('/media/mediaTextList', 'MediaTextController@index');
  Route::get('/media/mediaTextList/search', 'MediaTextController@search');
  Route::get('/media/editMediaText/{id}', 'MediaTextController@edit');
  Route::post('/media/editMediaText/{id}', 'MediaTextController@update'); 
  Route::delete('/media/mediaTextList/{id}', 'MediaTextController@destroy')->name('mediaText.destroy');

  Route::get('/link/newLink', 'LinkController@new');
  Route::post('/link/newLink', 'LinkController@store');
  Route::get('/link/linkList', 'LinkController@index');
  Route::get('/link/linkList/search', 'LinkController@search');
  Route::get('/link/editLink/{id}', 'LinkController@edit');
  Route::post('/link/editLink/{id}', 'LinkController@update');
  Route::delete('/link/editLink/{id}', 'LinkController@destroy')->name('link.destroy'); 

  Route::get('/project/newProjectTitle', 'pouyaController@newProjectTitle');
  Route::post('/project/newProjectTitle', 'pouyaController@storeProjectTitle');
  Route::get('/project/projectTitleList', 'pouyaController@indexProjectTitle');
  Route::get('/project/projectTitleList/search', 'pouyaController@searchProjectTitle');
  Route::get('/project/editProjectTitle/{id}', 'pouyaController@editProjectTitle');
  Route::post('/project/editProjectTitle/{id}', 'pouyaController@updateProjectTitle');
  Route::delete('/project/projectTitleList/{id}', 'pouyaController@destroyProjectTitle')->name('projectTitle.destroy'); 
  

});
