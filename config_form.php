<?php
/**
 * Config form include
 *
 * Included in the configuration page for users to change the plugin's settings.
 *
 * @package Export
 * @copyright Copyright (c) 2009-2010 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */
 ?>
<div class="field">
    <label for="export_save_directory">Snapshot save directory</label>
    <?php echo __v()->formText('export_save_directory', $saveDirectory); ?>
    <p class="explanation">The directory on the server where generated reports
        will be saved. This directory must be writable by the web server for
        the plugin to function correctly.</p>
</div>
