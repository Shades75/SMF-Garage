<?php
/**********************************************************************************
* GarageManagement.php                                                            *
***********************************************************************************
* SMF Garage: Simple Machines Forum Garage (MOD)                                  *
* =============================================================================== *
* Software Version:           SMF Garage 2.0                                      *
* Install for:                1.0-2.99                                            *
* Software by:                RRasco (http://www.smfgarage.com)                   *
* Copyright 2007-2011 by:     SMF Garage (http://www.smfgarage.com)               *
*                             RRasco (rrasco@smfgarage.com)                       *
* phpBB Garage by:            Esmond Poynton (esmond.poynton@gmail.com)           *
* Support, News, Updates at:  http://www.smfgarage.com                            *
***********************************************************************************
* See the "SMF_Garage_License.txt" file for details.                              *
*              http://www.opensource.org/licenses/BSD-3-Clause                    *
*                                                                                 *
* The latest version can always be found at:                                      *
*              http://www.smfgarage.com                                           *
**********************************************************************************/

if (!defined('SMF'))
	die('Hacking attempt...');

// The controller; doesn't do anything, just delegates.
function GarageManagement()
{
	global $smfgSettings, $context, $txt, $scripturl, $db_prefix;
    
    if(isset($context['TPortal'])) {
        tp_hidebars();
    }

	// First, let's do a quick permissions check
	isAllowedTo('manage_garage');
    
    // We need our functions!
    require_once('GarageFunctions.php');
    
    // Load settings
    loadSmfgConfig();
    
	// Administrative side bar, here we come!
	adminIndex('garage_management');

	// This is gonna be needed...
    loadTemplate('GarageManagement');
    loadLanguage('Garage');
    
    // Set our index includes
    $context['garage_js'] = 1;
    $context['mootools'] = 0;
    $context['smfg_ajax'] = 0;
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

	// Format: 'sub-action' => array('function', 'permission')
	$subActions = array(
		'business' => array('ManageBusiness', 'manage_garage_businesses'),
        'business_add' => array('AddBusiness', 'manage_garage_businesses'),
        'business_insert' => array('InsertBusiness', 'manage_garage_businesses'),
        'business_edit' => array('EditBusiness', 'manage_garage_businesses'),
        'business_approve' => array('ApproveBusiness', 'manage_garage_businesses'),
        'business_disable' => array('DisableBusiness', 'manage_garage_businesses'),
        'business_update' => array('UpdateBusiness', 'manage_garage_businesses'),
        'garage_delete' => array('DeleteGarage', 'manage_garage_businesses'),
        'shop_delete' => array('DeleteShop', 'manage_garage_businesses'),
        'insurance_delete' => array('DeleteInsurance', 'manage_garage_businesses'),
        'dynocenter_delete' => array('DeleteDynocenter', 'manage_garage_businesses'),
        'manufacturer_delete' => array('DeleteManufacturer', 'manage_garage_businesses'),
		'categories' => array('ManageCategories', 'manage_garage_categories'),
        'category_move' => array('MoveCat', 'manage_garage_categories'),
        'category_add' => array('AddCat', 'manage_garage_categories'),
        'category_edit' => array('EditCat', 'manage_garage_categories'),
        'category_update' => array('UpdateCat', 'manage_garage_categories'),
        'category_delete' => array('DeleteCat', 'manage_garage_categories'),
		'makesmodels' => array('ManageMakesModels', 'manage_garage_makes_models'),
        'make_add' => array('AddMake', 'manage_garage_makes_models'),
        'make_edit' => array('EditMake', 'manage_garage_makes_models'),
        'make_update' => array('UpdateMake', 'manage_garage_makes_models'),
        'make_delete' => array('DeleteMake', 'manage_garage_makes_models'),
        'make_approve' => array('ApproveMake', 'manage_garage_makes_models'),
        'make_disable' => array('DisableMake', 'manage_garage_makes_models'),
        'model_add' => array('AddModel', 'manage_garage_makes_models'),
        'model_edit' => array('EditModel', 'manage_garage_makes_models'),
        'model_update' => array('UpdateModel', 'manage_garage_makes_models'),
        'model_delete' => array('DeleteModel', 'manage_garage_makes_models'),
        'model_approve' => array('ApproveModel', 'manage_garage_makes_models'),
        'model_disable' => array('DisableModel', 'manage_garage_makes_models'),
		'products' =>  array('ManageProducts', 'manage_garage_products'),
        'product_add' => array('AddProduct', 'manage_garage_products'),
        'product_insert' => array('InsertProduct', 'manage_garage_products'),
        'product_edit' => array('EditProduct', 'manage_garage_products'),
        'product_update' => array('UpdateProduct', 'manage_garage_products'),
        'product_delete' => array('DeleteProduct', 'manage_garage_products'),
        'product_approve' => array('ApproveProduct', 'manage_garage_products'),
        'product_disable' => array('DisableProduct', 'manage_garage_products'),
        'tracks' => array('ManageTracks', 'manage_garage_tracks'),
        'track_add' => array('AddTrack', 'manage_garage_tracks'),
        'track_insert' => array('InsertTrack', 'manage_garage_tracks'),
        'track_edit' => array('EditTrack', 'manage_garage_tracks'),
        'track_update' => array('UpdateTrack', 'manage_garage_tracks'),
        'track_delete' => array('DeleteTrack', 'manage_garage_tracks'),
        'track_disable' => array('DisableTrack', 'manage_garage_tracks'),
        'track_approve' => array('ApproveTrack', 'manage_garage_tracks'),
        'tc_add' => array('AddTrackCondition', 'manage_garage_tracks'),
        'tc_move' => array('MoveTrackCondition', 'manage_garage_tracks'),
        'tc_edit' => array('EditTrackCondition', 'manage_garage_tracks'),
        'tc_update' => array('UpdateTrackCondition', 'manage_garage_tracks'),
        'tc_delete' => array('DeleteTrackCondition', 'manage_garage_tracks'),
        'lt_add' => array('AddLapType', 'manage_garage_tracks'),
        'lt_move' => array('MoveLapType', 'manage_garage_tracks'),
        'lt_edit' => array('EditLapType', 'manage_garage_tracks'),
        'lt_update' => array('UpdateLapType', 'manage_garage_tracks'),
        'lt_delete' => array('DeleteLapType', 'manage_garage_tracks'),
        'other' => array('ManageOther', 'manage_garage_other'),
        'pt_add' => array('AddPremiumType', 'manage_garage_other'),
        'pt_move' => array('MovePremiumType', 'manage_garage_other'),
        'pt_edit' => array('EditPremiumType', 'manage_garage_other'),
        'pt_update' => array('UpdatePremiumType', 'manage_garage_other'),
        'pt_delete' => array('DeletePremiumType', 'manage_garage_other'),
        'et_add' => array('AddEngineType', 'manage_garage_other'),
        'et_move' => array('MoveEngineType', 'manage_garage_other'),
        'et_edit' => array('EditEngineType', 'manage_garage_other'),
        'et_update' => array('UpdateEngineType', 'manage_garage_other'),
        'et_delete' => array('DeleteEngineType', 'manage_garage_other'),
        'st_add' => array('AddServiceType', 'manage_garage_other'),
        'st_move' => array('MoveServiceType', 'manage_garage_other'),
        'st_edit' => array('EditServiceType', 'manage_garage_other'),
        'st_update' => array('UpdateServiceType', 'manage_garage_other'),
        'st_delete' => array('DeleteServiceType', 'manage_garage_other'),
        'ct_add' => array('AddCurrencyType', 'manage_garage_other'),
        'ct_move' => array('MoveCurrencyType', 'manage_garage_other'),
        'ct_edit' => array('EditCurrencyType', 'manage_garage_other'),
        'ct_update' => array('UpdateCurrencyType', 'manage_garage_other'),
        'ct_delete' => array('DeleteCurrencyType', 'manage_garage_other'),
        'tools' => array('Tools', 'manage_garage_tools'),
        'rebuildimagesajax' => array('RebuildImagesAjax', 'manage_garage_tools'),
        'orphan_results' => array('OrphanResults', 'manage_garage_tools'),
        'optimize' => array('Optimize', 'manage_garage_tools'),
        'pending' => array('Pending', 'manage_garage_pending'),
        'vehicle_approve' => array('ApproveVehicle', 'manage_garage_pending'),
        'modification_approve' => array('ApproveModification', 'manage_garage_pending'),
        'quartermile_approve' => array('ApproveQuartermile', 'manage_garage_pending'),
        'dynorun_approve' => array('ApproveDynorun', 'manage_garage_pending'),
        'laptime_approve' => array('ApproveLaptime', 'manage_garage_pending'),
        'comment_approve' => array('Approve_Comment', 'manage_garage_pending'),
	);

	// Default to sub action 'business'.
    $_REQUEST['sa'] = !empty($_GET['sa']) ? $_GET['sa'] : 'business';
    // Default to a sub action they have permission to
    if(allowedTo('manage_garage_businesses'))
        $_REQUEST['sa'] = !empty($_GET['sa']) ? $_GET['sa'] : 'business';
    else if(allowedTo('manage_garage_categories'))
        $_REQUEST['sa'] = !empty($_GET['sa']) ? $_GET['sa'] : 'categories';
    else if(allowedTo('manage_garage_makes_models'))
        $_REQUEST['sa'] = !empty($_GET['sa']) ? $_GET['sa'] : 'makesmodels';
    else if(allowedTo('manage_garage_products'))
        $_REQUEST['sa'] = !empty($_GET['sa']) ? $_GET['sa'] : 'products';
    else if(allowedTo('manage_garage_tools'))
        $_REQUEST['sa'] = !empty($_GET['sa']) ? $_GET['sa'] : 'tools';
    else if(allowedTo('manage_garage_tracks'))
        $_REQUEST['sa'] = !empty($_GET['sa']) ? $_GET['sa'] : 'tracks';
    else if(allowedTo('manage_garage_other'))
        $_REQUEST['sa'] = !empty($_GET['sa']) ? $_GET['sa'] : 'other';
    else if(allowedTo('manage_garage_pending'))
        $_REQUEST['sa'] = !empty($_GET['sa']) ? $_GET['sa'] : 'pending';

	// Have you got the proper permissions?
	isAllowedTo($subActions[$_REQUEST['sa']][1]);

	// Create the tabs for the template.
    $context['admin_tabs'] = array(
        'title' => $txt['smfg_garage'].' '.$txt['smfg_management'],
        'help' => 'garage_management',
        'description' => '',
        'tabs' => array(),
    );
    if (allowedTo('manage_garage_businesses'))
        $context['admin_tabs']['tabs'][] = array(
            'title' => $txt['smfg_businesses'],
            'description' => $txt['management_business'],
            'href' => $scripturl . '?action=garagemanagement',
            'is_selected' => $_REQUEST['sa'] != 'categories' && $_REQUEST['sa'] != 'category_edit' && $_REQUEST['sa'] != 'makesmodels' && $_REQUEST['sa'] != 'make_edit' && $_REQUEST['sa'] != 'model_edit' && $_REQUEST['sa'] != 'products' && $_REQUEST['sa'] != 'product_edit' && $_REQUEST['sa'] != 'product_add' && $_REQUEST['sa'] != 'tools' && $_REQUEST['sa'] != 'tracks' && $_REQUEST['sa'] != 'track_edit' && $_REQUEST['sa'] != 'track_add' && $_REQUEST['sa'] != 'tc_edit' && $_REQUEST['sa'] != 'lt_edit' && $_REQUEST['sa'] != 'pt_edit' && $_REQUEST['sa'] != 'et_edit' && $_REQUEST['sa'] != 'st_edit' && $_REQUEST['sa'] != 'ct_edit' && $_REQUEST['sa'] != 'other' && $_REQUEST['sa'] != 'pending' && $_REQUEST['sa'] != 'orphan_results',
        );
    if (allowedTo('manage_garage_categories'))
        $context['admin_tabs']['tabs'][] = array(
            'title' => $txt['smfg_categories'],
            'description' => $txt['management_categories'],
            'href' => $scripturl . '?action=garagemanagement;sa=categories',
            'is_selected' => $_REQUEST['sa'] != 'business' && $_REQUEST['sa'] != 'business_add' && $_REQUEST['sa'] != 'business_edit' && $_REQUEST['sa'] != 'makesmodels' && $_REQUEST['sa'] != 'make_edit' && $_REQUEST['sa'] != 'model_edit' && $_REQUEST['sa'] != 'products' && $_REQUEST['sa'] != 'product_edit' && $_REQUEST['sa'] != 'product_add' && $_REQUEST['sa'] != 'tools' && $_REQUEST['sa'] != 'tracks' && $_REQUEST['sa'] != 'track_edit' && $_REQUEST['sa'] != 'track_add' && $_REQUEST['sa'] != 'tc_edit' && $_REQUEST['sa'] != 'lt_edit' && $_REQUEST['sa'] != 'pt_edit' && $_REQUEST['sa'] != 'et_edit' && $_REQUEST['sa'] != 'st_edit' && $_REQUEST['sa'] != 'ct_edit' && $_REQUEST['sa'] != 'other' && $_REQUEST['sa'] != 'pending' && $_REQUEST['sa'] != 'orphan_results',
        );
    if (allowedTo('manage_garage_makes_models'))
        $context['admin_tabs']['tabs'][] = array(
            'title' => $txt['smfg_mm'],
            'description' => $txt['management_makesmodels'],
            'href' => $scripturl . '?action=garagemanagement;sa=makesmodels',
            'is_selected' => $_REQUEST['sa'] != 'business' && $_REQUEST['sa'] != 'business_add' && $_REQUEST['sa'] != 'business_edit' && $_REQUEST['sa'] != 'categories' && $_REQUEST['sa'] != 'category_edit' && $_REQUEST['sa'] != 'products' && $_REQUEST['sa'] != 'product_edit' && $_REQUEST['sa'] != 'product_add'  && $_REQUEST['sa'] != 'tools' && $_REQUEST['sa'] != 'tracks' && $_REQUEST['sa'] != 'track_edit' && $_REQUEST['sa'] != 'track_add' && $_REQUEST['sa'] != 'tc_edit' && $_REQUEST['sa'] != 'lt_edit' && $_REQUEST['sa'] != 'pt_edit' && $_REQUEST['sa'] != 'et_edit' && $_REQUEST['sa'] != 'st_edit' && $_REQUEST['sa'] != 'ct_edit' && $_REQUEST['sa'] != 'other' && $_REQUEST['sa'] != 'pending' && $_REQUEST['sa'] != 'orphan_results',
        );
    if (allowedTo('manage_garage_products'))
        $context['admin_tabs']['tabs'][] = array(
            'title' => $txt['smfg_products'],
            'description' => $txt['management_products'],
            'href' => $scripturl . '?action=garagemanagement;sa=products',
            'is_selected' => $_REQUEST['sa'] != 'business' && $_REQUEST['sa'] != 'business_add' && $_REQUEST['sa'] != 'business_edit' && $_REQUEST['sa'] != 'categories' && $_REQUEST['sa'] != 'category_edit' && $_REQUEST['sa'] != 'makesmodels' && $_REQUEST['sa'] != 'make_edit' && $_REQUEST['sa'] != 'model_edit'  && $_REQUEST['sa'] != 'tools' && $_REQUEST['sa'] != 'tracks' && $_REQUEST['sa'] != 'track_edit' && $_REQUEST['sa'] != 'track_add' && $_REQUEST['sa'] != 'tc_edit' && $_REQUEST['sa'] != 'lt_edit' && $_REQUEST['sa'] != 'pt_edit' && $_REQUEST['sa'] != 'et_edit' && $_REQUEST['sa'] != 'st_edit' && $_REQUEST['sa'] != 'ct_edit' && $_REQUEST['sa'] != 'other' && $_REQUEST['sa'] != 'pending' && $_REQUEST['sa'] != 'orphan_results',
        );
    if (allowedTo('manage_garage_tracks'))
        $context['admin_tabs']['tabs'][] = array(
            'title' => $txt['smfg_tracks'],
            'description' => $txt['management_tracks'],
            'href' => $scripturl . '?action=garagemanagement;sa=tracks',
            'is_selected' => $_REQUEST['sa'] != 'business' && $_REQUEST['sa'] != 'business_add' && $_REQUEST['sa'] != 'business_edit' && $_REQUEST['sa'] != 'categories' && $_REQUEST['sa'] != 'category_edit' && $_REQUEST['sa'] != 'products' && $_REQUEST['sa'] != 'product_edit' && $_REQUEST['sa'] != 'product_add' && $_REQUEST['sa'] != 'makesmodels' && $_REQUEST['sa'] != 'make_edit' && $_REQUEST['sa'] != 'model_edit'  && $_REQUEST['sa'] != 'tools' && $_REQUEST['sa'] != 'other' && $_REQUEST['sa'] != 'pt_edit' && $_REQUEST['sa'] != 'et_edit' && $_REQUEST['sa'] != 'st_edit' && $_REQUEST['sa'] != 'ct_edit' && $_REQUEST['sa'] != 'pending' && $_REQUEST['sa'] != 'orphan_results',
        );
    if (allowedTo('manage_garage_other'))
        $context['admin_tabs']['tabs'][] = array(
            'title' => $txt['smfg_other'],
            'description' => $txt['management_other'],
            'href' => $scripturl . '?action=garagemanagement;sa=other',
            'is_selected' => $_REQUEST['sa'] != 'business' && $_REQUEST['sa'] != 'business_add' && $_REQUEST['sa'] != 'business_edit' && $_REQUEST['sa'] != 'categories' && $_REQUEST['sa'] != 'category_edit' && $_REQUEST['sa'] != 'products' && $_REQUEST['sa'] != 'product_edit' && $_REQUEST['sa'] != 'product_add' && $_REQUEST['sa'] != 'makesmodels' && $_REQUEST['sa'] != 'make_edit' && $_REQUEST['sa'] != 'model_edit'  && $_REQUEST['sa'] != 'tools' && $_REQUEST['sa'] != 'tracks' && $_REQUEST['sa'] != 'track_edit' && $_REQUEST['sa'] != 'track_add' && $_REQUEST['sa'] != 'tc_edit' && $_REQUEST['sa'] != 'lt_edit' && $_REQUEST['sa'] != 'orphan_results' && $_REQUEST['sa'] != 'pending',
        );
    if (allowedTo('manage_garage_tools'))
        $context['admin_tabs']['tabs'][] = array(
            'title' => $txt['smfg_tools'],
            'description' => $txt['management_tools'],
            'href' => $scripturl . '?action=garagemanagement;sa=tools',
            'is_selected' => $_REQUEST['sa'] != 'business' && $_REQUEST['sa'] != 'business_add' && $_REQUEST['sa'] != 'business_edit' && $_REQUEST['sa'] != 'categories' && $_REQUEST['sa'] != 'category_edit' && $_REQUEST['sa'] != 'products' && $_REQUEST['sa'] != 'product_edit' && $_REQUEST['sa'] != 'product_add' && $_REQUEST['sa'] != 'makesmodels' && $_REQUEST['sa'] != 'make_edit' && $_REQUEST['sa'] != 'model_edit'  && $_REQUEST['sa'] != 'tracks' && $_REQUEST['sa'] != 'track_edit' && $_REQUEST['sa'] != 'track_add' && $_REQUEST['sa'] != 'tc_edit' && $_REQUEST['sa'] != 'lt_edit' && $_REQUEST['sa'] != 'pending' && $_REQUEST['sa'] != 'pt_edit' && $_REQUEST['sa'] != 'et_edit' && $_REQUEST['sa'] != 'st_edit' && $_REQUEST['sa'] != 'ct_edit' && $_REQUEST['sa'] != 'other',
        );
    if (allowedTo('manage_garage_pending'))
        $context['admin_tabs']['tabs'][] = array(
            'title' => $txt['smfg_pending'],
            'description' => $txt['management_pending'],
            'href' => $scripturl . '?action=garagemanagement;sa=pending',
            'is_selected' => $_REQUEST['sa'] != 'business' && $_REQUEST['sa'] != 'business_add' && $_REQUEST['sa'] != 'business_edit' && $_REQUEST['sa'] != 'categories' && $_REQUEST['sa'] != 'category_edit' && $_REQUEST['sa'] != 'products' && $_REQUEST['sa'] != 'product_edit' && $_REQUEST['sa'] != 'product_add' && $_REQUEST['sa'] != 'makesmodels' && $_REQUEST['sa'] != 'make_edit' && $_REQUEST['sa'] != 'model_edit'  && $_REQUEST['sa'] != 'tools' && $_REQUEST['sa'] != 'other' && $_REQUEST['sa'] != 'tracks' && $_REQUEST['sa'] != 'track_edit' && $_REQUEST['sa'] != 'track_add' && $_REQUEST['sa'] != 'tc_edit' && $_REQUEST['sa'] != 'lt_edit' && $_REQUEST['sa'] != 'pt_edit' && $_REQUEST['sa'] != 'et_edit' && $_REQUEST['sa'] != 'st_edit' && $_REQUEST['sa'] != 'ct_edit' && $_REQUEST['sa'] != 'other' && $_REQUEST['sa'] != 'orphan_results',
        );

	$context['admin_tabs']['tabs'][count($context['admin_tabs']['tabs']) - 1]['is_last'] = true;

	$subActions[$_REQUEST['sa']][0]();
}

