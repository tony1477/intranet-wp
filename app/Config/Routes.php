<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function(){
    $data = [
        'title_meta' => view('partials/title-meta', ['title' => 'Error_404'])
    ];
    return view('pages-404',$data);
});
$routes->setAutoRoute(true);


$routes->group('', ['namespace' => 'App\Controllers'], static function ($routes) {
    
    // Login/out
    $routes->get('login', 'AuthController::login', ['as' => 'login']);
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('logout', 'AuthController::logout');

    // Registration
    $routes->get('register', 'AuthController::register', ['as' => 'register']);
    $routes->post('register', 'AuthController::attemptRegister');

    // Reset Password
    $routes->get('forgot', 'AuthController::forgotPassword', ['as' => 'forgot']);
    $routes->post('forgot', 'AuthController::attemptForgot');
});

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
$routes->get('index-dark', 'Home::show_index_dark');
$routes->get('index-rtl', 'Home::show_index_rtl');
$routes->get('layouts-boxed', 'Home::show_layouts_boxed');
$routes->get('layouts-colored-sidebar', 'Home::show_colored_sidebar');
$routes->get('layouts-compact-sidebar', 'Home::show_compact_sidebar');
$routes->get('layouts-dark-sidebar', 'Home::show_dark_sidebar');
$routes->get('layouts-icon-sidebar', 'Home::show_icon_sidebar');
$routes->get('layouts-scrollable', 'Home::show_layouts_scrollable');


//Multi-language functionality 
$routes->get('/lang/{locale}', 'Language::index');

// //Layout section routing
$routes->get('layouts-horizontal', 'Home::show_layouts_horizontal');
$routes->get('layouts-horizontal-boxed', 'Home::show_layouts_horizontal_boxed');
$routes->get('layouts-horizontal-dark', 'Home::show_layouts_horizontal_dark');
$routes->get('layouts-horizontal-rtl', 'Home::show_layouts_horizontal_rtl');
$routes->get('layouts-horizontal-scrollable', 'Home::show_layouts_horizontal_scrollable');
$routes->get('layouts-horizontal-dark-topbar', 'Home::show_layouts_dark_topbar');


// //App section routing
$routes->get('apps-calendar', 'Home::show_calendar');

$routes->get('apps-chat', 'Home::show_chat');

$routes->get('apps-email-inbox', 'Home::show_email_inbox');
$routes->get('apps-email-read', 'Home::show_email_read');

$routes->get('apps-invoices-list', 'Home::show_invoices_list');
$routes->get('apps-invoices-detail', 'Home::show_invoices_detail');

$routes->get('apps-contacts-grid', 'Home::show_contacts_grid');
$routes->get('apps-contacts-list', 'Home::show_contacts_list');
$routes->get('apps-contacts-profile', 'Home::show_contacts_profile');

// Pages
$routes->get('auth-login', 'Home::show_auth_login');
$routes->get('auth-register', 'Home::show_auth_register');
$routes->get('auth-recoverpw', 'Home::show_auth_recoverpw');
$routes->get('auth-lock-screen', 'Home::show_auth_lock_screen');
$routes->get('auth-confirm-mail', 'Home::show_auth_confirm_mail');
$routes->get('auth-email-verification', 'Home::show_auth_email_verification');
$routes->get('auth-two-step-verification', 'Home::show_auth_two_step_verification');


$routes->get('pages-starter', 'Home::show_pages_starter');
$routes->get('pages-invoice', 'Home::show_pages_invoice');
$routes->get('pages-profile', 'Home::show_pages_profile');
$routes->get('pages-maintenance', 'Home::show_pages_maintenance');
$routes->get('pages-comingsoon', 'Home::show_pages_comingsoon');
$routes->get('pages-timeline', 'Home::show_pages_timeline');
$routes->get('pages-faqs', 'Home::show_pages_faqs');
$routes->get('pages-pricing', 'Home::show_pages_pricing');
$routes->get('pages-404', 'Home::show_pages_404');
$routes->get('pages-500', 'Home::show_pages_500');

