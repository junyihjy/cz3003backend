<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\Router;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass('Route');

Router::scope('/', function ($routes) {
    $routes->connect('/', ['controller' => 'Dashboard']);
    $routes->connect('/about', ['controller' => 'About']);
    $routes->connect('/subscribe', ['controller' => 'Subscribe']);
    $routes->connect('/subscribe/subscribe', ['controller' => 'Subscribe', 'action' => 'subscribe']);
    $routes->connect('/incident', ['controller' => 'Incident']);
    $routes->connect('/report', ['controller' => 'Incident', 'action' => 'report']);
    $routes->connect('/dengue', ['controller' => 'Dengue']);
    $routes->connect('/haze', ['controller' => 'Haze']);
    $routes->connect('/contact', ['controller' => 'Contact']);
    $routes->connect('/faqs', ['controller' => 'Faqs']);

    $routes->extensions(['json']);
    $routes->resources('Incident', [
        'only' => ['index', 'create'],
        'actions' => ['create' => 'index']
    ]);

    $routes->resources('Dengue');
    $routes->resources('Haze');

});


Router::prefix('admin', function ($routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Staff', 'action' => 'login']);
    $routes->connect('/login', ['controller' => 'Staff', 'action' => 'login']);
    $routes->connect('/forgot_password', ['controller' => 'Staff', 'action' => 'forgotPassword']);
    $routes->connect('/logout', ['controller' => 'Staff', 'action' => 'logout']);

    $routes->connect('/dashboard', ['controller' => 'Dashboard']);
    $routes->connect('/agency', ['controller' => 'Agency']);
    $routes->connect('/dengue', ['controller' => 'Dengue']);
    $routes->connect('/haze', ['controller' => 'Haze']);
    $routes->connect('/incidentCategory', ['controller' => 'IncidentCategory']);
    $routes->connect('/incident', ['controller' => 'Incident']);
    $routes->connect('/incident/add', ['controller' => 'Incident', 'action' => 'add']);
    $routes->connect('/reportIncident', ['controller' => 'ReportIncident']);

    $routes->connect('/staff', ['controller' => 'Staff']);
    $routes->connect('/editProfile', ['controller' => 'Staff', 'action' => 'editProfile']);

    $routes->connect('/subscriber', ['controller' => 'Subscriber']);

    $routes->extensions(['json']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `InflectedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'InflectedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'InflectedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('InflectedRoute');
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
