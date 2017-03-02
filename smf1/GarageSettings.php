<?php
/**********************************************************************************
* GarageSettings.php                                                              *
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
function GarageSettings()
{
	global $smfgSettings, $context, $txt, $scripturl, $db_prefix;
    
    if(isset($context['TPortal'])) {
        tp_hidebars();
    }

	// First, let's do a quick permissions check
	isAllowedTo('manage_garage_settings');
    
    // We need our functions!
    require_once('GarageFunctions.php');
    
    // Load settings
    loadSmfgConfig();

	// Administrative side bar, here we come!
	adminIndex('garage_settings');

	// This is gonna be needed...
    loadTemplate('GarageSettings');
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
		'general' => array('ManageGarage', 'manage_garage_general'),
        'updategeneral' => array('UpdateGeneral', 'manage_garage_general'),
        'notify_add' => array('AddNotify', 'manage_garage_general'),
        'notify_delete' => array('DeleteNotify', 'manage_garage_general'),
		'menusettings' => array('MenuSettings', 'manage_garage_menu'),
        'updatemenu' => array('UpdateMenu', 'manage_garage_menu'),
		'indexsettings' => array('IndexSettings', 'manage_garage_index'),
        'updateindex' => array('UpdateIndex', 'manage_garage_index'),
        'block_move' => array('MoveBlock', 'manage_garage_index'),
        'block_disable' => array('DisableBlock', 'manage_garage_index'),
        'block_enable' => array('EnableBlock', 'manage_garage_index'),
        'imagesettings' =>  array('ImageSettings', 'manage_garage_images'),
        'updateimage' => array('UpdateImage', 'manage_garage_images'),
        'videosettings' =>  array('VideoSettings', 'manage_garage_videos'),
        'updatevideo' => array('UpdateVideo', 'manage_garage_videos'),
        'modulesettings' => array('ModuleSettings', 'manage_garage_modules'),
        'updatemodule' => array('UpdateModule', 'manage_garage_modules'),
	);

	// Default to a sub action they have permission to
    if(allowedTo('manage_garage_general'))
        $_REQUEST['sa'] = !empty($_GET['sa']) ? $_GET['sa'] : 'general';
    else if(allowedTo('manage_garage_menu'))
        $_REQUEST['sa'] = !empty($_GET['sa']) ? $_GET['sa'] : 'menusettings';
    else if(allowedTo('manage_garage_index'))
        $_REQUEST['sa'] = !empty($_GET['sa']) ? $_GET['sa'] : 'indexsettings';
    else if(allowedTo('manage_garage_images'))
        $_REQUEST['sa'] = !empty($_GET['sa']) ? $_GET['sa'] : 'imagesettings';
    else if(allowedTo('manage_garage_videos'))
        $_REQUEST['sa'] = !empty($_GET['sa']) ? $_GET['sa'] : 'videosettings';
    else if(allowedTo('manage_garage_modules'))
        $_REQUEST['sa'] = !empty($_GET['sa']) ? $_GET['sa'] : 'modulesettings';

	// Have you got the proper permissions?
	isAllowedTo($subActions[$_REQUEST['sa']][1]);

	// Create the tabs for the template.
    $context['admin_tabs'] = array(
        'title' => $txt['smfg_garage'].' '.$txt['smfg_settings'],
        'help' => 'garage_settings',
        'description' => '',
        'tabs' => array(),
    );
    if (allowedTo('manage_garage_general'))
        $context['admin_tabs']['tabs'][] = array(
            'title' => $txt['smfg_general'],
            'description' => $txt['settings_general'],
            'href' => $scripturl . '?action=garagesettings',
            'is_selected' => $_REQUEST['sa'] == 'general',
        );
    if (allowedTo('manage_garage_menu'))
        $context['admin_tabs']['tabs'][] = array(
            'title' => $txt['smfg_menu'],
            'description' => $txt['settings_menu'],
            'href' => $scripturl . '?action=garagesettings;sa=menusettings',
            'is_selected' => $_REQUEST['sa'] == 'menusettings',
        );
    if (allowedTo('manage_garage_index'))
        $context['admin_tabs']['tabs'][] = array(
            'title' => $txt['smfg_index'],
            'description' => $txt['settings_index'],
            'href' => $scripturl . '?action=garagesettings;sa=indexsettings',
            'is_selected' => $_REQUEST['sa'] == 'indexsettings',
        );
    if (allowedTo('manage_garage_images'))
        $context['admin_tabs']['tabs'][] = array(
            'title' => $txt['smfg_images'],
            'description' => $txt['settings_images'],
            'href' => $scripturl . '?action=garagesettings;sa=imagesettings',
            'is_selected' => $_REQUEST['sa'] == 'imagesettings',
        );
    if (allowedTo('manage_garage_videos'))
        $context['admin_tabs']['tabs'][] = array(
            'title' => $txt['smfg_videos'],
            'description' => $txt['settings_videos'],
            'href' => $scripturl . '?action=garagesettings;sa=videosettings',
            'is_selected' => $_REQUEST['sa'] == 'videosettings',
        );
    if (allowedTo('manage_garage_modules'))
        $context['admin_tabs']['tabs'][] = array(
            'title' => $txt['smfg_modules'],
            'description' => $txt['settings_modules'],
            'href' => $scripturl . '?action=garagesettings;sa=modulesettings',
            'is_selected' => $_REQUEST['sa'] == 'modulesettings',
        );

	$context['admin_tabs']['tabs'][count($context['admin_tabs']['tabs']) - 1]['is_last'] = true;

	$subActions[$_REQUEST['sa']][0]();
}

// General Garage Settings
function ManageGarage()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $smfgSettings, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'garage_settings';
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_settings'];
    
    // Check Permissions
    isAllowedTo('manage_garage_general');
    
    // Check for config values and 'check' enabled options
    if($smfgSettings['enable_vehicle_approval']) $context['enable_vehicle_approval_check'] = "checked=\"checked\"";
        else $context['enable_vehicle_approval_check'] = "";
    if($smfgSettings['enable_user_submit_make']) $context['user_submit_make_check'] = "checked=\"checked\"";
        else $context['user_submit_make_check'] = "";
    if($smfgSettings['enable_make_approval']) $context['enable_make_approval_check'] = "checked=\"checked\"";
        else $context['enable_make_approval_check'] = "";
    if($smfgSettings['enable_user_submit_model']) $context['user_submit_model_check'] = "checked=\"checked\"";
        else $context['user_submit_model_check'] = "";
    if($smfgSettings['enable_model_approval']) $context['enable_model_approval_check'] = "checked=\"checked\"";
        else $context['enable_model_approval_check'] = "";
    if($smfgSettings['enable_user_submit_business']) $context['enable_user_submit_business_check'] = "checked=\"checked\"";
        else $context['enable_user_submit_business_check'] = "";
    if($smfgSettings['enable_business_approval']) $context['enable_business_approval_check'] = "checked=\"checked\"";
        else $context['enable_business_approval_check'] = "";
    if($smfgSettings['enable_user_submit_product']) $context['enable_user_submit_product_check'] = "checked=\"checked\"";
        else $context['enable_user_submit_product_check'] = "";
    if($smfgSettings['enable_product_approval']) $context['enable_product_approval_check'] = "checked=\"checked\"";
        else $context['enable_product_approval_check'] = "";
    if($smfgSettings['integrate_viewtopic']) $context['integrate_viewtopic_check'] = "checked=\"checked\"";
        else $context['integrate_viewtopic_check'] = "";
    if($smfgSettings['integrate_profile']) $context['integrate_profile_check'] = "checked=\"checked\"";
        else $context['integrate_profile_check'] = "";
    if($smfgSettings['enable_pm_pending_notify']) $context['enable_pm_pending_notify_check'] = "checked=\"checked\"";
        else $context['enable_pm_pending_notify_check'] = "";
    if($smfgSettings['enable_email_pending_notify']) $context['enable_email_pending_notify_check'] = "checked=\"checked\"";
        else $context['enable_email_pending_notify_check'] = "";
    if($smfgSettings['enable_pm_pending_notify_optout']) $context['enable_pm_pending_notify_optout_check'] = "checked=\"checked\"";
        else $context['enable_pm_pending_notify_optout_check'] = "";
    if($smfgSettings['enable_email_pending_notify_optout']) $context['enable_email_pending_notify_optout_check'] = "checked=\"checked\"";
        else $context['enable_email_pending_notify_optout_check'] = "";
    if($smfgSettings['disable_garage']) $context['disable_garage_check'] = "checked=\"checked\"";
        else $context['disable_garage_check'] = "";

    if($smfgSettings['rating_system'] == 0) $context['sum_rating_check'] = "checked=\"checked\"";
    else if($smfgSettings['rating_system'] == 1) $context['avg_rating_check'] = "checked=\"checked\"";

    if(!isset($context['sum_rating_check'])) $context['sum_rating_check'] = "";
    if(!isset($context['avg_rating_check'])) $context['avg_rating_check'] = "";
    
    // What date format is selected?
    if($smfgSettings['dateformat'] == 'd M Y, H:i') $context['one'] = " selected=\"selected\"";
    else if($smfgSettings['dateformat'] == 'd M Y H:i') $context['two'] = " selected=\"selected\"";
    else if($smfgSettings['dateformat'] == 'M jS, \'y, H:i') $context['three'] = " selected=\"selected\"";
    else if($smfgSettings['dateformat'] == 'D M d, Y g:i a') $context['four'] = " selected=\"selected\"";
    else if($smfgSettings['dateformat'] == 'F jS, Y, g:i a') $context['five'] = " selected=\"selected\"";
    else if($smfgSettings['dateformat'] == '|d M Y| H:i') $context['six'] = " selected=\"selected\"";
    else if($smfgSettings['dateformat'] == '|F jS, Y| g:i a') $context['seven'] = " selected=\"selected\"";
    else $context['custom'] = " selected=\"selected\"";
    
    if(!isset($context['one'])) $context['one'] = "";
    if(!isset($context['two'])) $context['two'] = "";
    if(!isset($context['three'])) $context['three'] = "";
    if(!isset($context['four'])) $context['four'] = "";
    if(!isset($context['five'])) $context['five'] = "";
    if(!isset($context['six'])) $context['six'] = "";
    if(!isset($context['seven'])) $context['seven'] = "";
    if(!isset($context['custom'])) $context['custom'] = "";
    
    // Get all the members to be notified
    $request = db_query("
        SELECT n.id, u.realName
        FROM {$db_prefix}garage_notifications AS n, {$db_prefix}members AS u
        WHERE n.user_id = u.ID_MEMBER
            ORDER BY n.id",__FILE__,__LINE__);
    $count = 0;
    while($row = mysql_fetch_row($request)) {
        list($context['notifications'][$count]['id'],
             $context['notifications'][$count]['user']) = $row;   
        $count++;
    }
    mysql_free_result($request);
    
}

// Update General Settings
function UpdateGeneral()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $smfgSettings, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_general');
    
    // Validate the session
    checkSession();
    
    // Define all indices
    if(!isset($_POST['config']['enable_vehicle_approval'])) $_POST['config']['enable_vehicle_approval'] = "";
    if(!isset($_POST['config']['enable_user_submit_make'])) $_POST['config']['enable_user_submit_make'] = "";
    if(!isset($_POST['config']['enable_make_approval'])) $_POST['config']['enable_make_approval'] = "";
    if(!isset($_POST['config']['enable_user_submit_model'])) $_POST['config']['enable_user_submit_model'] = "";
    if(!isset($_POST['config']['enable_model_approval'])) $_POST['config']['enable_model_approval'] = "";
    if(!isset($_POST['config']['enable_user_submit_business'])) $_POST['config']['enable_user_submit_business'] = "";
    if(!isset($_POST['config']['enable_business_approval'])) $_POST['config']['enable_business_approval'] = "";
    if(!isset($_POST['config']['enable_user_submit_product'])) $_POST['config']['enable_user_submit_product'] = "";
    if(!isset($_POST['config']['enable_product_approval'])) $_POST['config']['enable_product_approval'] = "";
    if(!isset($_POST['config']['enable_pm_pending_notify'])) $_POST['config']['enable_pm_pending_notify'] = "";
    if(!isset($_POST['config']['enable_pm_pending_notify_optout'])) $_POST['config']['enable_pm_pending_notify_optout'] = "";
    if(!isset($_POST['config']['enable_email_pending_notify'])) $_POST['config']['enable_email_pending_notify'] = "";
    if(!isset($_POST['config']['enable_email_pending_notify_optout'])) $_POST['config']['enable_email_pending_notify_optout'] = "";
    if(!isset($_POST['config']['integrate_viewtopic'])) $_POST['config']['integrate_viewtopic'] = "";
    if(!isset($_POST['config']['integrate_profile'])) $_POST['config']['integrate_profile'] = "";
    if(!isset($_POST['config']['disable_garage'])) $_POST['config']['disable_garage'] = "";
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['cars_per_page']."\" 
        WHERE config_name = \"cars_per_page\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['results_per_page']."\" 
        WHERE config_name = \"results_per_page\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['blogs_per_page']."\" 
        WHERE config_name = \"blogs_per_page\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['insurance_review_limit']."\" 
        WHERE config_name = \"insurance_review_limit\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['shop_review_limit']."\" 
        WHERE config_name = \"shop_review_limit\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['garage_review_limit']."\" 
        WHERE config_name = \"garage_review_limit\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['default_vehicle_quota']."\" 
        WHERE config_name = \"default_vehicle_quota\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_vehicle_approval']."\" 
        WHERE config_name = \"enable_vehicle_approval\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['pending_subject']."\" 
        WHERE config_name = \"pending_subject\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['comments_per_page']."\" 
        WHERE config_name = \"comments_per_page\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['year_start']."\" 
        WHERE config_name = \"year_start\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['year_end']."\" 
        WHERE config_name = \"year_end\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_user_submit_make']."\" 
        WHERE config_name = \"enable_user_submit_make\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_make_approval']."\" 
        WHERE config_name = \"enable_make_approval\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_user_submit_model']."\" 
        WHERE config_name = \"enable_user_submit_model\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_model_approval']."\" 
        WHERE config_name = \"enable_model_approval\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['dateformat']."\" 
        WHERE config_name = \"dateformat\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['integrate_viewtopic']."\" 
        WHERE config_name = \"integrate_viewtopic\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['integrate_profile']."\" 
        WHERE config_name = \"integrate_profile\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['pending_sender']."\" 
        WHERE config_name = \"pending_sender\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_pm_pending_notify']."\" 
        WHERE config_name = \"enable_pm_pending_notify\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_email_pending_notify']."\" 
        WHERE config_name = \"enable_email_pending_notify\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_pm_pending_notify_optout']."\" 
        WHERE config_name = \"enable_pm_pending_notify_optout\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_email_pending_notify_optout']."\" 
        WHERE config_name = \"enable_email_pending_notify_optout\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_user_submit_business']."\" 
        WHERE config_name = \"enable_user_submit_business\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_business_approval']."\" 
        WHERE config_name = \"enable_business_approval\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_user_submit_product']."\" 
        WHERE config_name = \"enable_user_submit_product\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_product_approval']."\" 
        WHERE config_name = \"enable_product_approval\"",__FILE__,__LINE__);

    $request = db_query("
        UPDATE {$db_prefix}garage_config
        SET config_value = \"".$_POST['config']['rating_system']."\"
        WHERE config_name = \"rating_system\"",__FILE__,__LINE__);

    $request = db_query("
        UPDATE {$db_prefix}garage_config
        SET config_value = \"".$_POST['config']['disable_garage']."\"
        WHERE config_name = \"disable_garage\"",__FILE__,__LINE__);
        
    //header( 'Location: '.$scripturl.'?action=garagesettings');    
    $newurl = $_POST['redirecturl'];
    header( 'Location: '.$newurl);
    
}

// Menu Settings
function MenuSettings()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $smfgSettings, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'menu_settings';    
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_settings'];
    
    // Check Permissions
    isAllowedTo('manage_garage_menu');
    
    // Check for config values and 'check' enabled options
    if($smfgSettings['enable_index_menu']) $context['enable_index_menu_check'] = "checked=\"checked\"";
        else $context['enable_index_menu_check'] = "";
    if($smfgSettings['enable_browse_menu']) $context['enable_browse_menu_check'] = "checked=\"checked\"";
        else $context['enable_browse_menu_check'] = "";
    if($smfgSettings['enable_search_menu']) $context['enable_search_menu_check'] = "checked=\"checked\"";
        else $context['enable_search_menu_check'] = "";
    if($smfgSettings['enable_insurance_review_menu']) $context['enable_insurance_review_menu_check'] = "checked=\"checked\"";
        else $context['enable_insurance_review_menu_check'] = "";
    if($smfgSettings['enable_garage_review_menu']) $context['enable_garage_review_menu_check'] = "checked=\"checked\"";
        else $context['enable_garage_review_menu_check'] = "";
    if($smfgSettings['enable_shop_review_menu']) $context['enable_shop_review_menu_check'] = "checked=\"checked\"";
        else $context['enable_shop_review_menu_check'] = "";
    if($smfgSettings['enable_quartermile_menu']) $context['enable_quartermile_menu_check'] = "checked=\"checked\"";
        else $context['enable_quartermile_menu_check'] = "";
    if($smfgSettings['enable_dynorun_menu']) $context['enable_dynorun_menu_check'] = "checked=\"checked\"";
        else $context['enable_dynorun_menu_check'] = "";
    if($smfgSettings['enable_lap_menu']) $context['enable_lap_menu_check'] = "checked=\"checked\"";
        else $context['enable_lap_menu_check'] = "";
}

// Update Menu Settings
function UpdateMenu()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $smfgSettings, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'blank'; 
    
    // Check Permissions
    isAllowedTo('manage_garage_menu');
    
    // Validate the session
    checkSession();
    
    // Define all indices
    if(!isset($_POST['config']['enable_index_menu'])) $_POST['config']['enable_index_menu'] = "";
    if(!isset($_POST['config']['enable_browse_menu'])) $_POST['config']['enable_browse_menu'] = "";
    if(!isset($_POST['config']['enable_search_menu'])) $_POST['config']['enable_search_menu'] = "";
    if(!isset($_POST['config']['enable_insurance_review_menu'])) $_POST['config']['enable_insurance_review_menu'] = "";
    if(!isset($_POST['config']['enable_garage_review_menu'])) $_POST['config']['enable_garage_review_menu'] = "";
    if(!isset($_POST['config']['enable_shop_review_menu'])) $_POST['config']['enable_shop_review_menu'] = "";
    if(!isset($_POST['config']['enable_quartermile_menu'])) $_POST['config']['enable_quartermile_menu'] = "";
    if(!isset($_POST['config']['enable_dynorun_menu'])) $_POST['config']['enable_dynorun_menu'] = "";
    if(!isset($_POST['config']['enable_lap_menu'])) $_POST['config']['enable_lap_menu'] = "";
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_index_menu']."\" 
        WHERE config_name = \"enable_index_menu\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_browse_menu']."\" 
        WHERE config_name = \"enable_browse_menu\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_search_menu']."\" 
        WHERE config_name = \"enable_search_menu\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_insurance_review_menu']."\" 
        WHERE config_name = \"enable_insurance_review_menu\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_garage_review_menu']."\" 
        WHERE config_name = \"enable_garage_review_menu\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_shop_review_menu']."\" 
        WHERE config_name = \"enable_shop_review_menu\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_quartermile_menu']."\" 
        WHERE config_name = \"enable_quartermile_menu\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_dynorun_menu']."\" 
        WHERE config_name = \"enable_dynorun_menu\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_lap_menu']."\" 
        WHERE config_name = \"enable_lap_menu\"",__FILE__,__LINE__);
    
    //header( 'Location: '.$scripturl.'?action=garagesettings;sa=menusettings');
    $newurl = $_POST['redirecturl'];
    header( 'Location: '.$newurl);
    
}

// Index Page Settings
function IndexSettings()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $smfgSettings, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'index_settings';  
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_settings'];
    
    // Check Permissions
    isAllowedTo('manage_garage_index');
    
    // Get block postions
    $request = db_query("
        SELECT id, input_title, title, position, enabled
        FROM {$db_prefix}garage_blocks
            ORDER BY position ASC",__FILE__,__LINE__);
        $count = 0;
        while($row = mysql_fetch_row($request)) {
            list($context['blocks'][$count]['id'],
                 $context['blocks'][$count]['input_title'],
                 $context['blocks'][$count]['title'],
                 $context['blocks'][$count]['position'],
                 $context['blocks'][$count]['enabled']) = $row;
            $count++;
        }
        mysql_free_result($request);
        
    // Set the total number of blocks
    $context['blocks']['total'] = $count;
    
    // Check for config values and 'check' enabled options
    if($smfgSettings['enable_newest_vehicle']) $context['enable_newest_vehicle_check'] = "checked=\"checked\"";
        else $context['enable_newest_vehicle_check'] = "";
    if($smfgSettings['enable_updated_vehicle']) $context['enable_updated_vehicle_check'] = "checked=\"checked\"";
        else $context['enable_updated_vehicle_check'] = "";
    if($smfgSettings['enable_newest_modification']) $context['enable_newest_modification_check'] = "checked=\"checked\"";
        else $context['enable_newest_modification_check'] = "";
    if($smfgSettings['enable_updated_modification']) $context['enable_updated_modification_check'] = "checked=\"checked\"";
        else $context['enable_updated_modification_check'] = "";
    if($smfgSettings['enable_most_modified']) $context['enable_most_modified_check'] = "checked=\"checked\"";
        else $context['enable_most_modified_check'] = "";
    if($smfgSettings['enable_most_spent']) $context['enable_most_spent_check'] = "checked=\"checked\"";
        else $context['enable_most_spent_check'] = "";
    if($smfgSettings['enable_most_viewed']) $context['enable_most_viewed_check'] = "checked=\"checked\"";
        else $context['enable_most_viewed_check'] = "";
    if($smfgSettings['enable_last_commented']) $context['enable_last_commented_check'] = "checked=\"checked\"";
        else $context['enable_last_commented_check'] = "";
    if($smfgSettings['enable_top_dynorun']) $context['enable_top_dynorun_check'] = "checked=\"checked\"";
        else $context['enable_top_dynorun_check'] = "";
    if($smfgSettings['enable_top_quartermile']) $context['enable_top_quartermile_check'] = "checked=\"checked\"";
        else $context['enable_top_quartermile_check'] = "";
    if($smfgSettings['enable_top_rating']) $context['enable_top_rating_check'] = "checked=\"checked\"";
        else $context['enable_top_rating_check'] = "";
    if($smfgSettings['enable_top_lap']) $context['enable_top_lap_check'] = "checked=\"checked\"";
        else $context['enable_top_lap_check'] = "";
    if($smfgSettings['featured_vehicle_image_required']) $context['featured_vehicle_image_required_check'] = "checked=\"checked\"";
        else $context['featured_vehicle_image_required_check'] = "";
    
    if($smfgSettings['enable_featured_vehicle'] == 0) $context['disabled_check'] = "checked=\"checked\"";
    else if($smfgSettings['enable_featured_vehicle'] == 1) $context['from_id_check'] = "checked=\"checked\"";
    else if($smfgSettings['enable_featured_vehicle'] == 2) $context['from_block_check'] = "checked=\"checked\"";
    else if($smfgSettings['enable_featured_vehicle'] == 3) $context['random_check'] = "checked=\"checked\"";
    
    if(!isset($context['disabled_check'])) $context['disabled_check'] = "";
    if(!isset($context['from_id_check'])) $context['from_id_check'] = "";
    if(!isset($context['from_block_check'])) $context['from_block_check'] = "";
    if(!isset($context['random_check'])) $context['random_check'] = "";
    
    if($smfgSettings['index_columns'] == 1) $context['one'] = " selected=\"selected\"";
    else if($smfgSettings['index_columns'] == 2) $context['two'] = " selected=\"selected\"";
    
    if(!isset($context['one'])) $context['one'] = "";
    if(!isset($context['two'])) $context['two'] = "";
    
    if($smfgSettings['featured_vehicle_from_block'] == 0 | "") $context['fb_none'] = " selected=\"selected\"";
    else if($smfgSettings['featured_vehicle_from_block'] == 1) $context['fb_one'] = " selected=\"selected\"";
    else if($smfgSettings['featured_vehicle_from_block'] == 2) $context['fb_two'] = " selected=\"selected\"";
    else if($smfgSettings['featured_vehicle_from_block'] == 3) $context['fb_three'] = " selected=\"selected\"";
    else if($smfgSettings['featured_vehicle_from_block'] == 4) $context['fb_four'] = " selected=\"selected\"";
    else if($smfgSettings['featured_vehicle_from_block'] == 5) $context['fb_five'] = " selected=\"selected\"";
    else if($smfgSettings['featured_vehicle_from_block'] == 6) $context['fb_six'] = " selected=\"selected\"";
    else if($smfgSettings['featured_vehicle_from_block'] == 7) $context['fb_seven'] = " selected=\"selected\"";
    else if($smfgSettings['featured_vehicle_from_block'] == 8) $context['fb_eight'] = " selected=\"selected\"";
    else if($smfgSettings['featured_vehicle_from_block'] == 9) $context['fb_nine'] = " selected=\"selected\"";
    else if($smfgSettings['featured_vehicle_from_block'] == 10) $context['fb_ten'] = " selected=\"selected\"";
    else if($smfgSettings['featured_vehicle_from_block'] == 11) $context['fb_eleven'] = " selected=\"selected\"";
    else if($smfgSettings['featured_vehicle_from_block'] == 12) $context['fb_twelve'] = " selected=\"selected\"";
    
    if(!isset($context['fb_none'])) $context['fb_none'] = "";
    if(!isset($context['fb_one'])) $context['fb_one'] = "";
    if(!isset($context['fb_two'])) $context['fb_two'] = "";
    if(!isset($context['fb_three'])) $context['fb_three'] = "";
    if(!isset($context['fb_four'])) $context['fb_four'] = "";
    if(!isset($context['fb_five'])) $context['fb_five'] = "";
    if(!isset($context['fb_six'])) $context['fb_six'] = "";
    if(!isset($context['fb_seven'])) $context['fb_seven'] = "";
    if(!isset($context['fb_eight'])) $context['fb_eight'] = "";
    if(!isset($context['fb_nine'])) $context['fb_nine'] = "";
    if(!isset($context['fb_ten'])) $context['fb_ten'] = "";
    if(!isset($context['fb_eleven'])) $context['fb_eleven'] = "";
    if(!isset($context['fb_twelve'])) $context['fb_twelve'] = "";
    
    if($smfgSettings['featured_vehicle_description_alignment'] == "left") $context['left'] = " selected=\"selected\"";
    else if($smfgSettings['featured_vehicle_description_alignment'] == "center") $context['center'] = " selected=\"selected\"";
    else if($smfgSettings['featured_vehicle_description_alignment'] == "right") $context['right'] = " selected=\"selected\"";
    
    if(!isset($context['left'])) $context['left'] = "";
    if(!isset($context['center'])) $context['center'] = "";
    if(!isset($context['right'])) $context['right'] = "";
    
}

// Update Index Page Settings
function UpdateIndex()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $smfgSettings, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_index');
    
    // Validate the session
    checkSession();
    
    // Define all indices
    if(!isset($_POST['config']['featured_vehicle_image_required'])) $_POST['config']['featured_vehicle_image_required'] = "";
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['index_columns']."\" 
        WHERE config_name = \"index_columns\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_featured_vehicle']."\" 
        WHERE config_name = \"enable_featured_vehicle\"",__FILE__,__LINE__);
            
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['featured_vehicle_image_required']."\" 
        WHERE config_name = \"featured_vehicle_image_required\"",__FILE__,__LINE__);
        
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['featured_vehicle_id']."\" 
        WHERE config_name = \"featured_vehicle_id\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['featured_vehicle_from_block']."\" 
        WHERE config_name = \"featured_vehicle_from_block\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['featured_vehicle_description']."\" 
        WHERE config_name = \"featured_vehicle_description\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['featured_vehicle_description_alignment']."\" 
        WHERE config_name = \"featured_vehicle_description_alignment\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['newest_vehicle_limit']."\" 
        WHERE config_name = \"newest_vehicle_limit\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['updated_vehicle_limit']."\" 
        WHERE config_name = \"updated_vehicle_limit\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['newest_modification_limit']."\" 
        WHERE config_name = \"newest_modification_limit\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['updated_modification_limit']."\" 
        WHERE config_name = \"updated_modification_limit\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['most_modified_limit']."\" 
        WHERE config_name = \"most_modified_limit\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['most_spent_limit']."\" 
        WHERE config_name = \"most_spent_limit\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['most_viewed_limit']."\" 
        WHERE config_name = \"most_viewed_limit\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['last_commented_limit']."\" 
        WHERE config_name = \"last_commented_limit\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['top_dynorun_limit']."\" 
        WHERE config_name = \"top_dynorun_limit\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['top_quartermile_limit']."\" 
        WHERE config_name = \"top_quartermile_limit\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['top_rating_limit']."\" 
        WHERE config_name = \"top_rating_limit\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['top_lap_limit']."\" 
        WHERE config_name = \"top_lap_limit\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['latest_service_limit']."\" 
        WHERE config_name = \"latest_service_limit\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['latest_blog_limit']."\" 
        WHERE config_name = \"latest_blog_limit\"",__FILE__,__LINE__);
    
    //header( 'Location: '.$scripturl.'?action=garagesettings;sa=indexsettings');
    $newurl = $_POST['redirecturl'];
    header( 'Location: '.$newurl);
    
}

// Image Settings
function ImageSettings()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $smfgSettings, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'image_settings';   
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_settings'];
    
    // Check Permissions
    isAllowedTo('manage_garage_images');
    
    // Check for config values and 'check' enabled options
    if($smfgSettings['enable_images']) $context['enable_images_check'] = "checked=\"checked\"";
        else $context['enable_images_check'] = "";
    if($smfgSettings['enable_vehicle_images']) $context['enable_vehicle_images_check'] = "checked=\"checked\"";
        else $context['enable_vehicle_images_check'] = "";
    if($smfgSettings['enable_modification_images']) $context['enable_modification_images_check'] = "checked=\"checked\"";
        else $context['enable_modification_images_check'] = "";
    if($smfgSettings['enable_quartermile_images']) $context['enable_quartermile_images_check'] = "checked=\"checked\"";
        else $context['enable_quartermile_images_check'] = "";
    if($smfgSettings['enable_dynorun_images']) $context['enable_dynorun_images_check'] = "checked=\"checked\"";
        else $context['enable_dynorun_images_check'] = "";
    if($smfgSettings['enable_lap_images']) $context['enable_lap_images_check'] = "checked=\"checked\"";
        else $context['enable_lap_images_check'] = "";
    if($smfgSettings['enable_remote_images']) $context['enable_remote_images_check'] = "checked=\"checked\"";
        else $context['enable_remote_images_check'] = "";
    if($smfgSettings['store_remote_images_locally']) $context['store_remote_images_locally_check'] = "checked=\"checked\"";
        else $context['store_remote_images_locally_check'] = "";
    if($smfgSettings['enable_watermark']) $context['enable_watermark_check'] = "checked=\"checked\"";
        else $context['enable_watermark_check'] = "";
    if($smfgSettings['gcard_watermark']) $context['gcard_watermark_check'] = "checked=\"checked\"";
        else $context['gcard_watermark_check'] = "";
    if($smfgSettings['enable_lightbox']) $context['enable_lightbox_check'] = "checked=\"checked\"";
        else $context['enable_lightbox_check'] = "";

    $context['enable_watermark_thumb_off'] = "";
    $context['enable_watermark_thumb_on'] = "";
    $context['enable_watermark_thumb_onsized'] = "";
    if($smfgSettings['enable_watermark_thumb'] == 1)
        $context['enable_watermark_thumb_on'] = "selected=\"selected\"";
    else if($smfgSettings['enable_watermark_thumb'] == 2)
        $context['enable_watermark_thumb_onsized'] = "selected=\"selected\"";
    else
        $context['enable_watermark_thumb_off'] = "selected=\"selected\"";

    $context['watermark_position_0'] = "";
    $context['watermark_position_1'] = "";
    $context['watermark_position_2'] = "";
    $context['watermark_position_3'] = "";
    $context['watermark_position_4'] = "";
    $context['watermark_position_5'] = "";
    $context['watermark_position_6'] = "";
    $context['watermark_position_7'] = "";
    $context['watermark_position_8'] = "";
    if($smfgSettings['watermark_position'] == 0)
        $context['watermark_position_0'] = "checked=\"checked\"";
    else if($smfgSettings['watermark_position'] == 1)
        $context['watermark_position_1'] = "checked=\"checked\"";
    else if($smfgSettings['watermark_position'] == 2)
        $context['watermark_position_2'] = "checked=\"checked\"";
    else if($smfgSettings['watermark_position'] == 3)
        $context['watermark_position_3'] = "checked=\"checked\"";
    else if($smfgSettings['watermark_position'] == 4)
        $context['watermark_position_4'] = "checked=\"checked\"";
    else if($smfgSettings['watermark_position'] == 5)
        $context['watermark_position_5'] = "checked=\"checked\"";
    else if($smfgSettings['watermark_position'] == 6)
        $context['watermark_position_6'] = "checked=\"checked\"";
    else if($smfgSettings['watermark_position'] == 7)
        $context['watermark_position_7'] = "checked=\"checked\"";
    else if($smfgSettings['watermark_position'] == 8)
        $context['watermark_position_8'] = "checked=\"checked\"";
    
    $context['image_processor_none'] = "";
    $context['image_processor_im'] = "";
    $context['image_processor_gd'] = "";
    if($smfgSettings['image_processor'] == 1)
        $context['image_processor_im'] = "selected=\"selected\"";
    else if($smfgSettings['image_processor'] == 2)
        $context['image_processor_gd'] = "selected=\"selected\"";
    else
        $context['image_processor_none'] = "selected=\"selected\"";

    // Check for ImageMagick directories
    $context['im_convert'] = 0;
    $context['im_composite'] = 0;
    $context['im_gd'] = 0;
    exec($smfgSettings['im_convert'], $output, $returnval);
    if ($returnval == 0) {
        $context['im_convert'] = "OK";
        if (preg_match('/Version: ImageMagick ([0-9.]+)/i', $output[0], $matches))
            $context['im_convert'] = $matches[1];
    }
    unset($output);
    unset($returnval);
    exec($smfgSettings['im_composite'], $output, $returnval);
    if ($returnval == 0) {
        $context['im_composite'] = "OK";
        if (preg_match('/Version: ImageMagick ([0-9.]+)/i', $output[0], $matches))
            $context['im_composite'] = $matches[1];
    }
    unset($output);
    unset($returnval);
    $gdinfo = gd_info();
    if ($gdinfo["GD Version"]) {
       $context['im_gd'] = $gdinfo["GD Version"];
    }
    unset($gdinfo);
}

// Update Image Settings
function UpdateImage()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $smfgSettings, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_images');
    
    // Validate the session
    checkSession();

    // Define all indices
    if(!isset($_POST['config']['enable_vehicle_images'])) $_POST['config']['enable_vehicle_images'] = "";
    if(!isset($_POST['config']['enable_modification_images'])) $_POST['config']['enable_modification_images'] = "";
    if(!isset($_POST['config']['enable_quartermile_images'])) $_POST['config']['enable_quartermile_images'] = "";
    if(!isset($_POST['config']['enable_dynorun_images'])) $_POST['config']['enable_dynorun_images'] = "";
    if(!isset($_POST['config']['enable_lap_images'])) $_POST['config']['enable_lap_images'] = "";
    if(!isset($_POST['config']['enable_remote_images'])) $_POST['config']['enable_remote_images'] = "";
    if(!isset($_POST['config']['store_remote_images_locally'])) $_POST['config']['store_remote_images_locally'] = "";
    if(!isset($_POST['config']['enable_watermark'])) $_POST['config']['enable_watermark'] = "";
    if(!isset($_POST['config']['gcard_watermark'])) $_POST['config']['gcard_watermark'] = "";
    if(!isset($_POST['config']['enable_watermark_thumb'])) $_POST['config']['enable_watermark_thumb'] = "";
    if(!isset($_POST['config']['enable_lightbox'])) $_POST['config']['enable_lightbox'] = "";
    if(!isset($_POST['config']['watermark_position'])) $_POST['config']['watermark_position'] = "9";
    if(!isset($_POST['config']['watermark_opacity'])) $_POST['config']['watermark_opacity'] = "100";
    if(!isset($_POST['config']['image_processor'])) $_POST['config']['image_processor'] = "";
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_vehicle_images']."\" 
        WHERE config_name = \"enable_vehicle_images\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_modification_images']."\" 
        WHERE config_name = \"enable_modification_images\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_quartermile_images']."\" 
        WHERE config_name = \"enable_quartermile_images\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_dynorun_images']."\" 
        WHERE config_name = \"enable_dynorun_images\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_lap_images']."\" 
        WHERE config_name = \"enable_lap_images\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_remote_images']."\" 
        WHERE config_name = \"enable_remote_images\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['remote_timeout']."\" 
        WHERE config_name = \"remote_timeout\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['store_remote_images_locally']."\" 
        WHERE config_name = \"store_remote_images_locally\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_lightbox']."\" 
        WHERE config_name = \"enable_lightbox\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['gallery_limit']."\" 
        WHERE config_name = \"gallery_limit\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['max_image_kbytes']."\" 
        WHERE config_name = \"max_image_kbytes\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['max_image_resolution']."\" 
        WHERE config_name = \"max_image_resolution\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['thumbnail_resolution']."\" 
        WHERE config_name = \"thumbnail_resolution\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['upload_directory']."\" 
        WHERE config_name = \"upload_directory\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_watermark']."\" 
        WHERE config_name = \"enable_watermark\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['gcard_watermark']."\" 
        WHERE config_name = \"gcard_watermark\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_watermark_thumb']."\" 
        WHERE config_name = \"enable_watermark_thumb\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['watermark_position']."\" 
        WHERE config_name = \"watermark_position\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['watermark_opacity']."\" 
        WHERE config_name = \"watermark_opacity\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['image_processor']."\" 
        WHERE config_name = \"image_processor\"",__FILE__,__LINE__);
    
    /*/ Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['watermark_type']."\" 
        WHERE config_name = \"watermark_type\"",__FILE__,__LINE__);*/
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['watermark_source']."\" 
        WHERE config_name = \"watermark_source\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['im_convert']."\" 
        WHERE config_name = \"im_convert\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['im_composite']."\" 
        WHERE config_name = \"im_composite\"",__FILE__,__LINE__);
    
    //header( 'Location: '.$scripturl.'?action=garagesettings;sa=imagesettings');
    if ($_POST['rebuild'])
        $newurl = $_POST['redirecturl2'];
    else
        $newurl = $_POST['redirecturl'];
    header( 'Location: '.$newurl);
    
}