// UI Elements
$routes->get('ui-alerts', 'Home::show_ui_alerts');
$routes->get('ui-buttons', 'Home::show_ui_buttons');
$routes->get('ui-cards', 'Home::show_ui_cards');
$routes->get('ui-carousel', 'Home::show_ui_carousel');
$routes->get('ui-dropdowns', 'Home::show_ui_dropdowns');
$routes->get('ui-grid', 'Home::show_ui_grid');
$routes->get('ui-images', 'Home::show_ui_images');
$routes->get('ui-modals', 'Home::show_ui_modals');
$routes->get('ui-progressbars', 'Home::show_ui_progressbars');
$routes->get('ui-tabs-accordions', 'Home::show_ui_tabs_accordions');
$routes->get('ui-typography', 'Home::show_ui_typography');
$routes->get('ui-video', 'Home::show_ui_video');
$routes->get('ui-general', 'Home::show_ui_general');
$routes->get('ui-colors', 'Home::show_ui_colors');
$routes->get('ui-offcanvas', 'Home::show_ui_offcanvas');

//Extended
$routes->get('extended-lightbox', 'Home::show_extended_lightbox');
$routes->get('extended-rangeslider', 'Home::show_extended_rangeslider');
$routes->get('extended-session-timeout', 'Home::show_extended_session_timeout');
$routes->get('extended-sweet-alert', 'Home::show_extended_sweet_alert');
$routes->get('extended-rating', 'Home::show_extended_rating');
$routes->get('extended-notifications', 'Home::show_extended_notification');

// Forms
$routes->get('form-elements', 'Home::show_form_elements');
$routes->get('form-validation', 'Home::show_form_validation');
$routes->get('form-advanced', 'Home::show_form_advanced');
$routes->get('form-editors', 'Home::show_form_editors');
$routes->get('form-uploads', 'Home::show_form_uploads');
$routes->get('form-xeditable', 'Home::show_form_xeditable');
$routes->get('form-repeater', 'Home::show_form_repeater');
$routes->get('form-wizard', 'Home::show_form_wizard');
$routes->get('form-mask', 'Home::show_form_mask');

// Tables
$routes->get('tables-basic', 'Home::show_tables_basic');
$routes->get('tables-datatable', 'Home::show_tables_datatable');
$routes->get('tables-responsive', 'Home::show_tables_responsive');
$routes->get('tables-editable', 'Home::show_tables_editable');

// Charts
$routes->get('charts-apex', 'Home::show_charts_apex');
$routes->get('charts-chartjs', 'Home::show_charts_chartjs');
$routes->get('charts-echart', 'Home::show_charts_echart');
$routes->get('charts-knob', 'Home::show_charts_knob');
$routes->get('charts-sparkline', 'Home::show_charts_sparkline');

// Icons
$routes->get('icons-boxicons', 'Home::show_icons_boxicons');
$routes->get('icons-materialdesign', 'Home::show_icons_materialdesign');
$routes->get('icons-dripicons', 'Home::show_icons_dripicons');
$routes->get('icons-fontawesome', 'Home::show_icons_fontawesome');

// Maps
$routes->get('maps-google', 'Home::show_maps_google');
$routes->get('maps-vector', 'Home::show_maps_vector');
$routes->get('maps-leaflet', 'Home::show_maps_leaflet');

// INTRA

// Login & Logout
// $routes->get('login','Home::login');


// Register
// $routes->get('register','Home::register');

## GroupDivisi
$routes->get('group-divisi', 'Master/Grupdivisi::index', ['filter' => 'permission:master-data']);
$routes->post('group-divisi/delete', 'Master/Grupdivisi::delete', ['filter' => 'permission:master-data']);
$routes->post('group-divisi/post', 'Master/Grupdivisi::save', ['filter' => 'permission:master-data']);

