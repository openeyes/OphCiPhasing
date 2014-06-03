<?php

class m131204_163104_table_versioning extends OEMigration
{
	public function up()
	{
		$this->addColumn('ophciphasing_instrument','active','boolean not null default true');
	}

	public function down()
	{
		$this->dropColumn('ophciphasing_instrument','deleted');
	}
}
