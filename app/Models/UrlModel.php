<?php

namespace App\Models;


use CodeIgniter\Database\Exceptions\DataException;
use CodeIgniter\Model;

class UrlModel extends Model
{
	protected $table = 'url';

	public function __construct() {
		parent::__construct();
		$db = \Config\Database::connect();
		$builder = $db->table('url');
	}

	public function insertUrl($data)
	{
		$db = \Config\Database::connect();
		$builder = $db->table('url');
		if(empty(strlen($data['long_url'])) || empty(strlen($data['short_url']))){
			throw new DataException("empty string!");
		}

		$query = $this->db->table($this->table)->insert($data);

		return $this->db->insertID();
	}
}