## Divisi
$routes->get('divisi', 'Master/Divisi::index', ['filter' => 'permission:master-data']);
$routes->post('divisi/delete', 'Master/Divisi::delete', ['filter' => 'permission:master-data']);
$routes->post('divisi/post', 'Master/Divisi::save', ['filter' => 'permission:master-data']);
$routes->get('divisi/getData','Master/Divisi::getData');
$routes->get('api/getDivisi','Api/CommonApi::getDivisi');
$routes->get('api/getDepartment','Api/CommonApi::getDepartment');
$routes->get('api/getJabatan','Api/CommonApi::getJabatan');
$routes->get('api/getDepartment/(:num)','Api\CommonApi::getDepartment/$1');
$routes->get('api/getKaryawan','Api\CommonApi::getKaryawan');
$routes->get('api/getKaryawanwithExt','Api\CommonApi::getKaryawanwithExt');
$routes->get('api/getInfoKaryawanbyId/(:num)','Api\CommonApi::getInfoKaryawanbyId/$1');
$routes->get('api/getInfoKaryawanbyIdName/(:segment)/(:num)','Api\CommonApi::getInfoKaryawanbyIdName/$1/$2');

## Department
$routes->get('department', 'Master/Department::index', ['filter' => 'permission:master-data']);
$routes->post('department/delete', 'Master/Department::delete', ['filter' => 'permission:master-data']);
$routes->post('department/post', 'Master/Department::save', ['filter' => 'permission:master-data']);

## Struktur
$routes->get('struktur-organisasi', 'Master/Bpo/Strukturorg::index');
$routes->post('struktur-organisasi/delete', 'Master/Bpo/Strukturorg::delete');
$routes->post('struktur-organisasi/post', 'Master/Bpo/Strukturorg::save');
$routes->get('struktur-organisasi/display', 'Master/Bpo/Strukturorg::display');
$routes->get('struktur-organisasi/getDoc/(:segment)', 'Master\Bpo\Strukturorg::getDoc/$1');
$routes->add('struktur-organisasi/view/(:any)', 'Master\Bpo\Strukturorg::view/$1');
// $routes->add('struktur-organisasi/viewbyfile/(:any)', 'Master\Bpo\Strukturorg::viewbyfile/$1');
// $routes->post('struktur-organisasi/uploadfile', 'Master/Bpo/Strukturorg::uploadfile');
$routes->add('struktur-organisasi/tes', 'Master/Bpo/Strukturorg::tes');
$routes->add('struktur-organisasi/upload', 'Master/Bpo/Strukturorg::upload');
$routes->add('visi-misi/display', 'Master/Bpo/Strukturorg::visimisi');
## Kategory
$routes->get('kategory', 'Master/Bpo/Kategory::index');
$routes->post('kategory/delete', 'Master/Bpo/Kategory::delete');
$routes->post('kategory/post', 'Master/Bpo/Kategory::save');

## Dokumen
$routes->get('dokumen-sop', 'Master/Bpo/Dokumen::index');
$routes->post('dokumen-sop/delete', 'Master/Bpo/Dokumen::delete');
$routes->post('dokumen-sop/post', 'Master/Bpo/Dokumen::save');
$routes->post('dokumen-sop/postUser', 'Master/Bpo/Dokumen::saveUserByDoc');
// $routes->get('dokumen-sop/userbydokumen', 'Master/Bpo/Dokumen::userbydoc');
$routes->post('dokumen-sop/userbydoc', 'Master/Bpo/Dokumen::userbydoc');
// $routes->get('dokumen-sop/dokumenbyuser', 'Master/Bpo/Dokumen::docbyuser');
$routes->post('dokumen/uploadfile/(:any)', 'Home::uploadfile/$1');
$routes->get('dokumen/([a-z\-]+)/viewbyfile/(:any)','Home::viewbyfile/$1/$2/$3');

## Position
$routes->get('jabatan', 'Master/Position::index',['filter' => 'permission:master-data']);
$routes->post('jabatan/delete', 'Master/Position::delete', ['filter' => 'permission:master-data']);
$routes->post('jabatan/post', 'Master/Position::save', ['filter' => 'permission:master-data']);