// Management of Businesses
function ManageBusiness()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'manage_business';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_businesses');
    
    // Get Garage Infos
    $request = db_query("
        SELECT id, title, pending
        FROM {$db_prefix}garage_business
        WHERE garage = 1
        ORDER BY title ASC",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['garages'][$count]['id'],
             $context['garages'][$count]['title'],
             $context['garages'][$count]['pending']) = $row;
        $count++;
    }
    mysql_free_result($request);
    
    // Get Shop Infos
    $request = db_query("
        SELECT id, title, pending
        FROM {$db_prefix}garage_business
        WHERE retail = 1
        ORDER BY title ASC",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['shops'][$count]['id'],
             $context['shops'][$count]['title'],
             $context['shops'][$count]['pending']) = $row;
        $count++;
    }
    mysql_free_result($request);
    
    // Get Insurance Infos
    $request = db_query("
        SELECT id, title, pending
        FROM {$db_prefix}garage_business
        WHERE insurance = 1
        ORDER BY title ASC",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['insurance'][$count]['id'],
             $context['insurance'][$count]['title'],
             $context['insurance'][$count]['pending']) = $row;
        $count++;
    }
    mysql_free_result($request);
    
    // Get Dynocenter Infos
    $request = db_query("
        SELECT id, title, pending
        FROM {$db_prefix}garage_business
        WHERE dynocenter = 1
        ORDER BY title ASC",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['dynocenters'][$count]['id'],
             $context['dynocenters'][$count]['title'],
             $context['dynocenters'][$count]['pending']) = $row;
        $count++;
    }
    mysql_free_result($request);
    
    // Get Manufacturer Infos
    $request = db_query("
        SELECT id, title, pending
        FROM {$db_prefix}garage_business
        WHERE product = 1
        ORDER BY title ASC",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['manufacturers'][$count]['id'],
             $context['manufacturers'][$count]['title'],
             $context['manufacturers'][$count]['pending']) = $row;
        $count++;
    }
    mysql_free_result($request);
    
}

// Add businesses
function AddBusiness()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;

    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'add_business';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_businesses');

    // Get business type so that it's auto selected in the Type select
    $context['check_garage'] = "";
    $context['check_retail'] = "";
    $context['check_insurance'] = "";
    $context['check_dynocenter'] = "";
    $context['check_product'] = "";
    
    switch($_GET['type']) {
        case "garage":
            $context['check_garage'] = " checked=\"checked\"";
            $context['business_name'] = ucwords($_POST['garage']);
            break;
        case "retail":
            $context['check_retail'] = " checked=\"checked\"";
            $context['business_name'] = ucwords($_POST['shop']);
            break;
        case "insurance":
            $context['check_insurance'] = " checked=\"checked\"";
            $context['business_name'] = ucwords($_POST['insurance']);
            break;
        case "dynocenter":
            $context['check_dynocenter'] = " checked=\"checked\"";
            $context['business_name'] = ucwords($_POST['dynocenter']);
            break;
        case "product":
            $context['check_product'] = " checked=\"checked\"";
            $context['business_name'] = ucwords($_POST['manufacturer']);
            break;
    }

    // Check if the submitted business already exist
    $request = db_query("
        SELECT id
        FROM {$db_prefix}garage_business
        WHERE title = '".$context['business_name']."'",__FILE__,__LINE__);
    $matching_business = mysql_num_rows($request);
    list($bid) = mysql_fetch_row($request);
    mysql_free_result($request);

    if($matching_business > 0) {
        // Need to modify not add
        $_GET['BID'] = $bid;
        EditBusiness();
        return;
    }
    
}

// Insert businesses
function InsertBusiness()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_businesses');
        
    // Define these types
    $typeval = ARRAY();
    $typeval['product'] = 0;
    $typeval['retail'] = 0;
    $typeval['garage'] = 0;
    $typeval['insurance'] = 0;
    $typeval['dynocenter'] = 0;
    
    foreach($_POST['type'] as $type) {
        switch($type) {
            case "product":
                $typeval['product'] = 1;
                break;
            case "retail":
                $typeval['retail'] = 1;
                break;
            case "garage":
                $typeval['garage'] = 1;
                break;
            case "insurance":
                $typeval['insurance'] = 1;
                break;
            case "dynocenter":
                $typeval['dynocenter'] = 1;
                break;
        }
    }

    // Check for 'http://' or 'https://'
    if(!empty($_POST['website'])) {
        
        $http_pos = strpos($_POST['website'], 'http://');
        $https_pos = strpos($_POST['website'], 'https://');
        
        if($http_pos === FALSE && $https_pos === FALSE) {            
            // Append http:// to beginning of URL
            $http = array('http://', $_POST['website']);
            $_POST['website'] = join("", $http);
        }
    }
    
    // Insert the business
    $request = db_query("
        INSERT INTO {$db_prefix}garage_business (title, address, telephone, fax, website, email, opening_hours, product, retail, garage, insurance, dynocenter, pending)
        VALUES ('".$_POST['title']."', '".$_POST['address']."', '".$_POST['telephone']."', '".$_POST['fax']."', '".$_POST['website']."', '".$_POST['email']."', '".$_POST['opening_hours']."', ". ($typeval['product'] ? 1 : 0) .", ". ($typeval['retail'] ? 1 : 0) .", ". ($typeval['garage'] ? 1 : 0) .", ". ($typeval['insurance'] ? 1 : 0) .", ". ($typeval['dynocenter'] ? 1 : 0) .", '0')",__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement');
    header('Location: '.$_POST['redirecturl']);
    
}

// Edit businesses
function EditBusiness()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'edit_business';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_businesses');
    
    $request = db_query("
        SELECT id, title, address, telephone, fax, website, email, opening_hours, insurance, garage, retail, product, dynocenter
        FROM {$db_prefix}garage_business
        WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
        list($context['business']['bid'],
             $context['business']['title'],
             $context['business']['address'],
             $context['business']['telephone'],
             $context['business']['fax'],
             $context['business']['website'],
             $context['business']['email'],
             $context['business']['opening_hours'],
             $context['business']['insurance'],
             $context['business']['garage'],
             $context['business']['retail'],
             $context['business']['product'],
             $context['business']['dynocenter']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
    $context['business']['title'] = str_replace('"', '&quot;', $context['business']['title']);
    
    $context['business']['check']['insurance'] = "";
    $context['business']['check']['garage'] = "";
    $context['business']['check']['retail'] = "";
    $context['business']['check']['product'] = "";
    $context['business']['check']['dynocenter'] = "";
    if($context['business']['insurance'] == 1) $context['business']['check']['insurance'] = " checked=\"checked\" ";
    if($context['business']['garage'] == 1) $context['business']['check']['garage'] = " checked=\"checked\" ";
    if($context['business']['retail'] == 1) $context['business']['check']['retail'] = " checked=\"checked\" ";
    if($context['business']['product'] == 1) $context['business']['check']['product'] = " checked=\"checked\" ";
    if($context['business']['dynocenter'] == 1) $context['business']['check']['dynocenter'] = " checked=\"checked\" ";
    
}

// Update businesses
function UpdateBusiness()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_businesses');

    // need to set all types to 0 incase some got removed
    $typeval = ARRAY();
    $typeval['product'] = "0";
    $typeval['retail'] = "0";
    $typeval['garage'] = "0";
    $typeval['insurance'] = "0";
    $typeval['dynocenter'] = "0";

    foreach($_POST['type'] as $type) {
        switch($type) {
            case "product":
                $typeval['product'] = "1";
                break;
            case "retail":
                $typeval['retail'] = 1;
                break;
            case "garage":
                $typeval['garage'] = 1;
                break;
            case "insurance":
                $typeval['insurance'] = 1;
                break;
            case "dynocenter":
                $typeval['dynocenter'] = 1;
                break;
        }
    }

    // Check for 'http://' or 'https://'
    if(!empty($_POST['website'])) {

        $http_pos = strpos($_POST['website'], 'http://');
        $https_pos = strpos($_POST['website'], 'https://');

        if($http_pos === FALSE && $https_pos === FALSE) {
            // Append http:// to beginning of URL
            $http = array('http://', $_POST['website']);
            $_POST['website'] = join("", $http);
        }
    }
    
    $typestring = '';

    foreach($typeval as $type => $val) {
        $typestring .= "".$type." = ".$val.", ";
    }
    
    // Upper Case the Business Title
    $_POST['title'] = ucwords($_POST['title']);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_business
        SET title = '".$_POST['title']."', address = '".$_POST['address']."', telephone = '".$_POST['telephone']."', fax = '".$_POST['fax']."', website = '".$_POST['website']."', email = '".$_POST['email']."', opening_hours = '".$_POST['opening_hours']."'
        WHERE id = ".$_POST['BID'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement');
    header('Location: '.$_POST['redirecturl']);
    
}

