<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller\Admin;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class DengueController extends AppController
{
    var $dengueMapping = [
        'central' => 'Central',
        'northeast' => 'North East',
        'northwest' => 'North West',
        'southeast' => 'South East',
        'southwest' => 'South West',
        'cluster' => 'Cluster'
    ];

    private function getDengueInfo()
    {
        $this->loadModel('Dengue');

        $query = $this->Dengue->find('all');

        // Iteration will execute the query.
        foreach ($query as $row) {
        }

        // Calling execute will execute the query
        // and return the result set.
        $results = $query->all();

        // Once we have a result set we can get all the rows
        $data = $results->toArray();

        // Converting the query to an array will execute it.
        $results = $query->toArray();

        $this->set('dengueMapping', $this->dengueMapping);
        $this->set('dengue', $results);
    }

    public function index()
    {
        parent::index();
        
        $this->set('page', 'dengue');

        $this->getDengueInfo();
    }

    public function isAuthorized($user)
    {   
        // Logged in users can access
        if (isset($user['role']) && isset($user['status']) && $user['status'] === 'active') {
            return true;
        }

        // Default deny
        return false;
    }
}
