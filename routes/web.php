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
  Route::group(['prefix' => 'experience', 'as' => 'experience.'], function() {
    Route::get('list', 'ExperienceController@list')->name('table');
    Route::get('table/list', 'ExperienceController@experienceTable')->name('list.table');
    Route::post('new', 'ExperienceController@store')->name('store');
    Route::get('edit', 'ExperienceController@edit')->name('edit');
    Route::get('delete/{id}', 'ExperienceController@delete')->name('delete');
  });
  // Education
  Route::group(['prefix' => 'education', 'as' => 'education.'], function() {
    Route::get('list', 'EducationController@list')->name('table');
    Route::get('table/list', 'EducationController@educationTable')->name('list.table');
    Route::post('new', 'EducationController@store')->name('store');
    Route::get('edit', 'EducationController@edit')->name('edit');
    Route::get('delete/{id}', 'EducationController@delete')->name('delete');
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
  // Admin
  Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('list', 'AdminController@list')->name('table');
    Route::get('table/list', 'AdminController@adminTable')->name('list.table');
    Route::post('new', 'AdminController@store')->name('store');
    Route::get('edit', 'AdminController@edit')->name('edit');
    Route::get('delete/{id}', 'AdminController@delete')->name('delete');
  });
  // Setting
  Route::prefix('setting')->group(function () {
    Route::get('homeSetting', 'SettingController@index');
    Route::post('homeSetting', 'SettingController@update');
  });
  // Project
  Route::group(['prefix' => 'project' ,'as' => 'project.'], function() {
    Route::get('list', 'ProjectController@list')->name('table');
    Route::get('list/table', 'ProjectController@projectTable')->name('list.table');
    Route::post('new', 'ProjectController@store')->name('store');
    Route::get('edit', 'ProjectController@edit')->name('edit');
    Route::get('/delete/{id}', 'ProjectController@delete')->name('delete');
  });
  // Description
  Route::group(['prefix' => 'description' ,'as' => 'description.'], function() {
    Route::get('list', 'DescriptionController@list')->name('table');
    Route::get('list/table', 'DescriptionController@descriptionTable')->name('list.table');
    Route::post('new', 'DescriptionController@store')->name('store');
    Route::get('edit', 'DescriptionController@edit')->name('edit');
    Route::get('/delete/{id}', 'DescriptionController@delete')->name('delete');
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
  Route::group(['prefix' => 'link' ,'as' => 'link.'], function() {
    Route::get('list', 'LinkController@list')->name('table');
    Route::get('list/table', 'LinkController@linkTable')->name('list.table');
    Route::post('new', 'LinkController@store')->name('store');
    Route::get('edit', 'LinkController@edit')->name('edit');
    Route::get('eachDesc', 'LinkController@eachDesc')->name('eachDesc');
    Route::get('/delete/{id}', 'LinkController@delete')->name('delete');
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