// Video Settings
function VideoSettings()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $smfgSettings, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 1;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'video_settings';   
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_settings'];
    
    // Check Permissions
    isAllowedTo('manage_garage_videos');
    
    // Check for config values and 'check' enabled options
    if($smfgSettings['enable_vehicle_video']) $context['enable_vehicle_video_check'] = "checked=\"checked\"";
        else $context['enable_vehicle_video_check'] = "";
    if($smfgSettings['enable_modification_video']) $context['enable_modification_video_check'] = "checked=\"checked\"";
        else $context['enable_modification_video_check'] = "";
    if($smfgSettings['enable_quartermile_video']) $context['enable_quartermile_video_check'] = "checked=\"checked\"";
        else $context['enable_quartermile_video_check'] = "";
    if($smfgSettings['enable_dynorun_video']) $context['enable_dynorun_video_check'] = "checked=\"checked\"";
        else $context['enable_dynorun_video_check'] = "";
    if($smfgSettings['enable_laptime_video']) $context['enable_laptime_video_check'] = "checked=\"checked\"";
        else $context['enable_laptime_video_check'] = "";

    
}

// Update Video Settings
function UpdateVideo()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $smfgSettings, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'blank';
    
    // Check Permissions
    isAllowedTo('manage_garage_videos');
    
    // Validate the session
    checkSession();

    // Define all indices
    if(!isset($_POST['config']['enable_vehicle_video'])) $_POST['config']['enable_vehicle_video'] = "";
    if(!isset($_POST['config']['enable_modification_video'])) $_POST['config']['enable_modification_video'] = "";
    if(!isset($_POST['config']['enable_quartermile_video'])) $_POST['config']['enable_quartermile_video'] = "";
    if(!isset($_POST['config']['enable_dynorun_video'])) $_POST['config']['enable_dynorun_video'] = "";
    if(!isset($_POST['config']['enable_laptime_video'])) $_POST['config']['enable_laptime_video'] = "";
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_vehicle_video']."\" 
        WHERE config_name = \"enable_vehicle_video\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_modification_video']."\" 
        WHERE config_name = \"enable_modification_video\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_quartermile_video']."\" 
        WHERE config_name = \"enable_quartermile_video\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_dynorun_video']."\" 
        WHERE config_name = \"enable_dynorun_video\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_laptime_video']."\" 
        WHERE config_name = \"enable_laptime_video\"",__FILE__,__LINE__);
    
    // Update Config Settings
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['gallery_limit_video']."\" 
        WHERE config_name = \"gallery_limit_video\"",__FILE__,__LINE__);
    
    //header( 'Location: '.$scripturl.'?action=garagesettings;sa=imagesettings');
    $newurl = $_POST['redirecturl'];
    header( 'Location: '.$newurl);
    
}

