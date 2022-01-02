<?php

use System\Router\Web\Route;

//Home Routes
Route::get('/home', 'Home\HomeController@index', 'home.index');
Route::get('/', 'Home\HomeController@index', 'home.index');
Route::get('/search', 'Home\HomeController@search', 'search');
Route::post('/news-letter', 'Home\HomeController@newsLatter', 'news.latter');
Route::get('/home/all-course-professor/{id}', 'Home\HomeController@professorAll', 'home.professor.all.course');
Route::get('/home/all-course', 'Home\HomeController@allCourse', 'home.all.course');


//Admin Routes
Route::get('/admin', 'Admin\AdminController@index', 'admin.index');
Route::get('/admin/search', 'Admin\AdminController@search', 'search.admin');
Route::get('/admin/setting', 'Admin\AdminController@setting', 'admin.setting');
Route::get('/admin/setting/edit', 'Admin\AdminController@editSetting', 'admin.setting.edit');
Route::put('/admin/setting/update/{id}', 'Admin\AdminController@updateSetting', 'admin.setting.update');

//////Auth Routes
//panel
Route::get('/adminlogin', 'Auth\User\LoginController@adminView', 'auth.login.admin.view');

//Auth User
Route::get('/login', 'Auth\User\LoginController@view', 'auth.login.view');
Route::post('/login', 'Auth\User\LoginController@login', 'auth.login');
Route::get('/register', 'Auth\User\RegisterController@view', 'auth.register.view');
Route::post('/register', 'Auth\User\RegisterController@register', 'auth.register');
Route::get('/register/activation/{token}', 'Auth\User\RegisterController@activation', 'auth.activation');
Route::get('/forgot', 'Auth\User\ForgotController@view', 'auth.forgot.password');
Route::post('/forgot', 'Auth\User\ForgotController@forgot', 'auth.forgot');
Route::get('/reset-password/{token}', 'Auth\User\ResetPasswordController@view', 'auth.reset-password.view');
Route::post('/reset-password/{token}', 'Auth\User\ResetPasswordController@resetPassword', 'auth.reset-password');
Route::get('/logout', 'Auth\User\LogoutController@logout', 'auth.logout');
Route::get('/adminlogout', 'Auth\User\LogoutController@adminLogout', 'auth.admin.logout');

// Auth Professor
Route::get('/professor/login', 'Auth\Professor\LoginController@view', 'auth.professor.login.view');
Route::post('/professor/login', 'Auth\Professor\LoginController@login', 'auth.professor.login');
Route::get('/professor/register', 'Auth\Professor\RegisterController@view', 'auth.professor.register.view');
Route::post('/professor/register', 'Auth\Professor\RegisterController@register', 'auth.professor.register');
Route::get('/professor/register/activation/{token}', 'Auth\Professor\RegisterController@activation', 'auth.professor.activation');
Route::get('/professor/forgot', 'Auth\Professor\ForgotController@view', 'auth.professor.forgot.password');
Route::post('/professor/forgot', 'Auth\Professor\ForgotController@forgot', 'auth.professor.forgot');
Route::get('/professor/reset-password/{token}', 'Auth\Professor\ResetPasswordController@view', 'auth.professor.reset-password.view');
Route::post('/professor/reset-password/{token}', 'Auth\Professor\ResetPasswordController@resetPassword', 'auth.professor.reset-password');
Route::get('/professor/logout', 'Auth\Professor\LogoutController@logout', 'auth.professor.logout');
//////Auth Routes End


//Category Admin Routes
Route::get('/admin/category', 'Admin\CategoryController@index', 'admin.category.index');
Route::get('/admin/category/create', 'Admin\CategoryController@create', 'admin.category.create');
Route::post('/admin/category/store', 'Admin\CategoryController@store', 'admin.category.store');
Route::get('/admin/category/edit/{id}', 'Admin\CategoryController@edit', 'admin.category.edit');
Route::put('/admin/category/update/{id}', 'Admin\CategoryController@update', 'admin.category.update');
Route::delete('/admin/category/delete/{id}', 'Admin\CategoryController@destroy', 'admin.category.delete');

//Category Home Routes
Route::get('/home/category/{id}', 'Home\CategoryController@show', 'home.category.show');


//User Routes
Route::get('/admin/user', 'Admin\UserController@index', 'admin.user.index');
Route::get('/admin/user/edit/{id}', 'Admin\UserController@edit', 'admin.user.edit');
Route::put('/admin/user/update/{id}', 'Admin\UserController@update', 'admin.user.update');
Route::get('/admin/user/changestatus/{id}', 'Admin\UserController@changeStatus', 'admin.user.change.status');
Route::delete('/admin/user/delete/{id}', 'Admin\UserController@destroy', 'admin.user.delete');

