<?php

namespace App\Controllers;

use App\Models\UrlModel;

class Home extends BaseController
{

	/**
	 * Contain object url
	 * @var UrlModel
	 */
	private $urlModel;

	/**
	 * Home constructor.
	 */
	public function __construct()
	{
		$this->urlModel = new UrlModel();
	}

	/**
	 * Show index view
	 * @return string
	 */
	public function index()
	{
		return view('welcome_message');
	}

	/**
	 * Open short url
	 * @param $short
	 * @return \CodeIgniter\HTTP\RedirectResponse|string
	 */
	public function go($short){
		$data = $this->urlModel->where('short_url', $short)
			->first();

		$url = $data['long_url'];

		if(empty($data)){
			return view('errors/html/error_404');
		}

		return redirect()->to($data['long_url']);
	}

	/**
	 * Create short url
	 * @return string
	 * @throws \Exception
	 */
	public function short()
	{
		$shortUrl = '';
		$longUrl = $_POST["url"];

		if(empty($longUrl)) return view('errors/html/error_404');

		if($this->checkIfExists($longUrl)){
			$number = mt_rand(0, PHP_INT_MAX);
			$shortUrl = $this->encode($number);
			$data = [
				'short_url' => $shortUrl,
				'long_url' => $longUrl
			];
			$data['query'] = $this->urlModel->insertUrl($data);
		}else{
			$data = $this->urlModel->where('long_url', $longUrl)
				->first();
		}
		$shortUrl = $_SERVER['HTTP_HOST'] . "/" . $data['short_url'];

		return view('welcome_message',  ['vurl' => $shortUrl,'url' =>  $shortUrl]);
	}

	/**
	 * Check existing url in db
	 * @param $url
	 * @return bool
	 */
	private function checkIfExists($url){
		$data = $this->urlModel->where('long_url', $url)
			->first();
		 return (empty($data));
	}

	/**
	 * create short uri
	 * @param $number
	 * @return string|string[]|null
	 * @throws \Exception
	 */
	private function encode($number) {
		return preg_replace('/[^ a-zA-Z\d]/ui', random_int(0,9), rtrim(base64_encode(pack('i', $number)), "="));
	}

}
