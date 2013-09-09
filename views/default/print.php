<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
?>
<div class="page" id="OphCiPhasing_print">
	<div class="header">
		<div class="title middle">
			<img src="<?php echo Yii::app()->createUrl('img/_print/letterhead_seal.jpg')?>" alt="letterhead_seal" class="seal" width="100" height="83"/>
			<h1>Phasing</h1>
		</div>
		<div class="headerInfo">
			<div class="patientDetails">
				<strong><?php echo $this->patient->addressname?></strong>
				<br />
				<?php echo ($this->patient->contact && $this->patient->contact->address) ? $this->patient->contact->address->getLetterHtml() : ''; ?>
				<br>
				<br>
				Hospital No: <strong><?php echo $this->patient->hos_num ?></strong>
				<br>
				NHS No: <strong><?php echo $this->patient->nhsnum ?></strong>
				<br>
				DOB: <strong><?php echo Helper::convertDate2NHS($this->patient->dob) ?> (<?php echo $this->patient->getAge()?>)</strong>
			</div>
			<div class="headerDetails">
				<?php if ($consultant = $this->event->episode->firm->getConsultantName() ) { ?>
				<strong><?php echo $consultant ?></strong>
				<br>
				<?php } ?>
				Service: <strong><?php echo $this->event->episode->firm->getSubspecialtyText() ?></strong>
			</div>
			<div class="noteDates">
				Phasing Created: <strong><?php echo Helper::convertDate2NHS($this->event->created_date) ?></strong>
				<br>
				Phasing Printed: <strong><?php echo Helper::convertDate2NHS(date('Y-m-d')) ?></strong>
			</div>
		</div>
	</div>

	<div class="body">
		<?php if ($element = Element_OphCiPhasing_IntraocularPressure::model()->find('event_id=?',array($this->event->id))) {?>
			<h2>Intraocular Pressure</h2>
			<div class="details">
				<div class="cols2 clearfix">
					<div class="left">
						<?php if ($element->hasRight()) {?>
							<div class="data">
								<?php echo $element->right_instrument->name ?> <?php if ($element->right_dilated) {?>(dilated)<?php }?>
							</div>
							<div class="data">
								<table>
									<tbody>
										<?php foreach ($element->right_readings as $reading) { ?>
											<tr>
												<td><?php echo date('g:ia',strtotime($reading->measurement_timestamp)) ?> - </td>
												<td><?php echo $reading->value ?> mm Hg</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<?php if ($element->right_comments) {?>
								<div class="data">
									(<?php echo $element->right_comments?>)
								</div>
							<?php }?>
						<?php } else {?>
							Not recorded
						<?php }?>
					</div>
					<div class="right">
						<?php if ($element->hasLeft()) {?>
							<div class="data">
								<?php echo $element->left_instrument->name ?> <?php if ($element->left_dilated) {?>(dilated)<?php }?>
							</div>
							<div class="data">
								<table>
									<tbody>
										<?php foreach ($element->left_readings as $reading) { ?>
											<tr>
												<td><?php echo date('g:ia',strtotime($reading->measurement_timestamp)) ?> - </td>
												<td><?php echo $reading->value ?> mm Hg</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<?php if ($element->left_comments) {?>
								<div class="data">
									(<?php echo $element->left_comments?>)
								</div>
							<?php }?>
						<?php } else {?>
							Not recorded
						<?php }?>
					</div>
				</div>
			</div>
		<?php }?>

		<div class="metaData">
			<span class="info">Phasing created by <span class="user"><?php echo $this->event->user->fullname ?></span>
				on <?php echo $this->event->NHSDate('created_date') ?>
				at <?php echo date('H:i', strtotime($this->event->created_date)) ?></span>
			<span class="info">Phasing last modified by <span class="user"><?php echo $this->event->usermodified->fullname ?></span>
				on <?php echo $this->event->NHSDate('last_modified_date') ?>
				at <?php echo date('H:i', strtotime($this->event->last_modified_date)) ?></span>
		</div>

	</div>
</div>