## GroupUser
$routes->get('user-group', 'Master/GroupUser::index', ['filter' => 'permission:master-data']);
$routes->post('user-group/delete', 'Master/GroupUser::delete', ['filter' => 'permission:master-data']);
$routes->post('user-group/post', 'Master/GroupUser::save', ['filter' => 'permission:master-data']);

## User
$routes->get('users', 'Master/Users::index');
$routes->post('users/delete', 'Master/Users::delete');
$routes->post('users/post', 'Master/Users::save');
$routes->post('users/activated', 'Master/Users::activate');
$routes->post('users/docbyuser', 'Master/Users::docbyuser');
$routes->post('users/postDoc', 'Master/Users::saveDocByUser');
$routes->post('users/uploadimage', 'Master/Users::uploadImage');
$routes->get('([a-zA-z0-9\-]+)/profile', 'Master\Users::getProfile/$1');
$routes->post('profile/update','Master/Users::updateProfile');

## Meeting Room
$routes->get('room-meeting','Meeting/MeetingRoom::index');
$routes->get('room-meeting/detail/:any','Meeting/MeetingRoom::detail');

## Meeting Schedule
$routes->get('meeting-schedule','Meeting/MeetingSchedule::index');
$routes->get('meeting-schedule/booking','Meeting/MeetingSchedule::booking');
$routes->post('meeting-schedule/booking/request','Meeting/MeetingSchedule::requestRoom');
$routes->get('meeting-schedule/booking/:any','Meeting/MeetingSchedule::booking');
$routes->get('meeting-schedule/detail/:num','Meeting/MeetingSchedule::detail');
$routes->get('meeting-schedule/(:num)','Meeting\MeetingSchedule::getdata/$1');
$routes->post('meeting-schedule/sendmeeting','Meeting/MeetingSchedule::SendMeeting');
$routes->get('meeting-schedule/edit/(:num)','Meeting/MeetingSchedule::edit');
$routes->get('meeting-schedule/([a-z]+)/(:num)','Meeting\MeetingSchedule::action/$1/$2');
$routes->get('meeting-schedule/email','Meeting/MeetingSchedule::emailservice');
$routes->get('meeting-schedule/approveMeeting/(:num)','Meeting\MeetingSchedule::ApproveMeeting/$1');
$routes->get('meeting-schedule/:any','Meeting/MeetingSchedule::schedule');


## Notulen Meeting
$routes->get('notulen','Meeting/NotulenMeeting::index');
$routes->get('notulens','Meeting/NotulenMeeting::getdata');
$routes->post('notulen','Meeting/NotulenMeeting::postdata');
$routes->put('notulen/(:num)','Meeting\NotulenMeeting::updatedata/$1');
/* Detail */
$routes->get('notulen/(:num)/notes','Meeting\NotulenMeeting::getDetails/$1');
$routes->post('notulen/(:num)/notes','Meeting\NotulenMeeting::postDetail/$1');
$routes->put('notulen/(:num)/notes/(:num)','Meeting\NotulenMeeting::updateDetail/$1/$2');
$routes->delete('notulen/(:num)/notes/(:num)','Meeting\NotulenMeeting::purgeDetail/$1/$2');
$routes->get('notulen/feedback/(:num)','Meeting\NotulenMeeting::getFeedback/$1');
$routes->patch('notulen/feedback/(:num)','Meeting\NotulenMeeting::updateFeedback/$1');
/* Approve and Reject use PUT and DELETE instead of VERB
    and add request in the end of segment URI
*/
$routes->put('notulen/(:num)/request','Meeting\NotulenMeeting::approve/$1');
$routes->delete('notulen/(:num)/request','Meeting\NotulenMeeting::delete/$1');

$routes->get('notulen/print/(:num)','Meeting\NotulenMeeting::print/$1');

