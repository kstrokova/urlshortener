<?php


namespace App\Controllers;


use CodeIgniter\Controller;

class Migrate extends Controller
{
	public function index()
	{
		// load migration library
		$this->load->library('migration');

		if ( ! $this->migration->current())
		{
			echo 'Error' . $this->migration->error_string();
		} else {
			echo 'Migrations ran successfully!';
        }
	}
}
