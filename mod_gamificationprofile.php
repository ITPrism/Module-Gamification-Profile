<?php
/**
 * @package      Gamification Platform
 * @subpackage   Modules
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

// no direct access
defined("_JEXEC") or die;

jimport("Prism.init");
jimport("Gamification.init");

// Get component parameters
$componentParams = JComponentHelper::getParams("com_gamification");

$imagePath       = $componentParams->get("images_directory", "images/gamification");

// Get user ID.
JLoader::register("Prism\\Integration\\Helper", PRISM_PATH_LIBRARY . "/integration/helper.php");
$userId  = Prism\Integration\Helper::getUserId();
$user    = JFactory::getUser($userId);

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
}

if ($params->get("display_progress_bar", 0)) {
    $keys = array(
        "user_id"   => $userId,
        "points_id" => $params->get("progress_points_id")
    );

    $points = Gamification\User\Points::getInstance(JFactory::getDbo(), $keys);
    $based  = $params->get("progress_bar_mechanic", "levels");

    $progress = new Gamification\User\Progressbar(JFactory::getDbo(), $points);
    $progress->build($based);
}

$placeholders = array(
    "name" => $user->get("name")
);

require JModuleHelper::getLayoutPath('mod_gamificationprofile', $params->get('layout', 'default'));