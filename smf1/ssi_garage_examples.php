<?php
/**********************************************************************************
* ssi_garage_examples.php                                                         *
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

require(dirname(__FILE__) . '/SSI_Garage.php');

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title> << :: SMF Garage SSI_Garage.php 0.6.0b2 :: >> </title><?php
        
    ssi_smfg_js_includes();

    echo '
        <meta http-equiv="Content-Type" content="text/html; charset=', $context['character_set'], '" />
        <link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/style.css" />
        <script language="JavaScript" type="text/javascript" src="', $settings['default_theme_url'], '/script.js"></script>
        <style type="text/css">
            body
            {
                margin: 1ex;
            }';

    if ($context['browser']['needs_size_fix'])
        echo '
            @import(', $settings['default_theme_url'], '/fonts-compat.css);';

    echo '
        </style>';

?>
    </head>
    <body>
            <h1>SMF Garage SSI_Garage.php</h1>
            Current Version: 0.6.0b2<br />
            <br />
            This file is used to demonstrate the capabilities of SSI.php using PHP include functions.<br />
            The examples show the include tag, then the results of it. Examples are separated by horizontal rules.<br />
            <br />
            The functions displayed as code below were created to allow you to utilize shadowbox and the theme styles associated with your forum.  They will not return any visible output, only includes so you may put them in  your &lt;head&gt; tags.  In order for shadowbox to work with SSI_Garage.php you <b><u>must</u></b> inlcude at least the javascript function.  The CSS includes are required to utilize the SMF table style.
            <br />

        <hr />

            <br />
            To use SSI_Garage.php, add the following code to the very top of your page before the &lt;html&gt; tag on line 1:<br /><br />
            <div class="code">
            <pre>&lt;?php require(&quot;<?php echo addslashes($user_info['is_admin'] ? realpath($boarddir . '/SSI_Garage.php') : 'SSI_Garage.php'); ?>&quot;); ?&gt;</pre>
            </div>
            
        <hr />

            <h3>Javascript and CSS Includes: ssi_smfg_includes([<i>str</i> $output_method])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'return'&nbsp;-&nbsp;Will return output.
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_includes(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div class="code">
            <pre><?php $ssi_includes = ssi_smfg_includes('return');
            echo str_replace(array('<','>'),array('&lt;','&gt;'),$ssi_includes); flush(); ?></pre>
            </div>

        <hr />

            <h3>CSS Includes: ssi_smfg_css_includes([<i>str</i> $output_method])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'return'&nbsp;-&nbsp;Will return output.
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_css_includes(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div class="code">
            <pre><?php $ssi_css_includes = ssi_smfg_css_includes('return');
            echo str_replace(array('<','>'),array('&lt;','&gt;'),$ssi_css_includes); flush(); ?></pre>
            </div>

        <hr />

            <h3>Javascript Includes: ssi_smfg_js_includes([<i>str</i> $output_method])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'return'&nbsp;-&nbsp;Will return output.
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_js_includes(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div class="code">
            <pre><?php $ssi_js_includes = ssi_smfg_js_includes('return');
            echo str_replace(array('<','>'),array('&lt;','&gt;'),$ssi_js_includes); flush(); ?></pre>
            </div>

        <hr />

            <h3>Featured Vehicle: ssi_smfg_featuredVehicle([<i>int</i> $width [, <i>bool</i> $description [, <i>str</i> $output_method]]])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$width</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'200'
                <br />
                <b>$description</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'1'&nbsp;-&nbsp;Disables feature vehicle description.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'array'&nbsp;-&nbsp;Will return following array:
                <div class="code"><pre><?php $featuredVehicle = ssi_smfg_featuredVehicle(200, 1, 'array'); flush(); print_R(str_replace(array('<','>'),array('&lt;','&gt;'),$featuredVehicle));?></pre></div>
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_featuredVehicle(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <?php ssi_smfg_featuredVehicle(); flush(); ?>

        <hr />

            <h3>Garage Stats: ssi_smfg_garageStats([<i>int</i> $style [, <i>str</i> $output_method]])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$style</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'0'&nbsp;-&nbsp;Table style.
                <br />
                <b>$style</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'1'&nbsp;-&nbsp;TinyPortal style.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'array'&nbsp;-&nbsp;Will return following array:
                <div class="code"><pre><?php $garageStats = ssi_smfg_garageStats(0, 'array'); flush(); print_R($garageStats);?></pre></div>
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_garageStats(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <?php ssi_smfg_garageStats(); flush(); ?>

        <hr />

            <h3>Newest Vehicles: ssi_smfg_newestVehicles([<i>bool</i> $title [, <i>int</i> $limit [, <i>str</i> $output_method]]])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$title</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'1'&nbsp;-&nbsp;Disables block title.
                <br />
                <b>$limit</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'5'&nbsp;-&nbsp;Number of items to return.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'array'&nbsp;-&nbsp;Will return following array (<b>$limit</b> set to '1'):
                <div class="code"><pre><?php $newestVehicles = ssi_smfg_newestVehicles(1, 1, 'array'); flush(); print_R($newestVehicles);?></pre></div>
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_newestVehicles(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div style="width: 150px;"><?php ssi_smfg_newestVehicles(); flush(); ?></div>

        <hr />

            <h3>Last Updated Vehicles: ssi_smfg_lastUpdatedVehicles([<i>bool</i> $title [, <i>int</i> $limit [, <i>str</i> $output_method]]])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$title</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'1'&nbsp;-&nbsp;Disables block title.
                <br />
                <b>$limit</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'5'&nbsp;-&nbsp;Number of items to return.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'array'&nbsp;-&nbsp;Will return following array (<b>$limit</b> set to '1'):
                <div class="code"><pre><?php $updatedVehicles = ssi_smfg_lastUpdatedVehicles(1, 1, 'array'); flush(); print_R($updatedVehicles);?></pre></div>
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_lastUpdatedVehicles(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div style="width: 150px;"><?php ssi_smfg_lastUpdatedVehicles(); flush(); ?></div>

        <hr />

            <h3>Newest Modifications: ssi_smfg_newestMods([<i>bool</i> $title [, <i>int</i> $limit [, <i>str</i> $output_method]]])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$title</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'1'&nbsp;-&nbsp;Disables block title.
                <br />
                <b>$limit</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'5'&nbsp;-&nbsp;Number of items to return.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'array'&nbsp;-&nbsp;Will return following array (<b>$limit</b> set to '1'):
                <div class="code"><pre><?php $newestMods = ssi_smfg_newestMods(1, 1, 'array'); flush(); print_R($newestMods);?></pre></div>
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_newestMods(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div style="width: 150px;"><?php ssi_smfg_newestMods(); flush(); ?></div>

        <hr />

            <h3>Last Updated Modifications: ssi_smfg_lastUpdatedMods([<i>bool</i> $title [, <i>int</i> $limit [, <i>str</i> $output_method]]])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$title</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'1'&nbsp;-&nbsp;Disables block title.
                <br />
                <b>$limit</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'5'&nbsp;-&nbsp;Number of items to return.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'array'&nbsp;-&nbsp;Will return following array (<b>$limit</b> set to '1'):
                <div class="code"><pre><?php $updatedMods = ssi_smfg_lastUpdatedMods(1, 1, 'array'); flush(); print_R($updatedMods);?></pre></div>
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_lastUpdatedMods(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div style="width: 150px;"><?php ssi_smfg_lastUpdatedMods(); flush(); ?></div>

        <hr />

            <h3>Most Viewed Vehicles: ssi_smfg_mostViews([<i>bool</i> $title [, <i>int</i> $limit [, <i>str</i> $output_method]]])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$title</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'1'&nbsp;-&nbsp;Disables block title.
                <br />
                <b>$limit</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'5'&nbsp;-&nbsp;Number of items to return.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'array'&nbsp;-&nbsp;Will return following array (<b>$limit</b> set to '1'):
                <div class="code"><pre><?php $mostViews = ssi_smfg_mostViews(1, 1, 'array'); flush(); print_R($mostViews);?></pre></div>
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_mostViews(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div style="width: 150px;"><?php ssi_smfg_mostViews(); flush(); ?></div>

        <hr />

            <h3>Most Modified Vehicles: ssi_smfg_mostModified([<i>bool</i> $title [, <i>int</i> $limit [, <i>str</i> $output_method]]])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$title</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'1'&nbsp;-&nbsp;Disables block title.
                <br />
                <b>$limit</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'5'&nbsp;-&nbsp;Number of items to return.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'array'&nbsp;-&nbsp;Will return following array (<b>$limit</b> set to '1'):
                <div class="code"><pre><?php $mostModified = ssi_smfg_mostModified(1, 1, 'array'); flush(); print_R($mostModified);?></pre></div>
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_mostModified(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div style="width: 150px;"><?php ssi_smfg_mostModified(); flush(); ?></div>

        <hr />

            <h3>Most Spent: ssi_smfg_mostSpent([<i>bool</i> $title [, <i>int</i> $limit [, <i>str</i> $output_method]]])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$title</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'1'&nbsp;-&nbsp;Disables block title.
                <br />
                <b>$limit</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'5'&nbsp;-&nbsp;Number of items to return.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'array'&nbsp;-&nbsp;Will return following array (<b>$limit</b> set to '1'):
                <div class="code"><pre><?php $mostSpent = ssi_smfg_mostSpent(1, 1, 'array'); flush(); print_R($mostSpent);?></pre></div>
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_mostSpent(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div style="width: 150px;"><?php ssi_smfg_mostSpent(); flush(); ?></div>

        <hr />

            <h3>Top Quartermiles: ssi_smfg_topQmile([<i>bool</i> $title [, <i>int</i> $limit [, <i>str</i> $output_method]]])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$title</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'1'&nbsp;-&nbsp;Disables block title.
                <br />
                <b>$limit</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'5'&nbsp;-&nbsp;Number of items to return.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'array'&nbsp;-&nbsp;Will return following array (<b>$limit</b> set to '1'):
                <div class="code"><pre><?php $topQmile = ssi_smfg_topQmile(1, 1, 'array'); flush(); print_R($topQmile);?></pre></div>
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_topQmile(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div style="width: 150px;"><?php ssi_smfg_topQmile(); flush(); ?></div>

        <hr />

            <h3>Top Dynoruns: ssi_smfg_topDyno([<i>bool</i> $title [, <i>int</i> $limit [, <i>str</i> $output_method]]])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$title</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'1'&nbsp;-&nbsp;Disables block title.
                <br />
                <b>$limit</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'5'&nbsp;-&nbsp;Number of items to return.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'array'&nbsp;-&nbsp;Will return following array (<b>$limit</b> set to '1'):
                <div class="code"><pre><?php $topDyno = ssi_smfg_topDyno(1, 1, 'array'); flush(); print_R($topDyno);?></pre></div>
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_topDyno(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div style="width: 150px;"><?php ssi_smfg_topDyno(); flush(); ?></div>

        <hr />

            <h3>Top Laptimes: ssi_smfg_topLap([<i>bool</i> $title [, <i>int</i> $limit [, <i>str</i> $output_method]]])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$title</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'1'&nbsp;-&nbsp;Disables block title.
                <br />
                <b>$limit</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'5'&nbsp;-&nbsp;Number of items to return.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'array'&nbsp;-&nbsp;Will return following array (<b>$limit</b> set to '1'):
                <div class="code"><pre><?php $topLap = ssi_smfg_topLap(1, 1, 'array'); flush(); print_R($topLap);?></pre></div>
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_topLap(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div style="width: 150px;"><?php ssi_smfg_topLap(); flush(); ?></div>

        <hr />

            <h3>Top Rated Vehicles: ssi_smfg_topRated([<i>bool</i> $title [, <i>int</i> $limit [, <i>str</i> $output_method]]])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$title</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'1'&nbsp;-&nbsp;Disables block title.
                <br />
                <b>$limit</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'5'&nbsp;-&nbsp;Number of items to return.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'array'&nbsp;-&nbsp;Will return following array (<b>$limit</b> set to '1'):
                <div class="code"><pre><?php $topRated = ssi_smfg_topRated(1, 1, 'array'); flush(); print_R($topRated);?></pre></div>
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_topRated(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div style="width: 150px;"><?php ssi_smfg_topRated(); flush(); ?></div>

        <hr />

            <h3>Last Blog Entry: ssi_smfg_lastBlog([<i>bool</i> $title [, <i>int</i> $limit [, <i>str</i> $output_method]]])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$title</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'1'&nbsp;-&nbsp;Disables block title.
                <br />
                <b>$limit</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'5'&nbsp;-&nbsp;Number of items to return.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'array'&nbsp;-&nbsp;Will return following array (<b>$limit</b> set to '1'):
                <div class="code"><pre><?php $lastBlog = ssi_smfg_lastBlog(1, 1, 'array'); flush(); print_R($lastBlog);?></pre></div>
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_lastBlog(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div style="width: 150px;"><?php ssi_smfg_lastBlog(); flush(); ?></div>

        <hr />

            <h3>Last Service: ssi_smfg_lastService([<i>bool</i> $title [, <i>int</i> $limit [, <i>str</i> $output_method]]])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$title</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'1'&nbsp;-&nbsp;Disables block title.
                <br />
                <b>$limit</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'5'&nbsp;-&nbsp;Number of items to return.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'array'&nbsp;-&nbsp;Will return following array (<b>$limit</b> set to '1'):
                <div class="code"><pre><?php $lastService = ssi_smfg_lastService(1, 1, 'array'); flush(); print_R($lastService);?></pre></div>
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_lastService(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div style="width: 150px;"><?php ssi_smfg_lastService(); flush(); ?></div>

        <hr />

            <h3>Last Video: ssi_smfg_lastVideo([<i>bool</i> $title [, <i>int</i> $limit [, <i>str</i> $output_method]]])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$title</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'1'&nbsp;-&nbsp;Disables block title.
                <br />
                <b>$limit</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'5'&nbsp;-&nbsp;Number of items to return.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'array'&nbsp;-&nbsp;Will return following array (<b>$limit</b> set to '1'):
                <div class="code"><pre><?php $lastVideo = ssi_smfg_lastVideo(1, 1, 'array'); flush(); print_R($lastVideo);?></pre></div>
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_lastVideo(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div style="width: 150px;"><?php ssi_smfg_lastVideo(); flush(); ?></div>

        <hr />

            <h3>Last Comments: ssi_smfg_lastComment([<i>bool</i> $title [, <i>int</i> $limit [, <i>str</i> $output_method]]])</h3>
            <h4><i>Description:</i></h4>
            <div style='margin-left: 10px;'>
                <b>$title</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'1'&nbsp;-&nbsp;Disables block title.
                <br />
                <b>$limit</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'5'&nbsp;-&nbsp;Number of items to return.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>default</i>:&nbsp;'echo'&nbsp;-&nbsp;Will echo output.
                <br />
                <b>$output_method</b>&nbsp;-&nbsp;<i>other available</i>:&nbsp;'array'&nbsp;-&nbsp;Will return following array (<b>$limit</b> set to '1'):
                <div class="code"><pre><?php $lastComment = ssi_smfg_lastComment(1, 1, 'array'); flush(); print_R($lastComment);?></pre></div>
            </div>
            <h4><i>Include:</i></h4>
            <div class="code"><pre>&lt;?php ssi_smfg_lastComment(); ?&gt;</pre></div>
            <h4><i>Displays:</i></h4>
            <div style="width: 150px;"><?php ssi_smfg_lastComment(); flush(); ?></div>

        <hr />
        <span style="color: #CCCCCC; font-size: smaller;">
            <?php
                echo 'This page took ', round(array_sum(explode(' ', microtime())) - array_sum(explode(' ', $time_start)), 4), ' seconds to load.<br />';
            ?>
            *ssi_garage_examples.php last modified on <?php echo date('m/j/y', filemtime(__FILE__)); ?>
        </span>
    </body>
</html>
