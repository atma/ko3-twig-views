<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Twig view template controller
 *
 * @author Oleh Burkhay <atma@atmaworks.com>
 */
abstract class Controller_Twig extends Controller {

	/**
	 * @var View_Environment
	 */
	public $environment = 'default';
	/**
	 * @var boolean  Auto-render template after controller method returns
	 */
	public $auto_render = true;
	/**
	 * @var Twig template file name
	 */
	public $template_file;
    /**
	 * @var Twig view
	 */
	public $template;

	/**
	 * Setup view
	 *
	 * @return void
	 */
	public function before() {
        // Load the View template.
        $this->template = View::factory($this->template_file, $this->environment);
        // Get the View loaded environment
        $this->environment = $this->template->environment();
        
		if ($this->auto_render)
        {	
		}

		return parent::before();
	}

	/**
	 * Renders the template if necessary
	 *
	 * @return void
	 */
	public function after() {
        if (Kohana::$profiling === TRUE AND isset($_GET['debug']))
        {
            ob_start();
            include Kohana::find_file('views', 'profiler/stats', 'php');
            $this->template->profiler = ob_get_contents();
            ob_end_clean();
        }
		if ($this->auto_render) {
			// Auto-render the template
			$this->response->body($this->template->render());
		}
        
		return parent::after();
	}

} // End Controller_Twig