<?php
/**
 * @package      Gamification Platform
 * @subpackage   Modules
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined("_JEXEC") or die;

jimport("prism.init");
jimport("gamification.init");

// Get component parameters
$componentParams = JComponentHelper::getParams("com_gamification");

$imagePath       = $componentParams->get("images_directory", "images/gamification");

$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root() . 'modules/mod_gamificationprofile/css/style.css');

// Get user ID.
JLoader::register("Prism\\Integration\\Helper", PRISM_PATH_LIBRARY . "/integration/helper.php");
$userId  = Prism\Integration\Helper::getUserId();

if ($params->get("display_points", 0)) {

    $keys = array(
        "user_id"   => $userId,
        "points_id" => $params->get("points_points_id")
    );

    $points = Gamification\User\Points::getInstance(JFactory::getDbo(), $keys);
}

if ($params->get("display_level", 0)) {

    $keys = array(
        "user_id"  => $userId,
        "group_id" => $params->get("level_group_id")
    );

    $level = Gamification\User\Level::getInstance(JFactory::getDbo(), $keys);
}

if ($params->get("display_rank", 0)) {
    $keys = array(
        "user_id"  => $userId,
        "group_id" => $params->get("rank_group_id")
    );

    $rank = Gamification\User\Rank::getInstance(JFactory::getDbo(), $keys);
}

if ($params->get("display_badges", 0)) {

    $keys = array(
        "user_id"  => $userId,
        "group_id" => $params->get("badges_group_id")
    );

    $badges = Gamification\User\Badges::getInstance(JFactory::getDbo(), $keys);
    $badgeTooltip = $params->get("display_badges_note", 0);
}

if ($params->get("display_progress_bar", 0)) {

    $keys = array(
        "user_id"   => $userId,
        "points_id" => $params->get("progress_points_id")
    );

    $points = Gamification\User\Points::getInstance(JFactory::getDbo(), $keys);
    $based  = $params->get("progress_bar_mechanic", "levels");

    JLoader::register("Gamification\\User\\ProgressBar", GAMIFICATION_PATH_LIBRARY . "/user/progressbar.php");
    $progress = new Gamification\User\ProgressBar(JFactory::getDbo(), $points);
    $progress->build($based);
}

require JModuleHelper::getLayoutPath('mod_gamificationprofile', $params->get('layout', 'default'));