<?php

namespace JFFram;

use \Exception;

class View {

	private $file;
	private $title;
	private $app;
	
	public function __construct($action, $controller = "", $app) {

		$file = "./App/View/". $app ."/";
		$view = lcfirst($controller);
		
		$this->file = $file . $view . ".php";
		$this->app = $app;

	}

	public function generate($data, $app) {

		$content = $this->generateFile($this->file, $data);
		$view = $this->generateFile('./App/View/'. $app .'/Templates/layout.php', array('title' => $this->title, 'content' => $content));

		echo $view;

	}

	private function generateFile($file, $data) {

		if (file_exists($file)) {

			extract($data);

			ob_start();
			require $file;

			return ob_get_clean();

		} else {

			throw new Exception("Le fichier '$file' est introuvable.");
			
		}
	}

	private function clean($value) {

		return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);

	}

}