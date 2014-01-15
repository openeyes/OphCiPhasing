<?php

class m131204_163104_table_versioning extends CDbMigration
{
	public function up()
	{
		$this->execute("
CREATE TABLE `et_ophciphasing_intraocularpressure_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`eye_id` int(10) unsigned DEFAULT '3',
	`left_instrument_id` int(10) unsigned DEFAULT NULL,
	`right_instrument_id` int(10) unsigned DEFAULT NULL,
	`left_comments` text,
	`right_comments` text,
	`left_dilated` tinyint(1) unsigned NOT NULL DEFAULT '0',
	`right_dilated` tinyint(1) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	KEY `acv_et_ophciphasing_intraocularpressure_e_id_fk` (`event_id`),
	KEY `acv_et_ophciphasing_intraocularpressure_c_u_id_fk` (`created_user_id`),
	KEY `acv_et_ophciphasing_intraocularpressure_l_m_u_id_fk` (`last_modified_user_id`),
	KEY `acv_et_ophciphasing_intraocularpressure_eye_fk` (`eye_id`),
	KEY `acv_et_ophciphasing_intraocularpressure_li_fk` (`left_instrument_id`),
	KEY `acv_et_ophciphasing_intraocularpressure_ri_fk` (`right_instrument_id`),
	CONSTRAINT `acv_et_ophciphasing_intraocularpressure_c_u_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophciphasing_intraocularpressure_eye_fk` FOREIGN KEY (`eye_id`) REFERENCES `eye` (`id`),
	CONSTRAINT `acv_et_ophciphasing_intraocularpressure_e_id_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
	CONSTRAINT `acv_et_ophciphasing_intraocularpressure_li_fk` FOREIGN KEY (`left_instrument_id`) REFERENCES `ophciphasing_instrument` (`id`),
	CONSTRAINT `acv_et_ophciphasing_intraocularpressure_l_m_u_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophciphasing_intraocularpressure_ri_fk` FOREIGN KEY (`right_instrument_id`) REFERENCES `ophciphasing_instrument` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('et_ophciphasing_intraocularpressure_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophciphasing_intraocularpressure_version');

		$this->createIndex('et_ophciphasing_intraocularpressure_aid_fk','et_ophciphasing_intraocularpressure_version','id');
		$this->addForeignKey('et_ophciphasing_intraocularpressure_aid_fk','et_ophciphasing_intraocularpressure_version','id','et_ophciphasing_intraocularpressure','id');

		$this->addColumn('et_ophciphasing_intraocularpressure_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophciphasing_intraocularpressure_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophciphasing_intraocularpressure_version','version_id');
		$this->alterColumn('et_ophciphasing_intraocularpressure_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophciphasing_instrument_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`display_order` int(10) unsigned DEFAULT '1',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophciphasing_instrument_last_modified_user_id_fk` (`last_modified_user_id`),
	KEY `acv_ophciphasing_instrument_created_user_id_fk` (`created_user_id`),
	CONSTRAINT `acv_ophciphasing_instrument_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophciphasing_instrument_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophciphasing_instrument_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophciphasing_instrument_version');

		$this->createIndex('ophciphasing_instrument_aid_fk','ophciphasing_instrument_version','id');
		$this->addForeignKey('ophciphasing_instrument_aid_fk','ophciphasing_instrument_version','id','ophciphasing_instrument','id');

		$this->addColumn('ophciphasing_instrument_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophciphasing_instrument_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophciphasing_instrument_version','version_id');
		$this->alterColumn('ophciphasing_instrument_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophciphasing_reading_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`value` int(10) unsigned DEFAULT NULL,
	`side` tinyint(1) unsigned NOT NULL,
	`element_id` int(10) unsigned NOT NULL,
	`measurement_timestamp` time DEFAULT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophciphasing_reading_last_modified_user_id_fk` (`last_modified_user_id`),
	KEY `acv_ophciphasing_reading_created_user_id_fk` (`created_user_id`),
	KEY `acv_ophciphasing_reading_element_id_fk` (`element_id`),
	CONSTRAINT `acv_ophciphasing_reading_element_id_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophciphasing_intraocularpressure` (`id`),
	CONSTRAINT `acv_ophciphasing_reading_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophciphasing_reading_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophciphasing_reading_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophciphasing_reading_version');

		$this->createIndex('ophciphasing_reading_aid_fk','ophciphasing_reading_version','id');
		$this->addForeignKey('ophciphasing_reading_aid_fk','ophciphasing_reading_version','id','ophciphasing_reading','id');

		$this->addColumn('ophciphasing_reading_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophciphasing_reading_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophciphasing_reading_version','version_id');
		$this->alterColumn('ophciphasing_reading_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->addColumn('et_ophciphasing_intraocularpressure','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophciphasing_intraocularpressure_version','deleted','tinyint(1) unsigned not null');

		$this->addColumn('ophciphasing_instrument','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophciphasing_instrument_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophciphasing_reading','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophciphasing_reading_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('ophciphasing_instrument','deleted');
		$this->dropColumn('ophciphasing_reading','deleted');

		$this->dropColumn('et_ophciphasing_intraocularpressure','deleted');

		$this->dropTable('et_ophciphasing_intraocularpressure_version');
		$this->dropTable('ophciphasing_instrument_version');
		$this->dropTable('ophciphasing_reading_version');
	}
}
