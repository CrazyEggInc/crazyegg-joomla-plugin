<?php
/**
 * @package Plugin Crazy Egg for Joomla! 3.8
 * @version 1.0.0
 * @author Crazy Egg
 * @copyright (C) 2018 - Crazy Egg, Inc.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html; see LICENSE.txt
 * @website www.crazyegg.com
 **/

// No direct access.
defined('_JEXEC') or die('Direct access to this location is not allowed.');

jimport('joomla.form.formfield');

class JFormFieldSpacerinfo extends JFormField 
{
    protected $type = 'Spacerinfo';

    public function getLabel()
    {
        return '<img src="../plugins/system/crazyegg/crazyegg/images/logo.svg" style="display: block; width: 70px; margin: auto;" />';
    }

    public function getInput()
    {
        $output = "";
        $output .= '<style type="text/css">
        </style>';

        $output .= '<div style="margin-top: 10px; line-height: 1.5;">
            <strong>Name</strong>: Crazy Egg integration plugin <br />
            <strong>Version</strong>: 1.0.0 <br />
            <strong>Author</strong>: Crazy Egg, Inc. <br />
            <strong>Website</strong>: <a href="https://www.crazyegg.com" target="_blank">https://www.crazyegg.com</a> <br />
            <strong>Help</strong>: <a href="https://help.crazyegg.com/articles#1-tracking-script" target="_blank">help.crazyegg.com</a> <br />
            <strong>Contact</strong>: <a href="mailto:support@crazyegg.com">support@crazyegg.com</a> <br />
        </div>';

        return $output;
    }
}
