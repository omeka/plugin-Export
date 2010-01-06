<?php

/*$exporter = new Export_OmekaXmlWriter();
$exporter->writeDocument();*/

/*ProcessDispatcher::startProcess('Export_Exporter');*/
?>
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

$head = array('body_class' => 'export primary',
              'title'      => 'Export');
head($head);
?>

<h1><?php echo $head['title'];?></h1>

<p id="new-export" class="add-button"><a href="<?php echo uri('export/index/snapshot'); ?>" class="add">Make a Snapshot</a></p>

<div id="primary">

<?php echo flash(); ?>

<table>
<thead>
    <th>Date</th>
    <th>Status</th>
    <th>Download</th>
</thead>
<?php foreach ($snapshots as $snapshot): ?>
<tr>
    <td><?php echo $snapshot->date; ?></td>
    <td></td>
    <td></td>
</tr>
<?php endforeach; ?>
</table>
</div>

<?php foot(); ?>
