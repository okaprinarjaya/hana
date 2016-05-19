<?php
App::uses('AppController', 'Controller');

class KbController extends AppController
{
	public $uses = array('HelpdeskKnowledgebase');
	public $components = array('Paginator');

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

	public function detail($article_id)
	{	
		$this->layout = 'frontpage-detail';

		$article = $this->HelpdeskKnowledgebase->find('first', array(
			'conditions' => array('HelpdeskKnowledgebase.id' => $article_id)
		));

		$this->set('article', $article);
		$this->set('knowledges', $this->getAllKnowledges());
	}

	public function search()
	{
		$this->layout = 'frontpage';

		$this->Paginator->settings = array(
			'conditions' => array(
				'OR' => array(
					array('HelpdeskKnowledgebase.title LIKE' => "%{$this->request->query['key']}%"),
					array('HelpdeskKnowledgebase.content LIKE' => "%{$this->request->query['key']}%")
				)
			),
			'fields' => array('HelpdeskKnowledgebase.id', 'HelpdeskKnowledgebase.title'),
			'order' => array('HelpdeskKnowledgebase.helpdesk_knowledgebase_category_id' => 'ASC')
		);

		$this->set('knowledges', $this->Paginator->paginate($this->HelpdeskKnowledgebase));
	}

	private function getAllKnowledges()
	{
		$articles = array();
		$categories = $this->HelpdeskKnowledgebase->HelpdeskKnowledgebaseCategory->find('all');

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