<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push(trans('backend.sidbarnav.home'), route('admin.home'));
});

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.dashboard'), route('admin.home'));
});

// User List
Breadcrumbs::for('users', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminUserList'), route('users'));
});

// Single User Details
Breadcrumbs::for('userdetail', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminUserList'), route('users'));
	$trail->push(trans('backend.sidbarnav.show'), route('users'));
});

// create new user
Breadcrumbs::for('createuser', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminUserList'), route('users'));
	$trail->push(trans('backend.sidbarnav.create'));
});

// edit new user
Breadcrumbs::for('edituser', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminUserList'), route('users'));
	$trail->push(trans('backend.sidbarnav.edit'));
});


// pages List
Breadcrumbs::for('pages', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminPagesList'), route('pages.index')); 
});

// create new pages
Breadcrumbs::for('createpages', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminPagesList'), route('pages.index'));
	$trail->push(trans('backend.sidbarnav.create'));
});


// edit new page
Breadcrumbs::for('editepages', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminPagesList'), route('pages.index'));
	$trail->push(trans('backend.sidbarnav.edit'));
});

//show menus
Breadcrumbs::for('menus', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminMenuList'), route('menus.index'));
});

//edit menus
Breadcrumbs::for('editmenus', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminMenuList'), route('menus.index'));
    $trail->push(trans('backend.sidbarnav.edit'));
});

//show category
Breadcrumbs::for('category', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminCetegoryList'), route('category.index'));
});

//edit category
Breadcrumbs::for('editcategory', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminCetegoryList'), route('category.index'));
    $trail->push(trans('backend.sidbarnav.edit'));
});

//create category
Breadcrumbs::for('createcategory', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminCetegoryList'), route('category.index'));
    $trail->push(trans('backend.sidbarnav.create'));
});

//show channels
Breadcrumbs::for('channels', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminChannelsList'), route('channels.index'));
});

//edit channels
Breadcrumbs::for('editchannels', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminChannelsList'), route('channels.index'));
    $trail->push(trans('backend.sidbarnav.edit'));
});

//create channels
Breadcrumbs::for('createchannels', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminChannelsList'), route('channels.index'));
    $trail->push(trans('backend.sidbarnav.create'));
});

//show genres
Breadcrumbs::for('genres', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminGenresList'), route('genres.index'));
});

//edit genres
Breadcrumbs::for('editgenres', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminGenresList'), route('genres.index'));
    $trail->push(trans('backend.sidbarnav.edit'));
});

//create genres
Breadcrumbs::for('creategenres', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminGenresList'), route('genres.index'));
    $trail->push(trans('backend.sidbarnav.create'));
});

//show videos
Breadcrumbs::for('videos', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminVideosList'), route('videos.index'));
});

//edit videos
Breadcrumbs::for('editvideos', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminVideosList'), route('videos.index'));
    $trail->push(trans('backend.sidbarnav.edit'));
});

//create videos
Breadcrumbs::for('createvideos', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminVideosList'), route('videos.index'));
    $trail->push(trans('backend.sidbarnav.create'));
});

// videos sync
Breadcrumbs::for('video-sync', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminSyncvideosList'), route('search-sync'));
    
});

//show banners
Breadcrumbs::for('banners', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminBannersList'), route('banners.index'));
});

//edit banners
Breadcrumbs::for('editbanners', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminBannersList'), route('banners.index'));
    $trail->push(trans('backend.sidbarnav.edit'));
});

//create banners
Breadcrumbs::for('createbanners', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminBannersList'), route('banners.index'));
    $trail->push(trans('backend.sidbarnav.create'));
});


//show setting
Breadcrumbs::for('setting', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminSettingsList'), route('setting-index'));
   
});

//show contacts
Breadcrumbs::for('contacts', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminContactsList'), route('contacts.index'));
   
});

//showdetail contacts
Breadcrumbs::for('contactshow', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminContactsList'), route('contacts.index'));
    $trail->push(trans('backend.sidbarnav.show'));
   
});

//show ads
Breadcrumbs::for('ads', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminAdsList'), route('ads.index'));
   
});

//edit ads
Breadcrumbs::for('editads', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminAdsList'), route('ads.index'));
    $trail->push(trans('backend.sidbarnav.edit'));
});

//create ads
Breadcrumbs::for('adscreate', function ($trail) {
	$trail->parent('home');
    $trail->push(trans('backend.sidbarnav.adminAdsList'), route('ads.index'));
    $trail->push(trans('backend.sidbarnav.create'));
});