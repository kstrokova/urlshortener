<?php

namespace App\Database\Migrations;

class CreateUrlTableMigration extends  \CodeIgniter\Database\Migration
{
	public function up()
	{
		$forge = \Config\Database::forge();
		$forge->addfield(
			array(
				'id' => array(
					'type' => 'INT',
					'constraint' => 5,
					'unsigned' => true,
					'auto_increment' => true
				),
				'short_url' => array(
					'type' => 'text',
					'unique' => TRUE
				),
				'long_url' => array(
					'type' => 'TEXT',
					'unique' => TRUE
				),
			)
		);

		$forge->addkey('id', TRUE);
		$forge->createtable('url');
	}

	public function down()
	{
		$forge = \Config\Database::forge();
		$forge->droptable('url');
	}
}
