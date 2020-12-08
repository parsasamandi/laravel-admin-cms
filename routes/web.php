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

Route::get('/cv','pouyaController@indexCv');
Route::get('/project','ProjectController@index');
Route::get('/login/login',[ 'as' => 'login.login', 'uses' => 'Auth\LoginController@index']);
Route::post('/post-login', 'Auth\LoginController@store');   
Route::get('/','HomeController@index');
Route::post('/','pouyaController@storeEmail');

Route::group(['middleware' => 'auth'], function () {
  // Experience
  Route::prefix('experience')->group(function () {
    Route::get('newExperience','ExperienceController@new');
    Route::post('newExperience', 'ExperienceController@store');
    Route::get('experienceList', 'ExperienceController@index');
    Route::get('experienceList/search', 'ExperienceController@search');
    Route::get('eachExperience/{id}', 'ExperienceController@show');
    Route::delete('experienceList/{id}', 'ExperienceController@destroy')->name('experience.destroy'); 
    Route::get('editExperience/{id}', 'ExperienceController@edit'); 
    Route::post('editExperience/{id}', 'ExperienceController@update'); 
  });
  // Education
  Route::prefix('education')->group(function () {
    Route::get('newEducation', 'EducationController@new'); 
    Route::post('newEducation', 'EducationController@store'); 
    Route::get('educationList', 'EducationController@index'); 
    Route::get('educationList/search', 'EducationController@search');  
    Route::delete('educationList/{id}', 'EducationController@destroy')->name('education.destroy'); 
    Route::get('editEducation/{id}', 'EducationController@edit'); 
    Route::post('editEducation/{id}', 'EducationController@update'); 
    Route::get('eachEducation/{id}', 'EducationController@show');
  });
  // Publication
  Route::prefix('publication')->group(function () {
    Route::get('newPublication', 'PublicationController@new');
    Route::post('newPublication', 'PublicationController@store');
    Route::get('publicationList', 'PublicationController@index'); 
    Route::get('eachPublication/{id}', 'PublicationController@show'); 
    Route::get('editPublication/{id}', 'PublicationController@edit'); 
    Route::post('editPublication/{id}', 'PublicationController@update');
    Route::delete('publicationList/{id}', 'PublicationController@destroy')->name('publication.destroy'); 
    Route::get('publicationList/search', 'PublicaionController@search');  
  });
  // Interest
  Route::prefix('interest')->group(function () {
    Route::get('newInterest', 'InterestController@new');
    Route::post('newInterest', 'InterestController@store');
    Route::get('interestList', 'InterestController@index');
    Route::get('eachInterest/{id}', 'InterestController@show'); 
    Route::get('editInterest/{id}', 'InterestController@edit'); 
    Route::post('editInterest/{id}', 'InterestController@update');
    Route::delete('interestList/{id}', 'InterestController@destroy')->name('interest.destroy'); 
    Route::get('interestList/search', 'InterestController@search');  
  });
  // Skill
  Route::prefix('skill')->group(function () {
    Route::get('newSkill', 'SkillController@new');
    Route::post('newSkill', 'SkillController@store');
    Route::get('skillList', 'SkillController@index');
    Route::get('eachSkill/{id}', 'SkillController@show'); 
    Route::get('editSkill/{id}', 'SkillController@edit'); 
    Route::post('editSkill/{id}', 'SkillController@update');
    Route::delete('skillList/{id}', 'SkillController@destroy')->name('skill.destroy'); 
    Route::get('skillList/search', 'SkillController@search');  
  });
  // Refree
  Route::prefix('refree')->group(function () {
    Route::get('newRefree', 'RefreeController@new');
    Route::post('newRefree', 'RefreeController@store');
    Route::get('refreeList', 'RefreeController@index');
    Route::get('eachRefree/{id}', 'RefreeController@show'); 
    Route::get('editRefree/{id}', 'RefreeController@edit'); 
    Route::post('editRefree/{id}', 'RefreeController@update');
    Route::delete('refreeList/{id}', 'RefreeController@destroy')->name('refree.destroy'); 
    Route::get('refreeList/search', 'RefreeController@search');
  });
  // Admin Page
  Route::get('/adminHome','AdminController@adminHome');
  Route::get('/logout', 'AdminController@logout');
  Route::prefix('admin')->group(function () {
    Route::get('newAdmin', 'AdminController@new'); 
    Route::post('newAdmin', 'AdminController@store'); 
    Route::get('adminList', 'AdminController@index'); 
    Route::get('editAdmin/{id}', 'AdminController@edit');
    Route::post('editAdmin/{id}', 'AdminController@update');
    Route::get('adminList/search', 'AdminController@search');
    Route::delete('adminList/{id}', 'AdminController@destroy')->name('admin.destroy'); 
  });
  // Setting
  Route::prefix('setting')->group(function () {
    Route::get('homeSetting', 'SettingController@index');
    Route::post('homeSetting', 'SettingController@update');
  });
  // Project
  Route::prefix('project')->group(function () {
    Route::get('newProject', 'ProjectController@new');
    Route::post('newProject', 'ProjectController@store');
    Route::get('projectList','ProjectController@index');
    Route::get('projectList/search','ProjectController@search');
    Route::get('editProject/{id}','ProjectController@edit');
    Route::post('editProject/{id}','ProjectController@update');
    Route::delete('destroyProject/{id}', 'ProjectController@destroy')->name('project.destroy'); 
  });
  // Description
  Route::prefix('description')->group(function () {
    Route::get('newDescription', 'DescriptionController@new');
    Route::post('newDescription', 'DescriptionController@store');
    Route::get('descriptionList', 'DescriptionController@index');
    Route::get('descriptionList/search', 'DescriptionController@search');
    Route::get('editDescription/{id}', 'DescriptionController@editDescription');
    Route::post('editDescription/{id}', 'DescriptionController@update');
    Route::delete('descriptionList/{id}', 'DescriptionController@destroy')->name('description.destroy'); 
  });

  Route::prefix('media')->group(function () {
    // Media
    Route::get('newMedia', 'MediaController@new');
    Route::post('newMedia', 'MediaController@store');
    Route::get('mediaList', 'MediaController@index');
    Route::get('mediaList/search', 'MediaController@search');
    Route::get('editMedia/{id}', 'MediaController@edit');
    Route::post('editMedia/{id}', 'MediaController@update'); 
    Route::delete('mediaList/{id}', 'MediaController@destroy')->name('media.destroy');
    // Media Text
    Route::get('newMediaText', 'MediaTextController@new');
    Route::post('newMediaText', 'MediaTextController@store');
    Route::get('/media/mediaTextList', 'MediaTextController@index');
    Route::get('/media/mediaTextList/search', 'MediaTextController@search');
    Route::get('/media/editMediaText/{id}', 'MediaTextController@edit');
    Route::post('/media/editMediaText/{id}', 'MediaTextController@update'); 
    Route::delete('/media/mediaTextList/{id}', 'MediaTextController@destroy')->name('mediaText.destroy');
  });
  // Link
  Route::prefix('link')->group(function () {
    Route::get('newLink', 'LinkController@new');
    Route::post('newLink', 'LinkController@store');
    Route::get('linkList', 'LinkController@index');
    Route::get('linkList/search', 'LinkController@search');
    Route::get('editLink/{id}', 'LinkController@edit');
    Route::post('editLink/{id}', 'LinkController@update');
    Route::delete('editLink/{id}', 'LinkController@destroy')->name('link.destroy'); 
  });
  // Project
  Route::prefix('project')->group(function () {
    Route::get('newProjectTitle', 'ProjectTitleController@new');
    Route::post('newProjectTitle', 'ProjectTitleController@store');
    Route::get('projectTitleList', 'ProjectTitleController@index');
    Route::get('projectTitleList/search', 'ProjectTitleController@search');
    Route::get('editProjectTitle/{id}', 'ProjectTitleController@edit');
    Route::post('editProjectTitle/{id}', 'ProjectTitleController@update');
    Route::delete('projectTitleList/{id}', 'ProjectTitleController@destroy')->name('projectTitle.destroy'); 
  });

});