## BPO - USER
$routes->get('bpo/kebijakan','Bpo/Support::kebijakan');
$routes->get('bpo/manual','Bpo/Support::manual');
$routes->get('bpo/sop','Bpo/Support::sop');
$routes->get('bpo/intruksi-kerja','Bpo/Support::intruksikerja');
$routes->get('bpo/lainnya','Bpo/Support::lainnya');
$routes->get('bpo/([a-z\-]+)/viewpdf/(:any)','Bpo\Support::viewpdf/$1/$2');
$routes->get('bpo/([a-z\-]+)/downloadform/(:any)','Bpo\Support::downloadform/$1/$2/$3');
// $routes->get('bpo/([a-z\-]+)/viewpdf/(:any)','Bpo/Master::viewpdf/$1');

## Gallery
$routes->get('gallery-foto','Company/Gallery::GalleryFoto');
$routes->get('gallery-video','Company/Gallery::galleryvideo');
$routes->get('gallery-foto/open-album/(:num)','Company\Gallery::foto/$1');
$routes->get('album/category','Company/Gallery::manageAlbum');
$routes->get('album/foto','Company/Gallery::manageFoto');
$routes->post('gallery-foto/manage-album/post','Company/Gallery::postAlbum');
$routes->post('gallery-foto/manage-foto/post', 'Company/Gallery::postFoto');
$routes->post('gallery-foto/manage-video/post', 'Company/Gallery::postVideo');
$routes->post('([a-z]+)/uploadfile/gallery-foto/manage-foto', 'Company\Gallery::uploadfile/$1');
$routes->post('gallery-foto/manage-foto/upload_image','Company/Gallery::uploadfile');
$routes->post('gallery-foto/manage-foto/delete','Company/Gallery::deleteFoto');
$routes->post('gallery-foto/manage-album/delete','Company/Gallery::deleteAlbum');
$routes->post('gallery-foto/manage-video/delete','Company/Gallery::deleteVideo');
$routes->get('album/video','Company/Gallery::manageVideo');
$routes->post('gallery-foto/manage-video/upload_sampul','Company/Gallery::uploadCover');

## Article
$routes->get('articles','Company/Article::index');
$routes->get('article/atur-berita','Company/Article::ManageArticle');
$routes->post('article/upload_file','Company/Article::UploadFile');
$routes->post('article/post','Company/Article::postArticle');
$routes->get('article/atur-kategori','Company/Article::categories');
$routes->post('article/category/post','Company/Article::postCategories');
$routes->get('article/atur-pojok-wp','Company/Article::ManagePojokBerita');
$routes->post('article/pojok-wp/post','Company/Article::postPojokBerita');
$routes->post('article/addemailsubs','Company/Article::addEmailSubs');
$routes->get('pojok-wp','Company/Article::PojokWP');
$routes->get('pojok-wp/read/(:segment)/(:segment)','Company\Article::readPojokWP/$1/$2');
$routes->get('article/getData/(:num)','Company\Article::getData/$1');
$routes->get('article/getCommentbyArticle/(:num)','Company\Article::getCommentbyArticle/$1');
$routes->post('article/upload_image','Company/Article::uploadImg');
$routes->post('article/pojok-wp/upload_image','Company/Article::uploadImg');
$routes->post('article/postComment','Company/Article::postComment');
$routes->get('article/read/(:num)/','Company\Article::readArticlebyId/$1');
$routes->get('article/read/(:segment)/(:segment)','Company\Article::readArticle/$1/$2');
$routes->get('article/search','Company/Article::search');
$routes->get('article/(:segment)','Company\Article::Category/$1');
$routes->post('article/sendsubs','Company/Article::sendSubs');
$routes->get('mailsubs','Master/Mailsubs::index');
$routes->post('mailsubs/post','Master/Mailsubs::save');
$routes->get('mailsubs/email','Master/Mailsubs::email');