// Module Settings
function ModuleSettings()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $smfgSettings, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;

    $context['sub_template'] = 'module_settings';    
    $context['page_title'] = $txt['smfg_garage'].' '.$txt['smfg_settings'];
    
    // Check Permissions
    isAllowedTo('manage_garage_modules');
    
    // Check for config values and 'check' enabled options
    if($smfgSettings['enable_modification']) $context['enable_modification_check'] = "checked=\"checked\"";
        else $context['enable_modification_check'] = "";
    if($smfgSettings['enable_modification_approval']) $context['enable_modification_approval_check'] = "checked=\"checked\"";
        else $context['enable_modification_approval_check'] = "";
    if($smfgSettings['enable_quartermile']) $context['enable_quartermile_check'] = "checked=\"checked\"";
        else $context['enable_quartermile_check'] = "";
    if($smfgSettings['enable_quartermile_approval']) $context['enable_quartermile_approval_check'] = "checked=\"checked\"";
        else $context['enable_quartermile_approval_check'] = "";
    if($smfgSettings['enable_quartermile_image_required']) $context['enable_quartermile_image_required_check'] = "checked=\"checked\"";
        else $context['enable_quartermile_image_required_check'] = "";
    if($smfgSettings['enable_dynorun']) $context['enable_dynorun_check'] = "checked=\"checked\"";
        else $context['enable_dynorun_check'] = "";
    if($smfgSettings['enable_dynorun_approval']) $context['enable_dynorun_approval_check'] = "checked=\"checked\"";
        else $context['enable_dynorun_approval_check'] = "";
    if($smfgSettings['enable_dynorun_image_required']) $context['enable_dynorun_image_required_check'] = "checked=\"checked\"";
        else $context['enable_dynorun_image_required_check'] = "";
    if($smfgSettings['enable_laptimes']) $context['enable_laptimes_check'] = "checked=\"checked\"";
        else $context['enable_laptimes_check'] = "";
    if($smfgSettings['enable_user_add_track']) $context['enable_user_add_track_check'] = "checked=\"checked\"";
        else $context['enable_user_add_track_check'] = "";
    if($smfgSettings['enable_lap_approval']) $context['enable_lap_approval_check'] = "checked=\"checked\"";
        else $context['enable_lap_approval_check'] = "";
    if($smfgSettings['enable_lap_image_required']) $context['enable_lap_image_required_check'] = "checked=\"checked\"";
        else $context['enable_lap_image_required_check'] = "";
    if($smfgSettings['enable_track_approval']) $context['enable_track_approval_check'] = "checked=\"checked\"";
        else $context['enable_track_approval_check'] = "";
    if($smfgSettings['enable_insurance']) $context['enable_insurance_check'] = "checked=\"checked\"";
        else $context['enable_insurance_check'] = "";
    if($smfgSettings['enable_guestbooks']) $context['enable_guestbooks_check'] = "checked=\"checked\"";
        else $context['enable_guestbooks_check'] = "";
    if($smfgSettings['enable_guestbooks_bbcode']) $context['enable_guestbooks_bbcode_check'] = "checked=\"checked\"";
        else $context['enable_guestbooks_bbcode_check'] = "";
    if($smfgSettings['enable_guestbooks_comment_approval']) $context['enable_guestbooks_comment_approval_check'] = "checked=\"checked\"";
        else $context['enable_guestbooks_comment_approval_check'] = "";
    if($smfgSettings['enable_service']) $context['enable_service_check'] = "checked=\"checked\"";
        else $context['enable_service_check'] = "";
    if($smfgSettings['enable_blogs']) $context['enable_blogs_check'] = "checked=\"checked\"";
        else $context['enable_blogs_check'] = "";
    if($smfgSettings['enable_blogs_bbcode']) $context['enable_blogs_bbcode_check'] = "checked=\"checked\"";
        else $context['enable_blogs_bbcode_check'] = "";
    
}

