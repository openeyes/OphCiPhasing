<div class="cols2 clearfix">
	<div class="left eventDetail">
		<?php
		$this->renderPartial('_view_Element_OphCiPhasing_IntraocularPressure_Side', array(
				'element' => $element,
				'side' => 'Right',
		));
		?>
	</div>
	<div class="right eventDetail">
		<?php
		$this->renderPartial('_view_Element_OphCiPhasing_IntraocularPressure_Side', array(
				'element' => $element,
				'side' => 'Left',
		));
		?>
	</div>
</div>
