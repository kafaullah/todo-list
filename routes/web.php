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
//     return view('welcome');
// });

Route::get('/', 'TodoController@index');
Route::get('/add-todo', 'TodoController@create')->name('addTodo');
Route::post('/save-todo', 'TodoController@store')->name('saveTodo');
Route::get('/edit-todo/{id}', 'TodoController@edit')->name('editTodo');
Route::get('/show-trash-todos', 'TodoController@showTrashTodoList')->name('showTrashTodos');
Route::get('/trash-todo/{id}', 'TodoController@trash')->name('trashTodo');
Route::get('/restore-todo/{id}', 'TodoController@restore')->name('restoreTodo');
Route::get('/delete-todo/{id}', 'TodoController@destroy')->name('deleteTodo');

Route::get('/reminders', 'ReminderController@index')->name('reminders');
Route::get('/add-reminder', 'ReminderController@create')->name('addReminder');
Route::post('/save-reminder', 'ReminderController@store')->name('saveReminder');
Route::get('/edit-reminder/{id}', 'ReminderController@edit')->name('editReminder');
Route::get('/delete-reminder/{id}', 'ReminderController@destroy')->name('deleteReminder');

Route::get('/add-user-data', 'UserDataController@create')->name('addUserData');
Route::post('/save-user-data', 'UserDataController@store')->name('saveUserData');
Route::get('/edit-user-data/{id}', 'UserDataController@edit')->name('editUserData');
Route::get('/trash-user-data/{id}', 'UserDataController@trash')->name('trashUserData');
Route::get('/show-trash-user-data', 'UserDataController@showTrashItems')->name('showTrashUserData');
Route::get('/restore-user-data/{id}', 'UserDataController@restore')->name('restoreUserData');
Route::get('/delete-user-data/{id}', 'UserDataController@destroy')->name('deleteUserData');

// Route::get('/form', 'TestFormController@index');
// Route::post('/validaton', 'TestFormController@store')->name('validation');

// Route::get('master', function(){
// 	return view('masterView', ['data' => '<h1>Kafa is a good boy. He is a ashiq of abida jaan</h1>']);
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
