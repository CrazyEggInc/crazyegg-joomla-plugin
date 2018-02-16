<?php
/**
 * @package Plugin Crazy Egg for Joomla! 3.8
 * @version 1.0.0
 * @author Crazy Egg
 * @copyright (C) 2018 - Crazy Egg, Inc.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html; see LICENSE.txt
 * @website www.crazyegg.com
 **/

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

class plgSystemCrazyEgg extends JPlugin
{
    function plgSystemCrazyEgg( &$subject, $params )
    {
        parent::__construct($subject, $params);
    }

    function onBeforeCompileHead()
    {
        $document = JFactory::getDocument();

        // apply styles only to front-end
        if (substr(JURI::base(), -15) != "/administrator/")
        {
            $acc_number = $this->params->get('account_number');
            $acc_number = trim($acc_number);

            if (is_numeric($acc_number) and strlen($acc_number) == 8)
            {
                // insert slash character after first 4 digits of the account number
                $acc_number_path = substr_replace($acc_number, "/", 4, 0);
                $url = "//script.crazyegg.com/pages/scripts/".$acc_number_path.".js";
                $document->addScript($url, "text/javascript", false, true); // the last `true` is for "async" attribute
            }
        }
    }
}
