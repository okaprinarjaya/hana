<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('HelpdeskKnowledgebase');

/**
 * Auth methods
 *
 */
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function isAuthorized($user)
    {
        return parent::isAuthorized($user);
    }

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function display() {
		$this->layout = 'frontpage';
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}

		$knowledges = $this->getAllKnowledges();

		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->set('knowledges', $knowledges);

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			
			throw new NotFoundException();
		}
	}

	public function getAllKnowledges()
	{
		$articles = array();
		$categories = $this->HelpdeskKnowledgebase->HelpdeskKnowledgebaseCategory->find('all', array('order' => array('HelpdeskKnowledgebaseCategory.order_item' => 'asc')));

		foreach ($categories as $item) {
			$this->HelpdeskKnowledgebase->recursive = -1;
			$articles_by_category = $this->HelpdeskKnowledgebase->find('all', array(
				'conditions' => array('HelpdeskKnowledgebase.helpdesk_knowledgebase_category_id' => $item['HelpdeskKnowledgebaseCategory']['id'])
			));

			array_push($articles, array('category' => $item['HelpdeskKnowledgebaseCategory']['category_name'], 'items' => $articles_by_category));
		}

		return $articles;
	}
}
