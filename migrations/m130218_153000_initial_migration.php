<?php

class m130218_153000_initial_migration extends OEMigration {

	public function up() {

		// Get the event group id for "Clinical Events"
		$group_id = $this->dbConnection->createCommand()
		->select('id')
		->from('event_group')
		->where('code=:code', array(':code'=>'Ci'))
		->queryScalar();
		
		// Create the new Phasing event_type
		$this->insert('event_type', array(
				'name' => 'Phasing',
				'event_group_id' => $group_id,
				'class_name' => 'OphCiPhasing'
		));
		
		// Get the newly created event type
		$event_type_id = $this->dbConnection->createCommand()
		->select('id')
		->from('event_type')
		->where('class_name=:class_name', array(':class_name'=>'OphCiPhasing'))
		->queryScalar();
		
		$this->insert('element_type', array(
				'name' => 'Intraocular Pressure Phasing',
				'class_name' => 'Element_OphCiPhasing_IntraocularPressure',
				'event_type_id' => $event_type_id,
				'display_order' => 10,
				'default' => 1,
		));
			
		// Insert element type id into element type array
		$element_type_id = $this->dbConnection->createCommand()
		->select('id')
		->from('element_type')
		->where('class_name=:class_name', array(':class_name'=>'Element_OphCiPhasing_IntraocularPressure'))
		->queryScalar();

		$this->createTable('ophciphasing_instrument',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(255) NOT NULL',
				'display_order' => 'int(10) unsigned DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'CONSTRAINT `ophciphasing_instrument_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophciphasing_instrument_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
		
		$this->createTable('et_ophciphasing_intraocularpressure', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophciphasing_intraocularpressure_e_id_fk` (`event_id`)',
				'KEY `et_ophciphasing_intraocularpressure_c_u_id_fk` (`created_user_id`)',
				'KEY `et_ophciphasing_intraocularpressure_l_m_u_id_fk` (`last_modified_user_id`)',
				'CONSTRAINT `et_ophciphasing_intraocularpressure_e_id_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophciphasing_intraocularpressure_c_u_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciphasing_intraocularpressure_l_m_u_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
		$both_eyes_id = Eye::model()->find("name = 'Both'")->id;
		$this->addColumn('et_ophciphasing_intraocularpressure', 'eye_id', "int(10) unsigned DEFAULT $both_eyes_id");
		$this->addForeignKey('et_ophciphasing_intraocularpressure_eye_fk', 'et_ophciphasing_intraocularpressure', 'eye_id', 'eye', 'id');
		$this->addColumn('et_ophciphasing_intraocularpressure', 'left_instrument_id', 'int(10) unsigned');
		$this->addForeignKey('et_ophciphasing_intraocularpressure_li_fk', 'et_ophciphasing_intraocularpressure', 'left_instrument_id', 'ophciphasing_instrument', 'id');
		$this->addColumn('et_ophciphasing_intraocularpressure', 'right_instrument_id', 'int(10) unsigned');
		$this->addForeignKey('et_ophciphasing_intraocularpressure_ri_fk', 'et_ophciphasing_intraocularpressure', 'right_instrument_id', 'ophciphasing_instrument', 'id');
		$this->addColumn('et_ophciphasing_intraocularpressure', 'left_comments', 'text');
		$this->addColumn('et_ophciphasing_intraocularpressure', 'right_comments', 'text');
		$this->addColumn('et_ophciphasing_intraocularpressure', 'left_dilated', 'tinyint(1) unsigned');
		$this->addColumn('et_ophciphasing_intraocularpressure', 'right_dilated', 'tinyint(1) unsigned');
		
		$this->createTable('ophciphasing_reading',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'value' => 'int(10) unsigned',
				'side' => 'tinyint(1) unsigned NOT NULL',
				'element_id' => 'int(10) unsigned NOT NULL',
				'measurement_timestamp' => 'TIME',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'CONSTRAINT `ophciphasing_reading_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophciphasing_reading_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
		$this->addForeignKey('ophciphasing_reading_element_id_fk', 'ophciphasing_reading', 'element_id', 'et_ophciphasing_intraocularpressure', 'id');
		
		$migrations_path = dirname(__FILE__);
		$this->initialiseData($migrations_path);
	}

	public function down() {
		$this->dropTable('ophciphasing_reading');
		$this->dropTable('et_ophciphasing_intraocularpressure');
		$this->dropTable('ophciphasing_instrument');
		$this->delete('element_type','class_name=:class_name', array(':class_name'=>'Element_OphCiPhasing_IntraocularPressure'));
		$this->delete('event_type','class_name=:class_name', array(':class_name'=>'OphCiPhasing'));
	}

}
