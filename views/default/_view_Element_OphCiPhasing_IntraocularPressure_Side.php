<?php if($element->{'has'.$side}()) { ?>
<div class="data">
	<?php echo $element->{strtolower($side).'_instrument'}->name ?>
</div>
<div class="data">
	<table>
		<tbody>
			<?php foreach($element->{strtolower($side).'_readings'} as $reading) { ?>
			<tr>
				<td><?php echo date('g:ia',strtotime($reading->measurement_timestamp)) ?> - </td>
				<td><?php echo $reading->value ?> mm Hg</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<?php if($element->{strtolower($side).'_comments'}) { ?>
<div class="data">
	(<?php echo $element->{strtolower($side).'_comments'} ?>)
</div>
<?php } ?>
<?php } else { ?>
<div class="data">
	Not recorded
</div>
<?php } ?>