## Helpdesk
// $routes->get('list-helpdesk','Helpdesk/Ticketing::index');
$routes->get('helpdesk/getfirst','Helpdesk/Ticketing::getFirstCategory');
$routes->get('list-helpdesk','Helpdesk/Ticketing::listHelpdesk');
$routes->get('create-helpdesk','Helpdesk/Ticketing::create');
$routes->post('create-helpdesk/user/(:alpha)/form','Helpdesk\Ticketing::form/$1');
$routes->post('helpdesk/nextquestion','Helpdesk/Ticketing::nextquestion');
$routes->post('helpdesk/prevquestion','Helpdesk/Ticketing::prevquestion');
$routes->post('helpdesk/list-ticket/(:alpha)','Helpdesk\Ticketing::listTicket/$1');
$routes->post('approve-helpdesk','Helpdesk\Ticketing::approveTicket');
$routes->post('reject-helpdesk','Helpdesk\Ticketing::rejectTicket');
$routes->post('confirm-helpdesk','Helpdesk\Ticketing::confirmTicket');
$routes->post('feedback-helpdesk','Helpdesk\Ticketing::feedbackTicket');
$routes->get('edit-helpdesk/(:num)','Helpdesk\Ticketing::editTicket/$1');
$routes->get('resp-helpdesk','Helpdesk/Response::index');
$routes->post('list-resp/(:alpha)','Helpdesk\Response::listResponse/$1');
$routes->get('resp-helpdesk/detail/(:num)','Helpdesk\Response::detailResponse/$1');
$routes->post('resp-helpdesk/submit/(:alpha)','Helpdesk\Response::submitForm/$1');
$routes->post('resp-helpdesk/approve-helpdesk','Helpdesk\Response::approveHelpdesk');
$routes->post('resp-helpdesk/dohelpdesk','Helpdesk\Response::doHelpdesk');
$routes->post('resp-helpdesk/reject-helpdesk','Helpdesk\Response::rejectHelpdesk');
// $routes->post('edit-helpdesk','Helpdesk\Ticketing::editTicket');
// $routes->get('create-helpdesk/user/(:alpha)/(:segment)','Helpdesk\Ticketing::form/$1/$2');

## Auth
$routes->get('auth/workflow','Master/Auth/Workflow::index');
$routes->post('auth/workflow/delete', 'Master/Auth/Workflow::delete', ['filter' => 'permission:master-data']);
$routes->post('auth/workflow/post', 'Master/Auth/Workflow::save', ['filter' => 'permission:master-data']);
$routes->get('auth/wfgroup','Master/Auth/Wfgroup::index');
$routes->post('auth/wfgroup/delete', 'Master/Auth/Wfgroup::delete', ['filter' => 'permission:master-data']);
$routes->post('auth/wfgroup/post', 'Master/Auth/Wfgroup::save', ['filter' => 'permission:master-data']);
$routes->get('auth/wfstatus','Master/Auth/Wfstatus::index');
$routes->post('auth/wfstatus/delete', 'Master/Auth/Wfstatus::delete', ['filter' => 'permission:master-data']);
$routes->post('auth/wfstatus/post', 'Master/Auth/Wfstatus::save', ['filter' => 'permission:master-data']);
$routes->get('auth/wfstructure','Master/Auth/Wfstructure::index');
$routes->post('auth/wfstructure/delete', 'Master/Auth/Wfstructure::delete', ['filter' => 'permission:master-data']);
$routes->post('auth/wfstructure/post', 'Master/Auth/Wfstructure::save', ['filter' => 'permission:master-data']);

## External Participant
$routes->get('ext-participant', 'Meeting/Extparticipant::index',['filter' => 'permission:master-data']);
$routes->post('ext-participant/delete', 'Meeting/Extparticipant::delete', ['filter' => 'permission:master-data']);
$routes->post('ext-participant/post', 'Meeting/Extparticipant::save', ['filter' => 'permission:master-data']);

## Employee
$routes->get('employee/points','Company/Employee::showPoints');
$routes->get('employee/point/(:num)','Company\Employee::getPoint/$1');
$routes->get('employee/point/(:num)/detail','Company\Employee::getDetailPoint/$1');