// Update Module Settings
function UpdateModule()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $smfgSettings, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'blank';  
    
    // Check Permissions
    isAllowedTo('manage_garage_modules');
    
    // Validate the session
    checkSession();
    
    // Define all indices
    if(!isset($_POST['config']['enable_modification'])) $_POST['config']['enable_modification'] = "";
    if(!isset($_POST['config']['enable_modification_approval'])) $_POST['config']['enable_modification_approval'] = "";
    if(!isset($_POST['config']['enable_quartermile'])) $_POST['config']['enable_quartermile'] = "";
    if(!isset($_POST['config']['enable_quartermile_approval'])) $_POST['config']['enable_quartermile_approval'] = "";
    if(!isset($_POST['config']['enable_quartermile_image_required'])) $_POST['config']['enable_quartermile_image_required'] = "";
    if(!isset($_POST['config']['enable_dynorun'])) $_POST['config']['enable_dynorun'] = "";
    if(!isset($_POST['config']['enable_dynorun_approval'])) $_POST['config']['enable_dynorun_approval'] = "";
    if(!isset($_POST['config']['enable_dynorun_image_required'])) $_POST['config']['enable_dynorun_image_required'] = "";
    if(!isset($_POST['config']['enable_laptimes'])) $_POST['config']['enable_laptimes'] = "";
    if(!isset($_POST['config']['enable_user_add_track'])) $_POST['config']['enable_user_add_track'] = "";
    if(!isset($_POST['config']['enable_lap_approval'])) $_POST['config']['enable_lap_approval'] = "";
    if(!isset($_POST['config']['enable_lap_image_required'])) $_POST['config']['enable_lap_image_required'] = "";
    if(!isset($_POST['config']['enable_track_approval'])) $_POST['config']['enable_track_approval'] = "";
    if(!isset($_POST['config']['enable_insurance'])) $_POST['config']['enable_insurance'] = "";
    if(!isset($_POST['config']['enable_guestbooks'])) $_POST['config']['enable_guestbooks'] = "";
    if(!isset($_POST['config']['enable_guestbooks_bbcode'])) $_POST['config']['enable_guestbooks_bbcode'] = "";
    if(!isset($_POST['config']['enable_guestbooks_comment_approval'])) $_POST['config']['enable_guestbooks_comment_approval'] = "";
    if(!isset($_POST['config']['enable_service'])) $_POST['config']['enable_service'] = "";
    if(!isset($_POST['config']['enable_blogs'])) $_POST['config']['enable_blogs'] = "";
    if(!isset($_POST['config']['enable_blogs_bbcode'])) $_POST['config']['enable_blogs_bbcode'] = "";
    
    // Update Config Settings  
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_modification']."\" 
        WHERE config_name = \"enable_modification\"",__FILE__,__LINE__);
      
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_modification_approval']."\" 
        WHERE config_name = \"enable_modification_approval\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_quartermile']."\" 
        WHERE config_name = \"enable_quartermile\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_quartermile_approval']."\" 
        WHERE config_name = \"enable_quartermile_approval\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_quartermile_image_required']."\" 
        WHERE config_name = \"enable_quartermile_image_required\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_dynorun']."\" 
        WHERE config_name = \"enable_dynorun\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_dynorun_approval']."\" 
        WHERE config_name = \"enable_dynorun_approval\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_dynorun_image_required']."\" 
        WHERE config_name = \"enable_dynorun_image_required\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_laptimes']."\" 
        WHERE config_name = \"enable_laptimes\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_user_add_track']."\" 
        WHERE config_name = \"enable_user_add_track\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_lap_approval']."\" 
        WHERE config_name = \"enable_lap_approval\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_lap_image_required']."\" 
        WHERE config_name = \"enable_lap_image_required\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_track_approval']."\" 
        WHERE config_name = \"enable_track_approval\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_insurance']."\" 
        WHERE config_name = \"enable_insurance\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_guestbooks']."\" 
        WHERE config_name = \"enable_guestbooks\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_guestbooks_bbcode']."\" 
        WHERE config_name = \"enable_guestbooks_bbcode\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_guestbooks_comment_approval']."\" 
        WHERE config_name = \"enable_guestbooks_comment_approval\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_service']."\" 
        WHERE config_name = \"enable_service\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_blogs']."\" 
        WHERE config_name = \"enable_blogs\"",__FILE__,__LINE__);
    
    $request = db_query("
        UPDATE {$db_prefix}garage_config 
        SET config_value = \"".$_POST['config']['enable_blogs_bbcode']."\" 
        WHERE config_name = \"enable_blogs_bbcode\"",__FILE__,__LINE__);
    
    //header( 'Location: '.$scripturl.'?action=garagesettings;sa=modulesettings');
    $newurl = $_POST['redirecturl'];
    header( 'Location: '.$newurl);
    
}

