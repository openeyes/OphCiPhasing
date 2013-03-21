<?php

class m130321_143218_dilated_default_to_no extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('et_ophciphasing_intraocularpressure','left_dilated','tinyint(1) unsigned NOT NULL DEFAULT 0');
		$this->alterColumn('et_ophciphasing_intraocularpressure','right_dilated','tinyint(1) unsigned NOT NULL DEFAULT 0');
	}

	public function down()
	{
		$this->alterColumn('et_ophciphasing_intraocularpressure','left_dilated','tinyint(1) unsigned DEFAULT NULL');
		$this->alterColumn('et_ophciphasing_intraocularpressure','right_dilated','tinyint(1) unsigned DEFAULT NULL');
	}
}