Route::get('/user', 'Home\UserController@show', 'home.user.show');
Route::get('/user/changePassword', 'Home\UserController@changePasswordShow', 'home.user.change.password.show');
Route::post('/user/changePassword/{id}', 'Home\UserController@changePassword', 'home.user.change.password');
Route::get('/user/changeProfile', 'Home\UserController@changeProfileShow', 'home.user.change.profile.show');
Route::post('/user/changeProfile/{id}', 'Home\UserController@changeProfile', 'home.user.change.profile');
Route::get('/user/cart', 'Home\UserController@cart', 'home.user.cart');


//Professor Routes
Route::get('/professor', 'Home\ProfessorController@show', 'home.professor.show');
Route::get('/professor/editInfo', 'Home\ProfessorController@editInfo', 'home.professor.edit.info');
Route::put('/professor/updateInfo/{id}', 'Home\ProfessorController@updateInfo', 'home.professor.update.info');

Route::get('/admin/professor', 'Admin\ProfessorController@index', 'admin.professor.index');
Route::get('/admin/professor/edit/{id}', 'Admin\ProfessorController@edit', 'admin.professor.edit');
Route::put('/admin/professor/update/{id}', 'Admin\ProfessorController@update', 'admin.professor.update');
Route::get('/admin/professor/changestatus/{id}', 'Admin\ProfessorController@changeStatus', 'admin.professor.change.status');
Route::delete('/admin/professor/delete/{id}', 'Admin\ProfessorController@destroy', 'admin.professor.delete');


//Course Routs
Route::get('/course/create', 'Home\CourseController@create', 'home.course.create');
Route::post('/course/store', 'Home\CourseController@store', 'home.course.store');
Route::get('/course/edit/{id}', 'Home\CourseController@edit', 'home.course.edit');
Route::put('/course/update/{id}', 'Home\CourseController@update', 'home.course.update');
Route::get('/course/delete/{id}', 'Home\CourseController@destroy', 'home.course.delete');

Route::get('/admin/course', 'Admin\CourseController@index', 'admin.course.index');
Route::get('/admin/course/edit/{id}', 'Admin\CourseController@edit', 'admin.course.edit');
Route::put('/admin/course/update/{id}', 'Admin\CourseController@update', 'admin.course.update');
Route::delete('/admin/course/delete/{id}', 'Admin\CourseController@destroy', 'admin.course.delete');
Route::get('/admin/course/chnage/status/{id}', 'Admin\CourseController@changeStatus', 'admin.course.change.status');


//Comment Routs
Route::get('/admin/comment', 'Admin\CommentController@index', 'admin.comment.index');
Route::get('/admin/comment/show/{id}', 'Admin\CommentController@show', 'admin.comment.show');
Route::get('/admin/comment/confirm/{id}', 'Admin\CommentController@confirm', 'admin.comment.confirm');
Route::get('/admin/comment/chnage/status/{id}', 'Admin\CommentController@changeStatus', 'admin.comment.change.status');

Route::post('/comment/add/{courseId}', 'Home\CommentController@add', 'home.comment.add');
Route::post('/comment/answer/{commentId}', 'Home\CommentController@answer', 'home.comment.answer');


//Course Show Routs
Route::get('/course/show/{id}', 'Home\CourseShowController@show', 'home.course.show');
Route::get('/course/video/download/{id}', 'Home\CourseShowController@download', 'home.course.video.download');


//Video Routs
Route::get('/course/video/list/{id}', 'Home\VideoController@list', 'home.course.video.list');
Route::get('/course/video/create/{id}', 'Home\VideoController@create', 'home.course.video.create');
Route::post('/course/video/store/{id}', 'Home\VideoController@store', 'home.course.video.store');
Route::get('/course/video/edit/{id}', 'Home\VideoController@edit', 'home.course.video.edit');
Route::put('/course/video/update/{id}', 'Home\VideoController@update', 'home.course.video.update');
Route::delete('/course/video/delete/{id}', 'Home\VideoController@destroy', 'home.course.video.delete');
Route::get('/course/video/changestatus/{id}', 'Home\VideoController@changeStatus', 'home.course.video.change.status');

Route::get('/admin/video', 'Admin\VideoController@index', 'admin.video.index');
Route::delete('/admin/video/delete/{id}', 'Admin\VideoController@destroy', 'admin.video.delete');


//Cart Routs
Route::get('/cart/show', 'Home\CartController@index', 'home.cart.show');
Route::post('/cart/add/{courseId}', 'Home\CartController@add', 'home.cart.add');
Route::get('/cart/remove/{id}', 'Home\CartController@remove', 'home.cart.remove');


//News Latter Routs
Route::get('/admin/news-latter', 'Admin\NewsLatterController@index', 'admin.news.latter');


//payment
Route::put('/payment', 'Home\CartController@payment', 'user.payment');
Route::get('/payment/request/{amount}', 'Auth\PaymentRequestController@request', 'user.payment.request');
Route::get('/payment/verify', 'Auth\PaymentVerifyController@verify', 'user.payment.verify');