// Modify block position
function MoveBlock()
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
    isAllowedTo('manage_garage_index');
    
    if($_GET['direction'] == 'up') {
        
        // Find our target position
        $context['target_position'] = $_GET['position'] - 1;
        
    } else if($_GET['direction'] == 'down') {
        
        // Find our target position
        $context['target_position'] = $_GET['position'] + 1;
        
    }
    
    // Get the target position's BID
    $request = db_query("
        SELECT id
        FROM {$db_prefix}garage_blocks
        WHERE position = \"".$context['target_position']."\"",__FILE__LINE__)or die("Could not get target ID.");
    list($context['target_id']) = mysql_fetch_row($request);
    mysql_free_result($request);
            
    // First set our target to the current position
    $request = db_query("
        UPDATE {$db_prefix}garage_blocks
        SET position = \"".$_GET['position']."\"
        WHERE id = \"".$context['target_id']."\"",__FILE__,__LINE__)or die("Could not set target position.");
        
    // Then set our current block to the target position
    $request = db_query("
        UPDATE {$db_prefix}garage_blocks
        SET position = \"".$context['target_position']."\"
        WHERE id = \"".$_GET['BID']."\"",__FILE__,__LINE__)or die("Could not set block to target position.");
    
    header('Location: '.$scripturl.'?action=garagesettings;sa=indexsettings');
    
}

