$(document).ready(function() {

	/**
	 * Save event
	 */
	$('#event_display').delegate('#et_save', 'click', function(e) {
		if (!$(this).hasClass('inactive')) {
			disableButtons();
		} else {
			e.preventDefault();
		}
	});

	/**
	 * Delete event
	 */
	$('#event_display').delegate('#et_deleteevent', 'click', function(e) {
		if (!$(this).hasClass('inactive')) {
			disableButtons();
			return true;
		}
		e.preventDefault();
		return false;
	});

	/**
	 * Cancel event delete
	 */
	$('#event_display').delegate('#et_canceldelete', 'click', function(e) {
		if (!$(this).hasClass('inactive')) {
			disableButtons();
			if (m = window.location.href.match(/\/delete\/[0-9]+/)) {
				window.location.href = window.location.href.replace('/delete/', '/view/');
			} else {
				window.location.href = baseUrl + '/patient/episodes/' + et_patient_id;
			}
		}
		e.preventDefault();
	});

	$(this).delegate('#event_content .Element_OphCiPhasing_IntraocularPressure .removeReading', 'click', function(e) {
		var block = $(this).closest('.data');
		$(this).closest('tr').remove();
		e.preventDefault();
	});

	$(this).delegate('#event_content .Element_OphCiPhasing_IntraocularPressure .addReading', 'click', function(e) {
		var side = $(this).closest('.side').attr('data-side');
		OphCiPhasing_IntraocularPressure_addReading(side);
		e.preventDefault();
	});

	$(this).delegate('#event_content .side .activeForm a.removeSide', 'click', function(e) {
		
		// Update side field to indicate other side
		var side = $(this).closest('.side');
		
		var remove_physical_side = 'left';
		var show_physical_side = 'right';
		
		var eye_side = 1;
		if(side.attr('data-side') == 'left') {
			eye_side = 2; // Right
			remove_physical_side = 'right';
			show_physical_side = 'left';
		} 
		
		$(this).closest('.element').find('input.sideField').each(function() {
			$(this).val(eye_side);
		});
		
		// If other side is already inactive, then activate it (can't have both sides inactive)
		$(this).closest('.element').find('.side.'+show_physical_side).removeClass('inactive');
		
		// Make this side inactive
		$(this).closest('.element').find('.side.'+remove_physical_side).addClass('inactive');
		
		e.preventDefault();
	});

	$(this).delegate('#event_content .side .inactiveForm a', 'click', function(e) {
		var element = $(this).closest('.element'); 
		element.find('input.sideField').each(function() {
			$(this).val(3); // Both eyes
		});
		
		element.find('.side').removeClass('inactive');
		
		e.preventDefault();
	});
	
});

function OphCiPhasing_IntraocularPressure_getNextKey() {
	var keys = $('#event_content .Element_OphCiPhasing_IntraocularPressure .intraocularPressureReading').map(function(index, el) {
		return parseInt($(el).attr('data-key'));
	}).get();
	return Math.max.apply(null, keys) + 1;
}

function OphCiPhasing_IntraocularPressure_addReading(side) {
	var template = $('#intraocularpressure_reading_template').html();
	var data = {
		"key" : OphCiPhasing_IntraocularPressure_getNextKey(),
		"side" : (side == 'right' ? 0 : 1),
	};
	var form = Mustache.render(template, data);
	var table = $('#event_content .Element_OphCiPhasing_IntraocularPressure .[data-side="' + side + '"] table');
	$('tbody', table).append(form);
}
