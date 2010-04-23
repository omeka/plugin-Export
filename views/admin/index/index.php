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

<?php if (count($entries) == 0): ?>
<p>Click "Make a Snapshot" to export a snapshot of this Omeka installation.</p>
<p>Once created, snapshots will appear here.</p>
<?php else: ?>
<table>
<thead>
    <th>Snapshot Date</th>
    <th>Status</th>
    <th>Size</th>
    <th colspan="2">Actions</th>
</thead>

<?php foreach ($entries as $entry): 
    $id = $entry['id'];
    $status = $entry['status'];
?>
<tr>
    <td><?php echo $entry['displayDate']; ?></td>
    <td><?php echo $entry['displayStatus']; ?></td>
    <td><?php echo $entry['displaySize']; ?></td>
    <td><?php if ($status == 'completed'): ?><a href="<?php echo uri('export/index/download')."?id=$id" ?>" class="add-file">Download</a><?php endif; ?></td>
    <td><?php if ($status == 'completed'): ?><a href="<?php echo uri('export/index/delete')."?id=$id" ?>" class="delete">Delete</a><?php endif; ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
</div>

<?php foot(); ?>