// Disable block
function DisableBlock()
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
    isAllowedTo('manage_garage_index');
    
    // Get block config title
    $request = db_query("
        SELECT config_title
        FROM {$db_prefix}garage_blocks
        WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
    list($context['blocks']['config_title']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
    // Update 'blocks' table
    $request = db_query("
        UPDATE {$db_prefix}garage_blocks 
        SET enabled = 0
        WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
    
    // Update config table
    $request = db_query("
        UPDATE {$db_prefix}garage_config
        SET config_value = 0
        WHERE config_name = \"".$context['blocks']['config_title']."\"",__FILE__,__LINE__);
    
    header('Location: '.$scripturl.'?action=garagesettings;sa=indexsettings');
    
}

// Enable block
function EnableBlock()
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
    isAllowedTo('manage_garage_index');
    
    // Get block config title
    $request = db_query("
        SELECT config_title
        FROM {$db_prefix}garage_blocks
        WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
    list($context['blocks']['config_title']) = mysql_fetch_row($request);
    mysql_free_result($request);
    
    // Update 'blocks' table
    $request = db_query("
        UPDATE {$db_prefix}garage_blocks 
        SET enabled = 1
        WHERE id = ".$_GET['BID'],__FILE__,__LINE__);
    
    // Update config table
    $request = db_query("
        UPDATE {$db_prefix}garage_config
        SET config_value = 1
        WHERE config_name = \"".$context['blocks']['config_title']."\"",__FILE__,__LINE__);
    
    header('Location: '.$scripturl.'?action=garagesettings;sa=indexsettings');
    
}

// Add Member to Notification List
function AddNotify()
{
    global $txt, $modSettings, $context, $db_prefix, $sourcedir, $user_info;
    global $func, $scripturl;
    
    // Set our index includes
    $context['lightbox'] = 0;
    $context['editinplace'] = 0;
    $context['form_validation'] = 0;
    $context['dynamicoptionlist'] = 0;
    
    $context['sub_template'] = 'blank';
    
    checkSession();
    
    // Check Permissions
    isAllowedTo('manage_garage_general');
    
    // Get member info
    $request = db_query("
        SELECT ID_MEMBER
        FROM {$db_prefix}members
        WHERE memberName = \"".$_POST['username']."\"",__FILE__,__LINE__);
    $member = mysql_num_rows($request);
    if($member <= 0) {
        loadLanguage('Errors');
        fatal_lang_error('garage_nonexistent_member_error', false); 
    }
    $row = mysql_fetch_row($request);
    mysql_free_result($request);
    
    // Insert new member
    $request = db_query("
        INSERT INTO {$db_prefix}garage_notifications (user_id)
        VALUES (".$row[0].")",__FILE__,__LINE__);
        
    header('Location: '.$scripturl.'?action=garagesettings');
    
}

// Remove Member from Notification List
function DeleteNotify()
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
    isAllowedTo('manage_garage_general');
    
    // Delete member from list
    $request = db_query("
        DELETE FROM {$db_prefix}garage_notifications
        WHERE id = ".$_GET['ID'],__FILE__,__LINE__);
    
    header('Location: '.$scripturl.'?action=garagesettings');
    
}
?>
