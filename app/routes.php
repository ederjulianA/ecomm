<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/*Route::filter('before', function()
{
    // Check if we asked for a user
    $server = explode('.', Request::server('HTTP_HOST'));

    if (count($server) == 3) 
    {
        // We have 3 parts of the domain - therefore a subdomain was requested
        // i.e.  user.domain.com

        // Check if user is valid and has access - i.e. is logged in
        if (Auth::user()->username === $server[0])
        {
            // User is logged in, and has access to this subdomain

            // DO WHATEVER YOU WANT HERE WITH THE USER PROFILE
            echo "your username is ".$server[0];
        }
        else
        {
            // Username is invalid, or user does not have access to this subdomain
            // SHOW ERROR OR WHATEVER YOU WANT
            echo "error - you do not have access to here";
        }

    }
    else
    {
        // Only 2 parts of domain was requested - therefore no subdomain was requested
        // i.e. domain.com

        // Do nothing here - will just route normally - but you could put logic here if you want
    }
});*/

Route::get('/', array('uses'=>'StoreController@getIndex'));

Route::controller('admin/categories','CategoriesController');
Route::controller('admin/products','ProductsController');

Route::controller('store', 'StoreController');
Route::controller('favorites', 'FavoritesController');
Route::controller('users', 'UsersController');


Route::post('/store/addTocart', array(
		'as' => 'addTocart',
		'uses' => 'StoreController@postAddcart'
	));


Route::post('/addCart', array(
		'as' => 'addCart',
		'uses' => 'AjaxController@addCart'
	));
Route::get('/ajax', array(
		'as' => 'ajax',
		'uses' => 'AjaxController@getAjax'
	));

Route::get('/chat', array(
		'as' => 'chat',
		'uses' => 'AjaxController@getChat'
	));

Route::get('/svc', array(
		'as' => 'svc',
		'uses' => 'SvcController@getSvc'
	));

Route::post('/svc-post', array(
		'as' => 'svcPost',
		'uses' => 'SvcController@postUpload'
	));

Route::post('/ajax/lista', array(
		'as' => 'ajax-lista',
		'uses' => 'AjaxController@postAjax'
	));

Route::post('/ajax-chat', array(
		'as' => 'ajax-chat',
		'uses' => 'AjaxController@postChat'
	));

Route::post('/get-ajax', array(
		'as' => 'getA',
		'uses' => 'AjaxController@posGetA'
	));

Route::post('/get-ajax-2', array(
		'as' => 'getA-2',
		'uses' => 'AjaxController@posGetA2'
	));

Route::get('/getFeed', array(
		'as' => 'getFeed',
		'uses' => 'AjaxController@getFeed'
	));

Route::get('/getFeed', array(
		'as' => 'getFeed',
		'uses' => 'AjaxController@getFeed'
	));

Route::get('/resize', array(
		'as' => 'resizing',
		'uses' => 'HomeController@getResize'
	));


Route::post('/resizePost', array(
		'as' => 'resizePost',
		'uses' => 'HomeController@postResize'
	));
