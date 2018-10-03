<?php

Route::get('/', function () {
    return redirect('/'. App::getLocale() . '/');
});

Route::get('lang/{lang}/', function ($lang) {
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
Route::get('/wow/discussion/{id}/load.json', 'DiscussionController@loadComments');
Route::get('/noop', 'DiscussionController@loadNoop');
Route::post('/wow/discussion/{id}/comment.json', 'DiscussionController@commentJson');

Route::get('account/management/services/is-character-eligible', 'DiscussionController@isCharacterEligible');

Route::get('version', 'DiscussionController@version');
Route::get('navbar/notifications', 'DiscussionController@notifications');
Route::get('notification/list', 'DiscussionController@notificationsList');
Route::get('api/locales', 'DiscussionController@locales');
Route::get('api/localized-strings', 'Api\ApiController@localized');
Route::get('api/user', 'Api\ApiController@user');
Route::get('api/time/now', 'Api\ApiController@time');
Route::get('navbar', 'DiscussionController@navbar');
Route::post('account/pin/{characters}', 'DiscussionController@pin');

Route::get('forums/topic/post/{topic}/frag', 'Forum\ThreadsController@frag');
Route::post('forums/topic/post/{topic}/edit', 'Forum\ThreadsController@edit');
Route::post('forums/topic/post/{topic}/up', 'Forum\ThreadsController@up');
Route::post('forums/topic/post/{topic}/down', 'Forum\ThreadsController@down');
Route::post('forums/topic/post/{topic}/delete', 'Forum\ThreadsController@delete');
//Route::delete('forums/{channel}/topic/{thread}', 'Forum\ThreadsController@destroy');

Route::group(['prefix' => App\Http\Middleware\LocaleMiddleware::getLocales()], function(){
    if ( App\Services\Helpers::getSiteMaintenanceStatus() ) {
        Route::get('/', 'HomeController@offline')->name('home');
    } else {
        /// Auth route
        Auth::routes();
        Route::get('logout','Auth\LoginController@logout');
        Route::get('/register/confirm', 'Auth\RegisterConfirmationController@index')->name('register.confirm');
        // Password Reset Routes...
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password-reset');
        /// Auth route end
        Route::get('/', 'HomeController@index')->name('home');

        Route::get('/bugtracker', 'BugtrackerController@index')->name('bugtracker');
        //// Blog route
        Route::resource('news', 'BlogController', ['parameters' => ['id' => 'id']]);
        Route::get('news.frag', 'BlogController@frag');

        //// Shop route
        Route::get('shop/family/world-of-warcraft', 'ShopController@index')->name('shop');
        Route::get('shop/product/world-of-warcraft-{name}', 'ShopController@view')->name('shop.item');
        Route::get('shop/buy-{name}', 'ShopController@buy')->name('shop.buy');
        Route::post('shop/complete-{name}', 'ShopController@store')->name('shop.complete');
        Route::get('shop/complete-{name}', 'ShopController@buyComplete')->name('shop.buyComplete');
        Route::get('shop/checkout/add-balance', 'ShopController@addBalance')->name('add-balance');
        Route::post('shop/checkout/pay', 'ShopController@payBalanceAction')->name('pay-balanceAction');
        Route::get('shop/checkout/pay', 'ShopController@payBalance')->name('pay-balance');
        Route::get('shop/checkout/paypal', 'ShopController@payPaypal')->name('pay-paypal');

        /// Forum route
        Route::get('forums/patch-notes', 'Forum\HomeController@patchNotes')->name('patch-notes');
        Route::get('forums', 'Forum\HomeController@index')->name('forums');
        Route::get('forums/create', 'Forum\ThreadsController@create');
        Route::get('forums/search', 'Forum\SearchController@show');
        Route::get('forums/{category}', 'Forum\HomeController@show')->name('forum')->where('category', '[0-9]+');
        Route::get('forums/topic/{thread}', 'Forum\ThreadsController@show')->name('forum.topic');
        Route::patch('forums/{channel}/topic/{thread}', 'Forum\ThreadsController@update');
        Route::delete('forums/{channel}/topic/{thread}', 'Forum\ThreadsController@destroy');
        Route::post('forums/{category}/create', 'Forum\ThreadsController@store')->name('forum.topic.store')->middleware('must-be-confirmed');
        Route::get('forums/{channel}', 'Forum\ThreadsController@index')->name('forum');
        Route::get('forums/search', 'Forum\SearchController@search')->name('forum.search');
        Route::post('locked-threads/{thread}', 'Forum\LockedThreadsController@store')->name('locked-threads.store')->middleware('admin');
        Route::delete('locked-threads/{thread}', 'Forum\LockedThreadsController@destroy')->name('locked-threads.destroy')->middleware('admin');

        Route::get('/forums/{channel}/{thread}/replies', 'Forum\RepliesController@index');
        Route::post('/forums/replies/{thread}', 'Forum\RepliesController@store')->name('forum.topic.reply.create');
        Route::patch('/replies/{reply}', 'Forum\RepliesController@update');
        Route::delete('/replies/{reply}', 'Forum\RepliesController@destroy')->name('replies.destroy');

        Route::post('/replies/{reply}/best', 'Forum\BestRepliesController@store')->name('best-replies.store');

        Route::post('/forums/{channel}/{thread}/subscriptions', 'Forum\ThreadSubscriptionsController@store')->middleware('auth');
        Route::delete('/forums/{channel}/{thread}/subscriptions', 'Forum\ThreadSubscriptionsController@destroy')->middleware('auth');

        Route::post('/replies/{reply}/favorites', 'Forum\FavoritesController@store');
        Route::delete('/replies/{reply}/favorites', 'Forum\FavoritesController@destroy');

        /// Account route
        Route::get('account/management/invite.html', 'InviteController@invite')->name('invite');
        Route::post('account/management/invite-send.html', 'InviteController@process')->name('process');
        Route::get('account/management/invite-register.html', 'InviteController@accept')->name('accept');

        Route::get('account/management/test-level', 'UserController@levelup')->name('test-level');
        Route::get('account/management', 'UserController@showProfile')->name('account');
        Route::get('account/management/settings/change-email.html', 'UserController@changeEmail');
        Route::post('account/management/settings/change-email.html', 'UserController@changeEmailActoin')->name('change-email');

        Route::get('account/management/settings/change-password.html', 'UserController@changePassword');
        Route::post('account/management/settings/change-password.html', 'UserController@changePasswordActoin')->name('change-password');

        Route::get('account/management/tag-name-change.html', 'UserController@tagNameChange');
        Route::post('account/management/tag-name-change.html', 'UserController@tagNameChangeActoin')->name('tag-name-change');
        Route::get('account/management/tag-name-create', 'UserController@createName')->name('create-name');
        Route::post('account/management/tag-name-create', 'UserController@createNameAction')->name('create-name-action');

        Route::get('account/management/wallet.html', 'UserController@showWallet')->name('wallet');
        Route::get('account/management/primary-address.html', 'UserController@showProfile')->name('primary-address');
        Route::get('account/management/wow/dashboard.html', 'UserController@dashboard')->name('dashboard');

        Route::get('account/management/claim-code.html', 'UserController@claimCode')->name('claim-code');
        Route::get('account/management/claim-code-item.html', 'UserController@claimCodeSendAction')->name('claim-code-send');
        Route::get('account/management/claim-code-level.html', 'UserController@claimCodeLevelAction')->name('claim-code-level');
        Route::post('account/management/claim-code.html', 'UserController@claimCodeAction')->name('claim-code-action');

        Route::get('account/management/get-a-game.html', 'UserController@showProfile')->name('get-a-game');
        Route::get('account/management/download/', 'UserController@showProfile')->name('download-game');
        Route::get('account/management/beta-profile.html', 'UserController@showProfile')->name('beta-profile');

        Route::get('account/management/vote.html', 'UserController@vote')->name('vote');
        Route::get('account/management/vote-action.html', 'UserController@voteAction')->name('vote-action');

        Route::get('account/management/orders.html', 'UserController@showOrders')->name('orders');
        Route::get('account/management/transaction-history.html', 'UserController@showProfile')->name('transaction-history');
        Route::get('account/management/gift-claim-history.html', 'UserController@showProfile')->name('gift-claim-history');

        Route::get('account/management/invite-history.html', 'UserController@showInvite')->name('invite-history');
        Route::get('account/management/invite-bonus.html', 'UserController@inviteSelectCharacters')->name('invite-select-characters');
        Route::get('account/management/invite-bonus-send.html', 'UserController@inviteAction')->name('invite-send');

        Route::get('game/status', 'CommunityController@CommunityStatus')->name('community-status');
        Route::get('start', 'CommunityController@CommunityStart')->name('community-start');
        Route::get('return', 'CommunityController@CommunityReturn')->name('community-return');

        Route::get('characters/elisgrimm/{characters}', 'CharactersController@characters')->name('characters');
        Route::get('profiles/{user}', 'ProfilesController@show')->name('profiles');
        Route::get('profiles/{user}/activity', 'ProfilesController@activity')->name('profiles-activity');
        Route::get('characters/elisgrimm/{characters}/achievements', 'CharactersController@charactersAchi')->name('achievements');
        Route::get('characters/elisgrimm/{characters}/collections', 'CharactersController@characters')->name('collections');
        Route::get('characters/elisgrimm/{characters}/pve', 'CharactersController@characters')->name('characters-pve');
        Route::get('characters/elisgrimm/{characters}/reputation', 'CharactersController@characters')->name('reputation');
        Route::get('characters/elisgrimm/{characters}/pvp', 'CharactersController@charactersPvp')->name('characters-pvp');
        Route::get('characters', 'CharactersController@list')->name('characters-list');

        Route::get('game/pvp/leaderboards/2v2', 'CommunityController@leaderboardsTwo')->name('pvp-2v2');
        Route::get('game/pvp/leaderboards/3v3', 'CommunityController@leaderboardsTree')->name('pvp-3v3');
        Route::get('game/pvp/leaderboards/battlegrounds', 'CommunityController@battlegrounds')->name('pvp-battlegrounds');

        Route::get('game/recruit-a-friend', 'CommunityController@recruitAFriend')->name('recruitAFriend');
    }
});

///// ADMIN /////
Route::group(['middleware' => ['auth', 'admin']], function(){
    Route::get('/admin','Admin\AdminController@index')->name('admin-home');
    Route::get('/admin/news/list','Admin\NewsController@list')->name('admin-news-list');
    Route::get('/admin/news/edit/{id}','Admin\NewsController@edit')->name('admin-news-edit');
    Route::post('/admin/news/save','Admin\NewsController@save')->name('admin-news-save');
    Route::get('/admin/news/delete/{id}','Admin\NewsController@delete')->name('admin-news-delete');
    Route::get('/admin/news/create','Admin\NewsController@create')->name('admin-news-add');
    Route::post('/admin/news/create','Admin\NewsController@createAction');

    Route::get('/admin/shop/list','Admin\ShopController@list')->name('admin-shop-list');
    Route::get('/admin/shop/edit/{id}','Admin\ShopController@edit')->name('admin-shop-edit');
    Route::post('/admin/shop/save','Admin\ShopController@save')->name('admin-shop-save');
    Route::get('/admin/shop/delete/{id}','Admin\ShopController@delete')->name('admin-shop-delete');
    Route::get('/admin/shop/create','Admin\ShopController@create')->name('admin-shop-add');
    Route::post('/admin/shop/create','Admin\ShopController@createAction');

    Route::get('/admin/forum/list','Admin\ForumController@list')->name('admin-forum-list');
    Route::get('/admin/forum/edit/{id}','Admin\ForumController@edit')->name('admin-forum-edit');
    Route::post('/admin/forum/save','Admin\ForumController@save')->name('admin-forum-save');
    Route::get('/admin/forum/delete/{id}','Admin\ForumController@delete')->name('admin-forum-delete');
    Route::get('/admin/forum/create','Admin\ForumController@create')->name('admin-forum-add');
    Route::post('/admin/forum/create','Admin\ForumController@createAction');

    Route::get('admin/options','Admin\OptionsController@index')->name('options-index');

    Route::get('/admin/clearcache', function() {
        Cache::flush();
        return "The script cache is successfully cleared.";
    });
});