// Delete Garage
function DeleteGarage()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    require_once('Subs-Post.php');
    
    // Check Permissions
    isAllowedTo('manage_garage_businesses');
    
    checkSession('get');
    
    // Find any services done by this garage
    $request = db_query("
        SELECT s.id, v.user_id
        FROM {$db_prefix}garage_service_history AS s, {$db_prefix}garage_vehicles AS v
        WHERE s.garage_id = ".$_GET['BID']."
            AND s.vehicle_id = v.id",__FILE__,__LINE__);
    while($row = mysql_fetch_assoc($request)) {
        
        // Delete the service
        $request2 = db_query("
            DELETE FROM {$db_prefix}garage_service_history
            WHERE id =".$row['id'],__FILE__,__LINE__);
        
        // Send a notification to the user        
        //$recipients['to'] = array($row['user_id']);
        //$recipients['bcc'] = '';
        $recipients = array(
            'to' => array($row['user_id']),
            'bcc' => array()
        );
        
        // Send a notification to the user
        if (!empty($recipients['to']) || !empty($recipients['bcc']))
            $context['send_log'] = sendpm($recipients, $txt['smfg_service_removed_subject'], $txt['smfg_service_removed_PM'], false);
        else
            $context['send_log'] = array(
                'sent' => array(),
                'failed' => array()
            );
    }
    mysql_free_result($request);
    
    // Any other business types for this garage?
    $request = db_query("
        SELECT insurance, retail, product, dynocenter
        FROM {$db_prefix}garage_business
        WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
        list($context['insurance'],
             $context['retail'],
             $context['product'],
             $context['dynocenter']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
    if(!$context['insurance'] && !$context['retail'] && !$context['product'] && !$context['dynocenter']) {
    
        // Delete the business
        $request = db_query("
            DELETE FROM {$db_prefix}garage_business
            WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
            
    } else {
        
        // Just remove it as a garage
        $request = db_query("
            UPDATE {$db_prefix}garage_business
            SET garage = 0
            WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
    }
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Delete Shop
function DeleteShop()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_businesses');
    
    checkSession('get');
    
    // Any other business types for this shop?
    $request = db_query("
        SELECT insurance, garage, product, dynocenter
        FROM {$db_prefix}garage_business
        WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
        list($context['insurance'],
             $context['garage'],
             $context['product'],
             $context['dynocenter']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
    if(!$context['insurance'] && !$context['garage'] && !$context['product'] && !$context['dynocenter']) {
    
        // Delete the business
        $request = db_query("
            DELETE FROM {$db_prefix}garage_business
            WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
            
    } else {
        
        // Just remove it as a shop
        $request = db_query("
            UPDATE {$db_prefix}garage_business
            SET retail = 0
            WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
    }
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Delete Insurance
function DeleteInsurance()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    require_once('Subs-Post.php');
    
    // Check Permissions
    isAllowedTo('manage_garage_businesses');
    
    checkSession('get');
    
    // Find any premiums by this business
    $request = db_query("
        SELECT p.id, v.user_id
        FROM {$db_prefix}garage_premiums AS p, {$db_prefix}garage_vehicles AS v
        WHERE p.business_id = ".$_GET['BID']."
            AND p.vehicle_id = v.id",__FILE__,__LINE__);
    while($row = mysql_fetch_assoc($request)) {
        
        // Delete the premium
        $request2 = db_query("
            DELETE FROM {$db_prefix}garage_premiums
            WHERE id =".$row['id'],__FILE__,__LINE__);
            
        // Send a notification to the user        
        //$recipients['to'] = array($row['user_id']);
        //$recipients['bcc'] = '';
        $recipients = array(
            'to' => array($row['user_id']),
            'bcc' => array()
        );
        
        // Send a notification to the user
        if (!empty($recipients['to']) || !empty($recipients['bcc']))
            $context['send_log'] = sendpm($recipients, $txt['smfg_premium_removed_subject'], $txt['smfg_premium_removed_PM'], false);
        else
            $context['send_log'] = array(
                'sent' => array(),
                'failed' => array()
            );
    }
    mysql_free_result($request);
    
    // Any other business types for this insurance agency?
    $request = db_query("
        SELECT garage, retail, product, dynocenter
        FROM {$db_prefix}garage_business
        WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
        list($context['garage'],
             $context['retail'],
             $context['product'],
             $context['dynocenter']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
    if(!$context['garage'] && !$context['retail'] && !$context['product'] && !$context['dynocenter']) {
    
        // Delete the business
        $request = db_query("
            DELETE FROM {$db_prefix}garage_business
            WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
            
    } else {
        
        // Just remove it as insurance
        $request = db_query("
            UPDATE {$db_prefix}garage_business
            SET insurance = 0
            WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
    }
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Delete Dynocenter
function DeleteDynocenter()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info, $boarddir;
    global $func, $smfgSettings;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    require_once('Subs-Post.php');
    
    // Check Permissions
    isAllowedTo('manage_garage_businesses');
    
    checkSession('get');
        
    // Set image directory
    $dir = $boarddir.'/'.$smfgSettings['upload_directory'];  
    
    // Find any dynoruns done by this dynocenter
    $request = db_query("
        SELECT d.id, v.user_id
        FROM {$db_prefix}garage_dynoruns AS d, {$db_prefix}garage_vehicles AS v
        WHERE d.dynocenter_id = ".$_GET['BID']."
            AND d.vehicle_id = v.id",__FILE__,__LINE__);
    while($row = mysql_fetch_assoc($request)) {
        $dynoruns['id'] = $row['id'];
          
        // Get image IDs
        $request2 = db_query("
            SELECT image_id
            FROM {$db_prefix}garage_dynoruns_gallery
            WHERE dynorun_id = ".$dynoruns['id'],__FILE__,__LINE__);
        while($row2 = mysql_fetch_assoc($request2)) {
            $images['id'] = $row2['image_id'];
            // Get image filenames
            $request3 = db_query("
                SELECT attach_location, attach_thumb_location
                FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
                while($row3 = mysql_fetch_assoc($request3)) {
                    $images['filename'] = $row3['attach_location'];
                    $images['thumb_filename'] = $row3['attach_thumb_location'];
                    // Destroy the images
                    unlink($dir.$images['filename']);    
                    unlink($dir.$images['thumb_filename']);  
                }
            mysql_free_result($request3);
            
            // Delete row from garage_images
            $request3 = db_query("
                DELETE FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
        }
        mysql_free_result($request2);     
        
        // Delete rows from dynoruns_gallery 
        $request2 = db_query("
            DELETE FROM {$db_prefix}garage_dynoruns_gallery
            WHERE dynorun_id = ".$dynoruns['id'],__FILE__,__LINE__);
        
        // Delete the dynorun
        $request2 = db_query("
            DELETE FROM {$db_prefix}garage_dynoruns
            WHERE id =".$dynoruns['id'],__FILE__,__LINE__);
        
        // Send a notification to the user        
        //$recipients['to'] = array($row['user_id']);
        //$recipients['bcc'] = '';
        $recipients = array(
            'to' => array($row['user_id']),
            'bcc' => array()
        );
        
        // Send a notification to the user
        if (!empty($recipients['to']) || !empty($recipients['bcc']))
            $context['send_log'] = sendpm($recipients, $txt['smfg_dynorun_removed_subject'], $txt['smfg_dynorun_removed_PM'], false);
        else
            $context['send_log'] = array(
                'sent' => array(),
                'failed' => array()
            );
    }
    mysql_free_result($request);
    
    // Any other business types for this dynocenter?
    $request = db_query("
        SELECT insurance, garage, retail, product
        FROM {$db_prefix}garage_business
        WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
        list($context['insurance'],
             $context['garage'],
             $context['retail'],
             $context['product']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
    if(!$context['insurance'] && !$context['garage'] && !$context['retail'] && !$context['product']) {
    
        // Delete the business
        $request = db_query("
            DELETE FROM {$db_prefix}garage_business
            WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
            
    } else {
        
        // Just remove it as a dynocenter
        $request = db_query("
            UPDATE {$db_prefix}garage_business
            SET dynocenter = 0
            WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
    }
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Delete Manufacturer
function DeleteManufacturer()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info, $boarddir;
    global $func, $smfgSettings, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    require_once('Subs-Post.php');
    
    // Check Permissions
    isAllowedTo('manage_garage_businesses');
    
    checkSession('get');
        
    // Set image directory
    $dir = $boarddir.'/'.$smfgSettings['upload_directory'];  
    
    // Find any mods with products by this manufacturer
    $request = db_query("
        SELECT m.id, v.user_id
        FROM {$db_prefix}garage_modifications AS m, {$db_prefix}garage_vehicles AS v
        WHERE m.manufacturer_id = ".$_GET['BID']."
            AND m.vehicle_id = v.id",__FILE__,__LINE__);
    while($row = mysql_fetch_assoc($request)) {
        $modifications['id'] = $row['id'];
          
        // Get image IDs
        $request2 = db_query("
            SELECT image_id
            FROM {$db_prefix}garage_modifications_gallery
            WHERE modification_id = ".$modifications['id'],__FILE__,__LINE__);
        while($row2 = mysql_fetch_assoc($request2)) {
            $images['id'] = $row2['image_id'];
            // Get image filenames
            $request3 = db_query("
                SELECT attach_location, attach_thumb_location
                FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
                while($row3 = mysql_fetch_assoc($request3)) {
                    $images['filename'] = $row3['attach_location'];
                    $images['thumb_filename'] = $row3['attach_thumb_location'];
                    // Destroy the images
                    unlink($dir.$images['filename']);    
                    unlink($dir.$images['thumb_filename']);  
                }
            mysql_free_result($request3);
            
            // Delete row from garage_images
            $request3 = db_query("
                DELETE FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
        }
        mysql_free_result($request2);     
        
        // Delete rows from modifications_gallery 
        $request2 = db_query("
            DELETE FROM {$db_prefix}garage_modifications_gallery
            WHERE modification_id = ".$modifications['id'],__FILE__,__LINE__);
        
        // Delete the modification
        $request2 = db_query("
            DELETE FROM {$db_prefix}garage_modifications
            WHERE id =".$modifications['id'],__FILE__,__LINE__);
        
        // Send a notification to the user        
        //$recipients['to'] = array($row['user_id']);
        //$recipients['bcc'] = '';
        $recipients = array(
            'to' => array($row['user_id']),
            'bcc' => array()
        );
        
        // Send a notification to the user
        if (!empty($recipients['to']) || !empty($recipients['bcc']))
            $context['send_log'] = sendpm($recipients, $txt['smfg_mod_removed_subject'], $txt['smfg_mod_removed_PM'], false);
        else
            $context['send_log'] = array(
                'sent' => array(),
                'failed' => array()
            );
    }
    mysql_free_result($request);
    
    // Any other business types for this mfg?
    $request = db_query("
        SELECT insurance, garage, retail, dynocenter
        FROM {$db_prefix}garage_business
        WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
        list($context['insurance'],
             $context['garage'],
             $context['retail'],
             $context['dynocenter']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
    if(!$context['insurance'] && !$context['garage'] && !$context['retail'] && !$context['dynocenter']) {
    
        // Delete the business
        $request = db_query("
            DELETE FROM {$db_prefix}garage_business
            WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
            
    } else {
        
        // Just remove it as a mfg
        $request = db_query("
            UPDATE {$db_prefix}garage_business
            SET product = 0
            WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
    }
    
    // Delete the manufacturer's products
    $request = db_query("
        DELETE FROM {$db_prefix}garage_products
        WHERE business_id = ".$_GET['BID'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Approve businesses
function ApproveBusiness()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_businesses');
    
    checkSession('get');
    
    $request = db_query("
        UPDATE {$db_prefix}garage_business
        SET pending = '0'
        WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Disapprove/Disable businesses
function DisableBusiness()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_businesses');
    
    checkSession('get');
    
    $request = db_query("
        UPDATE {$db_prefix}garage_business
        SET pending = '1'
        WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Manage modification categories
function ManageCategories()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'manage_categories';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_categories');
    
    $request = db_query("
        SELECT id, title, field_order
        FROM {$db_prefix}garage_categories
        ORDER BY field_order ASC",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['categories'][$count]['id'],
             $context['categories'][$count]['title'],
             $context['categories'][$count]['field_order']) = $row;
        $count++;
    }
    $context['categories']['total'] = mysql_num_rows($request);
    mysql_free_result($request);
    
}

// Modify modification categories field_order
function MoveCat()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    checkSession('get');
    
    // Check Permissions
    isAllowedTo('manage_garage_categories');
    
    if($_GET['direction'] == 'up') {
        
        // Find our target order
        $context['target_order'] = $_GET['order'] - 1;
        
    } else if($_GET['direction'] == 'down') {
        
        // Find our target order
        $context['target_order'] = $_GET['order'] + 1;
        
    }
    
    // Get the target order's CID
    $request = db_query("
        SELECT id
        FROM {$db_prefix}garage_categories
        WHERE field_order = ".$context['target_order'],__FILE__,__LINE__);
    list($context['target_id']) = mysql_fetch_row($request);
    mysql_free_result($request);
            
    // First set our target to the current order
    $request = db_query("
        UPDATE {$db_prefix}garage_categories
        SET field_order = ".$_GET['order']."
        WHERE id = ".$context['target_id'],__FILE__,__LINE__);
        
    // Then set our current category to the target order
    $request = db_query("
        UPDATE {$db_prefix}garage_categories
        SET field_order = ".$context['target_order']."
        WHERE id = ".$_GET['CID'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=categories');
    header('Location: '.$_POST['redirecturl']);    
    
}

// Add modification category
function AddCat()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_categories');
    
    // Validate the session
    checkSession();
    
    $request = db_query("
        SELECT id
        FROM {$db_prefix}garage_categories",__FILE__,__LINE__);
    $context['categories']['total'] = mysql_num_rows($request);
    mysql_free_result($request);
    
    $context['field_order'] = $context['categories']['total'] + 1;
    
    // Upper Case the Category
    $_POST['category'] = ucwords($_POST['category']);

    $request = db_query("
        INSERT INTO {$db_prefix}garage_categories (title, field_order)
        VALUES ('".$_POST['category']."', ".$context['field_order'].")",__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=categories');
    header('Location: '.$_POST['redirecturl']);   
    
}

// Edit a modification category
function EditCat()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'edit_categories';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_categories');
    
    $request = db_query("
        SELECT id, title
        FROM {$db_prefix}garage_categories
        WHERE id = ".$_GET['CID'],__FILE__,__LINE__);
    list($context['categories']['cid'],
         $context['categories']['title']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
}

// Update modification category
function UpdateCat()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_categories');
    
    // Validate the session
    checkSession();
    
    // Upper Case the Category title
    $_POST['title'] = ucwords($_POST['title']);

    $request = db_query("
        UPDATE {$db_prefix}garage_categories
        SET title = '".$_POST['title']."'
        WHERE id = ".$_POST['cid'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=categories');
    header('Location: '.$_POST['redirecturl']);
    
}

// Delete modification category
function DeleteCat()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info, $boarddir;
    global $func, $scripturl, $smfgSettings;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    require_once('Subs-Post.php');
    
    // Check Permissions
    isAllowedTo('manage_garage_categories');
    
    checkSession('get');
        
    // Set image directory
    $dir = $boarddir.'/'.$smfgSettings['upload_directory'];  
    
    // Find any mods with products in this category
    $request = db_query("
        SELECT m.id, v.user_id
        FROM {$db_prefix}garage_modifications AS m, {$db_prefix}garage_vehicles AS v
        WHERE m.category_id = ".$_GET['CID']."
            AND m.vehicle_id = v.id",__FILE__,__LINE__);
    while($row = mysql_fetch_assoc($request)) {
        $modifications['id'] = $row['id'];
          
        // Get image IDs
        $request2 = db_query("
            SELECT image_id
            FROM {$db_prefix}garage_modifications_gallery
            WHERE modification_id = ".$modifications['id'],__FILE__,__LINE__);
        while($row2 = mysql_fetch_assoc($request2)) {
            $images['id'] = $row2['image_id'];
            // Get image filenames
            $request3 = db_query("
                SELECT attach_location, attach_thumb_location
                FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
                while($row3 = mysql_fetch_assoc($request3)) {
                    $images['filename'] = $row3['attach_location'];
                    $images['thumb_filename'] = $row3['attach_thumb_location'];
                    // Destroy the images
                    unlink($dir.$images['filename']);    
                    unlink($dir.$images['thumb_filename']);  
                }
            mysql_free_result($request3);
            
            // Delete row from garage_images
            $request3 = db_query("
                DELETE FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
        }
        mysql_free_result($request2);     
        
        // Delete rows from modifications_gallery 
        $request2 = db_query("
            DELETE FROM {$db_prefix}garage_modifications_gallery
            WHERE modification_id = ".$modifications['id'],__FILE__,__LINE__);
        
        // Delete the modification
        $request2 = db_query("
            DELETE FROM {$db_prefix}garage_modifications
            WHERE id =".$modifications['id'],__FILE__,__LINE__);
        
        // Send a notification to the user        
        //$recipients['to'] = array($row['user_id']);
        //$recipients['bcc'] = '';
        $recipients = array(
            'to' => array($row['user_id']),
            'bcc' => array()
        );
        
        // Send a notification to the user
        if (!empty($recipients['to']) || !empty($recipients['bcc']))
            $context['send_log'] = sendpm($recipients, $txt['smfg_mod_removed_subject'], $txt['smfg_mod_removed_PM'], false);
        else
            $context['send_log'] = array(
                'sent' => array(),
                'failed' => array()
            );
    }
    mysql_free_result($request);
    
    // Delete the products in this category
    $request = db_query("
        DELETE FROM {$db_prefix}garage_products
        WHERE category_id = ".$_GET['CID'],__FILE__,__LINE__);
        
    // Get the catgeories field_order
    $request = db_query("
        SELECT field_order
        FROM {$db_prefix}garage_categories
        WHERE id = ".$_GET['CID'],__FILE__,__LINE__);
    $row = mysql_fetch_assoc($request);
    mysql_free_result($request);
    
    // Fix the field order for any above the to be deleted catgeory
    $request = db_query("
        SELECT id, field_order
        FROM {$db_prefix}garage_categories
        WHERE field_order > ".$row['field_order'],__FILE__,__LINE__);
    while($field_order = mysql_fetch_assoc($request)) {
        $newFieldOrder = $field_order['field_order'] - 1;
        $request2 = db_query("
            UPDATE {$db_prefix}garage_categories
            SET field_order = ".$newFieldOrder."
            WHERE id = ".$field_order['id'],__FILE__,__LINE__);
    }
    mysql_free_result($request);
    
    // Delete the category
    $request = db_query("
        DELETE FROM {$db_prefix}garage_categories
        WHERE id = ".$_GET['CID'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=categories');
    header('Location: '.$_POST['redirecturl']);
    
}

// Let the administrator(s) edit the news.
function ManageMakesModels()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'manage_makes_models';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_makes_models');
    
    $request = db_query("
        SELECT id, make, pending
        FROM {$db_prefix}garage_makes
        ORDER BY make ASC",__FILE__,__LINE__);
        $count = 0;
        while($row = mysql_fetch_row($request)) {
            list($context['makes'][$count]['id'],
                 $context['makes'][$count]['title'],
                 $context['makes'][$count]['pending']) = $row;
            $count++;   
        }
        mysql_free_result($request);
}

// Add make
function AddMake()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_makes_models');
    
    // Validate the session
    checkSession();
    
    // Upper Case the make
    $_POST['make'] = ucwords($_POST['make']);

    // Check if the submitted make already exists
    $request = db_query("
        SELECT make
        FROM {$db_prefix}garage_makes
        WHERE make = '".$_POST['make']."'",__FILE__,__LINE__);
    $matching_makes = mysql_num_rows($request);
    mysql_free_result($request);

    if($matching_makes > 0) {
        loadLanguage('Errors');
        fatal_lang_error('garage_submit_make_error', false);
    }

    $request = db_query("
        INSERT INTO {$db_prefix}garage_makes (make)
        VALUES ('".$_POST['make']."')",__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=makesmodels');
    header('Location: '.$_POST['redirecturl']);
    
}

// Edit a make
function EditMake()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'edit_make';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_makes_models');
    
    $request = db_query("
        SELECT id, make
        FROM {$db_prefix}garage_makes
        WHERE id = ".$_GET['mkid'],__FILE__,__LINE__);
    list($context['makes']['mkid'],
         $context['makes']['title']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
}

// Update make
function UpdateMake()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_makes_models');
    
    // Validate the session
    checkSession();
    
    // Upper Case the Make Title
    $_POST['title'] = ucwords($_POST['title']);

    $request = db_query("
        UPDATE {$db_prefix}garage_makes
        SET make = '".$_POST['title']."'
        WHERE id = ".$_POST['mkid'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=makesmodels');
    header('Location: '.$_POST['redirecturl']);
    
}

// Delete make
function DeleteMake()
{
    global $txt, $scripturl, $db_prefix, $user_info, $scripturl, $boarddir;
    global $modSettings, $smfgSettings, $context, $func, $ext;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    require_once('Subs-Post.php');
    
    // Check Permissions
    isAllowedTo('manage_garage_makes_models');
    
    // Validate Session
    checkSession('get');
    
    // Set image directory
    $dir = $boarddir.'/'.$smfgSettings['upload_directory'];  
    
    // Get any vehicles of this make
    $result = db_query("
        SELECT id AS VID, user_id
        FROM {$db_prefix}garage_vehicles
        WHERE make_id = ".$_GET['mkid'],__FILE__,__LINE__);
    while($vehicle = mysql_fetch_assoc($result)) {
      
        // Get vehicle image IDs
        $request = db_query("
            SELECT image_id
            FROM {$db_prefix}garage_vehicles_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        while($row = mysql_fetch_row($request)) {
            $images['id'] = $row[0];
            // Get image filenames
            $request2 = db_query("
                SELECT attach_location, attach_thumb_location
                FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
                while($row2 = mysql_fetch_row($request2)) {
                    $images['filename'] = $row2[0];
                    $images['thumb_filename'] = $row2[1];   
                    // Destroy the images
                    unlink($dir.$images['filename']);    
                    unlink($dir.$images['thumb_filename']);  
                }
            mysql_free_result($request2);
        }
        mysql_free_result($request);    
          
        // Get modification image IDs
        $request = db_query("
            SELECT image_id
            FROM {$db_prefix}garage_modifications_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        while($row = mysql_fetch_row($request)) {
            $images['id'] = $row[0];
            // Get image filenames
            $request2 = db_query("
                SELECT attach_location, attach_thumb_location
                FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
                while($row2 = mysql_fetch_row($request2)) {
                    $images['filename'] = $row2[0];
                    $images['thumb_filename'] = $row2[1];   
                    // Destroy the images
                    unlink($dir.$images['filename']);    
                    unlink($dir.$images['thumb_filename']);  
                }
            mysql_free_result($request2);
        }
        mysql_free_result($request);    
          
        // Get quartermile image IDs
        $request = db_query("
            SELECT image_id
            FROM {$db_prefix}garage_quartermiles_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        while($row = mysql_fetch_row($request)) {
            $images['id'] = $row[0];
            // Get image filenames
            $request2 = db_query("
                SELECT attach_location, attach_thumb_location
                FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
                while($row2 = mysql_fetch_row($request2)) {
                    $images['filename'] = $row2[0];
                    $images['thumb_filename'] = $row2[1];   
                    // Destroy the images
                    unlink($dir.$images['filename']);    
                    unlink($dir.$images['thumb_filename']);  
                }
            mysql_free_result($request2);
        }
        mysql_free_result($request);    
          
        // Get dynorun image IDs
        $request = db_query("
            SELECT image_id
            FROM {$db_prefix}garage_dynoruns_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        while($row = mysql_fetch_row($request)) {
            $images['id'] = $row[0];
            // Get image filenames
            $request2 = db_query("
                SELECT attach_location, attach_thumb_location
                FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
                while($row2 = mysql_fetch_row($request2)) {
                    $images['filename'] = $row2[0];
                    $images['thumb_filename'] = $row2[1];   
                    // Destroy the images
                    unlink($dir.$images['filename']);    
                    unlink($dir.$images['thumb_filename']);  
                }
            mysql_free_result($request2);
        }
        mysql_free_result($request);    
          
        // Get lap image IDs
        $request = db_query("
            SELECT image_id
            FROM {$db_prefix}garage_laps_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        while($row = mysql_fetch_row($request)) {
            $images['id'] = $row[0];
            // Get image filenames
            $request2 = db_query("
                SELECT attach_location, attach_thumb_location
                FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
                while($row2 = mysql_fetch_row($request2)) {
                    $images['filename'] = $row2[0];
                    $images['thumb_filename'] = $row2[1];   
                    // Destroy the images
                    unlink($dir.$images['filename']);    
                    unlink($dir.$images['thumb_filename']);  
                }
            mysql_free_result($request2);
        }
        mysql_free_result($request);     
        
        // Delete rows from garage_images
        $request = db_query("
            DELETE FROM {$db_prefix}garage_images
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete rows from vehicles_gallery 
        $request = db_query("
            DELETE FROM {$db_prefix}garage_vehicles_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete rows from modifications_gallery 
        $request = db_query("
            DELETE FROM {$db_prefix}garage_modifications_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete modifications
        $request = db_query("
            DELETE FROM {$db_prefix}garage_modifications
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete rows from quartermiles_gallery 
        $request = db_query("
            DELETE FROM {$db_prefix}garage_quartermiles_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete quartermiles
        $request = db_query("
            DELETE FROM {$db_prefix}garage_quartermiles
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete rows from dynrouns_gallery 
        $request = db_query("
            DELETE FROM {$db_prefix}garage_dynoruns_gallery 
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete dynrouns
        $request = db_query("
            DELETE FROM {$db_prefix}garage_dynoruns
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete rows from laps_gallery 
        $request = db_query("
            DELETE FROM {$db_prefix}garage_laps_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete laps
        $request = db_query("
            DELETE FROM {$db_prefix}garage_laps
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete blogs
        $request = db_query("
            DELETE FROM {$db_prefix}garage_blog
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete guestbooks
        $request = db_query("
            DELETE FROM {$db_prefix}garage_guestbooks
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete premiums
        $request = db_query("
            DELETE FROM {$db_prefix}garage_premiums
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete ratings
        $request = db_query("
            DELETE FROM {$db_prefix}garage_ratings
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete service_history
        $request = db_query("
            DELETE FROM {$db_prefix}garage_service_history
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete the vehicle
        $request = db_query("
            DELETE FROM {$db_prefix}garage_vehicles
            WHERE id = ".$vehicle['VID'], __FILE__, __LINE__);
        
        // Send a notification to the user        
        //$recipients['to'] = array($row['user_id']);
        //$recipients['bcc'] = '';
        $recipients = array(
            'to' => array($row['user_id']),
            'bcc' => array()
        );
        
        // Send a notification to the user
        if (!empty($recipients['to']) || !empty($recipients['bcc']))
            $context['send_log'] = sendpm($recipients, $txt['smfg_make_removed_subject'], $txt['smfg_make_removed_PM'], false);
        else
            $context['send_log'] = array(
                'sent' => array(),
                'failed' => array()
            );  
    
    }
    mysql_free_result($result);
        
    // Delete the make
    $request = db_query("
        DELETE FROM {$db_prefix}garage_makes
        WHERE id = ".$_GET['mkid'], __FILE__, __LINE__);
        
    // ...and send them on their way
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);

}

// Approve make
function ApproveMake()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_makes_models');
    
    checkSession('get');
    
    $request = db_query("
        UPDATE {$db_prefix}garage_makes
        SET pending = '0'
        WHERE id = ".$_GET['mkid'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Disapprove/Disable make
function DisableMake()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_makes_models');
    
    checkSession('get');
    
    $request = db_query("
        UPDATE {$db_prefix}garage_makes
        SET pending = '1'
        WHERE id = ".$_GET['mkid'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Add model
function AddModel()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_makes_models');
    
    // Validate the session
    checkSession();
    
    // Upper Case the model
    $_POST['model'] = ucwords($_POST['model']);

    // Check if the submitted model already exists
    $request = db_query("
        SELECT model
        FROM {$db_prefix}garage_models
        WHERE make_id = ".$_POST['make_id']."
            AND model = '".$_POST['model']."'",__FILE__,__LINE__);
    $matching_models = mysql_num_rows($request);
    mysql_free_result($request);

    if($matching_models > 0) {
        loadLanguage('Errors');
        fatal_lang_error('garage_submit_model_error', false);
    }

    $request = db_query("
        INSERT INTO {$db_prefix}garage_models (make_id, model)
        VALUES (".$_POST['make_id'].", '".$_POST['model']."')",__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=makesmodels#models');
    header('Location: '.$_POST['redirecturl']);
    
}

// Edit a model
function EditModel()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'edit_model';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_makes_models');
    
    $request = db_query("
        SELECT id, make_id, model
        FROM {$db_prefix}garage_models
        WHERE id = ".$_GET['mdid'],__FILE__,__LINE__);
    list($context['models']['mdid'],
         $context['models']['mkid'],
         $context['models']['title']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
}

// Update model
function UpdateModel()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_makes_models');
    
    // Validate the session
    checkSession();
    
    $request = db_query("
        UPDATE {$db_prefix}garage_models
        SET make_id = ".$_POST['make_id'].", model = '".$_POST['title']."'
        WHERE id = ".$_POST['mdid'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=makesmodels#models');
    header('Location: '.$_POST['redirecturl']);
    
}

// Delete model
function DeleteModel()
{
    global $txt, $scripturl, $db_prefix, $user_info, $scripturl, $boarddir;
    global $modSettings, $smfgSettings, $context, $func, $ext;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    require_once('Subs-Post.php');
    
    // Check Permissions
    isAllowedTo('manage_garage_makes_models');
    
    // Validate Session
    checkSession('get');
    
    // Set image directory
    $dir = $boarddir.'/'.$smfgSettings['upload_directory'];  
    
    // Get any vehicles of this model
    $result = db_query("
        SELECT id AS VID, user_id
        FROM {$db_prefix}garage_vehicles
        WHERE model_id = ".$_GET['mdid'],__FILE__,__LINE__);
    while($vehicle = mysql_fetch_assoc($result)) {
      
        // Get vehicle image IDs
        $request = db_query("
            SELECT image_id
            FROM {$db_prefix}garage_vehicles_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        while($row = mysql_fetch_row($request)) {
            $images['id'] = $row[0];
            // Get image filenames
            $request2 = db_query("
                SELECT attach_location, attach_thumb_location
                FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
                while($row2 = mysql_fetch_row($request2)) {
                    $images['filename'] = $row2[0];
                    $images['thumb_filename'] = $row2[1];   
                    // Destroy the images
                    unlink($dir.$images['filename']);    
                    unlink($dir.$images['thumb_filename']);  
                }
            mysql_free_result($request2);
        }
        mysql_free_result($request);
          
        // Get modification image IDs
        $request = db_query("
            SELECT image_id
            FROM {$db_prefix}garage_modifications_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        while($row = mysql_fetch_row($request)) {
            $images['id'] = $row[0];
            // Get image filenames
            $request2 = db_query("
                SELECT attach_location, attach_thumb_location
                FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
                while($row2 = mysql_fetch_row($request2)) {
                    $images['filename'] = $row2[0];
                    $images['thumb_filename'] = $row2[1];   
                    // Destroy the images
                    unlink($dir.$images['filename']);    
                    unlink($dir.$images['thumb_filename']);  
                }
            mysql_free_result($request2);
        }
        mysql_free_result($request);    
          
        // Get quartermile image IDs
        $request = db_query("
            SELECT image_id
            FROM {$db_prefix}garage_quartermiles_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        while($row = mysql_fetch_row($request)) {
            $images['id'] = $row[0];
            // Get image filenames
            $request2 = db_query("
                SELECT attach_location, attach_thumb_location
                FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
                while($row2 = mysql_fetch_row($request2)) {
                    $images['filename'] = $row2[0];
                    $images['thumb_filename'] = $row2[1];   
                    // Destroy the images
                    unlink($dir.$images['filename']);    
                    unlink($dir.$images['thumb_filename']);  
                }
            mysql_free_result($request2);
        }
        mysql_free_result($request);    
          
        // Get dynorun image IDs
        $request = db_query("
            SELECT image_id
            FROM {$db_prefix}garage_dynoruns_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        while($row = mysql_fetch_row($request)) {
            $images['id'] = $row[0];
            // Get image filenames
            $request2 = db_query("
                SELECT attach_location, attach_thumb_location
                FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
                while($row2 = mysql_fetch_row($request2)) {
                    $images['filename'] = $row2[0];
                    $images['thumb_filename'] = $row2[1];   
                    // Destroy the images
                    unlink($dir.$images['filename']);    
                    unlink($dir.$images['thumb_filename']);  
                }
            mysql_free_result($request2);
        }
        mysql_free_result($request);    
          
        // Get lap image IDs
        $request = db_query("
            SELECT image_id
            FROM {$db_prefix}garage_laps_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        while($row = mysql_fetch_row($request)) {
            $images['id'] = $row[0];
            // Get image filenames
            $request2 = db_query("
                SELECT attach_location, attach_thumb_location
                FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
                while($row2 = mysql_fetch_row($request2)) {
                    $images['filename'] = $row2[0];
                    $images['thumb_filename'] = $row2[1];   
                    // Destroy the images
                    unlink($dir.$images['filename']);    
                    unlink($dir.$images['thumb_filename']);  
                }
            mysql_free_result($request2);
        }
        mysql_free_result($request);     
        
        // Delete rows from garage_images
        $request = db_query("
            DELETE FROM {$db_prefix}garage_images
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete rows from vehicles_gallery 
        $request = db_query("
            DELETE FROM {$db_prefix}garage_vehicles_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete rows from modifications_gallery 
        $request = db_query("
            DELETE FROM {$db_prefix}garage_modifications_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete modifications
        $request = db_query("
            DELETE FROM {$db_prefix}garage_modifications
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete rows from quartermiles_gallery 
        $request = db_query("
            DELETE FROM {$db_prefix}garage_quartermiles_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete quartermiles
        $request = db_query("
            DELETE FROM {$db_prefix}garage_quartermiles
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete rows from dynrouns_gallery 
        $request = db_query("
            DELETE FROM {$db_prefix}garage_dynoruns_gallery 
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete dynrouns
        $request = db_query("
            DELETE FROM {$db_prefix}garage_dynoruns
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete rows from laps_gallery 
        $request = db_query("
            DELETE FROM {$db_prefix}garage_laps_gallery
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete laps
        $request = db_query("
            DELETE FROM {$db_prefix}garage_laps
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete blogs
        $request = db_query("
            DELETE FROM {$db_prefix}garage_blog
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete guestbooks
        $request = db_query("
            DELETE FROM {$db_prefix}garage_guestbooks
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete premiums
        $request = db_query("
            DELETE FROM {$db_prefix}garage_premiums
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete ratings
        $request = db_query("
            DELETE FROM {$db_prefix}garage_ratings
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete service_history
        $request = db_query("
            DELETE FROM {$db_prefix}garage_service_history
            WHERE vehicle_id = ".$vehicle['VID'],__FILE__,__LINE__);
        
        // Delete the vehicle
        $request = db_query("
            DELETE FROM {$db_prefix}garage_vehicles
            WHERE id = ".$vehicle['VID'], __FILE__, __LINE__);
        
        // Send a notification to the user        
        //$recipients['to'] = array($row['user_id']);
        //$recipients['bcc'] = '';
        $recipients = array(
            'to' => array($row['user_id']),
            'bcc' => array()
        );
        
        // Send a notification to the user
        if (!empty($recipients['to']) || !empty($recipients['bcc']))
            $context['send_log'] = sendpm($recipients, $txt['smfg_model_removed_subject'], $txt['smfg_model_removed_PM'], false);
        else
            $context['send_log'] = array(
                'sent' => array(),
                'failed' => array()
            );
    
    }
    mysql_free_result($result);
        
    // Delete the model
    $request = db_query("
        DELETE FROM {$db_prefix}garage_models
        WHERE id = ".$_GET['mdid'], __FILE__, __LINE__);
        
    // ...and send them on their way
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);

}

// Approve model
function ApproveModel()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_makes_models');
    
    checkSession('get');
    
    $request = db_query("
        UPDATE {$db_prefix}garage_models
        SET pending = '0'
        WHERE id = ".$_GET['mdid'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Disapprove/Disable model
function DisableModel()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_makes_models');
    
    checkSession('get');
    
    $request = db_query("
        UPDATE {$db_prefix}garage_models
        SET pending = '1'
        WHERE id = ".$_GET['mdid'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Manage Products
function ManageProducts()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'manage_products';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_products');
}

// Add a product
function AddProduct()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'add_product';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_products');
    
}

// Insert product
function InsertProduct()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_products');
    
    // Validate the session
    checkSession();
    
    // Upper Case the Product Title
    $_POST['title'] = ucwords($_POST['title']);

    // Check if the submitted product already exists
    $request = db_query("
        SELECT title
        FROM {$db_prefix}garage_products
        WHERE business_id = ".$_POST['bid']."
            AND category_id = ".$_POST['cid']."
            AND title = '".$_POST['title']."'",__FILE__,__LINE__);
    $matching_products = mysql_num_rows($request);
    mysql_free_result($request);

    if($matching_products > 0) {
        loadLanguage('Errors');
        fatal_lang_error('garage_submit_product_error', false);
    }

    $request = db_query("
        INSERT INTO {$db_prefix}garage_products (business_id, category_id, title)
        VALUES (".$_POST['bid'].", ".$_POST['cid'].", '".$_POST['title']."')",__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=products');
    header('Location: '.$_POST['redirecturl']);
    
}

// Edit a product
function EditProduct()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'edit_product';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_products');
    
    $request = db_query("
        SELECT id, business_id, category_id, title
        FROM {$db_prefix}garage_products
        WHERE id = ".$_GET['pid'],__FILE__,__LINE__);
    list($context['products']['pid'],
         $context['products']['bid'],
         $context['products']['cid'],
         $context['products']['title']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
    $context['products']['title'] = str_replace('"', '&quot;', $context['products']['title']);
    
}

// Update product
function UpdateProduct()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_products');
    
    // Validate the session
    checkSession();
    
    // Upper Case the Product title
    $_POST['title'] = ucwords($_POST['title']);

    $request = db_query("
        UPDATE {$db_prefix}garage_products
        SET business_id = ".$_POST['bid'].", category_id = ".$_POST['cid'].", title = '".$_POST['title']."'
        WHERE id = ".$_POST['pid'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=products');
    header('Location: '.$_POST['redirecturl']);
    
}

// Delete Product
function DeleteProduct()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info, $boarddir;
    global $func, $smfgSettings, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    require_once('Subs-Post.php');
    
    // Check Permissions
    isAllowedTo('manage_garage_products');
    
    checkSession('get');
        
    // Set image directory
    $dir = $boarddir.'/'.$smfgSettings['upload_directory'];  
    
    // Find any mods with products by this manufacturer
    $request = db_query("
        SELECT m.id, v.user_id
        FROM {$db_prefix}garage_modifications AS m, {$db_prefix}garage_vehicles AS v
        WHERE m.product_id = ".$_GET['pid']."
            AND m.vehicle_id = v.id",__FILE__,__LINE__);
    while($row = mysql_fetch_assoc($request)) {
        $modifications['id'] = $row['id'];
          
        // Get image IDs
        $request2 = db_query("
            SELECT image_id
            FROM {$db_prefix}garage_modifications_gallery
            WHERE modification_id = ".$modifications['id'],__FILE__,__LINE__);
        while($row2 = mysql_fetch_assoc($request2)) {
            $images['id'] = $row2['image_id'];
            // Get image filenames
            $request3 = db_query("
                SELECT attach_location, attach_thumb_location
                FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
                while($row3 = mysql_fetch_assoc($request3)) {
                    $images['filename'] = $row3['attach_location'];
                    $images['thumb_filename'] = $row3['attach_thumb_location'];
                    // Destroy the images
                    unlink($dir.$images['filename']);    
                    unlink($dir.$images['thumb_filename']);  
                }
            mysql_free_result($request3);
            
            // Delete row from garage_images
            $request3 = db_query("
                DELETE FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
        }
        mysql_free_result($request2);     
        
        // Delete rows from modifications_gallery 
        $request2 = db_query("
            DELETE FROM {$db_prefix}garage_modifications_gallery
            WHERE modification_id = ".$modifications['id'],__FILE__,__LINE__);
        
        // Delete the modification
        $request2 = db_query("
            DELETE FROM {$db_prefix}garage_modifications
            WHERE id =".$modifications['id'],__FILE__,__LINE__);
        
        // Send a notification to the user        
        //$recipients['to'] = array($row['user_id']);
        //$recipients['bcc'] = '';
        $recipients = array(
            'to' => array($row['user_id']),
            'bcc' => array()
        );
        
        // Send a notification to the user
        if (!empty($recipients['to']) || !empty($recipients['bcc']))
            $context['send_log'] = sendpm($recipients, $txt['smfg_mod_removed_subject'], $txt['smfg_mod_removed_PM'], false);
        else
            $context['send_log'] = array(
                'sent' => array(),
                'failed' => array()
            );
    }
    mysql_free_result($request);
    
    // Delete the product
    $request = db_query("
        DELETE FROM {$db_prefix}garage_products
        WHERE id = ".$_GET['pid'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Approve product
function ApproveProduct()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_products');
    
    checkSession('get');
    
    $request = db_query("
        UPDATE {$db_prefix}garage_products
        SET pending = '0'
        WHERE id = ".$_GET['pid'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Disapprove/Disable product
function DisableProduct()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_products');
    
    checkSession('get');
    
    $request = db_query("
        UPDATE {$db_prefix}garage_products
        SET pending = '1'
        WHERE id = ".$_GET['pid'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Let the administrator(s) edit the news.
function ManageTracks()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'manage_tracks';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
    $request = db_query("
        SELECT id, title, pending
        FROM {$db_prefix}garage_tracks
        ORDER BY title ASC",__FILE__,__LINE__);
        $count = 0;
        while($row = mysql_fetch_row($request)) {
            list($context['tracks'][$count]['id'],
                 $context['tracks'][$count]['title'],
                 $context['tracks'][$count]['pending']) = $row;
            $count++;   
        }
    mysql_free_result($request);
        
    $request = db_query("
        SELECT id, title, field_order
        FROM {$db_prefix}garage_track_conditions
        ORDER BY field_order ASC",__FILE__,__LINE__);
        $count = 0;
        while($row = mysql_fetch_row($request)) {
            list($context['conditions'][$count]['id'],
                 $context['conditions'][$count]['title'],
                 $context['conditions'][$count]['field_order']) = $row;
            $count++;   
        }
    $context['conditions']['total'] = mysql_num_rows($request);
    mysql_free_result($request);
        
    $request = db_query("
        SELECT id, title, field_order
        FROM {$db_prefix}garage_lap_types
        ORDER BY field_order ASC",__FILE__,__LINE__);
        $count = 0;
        while($row = mysql_fetch_row($request)) {
            list($context['laptypes'][$count]['id'],
                 $context['laptypes'][$count]['title'],
                 $context['laptypes'][$count]['field_order']) = $row;
            $count++;   
        }
    $context['laptypes']['total'] = mysql_num_rows($request);
    mysql_free_result($request);
}

// Add a track
function AddTrack()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'add_track';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
}

// Insert track
function InsertTrack()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
    // Validate the session
    checkSession();
    
    // Upper Case the track title
    $_POST['title'] = ucwords($_POST['title']);

    // Check if the submitted track already exists
    $request = db_query("
        SELECT title
        FROM {$db_prefix}garage_tracks
        WHERE title = '".$_POST['title']."'",__FILE__,__LINE__);
    $matching_tracks = mysql_num_rows($request);
    mysql_free_result($request);

    if($matching_tracks > 0) {
        loadLanguage('Errors');
        fatal_lang_error('garage_submit_track_error', false);
    }

    $request = db_query("
        INSERT INTO {$db_prefix}garage_tracks (title, length, mileage_unit)
        VALUES ('".$_POST['title']."', '".$_POST['length']."', '".$_POST['mileage_unit']."')",__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=tracks');
    header('Location: '.$_POST['redirecturl']);
    
}

// Edit a track
function EditTrack()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'edit_track';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
    $request = db_query("
        SELECT id, title, length, mileage_unit
        FROM {$db_prefix}garage_tracks
        WHERE id = ".$_GET['TID'],__FILE__,__LINE__);
    list($context['tracks']['tid'],
         $context['tracks']['title'],
         $context['tracks']['length'],
         $context['tracks']['mileage_unit']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
    if($context['tracks']['mileage_unit'] == "Miles") $context['miles'] = " selected=\"selected\""; 
    else if($context['tracks']['mileage_unit'] == "Kilometers") $context['kilometers'] = " selected=\"selected\"";
    
    if(!isset($context['miles'])) $context['miles'] = "";
    if(!isset($context['kilometers'])) $context['kilometers'] = "";
    
}

// Update track
function UpdateTrack()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
    // Validate the session
    checkSession();
    
    // Upper Case the track title
    $_POST['title'] = ucwords($_POST['title']);

    $request = db_query("
        UPDATE {$db_prefix}garage_tracks
        SET title = '".$_POST['title']."', length = '".$_POST['length']."', mileage_unit = '".$_POST['mileage_unit']."'
        WHERE id = ".$_POST['tid'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=tracks');
    header('Location: '.$_POST['redirecturl']);
    
}

// Delete Track
function DeleteTrack()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info, $boarddir;
    global $func, $smfgSettings, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    require_once('Subs-Post.php');
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
    checkSession('get');
        
    // Set image directory
    $dir = $boarddir.'/'.$smfgSettings['upload_directory'];  
    
    // Find any laps at this track
    $request = db_query("
        SELECT l.id, v.user_id
        FROM {$db_prefix}garage_laps AS l, {$db_prefix}garage_vehicles AS v
        WHERE l.track_id = ".$_GET['TID']."
            AND l.vehicle_id = v.id",__FILE__,__LINE__);
    while($row = mysql_fetch_assoc($request)) {
        $laps['id'] = $row['id'];
          
        // Get image IDs
        $request2 = db_query("
            SELECT image_id
            FROM {$db_prefix}garage_laps_gallery
            WHERE lap_id = ".$laps['id'],__FILE__,__LINE__);
        while($row2 = mysql_fetch_assoc($request2)) {
            $images['id'] = $row2['image_id'];
            // Get image filenames
            $request3 = db_query("
                SELECT attach_location, attach_thumb_location
                FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
                while($row3 = mysql_fetch_assoc($request3)) {
                    $images['filename'] = $row3['attach_location'];
                    $images['thumb_filename'] = $row3['attach_thumb_location'];
                    // Destroy the images
                    unlink($dir.$images['filename']);    
                    unlink($dir.$images['thumb_filename']);  
                }
            mysql_free_result($request3);
            
            // Delete row from garage_images
            $request3 = db_query("
                DELETE FROM {$db_prefix}garage_images
                WHERE attach_id = ".$images['id'],__FILE__,__LINE__);
        }
        mysql_free_result($request2);     
        
        // Delete rows from laps_gallery 
        $request2 = db_query("
            DELETE FROM {$db_prefix}garage_laps_gallery
            WHERE lap_id = ".$laps['id'],__FILE__,__LINE__);
        
        // Delete the lap
        $request2 = db_query("
            DELETE FROM {$db_prefix}garage_laps
            WHERE id =".$laps['id'],__FILE__,__LINE__);
        
        // Send a notification to the user        
        //$recipients['to'] = array($row['user_id']);
        //$recipients['bcc'] = '';
        $recipients = array(
            'to' => array($row['user_id']),
            'bcc' => array()
        );
        
        // Send a notification to the user
        if (!empty($recipients['to']) || !empty($recipients['bcc']))
            $context['send_log'] = sendpm($recipients, $txt['smfg_lap_removed_subject'], $txt['smfg_lap_removed_PM'], false);
        else
            $context['send_log'] = array(
                'sent' => array(),
                'failed' => array()
            );
    }
    mysql_free_result($request);
    
    // Delete the track
    $request = db_query("
        DELETE FROM {$db_prefix}garage_tracks
        WHERE id = ".$_GET['TID'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Approve track
function ApproveTrack()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
    checkSession('get');
    
    $request = db_query("
        UPDATE {$db_prefix}garage_tracks
        SET pending = '0'
        WHERE id = ".$_GET['TID'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Disapprove/Disable track
function DisableTrack()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
    checkSession('get');
    
    $request = db_query("
        UPDATE {$db_prefix}garage_tracks
        SET pending = '1'
        WHERE id = ".$_GET['TID'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Add track condition
function AddTrackCondition()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
    // Validate the session
    checkSession();
    
    // Upper Case the Track Condition
    $_POST['tc'] = ucwords($_POST['tc']);

    $request = db_query("
        SELECT id
        FROM {$db_prefix}garage_track_conditions",__FILE__,__LINE__);
    $context['tc']['total'] = mysql_num_rows($request);
    mysql_free_result($request);
    
    $context['field_order'] = $context['tc']['total'] + 1;
    
    $request = db_query("
        INSERT INTO {$db_prefix}garage_track_conditions (title, field_order)
        VALUES ('".$_POST['tc']."', ".$context['field_order'].")",__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=tracks');
    header('Location: '.$_POST['redirecturl']);
    
}

// Edit a track condition
function EditTrackCondition()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'edit_track_condition';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
    $request = db_query("
        SELECT id, title
        FROM {$db_prefix}garage_track_conditions
        WHERE id = ".$_GET['TCID'],__FILE__,__LINE__);
    list($context['tc']['id'],
         $context['tc']['title']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
}

// Update track condition
function UpdateTrackCondition()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
    // Validate the session
    checkSession();
    
    // Upper Case the Track Condition title
    $_POST['title'] = ucwords($_POST['title']);

    $request = db_query("
        UPDATE {$db_prefix}garage_track_conditions
        SET title = '".$_POST['title']."'
        WHERE id = ".$_POST['tcid'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=tracks');
    header('Location: '.$_POST['redirecturl']);
    
}

// Delete track condition
function DeleteTrackCondition()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    require_once('Subs-Post.php');
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
    checkSession('get');
    
    // Get the conditions field_order
    $request = db_query("
        SELECT field_order
        FROM {$db_prefix}garage_track_conditions
        WHERE id = ".$_GET['TCID'],__FILE__,__LINE__);
    $row = mysql_fetch_assoc($request);
    mysql_free_result($request);
    
    // Fix the field order for any above the to be deleted condition
    $request = db_query("
        SELECT id, field_order
        FROM {$db_prefix}garage_track_conditions
        WHERE field_order > ".$row['field_order'],__FILE__,__LINE__);
    while($field_order = mysql_fetch_assoc($request)) {
        $newFieldOrder = $field_order['field_order'] - 1;
        $request2 = db_query("
            UPDATE {$db_prefix}garage_track_conditions
            SET field_order = ".$newFieldOrder."
            WHERE id = ".$field_order['id'],__FILE__,__LINE__);
    }
    mysql_free_result($request);
    
    // Delete the condition
    $request = db_query("
        DELETE FROM {$db_prefix}garage_track_conditions
        WHERE id = ".$_GET['TCID'],__FILE__,__LINE__);
    
    // Get an existing condition id
    $request = db_query("
        SELECT id AS condition_id
        FROM {$db_prefix}garage_track_conditions
        LIMIT 1",__FILE__,__LINE__);
    $row = mysql_fetch_assoc($request);
    $default_condition = $row['condition_id'];
    mysql_free_result($request);
    
    // Find any laps with this condition, and set them to an existing one
    $request = db_query("
        SELECT l.id, v.user_id
        FROM {$db_prefix}garage_laps AS l, {$db_prefix}garage_vehicles AS v
        WHERE condition_id = ".$_GET['TCID']."
            AND l.vehicle_id = v.id",__FILE__,__LINE__);
    while($row = mysql_fetch_assoc($request)) {    
        $request2 = db_query("
            UPDATE {$db_prefix}garage_laps
            SET condition_id = ".$default_condition."
            WHERE id = ".$row['id'],__FILE__,__LINE__);
        
        // Send a notification to the user        
        //$recipients['to'] = array($row['user_id']);
        //$recipients['bcc'] = '';
        $recipients = array(
            'to' => array($row['user_id']),
            'bcc' => array()
        );
        
        if (!empty($recipients['to']) || !empty($recipients['bcc']))
            $context['send_log'] = sendpm($recipients, $txt['smfg_condition_removed_subject'], $txt['smfg_condition_removed_PM'], false);
        else
            $context['send_log'] = array(
                'sent' => array(),
                'failed' => array()
            );
    }
    mysql_free_result($request); 
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Modify track conditions field_order
function MoveTrackCondition()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
    checkSession('get');
    
    if($_GET['direction'] == 'up') {
        
        // Find our target order
        $context['target_order'] = $_GET['order'] - 1;
        
    } else if($_GET['direction'] == 'down') {
        
        // Find our target order
        $context['target_order'] = $_GET['order'] + 1;
        
    }
    
    // Get the target order's ID
    $request = db_query("
        SELECT id
        FROM {$db_prefix}garage_track_conditions
        WHERE field_order = ".$context['target_order'],__FILE__,__LINE__);
    list($context['target_id']) = mysql_fetch_row($request);
    mysql_free_result($request);
            
    // First set our target to the current order
    $request = db_query("
        UPDATE {$db_prefix}garage_track_conditions
        SET field_order = ".$_GET['order']."
        WHERE id = ".$context['target_id'],__FILE__,__LINE__);
        
    // Then set our current category to the target order
    $request = db_query("
        UPDATE {$db_prefix}garage_track_conditions
        SET field_order = ".$context['target_order']."
        WHERE id = ".$_GET['TCID'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=tracks');
    header('Location: '.$_POST['redirecturl']);
    
}

// Add lap type
function AddLapType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
    // Validate the session
    checkSession();
    
    $request = db_query("
        SELECT id
        FROM {$db_prefix}garage_lap_types",__FILE__,__LINE__);
    $context['lt']['total'] = mysql_num_rows($request);
    mysql_free_result($request);
    
    $context['field_order'] = $context['lt']['total'] + 1;
    
    // Upper Case the Lap Type
    $_POST['lt'] = ucwords($_POST['lt']);

    $request = db_query("
        INSERT INTO {$db_prefix}garage_lap_types (title, field_order)
        VALUES ('".$_POST['lt']."', '".$context['field_order']."')",__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=tracks');
    header('Location: '.$_POST['redirecturl']);
    
}

// Edit a lap type
function EditLapType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'edit_lap_type';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
    $request = db_query("
        SELECT id, title
        FROM {$db_prefix}garage_lap_types
        WHERE id = ".$_GET['LTID'],__FILE__,__LINE__);
    list($context['lt']['id'],
         $context['lt']['title']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
}

// Update lap type
function UpdateLapType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
    // Validate the session
    checkSession();
    
    // Upper Case the Lap Type title
    $_POST['title'] = ucwords($_POST['title']);

    $request = db_query("
        UPDATE {$db_prefix}garage_lap_types
        SET title = '".$_POST['title']."'
        WHERE id = ".$_POST['ltid'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=tracks');
    header('Location: '.$_POST['redirecturl']);
    
}

// Delete lap type
function DeleteLapType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    require_once('Subs-Post.php');
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
    checkSession('get');
    
    // Get the lap types field_order
    $request = db_query("
        SELECT field_order
        FROM {$db_prefix}garage_lap_types
        WHERE id = ".$_GET['LTID'],__FILE__,__LINE__);
    $row = mysql_fetch_assoc($request);
    mysql_free_result($request);
    
    // Fix the field order for any above the to be deleted lap type
    $request = db_query("
        SELECT id, field_order
        FROM {$db_prefix}garage_lap_types
        WHERE field_order > ".$row['field_order'],__FILE__,__LINE__);
    while($field_order = mysql_fetch_assoc($request)) {
        $newFieldOrder = $field_order['field_order'] - 1;
        $request2 = db_query("
            UPDATE {$db_prefix}garage_lap_types
            SET field_order = ".$newFieldOrder."
            WHERE id = ".$field_order['id'],__FILE__,__LINE__);
    }
    mysql_free_result($request);
    
    // Delete the lap type
    $request = db_query("
        DELETE FROM {$db_prefix}garage_lap_types
        WHERE id = ".$_GET['LTID'],__FILE__,__LINE__);
    
    // Get an existing lap type id
    $request = db_query("
        SELECT id AS lap_type_id
        FROM {$db_prefix}garage_lap_types
        LIMIT 1",__FILE__,__LINE__);
    $row = mysql_fetch_assoc($request);
    $default_lap_type = $row['lap_type_id'];
    mysql_free_result($request);
    
    // Find any laps with this lap type, and set them to an existing one
    $request = db_query("
        SELECT l.id, v.user_id
        FROM {$db_prefix}garage_laps AS l, {$db_prefix}garage_vehicles AS v
        WHERE type_id = ".$_GET['LTID']."
            AND l.vehicle_id = v.id",__FILE__,__LINE__);
    while($row = mysql_fetch_assoc($request)) {    
        $request2 = db_query("
            UPDATE {$db_prefix}garage_laps
            SET type_id = ".$default_lap_type."
            WHERE id = ".$row['id'],__FILE__,__LINE__);
        
        // Send a notification to the user        
        //$recipients['to'] = array($row['user_id']);
        //$recipients['bcc'] = '';
        $recipients = array(
            'to' => array($row['user_id']),
            'bcc' => array()
        );
        
        if (!empty($recipients['to']) || !empty($recipients['bcc']))
            $context['send_log'] = sendpm($recipients, $txt['smfg_lap_type_removed_subject'], $txt['smfg_lap_type_removed_PM'], false);
        else
            $context['send_log'] = array(
                'sent' => array(),
                'failed' => array()
            );
    }
    mysql_free_result($request);    
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Modify lap types field_order
function MoveLapType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_tracks');
    
    checkSession('get');
    
    if($_GET['direction'] == 'up') {
        
        // Find our target order
        $context['target_order'] = $_GET['order'] - 1;
        
    } else if($_GET['direction'] == 'down') {
        
        // Find our target order
        $context['target_order'] = $_GET['order'] + 1;
        
    }
    
    // Get the target order's ID
    $request = db_query("
        SELECT id
        FROM {$db_prefix}garage_lap_types
        WHERE field_order = ".$context['target_order'],__FILE__,__LINE__);
    list($context['target_id']) = mysql_fetch_row($request);
    mysql_free_result($request);
            
    // First set our target to the current order
    $request = db_query("
        UPDATE {$db_prefix}garage_lap_types
        SET field_order = ".$_GET['order']."
        WHERE id = ".$context['target_id'],__FILE__,__LINE__);
        
    // Then set our current category to the target order
    $request = db_query("
        UPDATE {$db_prefix}garage_lap_types
        SET field_order = ".$context['target_order']."
        WHERE id = ".$_GET['LTID'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=tracks');
    header('Location: '.$_POST['redirecturl']);
    
}

// Let the administrator(s) edit the news.
function ManageOther()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'other';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    $request = db_query("
        SELECT id, title, field_order
        FROM {$db_prefix}garage_premium_types
        ORDER BY field_order ASC",__FILE__,__LINE__);
        $count = 0;
        while($row = mysql_fetch_row($request)) {
            list($context['premiumtypes'][$count]['id'],
                 $context['premiumtypes'][$count]['title'],
                 $context['premiumtypes'][$count]['field_order']) = $row;
            $count++;   
        }
    $context['premiumtypes']['total'] = mysql_num_rows($request);
    mysql_free_result($request);
        
    $request = db_query("
        SELECT id, title, field_order
        FROM {$db_prefix}garage_engine_types
        ORDER BY field_order ASC",__FILE__,__LINE__);
        $count = 0;
        while($row = mysql_fetch_row($request)) {
            list($context['enginetypes'][$count]['id'],
                 $context['enginetypes'][$count]['title'],
                 $context['enginetypes'][$count]['field_order']) = $row;
            $count++;   
        }
    $context['enginetypes']['total'] = mysql_num_rows($request);
    mysql_free_result($request);
        
    $request = db_query("
        SELECT id, title, field_order
        FROM {$db_prefix}garage_service_types
        ORDER BY field_order ASC",__FILE__,__LINE__);
        $count = 0;
        while($row = mysql_fetch_row($request)) {
            list($context['servicetypes'][$count]['id'],
                 $context['servicetypes'][$count]['title'],
                 $context['servicetypes'][$count]['field_order']) = $row;
            $count++;   
        }
    $context['servicetypes']['total'] = mysql_num_rows($request);
    mysql_free_result($request);
        
    $request = db_query("
        SELECT id, title, field_order
        FROM {$db_prefix}garage_currency
        ORDER BY field_order ASC",__FILE__,__LINE__);
        $count = 0;
        while($row = mysql_fetch_row($request)) {
            list($context['currencytypes'][$count]['id'],
                 $context['currencytypes'][$count]['title'],
                 $context['currencytypes'][$count]['field_order']) = $row;
            $count++;   
        }
    $context['currencytypes']['total'] = mysql_num_rows($request);
    mysql_free_result($request);
    
}

// Add premium type
function AddPremiumType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    // Validate the session
    checkSession();
    
    $request = db_query("
        SELECT id
        FROM {$db_prefix}garage_premium_types",__FILE__,__LINE__);
    $context['pt']['total'] = mysql_num_rows($request);
    mysql_free_result($request);
    
    $context['field_order'] = $context['pt']['total'] + 1;
    
    // Upper Case the Premium Type
    $_POST['pt'] = ucwords($_POST['pt']);

    $request = db_query("
        INSERT INTO {$db_prefix}garage_premium_types (title, field_order)
        VALUES ('".$_POST['pt']."', '".$context['field_order']."')",__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=other');
    header('Location: '.$_POST['redirecturl']);
    
}

// Edit a premium type
function EditPremiumType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'edit_premium_type';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    $request = db_query("
        SELECT id, title
        FROM {$db_prefix}garage_premium_types
        WHERE id = ".$_GET['PTID'],__FILE__,__LINE__);
    list($context['pt']['id'],
         $context['pt']['title']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
}

// Update premium type
function UpdatePremiumType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    // Validate the session
    checkSession();
    
    // Upper Case the Premium Type title
    $_POST['title'] = ucwords($_POST['title']);

    $request = db_query("
        UPDATE {$db_prefix}garage_premium_types
        SET title = '".$_POST['title']."'
        WHERE id = ".$_POST['ptid'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=other');
    header('Location: '.$_POST['redirecturl']);
    
}

// Delete premium type
function DeletePremiumType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    require_once('Subs-Post.php');
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    checkSession('get');
    
    // Get the premium types field_order
    $request = db_query("
        SELECT field_order
        FROM {$db_prefix}garage_premium_types
        WHERE id = ".$_GET['PTID'],__FILE__,__LINE__);
    $row = mysql_fetch_assoc($request);
    mysql_free_result($request);
    
    // Fix the field order for any above the to be deleted premium type
    $request = db_query("
        SELECT id, field_order
        FROM {$db_prefix}garage_premium_types
        WHERE field_order > ".$row['field_order'],__FILE__,__LINE__);
    while($field_order = mysql_fetch_assoc($request)) {
        $newFieldOrder = $field_order['field_order'] - 1;
        $request2 = db_query("
            UPDATE {$db_prefix}garage_premium_types
            SET field_order = ".$newFieldOrder."
            WHERE id = ".$field_order['id'],__FILE__,__LINE__);
        mysql_free_result($request2);
    }
    mysql_free_result($request);
    
    // Delete the premium_type
    $request = db_query("
        DELETE FROM {$db_prefix}garage_premium_types
        WHERE id = ".$_GET['PTID'],__FILE__,__LINE__);
    
    // Get an existing premium type id
    $request = db_query("
        SELECT id AS premium_type_id
        FROM {$db_prefix}garage_premium_types
        LIMIT 1",__FILE__,__LINE__);
    $row = mysql_fetch_assoc($request);
    $default_premium_type = $row['premium_type_id'];
    mysql_free_result($request);
    
    // Find any premiums with this premium type, and set them to an existing one
    $request = db_query("
        SELECT p.id, v.user_id
        FROM {$db_prefix}garage_premiums AS p, {$db_prefix}garage_vehicles AS v
        WHERE cover_type_id = ".$_GET['PTID']."
            AND p.vehicle_id = v.id",__FILE__,__LINE__);
    while($row = mysql_fetch_assoc($request)) {    
        $request2 = db_query("
            UPDATE {$db_prefix}garage_premiums
            SET cover_type_id = ".$default_premium_type."
            WHERE id = ".$row['id'],__FILE__,__LINE__);
        
        // Send a notification to the user        
        //$recipients['to'] = array($row['user_id']);
        //$recipients['bcc'] = '';
        $recipients = array(
            'to' => array($row['user_id']),
            'bcc' => array()
        );
        
        if (!empty($recipients['to']) || !empty($recipients['bcc']))
            $context['send_log'] = sendpm($recipients, $txt['smfg_premium_type_removed_subject'], $txt['smfg_premium_type_removed_PM'], false);
        else
            $context['send_log'] = array(
                'sent' => array(),
                'failed' => array()
            );
    }
    mysql_free_result($request);  
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Modify premium types field_order
function MovePremiumType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    checkSession('get');
    
    if($_GET['direction'] == 'up') {
        
        // Find our target order
        $context['target_order'] = $_GET['order'] - 1;
        
    } else if($_GET['direction'] == 'down') {
        
        // Find our target order
        $context['target_order'] = $_GET['order'] + 1;
        
    }
    
    // Get the target order's ID
    $request = db_query("
        SELECT id
        FROM {$db_prefix}garage_premium_types
        WHERE field_order = ".$context['target_order'],__FILE__,__LINE__);
    list($context['target_id']) = mysql_fetch_row($request);
    mysql_free_result($request);
            
    // First set our target to the current order
    $request = db_query("
        UPDATE {$db_prefix}garage_premium_types
        SET field_order = ".$_GET['order']."
        WHERE id = ".$context['target_id'],__FILE__,__LINE__);
        
    // Then set our current category to the target order
    $request = db_query("
        UPDATE {$db_prefix}garage_premium_types
        SET field_order = ".$context['target_order']."
        WHERE id = ".$_GET['PTID'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=other');
    header('Location: '.$_POST['redirecturl']);
    
}

// Add engine type
function AddEngineType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    // Validate the session
    checkSession();
    
    $request = db_query("
        SELECT id
        FROM {$db_prefix}garage_engine_types",__FILE__,__LINE__);
    $context['et']['total'] = mysql_num_rows($request);
    mysql_free_result($request);
    
    $context['field_order'] = $context['et']['total'] + 1;
    
    // Upper Case the Engine Type
    $_POST['et'] = ucwords($_POST['et']);

    $request = db_query("
        INSERT INTO {$db_prefix}garage_engine_types (title, field_order)
        VALUES ('".$_POST['et']."', ".$context['field_order'].")",__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=other');
    header('Location: '.$_POST['redirecturl']);
    
}

// Edit a engine type
function EditEngineType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'edit_engine_type';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    $request = db_query("
        SELECT id, title
        FROM {$db_prefix}garage_engine_types
        WHERE id = ".$_GET['ETID'],__FILE__,__LINE__);
    list($context['et']['id'],
         $context['et']['title']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
}

// Update engine type
function UpdateEngineType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    // Validate the session
    checkSession();
    
    // Upper Case the Engine Type Title
    $_POST['title'] = ucwords($_POST['title']);

    $request = db_query("
        UPDATE {$db_prefix}garage_engine_types
        SET title = '".$_POST['title']."'
        WHERE id = ".$_POST['etid'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=other');
    header('Location: '.$_POST['redirecturl']);
    
}

// Delete engine type
function DeleteEngineType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    require_once('Subs-Post.php');
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    checkSession('get');
    
    // Get the engine types field_order
    $request = db_query("
        SELECT field_order
        FROM {$db_prefix}garage_engine_types
        WHERE id = ".$_GET['ETID'],__FILE__,__LINE__);
    $row = mysql_fetch_assoc($request);
    mysql_free_result($request);
    
    // Fix the field order for any above the to be deleted engine type
    $request = db_query("
        SELECT id, field_order
        FROM {$db_prefix}garage_engine_types
        WHERE field_order > ".$row['field_order'],__FILE__,__LINE__);
    while($field_order = mysql_fetch_assoc($request)) {
        $newFieldOrder = $field_order['field_order'] - 1;
        $request2 = db_query("
            UPDATE {$db_prefix}garage_engine_types
            SET field_order = ".$newFieldOrder."
            WHERE id = ".$field_order['id'],__FILE__,__LINE__);
    }
    mysql_free_result($request);
    
    // Delete the engine type
    $request = db_query("
        DELETE FROM {$db_prefix}garage_engine_types
        WHERE id = ".$_GET['ETID'],__FILE__,__LINE__);
    
    // Get an existing engine type id
    $request = db_query("
        SELECT id AS engine_type_id
        FROM {$db_prefix}garage_engine_types
        LIMIT 1",__FILE__,__LINE__);
    $row = mysql_fetch_assoc($request);
    $default_engine_type = $row['engine_type_id'];
    mysql_free_result($request);
    
    // Find any vehicles with this engine type, and set them to an existing one
    $request = db_query("
        SELECT id, user_id
        FROM {$db_prefix}garage_vehicles
        WHERE engine_type = ".$_GET['ETID'],__FILE__,__LINE__);
    while($row = mysql_fetch_assoc($request)) {    
        $request2 = db_query("
            UPDATE {$db_prefix}garage_vehicles
            SET engine_type = ".$default_engine_type."
            WHERE id = ".$row['id'],__FILE__,__LINE__);
        
        // Send a notification to the user        
        //$recipients['to'] = array($row['user_id']);
        //$recipients['bcc'] = '';
        $recipients = array(
            'to' => array($row['user_id']),
            'bcc' => array()
        );
        
        if (!empty($recipients['to']) || !empty($recipients['bcc']))
            $context['send_log'] = sendpm($recipients, $txt['smfg_engine_type_removed_subject'], $txt['smfg_engine_type_removed_PM'], false);
        else
            $context['send_log'] = array(
                'sent' => array(),
                'failed' => array()
            );
    }
    mysql_free_result($request);  
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Modify engine types field_order
function MoveEngineType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    checkSession('get');
    
    if($_GET['direction'] == 'up') {
        
        // Find our target order
        $context['target_order'] = $_GET['order'] - 1;
        
    } else if($_GET['direction'] == 'down') {
        
        // Find our target order
        $context['target_order'] = $_GET['order'] + 1;
        
    }
    
    // Get the target order's ID
    $request = db_query("
        SELECT id
        FROM {$db_prefix}garage_engine_types
        WHERE field_order = ".$context['target_order'],__FILE__,__LINE__);
    list($context['target_id']) = mysql_fetch_row($request);
    mysql_free_result($request);
            
    // First set our target to the current order
    $request = db_query("
        UPDATE {$db_prefix}garage_engine_types
        SET field_order = ".$_GET['order']."
        WHERE id = ".$context['target_id'],__FILE__,__LINE__);
        
    // Then set our current category to the target order
    $request = db_query("
        UPDATE {$db_prefix}garage_engine_types
        SET field_order = ".$context['target_order']."
        WHERE id = ".$_GET['ETID'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=other');
    header('Location: '.$_POST['redirecturl']);
    
}

// Add service type
function AddServiceType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    // Validate the session
    checkSession();
    
    $request = db_query("
        SELECT id
        FROM {$db_prefix}garage_service_types",__FILE__,__LINE__);
    $context['st']['total'] = mysql_num_rows($request);
    mysql_free_result($request);
    
    $context['field_order'] = $context['st']['total'] + 1;
    
    // Upper Case the Service Type
    $_POST['st'] = ucwords($_POST['st']);

    $request = db_query("
        INSERT INTO {$db_prefix}garage_service_types (title, field_order)
        VALUES ('".$_POST['st']."', ".$context['field_order'].")",__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=other');
    header('Location: '.$_POST['redirecturl']);
    
}

// Edit a service type
function EditServiceType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'edit_service_type';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    $request = db_query("
        SELECT id, title
        FROM {$db_prefix}garage_service_types
        WHERE id = ".$_GET['STID'],__FILE__,__LINE__);
    list($context['st']['id'],
         $context['st']['title']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
}

// Update service type
function UpdateServiceType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    // Validate the session
    checkSession();
    
    // Upper Case the Service Type title
    $_POST['title'] = ucwords($_POST['title']);

    $request = db_query("
        UPDATE {$db_prefix}garage_service_types
        SET title = '".$_POST['title']."'
        WHERE id = ".$_POST['stid'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=other');
    header('Location: '.$_POST['redirecturl']);
    
}

// Delete service type
function DeleteServiceType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    require_once('Subs-Post.php');
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    checkSession('get');
    
    // Get the service types field_order
    $request = db_query("
        SELECT field_order
        FROM {$db_prefix}garage_service_types
        WHERE id = ".$_GET['STID'],__FILE__,__LINE__);
    $row = mysql_fetch_assoc($request);
    mysql_free_result($request);
    
    // Fix the field order for any above the to be deleted service type
    $request = db_query("
        SELECT id, field_order
        FROM {$db_prefix}garage_service_types
        WHERE field_order > ".$row['field_order'],__FILE__,__LINE__);
    while($field_order = mysql_fetch_assoc($request)) {
        $newFieldOrder = $field_order['field_order'] - 1;
        $request2 = db_query("
            UPDATE {$db_prefix}garage_service_types
            SET field_order = ".$newFieldOrder."
            WHERE id = ".$field_order['id'],__FILE__,__LINE__);
    }
    mysql_free_result($request);
    
    // Delete the service type
    $request = db_query("
        DELETE FROM {$db_prefix}garage_service_types
        WHERE id = ".$_GET['STID'],__FILE__,__LINE__);
    
    // Get an existing service type id
    $request = db_query("
        SELECT id AS service_type_id
        FROM {$db_prefix}garage_service_types
        LIMIT 1",__FILE__,__LINE__);
    $row = mysql_fetch_assoc($request);
    $default_service_type = $row['service_type_id'];
    mysql_free_result($request);
    
    // Find any services with this service type, and set them to an existing one
    $request = db_query("
        SELECT s.id, v.user_id
        FROM {$db_prefix}garage_service_history AS s, {$db_prefix}garage_vehicles AS v
        WHERE type_id = ".$_GET['STID']."
            AND s.vehicle_id = v.id",__FILE__,__LINE__);
    while($row = mysql_fetch_assoc($request)) {    
        $request2 = db_query("
            UPDATE {$db_prefix}garage_service_history
            SET type_id = ".$default_service_type."
            WHERE id = ".$row['id'],__FILE__,__LINE__);
        
        // Send a notification to the user        
        //$recipients['to'] = array($row['user_id']);
        //$recipients['bcc'] = '';
        $recipients = array(
            'to' => array($row['user_id']),
            'bcc' => array()
        );
        
        if (!empty($recipients['to']) || !empty($recipients['bcc']))
            $context['send_log'] = sendpm($recipients, $txt['smfg_service_type_removed_subject'], $txt['smfg_service_type_removed_PM'], false);
        else
            $context['send_log'] = array(
                'sent' => array(),
                'failed' => array()
            );
    }
    mysql_free_result($request);  
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Modify service types field_order
function MoveServiceType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    checkSession('get');
    
    if($_GET['direction'] == 'up') {
        
        // Find our target order
        $context['target_order'] = $_GET['order'] - 1;
        
    } else if($_GET['direction'] == 'down') {
        
        // Find our target order
        $context['target_order'] = $_GET['order'] + 1;
        
    }
    
    // Get the target order's ID
    $request = db_query("
        SELECT id
        FROM {$db_prefix}garage_service_types
        WHERE field_order = ".$context['target_order'],__FILE__,__LINE__);
    list($context['target_id']) = mysql_fetch_row($request);
    mysql_free_result($request);
            
    // First set our target to the current order
    $request = db_query("
        UPDATE {$db_prefix}garage_service_types
        SET field_order = ".$_GET['order']."
        WHERE id = ".$context['target_id'],__FILE__,__LINE__);
        
    // Then set our current category to the target order
    $request = db_query("
        UPDATE {$db_prefix}garage_service_types
        SET field_order = ".$context['target_order']."
        WHERE id = ".$_GET['STID'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=other');
    header('Location: '.$_POST['redirecturl']);
    
}

// Add currency type
function AddCurrencyType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    // Validate the session
    checkSession();
    
    $request = db_query("
        SELECT id
        FROM {$db_prefix}garage_currency",__FILE__,__LINE__);
    $context['ct']['total'] = mysql_num_rows($request);
    mysql_free_result($request);
    
    $context['field_order'] = $context['ct']['total'] + 1;
    
    // Upper Case the Currency Type
    $_POST['ct'] = ucwords($_POST['ct']);

    $request = db_query("
        INSERT INTO {$db_prefix}garage_currency (title, field_order)
        VALUES ('".$_POST['ct']."', ".$context['field_order'].")",__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=other');
    header('Location: '.$_POST['redirecturl']);
    
}

// Edit a currency type
function EditCurrencyType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'edit_currency_type';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    $request = db_query("
        SELECT id, title
        FROM {$db_prefix}garage_currency
        WHERE id = ".$_GET['CTID'],__FILE__,__LINE__);
    list($context['ct']['id'],
         $context['ct']['title']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
}

// Update currency type
function UpdateCurrencyType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    // Validate the session
    checkSession();
    
    // Upper Case the Currency Type title
    $_POST['title'] = ucwords($_POST['title']);

    $request = db_query("
        UPDATE {$db_prefix}garage_currency
        SET title = '".$_POST['title']."'
        WHERE id = ".$_POST['ctid'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=other');
    header('Location: '.$_POST['redirecturl']);
    
}

// Delete currency type
function DeleteCurrencyType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    require_once('Subs-Post.php');
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    checkSession('get');
    
    // Get the currency types field_order
    $request = db_query("
        SELECT field_order
        FROM {$db_prefix}garage_currency
        WHERE id = ".$_GET['CTID'],__FILE__,__LINE__);
    $row = mysql_fetch_assoc($request);
    mysql_free_result($request);
    
    // Fix the field order for any above the to be deleted currency type
    $request = db_query("
        SELECT id, field_order
        FROM {$db_prefix}garage_currency
        WHERE field_order > ".$row['field_order'],__FILE__,__LINE__);
    while($field_order = mysql_fetch_assoc($request)) {
        $newFieldOrder = $field_order['field_order'] - 1;
        $request2 = db_query("
            UPDATE {$db_prefix}garage_currency
            SET field_order = ".$newFieldOrder."
            WHERE id = ".$field_order['id'],__FILE__,__LINE__);
    }
    mysql_free_result($request);
    
    // Delete the currency type
    $request = db_query("
        DELETE FROM {$db_prefix}garage_currency
        WHERE id = ".$_GET['CTID'],__FILE__,__LINE__);
    
    // Get an existing currency type id
    $request = db_query("
        SELECT id AS currency_type_id
        FROM {$db_prefix}garage_currency
        LIMIT 1",__FILE__,__LINE__);
    $row = mysql_fetch_assoc($request);
    $default_currency_type = $row['currency_type_id'];
    mysql_free_result($request);
    
    // Find any vehicles with this currency type, and set them to an existing one
    $request = db_query("
        SELECT id, user_id
        FROM {$db_prefix}garage_vehicles
        WHERE currency = ".$_GET['CTID'],__FILE__,__LINE__);
    while($row = mysql_fetch_assoc($request)) {    
        $request2 = db_query("
            UPDATE {$db_prefix}garage_vehicles
            SET currency = ".$default_currency_type."
            WHERE id = ".$row['id'],__FILE__,__LINE__);
        
        // Send a notification to the user        
        //$recipients['to'] = array($row['user_id']);
        //$recipients['bcc'] = '';
        $recipients = array(
            'to' => array($row['user_id']),
            'bcc' => array()
        );
        
        if (!empty($recipients['to']) || !empty($recipients['bcc']))
            $context['send_log'] = sendpm($recipients, $txt['smfg_currency_type_removed_subject'], $txt['smfg_currency_type_removed_PM'], false);
        else
            $context['send_log'] = array(
                'sent' => array(),
                'failed' => array()
            );
    }
    mysql_free_result($request);  
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Modify currency types field_order
function MoveCurrencyType()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_other');
    
    checkSession('get');
    
    if($_GET['direction'] == 'up') {
        
        // Find our target order
        $context['target_order'] = $_GET['order'] - 1;
        
    } else if($_GET['direction'] == 'down') {
        
        // Find our target order
        $context['target_order'] = $_GET['order'] + 1;
        
    }
    
    // Get the target order's ID
    $request = db_query("
        SELECT id
        FROM {$db_prefix}garage_currency
        WHERE field_order = ".$context['target_order'],__FILE__,__LINE__);
    list($context['target_id']) = mysql_fetch_row($request);
    mysql_free_result($request);
            
    // First set our target to the current order
    $request = db_query("
        UPDATE {$db_prefix}garage_currency
        SET field_order = ".$_GET['order']."
        WHERE id = ".$context['target_id'],__FILE__,__LINE__);
        
    // Then set our current category to the target order
    $request = db_query("
        UPDATE {$db_prefix}garage_currency
        SET field_order = ".$context['target_order']."
        WHERE id = ".$_GET['CTID'],__FILE__,__LINE__);
    
    //header('Location: '.$scripturl.'?action=garagemanagement;sa=other');
    header('Location: '.$_POST['redirecturl']);
    
}

// Garage Management Tools
function Tools()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info, $boarddir;
    global $func, $smfgSettings, $scripturl;
    
    // Set our index includes
    $context['mootools'] = 1;
    $context['smfg_ajax'] = 1;
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'tools';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_tools');
    
    // Get upload directory details
    $dir = $boarddir.'/'.$smfgSettings['upload_directory'];
    $context['dir_details'] = getDirectorySize($dir, 0);

    // Get cache directory details
    $cachedir = $dir.'cache/';
    $context['cachedir_details'] = getDirectorySize($cachedir, 0);
     
}

// Garage Management Tools (Image rebuilding)
function rebuildimages()
{
    global $boarddir, $smfgSettings, $ext, $db_prefix, $context;
    global $missing, $missingcount, $totalcount, $regencount;

    // Set upload directory
    $uploaddir = $boarddir.'/'.$smfgSettings['upload_directory'];
    $cachedir = $uploaddir.'cache/';

    // Counts for output page
    $missingcount = 0;
    $totalcount = 0;
    $regencount = 0;
    
    ignore_user_abort(TRUE);
    ini_set("max_execution_time", "120");
    
    echo "<b>Please wait: </b> The images are being rebuilt.  This may take a few minutes....<br /><br />"; 
    $context['smfg_debug'] = '';

    // Get a list of local images and remove the thumb and watermarked versions
    // then rebuild them one at a time, if the original is missing don't remove
    $request = db_query("
        SELECT attach_id, attach_location, attach_file, attach_thumb_location
        FROM {$db_prefix}garage_images
        WHERE is_remote != 1",__FILE__,__LINE__);
    while($row = mysql_fetch_assoc($request)) {  
    
        // Fix a little timeout issue
        set_time_limit(2);        
            
        $totalcount++;
        // Might still be a remote image that is stored, check for url
        if(!file_exists($uploaddir.$row['attach_location']) && !preg_match('/^http/', urldecode($row['attach_file']))) {
            $missing[] = $row['attach_location'];
            $missingcount++;
        } else {
            if(preg_match('/^http/', urldecode($row['attach_file'])) && !file_exists($uploaddir.$row['attach_location'])) {
                getRemoteImage(urldecode($row['attach_file']), $uploaddir.$row['attach_location']);
            }
            if(file_exists($uploaddir.$row['attach_location'])) {
                
                // DEBUG WILL STAY FOR BETA
                //start debug 
                echo '<div style="display: none;">&nbsp;</div>';
                $context['smfg_debug'] .= "Current File: ". $uploaddir.$row['attach_location'] ."<br />"; 
                flush(); 
                ob_flush(); 
                //end debug
                
                
                unlink($cachedir.$row['attach_location']);
                unlink($cachedir.$row['attach_thumb_location']);
                $ext = findexts($uploaddir.$row['attach_location']);
                make_thumbnail($row['attach_location'], $smfgSettings['store_remote_images_locally']);
                // Gather some new file attributes
                $thumb_sizes = getimagesize($cachedir.$row['attach_thumb_location']);
                $thumb_filesize = filesize($cachedir.$row['attach_thumb_location']);
                
                // DEBUG WILL STAY FOR BETA
                //start debug 
                $context['smfg_debug'] .= "NEW Thumb Width: ".$thumb_sizes[0]."<br />"; 
                $context['smfg_debug'] .= "NEW Thumb Height: ".$thumb_sizes[1]."<br />"; 
                $context['smfg_debug'] .= "NEW Thumb Filesize: ".$thumb_filesize."<br />"; 
                $context['smfg_debug'] .= "<br />"; 
                //end debug
                
                
                $request2 = db_query("
                    UPDATE {$db_prefix}garage_images 
                    SET attach_ext = '".$ext."', attach_thumb_width = ".$thumb_sizes[0].", attach_thumb_height = ".$thumb_sizes[1].", attach_thumb_filesize = ".$thumb_filesize."
                    WHERE attach_id = ".$row['attach_id'],__FILE__,__LINE__);
                $regencount++;
            } else {
                $missing[] = urldecode($row['attach_location']);
                $missingcount++;
            }
        }
    }
    mysql_free_result($request);

    // Get a list of remote images and remove the thumb and watermarked versions
    // then rebuild them one at a time, download and check image first incase
    // it's missing
    $request = db_query("
        SELECT attach_id, attach_location, attach_file, attach_thumb_location
        FROM {$db_prefix}garage_images
        WHERE is_remote = 1",__FILE__,__LINE__);
    while($row = mysql_fetch_assoc($request)) {  
    
        // Fix a little timeout issue
        set_time_limit(2);        
            
        $totalcount++;
        
        // First check if it the image is still there   
        if(url_validate($row['attach_location'])) {  
            
            $new_attach_name = substr($row['attach_thumb_location'], 0, -10);
            $ext = findexts($row['attach_file']);
            $new_attach_location = $new_attach_name.'.'.$ext;
            $target = $uploaddir.'temp_'.$new_attach_location;
            
            // DEBUG WILL STAY FOR BETA
            // BEGIN DEBUG
            echo '<div style="display: none;">&nbsp;</div>';
            $context['smfg_debug'] .= 'New Attach Name: '.$new_attach_name.'<br />';
            $context['smfg_debug'] .= 'New Attach Location: '.$new_attach_location.'<br />';
            $context['smfg_debug'] .= 'Attach Location: '.$row['attach_location'].'<br />';
            $context['smfg_debug'] .= 'Thumb Location: '.$cachedir.$row['attach_thumb_location'].'<br />';
            $context['smfg_debug'] .= 'Target: '.$target.'<br />';
            flush(); 
            ob_flush(); 
            // END DEBUG
            
            
            // If so, go get it
            getRemoteImage($row['attach_location'],$target);
            // Check for completion
            if(!file_exists($target)) {
                $missing[] = $row['attach_location'];
                $missingcount++;
            } else {
                // These don't need to be removed, if is_remote = 1
                // then the files do not exist here
                // Additionally, we would need to remove attach_location
                // instead of attach_file
                /*if($smfgSettings['store_remote_images_locally']) {
                    unlink($uploaddir.$row['attach_file']);
                    unlink($cachedir.$row['attach_file']);
                }*/
                unlink($cachedir.$row['attach_thumb_location']);

                //copy($uploaddir.'temp_'.$new_attach_location, $uploaddir.$new_attach_location);
                copy($target, $cachedir.$new_attach_location);
                $attach_filesize = filesize($target);
                
                // Make sure we keep up to date with current settings
                if($smfgSettings['store_remote_images_locally']){
                    $is_remote = 0;
                    copy($target, $uploaddir.$new_attach_location);
                } else {
                    $is_remote = 1;
                    unlink($cachedir.$new_attach_location);
                }         
                
                make_thumbnail($new_attach_location, $smfgSettings['store_remote_images_locally']);
                $thumb_filesize = filesize($cachedir.$row['attach_thumb_location']);
                $thumb_sizes = getimagesize($cachedir.$row['attach_thumb_location']);
                
                // DEBUG WILL STAY FOR BETA
                // BEGIN DEBUG
                $context['smfg_debug'] .= 'Filesize: '.$attach_filesize.'<br />';
                $context['smfg_debug'] .= 'Thumb Filesize: '.$thumb_filesize.'<br />';
                $context['smfg_debug'] .= 'Thumb Width: '.$thumb_sizes[0].'<br />';
                $context['smfg_debug'] .= 'Thumb Height: '.$thumb_sizes[1].'<br /><br />';     
                // END DEBUG  
                
                
                // Remove the temp image
                unlink($target);
                
                // Update the DB
                $request2 = db_query("
                    UPDATE {$db_prefix}garage_images 
                    SET attach_location = '".$new_attach_location."', attach_ext = '".$ext."', attach_thumb_width = ".$thumb_sizes[0].", attach_thumb_height = ".$thumb_sizes[1].", attach_filesize = ".$attach_filesize.", attach_thumb_filesize = ".$thumb_filesize.", is_remote = ".$is_remote."
                    WHERE attach_id = ".$row['attach_id'],__FILE__,__LINE__);
                $regencount++;
            }
        } else {
            $missing[] = $row['attach_location'];
            $missingcount++;
        }
    }
    mysql_free_result($request);
    
    echo '<b>Rebuild Complete.</b>';
}

// Garage Management Tools (Image rebuilding AJAX)
function RebuildImagesAjax()
{
    global $boarddir, $smfgSettings, $ext, $db_prefix, $context;
    global $settings, $txt, $scripturl;
    global $missing, $missingcount, $totalcount, $regencount;
    
    $context['sub_template'] = 'blank';

    // Counts for output page
    $missingcount = 0;
    $totalcount = 0;
    $regencount = 0;

    // Set upload directory
    $uploaddir = $boarddir.'/'.$smfgSettings['upload_directory'];
    $cachedir = $uploaddir.'cache/';
    
    echo "<SCRIPT LANGUAGE=\"JavaScript\">
          image1 = new Image();
          image1.src = '", $settings['default_images_url'], "/progress.gif';
          </script>\n";
    
    if($_GET['regen'] == "start"){
        echo "<div class='smalltext'><i>Image regeneration starting...</i></div>\n";
        
        // Get a list of local images and remove the thumb and watermarked versions
        // then rebuild them one at a time, if the original is missing don't remove
        $request = db_query("
            SELECT attach_id, attach_location, attach_file, attach_thumb_location
            FROM {$db_prefix}garage_images
            WHERE is_remote != 1",__FILE__,__LINE__);
        while($row = mysql_fetch_assoc($request)) {  
                
            $totalcount++;
            // Might still be a remote image that is stored, check for url
            if(!file_exists($uploaddir.$row['attach_location']) && !preg_match('/^http/', urldecode($row['attach_file']))) {
                // Display some useful debug info
                echo "<script type=\"text/javascript\">";
                echo "update_rebuild_status('".$scripturl."?action=garagemanagement;sa=rebuildimagesajax;regen=missing;file={$row['attach_location']};regenc={$regencount};total={$totalcount}');";
                echo "</script>\n";
                
                $missing[] = $row['attach_location'];
                $missingcount++;
            } else {
                if(preg_match('/^http/', urldecode($row['attach_file'])) && !file_exists($uploaddir.$row['attach_location'])) {
                    getRemoteImage(urldecode($row['attach_file']), $uploaddir.$row['attach_location']);
                }
                if(file_exists($uploaddir.$row['attach_location'])) {
                    
                    echo "<script type=\"text/javascript\">";
                    echo "update_rebuild_status('".$scripturl."?action=garagemanagement;sa=rebuildimagesajax;regen=rebuild;file={$row['attach_location']};regenc={$regencount};total={$totalcount}');";
                    echo "</script>\n";
                    
                    // Just slowing things down a bit
                    usleep(8000);                   
                    
                    unlink($cachedir.$row['attach_location']);
                    unlink($cachedir.$row['attach_thumb_location']);
                    $ext = findexts($uploaddir.$row['attach_location']);
                    make_thumbnail($row['attach_location'], $smfgSettings['store_remote_images_locally']);
                    
                    // Gather some new file attributes
                    $thumb_sizes = getimagesize($cachedir.$row['attach_thumb_location']);
                    $thumb_filesize = filesize($cachedir.$row['attach_thumb_location']);                   
                    
                    $request2 = db_query("
                        UPDATE {$db_prefix}garage_images 
                        SET attach_ext = '".$ext."', attach_thumb_width = ".$thumb_sizes[0].", attach_thumb_height = ".$thumb_sizes[1].", attach_thumb_filesize = ".$thumb_filesize."
                        WHERE attach_id = ".$row['attach_id'],__FILE__,__LINE__);
                    $regencount++;
                } else {
                    // Display some useful debug info
                    echo "<script type=\"text/javascript\">";
                    echo "update_rebuild_status('".$scripturl."?action=garagemanagement;sa=rebuildimagesajax;regen=missing;file={$row['attach_location']};regenc={$regencount};total={$totalcount}');";
                    echo "</script>\n";
                    
                    $missing[] = urldecode($row['attach_location']);
                    $missingcount++;
                }
            }
        }
        mysql_free_result($request);
        
        // Get a list of remote images and remove the thumb and watermarked versions
        // then rebuild them one at a time, download and check image first incase
        // it's missing
        $request = db_query("
            SELECT attach_id, attach_location, attach_file, attach_thumb_location
            FROM {$db_prefix}garage_images
            WHERE is_remote = 1",__FILE__,__LINE__);
        while($row = mysql_fetch_assoc($request)) {         
                
            $totalcount++;
            
            // First check if it the image is still there   
            if(url_validate(urldecode($row['attach_file']))) {  
                
                $new_attach_name = substr($row['attach_thumb_location'], 0, -10);
                $ext = findexts($row['attach_file']);
                $new_attach_location = $new_attach_name.'.'.$ext;
                $target = $uploaddir.'temp_'.$new_attach_location;
                
                //echo '<b>New Attach Name:</b> '.$new_attach_name;
                //echo '<br />';
                //echo '<b>New Attach Location:</b> '.$new_attach_location;
                //echo '<br />';
                
                echo "<script type=\"text/javascript\">";
                echo "update_rebuild_status('".$scripturl."?action=garagemanagement;sa=rebuildimagesajax;regen=rebuild;file={$row['attach_location']};regenc={$regencount};total={$totalcount}');";
                echo "</script>\n";
                
                // Just slowing things down a bit
                usleep(8000);               
                
                // If its there, go get it
                getRemoteImage(urldecode($row['attach_file']),$target);
                
                // Check for completion
                if(!file_exists($target)) {
                    // Display some useful debug info
                    echo "<script type=\"text/javascript\">";
                    echo "update_rebuild_status('".$scripturl."?action=garagemanagement;sa=rebuildimagesajax;regen=missing;file={$row['attach_location']};regenc={$regencount};total={$totalcount}');";
                    echo "</script>\n";
                    
                    $missing[] = $row['attach_location'];
                    $missingcount++;
                } else {
                    // These don't need to be removed, if is_remote = 1
                    // then the files do not exist here
                    // Additionally, we would need to remove attach_location
                    // instead of attach_file
                    /*if($smfgSettings['store_remote_images_locally']) {
                        unlink($uploaddir.$row['attach_file']);
                        unlink($cachedir.$row['attach_file']);
                    }*/
                    unlink($cachedir.$row['attach_thumb_location']);
                    
                    //echo '<b>Target:</b> '.$target;
                    //echo '<br />';
                    //echo '<b>Cache/New Attach Location:</b> '.$cachedir.$new_attach_location;

                    //copy($uploaddir.'temp_'.$new_attach_location, $uploaddir.$new_attach_location);
                    
                    // This replication to the temp_ file has been moved to the make_thumbnail
                    // function so it will work when new remotely stored images are added
                    //copy($target, $cachedir.$new_attach_location);
                    $attach_filesize = filesize($target);
                    
                    //echo '<br />';
                    //echo '<b>Attach filesize:</b> '.$attach_filesize;
                    
                    // Make sure we keep up to date with current settings
                    if($smfgSettings['store_remote_images_locally']){
                        $is_remote = 0;
                        copy($target, $uploaddir.$new_attach_location);
                    } else {
                        $is_remote = 1;
                        unlink($cachedir.$new_attach_location);
                    }  
                    
                    make_thumbnail($new_attach_location, $smfgSettings['store_remote_images_locally'], $is_remote);
                    $thumb_filesize = filesize($cachedir.$row['attach_thumb_location']);
                    $thumb_sizes = getimagesize($cachedir.$row['attach_thumb_location']);   
                    
                    // MOVED TO make_thumbnail().  So 'temp_' files are removed 
                    // in all instances.
                    // Remove the temp image
                    //unlink($target);
                    
                    // Update the DB
                    $request2 = db_query("
                        UPDATE {$db_prefix}garage_images 
                        SET attach_location = '".$new_attach_location."', attach_ext = '".$ext."', attach_thumb_width = ".$thumb_sizes[0].", attach_thumb_height = ".$thumb_sizes[1].", attach_filesize = ".$attach_filesize.", attach_thumb_filesize = ".$thumb_filesize.", is_remote = ".$is_remote."
                        WHERE attach_id = ".$row['attach_id'],__FILE__,__LINE__);
                    $regencount++;
                }
            } else {
                // Display some useful debug info
                echo "<script type=\"text/javascript\">";
                echo "update_rebuild_status('".$scripturl."?action=garagemanagement;sa=rebuildimagesajax;regen=missing;file={$row['attach_location']};regenc={$regencount};total={$totalcount}');";
                echo "</script>\n";
                
                $missing[] = $row['attach_location'];
                $missingcount++;
            }
        }
        mysql_free_result($request);
            
        echo "<script type=\"text/javascript\">";
        echo "update_rebuild_status('".$scripturl."?action=garagemanagement;sa=rebuildimagesajax;regen=complete;regenc={$regencount};missing={$missingcount};total={$totalcount}');";
        echo "</script>\n";
    } 
    // rebuild the image functions start here...
    else if($_GET['regen'] == "rebuild") {
        echo "<div class='smalltext'><i>Regenerating:</i> <b>{$_GET['file']}</b></div>";
        // progress bar... ;)
        $total_td = $_GET['regenc']/$_GET['total'];
        $total_td = $total_td*100;
        $total_td = round($total_td);
        $leftover_td = 100 - $total_td;
        echo "<table style=\"width: 300px; text-align: right; margin-left: auto; margin-right: auto; border: 1px solid #000000;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                <tbody>
                    <tr>
                        <td style=\"width: {$total_td}%; white-space: nowrap; background-image: url('", $settings['default_images_url'], "/progress.gif'); background-repeat: repeat; border: 1px solid #FFFFFF; color: #FFFFFF;\">{$total_td}%</td>
                        <td style=\"width: {$leftover_td}%; white-space: nowrap; background-color: #FFF;\" cellpadding=\"0\" cellspacing=\"0\">&nbsp;</td>
                    </tr>
                </tbody>
              </table>";
        echo "<div class='smalltext'><i>".$txt['smfg_take_moment']."</i></div>";
    } 
    // missing files?
    else if($_GET['regen'] == "missing") {
        echo "<i>Missing:</i> <b>{$_GET['file']}</b><br />";
    }
    // rebuild complete
    else if($_GET['regen'] == "complete") {
        echo "<div class='smalltext'><i>Regeneration completed.</i></div>";
        echo "<table style=\"width: 300px; text-align: right; margin-left: auto; margin-right: auto; border: 1px solid #000000;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                <tbody>
                    <tr>
                        <td style=\"width: 100%; white-space: nowrap; background-image: url('", $settings['default_images_url'], "/progress.gif'); background-repeat: repeat; border: 1px solid #FFFFFF; color: #FFFFFF;\">100%</td>
                        <td style=\"white-space: nowrap; background-color: #FFF;\" cellpadding=\"0\" cellspacing=\"0\"></td>
                    </tr>
                </tbody>
              </table>";
        // Show the total count summary
        echo "<div class='smalltext'>".str_replace(array('@regen@','@total@','@missing@'),array($_GET['regenc'],$_GET['total'],$_GET['missing']),$txt['smfg_regen_totals'])."</div>";
    }
    
    //ajax completes too quickly so I put these here for better results
    echo "<script type=\"text/javascript\">";
    echo "$('rebuild_form_submit').setProperty('disabled', false);\n$('rebuild_form_submit').setProperty('value', '".$txt['smfg_regen_images']."');    ";
    echo "</script>\n";
    
    // Exit so the template is not loaded.
    exit;
}

/*// Garage Management Tools (Image rebuilding AJAX)
function RebuildImagesAjax()
{
    global $boarddir, $smfgSettings, $ext, $db_prefix, $context;
    global $missing, $missingcount, $totalcount, $regencount;
    
    $context['sub_template'] = 'blank';
    
    if($_GET['regen'] == "start"){
        echo "<i>Image regeneration starting...</i><br />";
        
        $files = array("blah.jpg", "w00t.jpg", "quake101.jpg", "is.jpg", "awesome.jpg", "and.jpg", "stuff.jpg", "001.jpg", "002.jpg", "003.jpg", "004.jpg", "005.jpg", "006.jpg", "007.jpg", "008.jpg", "009.jpg", "010.jpg", "last_file.jpg");

        // update the ajax
        foreach ($files as $file) {
            echo "<script type=\"text/javascript\">";
            echo "update_rebuild_status('".$scripturl."?action=garagemanagement;sa=rebuildimagesajax;regen=rebuild;file={$file}');";
            echo "</script>\n";
            //debug..
            //flush();
            //ob_flush();
            //just slowing things down a bit
            usleep(8000);
        }        
        echo "<script type=\"text/javascript\">";
        echo "update_rebuild_status('".$scripturl."?action=garagemanagement;sa=rebuildimagesajax;regen=complete');";
        echo "</script>\n";
    } 
    // rebuild the image functions start here...
    else if($_GET['regen'] == "rebuild") {
        echo "<i>Regenerating:</i> <b>{$_GET['file']}</b><br />";
    }
    // rebuild complete
    else if($_GET['regen'] == "complete") {
        echo "<i>Regeneration completed.</i><br />";
    }    
    exit;
}*/

// Orphan Results
function OrphanResults()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info, $boarddir;
    global $func, $smfgSettings, $regen, $orphans, $entries, $missing, $scripturl;
    global $missingcount, $totalcount, $regencount;
    
    // Set our index includes
    $context['lightbox'] = 1;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'orphan_results';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_tools');
    
    // Validate session
    checkSession();

    // Old regen method
    // If regen all call that function first then come back to this
    //if($_POST['regencache'])
    //    rebuildimages();
    
    // Set upload directory
    $uploaddir = $boarddir.'/'.$smfgSettings['upload_directory'];
    $cachedir = $uploaddir.'cache/';
    $dirs = array($uploaddir, $cachedir);

    foreach($dirs as $dir) { 
        // Get all the existing original files
        $files = directoryToArray($dir, false);
    
        // Check each file for db entry
        foreach($files AS $file) {
            $request = db_query("
                SELECT attach_location
                FROM {$db_prefix}garage_images
                WHERE attach_location = '".$file."'
                    OR attach_thumb_location = '".$file."'",__FILE__,__LINE__);             
            $results = mysql_num_rows($request);
            // Orphan?  Push it to the $orphans array
            if($results <= 0) $orphans[] = $dir.$file;
            mysql_free_result($request);
        }
    }
    
    // Get all the db entries (Make sure we have all the originals)
    $request = db_query("
        SELECT attach_location
        FROM {$db_prefix}garage_images
        WHERE is_remote != 1",__FILE__,__LINE__);
    // Check for file existance....
    while($row = mysql_fetch_assoc($request)) {        
        // If a file doesnt exist, push it to the $entries array
        if(!file_exists($uploaddir.$row['attach_location'])) $entries[] = $row['attach_location'];
        // If processed file doesn't exist, push it to the $regen array
        if(!file_exists($cachedir.$row['attach_location'])) $regen[] = $row['attach_location'];
    }
    mysql_free_result($request);
}

// Optimize the Garage
function Optimize()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info, $boarddir;
    global $func, $smfgSettings, $scripturl, $ext;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_tools');
    
    // Validate session
    checkSession();
    
    // Assign upload directory
    $dir = $boarddir.'/'.$smfgSettings['upload_directory'];
    $cachedir = $dir.'cache/';
    
    // Assign appropriate arrays
    $missing = $_POST['missing_files'];
    $orphans = $_POST['orphaned_files'];
    $entries = $_POST['db_entries'];
    $regen = $_POST['db_regen'];
    
    // Any missing files?
    if(!empty($missing)) {
        foreach($missing AS $lost) {
            // Get image id for galleries
            $request = db_query("
                SELECT attach_id
                FROM {$db_prefix}garage_images
                WHERE attach_location = '".$lost."'",__FILE__,__LINE__);
            $row = mysql_fetch_assoc($request);
            mysql_free_result($request);
            
            // Remove any gallery entries
            $request = db_query("
                DELETE FROM {$db_prefix}garage_vehicles_gallery
                WHERE image_id = ".$row['attach_id']."
                    LIMIT 1",__FILE__,__LINE__);
            $request = db_query("
                DELETE FROM {$db_prefix}garage_modifications_gallery
                WHERE image_id = ".$row['attach_id']."
                    LIMIT 1",__FILE__,__LINE__);
            $request = db_query("
                DELETE FROM {$db_prefix}garage_dynoruns_gallery
                WHERE image_id = ".$row['attach_id']."
                    LIMIT 1",__FILE__,__LINE__);
            $request = db_query("
                DELETE FROM {$db_prefix}garage_quartermiles_gallery
                WHERE image_id = ".$row['attach_id']."
                    LIMIT 1",__FILE__,__LINE__);
            $request = db_query("
                DELETE FROM {$db_prefix}garage_laps_gallery
                WHERE image_id = ".$row['attach_id']."
                    LIMIT 1",__FILE__,__LINE__);          
            
            // Remove the db entry
            $request = db_query("
                DELETE FROM {$db_prefix}garage_images
                WHERE attach_location = '".$lost."'
                    LIMIT 1",__FILE__,__LINE__);
            
        }
    }
    
    // Any orphans?
    if(!empty($orphans)) {
        foreach($orphans AS $orphan) {
            unlink($orphan);
        }
    }
    
    // Any db entries?
    if(!empty($entries)) {
        foreach($entries AS $entry) {
            // Get image id for galleries
            $request = db_query("
                SELECT attach_id
                FROM {$db_prefix}garage_images
                WHERE attach_location = '".$entry."'
                    OR attach_thumb_location = '".$entry."'",__FILE__,__LINE__);
            $row = mysql_fetch_assoc($request);
            mysql_free_result($request);
            
            // Remove any gallery entries
            $request = db_query("
                DELETE FROM {$db_prefix}garage_vehicles_gallery
                WHERE image_id = ".$row['attach_id']."
                    LIMIT 1",__FILE__,__LINE__);
            $request = db_query("
                DELETE FROM {$db_prefix}garage_modifications_gallery
                WHERE image_id = ".$row['attach_id']."
                    LIMIT 1",__FILE__,__LINE__);
            $request = db_query("
                DELETE FROM {$db_prefix}garage_dynoruns_gallery
                WHERE image_id = ".$row['attach_id']."
                    LIMIT 1",__FILE__,__LINE__);
            $request = db_query("
                DELETE FROM {$db_prefix}garage_quartermiles_gallery
                WHERE image_id = ".$row['attach_id']."
                    LIMIT 1",__FILE__,__LINE__);
            $request = db_query("
                DELETE FROM {$db_prefix}garage_laps_gallery
                WHERE image_id = ".$row['attach_id']."
                    LIMIT 1",__FILE__,__LINE__);          
            
            // Remove the db entry
            $request = db_query("
                DELETE FROM {$db_prefix}garage_images
                WHERE attach_location = '".$entry."'
                    OR attach_thumb_location = '".$entry."'
                    LIMIT 1",__FILE__,__LINE__);
        }
        
    }

    // Any thumb/watermark entries?
    if(!empty($regen)) {
        foreach($regen AS $gen) {
            $ext = findexts($gen);
            make_thumbnail($gen, $smfgSettings['store_remote_images_locally']);
        }
    }
    
    header('Location: '.$scripturl.'?action=garagemanagement;sa=tools');   
    
}

// All Pending Items
function Pending()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'pending';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_management'];
    
    // Check Permissions
    isAllowedTo('manage_garage_pending');
    
    // Get pending vehicles
    $request = db_query("
        SELECT v.id, CONCAT_WS( ' ', v.made_year, mk.make, md.model) AS vehicle, v.user_id, u.realName
        FROM {$db_prefix}garage_vehicles AS v, {$db_prefix}members AS u, {$db_prefix}garage_makes AS mk, {$db_prefix}garage_models AS md 
        WHERE v.user_id = u.ID_MEMBER
            AND v.make_id = mk.id
            AND v.model_id = md.id
            AND v.pending = '1'",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['vehicles'][$count]['id'],
             $context['vehicles'][$count]['vehicle'],
             $context['vehicles'][$count]['owner_id'],
             $context['vehicles'][$count]['owner']) = $row;
        $count++;   
    }
    mysql_free_result($request);
    
    // Get pending modifications
    $request = db_query("
        SELECT m.id, v.id, CONCAT_WS( ' ', v.made_year, mk.make, md.model) AS vehicle, v.user_id, u.realName, p.title
        FROM {$db_prefix}garage_vehicles AS v, {$db_prefix}members AS u, {$db_prefix}garage_makes AS mk, {$db_prefix}garage_models AS md , {$db_prefix}garage_modifications AS m, {$db_prefix}garage_products AS p
        WHERE v.user_id = u.ID_MEMBER
            AND v.make_id = mk.id
            AND v.model_id = md.id
            AND m.vehicle_id = v.id
            AND m.product_id = p.id
            AND m.pending = '1'",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['mods'][$count]['id'],
             $context['mods'][$count]['vid'],
             $context['mods'][$count]['vehicle'],
             $context['mods'][$count]['owner_id'],
             $context['mods'][$count]['owner'],
             $context['mods'][$count]['modification']) = $row;
        $count++;   
    }
    mysql_free_result($request);
    
    // Get pending makes
    $request = db_query("
        SELECT id, make
        FROM {$db_prefix}garage_makes
        WHERE pending = '1'",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['makes'][$count]['id'],
             $context['makes'][$count]['make']) = $row;
        $count++;   
    }
    mysql_free_result($request);
    
    // Get pending models
    $request = db_query("
        SELECT md.id, mk.make, md.model
        FROM {$db_prefix}garage_makes AS mk, {$db_prefix}garage_models AS md
        WHERE md.make_id = mk.id
            AND md.pending = '1'",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['models'][$count]['id'],
             $context['models'][$count]['make'],
             $context['models'][$count]['model']) = $row;
        $count++;   
    }
    mysql_free_result($request);
    
    // Get pending quartermiles
    $request = db_query("
        SELECT q.id, v.id, CONCAT_WS( ' ', v.made_year, mk.make, md.model) AS vehicle, v.user_id, u.realName
        FROM {$db_prefix}garage_vehicles AS v, {$db_prefix}members AS u, {$db_prefix}garage_makes AS mk, {$db_prefix}garage_models AS md , {$db_prefix}garage_quartermiles AS q
        WHERE v.user_id = u.ID_MEMBER
            AND v.make_id = mk.id
            AND v.model_id = md.id
            AND q.vehicle_id = v.id
            AND q.pending = '1'",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['qmiles'][$count]['id'],
             $context['qmiles'][$count]['vid'],
             $context['qmiles'][$count]['vehicle'],
             $context['qmiles'][$count]['owner_id'],
             $context['qmiles'][$count]['owner']) = $row;
        $count++;   
    }
    mysql_free_result($request);
    
    // Get pending dynoruns
    $request = db_query("
        SELECT d.id, v.id, CONCAT_WS( ' ', v.made_year, mk.make, md.model) AS vehicle, v.user_id, u.realName
        FROM {$db_prefix}garage_vehicles AS v, {$db_prefix}members AS u, {$db_prefix}garage_makes AS mk, {$db_prefix}garage_models AS md , {$db_prefix}garage_dynoruns AS d
        WHERE v.user_id = u.ID_MEMBER
            AND v.make_id = mk.id
            AND v.model_id = md.id
            AND d.vehicle_id = v.id
            AND d.pending = '1'",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['dynoruns'][$count]['id'],
             $context['dynoruns'][$count]['vid'],
             $context['dynoruns'][$count]['vehicle'],
             $context['dynoruns'][$count]['owner_id'],
             $context['dynoruns'][$count]['owner']) = $row;
        $count++;   
    }
    mysql_free_result($request);
    
    // Get pending lap times
    $request = db_query("
        SELECT l.id, v.id, CONCAT_WS( ' ', v.made_year, mk.make, md.model) AS vehicle, v.user_id, u.realName
        FROM {$db_prefix}garage_vehicles AS v, {$db_prefix}members AS u, {$db_prefix}garage_makes AS mk, {$db_prefix}garage_models AS md , {$db_prefix}garage_laps AS l
        WHERE v.user_id = u.ID_MEMBER
            AND v.make_id = mk.id
            AND v.model_id = md.id
            AND l.vehicle_id = v.id
            AND l.pending = '1'",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['laps'][$count]['id'],
             $context['laps'][$count]['vid'],
             $context['laps'][$count]['vehicle'],
             $context['laps'][$count]['owner_id'],
             $context['laps'][$count]['owner']) = $row;
        $count++;   
    }
    mysql_free_result($request);
    
    // Get pending tracks
    $request = db_query("
        SELECT id, title
        FROM {$db_prefix}garage_tracks
        WHERE pending = '1'",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['tracks'][$count]['id'],
             $context['tracks'][$count]['track']) = $row;
        $count++;   
    }
    mysql_free_result($request);
    
    // Get pending businesses
    $request = db_query("
        SELECT id, title, insurance, garage, retail, product, dynocenter
        FROM {$db_prefix}garage_business
        WHERE pending = '1'",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['business'][$count]['id'],
             $context['business'][$count]['business'],
             $context['business'][$count]['insurance'],
             $context['business'][$count]['garage'],
             $context['business'][$count]['retail'],
             $context['business'][$count]['product'],
             $context['business'][$count]['dynocenter']) = $row;
             
        if($context['business'][$count]['insurance']) {
            $context['business'][$count]['type'] = 'Insurance';  
            $context['business'][$count]['lowertype'] = 'insurance';            
        }
        if($context['business'][$count]['garage']) {
            $context['business'][$count]['type'] = 'Garage';
            $context['business'][$count]['lowertype'] = 'garage';
        }
        if($context['business'][$count]['retail']) {
            $context['business'][$count]['type'] = 'Shop';
            $context['business'][$count]['lowertype'] = 'shop';
        }
        if($context['business'][$count]['product']) {
            $context['business'][$count]['type'] = 'Manufacturer';
            $context['business'][$count]['lowertype'] = 'manufacturer';
        }
        if($context['business'][$count]['dynocenter']) {
            $context['business'][$count]['type'] = 'Dynocenter';
            $context['business'][$count]['lowertype'] = 'dynocenter';
        }
        $count++;   
    }
    mysql_free_result($request);
    
    // Get pending products
    $request = db_query("
        SELECT p.id, p.title, c.title, b.title
        FROM {$db_prefix}garage_products AS p, {$db_prefix}garage_categories AS c, {$db_prefix}garage_business AS b
        WHERE p.category_id = c.id
            AND p.business_id = b.id
            AND p.pending = '1'",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['products'][$count]['id'],
             $context['products'][$count]['product'],
             $context['products'][$count]['category'],
             $context['products'][$count]['manufacturer']) = $row;
        $count++;   
    }
    mysql_free_result($request); 
    
    // Get pending guestbook comments
    $request = db_query("
        SELECT gb.id, gb.author_id, u.realName, v.id, CONCAT_WS( ' ', v.made_year, mk.make, md.model) AS vehicle
        FROM {$db_prefix}garage_guestbooks AS gb, {$db_prefix}garage_vehicles AS v, {$db_prefix}garage_makes AS mk, {$db_prefix}garage_models AS md, {$db_prefix}members AS u
        WHERE gb.vehicle_id = v.id
            AND v.make_id = mk.id
            AND v.model_id = md.id
            AND gb.author_id = u.ID_MEMBER
            AND gb.pending = '1'",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['comments'][$count]['id'],
             $context['comments'][$count]['author_id'],
             $context['comments'][$count]['author'],
             $context['comments'][$count]['vid'],
             $context['comments'][$count]['vehicle']) = $row;
        $count++;   
    }
    mysql_free_result($request); 
    
}

// Approve Vehicle
function ApproveVehicle()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_pending');
    
    checkSession('get');
    
    $request = db_query("
        UPDATE {$db_prefix}garage_vehicles
        SET pending = '0'
        WHERE id = ".$_GET['VID'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Approve Modificaiton
function ApproveModification()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_pending');
    
    checkSession('get');
    
    $request = db_query("
        UPDATE {$db_prefix}garage_modifications
        SET pending = '0'
        WHERE id = ".$_GET['MID'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Approve Quartermile
function ApproveQuartermile()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_pending');
    
    checkSession('get');
    
    $request = db_query("
        UPDATE {$db_prefix}garage_quartermiles
        SET pending = '0'
        WHERE id = ".$_GET['QID'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Approve Dynorun
function ApproveDynorun()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_pending');
    
    checkSession('get');
    
    $request = db_query("
        UPDATE {$db_prefix}garage_dynoruns
        SET pending = '0'
        WHERE id = ".$_GET['DID'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Approve Laptime
function ApproveLaptime()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_pending');
    
    checkSession('get');
    
    $request = db_query("
        UPDATE {$db_prefix}garage_laps
        SET pending = '0'
        WHERE id = ".$_GET['LID'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

// Approve Guestbook Comment
function Approve_Comment()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_pending');
    
    checkSession('get');
    
    $request = db_query("
        UPDATE {$db_prefix}garage_guestbooks
        SET pending = '0'
        WHERE id = ".$_GET['CID'],__FILE__,__LINE__);
    
    //header('Location: '.$_SESSION['old_url']);
    header('Location: '.$_POST['redirecturl']);
    
}

?>
