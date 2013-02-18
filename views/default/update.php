<?php $this->header() ?>

<h3 class="withEventIcon">
	<?php echo $this->event_type->name ?>
</h3>

<div id="event_<?php echo $this->module->name?>">
	<?php
		$form = $this->beginWidget('BaseEventTypeCActiveForm', array(
				'id' => 'clinical-create',
				'enableAjaxValidation' => false,
				'htmlOptions' => array('class' => 'sliding'),
		));
	
		// Event actions
		$this->event_actions[] = EventAction::button('Save', 'save', array('colour' => 'green'));
		$this->renderPartial('//patient/event_actions');
	?>

	<?php $this->displayErrors($errors)?>
	
	<div id="elements">
		<?php $this->renderDefaultElements($this->action->id, $form); ?>
	</div>

	<div class="cleartall"></div>
	<?php $this->endWidget(); ?>
</div>

<?php $this->footer() ?>
