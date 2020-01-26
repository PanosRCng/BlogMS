<?php



Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/sidebar', 'DashboardController@sidebar');
Route::get('/dashboard/featured_articles', 'DashboardController@featured_articles');
Route::get('/dashboard/articles', 'DashboardController@articles');
Route::get('/dashboard/categories', 'DashboardController@categories');
Route::get('/dashboard/social_links', 'DashboardController@social_links');

Route::post('/dashboard/sidebar/update', 'Dashboard\SidebarController@update');
Route::post('/dashboard/sidebar/upload_logo', 'Dashboard\SidebarController@upload_logo');
Route::get('/dashboard/sidebar/delete_logo', 'Dashboard\SidebarController@delete_logo');
Route::get('/dashboard/sidebar/{option}/option_enable', 'Dashboard\SidebarController@enable_option');
Route::get('/dashboard/sidebar/{option}/option_disable', 'Dashboard\SidebarController@disable_option');

Route::post('/dashboard/article/create', 'Dashboard\ArticleController@create');
Route::get('/dashboard/article/{id}', 'Dashboard\ArticleController@article');
Route::post('/dashboard/article/{id}/delete', 'Dashboard\ArticleController@delete');
Route::post('/dashboard/article/{id}/update', 'Dashboard\ArticleController@update');
Route::get('/dashboard/article/{id}/enable', 'Dashboard\ArticleController@enable');
Route::get('/dashboard/article/{id}/disable', 'Dashboard\ArticleController@disable');
Route::post('/dashboard/article/{id}/create_segment', 'Dashboard\ArticleController@create_segment');
Route::get('/dashboard/article/{id}/move_up_segment/{article_segment_id}', 'Dashboard\ArticleController@move_up_segment');
Route::get('/dashboard/article/{id}/move_down_segment/{article_segment_id}', 'Dashboard\ArticleController@move_down_segment');

Route::post('/dashboard/category/create', 'Dashboard\CategoryController@create');
Route::get('/dashboard/category/{id}', 'Dashboard\CategoryController@category');
Route::post('/dashboard/category/{id}/delete', 'Dashboard\CategoryController@delete');
Route::post('/dashboard/category/{id}/update_name', 'Dashboard\CategoryController@update_name');
Route::get('/dashboard/category/{id}/enable', 'Dashboard\CategoryController@enable');
Route::get('/dashboard/category/{id}/disable', 'Dashboard\CategoryController@disable');
Route::post('/dashboard/category/{id}/attach_article', 'Dashboard\CategoryController@attach_article');
Route::get('/dashboard/category/{id}/detach_article/{article_id}', 'Dashboard\CategoryController@detach_article');
Route::get('/dashboard/category/{id}/move_up_article/{article_id}', 'Dashboard\CategoryController@move_up_article');
Route::get('/dashboard/category/{id}/move_down_article/{article_id}', 'Dashboard\CategoryController@move_down_article');

Route::post('/dashboard/social_link/create', 'Dashboard\SocialLinkController@create');
Route::get('/dashboard/social_link/{id}/delete', 'Dashboard\SocialLinkController@delete');
Route::get('/dashboard/social_link/{id}/enable', 'Dashboard\SocialLinkController@enable');
Route::get('/dashboard/social_link/{id}/disable', 'Dashboard\SocialLinkController@disable');
Route::get('/dashboard/social_link/{id}/move_up', 'Dashboard\SocialLinkController@move_up');
Route::get('/dashboard/social_link/{id}/move_down', 'Dashboard\SocialLinkController@move_down');

Route::get('/dashboard/segment/{segment_id}', 'Dashboard\SegmentController@segment');
Route::get('/dashboard/segment/{segment_id}/enable', 'Dashboard\SegmentController@enable');
Route::get('/dashboard/segment/{segment_id}/disable', 'Dashboard\SegmentController@disable');
Route::post('/dashboard/segment/{segment_id}/delete', 'Dashboard\SegmentController@delete');

Route::post('/dashboard/segment/{segment_id}/text_segment/update', 'Dashboard\TextSegmentController@update_text');

Route::post('/dashboard/segment/{segment_id}/file_segment/update', 'Dashboard\FileSegmentController@update');
Route::post('/dashboard/segment/{segment_id}/file_segment/upload_file', 'Dashboard\FileSegmentController@upload_file');
Route::get('/dashboard/segment/{segment_id}/file_segment/delete_file', 'Dashboard\FileSegmentController@delete_file');
Route::post('/dashboard/segment/{segment_id}/file_segment/upload_preview', 'Dashboard\FileSegmentController@upload_file_preview');
Route::get('/dashboard/segment/{segment_id}/file_segment/delete_preview', 'Dashboard\FileSegmentController@delete_file_preview');

Route::post('/dashboard/segment/{segment_id}/photo_gallery_segment/update_description', 'Dashboard\PhotoGallerySegmentController@update_description');
Route::post('/dashboard/segment/{segment_id}/photo_gallery_segment/add_photo', 'Dashboard\PhotoGallerySegmentController@add_photo');
Route::get('/dashboard/segment/{segment_id}/photo_gallery_segment/photo/{photo_id}/delete', 'Dashboard\PhotoGallerySegmentController@delete_photo');



Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/settings/change_password', 'Auth\SettingsController@change_password');
Route::get('/settings', 'Auth\SettingsController@index');



Route::get('/{article_title}', 'AppController@article');
Route::get('category/{category_name}', 'AppController@category');
Route::get('/document/{filename}', 'AppController@file');
Route::get('/image/{filename}', 'AppController@photo');
Route::get('/', 'AppController@index');