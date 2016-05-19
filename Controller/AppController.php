<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array(
                        'password' => 'userpassword'
                    )
                )
            ),
        	'logoutRedirect' => array(
        		'controller' => 'pages',
        		'action' => 'display'
        	),
            'loginRedirect' => array(
                'controller' => 'dashboard',
                'action' => 'index'
            ),
        	'loginAction' => array(
        		'controller' => 'users',
        		'action' => 'login'
        	),
        	'autoRedirect' => true,
        	'authorize' => array('Controller')
        )
    );

	public $helpers = array('MenuNavigation', 'Time');

    public function canUploadMedias($model, $id) {
        return true;
    }

    public function isAuthorized($user)
    {
        return true;
    }
}
