<?php

class m131206_150639_soft_deletion extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophciphasing_intraocularpressure','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophciphasing_intraocularpressure_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('et_ophciphasing_intraocularpressure','deleted');
		$this->dropColumn('et_ophciphasing_intraocularpressure_version','deleted');
	}
}