## Notif
$routes->get('notification','NotificationController::index');
$routes->post('notification/post','NotificationController::save');
$routes->post('notification/send','NotificationController::sendNotif');
$routes->get('notification/user','NotificationController::getNotifData');
$routes->get('notification/user/total','NotificationController::getNotifNumber');
$routes->get('notification/view','NotificationController::notifPage');
$routes->get('notification/view/(:num)','NotificationController::viewNotif/$1');

## Website
$routes->get('tentang/profil','Website/About/Profile::index');
$routes->post('tentang/profil/post', 'Website/About/Profile::save');
$routes->post('tentang/profil/delete', 'Website/About/Profile::delete');

$routes->get('tentang/strategi','Website/About/Strategi::index');
$routes->post('tentang/strategi/post', 'Website/About/Strategi::save');
$routes->post('tentang/strategi/delete', 'Website/About/Strategi::delete');

$routes->get('tentang/manajemen','Website/About/Manajemen::index');
$routes->post('tentang/manajemen/post', 'Website/About/Manajemen::save');
$routes->post('tentang/manajemen/delete', 'Website/About/Manajemen::delete');

$routes->get('bisnis/kebun','Website/Business/Kebun::index');
$routes->post('bisnis/kebun/post', 'Website/Business/Kebun::save');
$routes->post('bisnis/kebun/delete', 'Website/Business/Kebun::delete');

$routes->get('bisnis/pabrik','Website/Business/Pabrik::index');
$routes->post('bisnis/pabrik/post', 'Website/Business/Pabrik::save');
$routes->post('bisnis/pabrik/delete', 'Website/Business/Pabrik::delete');

$routes->get('bisnis/trading','Website/Business/Trading::index');
$routes->post('bisnis/trading/post', 'Website/Business/Trading::save');
$routes->post('bisnis/trading/delete', 'Website/Business/Trading::delete');

$routes->get('bisnis/fnb','Website/Business/Fnb::index');
$routes->post('bisnis/fnb/post', 'Website/Business/Fnb::save');
$routes->post('bisnis/fnb/delete', 'Website/Business/Fnb::delete');

$routes->get('keberlanjutan/kebijakan','Website/Sustainability/Policy::index');
$routes->post('keberlanjutan/kebijakan/post', 'Website/Sustainability/Policy::save');
$routes->post('keberlanjutan/kebijakan/delete', 'Website/Sustainability/Policy::delete');

$routes->get('keberlanjutan/sertifikasi','Website/Sustainability/Certification::index');
$routes->post('keberlanjutan/sertifikasi/post', 'Website/Sustainability/Certification::save');
$routes->post('keberlanjutan/sertifikasi/delete', 'Website/Sustainability/Certification::delete');

$routes->get('keberlanjutan/lingkungan','Website/Sustainability/Environment::index');
$routes->post('keberlanjutan/lingkungan/post', 'Website/Sustainability/Environment::save');
$routes->post('keberlanjutan/lingkungan/delete', 'Website/Sustainability/Environment::delete');

$routes->get('keberlanjutan/csr','Website/Sustainability/Csr::index');
$routes->post('keberlanjutan/csr/post', 'Website/Sustainability/Csr::save');
$routes->post('keberlanjutan/csr/delete', 'Website/Sustainability/Csr::delete');

$routes->get('keberlanjutan/osh','Website/Sustainability/Osh::index');
$routes->post('keberlanjutan/osh/post', 'Website/Sustainability/Osh::save');
$routes->post('keberlanjutan/osh/delete', 'Website/Sustainability/Osh::delete');


$routes->get('informasi/karir','Website/Info/Career::index');
$routes->post('informasi/karir/post', 'Website/Info/Career::save');
$routes->post('informasi/karir/delete', 'Website/Info/Career::delete');

$routes->get('informasi/lokasi','Website/Info/Location::index');
$routes->post('informasi/lokasi/post', 'Website/Info/Location::save');
$routes->post('informasi/lokasi/delete', 'Website/Info/Location::delete');
// RESOURCE
//$routes->resource('grupdivisi', ['controller' => 'Api\Grupdivisi']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
