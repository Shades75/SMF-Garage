<?php
/**********************************************************************************
* Garage.template.php                                                             *
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

function template_main()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
        if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

echo '
<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
<tr>
<td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center"><div style="float:right"><a href="#" onclick="shrinkSection(\'mainGarage\', \'mainGarageUpshrink\'); return false;"><img id="mainGarageUpshrink" src="'. $settings['actual_images_url'] . '/upshrink.gif" alt="*" title="Shrink or expand the table." align="bottom" style="margin: 0 1ex;" /></a></div>' . $txt['smfg_welcome'] . '</td>
</tr><tr id="mainGarage">
<td class="windowbg">';
 
echo '<table border="0" cellpadding="0" cellspacing="3" align="center" width="100%">
    <tr>';
        if($smfgSettings['enable_featured_vehicle'] != 0)
        {
        echo '
        <td width="33%" valign="top">
        <table width="75%" border="0" cellspacing="0" cellpadding="4" align="center" class="tborder">
            <tr class="titlebg">
                <td align="center" nowrap="nowrap">' . $txt['smfg_featured_vehicle'] . '</td>
            </tr>
            
            <tr>
                <td class="windowbg">
                <table border="0" cellpadding="0" cellspacing="3" width="100%">';
                if(isset($context['featured_vehicle']['id']) && !empty($context['featured_vehicle']['id'])) {
                    echo '
                    <tr>
                        <td width="100%" valign="top" align="center">
                        '.$context['featured_vehicle']['image'].'<a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['featured_vehicle']['id'].'">'.garage_title_clean($context['featured_vehicle']['vehicle']).'</a><br />'.$txt['smfg_owner'].':&nbsp;<a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['featured_vehicle']['user_id'].'">'.$context['featured_vehicle']['owner'].'</a></td>
                    </tr>';
                } else {
                    echo '
                    <tr>
                        <td width="100%" valign="top" align="center">'. $txt['smfg_no_vid'] .'</td>
                    </tr>';
                }
                echo '
                </table>
                </td>
            </tr>
        </table>
        <table width="75%" border="0" align="center">
        <tr>
            <td align="'.$smfgSettings['featured_vehicle_description_alignment'].'">'.$smfgSettings['featured_vehicle_description'].'</td>
        </tr>
        </table>
        </td>';
        }
        echo '
        <td>' . $txt['smfg_garage_brief'] . '
        <br /><br />
        ' . $txt['smfg_total_vehicles_caps'] . ':&nbsp;<b>'.$context['total_vehicles'].'</b>
        <br />
        ' . $txt['smfg_total_mods'] . ':&nbsp;<b>'.$context['total_mods'].'</b>
        <br />
        ' . $txt['smfg_total_comments'] . ':&nbsp;<b>'.$context['total_comments'].'</b>
        <br />
        ' . $txt['smfg_total_views'] . ':&nbsp;<b>'.$context['total_views'].'</b>
        </td>
    </tr>
</table>';
    
echo '
</td>
</tr>
</table>
<br />
';    
    
echo '
<table border="0" width="100%">
    <tr>
        <td width="50%" valign="top">';
            
            echo $context['blocks']['display'];

echo '            </td>
        </tr>
</table>
';
    
    echo smfg_footer();

}

function template_user_garage()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }
    
    echo '
<form action="'.$scripturl.'?action=garage;sa=browse" method="post" style="padding:0; margin:0;">
<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_my_vehicles'] . '</td>
    </tr>';
if($context['pending_modules']) {
echo '
    <tr>
        <td class="windowbg" align="center" valign="middle">'.$txt['smfg_vehicle_pending_alert'].'</td>
    </tr>';
}
echo '
<tr>';
echo '
<td class="windowbg">
    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
    
    // Check if there are vehicles in user's garage.    
    if (!empty($context['user_vehicles']))
    {
        echo '
    <tr>
        <td class="catbg" align="center" nowrap="nowrap">' . $txt['smfg_vehicle'] . '</td>
        <td class="catbg" align="center" nowrap="nowrap">' . $txt['smfg_mods'] . '</td>
        <td class="catbg" align="center" nowrap="nowrap">' . $txt['smfg_views'] . '</td>
        <td class="catbg" align="center" nowrap="nowrap">' . $txt['smfg_created'] . '</td>
        <td class="catbg" align="center" nowrap="nowrap">' . $txt['smfg_updated'] . '</td>
    </tr>';
    
    // Loop through each vehicle.   
    foreach ($context['user_vehicles'] as $vehicle)    {
        echo ' 
    <tr class="', ($vehicle['pending']) ? 'windowbg_pending' : 'windowbg' ,'">
        <td align="center"><a href="' . $scripturl . '?action=garage;sa=view_vehicle;VID=' . $vehicle['veh_id'] . '">' . garage_title_clean($vehicle['vehicle']) . '</a></td>
        <td align="center">'.$vehicle['total_mods'].'</td>
        <td align="center">' . $vehicle['views'] . '</td>
        <td align="center">' . date($context['date_format'], $vehicle['date_created']) . '</td>
        <td align="center">' . date($context['date_format'], $vehicle['date_updated']) . '</td>
    </tr>';
    
    }
    
} 
// No Vehicles?
else {
    
echo '
    <tr class="windowbg">
    <td align="center">' . $txt['smfg_no_vehicles_in_ug'] . '</td>
    </tr>'; 
    
}

echo '
    </table>
</td>
</tr>

<tr>
    <td class="titlebg" align="center" height="28"><a href="'.$scripturl.'?action=garage;sa=add_vehicle"><img src="'. $settings['default_images_url'] . '/garage_create_vehicle.gif" alt="' . $txt['smfg_create_vehicle'] . '" /></a></td>
</tr>
</table>
</form>';
    
    echo smfg_footer();

}

function template_view_garage()
{
global $context, $settings, $options, $txt, $scripturl, $db_prefix, $smfgSettings, $boardurl, $user_profile;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';
    
    // Display links to navigate garage.
        if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }    
    
echo '
<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
<tr>
<td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center">'. $context['user_vehicles']['memberName'] .'\'s ' . $txt['smfg_garage'] . '</td>
</tr><tr>
<td class="windowbg">';
 
echo '<table class="bordercolor" border="0" cellpadding="3" cellspacing="1" align="center" width="100%">';
        //show the vehicle(s) in this garage
        $count = 0;
        while(isset($context['user_vehicles'][$count]['veh_id'])){
        echo '
        <tr>
        <td class="windowbg" width="33%" valign="middle">
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="tborder">
            <tr class="titlebg">
                <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['user_vehicles'][$count]['veh_id'].'">'.garage_title_clean($context['user_vehicles'][$count]['vehicle']).'</a></td>
            </tr>
            <tr>
                <td class="windowbg">
                <table border="0" cellpadding="0" cellspacing="3" width="100%">
                    <tr>
                        <td width="100%" valign="top" align="center">'. $context['user_vehicles'][$count]['image'] .'</td>
                    </tr>
                </table>
                </td>
            </tr>
        </table>
        </td>
        <td class="windowbg" width="77%" valign="middle">
        <table width="350" border="0" cellspacing="1" cellpadding="3">
        <tbody>
            <tr>
                <td><b>'.$txt['smfg_vehicle'].':</b></td>
                <td><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['user_vehicles'][$count]['veh_id'].'">'.garage_title_clean($context['user_vehicles'][$count]['vehicle']).'</a></td>
            </tr>
            <tr>
                <td><b>'.$txt['smfg_date_created'].':</b></td>
                <td>'.date($context['date_format'], $context['user_vehicles'][$count]['date_created']).'</td>
            </tr>';
            if(!empty($context['user_vehicles'][$count]['color'])) {
                echo '
                <tr>
                    <td><b>'.$txt['smfg_color'].':</b></td>
                    <td>'.$context['user_vehicles'][$count]['color'].'</td>
                </tr>';
            }            
            echo '
            <tr>
                <td><b>'.$txt['smfg_mileage'].':</b></td>
                <td>'.$context['user_vehicles'][$count]['mileage'].' '.$context['user_vehicles'][$count]['mileage_unit'].'</td>
            </tr>
            <tr>
                <td><b>'.$txt['smfg_total_mods'].':</b></td>
                <td>'.$context['user_vehicles'][$count]['total_mods'].'</td>
            </tr>
            <tr>
                <td><b>'.$txt['smfg_total_views'].':</b></td>
                <td>'.$context['user_vehicles'][$count]['views'].'</td>
            </tr>
            <tr>
                <td><b>'.$txt['smfg_vehicle_rating'].':</b></td>
                <td>';
                if($context['user_vehicles'][$count]['poss_rating']) {
                    if($smfgSettings['rating_system'] == 0)
                        echo $context['user_vehicles'][$count]['rating'].'/'.$context['user_vehicles'][$count]['poss_rating'];
                    else if($smfgSettings['rating_system'] == 1)
                        echo $context['user_vehicles'][$count]['rating'].'/10 ('.$txt['smfg_rated'].' '.($context['user_vehicles'][$count]['poss_rating']/10).' '.$txt['smfg_times'].')';
                } else {
                    echo $txt['smfg_vehicle_not_rated'];
                }                
                echo '</td>
            </tr>                                                
        </tbody>
        </table>
        </td>
        </tr>';
        $count++;
        }
        echo '
      </table>
</td>
</tr>
<tr>
<td class="windowbg">
            <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="left" nowrap="nowrap">';
                echo $txt['139'].': '.$context['comments']['page_index'];
                echo '</td>
            </tr>
            <tr>
                <td class="windowbg">
                <form action="'.$scripturl.'?action=garage;sa=insert_garage_comment" method="post" name="add_comment" id="add_comment" style="padding:0; margin:0;">
                <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_garage;UID='.$_GET['UID'].'" />
                <table width="100%" cellspacing="1" cellpadding="3" border="0" class="bordercolor">';                    
                    $count = 0; 
                    $forms = '';
                    if(isset($context['comments'][$count]['comment'])) {
                        echo '
                        <tr>
                            <td class="catbg">'.$txt['smfg_author'].'</td>
                            <td class="catbg">'.$txt['smfg_message'].'</td>
                        </tr>';
                        while(isset($context['comments'][$count]['comment'])) {
                        loadMemberData(ARRAY($context['comments'][$count]['author_id']));
                        $avatarimg = "";
                        if ($user_profile[$context['comments'][$count]['author_id']]['ID_ATTACH'])
                          $avatarimg = '<img src="'.$scripturl.'?action=dlattach;attach='.$user_profile[$context['comments'][$count]['author_id']]['ID_ATTACH'].';type=avatar" alt="" class="avatar" border="0" /><br />';
                        echo '
                        <tr class="windowbg2">
                            <td width="150" align="center" valign="middle">
                            '.$avatarimg.'<b><a href="'.$scripturl.'?action=profile;u='.$context['comments'][$count]['author_id'].'">'.$context['comments'][$count]['author'].'</a></b>
                            <table cellspacing="4" align="center" width="150">
                                <tr>
                                    <td class="smalltext"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['comments'][$count]['author_VID'].'">'.garage_title_clean($context['comments'][$count]['author_vehicle']).'</a></td>
                                </tr>
                            </table>
                            <table cellspacing="4" border="0">
                                <tr>
                                    <td nowrap="nowrap"><span class="smalltext"><b>'.$txt['smfg_joined'].':</b>&nbsp;'.date($context['date_format'],$context['comments'][$count]['date_reg']).'<br /><b>'.$txt['smfg_posts'].':</b>&nbsp;'.$context['comments'][$count]['posts'].'</span>
                                    </td>
                                </tr>
                            </table>
                            </td>
                            <td valign="top">
                            <table width="100%" cellspacing="0">
                                <tr>
                                    <td class="smalltext" width="100%"><div style="float:right"><b>'.$txt['smfg_posted'].':</b>&nbsp;'.date($context['date_format'],$context['comments'][$count]['post_date']).'&nbsp;</div>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" cellspacing="5">
                                <tr>
                                    <td>
                                    <div class="postbody">'.$context['comments'][$count]['comment'].'</div>
                                    <br clear="all" /><br />
                                    <table width="100%" cellspacing="0">
                                        <tr valign="middle">
                                            <td class="smalltext" align="right">';
                                            if($context['user']['is_admin']) {
                                                echo '<img src="'. $settings['actual_images_url'] . '/ip.gif" alt="IP" title="IP" />&nbsp;<a href="'.$scripturl.'?action=trackip;searchip='.$context['comments'][$count]['author_ip'].'">'.$context['comments'][$count]['author_ip'].'</a>&nbsp;<a href="'.$scripturl.'?action=helpadmin;help=see_admin_ip" onclick="return reqWin(this.href);" class="help">(?)</a>';
                                            }
                                            echo '
                                            </td>
                                        </tr>
                                    </table>
                                    </td>
                                </tr>
                            </table>
                            </td>
                        </tr>
                        <tr class="windowbg2">
                            <td nowrap="nowrap">&nbsp;</td>
                            <td><div class="smalltext" style="float: left;">&nbsp;&nbsp;</div><div class="gensmall" style="float:right">'; 
                            // If the reader is the author, let them edit it
                            if($context['user']['id'] == $context['comments'][$count]['author_id'] | allowedTo('edit_all_comments')) {
                                echo '<a href="'.$scripturl.'?action=garage;sa=edit_garage_comment;UID='.$_GET['UID'].';CID='.$context['comments'][$count]['CID'].'"><img src="'. $settings['default_images_url'] . '/garage_edit.gif" alt="Edit" title="Edit" /></a>&nbsp;<a href="#" onClick="if (confirm(\''.$txt['smfg_delete_comment'].'\')) { document.delete_comment_'.$context['comments'][$count]['CID'].'.submit(); } else { return false; } return false;"><img src="'. $settings['default_images_url'] . '/garage_delete.gif" alt="Delete" title="Delete" /></a>'; 
                                $forms .= '
                                <form action="'.$scripturl.'?action=garage;sa=delete_garage_comment;UID='.$_GET['UID'].';CID='.$context['comments'][$count]['CID'].';sesc='.$context['session_id'].'" method="post" name="delete_comment_'.$context['comments'][$count]['CID'].'" id="delete_comment_'.$context['comments'][$count]['CID'].'" style="display: inline;">
                                <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_garage;UID='.$_GET['UID'].'" />
                                </form>';
                            }
                            echo '</div></td>
                        </tr>
                        <tr>
                            <td class="catbg" colspan="2" height="1"><img src="'. $settings['default_images_url'] . '/spacer.gif" alt="" width="1" height="1" />
                            </td>
                        </tr>';
                        $count++;
                        }
                    } else {
                       echo '
                       <tr>
                            <td class="windowbg" colspan="2" align="center">'.$txt['smfg_no_comments'].'</td>
                       </tr>';
                    } 
                    
                if($context['user']['is_logged'] && AllowedTo('post_comments')) { 
                                      
                    echo '   
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="5">'.$txt['smfg_add_comment'].'</td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="20%">'.$txt['smfg_add_comment'].'<br /><br />', $smfgSettings['enable_guestbooks_bbcode'] ? $txt['smfg_bbc_supported'] : $txt['smfg_bbc_disabled'] ,'<br />' . $txt['smfg_html_supported'] . '</td>
                        <td class="windowbg"><textarea name="post" cols="70" rows="7"></textarea></td>
                    </tr>
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="5"><input type="hidden" value="'.$_GET['UID'].'" name="UID" /><input type="hidden" value="'.$context['user']['id'].'" name="user_id" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="submit" type="submit" value="'.$txt['smfg_post_comment'].'" /></td>
                    </tr>';
                
                }
                
                echo '
                </table>
                </form>
                '.$forms.'';
                if($context['user']['is_logged'] && AllowedTo('post_comments')) { 
                                      
                    echo ' 
                    <script language="JavaScript" type="text/javascript">
                    var frmvalidator = new Validator("add_comment");
                    frmvalidator.addValidation("post","req","Please enter a comment.");
                    frmvalidator.addValidation("post","maxlen=2500","Max length for comments is 2500 characters.");
                    </script>';
                
                }
            echo '
            </td>
        </tr>
    </table>
</td>
</tr>
</table>';
    
    echo smfg_footer();
}

function template_view_vehicle()
{
global $context, $settings, $options, $txt, $scripturl, $db_prefix, $smfgSettings, $boardurl, $user_profile;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

 echo '
<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
<tr>
<td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$context['user_vehicles']['vehicle'].'</td>
</tr>

<tr>
<td class="windowbg">
    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
    
echo '
    <tr>
        <td class="windowbg" align="center" valign="top">
            <table border="0" width="70%">';
             if ($context['view_own_vehicle'] != 1){   
                echo '
                <tr>
                    <td align="left"><b>'.$txt['smfg_owner'].'</b></td>
                </tr>
                <tr>
                    <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['user_vehicles']['user_id'].'"><b>'.$context['user_vehicles']['memberName'].'</b></a></td>
                </tr>';
             }
            
            if(!empty($context['hilite_thumb_location'])) {
                echo '
                <tr>
                    <td align="left"></td>
                </tr>
                <tr>
                    <td align="center"><a href="'.$context['hilite_image_location'].'" rel="shadowbox" title="'.garage_title_clean($context['user_vehicles']['vehicle'].' :: '.$context['hilite_desc']).'" class="smfg_imageTitle"><img src="'.$boardurl.'/'.$smfgSettings['upload_directory'].'cache/'.$context['hilite_thumb_location'].'" width="'.$context['hilite_thumb_width'].'" height="'.$context['hilite_thumb_height'].'" /></a></td>
                </tr>';
            }
            
            if ($context['view_own_vehicle'] != 1){
                echo '
                <tr>
                    <td align="left"><b>'.$txt['smfg_description'].'</b></td>
                </tr>

                <tr>
                    <td align="center">'.$context['user_vehicles']['comments'].'</td>
                </tr>';
            }
            
            echo '
            </table>';
            
            // if they are the owner show them edit buttons
            if($context['view_own_vehicle'] == 1){
                    echo '
            <table border="0" cellpadding="3" cellspacing="1" width="413">
                <tr>
                    <td align="center">';
                    
                    echo '
                    <a href="' . $scripturl . '?action=garage;sa=view_vehicle;VID=' . $context['user_vehicles']['id'] . ';view_as_user=1"><img src="'. $settings['default_images_url'] . '/garage_view_vehicle.gif" width="130" height="33" alt="'.$txt['smfg_view_vehicle'].'" title="'.$txt['smfg_view_vehicle'].'" /></a>
                    <a href="' . $scripturl . '?action=garage;sa=edit_vehicle;VID=' . $context['user_vehicles']['id'] . '"><img src="'. $settings['default_images_url'] . '/garage_edit_vehicle.gif" width="130" height="33" alt="'.$txt['smfg_edit_vehicle'].'" title="'.$txt['smfg_edit_vehicle'].'" /></a>
                    <form action="'.$scripturl.'?action=garage;sa=delete_vehicle;VID=' . $context['user_vehicles']['id'] . ';ug=1;sesc=' . $context['session_id'] . '" method="post" name="remove_vehicle" id="remove_vehicle" style="display: inline;">
                        <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=user_garage" />
                        <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_vehicle'].'\')) { document.remove_vehicle.submit(); } else { return false; } return false;"><img src="'. $settings['default_images_url'] . '/garage_delete_vehicle.gif" width="130" height="33" alt="'.$txt['smfg_delete_vehicle'].'" title="'.$txt['smfg_delete_vehicle'].'" /></a>
                    </form>';
                    // Only display the buttons for enabled modules
                    if($smfgSettings['enable_modification']) {
                        echo '
                        <a href="' . $scripturl . '?action=garage;sa=add_modification;VID=' . $context['user_vehicles']['id'] . '"><img src="'. $settings['default_images_url'] . '/garage_add_modification.gif" width="130" height="33" alt="'.$txt['smfg_add_modification'].'" title="'.$txt['smfg_add_modification'].'" /></a>';
                    }
                    if($smfgSettings['enable_insurance']) {
                        echo '
                        <a href="' . $scripturl . '?action=garage;sa=add_insurance;VID=' . $context['user_vehicles']['id'] . '"><img src="'. $settings['default_images_url'] . '/garage_add_insurance.gif" width="130" height="33" alt="'.$txt['smfg_add_insurance'].'" title="'.$txt['smfg_add_insurance'].'" /></a>';
                    }
                    if($smfgSettings['enable_quartermile']) {
                        echo '
                        <a href="' . $scripturl . '?action=garage;sa=add_quartermile;VID=' . $context['user_vehicles']['id'] . '"><img src="'. $settings['default_images_url'] . '/garage_add_quartermile.gif" width="130" height="33" alt="'.$txt['smfg_add_quartermile'].'" title="'.$txt['smfg_add_quartermile'].'" /></a>';
                    }
                    if($smfgSettings['enable_dynorun']) {
                        echo '
                        <a href="' . $scripturl . '?action=garage;sa=add_dynorun;VID=' . $context['user_vehicles']['id'] . '"><img src="'. $settings['default_images_url'] . '/garage_add_dynorun.gif" width="130" height="33" alt="'.$txt['smfg_add_dynorun'].'" title="'.$txt['smfg_add_dynorun'].'" /></a>';
                    }
                    if($smfgSettings['enable_laptimes']) {                    
                        echo '
                        <a href="' . $scripturl . '?action=garage;sa=add_laptime;VID=' . $context['user_vehicles']['id'] . '"><img src="'. $settings['default_images_url'] . '/garage_add_lap.gif" width="130" height="33" alt="'.$txt['smfg_add_laptime'].'" title="'.$txt['smfg_add_laptime'].'" /></a>';
                    }
                    if($smfgSettings['enable_service']) {                    
                        echo '
                        <a href="' . $scripturl . '?action=garage;sa=add_service;VID=' . $context['user_vehicles']['id'] . '"><img src="'. $settings['default_images_url'] . '/garage_add_service.gif" width="130" height="33" alt="'.$txt['smfg_add_service'].'" title="'.$txt['smfg_add_service'].'" /></a>';
                    }
        // If it is not set to the main vehicle, give the option to set it
        if(!$context['user_vehicles']['main_vehicle']) {
            echo '
                    <center><form action="' . $scripturl . '?action=garage;sa=set_main_vehicle;VID=' . $context['user_vehicles']['id'] . ';user_id='.$context['user_vehicles']['user_id'].';sesc=' , $context['session_id'] , '" id="set_main_vehicle_'.$context['user_vehicles']['id'].'" enctype="multipart/form-data" method="post" name="set_main_vehicle_'.$context['user_vehicles']['id'].'" style="padding:0; margin:0; display:inline;"><input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['user_vehicles']['id'].'" /><a href="#" onClick="document.set_main_vehicle_'.$context['user_vehicles']['id'].'.submit(); return false;"><img src="'. $settings['default_images_url'] . '/garage_main_vehicle.gif" width="130" height="33" alt="'.$txt['smfg_set_main_vehicle'].'" title="'.$txt['smfg_set_main_vehicle'].'" /></a></form></center>';
        }
            echo'
                    </td>
                </tr>
            </table>';
            }else if ($context['user_vehicles']['user_id'] == $context['user']['id'] && $_SESSION['view_as_user'] == 1){
                echo '
                <a href="' . $scripturl . '?action=garage;sa=view_vehicle;VID=' . $context['user_vehicles']['id'] . ';view_as_user=0"><img src="'. $settings['default_images_url'] . '/garage_edit_vehicle.gif" width="130" height="33" alt="'.$txt['smfg_view_vehicle'].'" title="'.$txt['smfg_view_vehicle'].'" /></a>';
            }   

        echo '</td>
        <td width="30%" class="windowbg" valign="middle" align="center">
            <table border="0" cellspacing="1" cellpadding="3">
            <tr>
                <td align="left"><b>'.$txt['smfg_vehicle'].'</b></td>
                <td align="left">'.$context['user_vehicles']['vehicle'].'</td>
            </tr>';
            if(!empty($context['user_vehicles']['color'])) {
                echo '
                <tr>
                    <td align="left"><b>'.$txt['smfg_color'].'</b></td>
                    <td align="left">'.$context['user_vehicles']['color'].'</td>
                </tr>';
            }
            if(!empty($context['user_vehicles']['engine'])) {
                echo '
                <tr>
                    <td align="left"><b>'.$txt['smfg_engine_type'].'</b></td>
                    <td align="left">'.$context['user_vehicles']['engine'].'</td>
                </tr>';
            }
            echo '
            <tr>
                <td align="left"><b>'.$txt['smfg_updated'].'</b></td>
                <td align="left">'.date($context['date_format'], $context['user_vehicles']['date_updated']).'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_mileage'].'</b></td>
                <td align="left">'.$context['user_vehicles']['mileage'].' '.$context['user_vehicles']['mileage_unit'].'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_price'].'</b></td>
                <td align="left">'.$context['user_vehicles']['price'].' '.$context['user_vehicles']['currency'].'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_total_mods'].'</b></td>
                <td align="left">'.$context['user_vehicles']['total_mods'].'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_total_spent'].'</b></td>
                <td align="left">'.$context['user_vehicles']['total_spent'].' '.$context['user_vehicles']['currency'].'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_total_views'].'</b></td>
                <td align="left">'.$context['user_vehicles']['views'].'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_vehicle_rating'].'</b></td>';
                // Show the vehicle rating if there is one
                if($context['user_vehicles']['poss_rating']) {
                    if($smfgSettings['rating_system'] == 0)
                        echo '<td align="left">'.$context['user_vehicles']['rating'].'/'.$context['user_vehicles']['poss_rating'].'</td>';
                    else if($smfgSettings['rating_system'] == 1)
                        echo '<td align="left">'.$context['user_vehicles']['rating'].'/10 ('.$txt['smfg_rated'].' '.($context['user_vehicles']['poss_rating']/10).' '.$txt['smfg_times'].')</td>';
                } else {
                echo '
                <td align="left">'.$txt['smfg_vehicle_not_rated'].'</td>';
                }
            echo '
            </tr>';
                    // If they are logged in, let the user rate it                    
                    if($context['user']['is_logged'] && $context['view_own_vehicle'] != 1) {
                        echo '
                        <tr>
                            <td align="left" valign="top">
                            <b>Please Rate</b></td>';
                            // If they already rated it, dont let them rate it again
                            if(isset($context['user_vehicles']['veh_rating'])) {
                                echo '<td>'.$txt['smfg_rated'].' '.$context['user_vehicles']['veh_rating'].' '.$txt['smfg_on'].' '.date("n/j/Y",$context['user_vehicles']['rate_date']).'<br />
                                <form action="'.$scripturl.'?action=garage;sa=remove_rating;VID='.$_GET['VID'].';RID='.$context['user_vehicles']['rid'].';sesc=' . $context['session_id'] . '" method="post" name="remove_rating_'.$context['user_vehicles']['rid'].'" id="remove_rating_'.$context['user_vehicles']['rid'].'" style="display: inline;">
                                    <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['user_vehicles']['id'].'" />
                                    <a href="#" onClick="document.remove_rating_'.$context['user_vehicles']['rid'].'.submit(); return false;">('.$txt['smfg_remove_rating'].')</a>
                                </form>'; 
                            } else {
                                echo '
                                <td>
                                <form action="' . $scripturl . '?action=garage;sa=insert_rating" id="add_rating" enctype="multipart/form-data" method="post" name="add_rating" style="padding:0; margin:0;">
                                <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$_GET['VID'].'" />
                                <select id="rating" name="rating">
                                <option value="">'.$txt['smfg_select_rating'].'</option>
                                <option value="">------</option>
                                <option value="10">10 '.$txt['smfg_best'].'</option>
                                <option value="9">9</option>
                                <option value="8">8</option>
                                <option value="7">7</option>
                                <option value="6">6</option>
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1 '.$txt['smfg_worst'].'</option>
                                </select>
                                <input type="hidden" value="'.$_GET['VID'].'" name="VID" /><input type="hidden" value="'.$context['user']['id'].'" name="user_id" /><input name="Rate" type="submit" value="'.$txt['smfg_rate'].'" /><input type="hidden" name="sc" value="'.$context['session_id'].'" />
                                </form>
                                <script language="JavaScript" type="text/javascript">
                                 var frmvalidator = new Validator("add_rating");
                                 frmvalidator.addValidation("rating","req","'.$txt['smfg_val_select_rating'].'");
                                 frmvalidator.addValidation("rating","dontselect=0","'.$txt['smfg_val_select_rating'].'");
                                 frmvalidator.addValidation("rating","dontselect=1","'.$txt['smfg_val_select_rating'].'");
                                </script>
                                </td>';
                            }
                            echo '
                        </tr>';
                    }
                echo'
            </table>
        </td>
    </tr>';
    
echo '
    </table>
    <br />
    <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;" id="tab_table">
            <tr id="tab_row">
                <td class="mirrortab_first" id="tab_first">&nbsp;</td>

                <td class="mirrortab_active_first" id="tab_active_left">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back" id="tab000">
                    <a href="#images" onclick="change_tab(\'000\');">'.$txt['smfg_images'].'</a>
                </td>
                <td class="mirrortab_active_last" id="tab_active_right">&nbsp;</td>';
                $count = 0;
                if(isset($context['user_vehicles'][$count]['video_id']) && $smfgSettings['enable_vehicle_video']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab001">
                    <a href="#videos" onclick="change_tab(\'001\');">'.$txt['smfg_videos'].'</a>
                </td>';
                }
                if(isset($context['mods'][$count]['id']) && $smfgSettings['enable_modification']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab002">
                    <a href="#modifications" onclick="change_tab(\'002\');">'.$txt['smfg_modifications'].'</a>
                </td>';
                }
                if(isset($context['qmiles'][$count]['id']) && $smfgSettings['enable_quartermile']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab003">
                    <a href="#quartermiles" onclick="change_tab(\'003\');">'.$txt['smfg_qmile_runs'].'</a>
                </td>';
                }
                if(isset($context['dynoruns'][$count]['id']) && $smfgSettings['enable_dynorun']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab004">
                    <a href="#dynoruns" onclick="change_tab(\'004\');">'.$txt['smfg_dynoruns'].'</a>
                </td>';
                }
                if(isset($context['laps'][$count]['id']) && $smfgSettings['enable_laptimes']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab005">
                    <a href="#laps" onclick="change_tab(\'005\');">'.$txt['smfg_laps'].'</a>
                </td>';
                }
                if(isset($context['premiums'][$count]['id']) && $smfgSettings['enable_insurance']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab006">
                    <a href="#premiums" onclick="change_tab(\'006\');">'.$txt['smfg_premiums'].'</a>
                </td>';
                }
                if(isset($context['services'][$count]['id']) && $smfgSettings['enable_service']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab007">
                    <a href="#services" onclick="change_tab(\'007\');">'.$txt['smfg_services'].'</a>
                </td>';
                }
                if(isset($context['blog'][$count]['id']) && $smfgSettings['enable_blogs'] || $context['view_own_vehicle'] == 1) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab008">
                    <a href="#blog" onclick="change_tab(\'008\');">'.$txt['smfg_blog'].'</a>
                </td>';
                }
                if($smfgSettings['enable_guestbooks']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab009">
                    <a href="#guestbook" onclick="change_tab(\'009\');">'.$txt['smfg_guestbook'].'</a>
                </td>';
                }
                echo '
                <td class="mirrortab_last">&nbsp;</td>

            </tr>
    </table>';
        
        // Begin dynamic js divs
        echo '        
        <div class="garage_panel" id="options000" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_images'].'</td>
            </tr>';
            $count = 0;
            if(isset($context['user_vehicles'][$count]['image_id'])) {
                echo '
                <tr>
                    <td class="windowbg" valign="middle">';
                    while(isset($context['user_vehicles'][$count]['image_id'])) {
                        echo '
                        <a href="'.$context['user_vehicles'][$count]['attach_location'].'" rel="shadowbox[vehicle]" title="'.garage_title_clean($context['user_vehicles']['vehicle'].' :: '.$context['user_vehicles'][$count]['attach_desc']).'" class="smfg_imageTitle"><img src="'.$boardurl.'/'.$smfgSettings['upload_directory'].'cache/'.$context['user_vehicles'][$count]['attach_thumb_location'].'" width="'.$context['user_vehicles'][$count]['attach_thumb_width'].'" height="'.$context['user_vehicles'][$count]['attach_thumb_height'].'" /></a>';
                        $count++;
                    }
                    echo '
                    </td>
                </tr>';
            }  else {
                echo '
                <tr>
                    <td class="windowbg" align="center">'.$txt['smfg_no_images'].'</td>
                </tr>';
            }
        echo '
        </table>     
        </div>
        <div class="garage_panel" id="options001" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_videos'].'</td>
            </tr>';
            $count = 0;
            if(isset($context['user_vehicles'][$count]['video_id'])) {
            echo '
            <tr>
                <td class="windowbg" valign="middle">';
                while(isset($context['user_vehicles'][$count]['video_id'])) {
                    echo '
                    <a href="'.$scripturl.'?action=garage;sa=video;id='.$context['user_vehicles'][$count]['video_id'].'" rel="shadowbox[video];width='.$context['user_vehicles'][$count]['video_width'].';height='.$context['user_vehicles'][$count]['video_height'].';" title="'.garage_title_clean('<b>'.$context['user_vehicles'][$count]['video_title'].'</b> :: '.$context['user_vehicles'][$count]['video_desc']).'" class="smfg_videoTitle" ><img src="'.$context['user_vehicles'][$count]['video_thumb'].'" /></a>';
                $count++;
                }
                echo '
                </td>
            </tr>';
            }  else {
            echo '
            <tr>
                <td class="windowbg" align="center">'.$txt['smfg_no_videos'].'</td>
            </tr>';
            }
        echo '  
        </table>     
        </div>
        <div class="garage_panel" id="options002" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td colspan="',($context['view_own_vehicle'] == 1) ? '8' : '7','" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_modifications'].'</td>
            </tr>'; 
            $count = 0;
            if(isset($context['mods'][$count]['id'])) {
                echo'
            <tr>
                <td class="catbg">&nbsp;</td>
                <td class="catbg">'.$txt['smfg_modification'].'</td>
                <td class="catbg">'.$txt['smfg_rating'].'</td>
                <td class="catbg">'.$txt['smfg_cost'].'</td>
                <td class="catbg">'.$txt['smfg_install_cost'].'</td>
                <td class="catbg">'.$txt['smfg_created'].'</td>
                <td class="catbg">'.$txt['smfg_updated'].'</td>
                ',($context['view_own_vehicle'] == 1) ? '<td class="catbg">&nbsp;</td>' : '','
            </tr>
            ';
            
    // Loop through each modification.  
    while(isset($context['mods'][$count]['id']))    {
        echo '<tr class="windowbg">
                <td align="center" style="width: 25px;  white-space: nowrap;">'.$context['mods'][$count]['image'].$context['mods'][$count]['spacer'].$context['mods'][$count]['video'].'</td>
                <td><a href="'.$scripturl.'?action=garage;sa=view_modification;VID='.$context['user_vehicles']['id'].';MID='.$context['mods'][$count]['id'].'" title="'.$context['mods'][$count]['mod_tooltip'].'" class="smfg_videoTitle">'.garage_title_clean($context['mods'][$count]['title']).'</a></td>
                <td align="center">'.$context['mods'][$count]['product_rating'].'</td>
                <td align="center">'.$context['mods'][$count]['price'].'</td>
                <td align="center">'.$context['mods'][$count]['install_price'].'</td>
                <td nowrap="nowrap">'.date($context['date_format'], $context['mods'][$count]['date_created']).'</td>
                <td nowrap="nowrap">'.date($context['date_format'], $context['mods'][$count]['date_updated']).'</td>';

        if ($context['view_own_vehicle'] == 1){
            echo'
                <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=edit_modification;VID='.$context['user_vehicles']['id'].';MID='.$context['mods'][$count]['id'].'"><img src="'. $settings['default_images_url'] . '/garage_edit.gif" alt="'.$txt['smfg_edit'].'" title="'.$txt['smfg_edit'].'" /></a>
                <form action="'.$scripturl.'?action=garage;sa=delete_modification;VID='.$context['user_vehicles']['id'].';MID='.$context['mods'][$count]['id'].';sesc=' . $context['session_id'] . '" method="post" name="remove_modification_'.$context['mods'][$count]['id'].'" id="remove_modification_'.$context['mods'][$count]['id'].'" style="display: inline;">
                    <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['user_vehicles']['id'].'" />
                    <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_modification'].'\')) { document.remove_modification_'.$context['mods'][$count]['id'].'.submit(); } else { return false; } return false;"><img src="'. $settings['default_images_url'] . '/garage_delete.gif" alt="'.$txt['smfg_delete'].'" title="'.$txt['smfg_delete'].'" /></a>
                </form></td>';
        }
        
        echo '
               </tr>
            ';
        $count++;
    }
            } else {
                echo '
                <tr>
                    <td class="windowbg" align="center">'.$txt['smfg_no_modifications'].'</td>
                </tr>';
            }
    
    echo '     
        </table>     
        </div>
        <div class="garage_panel" id="options003" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td colspan="',($context['view_own_vehicle'] == 1) ? '10' : '9','" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_qmile_runs'].'</td>
            </tr>';
            $count = 0;
            if(isset($context['qmiles'][$count]['id'])) {
            echo '
            <tr>
                <td class="catbg">&nbsp;</td>
                <td class="catbg">'.$txt['smfg_rt'].'</td>
                <td class="catbg">'.$txt['smfg_sixty'].'</td>
                <td class="catbg">'.$txt['smfg_three_thiry'].'</td>
                <td class="catbg">'.$txt['smfg_eighth'].'</td>
                <td class="catbg">'.$txt['smfg_eighth_mph'].'</td>
                <td class="catbg">'.$txt['smfg_thou'].'</td>
                <td class="catbg">'.$txt['smfg_quart'].'</td>
                <td class="catbg">'.$txt['smfg_quart_mph'].'</td>
                ',($context['view_own_vehicle'] == 1) ? '<td class="catbg">&nbsp;</td>' : '','
            </tr>
            ';
            
    // Loop through each quartermile  
    while(isset($context['qmiles'][$count]['id']))    {
        echo '<tr class="windowbg">
                <td align="center" style="width: 25px;  white-space: nowrap;">'.$context['qmiles'][$count]['image'].$context['qmiles'][$count]['spacer'].$context['qmiles'][$count]['video'].'</td>
                <td align="center">'.$context['qmiles'][$count]['rt'].'</td>
                <td align="center">'.$context['qmiles'][$count]['sixty'].'</td>
                <td align="center">'.$context['qmiles'][$count]['three'].'</td>
                <td align="center">'.$context['qmiles'][$count]['eighth'].'</td>
                <td align="center">'.$context['qmiles'][$count]['eighthmph'].' MPH</td>
                <td align="center">'.$context['qmiles'][$count]['thou'].'</td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_quartermile;VID='.$_GET['VID'].';QID='.$context['qmiles'][$count]['id'].'">'.garage_title_clean($context['qmiles'][$count]['quart']).'</a></td>
                <td align="center">'.$context['qmiles'][$count]['quartmph'].' MPH</td>';                

        if ($context['view_own_vehicle'] == 1){
            echo '
                <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=edit_quartermile;VID='.$context['user_vehicles']['id'].';QID='.$context['qmiles'][$count]['id'].'"><img src="'. $settings['default_images_url'] . '/garage_edit.gif" alt="'.$txt['smfg_edit'].'" title="'.$txt['smfg_edit'].'" /></a>
                <form action="'.$scripturl.'?action=garage;sa=delete_quartermile;VID='.$context['user_vehicles']['id'].';QID='.$context['qmiles'][$count]['id'].';sesc=' . $context['session_id'] . '" method="post" name="remove_quartermile_'.$context['qmiles'][$count]['id'].'" id="remove_quartermile_'.$context['qmiles'][$count]['id'].'" style="display: inline;">
                    <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['user_vehicles']['id'].'" />
                    <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_quartermile'].'\')) { document.remove_quartermile_'.$context['qmiles'][$count]['id'].'.submit(); } else { return false; } return false;"><img src="'. $settings['default_images_url'] . '/garage_delete.gif" alt="'.$txt['smfg_delete'].'" title="'.$txt['smfg_delete'].'" /></a>
                </form></td>';
        }

        echo '
            </tr>
            ';
        $count++;
    }
            } else {
                echo '
                <tr>
                    <td class="windowbg" align="center">'.$txt['smfg_no_quartermiles'].'</td>
                </tr>';
            }
    echo '      
        </table>     
        </div>
        <div class="garage_panel" id="options004" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td colspan="',($context['view_own_vehicle'] == 1) ? '11' : '10','" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_dynoruns'].'</td>
            </tr>';
            $count = 0;
            if(isset($context['dynoruns'][$count]['id'])) {
            echo '
            <tr>
                <td class="catbg">&nbsp;</td>
                <td class="catbg">'.$txt['smfg_dynocenter'].'</td>
                <td class="catbg">'.$txt['smfg_bhp'].'</td>
                <td class="catbg">'.$txt['smfg_bhp_type'].'</td>
                <td class="catbg">'.$txt['smfg_torque'].'</td>
                <td class="catbg">'.$txt['smfg_torque_type'].'</td>
                <td class="catbg">'.$txt['smfg_boost'].'</td>
                <td class="catbg">'.$txt['smfg_boost_type'].'</td>
                <td class="catbg">'.$txt['smfg_nitrous'].'</td>
                <td class="catbg">'.$txt['smfg_peakpoint'].'</td>
                ',($context['view_own_vehicle'] == 1) ? '<td class="catbg">&nbsp;</td>' : '','
            </tr>
            ';
            
    // Loop through each dynorun   
    while(isset($context['dynoruns'][$count]['id']))    {
        echo '<tr class="windowbg">
                <td align="center" style="width: 25px;  white-space: nowrap;">'.$context['dynoruns'][$count]['image'].$context['dynoruns'][$count]['spacer'].$context['dynoruns'][$count]['video'].'</td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=dc_review;BID='.$context['dynoruns'][$count]['dynocenter_id'].'">'.garage_title_clean($context['dynoruns'][$count]['dynocenter']).'</a></td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_dynorun;VID='.$context['user_vehicles']['id'].';DID='.$context['dynoruns'][$count]['id'].'">'.garage_title_clean($context['dynoruns'][$count]['bhp']).'</a></td>
                <td align="center">'.$context['dynoruns'][$count]['bhp_unit'].'</td>
                <td align="center">'.$context['dynoruns'][$count]['torque'].'</td>
                <td align="center">'.$context['dynoruns'][$count]['torque_unit'].'</td>
                <td align="center">'.$context['dynoruns'][$count]['boost'].'</td>
                <td align="center">'.$context['dynoruns'][$count]['boost_unit'].'</td>
                <td align="center">'.$context['dynoruns'][$count]['nitrous'].' '.$txt['smfg_shot'].'</td>
                <td align="center">'.$context['dynoruns'][$count]['peakpoint'].' '.$txt['smfg_rpm'].'</td>';

        if ($context['view_own_vehicle'] == 1){
            echo '
                <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=edit_dynorun;VID='.$context['user_vehicles']['id'].';DID='.$context['dynoruns'][$count]['id'].'"><img src="'. $settings['default_images_url'] . '/garage_edit.gif" alt="'.$txt['smfg_edit'].'" title="'.$txt['smfg_edit'].'" /></a>
                <form action="'.$scripturl.'?action=garage;sa=delete_dynorun;VID='.$context['user_vehicles']['id'].';DID='.$context['dynoruns'][$count]['id'].';sesc=' . $context['session_id'] . '" method="post" name="remove_dynorun_'.$context['dynoruns'][$count]['id'].'" id="remove_dynorun_'.$context['dynoruns'][$count]['id'].'" style="display: inline;">
                    <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['user_vehicles']['id'].'" />
                    <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_dynorun'].'\')) { document.remove_dynorun_'.$context['dynoruns'][$count]['id'].'.submit(); } else { return false; } return false;"><img src="'. $settings['default_images_url'] . '/garage_delete.gif" alt="'.$txt['smfg_delete'].'" title="'.$txt['smfg_delete'].'" /></a>
                </form></td>';
        }

        echo '
            </tr>
            ';
        $count++;
    }
            } else {
                echo '
                <tr>
                    <td class="windowbg" align="center">'.$txt['smfg_no_dynoruns'].'</td>
                </tr>';
            }
    echo '      
        </table>     
        </div>
        <div class="garage_panel" id="options005" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td colspan="',($context['view_own_vehicle'] == 1) ? '6' : '5','" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_laps'].'</td>
            </tr>';
            $count = 0;
            if(isset($context['laps'][$count]['id'])) {
            echo '
            <tr>
                <td class="catbg">&nbsp;</td>
                <td class="catbg">'.$txt['smfg_track'].'</td>
                <td class="catbg">'.$txt['smfg_condition'].'</td>
                <td class="catbg">'.$txt['smfg_type'].'</td>
                <td class="catbg">'.$txt['smfg_laptime_specs'].'</td>
                ',($context['view_own_vehicle'] == 1) ? '<td class="catbg">&nbsp;</td>' : '','
            </tr>
            ';
            
    // Loop through each lap  
    while(isset($context['laps'][$count]['id'])) {
        echo '<tr class="windowbg">
                <td align="center" style="width: 25px;  white-space: nowrap;">'.$context['laps'][$count]['image'].$context['laps'][$count]['spacer'].$context['laps'][$count]['video'].'</td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_track;TID='.$context['laps'][$count]['track_id'].'">'.garage_title_clean($context['laps'][$count]['track']).'</a></td>
                <td align="center">'.$context['laps'][$count]['condition'].'</td>
                <td align="center">'.$context['laps'][$count]['type'].'</td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_laptime;VID='.$context['user_vehicles']['id'].';LID='.$context['laps'][$count]['id'].'">'.garage_title_clean($context['laps'][$count]['time']).'</a></td>';

        if ($context['view_own_vehicle'] == 1) {
            echo '
                <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=edit_laptime;VID='.$context['user_vehicles']['id'].';LID='.$context['laps'][$count]['id'].'"><img src="'. $settings['default_images_url'] . '/garage_edit.gif" alt="'.$txt['smfg_edit'].'" title="'.$txt['smfg_edit'].'" /></a>
                <form action="'.$scripturl.'?action=garage;sa=delete_laptime;VID='.$context['user_vehicles']['id'].';LID='.$context['laps'][$count]['id'].';sesc=' . $context['session_id'] . '" method="post" name="remove_laptime_'.$context['laps'][$count]['id'].'" id="remove_laptime_'.$context['laps'][$count]['id'].'" style="display: inline;">
                    <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['user_vehicles']['id'].'" />
                    <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_laptime'].'\')) { document.remove_laptime_'.$context['laps'][$count]['id'].'.submit(); } else { return false; } return false;"><img src="'. $settings['default_images_url'] . '/garage_delete.gif" alt="'.$txt['smfg_delete'].'" title="'.$txt['smfg_delete'].'" /></a>
                </form></td>';
        }
            
        echo '
            </tr>
            ';
        $count++;
    }
            } else {
                echo '
                <tr>
                    <td class="windowbg" align="center">'.$txt['smfg_no_laps'].'</td>
                </tr>';
            }
    echo '      
        </table>     
        </div>
        <div class="garage_panel" id="options006" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td colspan="',($context['view_own_vehicle'] == 1) ? '4' : '3','" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_premiums'].'</td>
            </tr>';
            $count = 0;
            if(isset($context['premiums'][$count]['id'])) {
            echo '
            <tr>
                <td class="catbg">'.$txt['smfg_insurer'].'</td>
                <td class="catbg">'.$txt['smfg_premium'].'</td>
                <td class="catbg">'.$txt['smfg_cover_type'].'</td>
                ',($context['view_own_vehicle'] == 1) ? '<td class="catbg">&nbsp;</td>' : '','
            </tr>
            ';
            
    // Loop through each premium
    while(isset($context['premiums'][$count]['id']))    {
        echo '<tr class="windowbg">
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=insurance_review;BID='.$context['premiums'][$count]['insurer_id'].'">'.garage_title_clean($context['premiums'][$count]['insurer']).'</a></td>
                <td align="center">'.$context['premiums'][$count]['premium'].'</td>
                <td align="center">'.$context['premiums'][$count]['cover_type'].'</td>';

        if ($context['view_own_vehicle'] == 1){
            echo '
                <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=edit_insurance;VID='.$context['user_vehicles']['id'].';INS_ID='.$context['premiums'][$count]['id'].'"><img src="'. $settings['default_images_url'] . '/garage_edit.gif" alt="'.$txt['smfg_edit'].'" title="'.$txt['smfg_edit'].'" /></a>
                <form action="'.$scripturl.'?action=garage;sa=delete_insurance;VID='.$context['user_vehicles']['id'].';INS_ID='.$context['premiums'][$count]['id'].';sesc=' . $context['session_id'] . '" method="post" name="remove_insurance_'.$context['premiums'][$count]['id'].'" id="remove_insurance_'.$context['premiums'][$count]['id'].'" style="display: inline;">
                    <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['user_vehicles']['id'].'" />
                    <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_premium'].'\')) { document.remove_insurance_'.$context['premiums'][$count]['id'].'.submit(); } else { return false; } return false;"><img src="'. $settings['default_images_url'] . '/garage_delete.gif" alt="'.$txt['smfg_delete'].'" title="'.$txt['smfg_delete'].'" /></a>
                </form></td>';
        }

        echo '
            </tr>
            ';
        $count++;
    }
            } else {
                echo '
                <tr>
                    <td class="windowbg" align="center">'.$txt['smfg_no_premiums'].'</td>
                </tr>';
            }
    echo '     
        </table>     
        </div>
        <div class="garage_panel" id="options007" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td colspan="',($context['view_own_vehicle'] == 1) ? '6' : '5','" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_services'].'</td>
            </tr>';
            $count = 0;
            if(isset($context['services'][$count]['id'])) {
            echo '
            <tr>
                <td class="catbg">'.$txt['smfg_garage'].'</td>
                <td class="catbg">'.$txt['smfg_type'].'</td>
                <td class="catbg">'.$txt['smfg_cost'].'</td>
                <td class="catbg">'.$txt['smfg_rating'].'</td>
                <td class="catbg">'.$txt['smfg_mileage'].'</td>
                ',($context['view_own_vehicle'] == 1) ? '<td class="catbg">&nbsp;</td>' : '','
            </tr>
            ';
            
    // Loop through each service  
    while(isset($context['services'][$count]['id'])) {
        echo '<tr class="windowbg">
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=garage_review;BID='.$context['services'][$count]['garage_id'].'">'.garage_title_clean($context['services'][$count]['garage']).'</a></td>
                <td align="center">'.$context['services'][$count]['type'].'</td>
                <td align="center">'.$context['services'][$count]['price'].'</td>
                <td align="center">'.$context['services'][$count]['rating'].'</td>
                <td align="center">'.$context['services'][$count]['mileage'].'</td>';

        if ($context['view_own_vehicle'] == 1) {
            echo '
                <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=edit_service;VID='.$context['user_vehicles']['id'].';SID='.$context['services'][$count]['id'].'"><img src="'. $settings['default_images_url'] . '/garage_edit.gif" alt="'.$txt['smfg_edit'].'" title="'.$txt['smfg_edit'].'" /></a>
                <form action="'.$scripturl.'?action=garage;sa=delete_service;VID='.$context['user_vehicles']['id'].';SID='.$context['services'][$count]['id'].';sesc=' . $context['session_id'] . '" method="post" name="remove_service_'.$context['services'][$count]['id'].'" id="remove_service_'.$context['services'][$count]['id'].'" style="display: inline;">
                    <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['user_vehicles']['id'].'" />
                    <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_service'].'\')) { document.remove_service_'.$context['services'][$count]['id'].'.submit(); } else { return false; } return false;"><img src="'. $settings['default_images_url'] . '/garage_delete.gif" alt="'.$txt['smfg_delete'].'" title="'.$txt['smfg_delete'].'" /></a>
                </form></td>';
        }

        echo '
              </tr>
            ';
        $count++;
    }
            } else {
                echo '
                <tr>
                    <td class="windowbg" align="center">'.$txt['smfg_no_services'].'</td>
                </tr>';
            }
    echo '   
        </table>     
        </div>
        <div class="garage_panel" id="options008" style="display: none;">';
   
   if ($context['view_own_vehicle'] == 1) {
       echo'
            <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="left" nowrap="nowrap">';
                echo $txt['139'].': '.$context['blog']['page_index'];
                echo '</td>
            </tr>
            <tr>
                <td class="windowbg">
                <form action="'.$scripturl.'?action=garage;sa=insert_blog" method="post" name="add_blog" id="add_blog" style="padding:0; margin:0;">
                <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$_GET['VID'].'#blog" />
                <table width="100%" cellspacing="1" cellpadding="3" border="0" class="bordercolor">
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="5">'.$txt['smfg_add_blog_entry'].'</td>
                </tr>
                <tr>
                    <td class="windowbg2" align="right" width="20%">'.$txt['smfg_blog_title'].'</td>
                    <td class="windowbg" colspan="1"><input name="blog_title" type="text" size="60" value="" /></td>
                </tr>
                <tr>
                    <td class="windowbg2" align="right" width="20%">'.$txt['smfg_add_blog_entry'].'<br /><br />', $smfgSettings['enable_blogs_bbcode'] ? $txt['smfg_bbc_supported'] : $txt['smfg_bbc_disabled'] ,'<br />' . $txt['smfg_html_supported'] . '</td>
                    <td class="windowbg" colspan="1"><textarea name="blog_text" cols="70" rows="6"></textarea></td>
                </tr>
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="5"><input type="hidden" value="'.$_GET['VID'].'" name="VID" /><input type="hidden" value="'.$context['user']['id'].'" name="user_id" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="submit" type="submit" value="'.$txt['smfg_add_blog_entry'].'"/></td>
                </tr>
            </table>
            </form>';
   }
        
    echo '
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">';
                $count=0;
                if(isset($context['blog'][$count]['id'])) {
                while(isset($context['blog'][$count]['id'])) {
                echo '
                <tr>
                    <td class="windowbg2" colspan="2">',($context['view_own_vehicle'] == 1) ? '<div style="float:right"><a href="'.$scripturl.'?action=garage;sa=edit_blog;VID='.$context['user_vehicles']['id'].';BID='.$context['blog'][$count]['id'].'"><img src="'. $settings['default_images_url'] . '/garage_edit.gif" alt="'.$txt['smfg_edit'].'" title="'.$txt['smfg_edit'].'" /></a>
                            <form action="'.$scripturl.'?action=garage;sa=delete_blog;VID='.$context['user_vehicles']['id'].';BID='.$context['blog'][$count]['id'].';sesc=' . $context['session_id'] . '" method="post" name="remove_blog_'.$context['blog'][$count]['id'].'" id="remove_blog_'.$context['blog'][$count]['id'].'" style="display: inline;">
                                <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['user_vehicles']['id'].'#blog" />
                                <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_blog'].'\')) { document.remove_blog_'.$context['blog'][$count]['id'].'.submit(); } else { return false; } return false;"><img src="'. $settings['default_images_url'] . '/garage_delete.gif" alt="'.$txt['smfg_delete'].'" title="'.$txt['smfg_delete'].'" /></a>
                            </form>
                            </div>' : '','<b>'.$context['blog'][$count]['title'].'</b><br />
                    <span class="smalltext">'.$txt['smfg_posted'].': '.date($context['date_format'],$context['blog'][$count]['post_date']).'</span>
                    <hr />'.$context['blog'][$count]['text'].'<hr /></td>
                </tr>';
                $count++;
                }
                } else {
                    echo '
                    <tr>
                        <td class="windowbg2" colspan="2" align="center">'.$txt['smfg_no_blogs'].'</td>
                    </tr>';
                }
    if ($context['view_own_vehicle'] == 1){
        echo '
        </table>
                <script language="JavaScript" type="text/javascript">
                var frmvalidator = new Validator("add_blog");
                
                frmvalidator.addValidation("blog_title","req","'.$txt['smfg_val_enter_blog_title'].'");
                frmvalidator.addValidation("blog_text","req","'.$txt['smfg_val_enter_blog_text'].'");
                frmvalidator.addValidation("blog_text","maxlen=5000","'.$txt['smfg_val_blog_restrictions'].'");
                </script>
                </td>
            </tr>    
        </table>     
        </div>';
    } else {
        echo'
        </table>     
        </div>';
    }
    
    echo ' 
        <div class="garage_panel" id="options009" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="left" nowrap="nowrap">';
                echo $txt['139'].': '.$context['gb']['page_index'];
                echo '</td>
            </tr>
            <tr>
                <td class="windowbg">
                <form action="'.$scripturl.'?action=garage;sa=insert_comment" method="post" name="add_comment" id="add_comment" style="padding:0; margin:0;">
                <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['user_vehicles']['id'].'#guestbook" />
                <table width="100%" cellspacing="1" cellpadding="3" border="0" class="bordercolor">';                    
                    $count = 0; 
                    $forms = '';
                    if(isset($context['gb'][$count]['comment'])) {
                        echo '
                        <tr>
                            <td class="catbg">'.$txt['smfg_author'].'</td>
                            <td class="catbg">'.$txt['smfg_message'].'</td>
                        </tr>';
                        while(isset($context['gb'][$count]['comment'])) {
                        loadMemberData(ARRAY($context['gb'][$count]['author_id']));
                        $avatarimg = "";
                        if ($user_profile[$context['gb'][$count]['author_id']]['ID_ATTACH'])
                          $avatarimg = '<img src="'.$scripturl.'?action=dlattach;attach='.$user_profile[$context['gb'][$count]['author_id']]['ID_ATTACH'].';type=avatar" alt="" class="avatar" border="0" /><br />';
                        echo '
                        <tr class="windowbg2">
                            <td width="150" align="center" valign="middle">
                            '.$avatarimg.'<b><a href="'.$scripturl.'?action=profile;u='.$context['gb'][$count]['author_id'].'">'.$context['gb'][$count]['author'].'</a></b>
                            <table cellspacing="4" align="center" width="150">
                                <tr>
                                    <td class="smalltext"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['gb'][$count]['author_VID'].'">'.garage_title_clean($context['gb'][$count]['author_vehicle']).'</a></td>
                                </tr>
                            </table>
                            <table cellspacing="4" border="0">
                                <tr>
                                    <td nowrap="nowrap"><span class="smalltext"><b>'.$txt['smfg_joined'].':</b>&nbsp;'.date($context['date_format'],$context['gb'][$count]['date_reg']).'<br /><b>'.$txt['smfg_posts'].':</b>&nbsp;'.$context['gb'][$count]['posts'].'</span>
                                    </td>
                                </tr>
                            </table>
                            </td>
                            <td valign="top">
                            <table width="100%" cellspacing="0">
                                <tr>
                                    <td class="smalltext" width="100%"><div style="float:right"><b>'.$txt['smfg_posted'].':</b>&nbsp;'.date($context['date_format'],$context['gb'][$count]['post_date']).'&nbsp;</div>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" cellspacing="5">
                                <tr>
                                    <td>
                                    <div class="postbody">'.$context['gb'][$count]['comment'].'</div>
                                    <br clear="all" /><br />
                                    <table width="100%" cellspacing="0">
                                        <tr valign="middle">
                                            <td class="smalltext" align="right">';
                                            if($context['user']['is_admin']) {
                                                echo '<img src="'. $settings['actual_images_url'] . '/ip.gif" alt="IP" title="IP" />&nbsp;<a href="'.$scripturl.'?action=trackip;searchip='.$context['gb'][$count]['author_ip'].'">'.$context['gb'][$count]['author_ip'].'</a>&nbsp;<a href="'.$scripturl.'?action=helpadmin;help=see_admin_ip" onclick="return reqWin(this.href);" class="help">(?)</a>';
                                            }
                                            echo '
                                            </td>
                                        </tr>
                                    </table>
                                    </td>
                                </tr>
                            </table>
                            </td>
                        </tr>
                        <tr class="windowbg2">
                            <td nowrap="nowrap">&nbsp;</td>
                            <td><div class="smalltext" style="float: left;">&nbsp;&nbsp;</div><div class="gensmall" style="float:right">'; 
                            // If the reader is the author, let them edit it
                            if($context['user']['id'] == $context['gb'][$count]['author_id'] | allowedTo('edit_all_comments')) {
                                echo '<a href="'.$scripturl.'?action=garage;sa=edit_comment;VID='.$context['user_vehicles']['id'].';CID='.$context['gb'][$count]['CID'].'"><img src="'. $settings['default_images_url'] . '/garage_edit.gif" alt="Edit" title="Edit" /></a>&nbsp;<a href="#" onClick="if (confirm(\''.$txt['smfg_delete_comment'].'\')) { document.delete_comment_'.$context['gb'][$count]['CID'].'.submit(); } else { return false; } return false;"><img src="'. $settings['default_images_url'] . '/garage_delete.gif" alt="Delete" title="Delete" /></a>'; 
                                $forms .= '
                                <form action="'.$scripturl.'?action=garage;sa=delete_comment;VID='.$context['user_vehicles']['id'].';CID='.$context['gb'][$count]['CID'].';sesc='.$context['session_id'].'" method="post" name="delete_comment_'.$context['gb'][$count]['CID'].'" id="delete_comment_'.$context['gb'][$count]['CID'].'" style="display: inline;">
                                <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['user_vehicles']['id'].'#guestbook" />
                                </form>';
                            }
                            echo '</div></td>
                        </tr>
                        <tr>
                            <td class="catbg" colspan="2" height="1"><img src="'. $settings['default_images_url'] . '/spacer.gif" alt="" width="1" height="1" />
                            </td>
                        </tr>';
                        $count++;
                        }
                    } else {
                       echo '
                       <tr>
                            <td class="windowbg" colspan="2" align="center">'.$txt['smfg_no_comments'].'</td>
                       </tr>';
                    } 
                    
                if($context['user']['is_logged'] && AllowedTo('post_comments')) { 
                                      
                    echo '   
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="5">'.$txt['smfg_add_comment'].'</td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="20%">'.$txt['smfg_add_comment'].'<br /><br />', $smfgSettings['enable_guestbooks_bbcode'] ? $txt['smfg_bbc_supported'] : $txt['smfg_bbc_disabled'] ,'<br />' . $txt['smfg_html_supported'] . '</td>
                        <td class="windowbg"><textarea name="post" cols="70" rows="7"></textarea></td>
                    </tr>
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="5"><input type="hidden" value="'.$_GET['VID'].'" name="VID" /><input type="hidden" value="'.$context['user']['id'].'" name="user_id" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="submit" type="submit" value="'.$txt['smfg_post_comment'].'" /></td>
                    </tr>';
                
                }
                
                echo '
                </table>
                </form>
                '.$forms.'';
                if($context['user']['is_logged'] && AllowedTo('post_comments')) { 
                                      
                    echo ' 
                    <script language="JavaScript" type="text/javascript">
                    var frmvalidator = new Validator("add_comment");
                    frmvalidator.addValidation("post","req","Please enter a comment.");
                    frmvalidator.addValidation("post","maxlen=2500","Max length for comments is 2500 characters.");
                    </script>';
                
                }
                echo '
                </td>
            </tr>    
        </table>     
        </div>

<script type="text/javascript">
<!--
    var lowest_tab = \'000\';
    var active_id = \'000\';
    if (document.location.hash == "")
    {
        change_tab(lowest_tab);
    }
    else if (document.location.hash == "#images")
    {
        change_tab(\'000\');
    }
    else if (document.location.hash == "#videos")
    {
        change_tab(\'001\');
    }
    else if (document.location.hash == "#modifications")
    {
        change_tab(\'002\');
    }
    else if (document.location.hash == "#quartermiles")
    {
        change_tab(\'003\');
    }
    else if (document.location.hash == "#dynoruns")
    {
        change_tab(\'004\');
    }
    else if (document.location.hash == "#laps")
    {
        change_tab(\'005\');
    }
    else if (document.location.hash == "#premiums")
    {
        change_tab(\'006\');
    }
    else if (document.location.hash == "#services")
    {
        change_tab(\'007\');
    }
    else if (document.location.hash == "#blog")
    {
        change_tab(\'008\');
    }
    else if (document.location.hash == "#guestbook")
    {
        change_tab(\'009\');
    }

//-->

</script>
</td>
</tr>

<tr>
    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28"></td>
</tr>
</table>';
    
    echo smfg_footer();

}

function template_add_vehicle()
{
global $context, $settings, $options, $txt, $scripturl, $db_prefix, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

 // List Model Options
 echo model_options('add_vehicle');
    
 echo '
<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_create_vehicle'] . '</td>
    </tr>';
        
        // Make?
        if($_SESSION['added_make']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_make_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a mod is added
            unset($_SESSION['added_make']);
        }
        
        // Model?
        if($_SESSION['added_model']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_model_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a mod is added
            unset($_SESSION['added_model']);
        }
        
    echo'
    <tr>
        <td class="windowbg">
            <form action="' . $scripturl . '?action=garage;sa=insert_vehicle" id="add_vehicle" enctype="multipart/form-data" method="post" name="add_vehicle" style="padding:0; margin:0;">
            <input type="hidden" name="redirecturl" value="' . $scripturl . '?action=garage;sa=view_vehicle;VID={VID}" />
            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
    
echo '
    <tr>
        <td class="windowbg2" width="20%" align="right"><b>'.$txt['smfg_year'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
        <td class="windowbg"><select id="made_year" name="made_year">
        ';
// List the Year Range Options
echo year_options($smfgSettings['year_start'], $smfgSettings['year_end']);

echo'</select>
        </td>
    </tr>
    
    <tr>
        <td class="windowbg2" width="20%" align="right"><b>'.$txt['smfg_make'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
        <td class="windowbg"><select id="make_id" name="make_id">
                             <option value="">'.$txt['smfg_select_make1'].'</option>
                             <option value="">------</option>';
                             // List Make Selections
                             echo make_select();
                             echo'</select>';
                             if($smfgSettings['enable_user_submit_make']) {
                             echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_make" rel="shadowbox;width=620;height=150" title="Garage :: Submit Make">'.$txt['smfg_here'].'</a>';
                             }
        echo '                             
        </td>
    </tr>
    
    <tr>
        <td class="windowbg2" width="20%" align="right"><b>'.$txt['smfg_model'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
        <td class="windowbg"><select id="model_id" name="model_id">
                             <script type="text/javascript">dol.printOptions("model_id")</script>
                             </select>';
                             if($smfgSettings['enable_user_submit_model']) {
                             echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_model" rel="shadowbox;width=620;height=200" title="Garage :: Submit Model">'.$txt['smfg_here'].'</a>';
                             }
        echo '
        </td>
    </tr>
    
    <tr>
        <td class="windowbg2" width="20%" align="right"><b>'.$txt['smfg_engine_type'].'</b></td>
        <td class="windowbg"><select id="engine_type" name="engine_type">
                             <option value="">'.$txt['smfg_select_engine_type'].'</option>
                             <option value="">------</option>';
                             echo engine_type_select();
                             echo '
                             </select>
        </td>
    </tr>
    
    <tr>
        <td class="windowbg2" width="20%" align="right"><b>'.$txt['smfg_color'].'</b></td>
        <td class="windowbg"><input name="color" type="text" size="20" value="" /></td>
    </tr>
    
    <tr>
        <td class="windowbg2" width="20%" align="right"><b>'.$txt['smfg_mileage'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
        <td class="windowbg"><input name="mileage" type="text" size="15" value="" />&nbsp;
                             <select id="mileage_units" name="mileage_units">
                             <option value="">'.$txt['smfg_select_mileage_type'].'</option>
                             <option value="">------</option>
                             <option value="Miles" >'.$txt['smfg_miles'].'</option>
                             <option value="Kilometers" >'.$txt['smfg_kilometers'].'</option>
                             </select>
        </td>
    </tr>
    
    <tr>
        <td class="windowbg2" width="20%" align="right"><b>'.$txt['smfg_purchased_price'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
        <td class="windowbg"><input name="price" type="text" size="10" value="" />&nbsp;'.$txt['smfg_currency'].':&nbsp;
                             <select id="currency" name="currency">
                             <option value="">'.$txt['smfg_select_currency'].'</option>
                             <option value="">------</option>';
                             echo currency_select();
                             echo '
                             </select>
        </td>
    </tr>
    
    <tr>
        <td class="windowbg2" width="20%" align="right"><b>'.$txt['smfg_description'].'</b></td>
        <td class="windowbg"><textarea name="comments" cols="60" rows="5"></textarea></td>
    </tr>';
    
    // Show the input for images if it is enabled
    if($smfgSettings['enable_vehicle_images']) {
    echo '
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="2">'.$txt['smfg_image_attachments'].'</td>
    </tr>
    
    <tr>
        <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_attach_image'].'.<br />'.$txt['smfg_max_filesize'].': '.$smfgSettings['max_image_kbytes'].' '.$txt['smfg_kbytes'].'<br />'.$txt['smfg_max_resolution'].': '.$smfgSettings['max_image_resolution'].'x'.$smfgSettings['max_image_resolution'].'</b></td>
        <td class="windowbg"><input type="hidden" name="MAX_FILE_SIZE" value="'.$context['max_image_bytes'].'" /><input type="file" size="30" name="FILE_UPLOAD"/></td>
    </tr>';
    
    // Show the input for remote images if it is enabled
    if($smfgSettings['enable_remote_images']) {
    echo '    
    <tr>
        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_enter_remote_url'].'</b></td>
        <td class="windowbg"><input name="url_image" type="text" size="40" maxlength="255" value="http://" /></td>
    </tr>';
    }
    
    echo '    
    <tr>
        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
        <td class="windowbg"><textarea name="attach_desc" cols="60" rows="3"></textarea></td>
    </tr>';
    
    }    
    
    // Show the input for videos if it is enabled
    if($smfgSettings['enable_vehicle_video']) {
    echo '
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="2">'.$txt['smfg_hosted_videos'].'</td>
    </tr>
    
    <tr>
        <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_title'].'</b></td>
        <td class="windowbg"><input type="text"  size="40" maxlength="75" value="" name="video_title"/></td>
    </tr>
    <tr>
        <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_url'].'</b></td>
        <td class="windowbg"><input type="text"  size="40" maxlength="255" value="http://" name="video_url"/>&nbsp;<span class="smalltext"><a href="'.$scripturl.'?action=garage;sa=supported_video" rel="shadowbox;width=260;height=400" title="'.$txt['smfg_video_instructions'].'">Supported Sites</a></span></td>
    </tr>';
    
    echo '    
    <tr>
        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
        <td class="windowbg"><textarea name="video_desc" cols="60" rows="3"></textarea></td>
    </tr>';
    
    }
    
    echo '    
    <tr>
        <td colspan="2" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28"><input type="hidden" value="" name="VID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="'.$txt['smfg_create_vehicle'].'" type="submit" value="'.$txt['smfg_create_vehicle'].'" /></td>
    </tr>';

echo '
    </table>
    </form>
</td>
</tr>
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28">&nbsp;</td>
    </tr>
</table>
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("add_vehicle");
 var frm = document.forms["add_vehicle"];
 
 frmvalidator.addValidation("made_year","req","'.$txt['smfg_val_select_year'].'");
 frmvalidator.addValidation("made_year","dontselect=0","'.$txt['smfg_val_select_year'].'");
 
 frmvalidator.addValidation("make_id","req","'.$txt['smfg_val_select_make'].'");
 frmvalidator.addValidation("make_id","dontselect=0","'.$txt['smfg_val_select_make'].'");
 frmvalidator.addValidation("make_id","dontselect=1","'.$txt['smfg_val_select_make'].'");
 
 frmvalidator.addValidation("model_id","req","'.$txt['smfg_val_select_model'].'");
 
 frmvalidator.addValidation("color","regexp=^[ /A-Za-z1-9]{1,20}$","'.$txt['smfg_val_color_requirements'].'");
 
 frmvalidator.addValidation("mileage","req","'.$txt['smfg_val_enter_mileage'].'");
 frmvalidator.addValidation("mileage","numeric","'.$txt['smfg_val_mileage_numeric'].'");
 
 frmvalidator.addValidation("mileage_units","req","'.$txt['smfg_val_select_mileage_unit'].'");
 frmvalidator.addValidation("mileage_units","dontselect=0","'.$txt['smfg_val_select_mileage_unit'].'");
  
 frmvalidator.addValidation("price","req","'.$txt['smfg_val_enter_purchased_price'].'");
 frmvalidator.addValidation("price","regexp=^[.0-9]{1,10}$","'.$txt['smfg_val_purchased_price_numeric_vehicle'].'");

 frmvalidator.addValidation("currency","req","'.$txt['smfg_val_select_currency'].'");
 frmvalidator.addValidation("currency","dontselect=0","'.$txt['smfg_val_select_currency'].'");
  
 frmvalidator.addValidation("comments","maxlen=500","'.$txt['smfg_val_description_length'].'");';
 if($smfgSettings['enable_vehicle_images']) {
     echo '
        frmvalidator.addValidation("attach_desc","maxlen=150","'.$txt['smfg_val_image_description_length'].'");';
 }
 if($smfgSettings['enable_vehicle_video']) {
     echo '
        frmvalidator.addValidation("video_desc","maxlen=150","'.$txt['smfg_val_video_description_length'].'");';
 }
 echo '
</script>';
    
    echo smfg_footer();

}

function template_edit_vehicle()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings, $boardurl;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
<tr>
    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_edit_vehicle'] . '</td>
</tr>

<tr>
    <td class="windowbg">
    
    <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;" id="tab_table">
            <tr id="tab_row">
                <td class="mirrortab_first" id="tab_first">&nbsp;</td>

                <td class="mirrortab_active_first" id="tab_active_left">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back" id="tab000">
                    <a href="#vehicle" onclick="change_tab(\'000\');">'.$txt['smfg_vehicle'].'</a>
                </td>
                <td class="mirrortab_active_last" id="tab_active_right">&nbsp;</td>';
                // Show the input for images if it is enabled
                if($smfgSettings['enable_vehicle_images']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab001">
                    <a href="#images" onclick="change_tab(\'001\');">'.$txt['smfg_images'].'</a>
                </td>';
                }
                // Show the input for videos if it is enabled
                if($smfgSettings['enable_vehicle_video']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab002">
                    <a href="#video" onclick="change_tab(\'002\');">'.$txt['smfg_video'].'</a>
                </td>';
                }
                echo '
                <td class="mirrortab_last">&nbsp;</td>

            </tr>
    </table>';
        
        // Begin dynamic js divs
        echo '        
        <div class="garage_panel" id="options000" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_vehicle'].'</td>
            </tr>';
        
        // Make?
        if($_SESSION['added_make']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_make_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a mod is added
            unset($_SESSION['added_make']);
        }
        
        // Model?
        if($_SESSION['added_model']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_model_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a mod is added
            unset($_SESSION['added_model']);
        }
        
    echo'
            <tr>
                <td class="windowbg">';
                
 // List Model Options
 echo model_options("update_vehicle");
 echo '<script language="JavaScript" type="text/javascript">dol.forField("model_id").setValues('.$context['user_vehicles']['model_id'].');</script>';

 echo '

    <form action="' . $scripturl . '?action=garage;sa=update_vehicle" id="update_vehicle" enctype="multipart/form-data" method="post" name="update_vehicle" style="padding:0; margin:0;">
    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
    
echo '
    <tr>
        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_year'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
        <td class="windowbg"><select id="made_year" name="made_year">
        ';
        // List the Year Range Options
        echo year_options($smfgSettings['year_start'], $smfgSettings['year_end'], $context['user_vehicles']['made_year']);

        echo'</select>
        </td>
    </tr>
    
    <tr>
        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_make'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
        <td class="windowbg"><select id="make_id" name="make_id">';
                             // List Make Selections
                             echo make_select($context['user_vehicles']['make_id']);
                             echo'</select>';
                             if($smfgSettings['enable_user_submit_make']) {
                             echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_make" rel="shadowbox;width=620;height=150" title="Garage :: Submit Make">'.$txt['smfg_here'].'</a>';
                             }
        echo '
        </td>
    </tr>
    
    <tr>
        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_model'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
        <td class="windowbg"><select id="model_id" name="model_id">
                             <script type="text/javascript">dol.printOptions("model_id")</script>
                             </select>';
                             if($smfgSettings['enable_user_submit_model']) {
                             echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_model" rel="shadowbox;width=620;height=200" title="Garage :: Submit Model">'.$txt['smfg_here'].'</a>';
                             }
        echo '                             
        </td>
    </tr>
    
    <tr>
        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_engine_type'].'</b></td>
        <td class="windowbg"><select id="engine_type" name="engine_type">
        <option value="">'.$txt['smfg_select_engine_type'].'</option>
        <option value="">------</option>
        ';
        echo engine_type_select($context['user_vehicles']['engine_type']);
        echo '
        </select>
        </td>
    </tr>
    
    <tr>
        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_color'].'</b></td>
        <td class="windowbg"><input name="color" type="text" size="20" value="' . $context['user_vehicles']['color'] . '" /></td>
    </tr>
    
    <tr>
        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_mileage'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
        <td class="windowbg"><input name="mileage" type="text" size="15" value="' . $context['user_vehicles']['mileage'] . '" />&nbsp;
                             <select id="mileage_unit" name="mileage_unit">
                             <option value="">'.$txt['smfg_select_mileage_type'].'</option>
                             <option value="">------</option>
                             <option value="Miles"'.$context['miles'].'>'.$txt['smfg_miles'].'</option>
                             <option value="Kilometers"'.$context['kilometers'].'>'.$txt['smfg_kilometers'].'</option>
        </select>
        </td>
    </tr>
    
    <tr>
        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_purchased_price'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
        <td class="windowbg">
        <input name="price" type="text" size="10" value="' . $context['user_vehicles']['price'] . '" />&nbsp;'.$txt['smfg_currency'].':&nbsp;
        <select id="currency" name="currency">
        <option value="">'.$txt['smfg_select_currency'].'</option>
        <option value="">------</option>
        ';
        echo currency_select($context['user_vehicles']['currency']); 
        echo '
        </select>
        </td>
    </tr>
    
    <tr>
        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
        <td class="windowbg"><textarea name="comments" cols="60" rows="5">' . $context['user_vehicles']['comments'] . '</textarea></td>
    </tr>
    
    <tr>
        <td colspan="2" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28">
            <input type="hidden" value="' . $context['user_vehicles']['id'] . '" name="VID" />
            <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_vehicle;VID='.$_GET['VID'].'#vehicle" />
            <input type="hidden" name="sc" value="', $context['session_id'], '" />
            <input name="edit_vehicle" type="submit" value="'.$txt['smfg_update_vehicle'].'" />
        </td>
    </tr>
</table>
</form>';                
                echo '
                </td>
            </tr>    
        </table>
        <script language="JavaScript" type="text/javascript">
         var frmvalidator = new Validator("update_vehicle");
         var frm = document.forms["update_vehicle"];
         
         frmvalidator.addValidation("made_year","req","'.$txt['smfg_val_select_year'].'");
         frmvalidator.addValidation("made_year","dontselect=0","'.$txt['smfg_val_select_year'].'");
         
         frmvalidator.addValidation("make_id","req","'.$txt['smfg_val_select_make'].'");
         
         frmvalidator.addValidation("model_id","req","'.$txt['smfg_val_select_model'].'");
         
         frmvalidator.addValidation("color","regexp=^[ /A-Za-z1-9]{1,20}$","'.$txt['smfg_val_color_requirements'].'");
         
         frmvalidator.addValidation("mileage","req","'.$txt['smfg_val_enter_mileage'].'");
         frmvalidator.addValidation("mileage","numeric","'.$txt['smfg_val_mileage_numeric'].'");
         
         frmvalidator.addValidation("mileage_unit","req","'.$txt['smfg_val_select_mileage_unit'].'");
         frmvalidator.addValidation("mileage_unit","dontselect=0","'.$txt['smfg_val_select_mileage_unit'].'");
          
         frmvalidator.addValidation("price","req","'.$txt['smfg_val_enter_purchased_price'].'");
         frmvalidator.addValidation("price","regexp=^[.0-9]{1,10}$","'.$txt['smfg_val_purchased_price_numeric_vehicle'].'");

         frmvalidator.addValidation("currency","req","'.$txt['smfg_val_select_currency'].'");
         frmvalidator.addValidation("currency","dontselect=0","'.$txt['smfg_val_select_currency'].'");
          
         frmvalidator.addValidation("comments","maxlen=500","'.$txt['smfg_val_description_length'].'");
         
        </script>
        </div>';
        // Show the input for images if it is enabled
        if($smfgSettings['enable_vehicle_images']) {
            echo '
            <div class="garage_panel" id="options001" style="display: none;">
            <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_images'].'</td>
                </tr>
                <tr>
                    <td class="windowbg">
                                        
                    <form action="' . $scripturl . '?action=garage;sa=insert_vehicle_images" id="update_images" enctype="multipart/form-data" method="post" name="update_images" style="padding:0; margin:0;">         
                    <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_vehicle;VID='.$_GET['VID'].'#images" />
                    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">  
                        <tr>
                            <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_attach_image'].'.<br />'.$txt['smfg_max_filesize'].': '.$smfgSettings['max_image_kbytes'].' '.$txt['smfg_kbytes'].'<br />'.$txt['smfg_max_resolution'].': '.$smfgSettings['max_image_resolution'].'x'.$smfgSettings['max_image_resolution'].'</b></td>
                            <td class="windowbg"><input type="hidden" name="MAX_FILE_SIZE" value="'.$context['max_image_bytes'].'" /><input type="file" size="30" name="FILE_UPLOAD"/></td>
                        </tr>';
        
                        // Show the input for remote images if it is enabled
                        if($smfgSettings['enable_remote_images']) {
                        echo '    
                        <tr>
                            <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_enter_remote_url'].'</b></td>
                            <td class="windowbg"><input name="url_image" type="text" size="40" maxlength="255" value="http://" /></td>
                        </tr>';
                        }
                        
                        echo '    
                        <tr>
                            <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                            <td class="windowbg"><textarea name="attach_desc" cols="60" rows="3"></textarea></td>
                        </tr>    
                        <tr>
                            <td colspan="2" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28"><input type="hidden" value="' . $context['user_vehicles']['id'] . '" name="VID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="insert_vehicle_images" type="submit" value="'.$txt['smfg_add_new_image'].'" /></td>
                        </tr>
                    </table>
                    </form>
                    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">  
                        <tr>
                            <td class="windowbg" colspan="2">
                            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
                                <tr>
                                    <td class="windowbg" width="100%" align="center" colspan="3">'.$txt['smfg_edit_in_place_instructions'].'<div id="updateStatus"></div></td>
                                </tr>
                                <tr>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_image'].'</td>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_description'].'</td>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_manage'].'</td>
                                </tr>';
                                
                                $count = 0;                            
                                // If there is an image, show em
                                if (isset($context['user_vehicles'][$count]['image_id'])) {
                                    // and keep showing em
                                    while(isset($context['user_vehicles'][$count]['image_id'])) {
                                        echo '                            
                                        <tr class="windowbg">
                                            <td align="center" valign="middle"><a href="'.$context['user_vehicles'][$count]['attach_location'].'" rel="shadowbox" title="'.garage_title_clean($context['user_vehicles']['made_year'].' '.$context['user_vehicles']['make'].' '.$context['user_vehicles']['model'].' :: '.$context['user_vehicles'][$count]['attach_desc']).'" class="smfg_imageTitle"><img src="'.$boardurl.'/'.$smfgSettings['upload_directory'].'cache/'.$context['user_vehicles'][$count]['attach_thumb_location'].'" width="'.$context['user_vehicles'][$count]['attach_thumb_width'].'" height="'.$context['user_vehicles'][$count]['attach_thumb_height'].'" alt=""/></a></td>
                                            <td align="center" valign="middle">
                                            <div id="image'.$context['user_vehicles'][$count]['image_id'].'" class="editin">';
                                            // If there is no desc, let them add one
                                            if (!empty($context['user_vehicles'][$count]['attach_desc'])) {
                                                echo $context['user_vehicles'][$count]['attach_desc'];
                                            } 
                                                echo'</div></td>
                                            <td align="center" valign="middle">';
                                            if ($context['user_vehicles'][$count]['hilite'] != 1) {
                                                echo '
                                                <form action="'.$scripturl.'?action=garage;sa=set_hilite_image;VID='.$context['user_vehicles']['id'].';image_id='.$context['user_vehicles'][$count]['image_id'].';sesc=' . $context['session_id'] . '" method="post" name="set_vehicle_hilite_'.$context['user_vehicles'][$count]['image_id'].'" id="set_vehicle_hilite_'.$context['user_vehicles'][$count]['image_id'].'" style="display: inline;">
                                                    <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_vehicle;VID='.$_GET['VID'].'#images" />
                                                    <a href="#" onClick="document.set_vehicle_hilite_'.$context['user_vehicles'][$count]['image_id'].'.submit(); return false;">'.$txt['smfg_set_hilite_image'].'</a>
                                                </form>
                                                <br /><br />';
                                            } else {
                                                echo 
                                                $txt['smfg_hilite_image'].'<br /><br />';
                                            }                                
                                            echo '
                                            <form action="'.$scripturl.'?action=garage;sa=remove_vehicle_image;VID='.$context['user_vehicles']['id'].';image_id='.$context['user_vehicles'][$count]['image_id'].';sesc=' . $context['session_id'] . '" method="post" name="remove_vehicle_image_'.$context['user_vehicles'][$count]['image_id'].'" id="remove_vehicle_image_'.$context['user_vehicles'][$count]['image_id'].'" style="display: inline;">
                                            <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_vehicle;VID='.$_GET['VID'].'#images" />
                                            <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_image'].'\')) { document.remove_vehicle_image_'.$context['user_vehicles'][$count]['image_id'].'.submit(); } else { return false; } return false;">'.$txt['smfg_remove_image'].'</a>
                                            </form>
                                            </td>
                                        </tr>';                            
                                        $count++;                            
                                    }
                                } else {
                                    echo '
                                    <tr class="windowbg">
                                        <td colspan="3" align="center" valign="middle">'.$txt['smfg_no_images'].'</td>
                                    </tr>';                  
                                }
                                echo '
                                </table> 
                            </td>
                        </tr>
                    </table>  
                    </td>
                </tr>
            </table>
            <script language="JavaScript" type="text/javascript">
             var frmvalidator = new Validator("update_images");
              
             frmvalidator.addValidation("attach_desc","maxlen=150","'.$txt['smfg_val_image_description_length'].'");  
             
            </script>
            </div>';
        }
        
        // Show the input for videos if it is enabled
        if($smfgSettings['enable_vehicle_video']) {
            echo '
            <div class="garage_panel" id="options002" style="display: none;">
            <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_video'].'</td>
                </tr>
                <tr>
                    <td class="windowbg">
                                        
                    <form action="' . $scripturl . '?action=garage;sa=insert_vehicle_video" id="update_video" enctype="multipart/form-data" method="post" name="update_video" style="padding:0; margin:0;">         
                    <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_vehicle;VID='.$_GET['VID'].'#video" />
                    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">  
                        <tr>
                            <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_title'].'</b></td>
                            <td class="windowbg"><input type="text"  size="40" maxlength="75" value="" name="video_title"/></td>
                        </tr>
                        <tr>
                            <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_url'].'</b></td>
                            <td class="windowbg"><input type="text"  size="40" maxlength="255" value="http://" name="video_url"/>&nbsp;<span class="smalltext"><a href="'.$scripturl.'?action=garage;sa=supported_video" rel="shadowbox;width=260;height=400" title="'.$txt['smfg_video_instructions'].'">Supported Sites</a></span></td>
                        </tr>';
                        
                        echo '    
                        <tr>
                            <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                            <td class="windowbg"><textarea name="video_desc" cols="60" rows="3"></textarea></td>
                        </tr>   
                        <tr>
                            <td colspan="2" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28"><input type="hidden" value="' . $context['user_vehicles']['id'] . '" name="VID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="insert_vehicle_video" type="submit" value="'.$txt['smfg_add_new_video'].'" /></td>
                        </tr>
                    </table>
                    </form>
                    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">  
                        <tr>
                            <td class="windowbg" colspan="2">
                            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
                                <tr>
                                    <td class="windowbg" width="100%" align="center" colspan="3">'.$txt['smfg_edit_in_place_instructions'].'<div id="updateStatus2"></div></td>
                                </tr>
                                <tr>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_video'].'</td>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_title_description'].'</td>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_manage'].'</td>
                                </tr>';
                                
                                $count = 0;                            
                                // If there is an video, show em
                                if (isset($context['user_vehicles'][$count]['video_id'])) {
                                    // and keep showing em
                                    while(isset($context['user_vehicles'][$count]['video_id'])) {
                                        echo '                            
                                        <tr class="windowbg">
                                            <td align="center" valign="middle"><a href="'.$scripturl.'?action=garage;sa=video;id='.$context['user_vehicles'][$count]['video_id'].'" rel="shadowbox;width='.$context['user_vehicles'][$count]['video_width'].';height='.$context['user_vehicles'][$count]['video_height'].';" title="'.garage_title_clean('<b>'.$context['user_vehicles'][$count]['video_title'].'</b> :: '.$context['user_vehicles'][$count]['video_desc']).'" class="smfg_videoTitle"><img src="'.$context['user_vehicles'][$count]['video_thumb'].'" /></a></td>
                                            <td align="center" valign="middle">
                                            <div id="video_title'.$context['user_vehicles'][$count]['video_id'].'" class="editin" style="font-weight: bold;">';
                                            // If there is no title, let them add one
                                            if (!empty($context['user_vehicles'][$count]['video_title'])) {
                                                echo $context['user_vehicles'][$count]['video_title'];
                                            }
                                            echo '
                                            </div>
                                            <br />
                                            <div id="video'.$context['user_vehicles'][$count]['video_id'].'" class="editin">';
                                            // If there is no desc, let them add one
                                            if (!empty($context['user_vehicles'][$count]['video_desc'])) {
                                                echo $context['user_vehicles'][$count]['video_desc'];
                                            } 
                                                echo'</div></td>
                                            <td align="center" valign="middle">';                               
                                            echo '
                                            <form action="'.$scripturl.'?action=garage;sa=remove_video;VID='.$context['user_vehicles']['id'].';video_id='.$context['user_vehicles'][$count]['video_id'].';sesc=' . $context['session_id'] . '" method="post" name="remove_vehicle_video_'.$context['user_vehicles'][$count]['video_id'].'" id="remove_vehicle_video_'.$context['user_vehicles'][$count]['video_id'].'" style="display: inline;">
                                            <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_vehicle;VID='.$_GET['VID'].'#video" />
                                            <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_video'].'\')) { document.remove_vehicle_video_'.$context['user_vehicles'][$count]['video_id'].'.submit(); } else { return false; } return false;">'.$txt['smfg_remove_video'].'</a>
                                            </form>
                                            </td>
                                        </tr>';                
                                        $count++;
                                    }
                                } else {
                                    echo '
                                    <tr class="windowbg">
                                        <td colspan="3" align="center" valign="middle">'.$txt['smfg_no_videos'].'</td>
                                    </tr>';
                                }
                                echo '
                                </table> 
                            </td>
                        </tr>
                    </table>  
                    </td>
                </tr>
            </table>
            <script language="JavaScript" type="text/javascript">
             var frmvalidator = new Validator("update_video");
              
             frmvalidator.addValidation("video_desc","maxlen=150","'.$txt['smfg_val_video_description_length'].'");  
             frmvalidator.addValidation("video_title","req","'.$txt['smfg_val_enter_title'].'");
             
            </script>
            </div>';
        }
        
        echo '

<script type="text/javascript">
<!--
    var lowest_tab = \'000\';
    var active_id = \'000\';
    if (document.location.hash == "")
    {
        change_tab(lowest_tab);
    }
    else if (document.location.hash == "#vehicle")
    {
        change_tab(\'000\');
    }
    else if (document.location.hash == "#images")
    {
        change_tab(\'001\');
    }
    else if (document.location.hash == "#video")
    {
        change_tab(\'002\');
    }

//-->

</script>
    
    </td>
</tr>

<tr>
    <td class="titlebg" align="center" height="28">&nbsp;</td>
</tr>
</table>';
    
    echo smfg_footer();

}

function template_add_modification()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    // List the product options
    echo product_options("add_modification");
    
    echo '
    <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_add_modification'] . '</td>
        </tr>';
        
        // Submitted items?
        if(!$_SESSION['added_man'] && !$_SESSION['added_product'] && !$_SESSION['added_shop'] && !$_SESSION['added_garage']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_add_mod_info'].'</td>
            </tr>';
        }
        
        // Manufactuer?
        if($_SESSION['added_man']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_manufacturer_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a mod is added
            unset($_SESSION['added_man']);
        } 
        
        // Product?
        if($_SESSION['added_product']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_product_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a mod is added
            unset($_SESSION['added_product']);
        }
        
        // Shop?
        if($_SESSION['added_shop']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_shop_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a mod is added
            unset($_SESSION['added_shop']);
        }
        
        // Garage?
        if($_SESSION['added_garage']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_garage_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a mod is added
            unset($_SESSION['added_garage']);
        }
        
        echo'
        <tr>
            <td class="windowbg">
            <form action="'.$scripturl.'?action=garage;sa=insert_modification" id="add_modification" enctype="multipart/form-data" method="post" name="add_modification" style="padding:0; margin:0;">
                <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$_GET['VID'].'#modifications" />
                <table width="100%" cellpadding="3" cellspacing="1" border="0" class="bordercolor">
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_category'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg">
                        <select id="category_id" name="category_id">
                        <option value="">'.$txt['smfg_select_category'].'</option>
                        <option value="">------</option>';
                        // List Mod Category Selections
                        echo cat_select();
                        echo '
                        </select>
                        &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_manufacturer'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg">
                        <select id="manufacturer_id" name="manufacturer_id">
                        <script type="text/javascript">dol2.printOptions("manufacturer_id")</script>
                        </select>';
                        if($smfgSettings['enable_user_submit_business']) {
                            echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_business;bustype=product" rel="shadowbox;width=620;height=560" title="Garage :: Submit Business">'.$txt['smfg_here'].'</a>';
                        }
                        echo '
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_product'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg">
                        <select id="product_id" name="product_id">
                        <script type="text/javascript">dol2.printOptions("product_id")</script>
                        </select>';
                        if($smfgSettings['enable_user_submit_product']) {
                            echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_product" rel="shadowbox;width=620;height=200" title="Garage :: Submit Product">'.$txt['smfg_here'].'</a>';
                        }
                        echo '&nbsp;&nbsp;&nbsp;
                        <b>'.$txt['smfg_rating'].'</b>&nbsp;
                        <select id="product_rating" name="product_rating">
                        <option value="">'.$txt['smfg_select_rating'].'</option>
                        <option value="">------</option>
                        <option value="10" >10 '.$txt['smfg_best'].'</option>
                        <option value="9" >9</option>
                        <option value="8" >8</option>
                        <option value="7" >7</option>
                        <option value="6" >6</option>
                        <option value="5" >5</option>
                        <option value="4" >4</option>
                        <option value="3" >3</option>
                        <option value="2" >2</option>
                        <option value="1" >1 '.$txt['smfg_worst'].'</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_purchased_from'].'</b></td>
                        <td class="windowbg">
                        <select id="shop_id" name="shop_id">
                        <option value="">'.$txt['smfg_select_shop'].'</option>
                        <option value="">------</option>';
                        // List Shop Options
                        echo shop_select();
                        echo '
                        </select>';
                        if($smfgSettings['enable_user_submit_business']) {
                            echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_business;bustype=retail" rel="shadowbox;width=620;height=560" title="Garage :: Submit Retail">'.$txt['smfg_here'].'</a>';
                        }
                        echo '
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_purchased_price'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg">
                        <input name="price" type="text" size="10" value="" />&nbsp;<b>'.$txt['smfg_purchase_rating'].'</b>&nbsp;
                        <select id="purchase_rating" name="purchase_rating">
                        <option value="">'.$txt['smfg_select_rating'].'</option>
                        <option value="">------</option>
                        <option value="10" >10 '.$txt['smfg_cheapest'].'</option>
                        <option value="9" >9</option>
                        <option value="8" >8</option>
                        <option value="7" >7</option>
                        <option value="6" >6</option>
                        <option value="5" >5</option>
                        <option value="4" >4</option>
                        <option value="3" >3</option>
                        <option value="2" >2</option>
                        <option value="1" >1 '.$txt['smfg_most_expensive'].'</option>
                        </select>
                        </td>
                    </tr>    
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_installed_by'].'</b></td>
                        <td class="windowbg">
                        <select id="installer_id" name="installer_id">
                        <option value="">'.$txt['smfg_select_garage'].'</option>
                        <option value="">------</option>';
                        // List Installer/Garage Options
                        echo install_select();
                        echo '
                        </select>';
                        if($smfgSettings['enable_user_submit_business']) {
                            echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_business;bustype=garage" rel="shadowbox;width=620;height=560" title="Garage :: Submit Garage">'.$txt['smfg_here'].'</a>';
                        }
                        echo '
                    </tr>
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_installation_price'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg">
                        <input name="install_price" type="text" size="10" value="" />&nbsp;<b>'.$txt['smfg_installation_rating'].'</b>&nbsp;
                        <select id="install_rating" name="install_rating">
                        <option value="">'.$txt['smfg_select_rating'].'</option>
                        <option value="">------</option>
                        <option value="10" >10 '.$txt['smfg_cheapest'].'</option>
                        <option value="9" >9</option>
                        <option value="8" >8</option>
                        <option value="7" >7</option>
                        <option value="6" >6</option>
                        <option value="5" >5</option>
                        <option value="4" >4</option>
                        <option value="3" >3</option>
                        <option value="2" >2</option>
                        <option value="1" >1 '.$txt['smfg_most_expensive'].'</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                        <td class="windowbg"><textarea name="comments" cols="60" rows="4"></textarea></td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_install_comments'].'</b><br/>'.$txt['smfg_only_show_in'].'</td>

                        <td class="windowbg"><textarea name="install_comments" cols="60" rows="4"></textarea></td>
                    </tr>';
                    
                    // Show the input for remote images if it is enabled
                    if($smfgSettings['enable_modification_images']) {
                    echo '
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="2">'.$txt['smfg_image_attachments'].'</td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_attach_image'].'<br />'.$txt['smfg_max_filesize'].': '.$smfgSettings['max_image_kbytes'].' '.$txt['smfg_kbytes'].'<br />'.$txt['smfg_max_resolution'].': '.$smfgSettings['max_image_resolution'].'x'.$smfgSettings['max_image_resolution'].'</b></td>
                        <td class="windowbg"><input type="hidden" name="MAX_FILE_SIZE" value="'.$context['max_image_bytes'].'" /><input type="file" size="30" name="FILE_UPLOAD"/></td>
                    </tr>';
    
                    // Show the input for remote images if it is enabled
                    if($smfgSettings['enable_remote_images']) {
                    echo '    
                    <tr>
                        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_enter_remote_url'].'</b></td>
                        <td class="windowbg"><input name="url_image" type="text" size="40" maxlength="255" value="http://" /></td>
                    </tr>';
                    }
                    
                    echo '    
                    <tr>
                        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                        <td class="windowbg"><textarea name="attach_desc" cols="60" rows="3"></textarea></td>
                    </tr>';  
                    }        
                    // Show the input for videos if it is enabled
                    if($smfgSettings['enable_modification_video']) {
                    echo '
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="2">'.$txt['smfg_hosted_videos'].'</td>
                    </tr>
                    
                    <tr>
                        <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_title'].'</b></td>
                        <td class="windowbg"><input type="text"  size="40" maxlength="75" value="" name="video_title"/></td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_url'].'</b></td>
                        <td class="windowbg"><input type="text"  size="40" maxlength="255" value="http://" name="video_url"/>&nbsp;<span class="smalltext"><a href="'.$scripturl.'?action=garage;sa=supported_video" rel="shadowbox;width=260;height=400" title="'.$txt['smfg_video_instructions'].'">Supported Sites</a></span></td>
                    </tr>';
                    
                    echo '    
                    <tr>
                        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                        <td class="windowbg"><textarea name="video_desc" cols="60" rows="3"></textarea></td>
                    </tr>';
                    
                    }
                    echo '
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="2"><input type="hidden" value="'.$_GET['VID'].'" name="VID"/><input type="hidden" value="" name="MID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="modification" type="submit" value="'.$txt['smfg_add_modification'].'" /></td>
                    </tr>
                </table>
                </form>
                <script language="JavaScript" type="text/javascript">
                 var frmvalidator = new Validator("add_modification");
                 var frm = document.forms["add_modification"];
                 
                 frmvalidator.addValidation("category_id","req","'.$txt['smfg_val_select_category'].'");
                 frmvalidator.addValidation("category_id","dontselect=0","'.$txt['smfg_val_select_category'].'");
                 frmvalidator.addValidation("category_id","dontselect=1","'.$txt['smfg_val_select_category'].'");
                 
                 frmvalidator.addValidation("manufacturer_id","req","'.$txt['smfg_val_select_manufacturer'].'");
                 frmvalidator.addValidation("product_id","req","'.$txt['smfg_val_select_product'].'");                 
                 frmvalidator.addValidation("product_rating","req","'.$txt['smfg_val_select_product_rating'].'");  
                                
                 frmvalidator.addValidation("price","req","'.$txt['smfg_val_enter_purchased_price'].'");
                 frmvalidator.addValidation("price","regexp=^[.0-9]{1,8}$","'.$txt['smfg_val_purchased_price_numeric'].'");
                 
                 frmvalidator.addValidation("purchase_rating","req","'.$txt['smfg_val_select_purchase_rating'].'");
                 
                 frmvalidator.addValidation("install_price","req","'.$txt['smfg_val_enter_install_price'].'");
                 frmvalidator.addValidation("install_price","regexp=^[.0-9]{1,8}$","'.$txt['smfg_val_install_price_numeric'].'");
                 
                 frmvalidator.addValidation("install_rating","req","'.$txt['smfg_val_select_install_rating'].'");
                 
                 frmvalidator.addValidation("comments","maxlen=500","'.$txt['smfg_val_description_length'].'");
                 frmvalidator.addValidation("install_comments","maxlen=500","'.$txt['smfg_val_install_comments_length'].'");';
                 if($smfgSettings['enable_vehicle_images']) {
                     echo '
                        frmvalidator.addValidation("attach_desc","maxlen=150","'.$txt['smfg_val_image_description_length'].'");';
                 }
                 if($smfgSettings['enable_vehicle_video']) {
                     echo '
                        frmvalidator.addValidation("video_desc","maxlen=150","'.$txt['smfg_val_video_description_length'].'");';
                 }
                 echo '
                </script>
            </td>
        </tr>

        <tr>
            <td class="titlebg" align="center" height="28"></td>
        </tr>
    </table>';
    
    echo smfg_footer();

}

function template_edit_modification()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
<tr>
    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_edit_modification'] . '</td>
</tr>

<tr>
    <td class="windowbg">
    
    <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;" id="tab_table">
            <tr id="tab_row">
                <td class="mirrortab_first" id="tab_first">&nbsp;</td>

                <td class="mirrortab_active_first" id="tab_active_left">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back" id="tab000">
                    <a href="#vehicle" onclick="change_tab(\'000\');">'.$txt['smfg_modification'].'</a>
                </td>
                <td class="mirrortab_active_last" id="tab_active_right">&nbsp;</td>';                
                // Show the input for remote images if it is enabled
                if($smfgSettings['enable_modification_images']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab001">
                    <a href="#images" onclick="change_tab(\'001\');">'.$txt['smfg_images'].'</a>
                </td>';
                }
                // Show the input for videos if it is enabled
                if($smfgSettings['enable_vehicle_video']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab002">
                    <a href="#video" onclick="change_tab(\'002\');">'.$txt['smfg_video'].'</a>
                </td>';
                }
                echo '
                <td class="mirrortab_last">&nbsp;</td>

            </tr>
    </table>
    ';
        
        // Begin dynamic js divs
        // List Prod Options
        echo product_options("edit_modification");
        echo '
        <script language="JavaScript" type="text/javascript">dol2.forField("manufacturer_id").setValues("'.$context['mods']['manufacturer_id'].'");</script>';
        echo '
        <script language="JavaScript" type="text/javascript">dol2.forField("product_id").setValues("'.$context['mods']['product_id'].'");</script>';
        echo '                
        <div class="garage_panel" id="options000" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_modification'].'</td>
            </tr>';
            
        // Submitted items?
        if(!$_SESSION['added_man'] && !$_SESSION['added_product'] && !$_SESSION['added_shop'] && !$_SESSION['added_garage']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_add_mod_info'].'</td>
            </tr>';
        }
        
        // Manufactuer?
        if($_SESSION['added_man']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_manufacturer_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a mod is added
            unset($_SESSION['added_man']);
        } 
        
        // Product?
        if($_SESSION['added_product']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_product_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a mod is added
            unset($_SESSION['added_product']);
        }
        
        // Shop?
        if($_SESSION['added_shop']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_shop_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a mod is added
            unset($_SESSION['added_shop']);
        }
        
        // Garage?
        if($_SESSION['added_garage']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_garage_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a mod is added
            unset($_SESSION['added_garage']);
        }  
        
        echo '
            <tr>
                <td class="windowbg">
                <form action="'.$scripturl.'?action=garage;sa=update_modification;VID='.$_GET['VID'].';MID='.$_GET['MID'].'" id="edit_modification" enctype="multipart/form-data" method="post" name="edit_modification" style="padding:0; margin:0;">
                <input type="hidden" name="redirecturl" value="' . $scripturl . '?action=garage;sa=view_vehicle;VID='.$_GET['VID'].';#modifications" />
                <table width="100%" cellpadding="3" cellspacing="1" border="0" class="bordercolor">
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_category'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg" colspan="2">
                        <select id="category_id" name="category_id">
                        <option value="">'.$txt['smfg_select_category'].'</option>
                        <option value="">------</option>';
                        // List Mod Category Selections
                        echo cat_select($context['mods']['category_id']);
                        echo '
                        </select>
                        &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_manufacturer'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg" colspan="2">
                        <select id="manufacturer_id" name="manufacturer_id">
                        </select>';
                        if($smfgSettings['enable_user_submit_business']) {
                            echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_business;bustype=product" rel="shadowbox;width=620;height=560" title="Garage :: Submit Product">'.$txt['smfg_here'].'</a>';
                        }
                        echo '
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_product'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg" colspan="2">
                        <select id="product_id" name="product_id">
                        </select>
                        ';
                        if($smfgSettings['enable_user_submit_product']) {
                            echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_product" rel="shadowbox;width=620;height=200" title="Garage :: Submit Product">'.$txt['smfg_here'].'</a>';
                        }
                        echo '&nbsp;&nbsp;&nbsp;
                        <b>'.$txt['smfg_rating'].'</b>&nbsp;';
                        echo '
                        <select id="product_rating" name="product_rating">
                        <option value="">'.$txt['smfg_select_rating'].'</option>
                        <option value="">------</option>
                        <option value="10" '.$context['prod_rat_10'].'>10 '.$txt['smfg_best'].'</option>
                        <option value="9" '.$context['prod_rat_9'].'>9</option>
                        <option value="8" '.$context['prod_rat_8'].'>8</option>
                        <option value="7" '.$context['prod_rat_7'].'>7</option>
                        <option value="6" '.$context['prod_rat_6'].'>6</option>
                        <option value="5" '.$context['prod_rat_5'].'>5</option>
                        <option value="4" '.$context['prod_rat_4'].'>4</option>
                        <option value="3" '.$context['prod_rat_3'].'>3</option>
                        <option value="2" '.$context['prod_rat_2'].'>2</option>
                        <option value="1" '.$context['prod_rat_1'].'>1 '.$txt['smfg_worst'].'</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_purchased_from'].'</b></td>
                        <td class="windowbg" colspan="2">
                        <select id="shop_id" name="shop_id">
                        <option value="">'.$txt['smfg_select_shop'].'</option>
                        <option value="">------</option>';
                        // List Shop Options
                        echo shop_select($context['mods']['shop_id']);
                        echo '
                        </select>';
                        if($smfgSettings['enable_user_submit_business']) {
                            echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_business;bustype=retail" rel="shadowbox;width=620;height=560" title="Garage :: Submit Retail">'.$txt['smfg_here'].'</a>';
                        }
                        echo '
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_purchased_price'].'</b></td>
                        <td class="windowbg" colspan="2"><input name="price" type="text" size="10" value="'.$context['mods']['price'].'" />&nbsp;
                        <b>'.$txt['smfg_purchase_rating'].'</b>&nbsp;';
                        echo '
                        <select id="purchase_rating" name="purchase_rating">
                        <option value="">'.$txt['smfg_select_rating'].'</option>
                        <option value="">------</option>
                        <option value="10" '.$context['purch_rat_10'].'>10 '.$txt['smfg_cheapest'].'</option>
                        <option value="9" '.$context['purch_rat_9'].'>9</option>
                        <option value="8" '.$context['purch_rat_8'].'>8</option>
                        <option value="7" '.$context['purch_rat_7'].'>7</option>
                        <option value="6" '.$context['purch_rat_6'].'>6</option>
                        <option value="5" '.$context['purch_rat_5'].'>5</option>
                        <option value="4" '.$context['purch_rat_4'].'>4</option>
                        <option value="3" '.$context['purch_rat_3'].'>3</option>
                        <option value="2" '.$context['purch_rat_2'].'>2</option>
                        <option value="1" '.$context['purch_rat_1'].'>1 '.$txt['smfg_most_expensive'].'</option>
                        </select></td>
                    </tr>    
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_installed_by'].'</b></td>
                        <td class="windowbg" colspan="2">
                        <select id="installer_id" name="installer_id">
                        <option value="">'.$txt['smfg_select_garage'].'</option>
                        <option value="">------</option>';
                        // List Installer/Garage Options
                        echo install_select($context['mods']['installer_id']);
                        echo '
                        </select>';
                        if($smfgSettings['enable_user_submit_business']) {
                            echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_business;bustype=garage" rel="shadowbox;width=620;height=560" title="Garage :: Submit Garage">'.$txt['smfg_here'].'</a>';
                        }
                        echo '</td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_installation_price'].'</b></td>
                        <td class="windowbg" colspan="2"><input name="install_price" type="text" size="10" value="'.$context['mods']['install_price'].'" />&nbsp;
                        <b>'.$txt['smfg_installation_rating'].'</b>&nbsp;';
                        echo '
                        <select id="install_rating" name="install_rating">
                        <option value="">'.$txt['smfg_select_rating'].'</option>
                        <option value="">------</option>
                        <option value="10" '.$context['ins_rat_10'].'>10 '.$txt['smfg_cheapest'].'</option>
                        <option value="9" '.$context['ins_rat_9'].'>9</option>
                        <option value="8" '.$context['ins_rat_8'].'>8</option>
                        <option value="7" '.$context['ins_rat_7'].'>7</option>
                        <option value="6" '.$context['ins_rat_6'].'>6</option>
                        <option value="5" '.$context['ins_rat_5'].'>5</option>
                        <option value="4" '.$context['ins_rat_4'].'>4</option>
                        <option value="3" '.$context['ins_rat_3'].'>3</option>
                        <option value="2" '.$context['ins_rat_2'].'>2</option>
                        <option value="1" '.$context['ins_rat_1'].'>1 '.$txt['smfg_most_expensive'].'</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                        <td class="windowbg" colspan="2"><textarea name="comments" cols="60" rows="4">'.$context['mods']['comments'].'</textarea></td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_install_comments'].'</b><br/>'.$txt['smfg_only_show_in'].'</td>

                        <td class="windowbg" colspan="2"><textarea name="install_comments" cols="60" rows="4">'.$context['mods']['install_comments'].'</textarea></td>
                    </tr>
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="3"><input type="hidden" value="'.$_GET['VID'].'" name="VID"/><input type="hidden" value="'.$_GET['MID'].'" name="MID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input type="hidden" name="redirecturl" value="' . $_SESSION['old_url'] . '" /><input name="modification" type="submit" value="'.$txt['smfg_update_modification'].'" /></td>
                    </tr>
                </table>
                </form>
                <script language="JavaScript" type="text/javascript">
                var frmvalidator = new Validator("edit_modification");
                var frm = document.forms["edit_modification"];
                
                frmvalidator.addValidation("category_id","req","'.$txt['smfg_val_select_category'].'");
                frmvalidator.addValidation("category_id","dontselect=0","'.$txt['smfg_val_select_category'].'");
                frmvalidator.addValidation("category_id","dontselect=1","'.$txt['smfg_val_select_category'].'");
                         
                frmvalidator.addValidation("manufacturer_id","req","'.$txt['smfg_val_select_manufacturer'].'");
                frmvalidator.addValidation("product_id","req","'.$txt['smfg_val_select_product'].'");                 
                frmvalidator.addValidation("product_rating","req","'.$txt['smfg_val_select_product_rating'].'");  
                                        
                frmvalidator.addValidation("price","req","'.$txt['smfg_val_enter_purchased_price'].'");
                frmvalidator.addValidation("price","regexp=^[.0-9]{1,8}$","'.$txt['smfg_val_purchased_price_numeric'].'");
                         
                frmvalidator.addValidation("purchase_rating","req","'.$txt['smfg_val_select_purchase_rating'].'");
                         
                frmvalidator.addValidation("install_price","req","'.$txt['smfg_val_enter_install_price'].'");
                frmvalidator.addValidation("install_price","regexp=^[.0-9]{1,8}$","'.$txt['smfg_val_install_price_numeric'].'");
                         
                frmvalidator.addValidation("install_rating","req","'.$txt['smfg_val_select_install_rating'].'");
                         
                frmvalidator.addValidation("comments","maxlen=500","'.$txt['smfg_val_description_length'].'");
                frmvalidator.addValidation("install_comments","maxlen=500","'.$txt['smfg_val_install_comments_length'].'");
                </script>';                
                echo '
                </td>
            </tr>    
        </table>
        </div>';
        
        // Show the input for remote images if it is enabled
        if($smfgSettings['enable_modification_images']) {
            echo '
            <div class="garage_panel" id="options001" style="display: none;">
            <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_images'].'</td>
                </tr>
                <tr>
                    <td class="windowbg">
                    
                    <form action="' . $scripturl . '?action=garage;sa=insert_modification_images" id="update_images" enctype="multipart/form-data" method="post" name="update_images" style="padding:0; margin:0;">
                    <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_modification;VID='.$_GET['VID'].';MID='.$_GET['MID'].'#images" />
                    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">           
                        <tr>
                            <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_attach_image'].'.<br />'.$txt['smfg_max_filesize'].': '.$smfgSettings['max_image_kbytes'].' '.$txt['smfg_kbytes'].'<br />'.$txt['smfg_max_resolution'].': '.$smfgSettings['max_image_resolution'].'x'.$smfgSettings['max_image_resolution'].'</b></td>
                            <td class="windowbg"><input type="hidden" name="MAX_FILE_SIZE" value="'.$context['max_image_bytes'].'" /><input type="file" size="30" name="FILE_UPLOAD"/></td>
                        </tr>';
        
                        // Show the input for remote images if it is enabled
                        if($smfgSettings['enable_remote_images']) {
                            echo '    
                            <tr>
                                <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_enter_remote_url'].'</b></td>
                                <td class="windowbg"><input name="url_image" type="text" size="40" maxlength="255" value="http://" /></td>
                            </tr>';
                        }
                        
                        echo '    
                        <tr>
                            <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                            <td class="windowbg"><textarea name="attach_desc" cols="60" rows="3"></textarea></td>
                        </tr>    
                        <tr>
                            <td colspan="2" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28"><input type="hidden" value="' . $_GET['VID'] . '" name="VID" /><input type="hidden" value="' . $_GET['MID'] . '" name="MID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="insert_modification_images" type="submit" value="'.$txt['smfg_add_new_image'].'" /></td>
                        </tr>
                    </table>
                    </form>
                    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
                        <tr>
                            <td class="windowbg" colspan="2">
                            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
                                <tr>
                                    <td class="windowbg" width="100%" align="center" colspan="3">'.$txt['smfg_edit_in_place_instructions'].'<div id="updateStatus"></div></td>
                                </tr>
                                <tr>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_image'].'</td>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_description'].'</td>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_manage'].'</td>
                                </tr>';
                                $count = 0;                            
                                // If there is an image, show em
                                if(isset($context['mods'][$count]['image_id'])) {
                                    // and keep showing em
                                    while(isset($context['mods'][$count]['image_id'])) {
                                        echo '                            
                                        <tr class="windowbg">
                                            <td align="center" valign="middle">'.$context['mods'][$count]['image'].'</td>
                                            <td align="center" valign="middle">
                                            <div id="image'.$context['mods'][$count]['image_id'].'" class="editin">';
                                            // If there is no desc, let them add one
                                            if (!empty($context['mods'][$count]['attach_desc'])) {
                                                echo $context['mods'][$count]['attach_desc'];
                                            } 
                                                echo'</div></td>
                                            <td align="center" valign="middle">';
                                            if($context['mods'][$count]['hilite'] != 1) {
                                                echo '
                                                <form action="'.$scripturl.'?action=garage;sa=set_hilite_image_mod;VID='.$_GET['VID'].';MID='.$_GET['MID'].';image_id='.$context['mods'][$count]['image_id'].';sesc=' . $context['session_id'] . '" method="post" name="set_mod_hilite_'.$context['mods'][$count]['image_id'].'" id="set_mod_hilite_'.$context['mods'][$count]['image_id'].'" style="display: inline;">
                                                    <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_modification;VID='.$_GET['VID'].';MID='.$_GET['MID'].'#images" />
                                                    <a href="#" onClick="document.set_mod_hilite_'.$context['mods'][$count]['image_id'].'.submit(); return false;">'.$txt['smfg_set_hilite_image'].'</a>
                                                </form>
                                                <br /><br />';
                                            } else {
                                                echo 
                                                $txt['smfg_hilite_image'].'<br /><br />';
                                            }                                
                                            echo '
                                            <form action="'.$scripturl.'?action=garage;sa=remove_modification_image;VID='.$_GET['VID'].';MID='.$_GET['MID'].';image_id='.$context['mods'][$count]['image_id'].';sesc=' . $context['session_id'] . '" method="post" name="remove_modification_image_'.$context['mods'][$count]['image_id'].'" id="remove_modification_image_'.$context['mods'][$count]['image_id'].'" style="display: inline;">
                                                <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_modification;VID='.$_GET['VID'].';MID='.$_GET['MID'].'#images" />
                                                <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_image'].'\')) { document.remove_modification_image_'.$context['mods'][$count]['image_id'].'.submit(); } else { return false; } return false;">'.$txt['smfg_remove_image'].'</a>
                                            </form>
                                            </td>
                                        </tr>';                            
                                        $count++;                            
                                    }
                                } else {
                                    echo '
                                    <tr class="windowbg">
                                        <td colspan="3" align="center" valign="middle">'.$txt['smfg_no_modification_images'].'</td>
                                    </tr>';                  
                                }
                                echo '
                                </table> 
                            </td>
                        </tr>
                    </table>          
                    </td>
                </tr>
            </table>
            <script language="JavaScript" type="text/javascript">
             var frmvalidator = new Validator("update_images");
            
             frmvalidator.addValidation("attach_desc","maxlen=150","'.$txt['smfg_val_image_description_length'].'");         
            </script>
            </div>';
        }
        
        // Show the input for videos if it is enabled
        if($smfgSettings['enable_modification_video']) {
            echo '
            <div class="garage_panel" id="options002" style="display: none;">
            <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_video'].'</td>
                </tr>
                <tr>
                    <td class="windowbg">
                                        
                    <form action="' . $scripturl . '?action=garage;sa=insert_modification_video" id="update_video" enctype="multipart/form-data" method="post" name="update_video" style="padding:0; margin:0;">         
                    <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_modification;VID='.$_GET['VID'].';MID='.$_GET['MID'].'#video" />
                    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">  
                        <tr>
                            <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_title'].'</b></td>
                            <td class="windowbg"><input type="text"  size="40" maxlength="75" value="" name="video_title"/></td>
                        </tr>
                        <tr>
                            <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_url'].'</b></td>
                            <td class="windowbg"><input type="text"  size="40" maxlength="255" value="http://" name="video_url"/>&nbsp;<span class="smalltext"><a href="'.$scripturl.'?action=garage;sa=supported_video" rel="shadowbox;width=260;height=400" title="'.$txt['smfg_video_instructions'].'">Supported Sites</a></span></td>
                        </tr>';
                        
                        echo '    
                        <tr>
                            <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                            <td class="windowbg"><textarea name="video_desc" cols="60" rows="3"></textarea></td>
                        </tr>   
                        <tr>
                            <td colspan="2" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28"><input type="hidden" value="' . $_GET['VID'] . '" name="VID" /><input type="hidden" value="' . $_GET['MID'] . '" name="MID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="insert_modification_video" type="submit" value="'.$txt['smfg_add_new_video'].'" /></td>
                        </tr>
                    </table>
                    </form>
                    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">  
                        <tr>
                            <td class="windowbg" colspan="2">
                            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
                                <tr>
                                    <td class="windowbg" width="100%" align="center" colspan="3">'.$txt['smfg_edit_in_place_instructions'].'<div id="updateStatus2"></div></td>
                                </tr>
                                <tr>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_video'].'</td>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_title_description'].'</td>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_manage'].'</td>
                                </tr>';
                                
                                $count = 0;                            
                                // If there is an video, show em
                                if (isset($context['mods'][$count]['video_id'])) {
                                    // and keep showing em
                                    while(isset($context['mods'][$count]['video_id'])) {
                                        echo '                            
                                        <tr class="windowbg">
                                            <td align="center" valign="middle"><a href="'.$scripturl.'?action=garage;sa=video;id='.$context['mods'][$count]['video_id'].'" rel="shadowbox;width='.$context['mods'][$count]['video_width'].';height='.$context['mods'][$count]['video_height'].'" title="'.garage_title_clean('<b>'.$context['mods'][$count]['video_title'].'</b> :: '.$context['mods'][$count]['video_desc']).'" class="smfg_videoTitle"><img src="'.$context['mods'][$count]['video_thumb'].'" /></a></td>
                                            <td align="center" valign="middle">
                                            <div id="video_title'.$context['mods'][$count]['video_id'].'" class="editin" style="font-weight: bold;">';
                                            // If there is no title, let them add one
                                            if (!empty($context['mods'][$count]['video_title'])) {
                                                echo $context['mods'][$count]['video_title'];
                                            }
                                            echo '
                                            </div>
                                            <br />
                                            <div id="video'.$context['mods'][$count]['video_id'].'" class="editin">';
                                            // If there is no desc, let them add one
                                            if (!empty($context['mods'][$count]['video_desc'])) {
                                                echo $context['mods'][$count]['video_desc'];
                                            } 
                                                echo'</div></td>
                                            <td align="center" valign="middle">';                               
                                            echo '
                                            <form action="'.$scripturl.'?action=garage;sa=remove_video;VID='.$_GET['VID'].';video_id='.$context['mods'][$count]['video_id'].';sesc=' . $context['session_id'] . '" method="post" name="remove_modification_video_'.$context['mods'][$count]['video_id'].'" id="remove_modification_video_'.$context['mods'][$count]['video_id'].'" style="display: inline;">
                                            <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_modification;VID='.$_GET['VID'].';MID='.$_GET['MID'].'#video" />
                                            <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_video'].'\')) { document.remove_modification_video_'.$context['mods'][$count]['video_id'].'.submit(); } else { return false; } return false;">'.$txt['smfg_remove_video'].'</a>
                                            </form>
                                            </td>
                                        </tr>';                
                                        $count++;
                                    }
                                } else {
                                    echo '
                                    <tr class="windowbg">
                                        <td colspan="3" align="center" valign="middle">'.$txt['smfg_no_mod_videos'].'</td>
                                    </tr>';
                                }
                                echo '
                                </table> 
                            </td>
                        </tr>
                    </table>  
                    </td>
                </tr>
            </table>
            <script language="JavaScript" type="text/javascript">
             var frmvalidator = new Validator("update_video");
              
             frmvalidator.addValidation("video_desc","maxlen=150","'.$txt['smfg_val_video_description_length'].'");
             frmvalidator.addValidation("video_title","req","'.$txt['smfg_val_enter_title'].'");
             
            </script>
            </div>';
        }
        
        echo '

<script type="text/javascript">
<!--
    var lowest_tab = \'000\';
    var active_id = \'000\';
    if (document.location.hash == "")
    {
        change_tab(lowest_tab);
    }
    else if (document.location.hash == "#vehicle")
    {
        change_tab(\'000\');
    }
    else if (document.location.hash == "#images")
    {
        change_tab(\'001\');
    }
    else if (document.location.hash == "#video")
    {
        change_tab(\'002\');
    }

//-->

</script>
    
    </td>
</tr>

<tr>
    <td class="titlebg" align="center" height="28">&nbsp;</td>
</tr>
</table>';
    
    echo smfg_footer();

}

function template_view_modification()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings, $boardurl;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
    <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$context['mods']['product'].'</td>
        </tr>

        <tr>
<td class="windowbg">
    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">

    <tr>
        <td class="windowbg" align="center" valign="top">';       
            
            // Pending?
            if($context['mods']['pending'] == '1') {
                echo '
            <table class="tborder" width="90%">
                <tr class="windowbg">
                    <td>
                    <table border="0">
                        <tr>
                            <td align="center" valign="middle" width="40"><img src="'. $settings['default_images_url'] . '/garage_delete.gif" alt="" title="" /></td>
                            <td align="center" valign="middle">'.$txt['smfg_pending_item'].'</td>
                        </tr>
                    </table>
                    </td>
                </tr>
            </table><br />';
            }
            
            echo '
            <table border="0" width="70%">
                <tr>
                    <td align="left"><b>'.$txt['smfg_owner'].'</b></td>
                </tr>
                <tr>
                    <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['user_vehicles']['user_id'].'"><b>'.$context['mods']['owner'].'</b></a></td>
                </tr>
                <tr>
                    <td align="left"><b>'.$txt['smfg_hilite_image'].'</b></td>
                </tr>
                <tr>
                    <td align="center">', (!empty($context['hilite_image_location'])) ? '<a href="'.$context['hilite_image_location'].'" rel="shadowbox" title="'.$context['mods']['product'].' :: '.garage_title_clean($context['hilite_desc']).'" class="smfg_imageTitle"><img src="'.$context['hilite_thumb_location'].'" width="'.$context['hilite_thumb_width'].'" height="'.$context['hilite_thumb_height'].'" /></a>' : '' ,'</td>
                </tr>
                <tr>
                    <td align="left"><b>'.$txt['smfg_comments'].'</b></td>
                </tr>
                <tr>
                    <td align="center">'.$context['mods']['comments'].'</td>
                </tr>
            </table>
        </td>
        <td width="30%" class="windowbg" valign="middle" align="center">
            <table border="0" cellspacing="1" cellpadding="3">
            <tr>
                <td align="left"><b>'.$txt['smfg_manufacturer'].'</b></td>
                <td align="left"><a href="'.$scripturl.'?action=garage;sa=mfg_review;BID='.$context['mods']['manufacturer_id'].'">'.garage_title_clean($context['mods']['manufacturer']).'</a><td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_modification'].'</b></td>
                <td align="left">'.$context['mods']['product'].'<td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_category'].'</b></td>
                <td align="left">'.$context['mods']['category'].'<td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_vehicle'].'</b></td>
                <td align="left"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$_GET['VID'].'">'.garage_title_clean($context['user_vehicles']['title']).'</a><td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_updated'].'</b></td>
                <td align="left">'.date($context['date_format'],$context['mods']['date_updated']).'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_purchased_from'].'</b></td>
                <td align="left">', (!empty($context['mods']['shop'])) ? '<a href="'.$scripturl.'?action=garage;sa=shop_review;BID='.$context['mods']['shop_id'].'">'.garage_title_clean($context['mods']['shop']).'</a>' : '' ,'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_purchased_price'].'</b></td>
                <td align="left">'.$context['mods']['price'].' '.$context['user_vehicles']['currency'].'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_product_rating'].'</b></td>
                <td align="left">'.$context['mods']['product_rating'].'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_installed_by'].'</b></td>
                <td align="left">', (!empty($context['mods']['installer'])) ? '<a href="'.$scripturl.'?action=garage;sa=garage_review;BID='.$context['mods']['installer_id'].'">'.garage_title_clean($context['mods']['installer']).'</a>' : '' ,'<td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_installation_price'].'</b></td>
                <td align="left">'.$context['mods']['install_price'].' '.$context['user_vehicles']['currency'].'<td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_installation_rating'].'</b></td>
                <td align="left">'.$context['mods']['install_rating'].'<td>
            </tr>
            </table>
        </td>
    </tr>
    </table>';
    
    if($smfgSettings['enable_modification_images'] || $smfgSettings['enable_modification_video']) {
    
    echo '
    <br />
    <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;" id="tab_table">
            <tr id="tab_row">
                <td class="mirrortab_first" id="tab_first">&nbsp;</td>

                <td class="mirrortab_active_first" id="tab_active_left">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back" id="tab000">
                    <a href="#images" onclick="change_tab(\'000\');">'.$txt['smfg_images'].'</a>
                </td>
                <td class="mirrortab_active_last" id="tab_active_right">&nbsp;</td>';
                $count = 0;
                if(isset($context['mods'][$count]['video_id']) && $smfgSettings['enable_modification_video']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab001">
                    <a href="#videos" onclick="change_tab(\'001\');">'.$txt['smfg_videos'].'</a>
                </td>';
                }
                echo '
                <td class="mirrortab_last">&nbsp;</td>

            </tr>
    </table>';
        
        // Begin dynamic js divs
        echo '        
        <div class="garage_panel" id="options000" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_images'].'</td>
            </tr>';
            $count = 0;
            if(isset($context['mods'][$count]['image_id'])) {
            echo '
            <tr>
                <td class="windowbg" valign="middle">';
                while(isset($context['mods'][$count]['image_id'])) {
                    echo '
                <a href="'.$context['mods'][$count]['attach_location'].'" rel="shadowbox[mods]" title="'.garage_title_clean($context['mods']['product'].' :: '.$context['mods'][$count]['attach_desc']).'" class="smfg_imageTitle"><img src="'.$context['mods'][$count]['attach_thumb_location'].'" width="'.$context['mods'][$count]['attach_thumb_width'].'" height="'.$context['mods'][$count]['attach_thumb_height'].'" /></a>';
                $count++;
                }
                echo '
                </td>
            </tr>';
            }  else {
            echo '
            <tr>
                <td class="windowbg" align="center">'.$txt['smfg_no_modification_images'].'</td>
            </tr>';
            }
        echo '
        </table>     
        </div>
        <div class="garage_panel" id="options001" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_videos'].'</td>
            </tr>';
            $count = 0;
            if(isset($context['mods'][$count]['video_id'])) {
            echo '
            <tr>
                <td class="windowbg" valign="middle">';
                while(isset($context['mods'][$count]['video_id'])) {
                    echo '
                <a href="'.$scripturl.'?action=garage;sa=video;id='.$context['mods'][$count]['video_id'].'" rel="shadowbox[video];width='.$context['mods'][$count]['video_width'].';height='.$context['mods'][$count]['video_height'].';" title="'.garage_title_clean('<b>'.$context['mods'][$count]['video_title'].'</b> :: '.$context['mods'][$count]['video_desc']).'" class="smfg_videoTitle"><img src="'.$context['mods'][$count]['video_thumb'].'" /></a>';
                $count++;
                }
                echo '
                </td>
            </tr>';
            }  else {
            echo '
            <tr>
                <td class="windowbg" align="center">'.$txt['smfg_no_videos'].'</td>
            </tr>';
            }
        echo '  
        </table>     
        </div>

        <script type="text/javascript">
        <!--
            var lowest_tab = \'000\';
            var active_id = \'000\';
            if (document.location.hash == "")
            {
                change_tab(lowest_tab);
            }
            else if (document.location.hash == "#images")
            {
                change_tab(\'000\');
            }
            else if (document.location.hash == "#videos")
            {
                change_tab(\'001\');
            }

        //-->

        </script>
        </td>
        </tr>

        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28"></td>
        </tr>
        </table>';

    }
    
    echo smfg_footer();

}

function template_add_insurance()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
    <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_add_insurance'] . '</td>
        </tr>';
        
        // Submitted insurance agency?
        if($_SESSION['added_insurance']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_insurance_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a dyno is added
            unset($_SESSION['added_insurance']);
        }  
        
        echo '
        <tr>
            <td class="windowbg">
            <form action="'.$scripturl.'?action=garage;sa=insert_insurance" enctype="multipart/form-data" method="post" id="add_insurance" name="add_insurance" style="padding:0; margin:0;">
            <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$_GET['VID'].'#premiums" />
            <table width="100%" cellpadding="3" cellspacing="1" border="0" class="bordercolor">
                <tr>
                    <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_insurer'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                    <td class="windowbg">
                    <select id="business_id" name="business_id">
                    <option value="">'.$txt['smfg_select_insurer'].'</option>
                    <option value="">------</option>
                    ';
                    echo insurer_select();
                    echo '
                    </select>';
                        if($smfgSettings['enable_user_submit_business']) {
                            echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_business;bustype=insurance" rel="shadowbox;width=620;height=560" title="Garage :: Submit Insurance">'.$txt['smfg_here'].'</a>';
                        }
                        echo '
                    </td>
                </tr>
                <tr>
                    <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_cost_of_premium'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                    <td class="windowbg"><input name="premium" type="text" size="15" value="" /></td>
                </tr>
                <tr>
                    <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_cover_type'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                    <td class="windowbg">
                    <select id="cover_type" name="cover_type">
                    <option value="">'.$txt['smfg_select_cover_type'].'</option>
                    <option value="">------</option>';
                    echo premium_type_select();
                    echo '
                    </select>
                    </td>
                </tr>
                <tr>
                    <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_comments'].'</b></td>
                    <td class="windowbg"><textarea name="comments" cols="60" rows="5"></textarea></td>
                </tr>
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="2"><input type="hidden" value="'.$_GET['VID'].'" name="VID" /><input type="hidden" value="" name="INS_ID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="submit" type="submit" value="'.$txt['smfg_add_insurance'].'" /></td>
                </tr>      
            </table>
            </form>
            <script language="JavaScript" type="text/javascript">
            var frmvalidator = new Validator("add_insurance");
            
            frmvalidator.addValidation("business_id","req","'.$txt['smfg_val_select_insurance_company'].'");
            frmvalidator.addValidation("business_id","dontselect=0","'.$txt['smfg_val_select_insurance_company'].'");
            frmvalidator.addValidation("business_id","dontselect=1","'.$txt['smfg_val_select_insurance_company'].'");
            
            frmvalidator.addValidation("premium","req","'.$txt['smfg_val_enter_premium'].'");
            frmvalidator.addValidation("premium","regexp=^[0-9]{1,10}$","'.$txt['smfg_val_premium_numeric'].'");
            
            frmvalidator.addValidation("cover_type","req","'.$txt['smfg_val_select_coverage'].'");
            frmvalidator.addValidation("cover_type","dontselect=0","'.$txt['smfg_val_select_coverage'].'");
            frmvalidator.addValidation("cover_type","dontselect=1","'.$txt['smfg_val_select_coverage'].'");
            frmvalidator.addValidation("comments","maxlen=500","'.$txt['smfg_val_comment_length'].'");
            </script>
            </td>
        </tr>

        <tr>
            <td class="titlebg" align="center" height="28"></td>
        </tr>
    </table>';
    
    echo smfg_footer();

}

function template_edit_insurance()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
    <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_edit_insurance'] . '</td>
        </tr>';
        
        // Submitted insurance agency?
        if($_SESSION['added_insurance']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_insurance_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a dyno is added
            unset($_SESSION['added_insurance']);
        }  
            
        echo '
        <tr>
            <td class="windowbg">
            <form action="'.$scripturl.'?action=garage;sa=update_insurance" enctype="multipart/form-data" method="post" name="edit_insurance" style="padding:0; margin:0;">
            <input type="hidden" name="redirecturl" value="' . $scripturl . '?action=garage;sa=view_vehicle;VID='.$_GET['VID'].';#premiums" />
            <table width="100%" cellpadding="3" cellspacing="1" border="0" class="bordercolor">
                <tr>
                    <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_insurer'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                    <td class="windowbg">
                    <select id="business_id" name="business_id">
                    <option value="">'.$txt['smfg_select_insurer'].'</option>
                    <option value="">------</option>
                    ';
                    echo insurer_select($context['premiums']['business_id']);
                    echo '
                    </select>';
                        if($smfgSettings['enable_user_submit_business']) {
                            echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_business;bustype=insurance" rel="shadowbox;width=620;height=560" title="Garage :: Submit Insurance">'.$txt['smfg_here'].'</a>';
                        }
                        echo '
                    </td>
                </tr>
                <tr>
                    <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_cost_of_premium'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                    <td class="windowbg"><input name="premium" type="text" size="15" value="'.$context['premiums']['premium'].'" /></td>
                </tr>
                <tr>
                    <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_cover_type'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                    <td class="windowbg">
                    <select id="cover_type" name="cover_type">
                    <option value="">'.$txt['smfg_select_cover_type'].'</option>
                    <option value="">------</option>
                    ';
                    echo premium_type_select($context['premiums']['cover_type_id']);
                    echo '
                    </select>
                    </td>
                </tr>
                <tr>
                    <td class="windowbg2" width="30%" align="right"><b>'.$txt['smfg_comments'].'</b></td>
                    <td class="windowbg"><textarea name="comments" cols="60" rows="5">'.$context['premiums']['comments'].'</textarea></td>
                </tr>
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="2"><input type="hidden" value="'.$_GET['VID'].'" name="VID" /><input type="hidden" value="'.$_GET['INS_ID'].'" name="INS_ID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input type="hidden" name="redirecturl" value="' . $_SESSION['old_url'] . '" /><input name="submit" type="submit" value="'.$txt['smfg_update_insurance'].'" /></td>
                </tr>      
            </table>
            </form>
            <script language="JavaScript" type="text/javascript">
            var frmvalidator = new Validator("edit_insurance");
            
            frmvalidator.addValidation("business_id","req","'.$txt['smfg_val_select_insurance_company'].'");
            frmvalidator.addValidation("business_id","dontselect=0","'.$txt['smfg_val_select_insurance_company'].'");
            frmvalidator.addValidation("business_id","dontselect=1","'.$txt['smfg_val_select_insurance_company'].'");
            
            frmvalidator.addValidation("premium","req","'.$txt['smfg_val_enter_premium'].'");
            frmvalidator.addValidation("premium","regexp=^[0-9]{1,10}$","'.$txt['smfg_val_premium_numeric'].'");
            
            frmvalidator.addValidation("cover_type","req","'.$txt['smfg_val_select_coverage'].'");
            frmvalidator.addValidation("cover_type","dontselect=0","'.$txt['smfg_val_select_coverage'].'");
            frmvalidator.addValidation("cover_type","dontselect=1","'.$txt['smfg_val_select_coverage'].'");
            frmvalidator.addValidation("comments","maxlen=500","'.$txt['smfg_val_comment_length'].'");
            </script>
            </td>
        </tr>

        <tr>
            <td class="titlebg" align="center" height="28"></td>
        </tr>
    </table>';
    
    echo smfg_footer();

}

function template_add_quartermile()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
    <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_add_quartermile'] . '</td>
        </tr>

        <tr>
            <td class="windowbg">
            <form action="'.$scripturl.'?action=garage;sa=insert_quartermile" enctype="multipart/form-data" method="post" name="add_quartermile" id="add_quartermile" style="padding:0; margin:0;">
                 <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$_GET['VID'].'#quartermiles" />
                <table width="100%" cellpadding="3" cellspacing="1" border="0" class="bordercolor">
                   <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_reaction_time'].'</b><br />'.$txt['smfg_enter_reaction'].'</td>
                        <td class="windowbg"><input name="rt" type="text" size="15" value="" /></td>
                   </tr>
                   <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_sixty_foot_time'].'</b><br />'.$txt['smfg_enter_sixty'].'</td>
                        <td class="windowbg"><input name="sixty" type="text" size="15" value="" /></td>
                   </tr>
                   <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_three_foot_time'].'</b><br />'.$txt['smfg_enter_three'].'</td>
                        <td class="windowbg"><input name="three" type="text" size="15" value="" /></td>
                   </tr>
                   <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_eighth_time'].'</b><br />'.$txt['smfg_enter_eighth'].'</td>
                        <td class="windowbg"><input name="eighth" type="text" size="15" value="" /></td>
                   </tr>
                   <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_eighth_speed'].'</b><br />'.$txt['smfg_enter_eighth_speed'].'</td>
                        <td class="windowbg"><input name="eighthmph" type="text" size="15" value="" /></td>
                   </tr>
                   <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_thou_time'].'</b><br />'.$txt['smfg_enter_thou_time'].'</td>
                        <td class="windowbg"><input name="thou" type="text" size="15" value="" /></td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_quart_time'].'</b><br />'.$txt['smfg_enter_quart_time'].'</td>
                        <td class="windowbg"><input name="quart" type="text" size="15" value="" />&nbsp;'.$txt['smfg_required'].'</td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_quart_speed'].'</b><br />'.$txt['smfg_enter_quart_speed'].'</td>
                        <td class="windowbg"><input name="quartmph" type="text" size="15" value=""/>&nbsp;'.$txt['smfg_required'].'</td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_link_to_rr'].'</b></td>
                        <td class="windowbg">
                        <select id="dynorun_id" name="dynorun_id">
                        <option value="">'.$txt['smfg_select_dynocenter'].'</option>
                        <option value="">------</option>';
                        echo dynoqm_select($_GET['VID']);
                        echo '
                        </select>
                        </td>
                    </tr>';
                    
                    // Show the input for remote images if it is enabled
                    if($smfgSettings['enable_quartermile_images']) {
                    echo '
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" colspan="2" align="center">'.$txt['smfg_image_attachments'].'</td>
                    </tr>                    
                    <tr>
                        <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_attach_image'].'.<br />'.$txt['smfg_max_filesize'].': '.$smfgSettings['max_image_kbytes'].' '.$txt['smfg_kbytes'].'<br />'.$txt['smfg_max_resolution'].': '.$smfgSettings['max_image_resolution'].'x'.$smfgSettings['max_image_resolution'].'</b></td>
                        <td class="windowbg"><input type="hidden" name="MAX_FILE_SIZE" value="'.$context['max_image_bytes'].'" /><input type="file" size="30" name="FILE_UPLOAD"/></td>
                    </tr>';
    
                    // Show the input for remote images if it is enabled
                    if($smfgSettings['enable_remote_images']) {
                    echo '    
                    <tr>
                        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_enter_remote_url'].'</b></td>
                        <td class="windowbg"><input name="url_image" type="text" size="40" maxlength="255" value="http://" /></td>
                    </tr>';
                    }
                    echo '    
                    <tr>
                        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                        <td class="windowbg"><textarea name="attach_desc" cols="60" rows="3"></textarea></td>
                    </tr>';
                    }      
                    // Show the input for videos if it is enabled
                    if($smfgSettings['enable_quartermile_video']) {
                    echo '
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="2">'.$txt['smfg_hosted_videos'].'</td>
                    </tr>
                    
                    <tr>
                        <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_title'].'</b></td>
                        <td class="windowbg"><input type="text"  size="40" maxlength="75" value="" name="video_title"/></td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_url'].'</b></td>
                        <td class="windowbg"><input type="text"  size="40" maxlength="255" value="http://" name="video_url"/>&nbsp;<span class="smalltext"><a href="'.$scripturl.'?action=garage;sa=supported_video" rel="shadowbox;width=260;height=400" title="'.$txt['smfg_video_instructions'].'">Supported Sites</a></span></td>
                    </tr>';
                    
                    echo '    
                    <tr>
                        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                        <td class="windowbg"><textarea name="video_desc" cols="60" rows="3"></textarea></td>
                    </tr>';
                    
                    }                  
                    echo '    
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="2"><input type="hidden" value="'.$_GET['VID'].'" name="VID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="submit" type="submit" value="'.$txt['smfg_add_quartermile'].'" /></td>
                    </tr>
                </table>
            </form>
            <script language="JavaScript" type="text/javascript">
            var frmvalidator = new Validator("add_quartermile");
            var frm = document.forms["add_quartermile"];
            
            frmvalidator.addValidation("rt","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_rt_restrictions'].'");
            frmvalidator.addValidation("sixty","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_sixty_restrictions'].'");
            frmvalidator.addValidation("three","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_three_restrictions'].'");
            
            frmvalidator.addValidation("eighth","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_eighth_restrictions'].'");
            frmvalidator.addValidation("eighthmph","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_eighth_mph_restrictions'].'");
            
            frmvalidator.addValidation("thou","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_thou_restrictions'].'");
            
            frmvalidator.addValidation("quart","req","'.$txt['smfg_val_enter_quart'].'");
            frmvalidator.addValidation("quart","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_quart_restrictions'].'");
            
            frmvalidator.addValidation("quartmph","req","'.$txt['smfg_val_enter_quart_mph'].'");    
            frmvalidator.addValidation("quartmph","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_quart_mph_restrictions'].'");';
             if($smfgSettings['enable_vehicle_images']) {
                 echo '
                    frmvalidator.addValidation("attach_desc","maxlen=150","'.$txt['smfg_val_image_description_length'].'");';
             }
             if($smfgSettings['enable_vehicle_video']) {
                 echo '
                    frmvalidator.addValidation("video_desc","maxlen=150","'.$txt['smfg_val_video_description_length'].'");';
             }
             echo '
            </script>
            </td>
        </tr>

        <tr>
            <td class="titlebg" align="center" height="28"></td>
        </tr>
    </table>';
    
    echo smfg_footer();

}

function template_edit_quartermile()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
<tr>
    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_edit_quartermile'] . '</td>
</tr>

<tr>
    <td class="windowbg">
    
    <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;" id="tab_table">
            <tr id="tab_row">
                <td class="mirrortab_first" id="tab_first">&nbsp;</td>

                <td class="mirrortab_active_first" id="tab_active_left">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back" id="tab000">
                    <a href="#vehicle" onclick="change_tab(\'000\');">'.$txt['smfg_quartermile'].'</a>
                </td>
                <td class="mirrortab_active_last" id="tab_active_right">&nbsp;</td>';
                // Show the input for images if it is enabled
                if($smfgSettings['enable_quartermile_images']) {
                    echo '
                    <td valign="top" class="mirrortab_back" id="tab001">
                        <a href="#images" onclick="change_tab(\'001\');">'.$txt['smfg_images'].'</a>
                    </td>';
                }
                // Show the input for video if it is enabled
                if($smfgSettings['enable_quartermile_video']) {
                    echo '
                    <td valign="top" class="mirrortab_back" id="tab002">
                        <a href="#video" onclick="change_tab(\'002\');">'.$txt['smfg_video'].'</a>
                    </td>';
                }
                echo '
                <td class="mirrortab_last">&nbsp;</td>

            </tr>
    </table>
    ';
        
        // Begin dynamic js divs
        echo '                
        <div class="garage_panel" id="options000" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_quartermile'].'</td>
            </tr>
            <tr>
                <td class="windowbg">
                <form action="'.$scripturl.'?action=garage;sa=update_quartermile" enctype="multipart/form-data" method="post" name="edit_quartermile" id="edit_quartermile" style="padding:0; margin:0;">
                <input type="hidden" name="redirecturl" value="' . $scripturl . '?action=garage;sa=view_vehicle;VID='.$_GET['VID'].';#quartermiles" />
                <table width="100%" cellpadding="3" cellspacing="1" border="0" class="bordercolor">
                   <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_reaction_time'].'</b><br />'.$txt['smfg_enter_reaction'].'</td>
                        <td class="windowbg"><input name="rt" type="text" size="15" value="'.$context['qmiles']['rt'].'" /></td>
                   </tr>
                   <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_sixty_foot_time'].'</b><br />'.$txt['smfg_enter_sixty'].'</td>
                        <td class="windowbg"><input name="sixty" type="text" size="15" value="'.$context['qmiles']['sixty'].'" /></td>
                   </tr>
                   <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_three_foot_time'].'</b><br />'.$txt['smfg_enter_three'].'</td>
                        <td class="windowbg"><input name="three" type="text" size="15" value="'.$context['qmiles']['three'].'" /></td>
                   </tr>
                   <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_eighth_time'].'</b><br />'.$txt['smfg_enter_eighth'].'</td>
                        <td class="windowbg"><input name="eighth" type="text" size="15" value="'.$context['qmiles']['eighth'].'" /></td>
                   </tr>
                   <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_eighth_speed'].'</b><br />'.$txt['smfg_enter_eighth_speed'].'</td>
                        <td class="windowbg"><input name="eighthmph" type="text" size="15" value="'.$context['qmiles']['eighthmph'].'" /></td>
                   </tr>
                   <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_thou_time'].'</b><br />'.$txt['smfg_enter_thou_time'].'</td>
                        <td class="windowbg"><input name="thou" type="text" size="15" value="'.$context['qmiles']['thou'].'" /></td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_quart_time'].'</b><br />'.$txt['smfg_enter_quart_time'].'</td>
                        <td class="windowbg"><input name="quart" type="text" size="15" value="'.$context['qmiles']['quart'].'" /> '.$txt['smfg_required'].'</td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_quart_speed'].'</b><br />'.$txt['smfg_enter_quart_speed'].'</td>
                        <td class="windowbg"><input name="quartmph" type="text" size="15" value="'.$context['qmiles']['quartmph'].'"/> </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="35%" align="right"><b>'.$txt['smfg_link_to_rr'].'</b></td>
                        <td class="windowbg">
                        <select id="dynorun_id" name="dynorun_id">
                        <option value="">'.$txt['smfg_please_select'].'</option>
                        <option value="">------</option>';
                        echo dynoqm_select($_GET['VID'], $context['qmiles']['dynorun_id']);
                        echo '
                        </select>
                        </td>
                    </tr>                                 
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="2"><input type="hidden" value="'.$_GET['VID'].'" name="VID" /><input type="hidden" value="'.$_GET['QID'].'" name="QID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input type="hidden" name="redirecturl" value="' . $_SESSION['old_url'] . '" /><input name="submit" type="submit" value="'.$txt['smfg_update_time'].'" /></td>
                    </tr>
                </table>
            </form>
            <script language="JavaScript" type="text/javascript">
            var frmvalidator = new Validator("edit_quartermile");
            
            frmvalidator.addValidation("rt","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_rt_restrictions'].'");
            frmvalidator.addValidation("sixty","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_sixty_restrictions'].'");
            frmvalidator.addValidation("three","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_three_restrictions'].'");
            
            frmvalidator.addValidation("eighth","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_eighth_restrictions'].'");
            frmvalidator.addValidation("eighthmph","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_eighth_mph_restrictions'].'");
            
            frmvalidator.addValidation("thou","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_thou_restrictions'].'");
            
            frmvalidator.addValidation("quart","req","'.$txt['smfg_val_enter_quart'].'");
            frmvalidator.addValidation("quart","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_quart_restrictions'].'");
            
            frmvalidator.addValidation("quartmph","req","'.$txt['smfg_val_enter_quart_mph'].'");    
            frmvalidator.addValidation("quartmph","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_quart_mph_restrictions'].'");
            </script>';    
                echo '
                </td>
            </tr>    
        </table>
        </div>';
        // Show the input for images if it is enabled
        if($smfgSettings['enable_quartermile_images']) {
            echo '
            <div class="garage_panel" id="options001" style="display: none;">
            <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_images'].'</td>
                </tr>
                <tr>
                    <td class="windowbg">                
                    <form action="' . $scripturl . '?action=garage;sa=insert_quartermile_images" id="update_images" enctype="multipart/form-data" method="post" name="update_images" style="padding:0; margin:0;">
                    <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_quartermile;VID='.$_GET['VID'].';QID='.$_GET['QID'].'#images" />
                    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">           
                        <tr>
                            <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_attach_image'].'.<br />'.$txt['smfg_max_filesize'].': '.$smfgSettings['max_image_kbytes'].' '.$txt['smfg_kbytes'].'<br />'.$txt['smfg_max_resolution'].': '.$smfgSettings['max_image_resolution'].'x'.$smfgSettings['max_image_resolution'].'</b></td>
                            <td class="windowbg"><input type="hidden" name="MAX_FILE_SIZE" value="'.$context['max_image_bytes'].'" /><input type="file" size="30" name="FILE_UPLOAD"/></td>
                        </tr>';
        
                        // Show the input for remote images if it is enabled
                        if($smfgSettings['enable_remote_images']) {
                            echo '    
                            <tr>
                                <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_enter_remote_url'].'</b></td>
                                <td class="windowbg"><input name="url_image" type="text" size="40" maxlength="255" value="http://" /></td>
                            </tr>';
                        }
                        
                        echo '    
                        <tr>
                            <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                            <td class="windowbg"><textarea name="attach_desc" cols="60" rows="3"></textarea></td>
                        </tr>    
                        <tr>
                            <td colspan="2" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28"><input type="hidden" value="' . $_GET['VID'] . '" name="VID" /><input type="hidden" value="' . $_GET['QID'] . '" name="QID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="insert_modification_images" type="submit" value="'.$txt['smfg_add_new_image'].'" /></td>
                        </tr>
                    </table>
                    </form>
                    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
                        <tr>
                            <td class="windowbg" colspan="2">
                            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
                                <tr>
                                    <td class="windowbg" width="100%" align="center" colspan="3">'.$txt['smfg_edit_in_place_instructions'].'.<div id="updateStatus"></div></td>
                                </tr>
                                <tr>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_image'].'</td>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_description'].'</td>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_manage'].'</td>
                                </tr>';
                                $count = 0;
                                // If there is an image, show em
                                if(isset($context['qmiles'][$count]['image_id'])) {
                                    // and keep showing em
                                    while(isset($context['qmiles'][$count]['image_id'])) {
                                        echo '                            
                                        <tr class="windowbg">
                                            <td align="center" valign="middle">'.$context['qmiles'][$count]['image'].'</td>
                                            <td align="center" valign="middle">
                                            <div id="image'.$context['qmiles'][$count]['image_id'].'" class="editin">';
                                            // If there is no desc, let them add one
                                            if (!empty($context['qmiles'][$count]['attach_desc'])) {
                                                echo $context['qmiles'][$count]['attach_desc'];
                                            } 
                                                echo'</div></td>
                                            <td align="center" valign="middle">';
                                            if ($context['qmiles'][$count]['hilite'] != 1) {
                                                echo '
                                                    <form action="'.$scripturl.'?action=garage;sa=set_hilite_image_quartermile;VID='.$_GET['VID'].';QID='.$_GET['QID'].';image_id='.$context['qmiles'][$count]['image_id'].';sesc=' . $context['session_id'] . '" method="post" name="set_qmile_hilite_'.$context['qmiles'][$count]['image_id'].'" id="set_qmile_hilite_'.$context['qmiles'][$count]['image_id'].'" style="display: inline;">
                                                        <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_quartermile;VID='.$_GET['VID'].';QID='.$_GET['QID'].'#images" />
                                                        <a href="#" onClick="document.set_qmile_hilite_'.$context['qmiles'][$count]['image_id'].'.submit(); return false;">'.$txt['smfg_set_hilite_image'].'</a>
                                                    </form>
                                                    <br /><br />';
                                            } else {
                                                echo 
                                                    $txt['smfg_hilite_image'].'<br /><br />';
                                            }                                
                                            echo '
                                            <form action="'.$scripturl.'?action=garage;sa=remove_quartermile_image;VID='.$_GET['VID'].';QID='.$_GET['QID'].';image_id='.$context['qmiles'][$count]['image_id'].';sesc=' . $context['session_id'] . '" method="post" name="remove_quartermile_image_'.$context['qmiles'][$count]['image_id'].'" id="remove_quartermile_image_'.$context['qmiles'][$count]['image_id'].'" style="display: inline;">
                                            <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_quartermile;VID='.$_GET['VID'].';QID='.$_GET['QID'].'#images" />
                                            <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_image'].'\')) { document.remove_quartermile_image_'.$context['qmiles'][$count]['image_id'].'.submit(); } else { return false; } return false;">'.$txt['smfg_remove_image'].'</a>
                                            </form>
                                            </td>
                                        </tr>';                            
                                        $count++;                            
                                    }
                                } else {
                                    echo '
                                    <tr class="windowbg">
                                        <td colspan="3" align="center" valign="middle">'.$txt['smfg_no_quartermile_images'].'</td>
                                    </tr>';                  
                                }                            
                                echo '
                                </table> 
                            </td>
                        </tr>
                    </table>  
                    <script language="JavaScript" type="text/javascript">
                     var frmvalidator = new Validator("update_images");
                        
                     frmvalidator.addValidation("attach_desc","maxlen=150","'.$txt['smfg_val_image_description_length'].'");
                     
                    </script>           
                    </td>
                </tr>
            </table>
            </div>';
        }
        
        // Show the input for videos if it is enabled
        if($smfgSettings['enable_quartermile_video']) {
            echo '
            <div class="garage_panel" id="options002" style="display: none;">
            <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_video'].'</td>
                </tr>
                <tr>
                    <td class="windowbg">
                                        
                    <form action="' . $scripturl . '?action=garage;sa=insert_quartermile_video" id="update_video" enctype="multipart/form-data" method="post" name="update_video" style="padding:0; margin:0;">         
                    <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_quartermile;VID='.$_GET['VID'].';QID='.$_GET['QID'].'#video" />
                    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">  
                        <tr>
                            <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_title'].'</b></td>
                            <td class="windowbg"><input type="text"  size="40" maxlength="75" value="" name="video_title"/></td>
                        </tr>
                        <tr>
                            <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_url'].'</b></td>
                            <td class="windowbg"><input type="text"  size="40" maxlength="255" value="http://" name="video_url"/>&nbsp;<span class="smalltext"><a href="'.$scripturl.'?action=garage;sa=supported_video" rel="shadowbox;width=260;height=400" title="'.$txt['smfg_video_instructions'].'">Supported Sites</a></span></td>
                        </tr>';
                        
                        echo '    
                        <tr>
                            <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                            <td class="windowbg"><textarea name="video_desc" cols="60" rows="3"></textarea></td>
                        </tr>   
                        <tr>
                            <td colspan="2" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28"><input type="hidden" value="' . $_GET['VID'] . '" name="VID" /><input type="hidden" value="' . $_GET['QID'] . '" name="QID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="insert_quartermile_video" type="submit" value="'.$txt['smfg_add_new_video'].'" /></td>
                        </tr>
                    </table>
                    </form>
                    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">  
                        <tr>
                            <td class="windowbg" colspan="2">
                            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
                                <tr>
                                    <td class="windowbg" width="100%" align="center" colspan="3">'.$txt['smfg_edit_in_place_instructions'].'<div id="updateStatus2"></div></td>
                                </tr>
                                <tr>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_video'].'</td>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_title_description'].'</td>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_manage'].'</td>
                                </tr>';
                                
                                $count = 0;                            
                                // If there is an video, show em
                                if (isset($context['qmiles'][$count]['video_id'])) {
                                    // and keep showing em
                                    while(isset($context['qmiles'][$count]['video_id'])) {
                                        echo '                            
                                        <tr class="windowbg">
                                            <td align="center" valign="middle"><a href="'.$scripturl.'?action=garage;sa=video;id='.$context['qmiles'][$count]['video_id'].'" rel="shadowbox;width='.$context['qmiles'][$count]['video_width'].';height='.$context['qmiles'][$count]['video_height'].'" title="'.garage_title_clean('<b>'.$context['qmiles'][$count]['video_title'].'</b> :: '.$context['qmiles'][$count]['video_desc']).'" class="smfg_videoTitle"><img src="'.$context['qmiles'][$count]['video_thumb'].'" /></a></td>
                                            <td align="center" valign="middle">
                                            <div id="video_title'.$context['qmiles'][$count]['video_id'].'" class="editin" style="font-weight: bold;">';
                                            // If there is no title, let them add one
                                            if (!empty($context['qmiles'][$count]['video_title'])) {
                                                echo $context['qmiles'][$count]['video_title'];
                                            }
                                            echo '
                                            </div>
                                            <br />
                                            <div id="video'.$context['qmiles'][$count]['video_id'].'" class="editin">';
                                            // If there is no desc, let them add one
                                            if (!empty($context['qmiles'][$count]['video_desc'])) {
                                                echo $context['qmiles'][$count]['video_desc'];
                                            } 
                                                echo'</div></td>
                                            <td align="center" valign="middle">';                               
                                            echo '
                                            <form action="'.$scripturl.'?action=garage;sa=remove_video;VID='.$_GET['VID'].';video_id='.$context['qmiles'][$count]['video_id'].';sesc=' . $context['session_id'] . '" method="post" name="remove_quartermile_video_'.$context['qmiles'][$count]['video_id'].'" id="remove_quartermile_video_'.$context['qmiles'][$count]['video_id'].'" style="display: inline;">
                                            <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_quartermile;VID='.$_GET['VID'].';QID='.$_GET['QID'].'#video" />
                                            <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_video'].'\')) { document.remove_quartermile_video_'.$context['qmiles'][$count]['video_id'].'.submit(); } else { return false; } return false;">'.$txt['smfg_remove_video'].'</a>
                                            </form>
                                            </td>
                                        </tr>';                
                                        $count++;
                                    }
                                } else {
                                    echo '
                                    <tr class="windowbg">
                                        <td colspan="3" align="center" valign="middle">'.$txt['smfg_no_quartermile_videos'].'</td>
                                    </tr>';
                                }
                                echo '
                                </table> 
                            </td>
                        </tr>
                    </table>  
                    </td>
                </tr>
            </table>
            <script language="JavaScript" type="text/javascript">
             var frmvalidator = new Validator("update_video");
              
             frmvalidator.addValidation("video_desc","maxlen=150","'.$txt['smfg_val_video_description_length'].'");
             frmvalidator.addValidation("video_title","req","'.$txt['smfg_val_enter_title'].'");
             
            </script>
            </div>';
        }
        
        echo '

<script type="text/javascript">
<!--
    var lowest_tab = \'000\';
    var active_id = \'000\';
    if (document.location.hash == "")
    {
        change_tab(lowest_tab);
    }
    else if (document.location.hash == "#vehicle")
    {
        change_tab(\'000\');
    }
    else if (document.location.hash == "#images")
    {
        change_tab(\'001\');
    }
    else if (document.location.hash == "#video")
    {
        change_tab(\'002\');
    }

//-->

</script>
    
    </td>
</tr>

<tr>
    <td class="titlebg" align="center" height="28">&nbsp;</td>
</tr>
</table>';
    
    echo smfg_footer();

}

function template_view_quartermile()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings, $boardurl;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }
        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
    <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_view_quartermile'].'</td>
        </tr>

        <tr>
<td class="windowbg">
    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
    <tr>
        <td class="windowbg" align="center" valign="top">';       
            
            // Pending?
            if($context['qmiles']['pending'] == '1') {
                echo '
            <table class="tborder" width="90%">
                <tr class="windowbg">
                    <td>
                    <table border="0">
                        <tr>
                            <td align="center" valign="middle" width="40"><img src="'. $settings['default_images_url'] . '/garage_delete.gif" alt="" title="" /></td>
                            <td align="center" valign="middle">'.$txt['smfg_pending_item'].'</td>
                        </tr>
                    </table>
                    </td>
                </tr>
            </table><br />';
            }
            
            echo '
            
            <table border="0" width="70%">
                <tr>
                    <td align="left"><b>'.$txt['smfg_owner'].'</b></td>
                </tr>
                <tr>
                    <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['user_vehicles']['user_id'].'"><b>'.$context['qmiles']['owner'].'</b></a></td>
                </tr>
                <tr>
                    <td align="left"><b>'.$txt['smfg_hilite_image'].'</b></td>
                </tr>
                <tr>
                    <td align="center">', (!empty($context['hilite_image_location'])) ? '<a href="'.$context['hilite_image_location'].'" rel="shadowbox" title="'.$context['qmiles']['quart'].' @ '.$context['qmiles']['quartmph'].' :: '.garage_title_clean($context['hilite_desc']).'" class="smfg_imageTitle"><img src="'.$context['hilite_thumb_location'].'" width="'.$context['hilite_thumb_width'].'" height="'.$context['hilite_thumb_height'].'" /></a>' : '' ,'</td>
                </tr>
            </table>
        </td>
        <td width="30%" class="windowbg" valign="middle" align="center">
            <table border="0" cellspacing="1" cellpadding="3">
            <tr>
                <td align="left"><b>'.$txt['smfg_vehicle'].'</b></td>
                <td align="left"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$_GET['VID'].'">'.garage_title_clean($context['user_vehicles']['title']).'</a><td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_rt'].'</b></td>
                <td align="left">'.$context['qmiles']['rt'].'<td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_sixty'].'</b></td>
                <td align="left">'.$context['qmiles']['sixty'].'<td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_three_thiry'].'</b></td>
                <td align="left">'.$context['qmiles']['three'].'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_eighth'].'</b></td>
                <td align="left">'.$context['qmiles']['eighth'].'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_eighth_mph'].'</b></td>
                <td align="left">'.$context['qmiles']['eighthmph'].' MPH</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_thou'].'</b></td>
                <td align="left">'.$context['qmiles']['thou'].'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_quart'].'</b></td>
                <td align="left">'.$context['qmiles']['quart'].'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_quart_mph'].'</b></td>
                <td align="left">'.$context['qmiles']['quartmph'].' MPH</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_date_created'].'</b></td>
                <td align="left">'.date($context['date_format'],$context['qmiles']['date_created']).'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_date_updated'].'</b></td>
                <td align="left">'.date($context['date_format'],$context['qmiles']['date_updated']).'</td>
            </tr>
            </table>
        </td>
    </tr>
    </table>';
    
    if($smfgSettings['enable_quartermile_images'] || $smfgSettings['enable_quartermile_video']) {
    
    echo '
    <br />
    <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;" id="tab_table">
            <tr id="tab_row">
                <td class="mirrortab_first" id="tab_first">&nbsp;</td>

                <td class="mirrortab_active_first" id="tab_active_left">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back" id="tab000">
                    <a href="#images" onclick="change_tab(\'000\');">'.$txt['smfg_images'].'</a>
                </td>
                <td class="mirrortab_active_last" id="tab_active_right">&nbsp;</td>';
                $count = 0;
                if(isset($context['qmiles'][$count]['video_id']) && $smfgSettings['enable_quartermile_video']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab001">
                    <a href="#videos" onclick="change_tab(\'001\');">'.$txt['smfg_videos'].'</a>
                </td>';
                }
                echo '
                <td class="mirrortab_last">&nbsp;</td>

            </tr>
    </table>';
        
        // Begin dynamic js divs
        echo '        
        <div class="garage_panel" id="options000" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_images'].'</td>
            </tr>';
            $count = 0;
            if(isset($context['qmiles'][$count]['image_id'])) {
            echo '
            <tr>
                <td class="windowbg" valign="middle">';
                while(isset($context['qmiles'][$count]['image_id'])) {
                    echo '
                <a href="'.$context['qmiles'][$count]['attach_location'].'" rel="shadowbox[qmiles]" title="'.garage_title_clean($context['qmiles']['quart'].' @ '.$context['qmiles']['quartmph'].' :: '.$context['qmiles'][$count]['attach_desc']).'" class="smfg_imageTitle"><img src="'.$context['qmiles'][$count]['attach_thumb_location'].'" width="'.$context['qmiles'][$count]['attach_thumb_width'].'" height="'.$context['qmiles'][$count]['attach_thumb_height'].'" /></a>';
                $count++;
                }
                echo '
                </td>
            </tr>';
            }  else {
            echo '
            <tr>
                <td class="windowbg" align="center">'.$txt['smfg_no_quartermile_images'].'</td>
            </tr>';
            }
        echo '
        </table>     
        </div>
        <div class="garage_panel" id="options001" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_videos'].'</td>
            </tr>';
            $count = 0;
            if(isset($context['qmiles'][$count]['video_id'])) {
            echo '
            <tr>
                <td class="windowbg" valign="middle">';
                while(isset($context['qmiles'][$count]['video_id'])) {
                    echo '
                <a href="'.$scripturl.'?action=garage;sa=video;id='.$context['qmiles'][$count]['video_id'].'" rel="shadowbox[video];width='.$context['qmiles'][$count]['video_width'].';height='.$context['qmiles'][$count]['video_height'].';" title="'.garage_title_clean('<b>'.$context['qmiles'][$count]['video_title'].'</b> :: '.$context['qmiles'][$count]['video_desc']).'" class="smfg_videoTitle"><img src="'.$context['qmiles'][$count]['video_thumb'].'" /></a>';
                $count++;
                }
                echo '
                </td>
            </tr>';
            }  else {
            echo '
            <tr>
                <td class="windowbg" align="center">'.$txt['smfg_no_quartermile_videos'].'</td>
            </tr>';
            }
        echo '  
        </table>     
        </div>

        <script type="text/javascript">
        <!--
            var lowest_tab = \'000\';
            var active_id = \'000\';
            if (document.location.hash == "")
            {
                change_tab(lowest_tab);
            }
            else if (document.location.hash == "#images")
            {
                change_tab(\'000\');
            }
            else if (document.location.hash == "#videos")
            {
                change_tab(\'001\');
            }

        //-->

        </script>
        </td>
        </tr>

        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28"></td>
        </tr>
        </table>';

    }
    
    echo smfg_footer();

}

function template_add_dynorun()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
    <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_add_dynorun'] . '</td>
        </tr>';
        
        // Submitted dynocenter?
        if($_SESSION['added_dynocenter']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_dynocenter_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a dyno is added
            unset($_SESSION['added_dynocenter']);
        }  
        
        echo '
        <tr>
            <td class="windowbg">
            <form action="'.$scripturl.'?action=garage;sa=insert_dynorun" enctype="multipart/form-data" method="post" name="add_dynorun" id="add_dynorun" style="padding:0; margin:0;">
                <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$_GET['VID'].'#dynoruns" />

                <table width="100%" cellpadding="3" cellspacing="1" border="0" class="bordercolor">
                    <tr>
                        <td class="windowbg2" align="right" width="35%"><b>'.$txt['smfg_dynocenter'].'</b></td>
                        <td class="windowbg">
                        <select id="dynocenter_id" name="dynocenter_id">
                        <option value="">'.$txt['smfg_select_dynocenter'].'</option>
                        <option value="">------</option>';
                        echo dynocenter_select();
                    echo '
                        </select>';
                        if($smfgSettings['enable_user_submit_business']) {
                            echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_business;bustype=dynocenter" rel="shadowbox;width=620;height=560" title="Garage :: Submit Dynocenter">'.$txt['smfg_here'].'</a>';
                        }
                        echo '
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="35%"><b>'.$txt['smfg_bhp'].'</b><br />'.$txt['smfg_enter_bhp'].'</td>
                        <td class="windowbg">
                        <input name="bhp" type="text" size="15" value ="" />&nbsp;
                        <select id="bhp_unit" name="bhp_unit">
                        <option value="">'.$txt['smfg_please_select'].'</option>
                        <option value="">------</option>
                        <option value="wheel" >'.$txt['smfg_wheel'].'</option>
                        <option value="hub" >'.$txt['smfg_hub'].'</option>
                        <option value="flywheel" >'.$txt['smfg_flywheel'].'</option>
                        </select>&nbsp;'.$txt['smfg_required'].'
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="35%"><b>'.$txt['smfg_torque'].'</b><br />'.$txt['smfg_enter_torque'].'</td>
                        <td class="windowbg">
                        <input name="torque" type="text" size="15" value ="" />&nbsp;
                        <select id="torque_unit" name="torque_unit">
                        <option value="">'.$txt['smfg_please_select'].'</option>
                        <option value="">------</option>
                        <option value="wheel" >'.$txt['smfg_wheel'].'</option>
                        <option value="hub" >'.$txt['smfg_hub'].'</option>
                        <option value="flywheel" >'.$txt['smfg_flywheel'].'</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="35%"><b>'.$txt['smfg_boost'].'</b><br />'.$txt['smfg_enter_boost'].'</td>
                        <td class="windowbg">
                        <input name="boost" type="text" size="15" value ="" />&nbsp;
                        <select id="boost_unit" name="boost_unit">
                        <option value="">'.$txt['smfg_please_select'].'</option>
                        <option value="">------</option>
                        <option value="PSI" >'.$txt['smfg_psi'].'</option>
                        <option value="BAR" >'.$txt['smfg_bar'].'</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="35%"><b>'.$txt['smfg_nitrous'].'</b><br />'.$txt['smfg_enter_nitrous'].'</td>
                        <td class="windowbg">
                        <select id="nitrous" name="nitrous">
                        <option value="">'.$txt['smfg_please_select'].'</option>
                        <option value="">------</option>
                        <option value="0" >'.$txt['smfg_no_nos'].'</option>
                        <option value="25" >25 '.$txt['smfg_bhp'].' '.$txt['smfg_shot'].'</option>
                        <option value="50" >50 '.$txt['smfg_bhp'].' '.$txt['smfg_shot'].'</option>
                        <option value="75" >75 '.$txt['smfg_bhp'].' '.$txt['smfg_shot'].'</option>
                        <option value="100" >100 '.$txt['smfg_bhp'].' '.$txt['smfg_shot'].'</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="35%"><b>'.$txt['smfg_peakpoint'].'</b><br />'.$txt['smfg_rpm_at_peak'].'</td>

                        <td class="windowbg"><input name="peakpoint" type="text" size="15" value ="" /></td>
                    </tr>';
                    
                    // Show the input for images if it is enabled
                    if($smfgSettings['enable_dynorun_images']) {
                    echo '
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" colspan="2" align="center">'.$txt['smfg_image_attachments'].'</td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_attach_image'].'.<br />'.$txt['smfg_max_filesize'].': '.$smfgSettings['max_image_kbytes'].' '.$txt['smfg_kbytes'].'<br />'.$txt['smfg_max_resolution'].': '.$smfgSettings['max_image_resolution'].'x'.$smfgSettings['max_image_resolution'].'</b></td>
                        <td class="windowbg"><input type="hidden" name="MAX_FILE_SIZE" value="'.$context['max_image_bytes'].'" /><input type="file" size="30" name="FILE_UPLOAD"/></td>
                    </tr>';
    
                    // Show the input for remote images if it is enabled
                    if($smfgSettings['enable_remote_images']) {
                    echo '    
                    <tr>
                        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_enter_remote_url'].'</b></td>
                        <td class="windowbg"><input name="url_image" type="text" size="40" maxlength="255" value="http://" /></td>
                    </tr>';
                    }
                    echo '    
                    <tr>
                        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                        <td class="windowbg"><textarea name="attach_desc" cols="60" rows="3"></textarea></td>
                    </tr>';
                    }         
                    // Show the input for videos if it is enabled
                    if($smfgSettings['enable_dynorun_video']) {
                    echo '
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="2">'.$txt['smfg_hosted_videos'].'</td>
                    </tr>
                    
                    <tr>
                        <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_title'].'</b></td>
                        <td class="windowbg"><input type="text"  size="40" maxlength="75" value="" name="video_title"/></td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_url'].'</b></td>
                        <td class="windowbg"><input type="text"  size="40" maxlength="255" value="http://" name="video_url"/>&nbsp;<span class="smalltext"><a href="'.$scripturl.'?action=garage;sa=supported_video" rel="shadowbox;width=260;height=400" title="'.$txt['smfg_video_instructions'].'">Supported Sites</a></span></td>
                    </tr>';
                    
                    echo '    
                    <tr>
                        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                        <td class="windowbg"><textarea name="video_desc" cols="60" rows="3"></textarea></td>
                    </tr>';
                    
                    }               
                    echo '
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="2"><input type="hidden" value="'.$_GET['VID'].'" name="VID" /><input type="hidden" value="" name="DID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="submit" type="submit" value="'.$txt['smfg_add_dynorun'].'" /></td>
                    </tr>
                </table>
                </form>
                <script language="JavaScript" type="text/javascript">
                var frmvalidator = new Validator("add_dynorun");
                var frm = document.forms["add_dynorun"];
                
                frmvalidator.addValidation("dynocenter_id","req","'.$txt['smfg_val_select_dynocenter'].'");
                frmvalidator.addValidation("dynocenter_id","dontselect=0","'.$txt['smfg_val_select_dynocenter'].'");
                frmvalidator.addValidation("dynocenter_id","dontselect=1","'.$txt['smfg_val_select_dynocenter'].'");
                
                frmvalidator.addValidation("bhp","req","'.$txt['smfg_val_enter_bhp'].'");
                frmvalidator.addValidation("bhp","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_bhp_restrictions'].'");
                frmvalidator.addValidation("bhp_unit","req","'.$txt['smfg_val_select_bhp_unit'].'");
                
                frmvalidator.addValidation("torque","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_torque_restrictions'].'");
                frmvalidator.addValidation("boost","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_boost_restrictions'].'");
                    
                frmvalidator.addValidation("peakpoint","regexp=^[.0-9]{1,9}$","'.$txt['smfg_val_peakpoint_restrictions'].'");';
                 if($smfgSettings['enable_vehicle_images']) {
                     echo '
                        frmvalidator.addValidation("attach_desc","maxlen=150","'.$txt['smfg_val_image_description_length'].'");';
                 }
                 if($smfgSettings['enable_vehicle_video']) {
                     echo '
                        frmvalidator.addValidation("video_desc","maxlen=150","'.$txt['smfg_val_video_description_length'].'");';
                 }
                 echo '
                </script>
            </td>
        </tr>

        <tr>
            <td class="titlebg" align="center" height="28"></td>
        </tr>
    </table>';
    
    echo smfg_footer();

}

function template_edit_dynorun()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
<tr>
    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_edit_dynorun'] . '</td>
</tr>

<tr>
    <td class="windowbg">
    
    <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;" id="tab_table">
            <tr id="tab_row">
                <td class="mirrortab_first" id="tab_first">&nbsp;</td>

                <td class="mirrortab_active_first" id="tab_active_left">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back" id="tab000">
                    <a href="#vehicle" onclick="change_tab(\'000\');">'.$txt['smfg_dynorun'].'</a>
                </td>
                <td class="mirrortab_active_last" id="tab_active_right">&nbsp;</td>';
                // Show the input for images if it is enabled
                if($smfgSettings['enable_dynorun_images']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab001">
                    <a href="#images" onclick="change_tab(\'001\');">'.$txt['smfg_images'].'</a>
                </td>';
                }
                // Show the input for video if it is enabled
                if($smfgSettings['enable_dynorun_video']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab002">
                    <a href="#video" onclick="change_tab(\'002\');">'.$txt['smfg_video'].'</a>
                </td>';
                }
                echo'
                <td class="mirrortab_last">&nbsp;</td>

            </tr>
    </table>
    ';
        
        // Begin dynamic js divs
        echo '                     
        <div class="garage_panel" id="options000" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_dynorun'].'</td>
            </tr>';
        
            // Submitted dynocenter?
            if($_SESSION['added_dynocenter']) {
                echo '
                <tr>
                    <td class="windowbg" align="center" valign="middle">'.$txt['smfg_dynocenter_added'].'</td>
                </tr>';
                // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a dyno is added
                unset($_SESSION['added_dynocenter']);
            }  
            
            echo '
            <tr>
                <td class="windowbg">
                <form action="'.$scripturl.'?action=garage;sa=update_dynorun" enctype="multipart/form-data" method="post" name="edit_dynorun" id="edit_dynorun" style="padding:0; margin:0;">
                <input type="hidden" name="redirecturl" value="' . $scripturl . '?action=garage;sa=view_vehicle;VID='.$_GET['VID'].';#dynoruns" />
                <table width="100%" cellpadding="3" cellspacing="1" border="0" class="bordercolor">
                    <tr>
                        <td class="windowbg2" align="right" width="35%"><b>'.$txt['smfg_dynocenter'].'</b></td>
                        <td class="windowbg">
                        <select id="dynocenter_id" name="dynocenter_id">
                        <option value="">'.$txt['smfg_select_dynocenter'].'</option>
                        <option value="">------</option>';
                        echo dynocenter_select($context['dynoruns']['dynocenter_id']);
                    echo '
                        </select>';
                        if($smfgSettings['enable_user_submit_business']) {
                            echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_business;bustype=dynocenter" rel="shadowbox;width=620;height=560" title="Garage :: Submit Dynocenter">'.$txt['smfg_here'].'</a>';
                        }
                        echo '
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="35%"><b>'.$txt['smfg_bhp'].'</b><br />'.$txt['smfg_enter_bhp'].'</td>
                        <td class="windowbg">';
                        echo '
                        <input name="bhp" type="text" size="15" value ="'.$context['dynoruns']['bhp'].'" />&nbsp;
                        <select id="bhp_unit" name="bhp_unit">
                        <option value="">'.$txt['smfg_please_select'].'</option>
                        <option value="">------</option>
                        <option value="wheel" '.$context['bhp_wheel'].'>'.$txt['smfg_wheel'].'</option>
                        <option value="hub" '.$context['bhp_hub'].'>'.$txt['smfg_hub'].'</option>
                        <option value="flywheel" '.$context['bhp_fly'].'>'.$txt['smfg_flywheel'].'</option>
                        </select>&nbsp;'.$txt['smfg_required'].'
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="35%"><b>'.$txt['smfg_torque'].'</b><br />'.$txt['smfg_enter_torque'].'</td>
                        <td class="windowbg">';
                        echo '
                        <input name="torque" type="text" size="15" value ="'.$context['dynoruns']['torque'].'" />&nbsp;
                        <select id="torque_unit" name="torque_unit">
                        <option value="">'.$txt['smfg_please_select'].'</option>
                        <option value="">------</option>
                        <option value="wheel" '.$context['torque_wheel'].'>'.$txt['smfg_wheel'].'</option>
                        <option value="hub" '.$context['torque_hub'].'>'.$txt['smfg_hub'].'</option>
                        <option value="flywheel" '.$context['torque_fly'].'>'.$txt['smfg_flywheel'].'</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="35%"><b>'.$txt['smfg_boost'].'</b><br />'.$txt['smfg_enter_boost'].'</td>
                        <td class="windowbg">';
                        echo '
                        <input name="boost" type="text" size="15" value ="'.$context['dynoruns']['boost'].'" />&nbsp;
                        <select id="boost_unit" name="boost_unit">
                        <option value="">'.$txt['smfg_please_select'].'</option>
                        <option value="">------</option>
                        <option value="PSI" '.$context['psi'].'>'.$txt['smfg_psi'].'</option>
                        <option value="BAR" '.$context['bar'].'>'.$txt['smfg_bar'].'</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="35%"><b>'.$txt['smfg_nitrous'].'</b><br />'.$txt['smfg_enter_nitrous'].'</td>
                        <td class="windowbg">';
                        echo '
                        <select id="nitrous" name="nitrous">
                        <option value="">'.$txt['smfg_please_select'].'</option>
                        <option value="">------</option>
                        <option value="0" '.$context['n0'].'>'.$txt['smfg_no_nos'].'</option>
                        <option value="25" '.$context['n25'].'>25 '.$txt['smfg_bhp'].' '.$txt['smfg_shot'].'</option>
                        <option value="50" '.$context['n50'].'>50 '.$txt['smfg_bhp'].' '.$txt['smfg_shot'].'</option>
                        <option value="75" '.$context['n75'].'>75 '.$txt['smfg_bhp'].' '.$txt['smfg_shot'].'</option>
                        <option value="100" '.$context['n100'].'>100 '.$txt['smfg_bhp'].' '.$txt['smfg_shot'].'</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="35%"><b>'.$txt['smfg_peakpoint'].'</b><br />'.$txt['smfg_rpm_at_peak'].'</td>

                        <td class="windowbg"><input name="peakpoint" type="text" size="15" value ="'.$context['dynoruns']['peakpoint'].'" /></td>
                    </tr>               
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="2"><input type="hidden" value="'.$_GET['VID'].'" name="VID" /><input type="hidden" value="'.$_GET['DID'].'" name="DID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input type="hidden" name="redirecturl" value="' . $_SESSION['old_url'] . '" /><input name="submit" type="submit" value="'.$txt['smfg_update_dynorun'].'" /></td>
                    </tr>
                </table>
                </form>
                <script language="JavaScript" type="text/javascript">
                var frmvalidator = new Validator("edit_dynorun");
                var frm = document.forms["edit_dynorun"];
                
                frmvalidator.addValidation("dynocenter_id","req","'.$txt['smfg_val_select_dynocenter'].'");
                frmvalidator.addValidation("dynocenter_id","dontselect=0","'.$txt['smfg_val_select_dynocenter'].'");
                frmvalidator.addValidation("dynocenter_id","dontselect=1","'.$txt['smfg_val_select_dynocenter'].'");
                
                frmvalidator.addValidation("bhp","req","'.$txt['smfg_val_enter_bhp'].'");
                frmvalidator.addValidation("bhp","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_bhp_restrictions'].'");
                frmvalidator.addValidation("bhp_unit","req","'.$txt['smfg_val_select_bhp_unit'].'");
                
                frmvalidator.addValidation("torque","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_torque_restrictions'].'");
                frmvalidator.addValidation("boost","regexp=^[.0-9]{1,7}$","'.$txt['smfg_val_boost_restrictions'].'");
                    
                frmvalidator.addValidation("peakpoint","regexp=^[.0-9]{1,9}$","'.$txt['smfg_val_peakpoint_restrictions'].'");
                </script>';    
                echo '
                </td>
            </tr>    
        </table>
        </div>';
        // Show the input for images if it is enabled
        if($smfgSettings['enable_dynorun_images']) {
        echo '
        <div class="garage_panel" id="options001" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_images'].'</td>
            </tr>
            <tr>
                <td class="windowbg">
                
                <form action="' . $scripturl . '?action=garage;sa=insert_dynorun_images" id="update_images" enctype="multipart/form-data" method="post" name="update_images" style="padding:0; margin:0;">
                <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_dynorun;VID='.$_GET['VID'].';DID='.$_GET['DID'].'#images" />
                <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">           
                    <tr>
                        <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_attach_image'].'.<br />'.$txt['smfg_max_filesize'].': '.$smfgSettings['max_image_kbytes'].' '.$txt['smfg_kbytes'].'<br />'.$txt['smfg_max_resolution'].': '.$smfgSettings['max_image_resolution'].'x'.$smfgSettings['max_image_resolution'].'</b></td>
                        <td class="windowbg"><input type="hidden" name="MAX_FILE_SIZE" value="'.$context['max_image_bytes'].'" /><input type="file" size="30" name="FILE_UPLOAD"/></td>
                    </tr>';
    
                    // Show the input for remote images if it is enabled
                    if($smfgSettings['enable_remote_images']) {
                    echo '    
                    <tr>
                        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_enter_remote_url'].'</b></td>
                        <td class="windowbg"><input name="url_image" type="text" size="40" maxlength="255" value="http://" /></td>
                    </tr>';
                    }
                    
                    echo '    
                    <tr>
                        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                        <td class="windowbg"><textarea name="attach_desc" cols="60" rows="3"></textarea></td>
                    </tr>    
                    <tr>
                        <td colspan="2" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28"><input type="hidden" value="' . $_GET['VID'] . '" name="VID" /><input type="hidden" value="' . $_GET['DID'] . '" name="DID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="insert_dynorun_images" type="submit" value="'.$txt['smfg_add_new_image'].'" /></td>
                    </tr>
                </table>
                </form>
                <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
                    <tr>
                        <td class="windowbg" colspan="2">
                        <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
                            <tr>
                                <td class="windowbg" width="100%" align="center" colspan="3">'.$txt['smfg_edit_in_place_instructions'].'.<div id="updateStatus"></div></td>
                            </tr>
                            <tr>
                                <td class="catbg" width="33%" align="center">'.$txt['smfg_image'].'</td>
                                <td class="catbg" width="33%" align="center">'.$txt['smfg_description'].'</td>
                                <td class="catbg" width="33%" align="center">'.$txt['smfg_manage'].'</td>
                            </tr>';
                            $count = 0;                            
                            // If there is an image, show em
                            if(isset($context['dynoruns'][$count]['image_id'])) {
                                // and keep showing em
                                while(isset($context['dynoruns'][$count]['image_id'])) {
                                    echo '                            
                                    <tr class="windowbg">
                                        <td align="center" valign="middle">'.$context['dynoruns'][$count]['image'].'</td>
                                        <td align="center" valign="middle">
                                            <div id="image'.$context['dynoruns'][$count]['image_id'].'" class="editin">';
                                            // If there is no desc, let them add one
                                            if (!empty($context['dynoruns'][$count]['attach_desc'])) {
                                                echo $context['dynoruns'][$count]['attach_desc'];
                                            } 
                                                echo'</div></td>
                                        <td align="center" valign="middle">';
                                        if ($context['dynoruns'][$count]['hilite'] != 1) {
                                            echo '
                                            <form action="'.$scripturl.'?action=garage;sa=set_hilite_image_dynorun;VID='.$_GET['VID'].';DID='.$_GET['DID'].';image_id='.$context['dynoruns'][$count]['image_id'].';sesc=' . $context['session_id'] . '" method="post" name="set_dynorun_hilite_'.$context['dynoruns'][$count]['image_id'].'" id="set_dynorun_hilite_'.$context['dynoruns'][$count]['image_id'].'" style="display: inline;">
                                                <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_dynorun;VID='.$_GET['VID'].';DID='.$_GET['DID'].'#images" />
                                                <a href="#" onClick="document.set_dynorun_hilite_'.$context['dynoruns'][$count]['image_id'].'.submit(); return false;">'.$txt['smfg_set_hilite_image'].'</a>
                                            </form>
                                            <br /><br />';
                                        } else {
                                            echo 
                                                $txt['smfg_hilite_image'].'<br /><br />';
                                        }                                
                                        echo '
                                        <form action="'.$scripturl.'?action=garage;sa=remove_dynorun_image;VID='.$_GET['VID'].';DID='.$_GET['DID'].';image_id='.$context['dynoruns'][$count]['image_id'].';sesc=' . $context['session_id'] . '" method="post" name="remove_dynorun_image_'.$context['dynoruns'][$count]['image_id'].'" id="remove_dynorun_image_'.$context['dynoruns'][$count]['image_id'].'" style="display: inline;">
                                        <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_dynorun;VID='.$_GET['VID'].';DID='.$_GET['DID'].'#images" />
                                        <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_image'].'\')) { document.remove_dynorun_image_'.$context['dynoruns'][$count]['image_id'].'.submit(); } else { return false; } return false;">'.$txt['smfg_remove_image'].'</a>
                                        </form>
                                        </td>
                                    </tr>';                            
                                    $count++;                            
                                }
                            } else {
                                echo '
                                <tr class="windowbg">
                                    <td colspan="3" align="center" valign="middle">'.$txt['smfg_no_dynorun_image'].'</td>
                                </tr>';                  
                            }
                            echo '
                            </table> 
                        </td>
                    </tr>
                </table> 
                <script language="JavaScript" type="text/javascript">
                 var frmvalidator = new Validator("update_images");
                    
                    frmvalidator.addValidation("attach_desc","maxlen=150","'.$txt['smfg_val_image_description_length'].'");
                 
                </script>            
                </td>
            </tr>
        </table>
        </div>';
        }        
        // Show the input for videos if it is enabled
        if($smfgSettings['enable_dynorun_video']) {
            echo '
            <div class="garage_panel" id="options002" style="display: none;">
            <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_video'].'</td>
                </tr>
                <tr>
                    <td class="windowbg">
                                        
                    <form action="' . $scripturl . '?action=garage;sa=insert_dynorun_video" id="update_video" enctype="multipart/form-data" method="post" name="update_video" style="padding:0; margin:0;">         
                    <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_dynorun;VID='.$_GET['VID'].';DID='.$_GET['DID'].'#video" />
                    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">  
                        <tr>
                            <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_title'].'</b></td>
                            <td class="windowbg"><input type="text"  size="40" maxlength="75" value="" name="video_title"/></td>
                        </tr>
                        <tr>
                            <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_url'].'</b></td>
                            <td class="windowbg"><input type="text"  size="40" maxlength="255" value="http://" name="video_url"/>&nbsp;<span class="smalltext"><a href="'.$scripturl.'?action=garage;sa=supported_video" rel="shadowbox;width=260;height=400" title="'.$txt['smfg_video_instructions'].'">Supported Sites</a></span></td>
                        </tr>';
                        
                        echo '    
                        <tr>
                            <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                            <td class="windowbg"><textarea name="video_desc" cols="60" rows="3"></textarea></td>
                        </tr>   
                        <tr>
                            <td colspan="2" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28"><input type="hidden" value="' . $_GET['VID'] . '" name="VID" /><input type="hidden" value="' . $_GET['DID'] . '" name="DID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="insert_dynorun_video" type="submit" value="'.$txt['smfg_add_new_video'].'" /></td>
                        </tr>
                    </table>
                    </form>
                    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">  
                        <tr>
                            <td class="windowbg" colspan="2">
                            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
                                <tr>
                                    <td class="windowbg" width="100%" align="center" colspan="3">'.$txt['smfg_edit_in_place_instructions'].'<div id="updateStatus2"></div></td>
                                </tr>
                                <tr>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_video'].'</td>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_title_description'].'</td>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_manage'].'</td>
                                </tr>';
                                
                                $count = 0;                            
                                // If there is an video, show em
                                if (isset($context['dynoruns'][$count]['video_id'])) {
                                    // and keep showing em
                                    while(isset($context['dynoruns'][$count]['video_id'])) {
                                        echo '                            
                                        <tr class="windowbg">
                                            <td align="center" valign="middle"><a href="'.$scripturl.'?action=garage;sa=video;id='.$context['dynoruns'][$count]['video_id'].'" rel="shadowbox;width='.$context['dynoruns'][$count]['video_width'].';height='.$context['dynoruns'][$count]['video_height'].'" title="'.garage_title_clean('<b>'.$context['dynoruns'][$count]['video_title'].'</b> :: '.$context['dynoruns'][$count]['video_desc']).'" class="smfg_videoTitle"><img src="'.$context['dynoruns'][$count]['video_thumb'].'" /></a></td>
                                            <td align="center" valign="middle">
                                            <div id="video_title'.$context['dynoruns'][$count]['video_id'].'" class="editin" style="font-weight: bold;">';
                                            // If there is no title, let them add one
                                            if (!empty($context['dynoruns'][$count]['video_title'])) {
                                                echo $context['dynoruns'][$count]['video_title'];
                                            }
                                            echo '
                                            </div>
                                            <br />
                                            <div id="video'.$context['dynoruns'][$count]['video_id'].'" class="editin">';
                                            // If there is no desc, let them add one
                                            if (!empty($context['dynoruns'][$count]['video_desc'])) {
                                                echo $context['dynoruns'][$count]['video_desc'];
                                            } 
                                                echo'</div></td>
                                            <td align="center" valign="middle">';                               
                                            echo '
                                            <form action="'.$scripturl.'?action=garage;sa=remove_video;VID='.$_GET['VID'].';video_id='.$context['dynoruns'][$count]['video_id'].';sesc=' . $context['session_id'] . '" method="post" name="remove_dynorun_video_'.$context['dynoruns'][$count]['video_id'].'" id="remove_dynorun_video_'.$context['dynoruns'][$count]['video_id'].'" style="display: inline;">
                                            <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_dynorun;VID='.$_GET['VID'].';DID='.$_GET['DID'].'#video" />
                                            <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_video'].'\')) { document.remove_dynorun_video_'.$context['dynoruns'][$count]['video_id'].'.submit(); } else { return false; } return false;">'.$txt['smfg_remove_video'].'</a>
                                            </form>
                                            </td>
                                        </tr>';                
                                        $count++;
                                    }
                                } else {
                                    echo '
                                    <tr class="windowbg">
                                        <td colspan="3" align="center" valign="middle">'.$txt['smfg_no_dynorun_videos'].'</td>
                                    </tr>';
                                }
                                echo '
                                </table> 
                            </td>
                        </tr>
                    </table>  
                    </td>
                </tr>
            </table>
            <script language="JavaScript" type="text/javascript">
             var frmvalidator = new Validator("update_video");
              
             frmvalidator.addValidation("video_desc","maxlen=150","'.$txt['smfg_val_video_description_length'].'");
             frmvalidator.addValidation("video_title","req","'.$txt['smfg_val_enter_title'].'");
             
            </script>
            </div>';
        }
        echo'

<script type="text/javascript">
<!--
    var lowest_tab = \'000\';
    var active_id = \'000\';
    if (document.location.hash == "")
    {
        change_tab(lowest_tab);
    }
    else if (document.location.hash == "#vehicle")
    {
        change_tab(\'000\');
    }
    else if (document.location.hash == "#images")
    {
        change_tab(\'001\');
    }
    else if (document.location.hash == "#video")
    {
        change_tab(\'002\');
    }

//-->

</script>
    
    </td>
</tr>

<tr>
    <td class="titlebg" align="center" height="28">&nbsp;</td>
</tr>
</table>';
    
    echo smfg_footer();

}

function template_view_dynorun()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings, $boardurl;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
    <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_view_dynorun'].'</td>
        </tr>

        <tr>
<td class="windowbg">
    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
    <tr>
        <td class="windowbg" align="center" valign="top">';       
            
            // Pending?
            if($context['dynoruns']['pending'] == '1') {
                echo '
            <table class="tborder" width="90%">
                <tr class="windowbg">
                    <td>
                    <table border="0">
                        <tr>
                            <td align="center" valign="middle" width="40"><img src="'. $settings['default_images_url'] . '/garage_delete.gif" alt="" title="" /></td>
                            <td align="center" valign="middle">'.$txt['smfg_pending_item'].'</td>
                        </tr>
                    </table>
                    </td>
                </tr>
            </table><br />';
            }
            
            echo '
            
            <table border="0" width="70%">
                <tr>
                    <td align="left"><b>'.$txt['smfg_owner'].'</b></td>
                </tr>
                <tr>
                    <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['user_vehicles']['user_id'].'"><b>'.$context['dynoruns']['owner'].'</b></a></td>
                </tr>
                <tr>
                    <td align="left"><b>'.$txt['smfg_hilite_image'].'</b></td>
                </tr>
                <tr>
                    <td align="center">', (!empty($context['hilite_image_location'])) ? '<a href="'.$context['hilite_image_location'].'" rel="shadowbox" title="'.$context['dynoruns']['bhp'].' '.$context['dynoruns']['bhp_unit'].' :: '.garage_title_clean($context['hilite_desc']).'" class="smfg_imageTitle"><img src="'.$context['hilite_thumb_location'].'" width="'.$context['hilite_thumb_width'].'" height="'.$context['hilite_thumb_height'].'" /></a>' : '' ,'</td>
                </tr>
            </table>
        </td>
        <td width="30%" class="windowbg" valign="middle" align="center">
            <table border="0" cellspacing="1" cellpadding="3">
            <tr>
                <td align="left"><b>'.$txt['smfg_vehicle'].'</b></td>
                <td align="left"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$_GET['VID'].'">'.garage_title_clean($context['user_vehicles']['title']).'</a><td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_dynocenter'].'</b></td>
                <td align="left"><a href="'.$scripturl.'?action=garage;sa=dc_review;BID='.$context['dynoruns']['dynocenter_id'].'">'.garage_title_clean($context['dynoruns']['dynocenter']).'</a><td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_bhp'].'</b></td>
                <td align="left">'.$context['dynoruns']['bhp'].' '.$context['dynoruns']['bhp_unit'].'<td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_torque'].'</b></td>
                <td align="left">'.$context['dynoruns']['torque'].' '.$context['dynoruns']['torque_unit'].'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_boost'].'</b></td>
                <td align="left">'.$context['dynoruns']['boost'].' '.$context['dynoruns']['boost_unit'].'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_nitrous'].'</b></td>
                <td align="left">'.$context['dynoruns']['nitrous'].' '.$txt['smfg_shot'].'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_peakpoint'].'</b></td>
                <td align="left">'.$context['dynoruns']['peakpoint'].' '.$txt['smfg_rpm'].'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_date_created'].'</b></td>
                <td align="left">'.date($context['date_format'],$context['dynoruns']['date_created']).'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_date_updated'].'</b></td>
                <td align="left">'.date($context['date_format'],$context['dynoruns']['date_updated']).'</td>
            </tr>
            </table>
        </td>
    </tr>
    </table>';
    
    if($smfgSettings['enable_dynorun_images'] || $smfgSettings['enable_dynorun_video']) {
    
    echo '
    <br />
    <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;" id="tab_table">
            <tr id="tab_row">
                <td class="mirrortab_first" id="tab_first">&nbsp;</td>

                <td class="mirrortab_active_first" id="tab_active_left">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back" id="tab000">
                    <a href="#images" onclick="change_tab(\'000\');">'.$txt['smfg_images'].'</a>
                </td>
                <td class="mirrortab_active_last" id="tab_active_right">&nbsp;</td>';
                $count = 0;
                if(isset($context['dynoruns'][$count]['video_id']) && $smfgSettings['enable_dynorun_video']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab001">
                    <a href="#videos" onclick="change_tab(\'001\');">'.$txt['smfg_videos'].'</a>
                </td>';
                }
                echo '
                <td class="mirrortab_last">&nbsp;</td>

            </tr>
    </table>';
        
        // Begin dynamic js divs
        echo '        
        <div class="garage_panel" id="options000" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_images'].'</td>
            </tr>';
            $count = 0;
            if(isset($context['dynoruns'][$count]['image_id'])) {
            echo '
            <tr>
                <td class="windowbg" valign="middle">';
                while(isset($context['dynoruns'][$count]['image_id'])) {
                    echo '
                <a href="'.$context['dynoruns'][$count]['attach_location'].'" rel="shadowbox[dynoruns]" title="'.garage_title_clean($context['dynoruns']['bhp'].' '.$context['dynoruns']['bhp_unit'].' :: '.$context['dynoruns'][$count]['attach_desc']).'" class="smfg_imageTitle"><img src="'.$context['dynoruns'][$count]['attach_thumb_location'].'" width="'.$context['dynoruns'][$count]['attach_thumb_width'].'" height="'.$context['dynoruns'][$count]['attach_thumb_height'].'" /></a>';
                $count++;
                }
                echo '
                </td>
            </tr>';
            }  else {
            echo '
            <tr>
                <td class="windowbg" align="center">'.$txt['smfg_no_dynorun_images'].'</td>
            </tr>';
            }
        echo '
        </table>     
        </div>
        <div class="garage_panel" id="options001" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_videos'].'</td>
            </tr>';
            $count = 0;
            if(isset($context['dynoruns'][$count]['video_id'])) {
            echo '
            <tr>
                <td class="windowbg" valign="middle">';
                while(isset($context['dynoruns'][$count]['video_id'])) {
                    echo '
                <a href="'.$scripturl.'?action=garage;sa=video;id='.$context['dynoruns'][$count]['video_id'].'" rel="shadowbox[video];width='.$context['dynoruns'][$count]['video_width'].';height='.$context['dynoruns'][$count]['video_height'].';" title="'.garage_title_clean('<b>'.$context['dynoruns'][$count]['video_title'].'</b> :: '.$context['dynoruns'][$count]['video_desc']).'" class="smfg_videoTitle"><img src="'.$context['dynoruns'][$count]['video_thumb'].'" /></a>';
                $count++;
                }
                echo '
                </td>
            </tr>';
            }  else {
            echo '
            <tr>
                <td class="windowbg" align="center">'.$txt['smfg_no_dynorun_videos'].'</td>
            </tr>';
            }
        echo '  
        </table>     
        </div>

        <script type="text/javascript">
        <!--
            var lowest_tab = \'000\';
            var active_id = \'000\';
            if (document.location.hash == "")
            {
                change_tab(lowest_tab);
            }
            else if (document.location.hash == "#images")
            {
                change_tab(\'000\');
            }
            else if (document.location.hash == "#videos")
            {
                change_tab(\'001\');
            }

        //-->

        </script>
        </td>
        </tr>

        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28"></td>
        </tr>
        </table>';

    }
    
    echo smfg_footer();

}

function template_add_laptime()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
    <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_add_laptime'] . '</td>
        </tr>';
        
        // Submitted track?
        if($_SESSION['added_track']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_track_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a dyno is added
            unset($_SESSION['added_track']);
        }  
        
        echo '
        <tr>
            <td class="windowbg">
            <form action="'.$scripturl.'?action=garage;sa=insert_laptime" enctype="multipart/form-data" method="post" name="add_lap" id="add_lap" style="padding:0; margin:0;">
                <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$_GET['VID'].'#laps" />
                <table width="100%" cellpadding="3" cellspacing="1" border="0" class="bordercolor">
                    <tr>
                        <td class="windowbg2" align="right" width="30%"><b>'.$txt['smfg_track'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg">
                        <select id="track_id" name="track_id" >
                        <option value="">'.$txt['smfg_select_track'].'</option>
                        <option value="">------</option>';
                        echo track_select();
                        echo '
                        </select>';
                        if($smfgSettings['enable_user_add_track']) {                     
                            echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_track" rel="shadowbox;width=620;height=200" title="Garage :: Submit Track">'.$txt['smfg_here'].'</a>';
                        }
                        echo '
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="30%"><b>'.$txt['smfg_track'].' '.$txt['smfg_condition'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg">
                        <select id="condition" name="condition" >
                        <option value="">'.$txt['smfg_select_condition'].'</option>
                        <option value="">------</option>';
                        echo track_condition_select();
                        echo '
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="30%"><b>'.$txt['smfg_lap_type'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg">
                        <select id="type" name="type" >
                        <option value="">'.$txt['smfg_select_type'].'</option>
                        <option value="">------</option>';
                        echo lap_type_select();
                        echo '
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="35%"><b>'.$txt['smfg_laptime'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg"><b>M</b><input name="minute" type="text" size="2" maxlength="2" value="" />&nbsp;<b>S</b><input name="second" type="text" size="2" maxlength="2" value="" />&nbsp;<b>MS</b><input name="millisecond" type="text" size="2" maxlength="3" value="" /></td>
                    </tr>';
                    
                    // Show the input for images if it is enabled
                    if($smfgSettings['enable_lap_images']) {
                    echo '
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" colspan="2" align="center">'.$txt['smfg_image_attachments'].'</td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_attach_image'].'.<br />'.$txt['smfg_max_filesize'].': '.$smfgSettings['max_image_kbytes'].' '.$txt['smfg_kbytes'].'<br />'.$txt['smfg_max_resolution'].': '.$smfgSettings['max_image_resolution'].'x'.$smfgSettings['max_image_resolution'].'</b></td>
                        <td class="windowbg"><input type="hidden" name="MAX_FILE_SIZE" value="'.$context['max_image_bytes'].'" /><input type="file" size="30" name="FILE_UPLOAD"/></td>
                    </tr>';
    
                    // Show the input for remote images if it is enabled
                    if($smfgSettings['enable_remote_images']) {
                    echo '    
                    <tr>
                        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_enter_remote_url'].'</b></td>
                        <td class="windowbg"><input name="url_image" type="text" size="40" maxlength="255" value="http://" /></td>
                    </tr>';
                    }
                    echo '    
                    <tr>
                        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                        <td class="windowbg"><textarea name="attach_desc" cols="60" rows="3"></textarea></td>
                    </tr>';
                    }
                    // Show the input for videos if it is enabled
                    if($smfgSettings['enable_laptime_video']) {
                    echo '
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="2">'.$txt['smfg_hosted_videos'].'</td>
                    </tr>
                    
                    <tr>
                        <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_title'].'</b></td>
                        <td class="windowbg"><input type="text"  size="40" maxlength="75" value="" name="video_title"/></td>
                    </tr>
                    <tr>
                        <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_url'].'</b></td>
                        <td class="windowbg"><input type="text"  size="40" maxlength="255" value="http://" name="video_url"/>&nbsp;<span class="smalltext"><a href="'.$scripturl.'?action=garage;sa=supported_video" rel="shadowbox;width=260;height=400" title="'.$txt['smfg_video_instructions'].'">Supported Sites</a></span></td>
                    </tr>';
                    
                    echo '    
                    <tr>
                        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                        <td class="windowbg"><textarea name="video_desc" cols="60" rows="3"></textarea></td>
                    </tr>';
                    
                    }                    
                    echo '
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="2"><input type="hidden" value="'.$_GET['VID'].'" name="VID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="add_laptime" type="submit" value="'.$txt['smfg_add_laptime'].'" /></td>
                    </tr>
                </table>
            </form>
                <script language="JavaScript" type="text/javascript">
                var frmvalidator = new Validator("add_lap");
                var frm = document.forms["add_lap"];
                
                frmvalidator.addValidation("track_id","req","'.$txt['smfg_val_select_track'].'");
                frmvalidator.addValidation("condition","req","'.$txt['smfg_val_select_track_condition'].'");
                frmvalidator.addValidation("type","req","'.$txt['smfg_val_select_lap_type'].'");
                
                frmvalidator.addValidation("minute","req","'.$txt['smfg_val_enter_minute'].'");
                frmvalidator.addValidation("minute","num","'.$txt['smfg_val_time_restrictions'].'");
                frmvalidator.addValidation("minute","minlen=1","'.$txt['smfg_val_minute_restriction1'].'");
                frmvalidator.addValidation("minute","maxlen=2","'.$txt['smfg_val_minute_restriction2'].'");
                
                frmvalidator.addValidation("second","req","'.$txt['smfg_val_enter_second'].'");
                frmvalidator.addValidation("second","num","'.$txt['smfg_val_time_restrictions'].'");
                frmvalidator.addValidation("second","maxlen=2","'.$txt['smfg_val_second_restriction'].'");
                frmvalidator.addValidation("second","minlen=2","'.$txt['smfg_val_second_restriction'].'");
                
                frmvalidator.addValidation("millisecond","req","'.$txt['smfg_val_enter_millisecond'].'");
                frmvalidator.addValidation("millisecond","num","'.$txt['smfg_val_time_restrictions'].'");
                frmvalidator.addValidation("millisecond","maxlen=2","'.$txt['smfg_val_millisecond_restriction'].'");
                frmvalidator.addValidation("millisecond","minlen=2","'.$txt['smfg_val_millisecond_restriction'].'");';
                 if($smfgSettings['enable_vehicle_images']) {
                     echo '
                        frmvalidator.addValidation("attach_desc","maxlen=150","'.$txt['smfg_val_image_description_length'].'");';
                 }
                 if($smfgSettings['enable_vehicle_video']) {
                     echo '
                        frmvalidator.addValidation("video_desc","maxlen=150","'.$txt['smfg_val_video_description_length'].'");';
                 }
                 echo '
                </script>
            </td>
        </tr>

        <tr>
            <td class="titlebg" align="center" height="28"></td>
        </tr>
    </table>';
    
    echo smfg_footer();

}

function template_edit_laptime()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
<tr>
    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_edit_laptime'] . '</td>
</tr>

<tr>
    <td class="windowbg">
    
    <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;" id="tab_table">
            <tr id="tab_row">
                <td class="mirrortab_first" id="tab_first">&nbsp;</td>

                <td class="mirrortab_active_first" id="tab_active_left">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back" id="tab000">
                    <a href="#vehicle" onclick="change_tab(\'000\');">'.$txt['smfg_laptime'].'</a>
                </td>
                <td class="mirrortab_active_last" id="tab_active_right">&nbsp;</td>';
                // Show the input for images if it is enabled
                if($smfgSettings['enable_lap_images']) {
                    echo '
                    <td valign="top" class="mirrortab_back" id="tab001">
                        <a href="#images" onclick="change_tab(\'001\');">'.$txt['smfg_images'].'</a>
                    </td>';
                }
                // Show the input for video if it is enabled
                if($smfgSettings['enable_laptime_video']) {
                    echo '
                    <td valign="top" class="mirrortab_back" id="tab002">
                        <a href="#images" onclick="change_tab(\'002\');">'.$txt['smfg_video'].'</a>
                    </td>';
                }
                echo '
                <td class="mirrortab_last">&nbsp;</td>

            </tr>
    </table>
    ';
        
        // Begin dynamic js divs
        echo '                     
        <div class="garage_panel" id="options000" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_laptime'].'</td>
            </tr>';
        
            // Submitted track?
            if($_SESSION['added_track']) {
                echo '
                <tr>
                    <td class="windowbg" align="center" valign="middle">'.$txt['smfg_track_added'].'</td>
                </tr>';
                // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a dyno is added
                unset($_SESSION['added_track']);
            }  
            
            echo '
            <tr>
                <td class="windowbg">
                <form action="'.$scripturl.'?action=garage;sa=update_laptime" enctype="multipart/form-data" method="post" name="edit_lap" id="edit_lap" style="padding:0; margin:0;">
                <input type="hidden" name="redirecturl" value="' . $scripturl . '?action=garage;sa=view_vehicle;VID='.$_GET['VID'].';#laps" />
                <table width="100%" cellpadding="3" cellspacing="1" border="0" class="bordercolor">
                    <tr>
                        <td class="windowbg2" align="right" width="30%"><b>'.$txt['smfg_track'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg">
                        <select id="track_id" name="track_id" >
                        <option value="">'.$txt['smfg_select_track'].'</option>
                        <option value="">------</option>';
                        echo track_select($context['laps']['track_id']);
                        echo '
                        </select>';
                        if($smfgSettings['enable_user_add_track']) {                     
                            echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_track" rel="shadowbox;width=620;height=200" title="Garage :: Submit Track">'.$txt['smfg_here'].'</a>';
                        }
                        echo '
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="30%"><b>'.$txt['smfg_track'].' '.$txt['smfg_condition'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg">
                        <select id="condition" name="condition" >
                        <option value="">'.$txt['smfg_select_condition'].'</option>
                        <option value="">------</option>';
                        echo track_condition_select($context['laps']['condition_id']);
                        echo '
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="30%"><b>'.$txt['smfg_lap_type'] .'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg">
                        <select id="type" name="type" >
                        <option value="">'.$txt['smfg_select_type'].'</option>
                        <option value="">------</option>';
                        echo lap_type_select($context['laps']['type_id']);
                        echo '
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="35%"><b>'.$txt['smfg_laptime'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg"><b>M</b><input name="minute" type="text" size="2" maxlength="2" value="'.$context['laps']['minute'].'" />&nbsp;<b>S</b><input name="second" type="text" size="2" maxlength="2" value="'.$context['laps']['second'].'" />&nbsp;<b>MS</b><input name="millisecond" type="text" size="2" maxlength="3" value="'.$context['laps']['millisecond'].'" /></td>
                    </tr>
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="2"><input type="hidden" value="'.$_GET['VID'].'" name="VID" /><input type="hidden" value="'.$_GET['LID'].'" name="LID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input type="hidden" name="redirecturl" value="' . $_SESSION['old_url'] . '" /><input name="add_laptime" type="submit" value="'.$txt['smfg_update_laptime'].'" /></td>
                    </tr>
                </table>
            </form>
                <script language="JavaScript" type="text/javascript">
                var frmvalidator = new Validator("edit_lap");
                var frm = document.forms["edit_lap"];
                
                frmvalidator.addValidation("track_id","req","'.$txt['smfg_val_select_track'].'");
                frmvalidator.addValidation("condition","req","'.$txt['smfg_val_select_track_condition'].'");
                frmvalidator.addValidation("type","req","'.$txt['smfg_val_select_lap_type'].'");
                
                frmvalidator.addValidation("minute","req","'.$txt['smfg_val_enter_minute'].'");
                frmvalidator.addValidation("minute","num","'.$txt['smfg_val_time_restrictions'].'");
                frmvalidator.addValidation("minute","minlen=1","'.$txt['smfg_val_minute_restriction1'].'");
                frmvalidator.addValidation("minute","maxlen=2","'.$txt['smfg_val_minute_restriction2'].'");
                
                frmvalidator.addValidation("second","req","'.$txt['smfg_val_enter_second'].'");
                frmvalidator.addValidation("second","num","'.$txt['smfg_val_time_restrictions'].'");
                frmvalidator.addValidation("second","maxlen=2","'.$txt['smfg_val_second_restriction'].'");
                frmvalidator.addValidation("second","minlen=2","'.$txt['smfg_val_second_restriction'].'");
                
                frmvalidator.addValidation("millisecond","req","'.$txt['smfg_val_enter_millisecond'].'");
                frmvalidator.addValidation("millisecond","num","'.$txt['smfg_val_time_restrictions'].'");
                frmvalidator.addValidation("millisecond","maxlen=2","'.$txt['smfg_val_millisecond_restriction'].'");
                frmvalidator.addValidation("millisecond","minlen=2","'.$txt['smfg_val_millisecond_restriction'].'");
                </script>';    
                echo '
                </td>
            </tr>    
        </table>
        </div>';
        // Show the input for images if it is enabled
        if($smfgSettings['enable_lap_images']) {
        echo '
        <div class="garage_panel" id="options001" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_images'].'</td>
            </tr>
            <tr>
                <td class="windowbg">
                
                <form action="' . $scripturl . '?action=garage;sa=insert_laptime_images" id="update_images" enctype="multipart/form-data" method="post" name="update_images" style="padding:0; margin:0;">
                <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_laptime;VID='.$_GET['VID'].';LID='.$_GET['LID'].'#images" />
                <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">           
                    <tr>
                        <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_attach_image'].'.<br />'.$txt['smfg_max_filesize'].': '.$smfgSettings['max_image_kbytes'].' '.$txt['smfg_kbytes'].'<br />'.$txt['smfg_max_resolution'].': '.$smfgSettings['max_image_resolution'].'x'.$smfgSettings['max_image_resolution'].'</b></td>
                        <td class="windowbg"><input type="hidden" name="MAX_FILE_SIZE" value="'.$context['max_image_bytes'].'" /><input type="file" size="30" name="FILE_UPLOAD"/></td>
                    </tr>';
    
                    // Show the input for remote images if it is enabled
                    if($smfgSettings['enable_remote_images']) {
                    echo '    
                    <tr>
                        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_enter_remote_url'].'</b></td>
                        <td class="windowbg"><input name="url_image" type="text" size="40" maxlength="255" value="http://" /></td>
                    </tr>';
                    }
                    
                    echo '    
                    <tr>
                        <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                        <td class="windowbg"><textarea name="attach_desc" cols="60" rows="3"></textarea></td>
                    </tr>    
                    <tr>
                        <td colspan="2" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28"><input type="hidden" value="' . $_GET['VID'] . '" name="VID" /><input type="hidden" value="' . $_GET['LID'] . '" name="LID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="insert_laptime_images" type="submit" value="'.$txt['smfg_add_new_image'].'" /></td>
                    </tr>
                </table>
                </form>
                <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
                    <tr>
                        <td class="windowbg" colspan="2">
                        <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
                            <tr>
                                <td class="windowbg" width="100%" align="center" colspan="3">'.$txt['smfg_edit_in_place_instructions'].'.<div id="updateStatus"></div></td>
                            </tr>
                            <tr>
                                <td class="catbg" width="33%" align="center">'.$txt['smfg_image'].'</td>
                                <td class="catbg" width="33%" align="center">'.$txt['smfg_description'].'</td>
                                <td class="catbg" width="33%" align="center">'.$txt['smfg_manage'].'</td>
                            </tr>';
                            $count = 0;                            
                            // If there is an image, show em
                            if (isset($context['laps'][$count]['image_id'])) {
                                // and keep showing em
                                while(isset($context['laps'][$count]['image_id'])) {
                                    echo '                            
                                    <tr class="windowbg">
                                        <td align="center" valign="middle">'.$context['laps'][$count]['image'].'</td>
                                        <td align="center" valign="middle">
                                            <div id="image'.$context['laps'][$count]['image_id'].'" class="editin">';
                                            // If there is no desc, let them add one
                                            if (!empty($context['laps'][$count]['attach_desc'])) {
                                                echo $context['laps'][$count]['attach_desc'];
                                            } 
                                                echo'</div></td>
                                        <td align="center" valign="middle">';
                                        if ($context['laps'][$count]['hilite'] != 1) {
                                            echo '
                                            <form action="'.$scripturl.'?action=garage;sa=set_hilite_image_laptime;VID='.$_GET['VID'].';LID='.$_GET['LID'].';image_id='.$context['laps'][$count]['image_id'].';sesc=' . $context['session_id'] . '" method="post" name="set_laptime_hilite_'.$context['laps'][$count]['image_id'].'" id="set_laptime_hilite_'.$context['laps'][$count]['image_id'].'" style="display: inline;">
                                                <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_laptime;VID='.$_GET['VID'].';LID='.$_GET['LID'].'#images" />
                                                <a href="#" onClick="document.set_laptime_hilite_'.$context['laps'][$count]['image_id'].'.submit(); return false;">'.$txt['smfg_set_hilite_image'].'</a>
                                            </form>
                                            <br /><br />';
                                        } else {
                                            echo 
                                            $txt['smfg_hilite_image'].'<br /><br />';
                                        }                                
                                        echo '
                                        <form action="'.$scripturl.'?action=garage;sa=remove_laptime_image;VID='.$_GET['VID'].';LID='.$_GET['LID'].';image_id='.$context['laps'][$count]['image_id'].';sesc=' . $context['session_id'] . '" method="post" name="remove_laptime_image_'.$context['laps'][$count]['image_id'].'" id="remove_laptime_image_'.$context['laps'][$count]['image_id'].'" style="display: inline;">
                                        <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_laptime;VID='.$_GET['VID'].';LID='.$_GET['LID'].'#images" />
                                        <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_image'].'\')) { document.remove_laptime_image_'.$context['laps'][$count]['image_id'].'.submit(); } else { return false; } return false;">'.$txt['smfg_remove_image'].'</a>
                                        </form>
                                        </td>
                                    </tr>';                            
                                    $count++;                            
                                    }
                            } else {
                                echo '
                            <tr class="windowbg">
                                <td colspan="3" align="center" valign="middle">'.$txt['smfg_no_lap_images'].'</td>
                            </tr>';                  
                            }
                            echo '
                            </table> 
                        </td>
                    </tr>
                </table>  
                <script language="JavaScript" type="text/javascript">
                 var frmvalidator = new Validator("update_images");
                
                    frmvalidator.addValidation("attach_desc","maxlen=150","'.$txt['smfg_val_image_description_length'].'");
                 
                </script>           
                </td>
            </tr>
        </table>
        </div>';
        }
        // Show the input for videos if it is enabled
        if($smfgSettings['enable_laptime_video']) {
            echo '
            <div class="garage_panel" id="options002" style="display: none;">
            <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_video'].'</td>
                </tr>
                <tr>
                    <td class="windowbg">
                                        
                    <form action="' . $scripturl . '?action=garage;sa=insert_laptime_video" id="update_video" enctype="multipart/form-data" method="post" name="update_video" style="padding:0; margin:0;">         
                    <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_laptime;VID='.$_GET['VID'].';LID='.$_GET['LID'].'#video" />
                    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">  
                        <tr>
                            <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_title'].'</b></td>
                            <td class="windowbg"><input type="text"  size="40" maxlength="75" value="" name="video_title"/></td>
                        </tr>
                        <tr>
                            <td class="windowbg2" width="32%" align="right" nowrap="nowrap"><b>'.$txt['smfg_video_url'].'</b></td>
                            <td class="windowbg"><input type="text"  size="40" maxlength="255" value="http://" name="video_url"/>&nbsp;<span class="smalltext"><a href="'.$scripturl.'?action=garage;sa=supported_video" rel="shadowbox;width=260;height=400" title="'.$txt['smfg_video_instructions'].'">Supported Sites</a></span></td>
                        </tr>';
                        
                        echo '    
                        <tr>
                            <td class="windowbg2" width="32%" align="right"><b>'.$txt['smfg_description'].'</b></td>
                            <td class="windowbg"><textarea name="video_desc" cols="60" rows="3"></textarea></td>
                        </tr>   
                        <tr>
                            <td colspan="2" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28"><input type="hidden" value="' . $_GET['VID'] . '" name="VID" /><input type="hidden" value="' . $_GET['LID'] . '" name="LID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="insert_laptime_video" type="submit" value="'.$txt['smfg_add_new_video'].'" /></td>
                        </tr>
                    </table>
                    </form>
                    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">  
                        <tr>
                            <td class="windowbg" colspan="2">
                            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
                                <tr>
                                    <td class="windowbg" width="100%" align="center" colspan="3">'.$txt['smfg_edit_in_place_instructions'].'<div id="updateStatus2"></div></td>
                                </tr>
                                <tr>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_video'].'</td>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_title_description'].'</td>
                                    <td class="catbg" width="33%" align="center">'.$txt['smfg_manage'].'</td>
                                </tr>';
                                
                                $count = 0;                            
                                // If there is an video, show em
                                if (isset($context['laps'][$count]['video_id'])) {
                                    // and keep showing em
                                    while(isset($context['laps'][$count]['video_id'])) {
                                        echo '                            
                                        <tr class="windowbg">
                                            <td align="center" valign="middle"><a href="'.$scripturl.'?action=garage;sa=video;id='.$context['laps'][$count]['video_id'].'" rel="shadowbox;width='.$context['laps'][$count]['video_width'].';height='.$context['laps'][$count]['video_height'].'" title="'.garage_title_clean('<b>'.$context['laps'][$count]['video_title'].'</b> :: '.$context['laps'][$count]['video_desc']).'" class="smfg_videoTitle"><img src="'.$context['laps'][$count]['video_thumb'].'" /></a></td>
                                            <td align="center" valign="middle">
                                            <div id="video_title'.$context['laps'][$count]['video_id'].'" class="editin" style="font-weight: bold;">';
                                            // If there is no title, let them add one
                                            if (!empty($context['laps'][$count]['video_title'])) {
                                                echo $context['laps'][$count]['video_title'];
                                            }
                                            echo '
                                            </div>
                                            <br />
                                            <div id="video'.$context['laps'][$count]['video_id'].'" class="editin">';
                                            // If there is no desc, let them add one
                                            if (!empty($context['laps'][$count]['video_desc'])) {
                                                echo $context['laps'][$count]['video_desc'];
                                            } 
                                                echo'</div></td>
                                            <td align="center" valign="middle">';                               
                                            echo '
                                            <form action="'.$scripturl.'?action=garage;sa=remove_video;VID='.$_GET['VID'].';video_id='.$context['laps'][$count]['video_id'].';sesc=' . $context['session_id'] . '" method="post" name="remove_laptime_video_'.$context['laps'][$count]['video_id'].'" id="remove_laptime_video_'.$context['laps'][$count]['video_id'].'" style="display: inline;">
                                            <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=edit_laptime;VID='.$_GET['VID'].';LID='.$_GET['LID'].'#video" />
                                            <a href="#" onClick="if (confirm(\''.$txt['smfg_delete_video'].'\')) { document.remove_laptime_video_'.$context['laps'][$count]['video_id'].'.submit(); } else { return false; } return false;">'.$txt['smfg_remove_video'].'</a>
                                            </form>
                                            </td>
                                        </tr>';                
                                        $count++;
                                    }
                                } else {
                                    echo '
                                    <tr class="windowbg">
                                        <td colspan="3" align="center" valign="middle">'.$txt['smfg_no_lap_videos'].'</td>
                                    </tr>';
                                }
                                echo '
                                </table> 
                            </td>
                        </tr>
                    </table>  
                    </td>
                </tr>
            </table>
            <script language="JavaScript" type="text/javascript">
             var frmvalidator = new Validator("update_video");
              
             frmvalidator.addValidation("video_desc","maxlen=150","'.$txt['smfg_val_video_description_length'].'");
             frmvalidator.addValidation("video_title","req","'.$txt['smfg_val_enter_title'].'");
             
            </script>
            </div>';
        }
        echo '

<script type="text/javascript">
<!--
    var lowest_tab = \'000\';
    var active_id = \'000\';
    if (document.location.hash == "")
    {
        change_tab(lowest_tab);
    }
    else if (document.location.hash == "#vehicle")
    {
        change_tab(\'000\');
    }
    else if (document.location.hash == "#images")
    {
        change_tab(\'001\');
    }
    else if (document.location.hash == "#video")
    {
        change_tab(\'002\');
    }

//-->

</script>
    
    </td>
</tr>

<tr>
    <td class="titlebg" align="center" height="28">&nbsp;</td>
</tr>
</table>';
    
    echo smfg_footer();

}

function template_view_laptime()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings, $boardurl;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
    <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_view_laptime'].'</td>
        </tr>

        <tr>
<td class="windowbg">
    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
    <tr>
        <td class="windowbg" align="center" valign="top">';       
            
            // Pending?
            if($context['laps']['pending'] == '1') {
                echo '
            <table class="tborder" width="90%">
                <tr class="windowbg">
                    <td>
                    <table border="0">
                        <tr>
                            <td align="center" valign="middle" width="40"><img src="'. $settings['default_images_url'] . '/garage_delete.gif" alt="" title="" /></td>
                            <td align="center" valign="middle">'.$txt['smfg_pending_item'].'</td>
                        </tr>
                    </table>
                    </td>
                </tr>
            </table><br />';
            }
            
            echo '
            
            <table border="0" width="70%">
                <tr>
                    <td align="left"><b>'.$txt['smfg_owner'].'</b></td>
                </tr>
                <tr>
                    <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['user_vehicles']['user_id'].'"><b>'.$context['laps']['owner'].'</b></a></td>
                </tr>
                <tr>
                    <td align="left"><b>'.$txt['smfg_hilite_image'].'</b></td>
                </tr>
                <tr>
                    <td align="center">', (!empty($context['hilite_image_location'])) ? '<a href="'.$context['hilite_image_location'].'" rel="shadowbox" title="'.$context['laps']['time'].' @ '.$context['laps']['track'].' :: '.garage_title_clean($context['hilite_desc']).'" class="smfg_imageTitle"><img src="'.$context['hilite_thumb_location'].'" width="'.$context['hilite_thumb_width'].'" height="'.$context['hilite_thumb_height'].'" /></a>' : '' ,'</td>
                </tr>
            </table>
        </td>
        <td width="30%" class="windowbg" valign="middle" align="center">
            <table border="0" cellspacing="1" cellpadding="3">
            <tr>
                <td align="left"><b>'.$txt['smfg_vehicle'].'</b></td>
                <td align="left"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$_GET['VID'].'">'.garage_title_clean($context['user_vehicles']['title']).'</a><td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_track'].'</b></td>
                <td align="left"><a href="'.$scripturl.'?action=garage;sa=view_track;TID='.$context['laps']['track_id'].'">'.garage_title_clean($context['laps']['track']).'</a><td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_track'].' '.$txt['smfg_condition'].'</b></td>
                <td align="left">'.$context['laps']['condition'].'<td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_lap_type'].'</b></td>
                <td align="left">'.$context['laps']['type'].'</td>
            </tr>
            <tr>
                <td align="left"><b>'.$txt['smfg_laptime_specs'].'</b></td>
                <td align="left">'.$context['laps']['time'].'</td>
            </tr>
            </table>
        </td>
    </tr>
    </table>';
    
    if($smfgSettings['enable_lap_images'] || $smfgSettings['enable_laptime_video']) {
    
    echo '
    <br />
    <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;" id="tab_table">
            <tr id="tab_row">
                <td class="mirrortab_first" id="tab_first">&nbsp;</td>

                <td class="mirrortab_active_first" id="tab_active_left">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back" id="tab000">
                    <a href="#images" onclick="change_tab(\'000\');">'.$txt['smfg_images'].'</a>
                </td>
                <td class="mirrortab_active_last" id="tab_active_right">&nbsp;</td>';
                $count = 0;
                if(isset($context['laps'][$count]['video_id']) && $smfgSettings['enable_laptime_video']) {
                echo '
                <td valign="top" class="mirrortab_back" id="tab001">
                    <a href="#videos" onclick="change_tab(\'001\');">'.$txt['smfg_videos'].'</a>
                </td>';
                }
                echo '
                <td class="mirrortab_last">&nbsp;</td>

            </tr>
    </table>';
        
        // Begin dynamic js divs
        echo '        
        <div class="garage_panel" id="options000" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_images'].'</td>
            </tr>';
            $count = 0;
            if(isset($context['laps'][$count]['image_id'])) {
            echo '
            <tr>
                <td class="windowbg" valign="middle">';
                while(isset($context['laps'][$count]['image_id'])) {
                    echo '
                <a href="'.$context['laps'][$count]['attach_location'].'" rel="shadowbox[laps]" title="'.garage_title_clean($context['laps']['time'].' @ '.$context['laps']['track'].' :: '.$context['laps'][$count]['attach_desc']).'" class="smfg_imageTitle"><img src="'.$context['laps'][$count]['attach_thumb_location'].'" width="'.$context['laps'][$count]['attach_thumb_width'].'" height="'.$context['laps'][$count]['attach_thumb_height'].'" /></a>';
                $count++;
                }
                echo '
                </td>
            </tr>';
            }  else {
            echo '
            <tr>
                <td class="windowbg" align="center">'.$txt['smfg_no_lap_images'].'</td>
            </tr>';
            }
        echo '
        </table>     
        </div>
        <div class="garage_panel" id="options001" style="display: none;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_videos'].'</td>
            </tr>';
            $count = 0;
            if(isset($context['laps'][$count]['video_id'])) {
            echo '
            <tr>
                <td class="windowbg" valign="middle">';
                while(isset($context['laps'][$count]['video_id'])) {
                    echo '
                <a href="'.$scripturl.'?action=garage;sa=video;id='.$context['laps'][$count]['video_id'].'" rel="shadowbox[video];width='.$context['laps'][$count]['video_width'].';height='.$context['laps'][$count]['video_height'].';" title="'.garage_title_clean('<b>'.$context['laps'][$count]['video_title'].'</b> :: '.$context['laps'][$count]['video_desc']).'" class="smfg_videoTitle"><img src="'.$context['laps'][$count]['video_thumb'].'" /></a>';
                $count++;
                }
                echo '
                </td>
            </tr>';
            }  else {
            echo '
            <tr>
                <td class="windowbg" align="center">'.$txt['smfg_no_lap_videos'].'</td>
            </tr>';
            }
        echo '  
        </table>     
        </div>

        <script type="text/javascript">
        <!--
            var lowest_tab = \'000\';
            var active_id = \'000\';
            if (document.location.hash == "")
            {
                change_tab(lowest_tab);
            }
            else if (document.location.hash == "#images")
            {
                change_tab(\'000\');
            }
            else if (document.location.hash == "#videos")
            {
                change_tab(\'001\');
            }

        //-->

        </script>
        </td>
        </tr>

        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28"></td>
        </tr>
        </table>';

    }
    
    echo smfg_footer();

}

function template_view_track()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
    <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">'.$txt['smfg_view_track'].'</td>
        </tr>
        <tr>
        <td class="windowbg">
        <table width="100%" border="0" cellspacing="1" cellpadding="4" class="bordercolor"> 
        <tr>
            <td align="left" width="30%" class="windowbg2"><b>'.$txt['smfg_track'].'</b></td>
            <td align="left" width="100%" class="windowbg">'.$context['track']['title'].'</td>
        </tr>
        <tr>
            <td align="left" width="30%" class="windowbg2"><b>'.$txt['smfg_length'].'</b></td>
            <td align="left" width="100%" class="windowbg">'.$context['track']['length'].' '.$context['track']['mileage_unit'].'</td>
        </tr>
        </table>
        <br />
        <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">        
        <tr>
            <td colspan="6" class="titlebg" align="center" nowrap="nowrap">'.$txt['smfg_posted_laptimes'].'</td>
        </tr>';
        $count = 0;
        if(isset($context['laps'][$count]['id'])) {
            echo '
            <tr>
                <td class="catbg">&nbsp;</td>   
                <td class="catbg">'.$txt['smfg_owner'].'</td>   
                <td class="catbg">'.$txt['smfg_vehicle'].'</td>   
                <td class="catbg">'.$txt['smfg_condition'].'</td>   
                <td class="catbg">'.$txt['smfg_type'].'</td>   
                <td class="catbg">'.$txt['smfg_laptime_specs'].'</td>   
            </tr>';
            while(isset($context['laps'][$count]['id'])) {
                echo '
                <tr>         
                    <td class="windowbg" align="center" style="width: 25px;  white-space: nowrap;">'.$context['laps'][$count]['image'].$context['laps'][$count]['spacer'].$context['laps'][$count]['video'].'</td>
                    <td class="windowbg" align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['laps'][$count]['user_id'].'">'.$context['laps'][$count]['memberName'].'</a></td>
                    <td class="windowbg" align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['laps'][$count]['vehicle_id'].'">'.garage_title_clean($context['laps'][$count]['vehicle']).'</a></td>
                    <td class="windowbg" align="center">'.$context['laps'][$count]['condition'].'</td>
                    <td class="windowbg" align="center">'.$context['laps'][$count]['type'].'</td>
                    <td class="windowbg" align="center"><a href="'.$scripturl.'?action=garage;sa=view_laptime;VID='.$context['laps'][$count]['vehicle_id'].';LID='.$context['laps'][$count]['id'].'">'.garage_title_clean($context['laps'][$count]['time']).'</a></td>
                </tr>'; 
                $count++;        
            }
        } else {
            echo '
            <tr>         
                <td class="windowbg" align="center">'.$txt['smfg_no_laps_on_track'].'</td>
            </tr>'; 
        }
        echo '
        </table>
        </td>
    </tr>   
    <tr>
        <td class="titlebg" align="center" height="28"></td>
    </tr>
</table>';
    
    echo smfg_footer();

}

function template_add_service()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
    <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_add_service'] . '</td>
        </tr>';
        
        // Garage?
        if($_SESSION['added_garage']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_garage_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a mod is added
            unset($_SESSION['added_garage']);
        }
        
        echo'
        <tr>
            <td class="windowbg">
             <form action="'.$scripturl.'?action=garage;sa=insert_service;VID='.$_GET['VID'].'" enctype="multipart/form-data" method="post" name="add_service" id="add_service" style="padding:0; margin:0;">
                <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$_GET['VID'].'#services" />
                <table width="100%" cellpadding="3" cellspacing="1" border="0" class="bordercolor">
                    <tr>
                        <td class="windowbg2" align="right" width="30%"><b>'.$txt['smfg_serviced_by'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                          <td class="windowbg" colspan="2">
                          <select id="garage_id" name="garage_id">
                          <option value="">'.$txt['smfg_select_garage'].'</option>
                          <option value="">------</option>';
                          echo install_select();
                          echo '
                          </select>';
                            if($smfgSettings['enable_user_submit_business']) {
                                echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_business;bustype=garage" rel="shadowbox;width=620;height=560" title="Garage :: Submit Garage">'.$txt['smfg_here'].'</a>';
                            }
                            echo '
                        </td>

                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="30%"><b>'.$txt['smfg_service_type'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                          <td class="windowbg" colspan="2">
                          <select id="type_id" name="type_id">
                          <option value="">'.$txt['smfg_select_service_type'].'</option>
                          <option value="">------</option>';
                          echo service_type_select();
                          echo '
                          </select>
                          </td>
                    </tr>
                    <tr>

                        <td class="windowbg2" align="right" width="30%"><b>'.$txt['smfg_service_price'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg" colspan="2"><input name="price" type="text" size="10" value="" /></td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="30%"><b>'.$txt['smfg_service_rating'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg" colspan="2">
                        <select id="rating" name="rating">
                        <option value="">'.$txt['smfg_select_rating'].'</option>
                        <option value="">------</option>
                        <option value="10" >10 '.$txt['smfg_best'].'</option>
                        <option value="9" >9</option>
                        <option value="8" >8</option>
                        <option value="7" >7</option>
                        <option value="6" >6</option>
                        <option value="5" >5</option>
                        <option value="4" >4</option>
                        <option value="3" >3</option>
                        <option value="2" >2</option>
                        <option value="1" >1 '.$txt['smfg_worst'].'</option>
                        </select>
                        </td>

                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="30%"><b>'.$txt['smfg_vehicle_mileage'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg" colspan="2"><input name="mileage" type="text" size="10" value="" /></td>
                    </tr>
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="3"><input type="hidden" value="'.$_GET['VID'].'" name="VID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="modification" type="submit" value="'.$txt['smfg_add_service'].'" /></td>
                    </tr>
                </table>
                </form>
                <script language="JavaScript" type="text/javascript">
                var frmvalidator = new Validator("add_service");
                var frm = document.forms["add_service"];
                
                frmvalidator.addValidation("garage_id","req","'.$txt['smfg_val_select_garage'].'");
                frmvalidator.addValidation("garage_id","dontselect=0","'.$txt['smfg_val_select_garage'].'");
                frmvalidator.addValidation("garage_id","dontselect=1","'.$txt['smfg_val_select_garage'].'");
                
                frmvalidator.addValidation("type_id","req","'.$txt['smfg_val_select_service_type'].'");
                frmvalidator.addValidation("type_id","dontselect=0","'.$txt['smfg_val_select_service_type'].'");
                frmvalidator.addValidation("type_id","dontselect=1","'.$txt['smfg_val_select_service_type'].'");
                
                frmvalidator.addValidation("price","req","'.$txt['smfg_val_enter_service_price'].'");
                frmvalidator.addValidation("price","regexp=^[.0-9]{1,10}$","'.$txt['smfg_val_service_price_restriction'].'");
                
                frmvalidator.addValidation("rating","req","'.$txt['smfg_val_select_service_rating'].'");
                frmvalidator.addValidation("rating","dontselect=0","'.$txt['smfg_val_select_service_rating'].'");
                frmvalidator.addValidation("rating","dontselect=1","'.$txt['smfg_val_select_service_rating'].'");
                
                frmvalidator.addValidation("mileage","req","'.$txt['smfg_val_enter_mileage'].'");
                frmvalidator.addValidation("mileage","num","'.$txt['smfg_val_mileage_restriction'].'");
                </script>
            </td>
        </tr>

        <tr>
            <td class="titlebg" align="center" height="28"></td>
        </tr>
    </table>';
    
    echo smfg_footer();

}

function template_edit_service()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
    <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_edit_service'] . '</td>
        </tr>';
        
        // Garage?
        if($_SESSION['added_garage']) {
            echo '
            <tr>
                <td class="windowbg" align="center" valign="middle">'.$txt['smfg_garage_added'].'</td>
            </tr>';
            // Have to unset the session after we check for it so it doesn't show 'Successful' everytime a mod is added
            unset($_SESSION['added_garage']);
        }
        
        echo'
        <tr>
            <td class="windowbg">
            <form action="'.$scripturl.'?action=garage;sa=update_service" enctype="multipart/form-data" method="post" name="edit_service" id="edit_service" style="padding:0; margin:0;">
            <input type="hidden" name="redirecturl" value="' . $scripturl . '?action=garage;sa=view_vehicle;VID='.$_GET['VID'].';#services" />
                <table width="100%" cellpadding="3" cellspacing="1" border="0" class="bordercolor">
                    <tr>
                        <td class="windowbg2" align="right" width="30%"><b>'.$txt['smfg_serviced_by'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                          <td class="windowbg" colspan="2">
                          <select id="garage_id" name="garage_id">
                          <option value="">'.$txt['smfg_select_garage'].'</option>
                          <option value="">------</option>';
                          echo install_select($context['services']['garage_id']);
                          echo '
                          </select>';
                            if($smfgSettings['enable_user_submit_business']) {
                                echo '&nbsp;'.$txt['smfg_not_listed'].' <a href="'.$scripturl.'?action=garage;sa=submit_business;bustype=garage" rel="shadowbox;width=620;height=560" title="Garage :: Submit Garage">'.$txt['smfg_here'].'</a>';
                            }
                            echo '
                          </td>

                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="30%"><b>'.$txt['smfg_service_type'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                          <td class="windowbg" colspan="2">
                          <select id="type_id" name="type_id">
                          <option value="">'.$txt['smfg_select_service_type'].'</option>
                          <option value="">------</option>';
                          echo service_type_select($context['services']['type_id']);
                          echo '
                          </select>
                          </td>
                    </tr>
                    <tr>

                        <td class="windowbg2" align="right" width="30%"><b>'.$txt['smfg_service_price'].'</b></td>
                        <td class="windowbg" colspan="2"><input name="price" type="text" size="10" value="'.$context['services']['price'].'" /></td>
                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="30%"><b>'.$txt['smfg_service_rating'].'</b></td>
                        <td class="windowbg" colspan="2">';
                        echo '
                        <select id="rating" name="rating">   
                        <option value="">'.$txt['smfg_select_rating'].'</option>
                        <option value="">------</option>
                        <option value="10" '.$context['rat_10'].'>10 '.$txt['smfg_best'].'</option>
                        <option value="9" '.$context['rat_9'].'>9</option>
                        <option value="8" '.$context['rat_8'].'>8</option>
                        <option value="7" '.$context['rat_7'].'>7</option>
                        <option value="6" '.$context['rat_6'].'>6</option>
                        <option value="5" '.$context['rat_5'].'>5</option>
                        <option value="4" '.$context['rat_4'].'>4</option>
                        <option value="3" '.$context['rat_3'].'>3</option>
                        <option value="2" '.$context['rat_2'].'>2</option>
                        <option value="1" '.$context['rat_1'].'>1 '.$txt['smfg_worst'].'</option>
                        </select>
                        </td>

                    </tr>
                    <tr>
                        <td class="windowbg2" align="right" width="30%"><b>'.$txt['smfg_vehicle_mileage'].'</b>&nbsp;'.$txt['smfg_required'].'</td>
                        <td class="windowbg" colspan="2"><input name="mileage" type="text" size="10" value="'.$context['services']['mileage'].'" /></td>
                    </tr>
                    <tr>
                        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="3"><input type="hidden" value="'.$_GET['VID'].'" name="VID" /><input type="hidden" value="'.$_GET['SID'].'" name="SID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input type="hidden" name="redirecturl" value="' . $_SESSION['old_url'] . '" /><input name="service_update" type="submit" value="'.$txt['smfg_update_service'].'" /></td>
                    </tr>
                </table>
                </form>
                <script language="JavaScript" type="text/javascript">
                var frmvalidator = new Validator("edit_service");
                var frm = document.forms["edit_service"];
                
                frmvalidator.addValidation("garage_id","req","'.$txt['smfg_val_select_garage'].'");
                frmvalidator.addValidation("garage_id","dontselect=0","'.$txt['smfg_val_select_garage'].'");
                frmvalidator.addValidation("garage_id","dontselect=1","'.$txt['smfg_val_select_garage'].'");
                
                frmvalidator.addValidation("type_id","req","'.$txt['smfg_val_select_service_type'].'");
                frmvalidator.addValidation("type_id","dontselect=0","'.$txt['smfg_val_select_service_type'].'");
                frmvalidator.addValidation("type_id","dontselect=1","'.$txt['smfg_val_select_service_type'].'");
                
                frmvalidator.addValidation("price","req","'.$txt['smfg_val_enter_service_price'].'");
                frmvalidator.addValidation("price","regexp=^[.0-9]{1,10}$","'.$txt['smfg_val_service_price_restriction'].'");
                
                frmvalidator.addValidation("rating","req","'.$txt['smfg_val_select_service_rating'].'");
                frmvalidator.addValidation("rating","dontselect=0","'.$txt['smfg_val_select_service_rating'].'");
                frmvalidator.addValidation("rating","dontselect=1","'.$txt['smfg_val_select_service_rating'].'");
                
                frmvalidator.addValidation("mileage","req","'.$txt['smfg_val_enter_mileage'].'");
                frmvalidator.addValidation("mileage","num","'.$txt['smfg_val_mileage_restriction'].'");
                </script>
            </td>
        </tr>

        <tr>
            <td class="titlebg" align="center" height="28"></td>
        </tr>
    </table>';
    
    echo smfg_footer();

}

function template_edit_blog()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
    <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_edit_blog'] . '</td>
        </tr>

        <tr>
            <td class="windowbg">
            <form action="'.$scripturl.'?action=garage;sa=update_blog" method="post" name="edit_blog" id="edit_blog" style="padding:0; margin:0;">
            <input type="hidden" name="redirecturl" value="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$_GET['VID'].';#blog" />
            <table width="100%" cellspacing="1" cellpadding="3" border="0" class="bordercolor">
                <tr>
                    <td class="windowbg2" align="right" width="20%">'.$txt['smfg_blog_title'].'</td>
                    <td class="windowbg" colspan="1"><input name="blog_title" type="text" size="60" value="'.$context['blog']['title'].'" /></td>
                </tr>
                <tr>
                    <td class="windowbg2" align="right" width="20%">'.$txt['smfg_blog_entry'].'<br /><br />', $smfgSettings['enable_blogs_bbcode'] ? $txt['smfg_bbc_supported'] : $txt['smfg_bbc_disabled'] ,'<br />' . $txt['smfg_html_supported'] . '</td>
                    <td class="windowbg" colspan="1"><textarea name="blog_text" cols="70" rows="6">'.$context['blog']['text'].'</textarea></td>
                </tr>
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="5"><input type="hidden" value="'.$_GET['VID'].'" name="VID" /><input type="hidden" value="'.$_GET['BID'].'" name="BID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input name="submit" type="submit" value="'.$txt['smfg_update_blog_entry'].'"/></td>
                </tr>
            </table>
            </form>
            <script language="JavaScript" type="text/javascript">
            var frmvalidator = new Validator("edit_blog");
                
            frmvalidator.addValidation("blog_title","req","'.$txt['smfg_val_enter_blog_title'].'");
            frmvalidator.addValidation("blog_text","req","'.$txt['smfg_val_enter_blog_text'].'");
            frmvalidator.addValidation("blog_text","maxlen=5000","'.$txt['smfg_val_blog_restrictions'].'");
            </script>
            </td>
        </tr>

        <tr>
            <td class="titlebg" align="center" height="28"></td>
        </tr>
    </table>';
    
    echo smfg_footer();

}

function template_edit_garage_comment()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
    <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_edit_comment'] . '</td>
        </tr>

        <tr>
            <td class="windowbg">
            <form action="'.$scripturl.'?action=garage;sa=update_garage_comment" method="post" name="edit_comment" id="edit_comment" style="padding:0; margin:0;">
            <table width="100%" cellspacing="1" cellpadding="3" border="0" class="bordercolor">
                <tr>
                    <td class="windowbg2" align="right" width="20%">'.$txt['smfg_comment'].'<br /><br />', $smfgSettings['enable_guestbooks_bbcode'] ? $txt['smfg_bbc_supported'] : $txt['smfg_bbc_disabled'] ,'<br />' . $txt['smfg_html_supported'] . '</td>
                    <td class="windowbg" colspan="4"><textarea name="post" cols="70" rows="7">'.$context['comments']['post'].'</textarea></td>
                </tr>
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="5"><input type="hidden" value="'.$_GET['UID'].'" name="UID" /><input type="hidden" value="'.$_GET['CID'].'" name="CID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input type="hidden" name="redirecturl" value="' . $_SESSION['old_url'] . '" /><input name="submit" type="submit" value="'.$txt['smfg_update_comment'].'" /></td>
                </tr>
            </table>
            </form>
            <script language="JavaScript" type="text/javascript">
            var frmvalidator = new Validator("edit_comment");
                
            frmvalidator.addValidation("post","req","'.$txt['smfg_val_enter_comment'].'");
            frmvalidator.addValidation("post","maxlen=2500","'.$txt['smfg_val_comment_restriction'].'");
            </script>
            </td>
        </tr>

        <tr>
            <td class="titlebg" align="center" height="28"></td>
        </tr>
    </table>';
    
    echo smfg_footer();

}

function template_edit_comment()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

    echo '
    <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
        <tr>
            <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_edit_comment'] . '</td>
        </tr>

        <tr>
            <td class="windowbg">
            <form action="'.$scripturl.'?action=garage;sa=update_comment" method="post" name="edit_comment" id="edit_comment" style="padding:0; margin:0;">
            <table width="100%" cellspacing="1" cellpadding="3" border="0" class="bordercolor">
                <tr>
                    <td class="windowbg2" align="right" width="20%">'.$txt['smfg_comment'].'<br /><br />', $smfgSettings['enable_guestbooks_bbcode'] ? $txt['smfg_bbc_supported'] : $txt['smfg_bbc_disabled'] ,'<br />' . $txt['smfg_html_supported'] . '</td>
                    <td class="windowbg" colspan="4"><textarea name="post" cols="70" rows="7">'.$context['gb']['comment'].'</textarea></td>
                </tr>
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="5"><input type="hidden" value="'.$_GET['VID'].'" name="VID" /><input type="hidden" value="'.$_GET['CID'].'" name="CID" /><input type="hidden" name="sc" value="', $context['session_id'], '" /><input type="hidden" name="redirecturl" value="' . $_SESSION['old_url'] . '" /><input name="submit" type="submit" value="'.$txt['smfg_update_comment'].'" /></td>
                </tr>
            </table>
            </form>
            <script language="JavaScript" type="text/javascript">
            var frmvalidator = new Validator("edit_comment");
                
            frmvalidator.addValidation("post","req","'.$txt['smfg_val_enter_comment'].'");
            frmvalidator.addValidation("post","maxlen=2500","'.$txt['smfg_val_comment_restriction'].'");
            </script>
            </td>
        </tr>

        <tr>
            <td class="titlebg" align="center" height="28"></td>
        </tr>
    </table>';
    
    echo smfg_footer();

}

function template_search()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings, $boardurl;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
        if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

 // List Model Options
    echo model_options('search_garage')."\n\n";
 
 // List the product options
    echo product_options('search_garage');
    
echo '

<form action="'.$scripturl.'?action=garage;sa=search_results" id="search_garage" enctype="multipart/form-data"  name="search_garage" method="post" style="padding:0; margin:0;">
<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center">'.$txt['smfg_search'].' '.$txt['smfg_garage'].'</td>
    </tr>
    <tr>
        <td class="windowbg">
        <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
            <tr>
                <td class="windowbg2" align="center"><input type="checkbox" name="search_year" value="1" /></td>
                <td class="windowbg2" width="25%"><b>'.$txt['smfg_vehicle'].'&nbsp;'.$txt['smfg_year'].'</b></td>
                <td class="windowbg">
                <select id="made_year" name="made_year">';
                echo year_options($smfgSettings['year_start'], $smfgSettings['year_end']);
                echo '
                </select></td>
            </tr>
            <tr>
                <td class="windowbg2" align="center"><input type="checkbox" name="search_make" value="1" /></td>
                <td class="windowbg2" width="25%"><b>'.$txt['smfg_vehicle'].'&nbsp;'.$txt['smfg_make'].'</b></td>
                <td class="windowbg">
                <select id="make_id" name="make_id">
                <option value="">'.$txt['smfg_select_make1'].'</option>
                <option value="">------</option>';
                             // List Make Selections
                             echo make_select();
                             echo'
                </select></td>
            </tr>
            <tr>
                <td class="windowbg2" align="center"><input type="checkbox" name="search_model" value="1" /></td>
                <td class="windowbg2" width="25%"><b>'.$txt['smfg_vehicle'].'&nbsp;'.$txt['smfg_model'].'</b></td>
                <td class="windowbg">
                <select id="model_id" name="model_id">
                <script type="text/javascript">dol.printOptions("model_id")</script>
                </select></td>
            </tr>
            <tr>
                <td class="windowbg2" align="center"><input type="checkbox" name="search_category" value="1" /></td>
                <td class="windowbg2" width="25%"><b>'.$txt['smfg_modification'].'&nbsp;'.$txt['smfg_category'].'</b></td>
                <td class="windowbg">
                <select id="category_id" name="category_id">
                <option value="">'.$txt['smfg_select_category'].'</option>
                <option value="">------</option>';
                        // List Mod Category Selections
                        echo cat_select();
                        echo '</select></td>
            </tr>
            <tr>
                <td class="windowbg2" align="center"><input type="checkbox" name="search_manufacturer" value="1" /></td>
                <td class="windowbg2" width="25%"><b>'.$txt['smfg_modification'].'&nbsp;'.$txt['smfg_manufacturer'].'</b></td>
                <td class="windowbg">
                <select id="manufacturer_id" name="manufacturer_id">
                <script type="text/javascript">dol.printOptions("manufacturer_id")</script>
                </select></td>
            </tr>
            <tr>
                <td class="windowbg2" align="center"><input type="checkbox" name="search_product" value="1" /></td>
                <td class="windowbg2" width="25%"><b>'.$txt['smfg_modification'].'&nbsp;'.$txt['smfg_product'].'</b></td>
                <td class="windowbg">
                <select id="product_id" name="product_id">
                <script type="text/javascript">dol.printOptions("product_id")</script>
                </select></td>
            </tr>
            <tr>
                <td class="windowbg2" align="center"><input type="checkbox" name="search_username" value="1" /></td>
                <td class="windowbg2" width="25%"><b>'.$txt['smfg_member_name'].'</b></td>
                <td class="windowbg"><input name="username" id="username" type="text" size="35" value="" tabindex="', $context['tabindex']++, '" />&nbsp;<a href="', $scripturl, '?action=findmember;input=username;quote=0;sesc=', $context['session_id'], '" onclick="return reqWin(this.href, 350, 400);"><img src="', $settings['images_url'], '/icons/assist.gif" alt="', $txt['find_members'], '" /></a> <a href="', $scripturl, '?action=findmember;input=username;quote=0;sesc=', $context['session_id'], '" onclick="return reqWin(this.href, 350, 400);"><span class="smalltext">', $txt['find_members'], '</span></a>
            </tr>
            <tr>
                <td class="windowbg2">&nbsp;</td>
                <td class="windowbg2" width="25%"><b>'.$txt['smfg_search_logic'].'</b></td>
                <td class="windowbg"><label for="search_any">'.$txt['smfg_match_any'].'<input type="radio" name="search_logic" id="search_any" value="OR" checked="checked" /></label>&nbsp;&nbsp;<label for="search_all">'.$txt['smfg_match_all'].'<input type="radio" name="search_logic" id="search_all" value="AND" /></label></td>
            </tr>
            <tr>
                <td class="windowbg2">&nbsp;</td>
                <td class="windowbg2" width="25%"><b>'.$txt['smfg_display_results_as'].'</b></td>
                <td class="windowbg">
                <label for="vehicles">'.$txt['smfg_vehicles_caps'].'<input type="radio" class="radio" name="display_as" id="vehicles" value="vehicles" checked /></label>&nbsp;&nbsp;';
                if($smfgSettings['enable_modification']) {
                    echo '
                    <label for="modifications">'.$txt['smfg_modifications'].'<input name="display_as" type="radio" class="radio" id="modifications" value="modifications" /></label>&nbsp;&nbsp;';
                }
                if($smfgSettings['enable_insurance']) {
                    echo '
                    <label for="premiums">'.$txt['smfg_premiums'].'<input name="display_as" type="radio" class="radio" id="premiums" value="premiums" /></label>&nbsp;&nbsp;';
                }
                if($smfgSettings['enable_quartermile']) {
                    echo '
                    <label for="quartermiles">&frac14; miles<input type="radio" class="radio" name="display_as" id="quartermiles" value="quartermiles" /></label>&nbsp;&nbsp;';
                }
                if($smfgSettings['enable_dynorun']) {
                    echo '
                    <label for="dynoruns">'.$txt['smfg_dynoruns'].'<input type="radio" class="radio" name="display_as" id="dynoruns" value="dynoruns" /></label>&nbsp;&nbsp;';
                }
                if($smfgSettings['enable_laptimes']) {
                    echo '
                    <label for="laps">'.$txt['smfg_laps'].'<input type="radio" class="radio" name="display_as" id="laps" value="laps" /></label>';
                }
                echo '</td>
            </tr>
        </table>';

echo '</td>
</tr>
<tr>
    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28"><input name="submit" type="submit" value="'.$txt['smfg_search'].'" /></td>
</tr>
</table>
</form>';
    
    echo smfg_footer();

}

function template_search_results()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }
    
echo '

<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="left">';
            echo $txt['139'].': '.$context['page_index'];
            echo '</td>
    </tr>
    <tr>
        <td class="windowbg">';
        
        // Display as - Vehicles
        if($_SESSION['smfg']['display_as'] == "vehicles") {
            echo '
            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
            $count = 0;
            if(isset($context['search_results'][$count]['vid'])) {
                echo '
                <tr>
                <td class="catbg" align="center" nowrap="nowrap">&nbsp;</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byYear'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byMake'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byModel'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byColor'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byOwner'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byViews'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byMods'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byUpdated'].'</td>
                </tr>';
                while(isset($context['search_results'][$count]['vid'])) {
                    // Set class for alternating bgcolor
                    if($context['bgclass'] == "windowbg") {
                        $context['bgclass'] = "windowbg2";
                    } else {
                        $context['bgclass'] = "windowbg";
                    }
                echo '
                <tr class="'.$context['bgclass'].'">
                <td align="center" style="width: 25px;  white-space: nowrap;">'.$context['search_results'][$count]['image'].$context['search_results'][$count]['spacer'].$context['search_results'][$count]['video'].'</td>
                <td align="center">'.$context['search_results'][$count]['made_year'].'</td>
                <td align="center">'.$context['search_results'][$count]['make'].'</td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['search_results'][$count]['vid'].'">'.garage_title_clean($context['search_results'][$count]['model']).'</a></td>
                <td align="center">'.$context['search_results'][$count]['color'].'</td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['search_results'][$count]['user_id'].'">'.$context['search_results'][$count]['memberName'].'</a></td>
                <td align="center">'.$context['search_results'][$count]['views'].'</td>
                <td align="center">'.$context['search_results'][$count]['total_mods'].'</td>
                <td align="center">'.date($context['date_format'],$context['search_results'][$count]['date_updated']).'</td>
                </tr>';
                $count++;
                }
            } else {
                echo '
                <tr class="windowbg">
                <td colspan="9" align="center">'.$txt['smfg_no_vehicle_results'].'</td>
                </tr>';
            }        
            echo '
            </table>';
        }
        
        // Display as - Modifications
        if($_SESSION['smfg']['display_as'] == "modifications") {
            echo '
            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
            $count = 0;
            if(isset($context['search_results'][$count]['vid'])) {
                echo '
                <tr>
                <td class="catbg" align="center" nowrap="nowrap">&nbsp;</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byYear'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byMake'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byModel'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byOwner'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byMod'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byUpdated'].'</td>
                </tr>';
                while(isset($context['search_results'][$count]['vid'])) {
                    // Set class for alternating bgcolor
                    if($context['bgclass'] == "windowbg") {
                        $context['bgclass'] = "windowbg2";
                    } else {
                        $context['bgclass'] = "windowbg";
                    }
                echo '
                <tr class="'.$context['bgclass'].'">
                <td align="center" style="width: 25px;  white-space: nowrap;">'.$context['search_results'][$count]['image'].$context['search_results'][$count]['spacer'].$context['search_results'][$count]['video'].'</td>
                <td align="center">'.$context['search_results'][$count]['made_year'].'</td>
                <td align="center">'.$context['search_results'][$count]['make'].'</td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['search_results'][$count]['vid'].'">'.garage_title_clean($context['search_results'][$count]['model']).'</a></td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['search_results'][$count]['user_id'].'">'.$context['search_results'][$count]['memberName'].'</a></td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_modification;VID='.$context['search_results'][$count]['vid'].';MID='.$context['search_results'][$count]['mid'].'">'.garage_title_clean($context['search_results'][$count]['modification']).'</td>
                <td align="center">'.date($context['date_format'],$context['search_results'][$count]['date_updated']).'</td>
                </tr>';
                $count++;
                }
            } else {
                echo '
                <tr class="windowbg">
                <td colspan="9" align="center">'.$txt['smfg_no_modification_results'].'</td>
                </tr>';
            }        
            echo '
            </table>';    
        }
        
        
        // Display as - Premiums
        if($_SESSION['smfg']['display_as'] == "premiums") {
        echo '
            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
            $count = 0;
            if(isset($context['search_results'][$count]['vid'])) {
                echo '
                <tr>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byVehicle'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byOwner'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byPremium'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byCoverType'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byInsurer'].'</td>
                </tr>';
                while(isset($context['search_results'][$count]['vid'])) {
                    // Set class for alternating bgcolor
                    if($context['bgclass'] == "windowbg") {
                        $context['bgclass'] = "windowbg2";
                    } else {
                        $context['bgclass'] = "windowbg";
                    }
                echo '
                <tr class="'.$context['bgclass'].'">
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['search_results'][$count]['vid'].'">'.garage_title_clean($context['search_results'][$count]['vehicle']).'</a></td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['search_results'][$count]['user_id'].'">'.$context['search_results'][$count]['memberName'].'</a></td>
                <td align="center">'.$context['search_results'][$count]['price'].'</td>
                <td align="center">'.$context['search_results'][$count]['cover_type'].'</td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=insurance_review;BID='.$context['search_results'][$count]['bid'].'">'.garage_title_clean($context['search_results'][$count]['insurer']).'</a></td>
                </tr>';
                $count++;
                }
            } else {
                echo '
                <tr class="windowbg">
                <td colspan="9" align="center">'.$txt['smfg_no_premium_results'].'</td>
                </tr>';
            }        
            echo '
            </table>'; 
        }
        
        
        // Display as - Quartermiles
        if($_SESSION['smfg']['display_as'] == "quartermiles") {
            echo '
            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
            $count = 0;
            if(isset($context['search_results'][$count]['qmid'])) {
                echo '
                    <tr>
                        <td class="catbg" nowrap="nowrap">&nbsp;</td>
                        <td class="catbg" nowrap="nowrap">'.$context['sort']['byUsername'].'</td>
                        <td class="catbg" nowrap="nowrap">'.$context['sort']['byVehicle'].'</td>
                        <td class="catbg" nowrap="nowrap">'.$context['sort']['byRt'].'</td>
                        <td class="catbg" nowrap="nowrap">'.$context['sort']['bySixty'].'</td>
                        <td class="catbg" nowrap="nowrap">'.$context['sort']['byThree'].'</td>
                        <td class="catbg" nowrap="nowrap">'.$context['sort']['byEighth'].'</td>
                        <td class="catbg" nowrap="nowrap">'.$context['sort']['byThou'].'</td>
                        <td class="catbg" nowrap="nowrap">'.$context['sort']['byQuart'].'</td>
                    </tr>';
                    while(isset($context['search_results'][$count]['qmid'])) {
                        // Set class for alternating bgcolor
                        if($context['bgclass'] == "windowbg") {
                            $context['bgclass'] = "windowbg2";
                        } else {
                            $context['bgclass'] = "windowbg";
                        }
                        echo '
                        <tr class="'.$context['bgclass'].'">
                            <td align="center" style="width: 25px;  white-space: nowrap;">'.$context['search_results'][$count]['image'].$context['search_results'][$count]['spacer'].$context['search_results'][$count]['video'].'</td>
                            <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['search_results'][$count]['user_id'].'">'.$context['search_results'][$count]['memberName'].'</a></td>
                            <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['search_results'][$count]['vid'].'">'.garage_title_clean($context['search_results'][$count]['vehicle']).'</a></td>
                            <td align="center">'.$context['search_results'][$count]['rt'].'</td>
                            <td align="center">'.$context['search_results'][$count]['sixty'].'</td>
                            <td align="center">'.$context['search_results'][$count]['three'].'</td>
                            <td align="center">'.$context['search_results'][$count]['eighth'].'&nbsp;&#64;&nbsp;'.$context['search_results'][$count]['eighthmph'].'</td>
                            <td align="center">'.$context['search_results'][$count]['thou'].'</td>
                            <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_quartermile;VID='.$context['search_results'][$count]['vid'].';QID='.$context['search_results'][$count]['qmid'].'">'.garage_title_clean($context['search_results'][$count]['quart']).'&nbsp;&#64;&nbsp;'.garage_title_clean($context['search_results'][$count]['quartmph']).'</a></td>
                        </tr>';
                        $count++;
                    }            
            } else {
                echo '
                    <tr class="windowbg">
                        <td colspan="9" align="center">'.$txt['smfg_no_quartermile_results'].'</td>
                    </tr>';
            }            
                echo '
            </table>';
        }
        
        
        // Display as - Dynoruns
        if($_SESSION['smfg']['display_as'] == "dynoruns") {
        echo '
        <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
        $count = 0;
        if(isset($context['search_results'][$count]['vid'])) {
        echo '
                <tr> 
                    <td class="catbg" nowrap="nowrap">&nbsp;</td>
                    <td class="catbg" nowrap="nowrap">'.$context['sort']['byOwner'].'</td>
                    <td class="catbg" nowrap="nowrap">'.$context['sort']['byVehicle'].'</td>
                    <td class="catbg" nowrap="nowrap">'.$context['sort']['byDynocenter'].'</td>
                    <td class="catbg" nowrap="nowrap">'.$context['sort']['byBhp'].'</td>
                    <td class="catbg" nowrap="nowrap">'.$context['sort']['byTorque'].'</td>
                    <td class="catbg" nowrap="nowrap">'.$context['sort']['byBoost'].'</td>
                    <td class="catbg" nowrap="nowrap">'.$context['sort']['byNitrous'].'</td>
                    <td class="catbg" nowrap="nowrap">'.$context['sort']['byPeakpoint'].'</td>
                </tr>';
            while(isset($context['search_results'][$count]['vid'])) { 
                    // Set class for alternating bgcolor
                    if($context['bgclass'] == "windowbg") {
                        $context['bgclass'] = "windowbg2";
                    } else {
                        $context['bgclass'] = "windowbg";
                    }
                    echo '
                    <tr class="'.$context['bgclass'].'">
                        <td align="center" style="width: 25px;  white-space: nowrap;">'.$context['search_results'][$count]['image'].$context['search_results'][$count]['spacer'].$context['search_results'][$count]['video'].'</td>
                        <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['search_results'][$count]['user_id'].'">'.$context['search_results'][$count]['memberName'].'</a></td>
                        <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['search_results'][$count]['vid'].'" >'.garage_title_clean($context['search_results'][$count]['vehicle']).'</a></td>
                        <td align="center"><a href="'.$scripturl.'?action=garage;sa=dc_review;BID='.$context['search_results'][$count]['dynocenter_id'].'">'.garage_title_clean($context['search_results'][$count]['dynocenter']).'</a></td>
                        <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_dynorun;VID='.$context['search_results'][$count]['vid'].';DID='.$context['search_results'][$count]['did'].'">'.garage_title_clean($context['search_results'][$count]['bhp']).' '.garage_title_clean($context['search_results'][$count]['bhp_unit']).'</a></td>
                        <td align="center">'.$context['search_results'][$count]['torque'].' '.$context['search_results'][$count]['torque_unit'].'</td>
                        <td align="center">'.$context['search_results'][$count]['boost'].' '.$context['search_results'][$count]['boost_unit'].'</td>
                        <td align="center">'.$context['search_results'][$count]['nitrous'].' Shot</td>
                        <td align="center">'.$context['search_results'][$count]['peakpoint'].' RPM</td>
                    </tr>';
                    $count++;
            }
        } else {
            echo '
                <tr class="windowbg">
                    <td colspan="9" align="center">'.$txt['smfg_no_dynorun_results'].'</td>
                </tr>';
        }                
        echo '
            </table>';
        }
        
        
        // Display as - Laps
        if($_SESSION['smfg']['display_as'] == "laps") {
            echo '
        <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
        $count = 0;
        if(isset($context['search_results'][$count]['lid'])) {
        echo '
            <tr>
                <td class="catbg">&nbsp;</td>
                <td class="catbg" nowrap="nowrap">'.$context['sort']['byOwner'].'</td>
                <td class="catbg" nowrap="nowrap">'.$context['sort']['byVehicle'].'</td>
                <td class="catbg">'.$context['sort']['byTrack'].'</td>
                <td class="catbg">'.$context['sort']['byCondition'].'</td>
                <td class="catbg">'.$context['sort']['byType'].'</td>
                <td class="catbg">'.$context['sort']['byTime'].'</td>
            </tr>';
            while(isset($context['search_results'][$count]['lid'])) {
                // Set class for alternating bgcolor
                if($context['bgclass'] == "windowbg") {
                    $context['bgclass'] = "windowbg2";
                } else {
                    $context['bgclass'] = "windowbg";
                }
                echo '
                <tr class="'.$context['bgclass'].'">
                    <td align="center" style="width: 25px;  white-space: nowrap;">'.$context['search_results'][$count]['image'].'&nbsp;'.$context['search_results'][$count]['video'].'</td>
                    <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['search_results'][$count]['user_id'].'">'.$context['search_results'][$count]['memberName'].'</a></td>
                    <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['search_results'][$count]['vid'].'">'.garage_title_clean($context['search_results'][$count]['vehicle']).'</a></td>
                    <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_track;TID='.$context['search_results'][$count]['tid'].'">'.garage_title_clean($context['search_results'][$count]['track']).'</a></td>
                    <td align="center">'.$context['search_results'][$count]['condition'].'</td>
                    <td align="center">'.$context['search_results'][$count]['type'].'</td>
                    <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_laptime;VID='.$context['search_results'][$count]['vid'].';LID='.$context['search_results'][$count]['lid'].'">'.garage_title_clean($context['search_results'][$count]['time']).'</a></td>
                </tr>';
                $count++;
            }            
        } else {
            echo '
                <tr class="windowbg">
                    <td colspan="9" align="center">'.$txt['smfg_no_lap_results'].'</td>
                </tr>';
        }
            echo'
        </table>';  
        }
        
        echo '</td>
    </tr>
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28">
        <table width="100%">
        <tr>
            <td align="left">';
            echo $txt['139'].': '.$context['page_index'];
            echo '</td>
            <td align="right"><b>[&nbsp;'.$context['total'].'&nbsp;results&nbsp;]&nbsp;</b></td>
        </tr>
    </table></td>
    </tr>
</table>';
    
    echo smfg_footer();

}

function template_insurance()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
        if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

echo '

<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="left">';
            echo $txt['139'].': '.$context['page_index'];
            echo '</td>
    </tr>
    <tr>
        <td class="windowbg">
        <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
        // Loop through each insurance company
        $count = 0;
        if(isset($context['insurance'][$count]['bid'])) {
            while(isset($context['insurance'][$count]['bid'])) {
                echo '
                   <tr>
                    <td height="25" colspan="8" class="titlebg" align="center"><a href="'.$scripturl.'?action=garage;sa=insurance_review;BID='.$context['insurance'][$count]['bid'].'">'.garage_title_clean($context['insurance'][$count]['title']).'</a></td>
                </tr>
                <tr>
                      <td class="windowbg" height="25" colspan="8" >
                    <b>'.$txt['smfg_business_name'].': </b><a href="'.$scripturl.'?action=garage;sa=insurance_review;BID='.$context['insurance'][$count]['bid'].'">'.garage_title_clean($context['insurance'][$count]['title']).'</a>
                    &nbsp;&nbsp;<span class="smalltext">'.$txt['smfg_click_for_detail'].'</span>
                     <br /><b>'.$txt['smfg_address'].': </b>'.$context['insurance'][$count]['address'].'
                    <br /><b>'.$txt['smfg_telephone_no'].': </b>'.$context['insurance'][$count]['telephone'].'
                    <br /><b>'.$txt['smfg_fax'].': </b>'.$context['insurance'][$count]['fax'].'
                    <br /><b>'.$txt['smfg_website'].': </b>', (!empty($context['insurance'][$count]['website'])) ? '<a href="'.$context['insurance'][$count]['website'].'" target="_blank">'.$context['insurance'][$count]['website'].'</a>' : '' ,'
                    <br /><b>'.$txt['smfg_email'].': </b>'.$context['insurance'][$count]['email'].'
                    <br /><b>'.$txt['smfg_opening_hours'].': </b>'.$context['insurance'][$count]['opening_hours'].'
                    </td>
                </tr>
                   <tr>
                      <td class="catbg" width="30%" nowrap="nowrap">'.$txt['smfg_cover_type'].'</td>
                    <td class="catbg" width="25%" align="center">'.$txt['smfg_lowest_premium'].'</td>
                    <td class="catbg" width="25%" align="center">'.$txt['smfg_average_premium'].'</td>
                    <td class="catbg" width="25%" align="center">'.$txt['smfg_highest_premium'].'</td>
                </tr>';
                // Loop through all the coverage types and premiums
                $count2 = 0;
                while(isset($context['insurance'][$count][$count2]['cid'])) {
                echo '
                <tr>
                    <td class="windowbg" nowrap="nowrap">'.$context['insurance'][$count][$count2]['title'].'</td>
                    <td class="windowbg" align="center">'.$context['insurance'][$count][$count2]['min'].'</td>
                    <td class="windowbg" align="center">'.$context['insurance'][$count][$count2]['avg'].'</td>
                    <td class="windowbg" align="center">'.$context['insurance'][$count][$count2]['max'].'</td>
                   </tr>';
                $count2++;
                }            
                echo '
                <tr>
                    <td class="catbg" colspan="4" height="1"><img src="'. $settings['default_images_url'] . '/spacer.gif" alt="" width="1" height="1" /></td>
                </tr>';
            $count++;
            } 
        } else {
            echo '
                    <tr class="windowbg">
                        <td align="center">'.$txt['smfg_no_insurance'].'</td>
                    </tr>';
        }
        echo '
          </table>
        </td>
    </tr>
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="left">
        <table width="100%">
            <tr>
                <td align="left">';
                echo $txt['139'].': '.$context['page_index'];
                echo '</td>
                <td align="right">[&nbsp;'.$context['total'].'&nbsp;'.$txt['smfg_businesses_lower'].'&nbsp;]&nbsp;</td>
            </tr>
        </table>
        </td>
    </tr>
</table>';
    
    echo smfg_footer();

}

function template_insurance_review()
{
global $context, $settings, $options, $txt, $scripturl;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

echo '

<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="left">&nbsp;</td>
    </tr>
    <tr>
        <td class="windowbg">
        <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
               <tr>
                <td height="25" colspan="8" class="titlebg" align="center">'.$context['insurance']['title'].'</td>
            </tr>
            <tr>
                <td class="windowbg" height="25" colspan="8" >
                <b>'.$txt['smfg_business_name'].': </b>'.$context['insurance']['title'].'
                <br /><b>'.$txt['smfg_address'].': </b>'.$context['insurance']['address'].'
                <br /><b>'.$txt['smfg_telephone_no'].': </b>'.$context['insurance']['telephone'].'
                <br /><b>'.$txt['smfg_fax'].': </b>'.$context['insurance']['fax'].'
                <br /><b>'.$txt['smfg_website'].': </b>', (!empty($context['insurance']['website'])) ? '<a href="'.$context['insurance']['website'].'" target="_blank">'.$context['insurance']['website'].'</a>' : '' ,'
                <br /><b>'.$txt['smfg_email'].': </b>'.$context['insurance']['email'].'
                <br /><b>'.$txt['smfg_opening_hours'].': </b>'.$context['insurance']['opening_hours'].'
                </td>
            </tr>
            <tr>
                <td class="catbg" width="30%" nowrap="nowrap">'.$txt['smfg_cover_type'].'</td>
                <td class="catbg" width="25%" align="center">'.$txt['smfg_lowest_premium'].'</td>
                <td class="catbg" width="25%" align="center">'.$txt['smfg_average_premium'].'</td>
                <td class="catbg" width="25%" align="center">'.$txt['smfg_highest_premium'].'</td>
            </tr>';
            // Loop through all the coverage types and premiums
            $count = 0;
            while(isset($context['insurance'][$count]['cid'])) {
            echo '
            <tr>
                <td class="windowbg" nowrap="nowrap">'.$context['insurance'][$count]['title'].'</td>
                <td class="windowbg" align="center">'.$context['insurance'][$count]['min'].'</td>
                <td class="windowbg" align="center">'.$context['insurance'][$count]['avg'].'</td>
                <td class="windowbg" align="center">'.$context['insurance'][$count]['max'].'</td>
            </tr>';
            $count++;
            }            
            echo '
            <tr>
                <td class="catbg" colspan="4" height="1"><img src="'. $settings['default_images_url'] . '/spacer.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
                <td colspan="4" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center">'.$txt['smfg_latest_customers'].'</td>
            </tr>';
            $count = 0;
            if(isset($context['insurance'][$count]['pid'])) {
                echo '
                <tr>
                    <td class="catbg" width="30%" nowrap="nowrap">'.$txt['smfg_owner'].'</td>
                    <td class="catbg" width="25%" align="center">'.$txt['smfg_vehicle'].'</td>
                    <td class="catbg" width="25%" align="center">'.$txt['smfg_premium'].'</td>
                    <td class="catbg" width="25%" align="center">'.$txt['smfg_cover_type'].'</td>
                </tr>';
                while(isset($context['insurance'][$count]['pid'])) {
                    // Set class for alternating bgcolor
                    if($context['bgclass'] == "windowbg") {
                        $context['bgclass'] = "windowbg2";
                    } else {
                        $context['bgclass'] = "windowbg";
                    }
                echo '
                <tr class="'.$context['bgclass'].'">
                    <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['insurance'][$count]['user_id'].'">'.$context['insurance'][$count]['memberName'].'</a></td>
                    <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['insurance'][$count]['vid'].'">'.garage_title_clean($context['insurance'][$count]['vehicle']).'</a></td>
                    <td align="center">'.$context['insurance'][$count]['premium'].'</td>
                    <td align="center">'.$context['insurance'][$count]['cover_type'].'</td>
                </tr>';
                $count++;
                }
            } else {
                echo '
            <tr>
                <td class="windowbg" colspan="4" align="center">'.$txt['smfg_no_customers'].'</td>
            </tr>';            
            } 
           echo '
          </table>
          </td>
    </tr>
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="left">&nbsp;</td>
    </tr>
</table>';
    
    echo smfg_footer();

}

function template_shops()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
        if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

echo '

<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="left">';
            echo $txt['139'].': '.$context['page_index'];
            echo '</td>
    </tr>
    <tr>
        <td class="windowbg">
        <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
            $count = 0;
            if(isset($context['shops'][$count]['bid'])) {
                while(isset($context['shops'][$count]['bid'])) {

                echo '
                <tr>
                      <td height="25" colspan="8" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center"><a href="'.$scripturl.'?action=garage;sa=shop_review;BID='.$context['shops'][$count]['bid'].'">'.garage_title_clean($context['shops'][$count]['title']).'</a></td>
                </tr>
                <tr>
                      <td class="windowbg" height="25" colspan="8" ><b>'.$txt['smfg_business_name'].': </b><a href="'.$scripturl.'?action=garage;sa=shop_review;BID='.$context['shops'][$count]['bid'].'">'.garage_title_clean($context['shops'][$count]['title']).'</a>
                    &nbsp;&nbsp;<span class="smalltext">'.$txt['smfg_click_for_detail'].'</span>
                     <br /><b>'.$txt['smfg_address'].': </b>'.$context['shops'][$count]['address'].'
                    <br /><b>'.$txt['smfg_telephone_no'].': </b>'.$context['shops'][$count]['telephone'].'
                    <br /><b>'.$txt['smfg_fax'].':</b>'.$context['shops'][$count]['fax'].'
                    <br /><b>'.$txt['smfg_website'].': </b>', (!empty($context['shops'][$count]['website'])) ? '<a href="'.$context['shops'][$count]['website'].'" target="_blank">'.$context['shops'][$count]['website'].'</a>' : '' ,'
                    <br /><b>'.$txt['smfg_email'].': </b>'.$context['shops'][$count]['email'].'
                    <br /><b>'.$txt['smfg_opening_hours'].': </b>'.$context['shops'][$count]['opening_hours'];
                    if($context['shops'][$count]['total_poss_rating']) {
                        if($smfgSettings['rating_system'] == 0)
                            echo '<br /><b>'.$txt['smfg_rating'].': </b>'.$context['shops'][$count]['total_rating'].'/'.$context['shops'][$count]['total_poss_rating'].'</td>';
                        else if($smfgSettings['rating_system'] == 1)
                            echo '<br /><b>'.$txt['smfg_rating'].': </b>'.$context['shops'][$count]['total_rating'].'/10 ('.$txt['smfg_rated'].' '.($context['shops'][$count]['total_poss_rating']/10).' '.$txt['smfg_times'].')</td>';
                    } else {
                        echo '<br /><b>'.$txt['smfg_rating'].': </b>'.$txt['smfg_not_rated'].'</td>';
                    }
                echo '                                
                </tr>
                 <tr>
                    <td class="titlebg" align="center" height="28" colspan="6">'.$txt['smfg_latest_customers'].'</td>
                </tr>';
                $count2 = 0;
                if(isset($context['shops'][$count][$count2]['vid'])) {
                echo '
                <tr>
                    <td class="catbg" align="center" height="28" >'.$txt['smfg_owner'].'</td>
                    <td class="catbg" align="center" height="28" >'.$txt['smfg_vehicle'].'</td>
                    <td class="catbg" align="center" height="28" >'.$txt['smfg_modification'].'</td>
                    <td class="catbg" align="center" height="28" >'.$txt['smfg_purchase_rating'].'</td>
                    <td class="catbg" align="center" height="28" >'.$txt['smfg_product_rating'].'</td>
                    <td class="catbg" align="center" height="28" >'.$txt['smfg_price'].'</td>
                </tr>';
                while(isset($context['shops'][$count][$count2]['vid'])) {
                    // Set class for alternating bgcolor
                    if($context['bgclass'] == "windowbg") {
                        $context['bgclass'] = "windowbg2";
                    } else {
                        $context['bgclass'] = "windowbg";
                    }
                    echo '
                    <tr class="'.$context['bgclass'].'">
                        <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['shops'][$count][$count2]['user_id'].'">'.$context['shops'][$count][$count2]['memberName'].'</a></td>
                        <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['shops'][$count][$count2]['vid'].'">'.garage_title_clean($context['shops'][$count][$count2]['vehicle']).'</a></td>
                        <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_modification;VID='.$context['shops'][$count][$count2]['vid'].';MID='.$context['shops'][$count][$count2]['mid'].'">'.garage_title_clean($context['shops'][$count][$count2]['mod_title']).'</a></td>
                        <td align="center" nowrap="nowrap">'.$context['shops'][$count][$count2]['purchase_rating'].'</td>
                        <td align="center" nowrap="nowrap">'.$context['shops'][$count][$count2]['product_rating'].'</td>
                        <td align="center" nowrap="nowrap">'.$context['shops'][$count][$count2]['price'].'</td>
                    </tr>';
                    $count2++;
                }
                } else {
                    echo '
                    <tr>
                        <td class="windowbg" colspan="6" align="center">'.$txt['smfg_no_customers'].'</td>
                    </tr>
                    ';
                }
                echo '
                <tr>
                    <td class="catbg" colspan="6" height="1"><img src="'. $settings['default_images_url'] . '/spacer.gif" alt="" width="1" height="1" /></td>
                </tr>';
                $count++;
                } 
            } else {
            echo '
                    <tr class="windowbg">
                        <td align="center">'.$txt['smfg_no_shops'].'</td>
                    </tr>';
            }
            echo '
        </table>
        </td>
    </tr>
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="left">
        <table width="100%">
            <tr>
                <td align="left">';
                echo $txt['139'].': '.$context['page_index'];
                echo '</td>
                <td align="right">[&nbsp;'.$context['total'].'&nbsp;'.$txt['smfg_businesses_lower'].'&nbsp;]&nbsp;</td>
            </tr>
        </table>
        </td>
    </tr>
</table>';
    
    echo smfg_footer();

}

function template_shop_review()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

echo '

<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center">&nbsp;</td>
    </tr>
    <tr>
        <td class="windowbg">
        <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor"><tr>
                  <td height="25" colspan="8" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center">'.$context['shops']['title'].'</td>
            </tr>';
            $count = 0;

            echo '
            <tr>
                <td class="windowbg" height="25" colspan="8" ><b>'.$txt['smfg_business_name'].': </b>'.$context['shops']['title'].'
                <br /><b>'.$txt['smfg_address'].': </b>'.$context['shops']['address'].'
                <br /><b>'.$txt['smfg_telephone_no'].': </b>'.$context['shops']['telephone'].'
                <br /><b>'.$txt['smfg_fax'].':</b>'.$context['shops']['fax'].'
                <br /><b>'.$txt['smfg_website'].': </b>', (!empty($context['shops']['website'])) ? '<a href="'.$context['shops']['website'].'" target="_blank">'.$context['shops']['website'].'</a>' : '' ,'
                <br /><b>'.$txt['smfg_email'].': </b>'. $context['shops']['email'] .'
                <br /><b>'.$txt['smfg_opening_hours'].': </b>'.$context['shops']['opening_hours'];
                if($context['shops']['total_poss_rating']) {
                    if($smfgSettings['rating_system'] == 0)
                        echo '<br /><b>'.$txt['smfg_rating'].': </b>'.$context['shops']['total_rating'].'/'.$context['shops']['total_poss_rating'].'</td>';
                    else if($smfgSettings['rating_system'] == 1)
                        echo '<br /><b>'.$txt['smfg_rating'].': </b>'.$context['shops']['total_rating'].'/10 ('.$txt['smfg_rated'].' '.($context['shops']['total_poss_rating']/10).' '.$txt['smfg_times'].')</td>';
                } else {
                    echo '<br /><b>'.$txt['smfg_rating'].': </b>'.$txt['smfg_not_rated'].'</td>';
                }
            echo '
            </tr>
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg' ,'" align="center" height="28" colspan="6">'.$txt['smfg_latest_customers'].'</td>
            </tr>';
            if(isset($context['shops'][$count]['vid'])) {
            echo '
            <tr>
                <td class="catbg" align="center" height="28" >'.$txt['smfg_owner'].'</td>
                <td class="catbg" align="center" height="28" >'.$txt['smfg_vehicle'].'</td>
                <td class="catbg" align="center" height="28" >'.$txt['smfg_modification'].'</td>
                <td class="catbg" align="center" height="28" >'.$txt['smfg_purchase_rating'].'</td>
                <td class="catbg" align="center" height="28" >'.$txt['smfg_product_rating'].'</td>
                <td class="catbg" align="center" height="28" >'.$txt['smfg_price'].'</td>
            </tr>';
            while(isset($context['shops'][$count]['vid'])) {
                // Set class for alternating bgcolor
                if($context['bgclass'] == "windowbg") {
                    $context['bgclass'] = "windowbg2";
                } else {
                    $context['bgclass'] = "windowbg";
                }
                echo '
                <tr class="'.$context['bgclass'].'">
                    <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['shops'][$count]['user_id'].'">'.$context['shops'][$count]['memberName'].'</a></td>
                    <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['shops'][$count]['vid'].'">'.garage_title_clean($context['shops'][$count]['vehicle']).'</a></td>
                    <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_modification;VID='.$context['shops'][$count]['vid'].';MID='.$context['shops'][$count]['mid'].'">'.garage_title_clean($context['shops'][$count]['mod_title']).'</a></td>
                    <td align="center" nowrap="nowrap">'.$context['shops'][$count]['purchase_rating'].'</td>
                    <td align="center" nowrap="nowrap">'.$context['shops'][$count]['product_rating'].'</td>
                    <td align="center" nowrap="nowrap">'.$context['shops'][$count]['price'].'</td>
                </tr>';
                $count++;
            }
            } else {
                echo '
                <tr>
                    <td class="windowbg" colspan="6" align="center">'.$txt['smfg_no_customers'].'</td>
                </tr>
                ';
            }
            echo '
            <tr>
                <td class="catbg" colspan="6" height="1"><img src="'. $settings['default_images_url'] . '/spacer.gif" alt="" width="1" height="1" /></td>
            </tr>';
            /* Omitting for now, doesnt make sense to show mod comments on shop review page
            $count = 0;
            if(isset($context['shops'][$count]['comment'])) {
                echo '
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="6">'.$txt['smfg_comments'].'</td>
                </tr>
                <tr>
                    <td class="windowbg" colspan="6" align="left"><span class="smalltext">';
                while(isset($context['shops'][$count]['comment'])) {
                echo $context['shops'][$count]['memberName'].' -&gt; '.$context['shops'][$count]['comment'].'<br />';
                $count++;    
                }
                echo '</span></td>
                </tr>';
            }*/
            echo '
            </table>
        </td>
    </tr>
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="left">&nbsp;</td>
    </tr>
</table>';
    
    echo smfg_footer();

}

function template_garages()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
        if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

echo '

<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="left">';
            echo $txt['139'].': '.$context['page_index'];
            echo '</td>
    </tr>
    <tr>
        <td class="windowbg">
        <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
        $count = 0;
        if(isset($context['garages'][$count]['bid'])) {
            while(isset($context['garages'][$count]['bid'])) {

            echo'
                <tr>
                    <td height="25" colspan="8" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center"><a href="'.$scripturl.'?action=garage;sa=garage_review;BID='.$context['garages'][$count]['bid'].'">'.garage_title_clean($context['garages'][$count]['title']).'</a></td>
                </tr>        
                <tr>
                      <td class="windowbg" height="25" colspan="8" >
                    <b>'.$txt['smfg_business_name'].': </b><a href="'.$scripturl.'?action=garage;sa=garage_review;BID='.$context['garages'][$count]['bid'].'">'.garage_title_clean($context['garages'][$count]['title']).'</a>
                    &nbsp;&nbsp;<span class="smalltext">'.$txt['smfg_click_for_detail'].'</span>
                     <br /><b>'.$txt['smfg_address'].': </b>'.$context['garages'][$count]['address'].'
                    <br /><b>'.$txt['smfg_telephone_no'].': </b>'.$context['garages'][$count]['telephone'].'
                    <br /><b>'.$txt['smfg_fax'].': </b>'.$context['garages'][$count]['fax'].'
                    <br /><b>'.$txt['smfg_website'].': </b>', (!empty($context['garages'][$count]['website'])) ? '<a href="'.$context['garages'][$count]['website'].'" target="_blank">'.$context['garages'][$count]['website'].'</a>' : '' ,'
                    <br /><b>'.$txt['smfg_email'].': </b>'.$context['garages'][$count]['email'].'
                    <br /><b>'.$txt['smfg_opening_hours'].': </b>'.$context['garages'][$count]['opening_hours'];
                    if($context['garages'][$count]['total_poss_rating']) {
                        if($smfgSettings['rating_system'] == 0)
                            echo '<br /><b>'.$txt['smfg_rating'].': </b>'.$context['garages'][$count]['total_rating'].'/'.$context['garages'][$count]['total_poss_rating'].'</td>';
                        else if($smfgSettings['rating_system'] == 1)
                            echo '<br /><b>'.$txt['smfg_rating'].': </b>'.$context['garages'][$count]['total_rating'].'/10 ('.$txt['smfg_rated'].' '.($context['garages'][$count]['total_poss_rating']/10).' '.$txt['smfg_times'].')</td>';
                    } else {
                        echo '<br /><b>'.$txt['smfg_rating'].': </b>'.$txt['smfg_not_rated'].'</td>';
                    }
                echo '
                 </tr>
                 <tr>
                    <td class="titlebg" align="center" height="28" colspan="6">'.$txt['smfg_latest_customers'].'</td>
                </tr>';
                $count2 = 0;
                $count3 = 0;
                if(isset($context['garages']['mods'][$count][$count2]['vid']) || isset($context['garages']['services'][$count][$count2]['vid'])) {
                    echo '
                    <tr>
                        <td class="catbg" align="center" height="28" >'.$txt['smfg_owner'].'</td>
                        <td class="catbg" align="center" height="28" >'.$txt['smfg_vehicle'].'</td>
                        <td class="catbg" align="center" height="28" >'.$txt['smfg_modification'].'&nbsp;/&nbsp;'.$txt['smfg_services'].'</td>
                        <td class="catbg" align="center" height="28" >'.$txt['smfg_rating'].'</td>
                    </tr>';
                    if(isset($context['garages']['mods'][$count][$count2]['vid'])) {
                        while(isset($context['garages']['mods'][$count][$count2]['vid'])) {
                            // Set class for alternating bgcolor
                            if($context['bgclass'] == "windowbg") {
                                $context['bgclass'] = "windowbg2";
                            } else {
                                $context['bgclass'] = "windowbg";
                            }
                            echo '
                            <tr class="'.$context['bgclass'].'">
                                <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['garages']['mods'][$count][$count2]['user_id'].'">'.$context['garages']['mods'][$count][$count2]['memberName'].'</a></td>
                                <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['garages']['mods'][$count][$count2]['vid'].'">'.garage_title_clean($context['garages']['mods'][$count][$count2]['vehicle']).'</a></td>
                                <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_modification;VID='.$context['garages']['mods'][$count][$count2]['vid'].';MID='.$context['garages']['mods'][$count][$count2]['mid'].'">'.garage_title_clean($context['garages']['mods'][$count][$count2]['mod_title']).'</a></td>
                                <td align="center" nowrap="nowrap">'.$context['garages']['mods'][$count][$count2]['install_rating'].'</td>
                            </tr>';
                            $count2++;
                        }
                    }
                    if(isset($context['garages']['services'][$count][$count3]['vid'])) {
                        while(isset($context['garages']['services'][$count][$count3]['vid'])) {
                            // Set class for alternating bgcolor
                            if($context['bgclass'] == "windowbg") {
                                $context['bgclass'] = "windowbg2";
                            } else {
                                $context['bgclass'] = "windowbg";
                            }
                            echo '
                            <tr class="'.$context['bgclass'].'">
                                <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['garages']['services'][$count][$count3]['user_id'].'">'.$context['garages']['services'][$count][$count3]['memberName'].'</a></td>
                                <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['garages']['services'][$count][$count3]['vid'].'">'.garage_title_clean($context['garages']['services'][$count][$count3]['vehicle']).'</a></td>
                                <td align="center" nowrap="nowrap">'.$context['garages']['services'][$count][$count3]['service_type'].'</td>
                                <td align="center" nowrap="nowrap">'.$context['garages']['services'][$count][$count3]['rating'].'</td>
                            </tr>';
                            $count3++;
                        }
                    }
                    } else {
                    echo '
                    <tr>
                        <td class="windowbg" colspan="6" align="center">'.$txt['smfg_no_customers'].'</td>
                    </tr>
                    ';
                }
                $count++;
                echo '
                <tr>
                    <td class="catbg" colspan="6" height="1"><img src="'. $settings['default_images_url'] . '/spacer.gif" alt="" width="1" height="1" /></td>
                </tr>';
            } 
        } else {
            echo '
                    <tr class="windowbg">
                        <td align="center">'.$txt['smfg_no_garages'].'</td>
                    </tr>';
        }
            echo '
        </table>
        </td>
    </tr>
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="left">
        <table width="100%">
            <tr>
                <td align="left">';
                echo $txt['139'].': '.$context['page_index'];
                echo '</td>
                <td align="right">[&nbsp;'.$context['total'].'&nbsp;'.$txt['smfg_businesses_lower'].'&nbsp;]&nbsp;</td>
            </tr>
        </table>
        </td>
    </tr>
</table>';
    
    echo smfg_footer();

}

function template_garage_review()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

echo '

<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center">&nbsp;</td>
    </tr>
    <tr>
        <td class="windowbg">
        <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">
            <tr>
                <td height="25" colspan="8" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center">'.$context['garages']['title'].'</td>
            </tr>';
            $count = 0;

            echo '     
            <tr>
                <td class="windowbg" height="25" colspan="8" >
                <b>'.$txt['smfg_business_name'].': </b>'.$context['garages']['title'].'
                <br /><b>'.$txt['smfg_address'].': </b>'.$context['garages']['address'].'
                <br /><b>'.$txt['smfg_telephone_no'].': </b>'.$context['garages']['telephone'].'
                <br /><b>'.$txt['smfg_fax'].':</b>'.$context['garages']['fax'].'
                <br /><b>'.$txt['smfg_website'].': </b>', (!empty($context['garages']['website'])) ? '<a href="'.$context['garages']['website'].'" target="_blank">'.$context['garages']['website'].'</a>' : '' ,'
                <br /><b>'.$txt['smfg_email'].': </b>'.$context['garages']['email'].'
                <br /><b>'.$txt['smfg_opening_hours'].': </b>'.$context['garages']['opening_hours'];
                if($context['garages']['total_poss_rating']) {
                    if($smfgSettings['rating_system'] == 0)
                        echo '<br /><b>'.$txt['smfg_rating'].': </b>'.$context['garages']['total_rating'].'/'.$context['garages']['total_poss_rating'].'</td>';
                    else if($smfgSettings['rating_system'] == 1)
                        echo '<br /><b>'.$txt['smfg_rating'].': </b>'.$context['garages']['total_rating'].'/10 ('.$txt['smfg_rated'].' '.($context['garages']['total_poss_rating']/10).' '.$txt['smfg_times'].')</td>';
                } else {
                    echo '<br /><b>'.$txt['smfg_rating'].': </b>'.$txt['smfg_not_rated'].'</td>';
                }
            echo '
            </tr>
            <tr>
                <td class="titlebg" align="center" height="28" colspan="6">'.$txt['smfg_latest_customers'].'</td>
            </tr>';
            $count2 = 0;
            if(isset($context['garages']['mods'][$count]['vid']) || isset($context['garages']['services'][$count]['vid'])) {
                echo '
                <tr>
                    <td class="catbg" align="center" height="28" >'.$txt['smfg_owner'].'</td>
                    <td class="catbg" align="center" height="28" >'.$txt['smfg_vehicle'].'</td>
                    <td class="catbg" align="center" height="28" >'.$txt['smfg_modification'].'&nbsp;/&nbsp;'.$txt['smfg_services'].'</td>
                    <td class="catbg" align="center" height="28" >'.$txt['smfg_rating'].'</td>
                </tr>';
                if(isset($context['garages']['mods'][$count]['vid'])) {
                    while(isset($context['garages']['mods'][$count]['vid'])) {
                        // Set class for alternating bgcolor
                        if($context['bgclass'] == "windowbg") {
                            $context['bgclass'] = "windowbg2";
                        } else {
                            $context['bgclass'] = "windowbg";
                        }
                        echo '
                        <tr class="'.$context['bgclass'].'">
                            <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['garages']['mods'][$count]['user_id'].'">'.$context['garages']['mods'][$count]['memberName'].'</a></td>
                            <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['garages']['mods'][$count]['vid'].'">'.garage_title_clean($context['garages']['mods'][$count]['vehicle']).'</a></td>
                            <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_modification;VID='.$context['garages']['mods'][$count]['vid'].';MID='.$context['garages']['mods'][$count]['mid'].'">'.garage_title_clean($context['garages']['mods'][$count]['mod_title']).'</a></td>
                            <td align="center" nowrap="nowrap">'.$context['garages']['mods'][$count]['install_rating'].'</td>
                        </tr>';
                        $count++;
                    }
                }
                if(isset($context['garages']['services'][$count2]['vid'])) {
                    while(isset($context['garages']['services'][$count2]['vid'])) {
                        // Set class for alternating bgcolor
                        if($context['bgclass'] == "windowbg") {
                            $context['bgclass'] = "windowbg2";
                        } else {
                            $context['bgclass'] = "windowbg";
                        }
                        echo '
                        <tr class="'.$context['bgclass'].'">
                            <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['garages']['services'][$count2]['user_id'].'">'.$context['garages']['services'][$count2]['memberName'].'</a></td>
                            <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['garages']['services'][$count2]['vid'].'">'.garage_title_clean($context['garages']['services'][$count2]['vehicle']).'</a></td>
                            <td align="center" nowrap="nowrap">'.$context['garages']['services'][$count2]['service_type'].'</td>
                            <td align="center" nowrap="nowrap">'.$context['garages']['services'][$count2]['rating'].'</td>
                        </tr>';
                        $count2++;
                    }
                }
                } else {
                echo '
                <tr>
                    <td class="windowbg" colspan="6" align="center">'.$txt['smfg_no_customers'].'</td>
                </tr>
                ';
            }
            echo '
            <tr>
                <td class="catbg" colspan="6" height="1"><img src="'. $settings['default_images_url'] . '/spacer.gif" alt="" width="1" height="1" /></td>
            </tr>';
            $count = 0;
            if(!empty($context['garages']['mods'][$count]['comment'])) {
                echo '
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="6">'.$txt['smfg_comments'].'</td>
                </tr>
                <tr>
                    <td class="windowbg" colspan="6" align="left">';
                // Loop through the num of results and only show the ones with a comment
                while($count < $context['garages']['mods']['total']) {
                    if($context['garages']['mods'][$count]['comment'] != "") 
                    {
                        $context['garages']['mods'][$count]['comment_str'] = '<a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['garages']['mods'][$count]['user_id'].'">'.$context['garages']['mods'][$count]['memberName'].'</a> -&gt; <a href="'.$scripturl.'?action=garage;sa=view_modification;VID='.$context['garages']['mods'][$count]['vid'].';MID='.$context['garages']['mods'][$count]['mid'].'">'.garage_title_clean($context['garages']['mods'][$count]['mod_title']).'</a> -&gt; '.$context['garages']['mods'][$count]['comment'].'<br />';
                        echo '<span class="smalltext">'.$context['garages']['mods'][$count]['comment_str'].'</span>';
                    }
                $count++;    
                }
                echo '</td>
                </tr>';
            }
            echo '
        </table>
        </td>
    </tr>
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="left">&nbsp;</td>
    </tr>
</table>';
    
    echo smfg_footer();

}

function template_manufacturer_review()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

echo '

<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center">&nbsp;</td>
    </tr>
    <tr>
        <td class="windowbg">
        <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor"><tr>
                  <td height="25" colspan="8" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center">'.$context['mfg']['title'].'</td>
            </tr>';
            $count = 0;

            echo '
            <tr>
                <td class="windowbg" height="25" colspan="8" ><b>'.$txt['smfg_business_name'].': </b>'.$context['mfg']['title'].'
                <br /><b>'.$txt['smfg_address'].': </b>'.$context['mfg']['address'].'
                <br /><b>'.$txt['smfg_telephone_no'].': </b>'.$context['mfg']['telephone'].'
                <br /><b>'.$txt['smfg_fax'].':</b>'.$context['mfg']['fax'].'
                <br /><b>'.$txt['smfg_website'].': </b>', (!empty($context['mfg']['website'])) ? '<a href="'.$context['mfg']['website'].'" target="_blank">'.$context['mfg']['website'].'</a>' : '' ,'
                <br /><b>'.$txt['smfg_email'].': </b>'. $context['mfg']['email'] .'
                <br /><b>'.$txt['smfg_opening_hours'].': </b>'.$context['mfg']['opening_hours'];
                if($context['mfg']['total_poss_rating']) {
                    if($smfgSettings['rating_system'] == 0)
                        echo '<br /><b>'.$txt['smfg_rating'].': </b>'.$context['mfg']['total_rating'].'/'.$context['mfg']['total_poss_rating'].'</td>';
                    else if($smfgSettings['rating_system'] == 1)
                        echo '<br /><b>'.$txt['smfg_rating'].': </b>'.$context['mfg']['total_rating'].'/10 ('.$txt['smfg_rated'].' '.($context['mfg']['total_poss_rating']/10).' '.$txt['smfg_times'].'</td>';
                } else {
                    echo '<br /><b>'.$txt['smfg_rating'].': </b>'.$txt['smfg_not_rated'].'</td>';
                }
            echo '
            </tr>
            <tr>
                <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg' ,'" align="center" height="28" colspan="6">'.$txt['smfg_latest_customers'].'</td>
            </tr>';
            if(isset($context['mfg'][$count]['vid'])) {
            echo '
            <tr>
                <td class="catbg" align="center" height="28" >'.$txt['smfg_owner'].'</td>
                <td class="catbg" align="center" height="28" >'.$txt['smfg_vehicle'].'</td>
                <td class="catbg" align="center" height="28" >'.$txt['smfg_modification'].'</td>
                <td class="catbg" align="center" height="28" >'.$txt['smfg_purchase_rating'].'</td>
                <td class="catbg" align="center" height="28" >'.$txt['smfg_product_rating'].'</td>
                <td class="catbg" align="center" height="28" >'.$txt['smfg_price'].'</td>
            </tr>';
            while(isset($context['mfg'][$count]['vid'])) {
                // Set class for alternating bgcolor
                if($context['bgclass'] == "windowbg") {
                    $context['bgclass'] = "windowbg2";
                } else {
                    $context['bgclass'] = "windowbg";
                }
                echo '
                <tr class="'.$context['bgclass'].'">
                    <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['mfg'][$count]['user_id'].'">'.$context['mfg'][$count]['memberName'].'</a></td>
                    <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['mfg'][$count]['vid'].'">'.garage_title_clean($context['mfg'][$count]['vehicle']).'</a></td>
                    <td align="center" nowrap="nowrap"><a href="'.$scripturl.'?action=garage;sa=view_modification;VID='.$context['mfg'][$count]['vid'].';MID='.$context['mfg'][$count]['mid'].'">'.garage_title_clean($context['mfg'][$count]['mod_title']).'</a></td>
                    <td align="center" nowrap="nowrap">'.$context['mfg'][$count]['purchase_rating'].'</td>
                    <td align="center" nowrap="nowrap">'.$context['mfg'][$count]['product_rating'].'</td>
                    <td align="center" nowrap="nowrap">'.$context['mfg'][$count]['price'].'</td>
                </tr>';
                $count++;
            }
            } else {
                echo '
                <tr>
                    <td class="windowbg" colspan="6" align="center">'.$txt['smfg_no_customers'].'</td>
                </tr>
                ';
            }
            echo '
            <tr>
                <td class="catbg" colspan="6" height="1"><img src="'. $settings['default_images_url'] . '/spacer.gif" alt="" width="1" height="1" /></td>
            </tr>';
            /* Omitting for now, doesnt make sense to show mod comments on shop review page
            $count = 0;
            if(isset($context['mfg'][$count]['comment'])) {
                echo '
                <tr>
                    <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28" colspan="6">'.$txt['smfg_comments'].'</td>
                </tr>
                <tr>
                    <td class="windowbg" colspan="6" align="left"><span class="smalltext">';
                while(isset($context['mfg'][$count]['comment'])) {
                echo $context['mfg'][$count]['memberName'].' -&gt; '.$context['mfg'][$count]['comment'].'<br />';
                $count++;    
                }
                echo '</span></td>
                </tr>';
            }*/
            echo '
            </table>
        </td>
    </tr>
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="left">&nbsp;</td>
    </tr>
</table>';
    
    echo smfg_footer();

}

function template_dynocenter_review()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }

echo '

<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center">&nbsp;</td>
    </tr>
    <tr>
        <td class="windowbg">
        <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor"><tr>
                  <td height="25" colspan="8" class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center">'.$context['dc']['title'].'</td>
            </tr>';
            $count = 0;

            echo '
            <tr>
                <td class="windowbg" height="25" colspan="8" ><b>'.$txt['smfg_business_name'].': </b>'.$context['dc']['title'].'
                <br /><b>'.$txt['smfg_address'].': </b>'.$context['dc']['address'].'
                <br /><b>'.$txt['smfg_telephone_no'].': </b>'.$context['dc']['telephone'].'
                <br /><b>'.$txt['smfg_fax'].':</b>'.$context['dc']['fax'].'
                <br /><b>'.$txt['smfg_website'].': </b>', (!empty($context['dc']['website'])) ? '<a href="'.$context['dc']['website'].'" target="_blank">'.$context['dc']['website'].'</a>' : '' ,'
                <br /><b>'.$txt['smfg_email'].': </b>'. $context['dc']['email'] .'
                <br /><b>'.$txt['smfg_opening_hours'].': </b>'.$context['dc']['opening_hours'].'
            </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="left">&nbsp;</td>
    </tr>
</table>';
    
    echo smfg_footer();

}

function template_browse_tables()
{
global $context, $settings, $options, $txt, $scripturl, $smfgSettings;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }
    
echo '

<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="left">';
            echo $txt['139'].': '.$context['page_index'];
            echo '</td>
    </tr>
    <tr>
        <td class="windowbg">';
        
        // Display as - Vehicles
        if($context['browse_type'] == "vehicles") {
            echo '
            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
            $count = 0;
            if(isset($context['browse_tables'][$count]['vid'])) {
                echo '
                <tr>
                <td class="catbg" align="center" nowrap="nowrap">&nbsp;</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byYear'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byMake'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byModel'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byColor'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byOwner'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byViews'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byMods'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byUpdated'].'</td>
                </tr>';
                while(isset($context['browse_tables'][$count]['vid'])) {
                    // Set class for alternating bgcolor
                    if($context['bgclass'] == "windowbg") {
                        $context['bgclass'] = "windowbg2";
                    } else {
                        $context['bgclass'] = "windowbg";
                    }
                echo '
                <tr class="'.$context['bgclass'].'">
                <td align="center" style="width: 25px;  white-space: nowrap;">'.$context['browse_tables'][$count]['image'].$context['browse_tables'][$count]['spacer'].$context['browse_tables'][$count]['video'].'</td>
                <td align="center">'.$context['browse_tables'][$count]['made_year'].'</td>
                <td align="center">'.$context['browse_tables'][$count]['make'].'</td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['browse_tables'][$count]['vid'].'">'.garage_title_clean($context['browse_tables'][$count]['model']).'</a></td>
                <td align="center">'.$context['browse_tables'][$count]['color'].'</td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['browse_tables'][$count]['user_id'].'">'.$context['browse_tables'][$count]['memberName'].'</a></td>
                <td align="center">'.$context['browse_tables'][$count]['views'].'</td>
                <td align="center">'.$context['browse_tables'][$count]['total_mods'].'</td>
                <td align="center">'.date($context['date_format'],$context['browse_tables'][$count]['date_updated']).'</td>
                </tr>';
                $count++;
                }
            } else {
                echo '
                <tr class="windowbg">
                <td colspan="9" align="center">'.$txt['smfg_no_vehicle_results'].'</td>
                </tr>';
            }        
            echo '
            </table>';
        }
        
        // Display as - Modifications
        if($context['browse_type'] == "modifications") {
            echo '
            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
            $count = 0;
            if(isset($context['browse_tables'][$count]['vid'])) {
                echo '
                <tr>
                <td class="catbg" align="center" nowrap="nowrap">&nbsp;</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byYear'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byMake'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byModel'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byOwner'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byMod'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byUpdated'].'</td>
                </tr>';
                while(isset($context['browse_tables'][$count]['vid'])) {
                    // Set class for alternating bgcolor
                    if($context['bgclass'] == "windowbg") {
                        $context['bgclass'] = "windowbg2";
                    } else {
                        $context['bgclass'] = "windowbg";
                    }
                echo '
                <tr class="'.$context['bgclass'].'">
                <td align="center" style="width: 25px;  white-space: nowrap;">'.$context['browse_tables'][$count]['image'].$context['browse_tables'][$count]['spacer'].$context['browse_tables'][$count]['video'].'</td>
                <td align="center">'.$context['browse_tables'][$count]['made_year'].'</td>
                <td align="center">'.$context['browse_tables'][$count]['make'].'</td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['browse_tables'][$count]['vid'].'">'.garage_title_clean($context['browse_tables'][$count]['model']).'</a></td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['browse_tables'][$count]['user_id'].'">'.$context['browse_tables'][$count]['memberName'].'</a></td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_modification;VID='.$context['browse_tables'][$count]['vid'].';MID='.$context['browse_tables'][$count]['mid'].'" title="'.$context['browse_tables'][$count]['mod_tooltip'].'" class="smfg_videoTitle">'.garage_title_clean($context['browse_tables'][$count]['modification']).'</td>
                <td align="center">'.date($context['date_format'],$context['browse_tables'][$count]['date_updated']).'</td>
                </tr>';
                $count++;
                }
            } else {
                echo '
                <tr class="windowbg">
                <td colspan="9" align="center">'.$txt['smfg_no_modification_results'].'</td>
                </tr>';
            }        
            echo '
            </table>';    
        }
        
        // Display as - Quartermiles
        if($context['browse_type'] == "quartermiles") {
            echo '
            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
            $count = 0;
            if(isset($context['browse_tables'][$count]['qmid'])) {
                echo '
                    <tr>
                        <td class="catbg" nowrap="nowrap">&nbsp;</td>
                        <td class="catbg" nowrap="nowrap">'.$context['sort']['byUsername'].'</td>
                        <td class="catbg" nowrap="nowrap">'.$context['sort']['byVehicle'].'</td>
                        <td class="catbg" nowrap="nowrap">'.$context['sort']['byRt'].'</td>
                        <td class="catbg" nowrap="nowrap">'.$context['sort']['bySixty'].'</td>
                        <td class="catbg" nowrap="nowrap">'.$context['sort']['byThree'].'</td>
                        <td class="catbg" nowrap="nowrap">'.$context['sort']['byEighth'].'</td>
                        <td class="catbg" nowrap="nowrap">'.$context['sort']['byThou'].'</td>
                        <td class="catbg" nowrap="nowrap">'.$context['sort']['byQuart'].'</td>
                    </tr>';
                    while(isset($context['browse_tables'][$count]['qmid'])) {
                        // Set class for alternating bgcolor
                        if($context['bgclass'] == "windowbg") {
                            $context['bgclass'] = "windowbg2";
                        } else {
                            $context['bgclass'] = "windowbg";
                        }
                        echo '
                        <tr class="'.$context['bgclass'].'">
                            <td align="center" style="width: 25px;  white-space: nowrap;">'.$context['browse_tables'][$count]['image'].$context['browse_tables'][$count]['spacer'].$context['browse_tables'][$count]['video'].'</td>
                            <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['browse_tables'][$count]['user_id'].'">'.$context['browse_tables'][$count]['memberName'].'</a></td>
                            <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['browse_tables'][$count]['vid'].'">'.garage_title_clean($context['browse_tables'][$count]['vehicle']).'</a></td>
                            <td align="center">'.$context['browse_tables'][$count]['rt'].'</td>
                            <td align="center">'.$context['browse_tables'][$count]['sixty'].'</td>
                            <td align="center">'.$context['browse_tables'][$count]['three'].'</td>
                            <td align="center">'.$context['browse_tables'][$count]['eighth'].'&nbsp;&#64;&nbsp;'.$context['browse_tables'][$count]['eighthmph'].'</td>
                            <td align="center">'.$context['browse_tables'][$count]['thou'].'</td>
                            <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_quartermile;VID='.$context['browse_tables'][$count]['vid'].';QID='.$context['browse_tables'][$count]['qmid'].'">'.garage_title_clean($context['browse_tables'][$count]['quart']).'&nbsp;&#64;&nbsp;'.garage_title_clean($context['browse_tables'][$count]['quartmph']).'</a></td>
                        </tr>';
                        $count++;
                    }            
            } else {
                echo '
                    <tr class="windowbg">
                        <td colspan="9" align="center">'.$txt['smfg_no_quartermile_results'].'</td>
                    </tr>';
            }            
                echo '
            </table>';
        }
        
        
        // Display as - Dynoruns
        if($context['browse_type'] == "dynoruns") {
        echo '
        <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
        $count = 0;
        if(isset($context['browse_tables'][$count]['vid'])) {
        echo '
                <tr> 
                    <td class="catbg" nowrap="nowrap">&nbsp;</td>
                    <td class="catbg" nowrap="nowrap">'.$context['sort']['byOwner'].'</td>
                    <td class="catbg" nowrap="nowrap">'.$context['sort']['byVehicle'].'</td>
                    <td class="catbg" nowrap="nowrap">'.$context['sort']['byDynocenter'].'</td>
                    <td class="catbg" nowrap="nowrap">'.$context['sort']['byBhp'].'</td>
                    <td class="catbg" nowrap="nowrap">'.$context['sort']['byTorque'].'</td>
                    <td class="catbg" nowrap="nowrap">'.$context['sort']['byBoost'].'</td>
                    <td class="catbg" nowrap="nowrap">'.$context['sort']['byNitrous'].'</td>
                    <td class="catbg" nowrap="nowrap">'.$context['sort']['byPeakpoint'].'</td>
                </tr>';
            while(isset($context['browse_tables'][$count]['vid'])) { 
                    // Set class for alternating bgcolor
                    if($context['bgclass'] == "windowbg") {
                        $context['bgclass'] = "windowbg2";
                    } else {
                        $context['bgclass'] = "windowbg";
                    }
                    echo '
                    <tr class="'.$context['bgclass'].'">
                        <td align="center" style="width: 25px;  white-space: nowrap;">'.$context['browse_tables'][$count]['image'].$context['browse_tables'][$count]['spacer'].$context['browse_tables'][$count]['video'].'</td>
                        <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['browse_tables'][$count]['user_id'].'">'.$context['browse_tables'][$count]['memberName'].'</a></td>
                        <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['browse_tables'][$count]['vid'].'" >'.garage_title_clean($context['browse_tables'][$count]['vehicle']).'</a></td>
                        <td align="center"><a href="'.$scripturl.'?action=garage;sa=dc_review;BID='.$context['browse_tables'][$count]['dynocenter_id'].'">'.garage_title_clean($context['browse_tables'][$count]['dynocenter']).'</a></td>
                        <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_dynorun;VID='.$context['browse_tables'][$count]['vid'].';DID='.$context['browse_tables'][$count]['did'].'">'.garage_title_clean($context['browse_tables'][$count]['bhp']).' '.garage_title_clean($context['browse_tables'][$count]['bhp_unit']).'</a></td>
                        <td align="center">'.$context['browse_tables'][$count]['torque'].' '.$context['browse_tables'][$count]['torque_unit'].'</td>
                        <td align="center">'.$context['browse_tables'][$count]['boost'].' '.$context['browse_tables'][$count]['boost_unit'].'</td>
                        <td align="center">'.$context['browse_tables'][$count]['nitrous'].' Shot</td>
                        <td align="center">'.$context['browse_tables'][$count]['peakpoint'].' RPM</td>
                    </tr>';
                    $count++;
            }
        } else {
            echo '
                <tr class="windowbg">
                    <td colspan="9" align="center">'.$txt['smfg_no_dynorun_results'].'</td>
                </tr>';
        }                
        echo '
            </table>';
        }
        
        
        // Display as - Laps
        if($context['browse_type'] == "laps") {
            echo '
        <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
        $count = 0;
        if(isset($context['browse_tables'][$count]['lid'])) {
        echo '
            <tr>
                <td class="catbg">&nbsp;</td>
                <td class="catbg" nowrap="nowrap">'.$context['sort']['byOwner'].'</td>
                <td class="catbg" nowrap="nowrap">'.$context['sort']['byVehicle'].'</td>
                <td class="catbg">'.$context['sort']['byTrack'].'</td>
                <td class="catbg">'.$context['sort']['byCondition'].'</td>
                <td class="catbg">'.$context['sort']['byType'].'</td>
                <td class="catbg">'.$context['sort']['byTime'].'</td>
            </tr>';
            while(isset($context['browse_tables'][$count]['lid'])) {
                // Set class for alternating bgcolor
                if($context['bgclass'] == "windowbg") {
                    $context['bgclass'] = "windowbg2";
                } else {
                    $context['bgclass'] = "windowbg";
                }
                echo '
                <tr class="'.$context['bgclass'].'">
                    <td align="center" style="width: 25px;  white-space: nowrap;">'.$context['browse_tables'][$count]['image'].'&nbsp;'.$context['browse_tables'][$count]['video'].'</td>
                    <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['browse_tables'][$count]['user_id'].'">'.$context['browse_tables'][$count]['memberName'].'</a></td>
                    <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['browse_tables'][$count]['vid'].'">'.garage_title_clean($context['browse_tables'][$count]['vehicle']).'</a></td>
                    <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_track;TID='.$context['browse_tables'][$count]['tid'].'">'.garage_title_clean($context['browse_tables'][$count]['track']).'</a></td>
                    <td align="center">'.$context['browse_tables'][$count]['condition'].'</td>
                    <td align="center">'.$context['browse_tables'][$count]['type'].'</td>
                    <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_laptime;VID='.$context['browse_tables'][$count]['vid'].';LID='.$context['browse_tables'][$count]['lid'].'">'.garage_title_clean($context['browse_tables'][$count]['time']).'</a></td>
                </tr>';
                $count++;
            }            
        } else {
            echo '
                <tr class="windowbg">
                    <td colspan="9" align="center">'.$txt['smfg_no_lap_results'].'</td>
                </tr>';
        }
            echo'
        </table>';  
        }
        
        // Display as - Most Modified
        if($context['browse_type'] == "mostmodified") {
            echo '
            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
            $count = 0;
            if(isset($context['browse_tables'][$count]['vid'])) {
                echo '
                <tr>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byYear'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byMake'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byModel'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byOwner'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byMods'].'</td>
                </tr>';
                while(isset($context['browse_tables'][$count]['vid'])) {
                    // Set class for alternating bgcolor
                    if($context['bgclass'] == "windowbg") {
                        $context['bgclass'] = "windowbg2";
                    } else {
                        $context['bgclass'] = "windowbg";
                    }
                echo '
                <tr class="'.$context['bgclass'].'">
                <td align="center">'.$context['browse_tables'][$count]['made_year'].'</td>
                <td align="center">'.$context['browse_tables'][$count]['make'].'</td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['browse_tables'][$count]['vid'].'">'.garage_title_clean($context['browse_tables'][$count]['model']).'</a></td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['browse_tables'][$count]['user_id'].'">'.$context['browse_tables'][$count]['memberName'].'</a></td>
                <td align="center">'.$context['browse_tables'][$count]['total_mods'].'</td>
                </tr>';
                $count++;
                }
            } else {
                echo '
                <tr class="windowbg">
                <td colspan="9" align="center">'.$txt['smfg_no_vehicle_results'].'</td>
                </tr>';
            }        
            echo '
            </table>';    
        }
        
        // Display as - Most Viewed
        if($context['browse_type'] == "mostviewed") {
            echo '
            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
            $count = 0;
            if(isset($context['browse_tables'][$count]['vid'])) {
                echo '
                <tr>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byYear'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byMake'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byModel'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byOwner'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byViews'].'</td>
                </tr>';
                while(isset($context['browse_tables'][$count]['vid'])) {
                    // Set class for alternating bgcolor
                    if($context['bgclass'] == "windowbg") {
                        $context['bgclass'] = "windowbg2";
                    } else {
                        $context['bgclass'] = "windowbg";
                    }
                echo '
                <tr class="'.$context['bgclass'].'">
                <td align="center">'.$context['browse_tables'][$count]['made_year'].'</td>
                <td align="center">'.$context['browse_tables'][$count]['make'].'</td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['browse_tables'][$count]['vid'].'">'.garage_title_clean($context['browse_tables'][$count]['model']).'</a></td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['browse_tables'][$count]['user_id'].'">'.$context['browse_tables'][$count]['memberName'].'</a></td>
                <td align="center">'.$context['browse_tables'][$count]['views'].'</td>
                </tr>';
                $count++;
                }
            } else {
                echo '
                <tr class="windowbg">
                <td colspan="9" align="center">'.$txt['smfg_no_vehicle_results'].'</td>
                </tr>';
            }        
            echo '
            </table>';    
        }      
        
        // Display as - Latest Service
        if($context['browse_type'] == "latestservice") {
            echo '
            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
            $count = 0;
            if(isset($context['browse_tables'][$count]['vid'])) {
                echo '
                <tr>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byYear'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byMake'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byModel'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byOwner'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byType'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byCreated'].'</td>
                </tr>';
                while(isset($context['browse_tables'][$count]['vid'])) {
                    // Set class for alternating bgcolor
                    if($context['bgclass'] == "windowbg") {
                        $context['bgclass'] = "windowbg2";
                    } else {
                        $context['bgclass'] = "windowbg";
                    }
                echo '
                <tr class="'.$context['bgclass'].'">
                <td align="center">'.$context['browse_tables'][$count]['made_year'].'</td>
                <td align="center">'.$context['browse_tables'][$count]['make'].'</td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['browse_tables'][$count]['vid'].'">'.garage_title_clean($context['browse_tables'][$count]['model']).'</a></td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['browse_tables'][$count]['user_id'].'">'.$context['browse_tables'][$count]['memberName'].'</a></td>
                <td align="center">'.$context['browse_tables'][$count]['type'].'</td>
                <td align="center">'.date($context['date_format'],$context['browse_tables'][$count]['created']).'</td>
                </tr>';
                $count++;
                }
            } else {
                echo '
                <tr class="windowbg">
                <td colspan="9" align="center">'.$txt['smfg_no_vehicle_results'].'</td>
                </tr>';
            }        
            echo '
            </table>';    
        }
        
        // Display as - Top Rated
        if($context['browse_type'] == "toprated") {
            echo '
            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
            $count = 0;
            if(isset($context['browse_tables'][$count]['vid'])) {
                echo '
                <tr>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byYear'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byMake'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byModel'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byOwner'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byRating'].'</td>
                </tr>';
                while(isset($context['browse_tables'][$count]['vid'])) {
                    // Set class for alternating bgcolor
                    if($context['bgclass'] == "windowbg") {
                        $context['bgclass'] = "windowbg2";
                    } else {
                        $context['bgclass'] = "windowbg";
                    }
                echo '
                <tr class="'.$context['bgclass'].'">
                <td align="center">'.$context['browse_tables'][$count]['made_year'].'</td>
                <td align="center">'.$context['browse_tables'][$count]['make'].'</td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['browse_tables'][$count]['vid'].'">'.garage_title_clean($context['browse_tables'][$count]['model']).'</a></td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['browse_tables'][$count]['user_id'].'">'.$context['browse_tables'][$count]['memberName'].'</a></td>';
                if($context['browse_tables'][$count]['poss_rating']) {
                    if($smfgSettings['rating_system'] == 0)
                            echo '
                        <td align="center" valign="middle" nowrap="nowrap">'.$context['browse_tables'][$count]['rating'].'/'.$context['browse_tables'][$count]['poss_rating'].'</td>';
                    else if($smfgSettings['rating_system'] == 1)
                            echo '
                        <td align="center" valign="middle" nowrap="nowrap">'.$context['browse_tables'][$count]['rating'].'/10</td>';
                } else {
                            echo '
                        <td align="center" valign="middle" nowrap="nowrap">'.$txt['smfg_vehicle_not_rated'].'</td>';
                }
                echo '</tr>';
                $count++;
                }
            } else {
                echo '
                <tr class="windowbg">
                <td colspan="9" align="center">'.$txt['smfg_no_vehicle_results'].'</td>
                </tr>';
            }        
            echo '
            </table>';    
        }
        
        // Display as - Most Spent
        if($context['browse_type'] == "mostspent") {
            echo '
            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
            $count = 0;
            if(isset($context['browse_tables'][$count]['vid'])) {
                echo '
                <tr>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byYear'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byMake'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byModel'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byOwner'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byTotalSpent'].'</td>
                </tr>';
                while(isset($context['browse_tables'][$count]['vid'])) {
                    // Set class for alternating bgcolor
                    if($context['bgclass'] == "windowbg") {
                        $context['bgclass'] = "windowbg2";
                    } else {
                        $context['bgclass'] = "windowbg";
                    }
                echo '
                <tr class="'.$context['bgclass'].'">
                <td align="center">'.$context['browse_tables'][$count]['made_year'].'</td>
                <td align="center">'.$context['browse_tables'][$count]['make'].'</td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['browse_tables'][$count]['vid'].'">'.garage_title_clean($context['browse_tables'][$count]['model']).'</a></td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['browse_tables'][$count]['user_id'].'">'.$context['browse_tables'][$count]['memberName'].'</a></td>
                <td align="center">'.$context['browse_tables'][$count]['total_spent'].' '.$context['browse_tables'][$count]['currency'].'</td>
                </tr>';
                $count++;
                }
            } else {
                echo '
                <tr class="windowbg">
                <td colspan="9" align="center">'.$txt['smfg_no_vehicle_results'].'</td>
                </tr>';
            }        
            echo '
            </table>';    
        }

        // Display as - Latest Blog
        if($context['browse_type'] == "latestblog") {
            echo '
            <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
            $count = 0;
            if(isset($context['browse_tables'][$count]['vid'])) {
                echo '
                <tr>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byYear'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byMake'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byModel'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byOwner'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byTitle'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byPosted'].'</td>
                </tr>';
                while(isset($context['browse_tables'][$count]['vid'])) {
                    // Set class for alternating bgcolor
                    if($context['bgclass'] == "windowbg") {
                        $context['bgclass'] = "windowbg2";
                    } else {
                        $context['bgclass'] = "windowbg";
                    }
                echo '
                <tr class="'.$context['bgclass'].'">
                <td align="center">'.$context['browse_tables'][$count]['made_year'].'</td>
                <td align="center">'.$context['browse_tables'][$count]['make'].'</td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['browse_tables'][$count]['vid'].'">'.garage_title_clean($context['browse_tables'][$count]['model']).'</a></td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['browse_tables'][$count]['user_id'].'">'.$context['browse_tables'][$count]['memberName'].'</a></td>
                <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['browse_tables'][$count]['vid'].'#blog">'.$context['browse_tables'][$count]['blog_title'].'</a></td>
                <td align="center">'.date($context['date_format'],$context['browse_tables'][$count]['posted_date']).'</td>
                </tr>';
                $count++;
                }
            } else {
                echo '
                <tr class="windowbg">
                <td colspan="9" align="center">'.$txt['smfg_no_blogs_in_garage'].'</td>
                </tr>';
            }        
            echo '
            </table>';    
        }
        
        // Display as - Latest Video
        if($context['browse_type'] == "latestvideo") {
            echo '
        <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';
        $count = 0;
        if(isset($context['browse_tables'][$count]['id'])) {
        echo '
            <tr>
                <td class="catbg">&nbsp;</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byYear'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byMake'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byModel'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byOwner'].'</td>
                <td class="catbg" align="center" nowrap="nowrap">'.$context['sort']['byTitle'].'</td>
            </tr>';
            while(isset($context['browse_tables'][$count]['id'])) {
                // Set class for alternating bgcolor
                if($context['bgclass'] == "windowbg") {
                    $context['bgclass'] = "windowbg2";
                } else {
                    $context['bgclass'] = "windowbg";
                }
                
                switch($context['browse_tables'][$count]['video_type']) {
                    case 'vehicle':
                        $uri = 'sa=view_vehicle;VID='.$context['browse_tables'][$count]['vid'];
                        break;
                    case 'mod':
                        $uri = 'sa=view_modification;VID='.$context['browse_tables'][$count]['vid'].';MID='.$context['browse_tables'][$count]['tid'];
                        break;
                    case 'dynorun':
                        $uri = 'sa=view_dynorun;VID='.$context['browse_tables'][$count]['vid'].';DID='.$context['browse_tables'][$count]['tid'];
                        break;
                    case 'qmile':
                        $uri = 'sa=view_quartermile;VID='.$context['browse_tables'][$count]['vid'].';QID='.$context['browse_tables'][$count]['tid'];
                        break;
                    case 'lap':
                        $uri = 'sa=view_laptime;VID='.$context['browse_tables'][$count]['vid'].';LID='.$context['browse_tables'][$count]['tid'];
                        break;
                }
                
                echo '
                <tr class="'.$context['bgclass'].'">
                    <td align="center" style="width: 25px;  white-space: nowrap;">'.$context['browse_tables'][$count]['video'].'</td>
                    <td align="center">'.$context['browse_tables'][$count]['made_year'].'</td>
                    <td align="center">'.$context['browse_tables'][$count]['make'].'</td>
                    <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_vehicle;VID='.$context['browse_tables'][$count]['vid'].'">'.garage_title_clean($context['browse_tables'][$count]['model']).'</a></td>
                    <td align="center"><a href="'.$scripturl.'?action=garage;sa=view_garage;UID='.$context['browse_tables'][$count]['user_id'].'">'.$context['browse_tables'][$count]['memberName'].'</a></td>
                    <td align="center"><a href="'.$scripturl.'?action=garage;'.$uri.'#videos">'.$context['browse_tables'][$count]['video_title'].'</a></td>
                </tr>';
                $count++;
            }            
        } else {
            echo '
                <tr class="windowbg">
                    <td colspan="9" align="center">'.$txt['smfg_no_videos_in_garage'].'</td>
                </tr>';
        }
            echo'
        </table>';  
        }
        
        echo '</td>
    </tr>
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" height="28">
        <table width="100%">
        <tr>
            <td align="left">';
            echo $txt['139'].': '.$context['page_index'];
            echo '</td>
            <td align="right"><b>[&nbsp;'.$context['total'].'&nbsp;'.$context['browse_type_total'].'&nbsp;]&nbsp;</b></td>
        </tr>
    </table></td>
    </tr>
</table>';
    
    echo smfg_footer();

}

function template_copyright()
{
global $context, $settings, $options, $txt, $scripturl;

    // Show the link tree.
    echo '
    <div style="padding: 3px;">', theme_linktree(), '</div>';

    // Display links to navigate garage.
    if (!empty($smfgSettings['enable_index_menu']))
    if (!empty($settings['use_tabs']))
    {
        echo '
        <table cellpadding="0" cellspacing="0" border="0" style="margin-left: 10px;">
            <tr>
                <td class="mirrortab_first">&nbsp;</td>';

        foreach ($context['sort_links'] as $link)
        {
            if ($link['selected'])
                echo '
                <td class="mirrortab_active_first">&nbsp;</td>
                <td valign="top" class="mirrortab_active_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>
                <td class="mirrortab_active_last">&nbsp;</td>';
            else
                echo '
                <td valign="top" class="mirrortab_back">
                    <a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">', $link['label'], '</a>
                </td>';
        }

        echo '
                <td class="mirrortab_last">&nbsp;</td>
            </tr>
        </table>';
    }
    else
    {
        echo '
        <div class="bordercolor" style="padding: 1px;">
            <div class="titlebg" style="padding: 4px 4px 4px 10px;">';
                $links = array();
                foreach ($context['sort_links'] as $link)
                    $links[] = ($link['selected'] ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '') . '<a href="' . $scripturl . '?action=garage' . (!empty($link['action']) ? ';sa=' . $link['action'] : '') . '">' . $link['label'] . '</a>';

                echo '
                    ', implode(' | ', $links), '
            </div>
        </div>
        <div class="bordercolor" style="padding: 1px">';
    }
    
    echo '
<form action="'.$scripturl.'?action=garage;sa=browse" method="post" style="padding:0; margin:0;">
<table width="100%" border="0" cellspacing="1" cellpadding="4" align="center" class="bordercolor">
    <tr>
        <td class="', empty($settings['use_tabs']) ? 'catbg' : 'titlebg', '" align="center" nowrap="nowrap">' . $txt['smfg_copyright'] . '</td>
    </tr>
<tr>
<td class="windowbg">
    <table border="0" cellpadding="3" cellspacing="1" width="100%" class="bordercolor">';

    
echo '
    <tr class="windowbg">
    <td align="center"><pre>' . $txt['smfg_gnu_license'] . '</pre></td>
    </tr>'; 

echo '
    </table>
</td>
</tr>

<tr>
    <td class="titlebg" align="center" height="28"></td>
</tr>
</table>
</form>';
    
    echo smfg_footer();

}

// This is a blank template for all forwarding actions
function template_blank()
{
  // Nothing to see here folks   
}

?>
