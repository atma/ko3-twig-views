<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Twig Loader
 *
 * @author Oleh Burkhay <atma@atmaworks.com>
 */
class View_Environment {

	/**
	 * Loads View_Environment based on the configuration key they represent
	 *
	 * @param string $env
	 * @return Twig_Environment
	 */
	public static function instance($env = 'default') {
		static $instances;

		if (!isset($instances[$env])) {
			$config = Kohana::$config->load('twig.' . $env);

			// Create the the loader
			$view_loader = $config['loader']['class'];
			$loader = new $view_loader($config['loader']['options']);

			// Set up the instance
			$view = new Twig_Environment($loader, $config['environment']);

			// Load extensions
			foreach ($config['extensions'] as $extension) {
				$view->addExtension(new $extension);
			}
            $instances[$env] = $view;
		}

		return $instances[$env];
	}

	final private function __construct() {
		// This is a static class
	}
}