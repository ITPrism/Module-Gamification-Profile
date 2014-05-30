<?php
/**
 * @package      Gamification Platform
 * @subpackage   Modules
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined("_JEXEC") or die;

jimport("gamification.init");

// Get component parameters
$componentParams = JComponentHelper::getParams("com_gamification");

// Load helpers
JHtml::addIncludePath(GAMIFICATION_PATH_COMPONENT_SITE . '/helpers/html');

$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root() . 'modules/mod_gamificationprofile/css/style.css');

$userId  = JFactory::getUser()->get("id");
$groupId = $params->get("group_id");

$imagePath = $componentParams->get("images_directory", "images/gamification");

$keys = array(
    "user_id"  => $userId,
    "group_id" => $groupId
);

if ($params->get("display_points", 0)) {

    $pointsKeys = array(
        "user_id"   => $userId,
        "points_id" => $params->get("points_id")
    );

    jimport('gamification.userpoints');
    $points = GamificationUserPoints::getInstance($pointsKeys);
}

if ($params->get("display_level", 0)) {

    jimport('gamification.userlevel');
    $level = GamificationUserLevel::getInstance($keys);
}

if ($params->get("display_rank", 0)) {

    jimport('gamification.userrank');
    $rank = GamificationUserRank::getInstance($keys);
}

if ($params->get("display_badges", 0)) {

    jimport('gamification.userbadges');
    $badges = GamificationUserBadges::getInstance($keys);
    $badgeTooltip = $params->get("display_badges_note", 0);
}

if ($params->get("display_progress_bar", 0)) {

    jimport('gamification.userpoints');
    $pointsKeys = array(
        "user_id"   => $userId,
        "points_id" => $params->get("points_id")
    );

    $points = GamificationUserPoints::getInstance($pointsKeys);
    $based  = $params->get("display_progress_bar_based", "levels");

    jimport('gamification.userprogressbar');
    $progress = new GamificationUserProgressBar($points, $based);
}

require JModuleHelper::getLayoutPath('mod_gamificationprofile', $params->get('layout', 'default'));