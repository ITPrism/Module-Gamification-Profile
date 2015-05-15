<?php
/**
 * @package      Gamification Platform
 * @subpackage   Modules
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die; ?>
<div class="row">
    <?php if ($params->get("display_points", 0)) {?>
    <div class="col-xs-12 col-md-4 gfy-modprofile-points">
        <h4><?php echo JText::_("MOD_GAMIFICATIONPROFILE_POINTS");?></h4>
        <p class="gfy-modprofile-points-value">
        <?php if ($params->get("display_points_abbr", 0)) {
            echo $points;
        } else {
            echo $points->getPoints();
        }?>
        <p>
    </div>
    <?php }?>

    <?php if ($params->get("display_level", 0)) {?>
    <div class="col-xs-12 col-md-4 gfy-modprofile-level">
        <h4><?php echo JText::_("MOD_GAMIFICATIONPROFILE_LEVEL");?></h4>
        <p class="gfy-modprofile-level-value"><?php echo $level->getLevel();?><p>

        <?php if ($params->get("display_level_title", 0)) {?>
        <p><?php echo $level->getTitle(); ?></p>
        <?php }?>

        <?php if ($params->get("display_level_rank", 0) and $level->getRankId()) {?>
        <p><?php echo $level->getRank()->getTitle(); ?></p>
        <?php }?>

    </div>
    <?php } ?>

    <?php if ($params->get("display_rank", 0)) {?>
    <div class="col-xs-12 col-md-4 gfy-modprofile-rank">
        <h4><?php echo JText::_("MOD_GAMIFICATIONPROFILE_RANK");?></h4>

        <?php if ($params->get("display_rank_picture", 0)) {?>
            <img src="<?php echo $imagePath."/".$rank->getImage();?>" alt="<?php echo stripslashes(htmlentities($rank->getTitle(), ENT_QUOTES, "UTF-8"));?>" />
        <?php }?>

        <p><?php echo $rank->getTitle();?><p>

    </div>
    <?php } ?>

</div>

<?php if ($params->get("display_badges", 0)) { ?>
<div class="row">
    <div class="col-xs-12 gfy-modprofile-badges">
    <h4><?php echo JText::_("MOD_GAMIFICATIONPROFILE_BADGES");?></h4>
    <?php
        $badges_ = $badges->getBadges($params->get("badges_group_id"));
        foreach ($badges_ as $badge) {
            echo JHtml::_("gamification.badge", $imagePath."/".$badge->getImage(), $badge->getTitle(), $badgeTooltip, $badge->getNote());
        }
    ?>
    </div>
</div>
<?php }?>

<?php if ($params->get("display_progress_bar", 0)) { ?>
<div class="row">
    <div class="col-xs-12 gfy-modprofile-progress">
        <h4><?php echo JText::_("MOD_GAMIFICATIONPROFILE_PROGRESS");?></h4>
        <?php echo JHtml::_("gamification.progress", $progress, $params->get("display_badges_information", 0));?>
    </div>
</div>
<?php }?>