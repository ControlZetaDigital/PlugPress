<?php
/**
 * Plugs page
 * 
 * @since       1.0.0
 * @package     PlugPress
 * @subpackage  PlugPress/admin/views/pages
 */
?>

<div class="wrap">

    <h1><?php _e("My Plugs", "plugpress"); ?></h1>

    <p><?php _e("List of plugs installed", "plugpress"); ?></p>

    <?php if ($plugs) : ?>

        <div class="<?php echo $prefix; ?>plugs">

        <?php foreach ($plugs as $plug) : ?>

            <div class="<?php echo $prefix; ?>plug" data-id="<?php echo $plug['plug_id']; ?>" data-version="<?php echo $plug['version']; ?>">

                <h3><?php echo $plug['plug_name']; ?></h3>

                <p><?php echo $plug['description']; ?></p>

                <p><a href="<?php echo $plug['author_uri']; ?>"><?php echo $plug['author']; ?></a></p>

                <select class="<?php echo $prefix; ?>plug-enabled">

                    <option value="0"<?php echo ($settings::is_enabled($plug['plug_id'])) ? '' : ' selected'; ?>><?php _e("No", "plugpress"); ?></option>

                    <option value="1"<?php echo ($settings::is_enabled($plug['plug_id'])) ? ' selected' : ''; ?>><?php _e("Yes", "plugpress"); ?></option>

                </select>

            </div>

        <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div> <!-- END .wrap -->