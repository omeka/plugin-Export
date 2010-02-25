<?php
/**
 * Admin page index view
 *
 * Provides the main landing page of the administrative interface.
 *
 * @package Export
 * @subpackage Views
 * @copyright Copyright (c) 2009-2010 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename=snapshot.zip');

ob_end_flush();
readfile($snapshot->archive);
