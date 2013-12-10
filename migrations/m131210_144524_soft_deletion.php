<?php

class m131210_144524_soft_deletion extends CDbMigration
{
	public function up()
	{
		$this->addColumn('ophciphasing_instrument','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophciphasing_instrument_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophciphasing_reading','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophciphasing_reading_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('ophciphasing_instrument','deleted');
		$this->dropColumn('ophciphasing_instrument_version','deleted');
		$this->dropColumn('ophciphasing_reading','deleted');
		$this->dropColumn('ophciphasing_reading_version','deleted');
	}
}
