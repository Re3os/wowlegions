<?php

Route::get('/', function () {
    return redirect('/'. App\Http\Middleware\LocaleMiddleware::$mainLanguage);
});

Route::get('lang/{lang}', function ($lang) {

    $referer = Redirect::back()->getTargetUrl();
    $parse_url = parse_url($referer, PHP_URL_PATH);
    $segments = explode('/', $parse_url);
    if (in_array($segments[1], App\Http\Middleware\LocaleMiddleware::$languages)) {

        unset($segments[1]);
    }

    array_splice($segments, 1, 0, $lang);
    $url = Request::root().implode("/", $segments);
    if(parse_url($referer, PHP_URL_QUERY)){
        $url = $url.'?'. parse_url($referer, PHP_URL_QUERY);
    }
    return redirect($url);

})->name('lang');

//// Comments route
Route::get('/discussion/{id}/load.json', 'DiscussionController@loadComments');
Route::post('/discussion/{id}/comment.json', 'DiscussionController@commentJson');

//// Sidebar route
Route::get('/sidebar/realm-status', 'SidebarController@SidebarStatus')->name('status');
Route::get('/sidebar/client', 'SidebarController@SidebarClient')->name('client');
Route::get('/sidebar/events', 'SidebarController@SidebarEvents')->name('events');
Route::get('/sidebar/blizzard-posts', 'SidebarController@SidebarForum')->name('forum');

Route::group(['prefix' => App\Http\Middleware\LocaleMiddleware::getLocale()], function(){
    /// Auth route
    Auth::routes();
    Route::get('logout','Auth\LoginController@logout');
    /// Auth route end

    Route::get('/', 'HomeController@index')->name('home');

    //// Blog route
    Route::resource('blog', 'BlogController', ['parameters' => ['id' => 'id', 't' => 't']]);

    //// Shop route
    Route::get('shop/', 'ShopController@index')->name('shop');

    /// Forum route
    Route::get('forums/', 'CategoryController@index')->name('forums');
    Route::get('forums/{category}', 'CategoryController@show')->name('forum')->where('category', '[0-9]+');
    Route::get('forums/search', 'TopicsController@search')->name('forum.search');
    Route::post('forums/{category}/create', 'TopicsController@store')->name('forum.topic.store')->where('category', '[0-9]+');
    Route::get('forums/{category}/topic/{topic}', 'TopicsController@show')->name('forum.topic')->where(['category' => '[0-9]+', 'topic' => '[0-9]+']);
    Route::post('forums/{category}/{topic}/create', 'TopicsController@store_reply')->name('forum.topic.reply.create')->where(['category' => '[0-9]+', 'topic' => '[0-9]+']);
    Route::patch('forums/{category}/{topic}', 'TopicsController@update_reply')->name('forum.topic.reply.update')->where(['category' => '[0-9]+', 'topic' => '[0-9]+']);
    Route::delete('forums/{category}/{topic}/{reply}', 'TopicsController@delete_reply')->name('forum.topic.reply.destroy')->where(['category' => '[0-9]+', 'topic' => '[0-9]+', 'reply' => '[0-9]+']);

    Route::get('account/management', 'UserController@showProfile')->name('account');
    Route::get('account/management/settings/change-email.html', 'UserController@changeEmail');
    Route::post('account/management/settings/change-email.html', 'UserController@changeEmailActoin')->name('change-email');
    Route::get('account/management/settings/change-password.html', 'UserController@changePassword');
    Route::post('account/management/settings/change-password.html', 'UserController@changePasswordActoin')->name('change-password');
    Route::get('account/management/wallet.html', 'UserController@showWallet')->name('wallet');
    Route::get('account/management/primary-address.html', 'UserController@showProfile')->name('primary-address');

    Route::get('account/management/claim-code.html', 'UserController@showProfile')->name('claim-code');
    Route::get('account/management/get-a-game.html', 'UserController@showProfile')->name('get-a-game');
    Route::get('account/management/download/', 'UserController@showProfile')->name('download-game');
    Route::get('account/management/beta-profile.html', 'UserController@showProfile')->name('beta-profile');

    Route::get('account/management/orders.html', 'UserController@showProfile')->name('orders');
    Route::get('account/management/transaction-history.html', 'UserController@showProfile')->name('transaction-history');
    Route::get('account/management/gift-claim-history.html', 'UserController@showProfile')->name('gift-claim-history');

    Route::get('shop/checkout/add-balance', 'UserController@showProfile')->name('add-balance');

});