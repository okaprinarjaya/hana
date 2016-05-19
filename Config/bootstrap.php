<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. Make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */
CakePlugin::loadAll();

/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter . By default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 *		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 *		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 * 		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 *		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');

CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));

CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));

define('TICKET_STATUS_OPEN', 0);
define('TICKET_STATUS_PROCESS', 1);
define('TICKET_STATUS_CLOSE', 2);

define('USER_LEVEL_1', 1);
define('USER_LEVEL_2', 2);
define('USER_LEVEL_3', 3);

define('PRIORITY_HIGH', 1);
define('PRIORITY_MEDIUM', 2);
define('PRIORITY_LOW', 3);

function getWDays($startDate, $holidays = array(), $wDays) {
    
    // using + weekdays excludes weekends
    $new_date = date('Y-m-d', strtotime("{$startDate} +{$wDays} weekdays"));

    $extra_days = 0;
	foreach ($holidays as $holiday) {
	    $holiday_ts = strtotime($holiday);
		
		// if holiday falls between start date and new date, then account for it
		if ($holiday_ts >= strtotime($startDate) && $holiday_ts <= strtotime($new_date)) {
		
		    // check if the holiday falls on a working day
			$h = date('w', $holiday_ts);
			if ($h != 0 && $h != 6 ) {
			    // holiday falls on a working day, add an extra working day
				$extra_days = $extra_days + 1;
			}
		}
	}
	
	if ($extra_days > 0) {
	    $new_date = date('Y-m-d', strtotime("{$new_date} +{$extra_days} weekdays"));
	}

    return $new_date;
}

function months()
{
	return array(
		1 => 'January',
		2 => 'February',
		3 => 'March',
		4 => 'April',
		5 => 'May',
		6 => 'June',
		7 => 'July',
		8 => 'August',
		9 => 'September',
		10 => 'October',
		11 => 'November',
		12 => 'December'
	);
}

function months_short()
{
	return array(
		1 => 'Jan',
		2 => 'Feb',
		3 => 'Mar',
		4 => 'Apr',
		5 => 'May',
		6 => 'June',
		7 => 'July',
		8 => 'Aug',
		9 => 'Sept',
		10 => 'Oct',
		11 => 'Nov',
		12 => 'Dec'
	);
}

function id_days()
{
	return array(
		1 => 'Senin',
		2 => 'Selasa',
		3 => 'Rabu',
		4 => 'Kamis',
		5 => 'Jumat',
		6 => 'Sabtu',
		7 => 'Minggu'
	);
}

function ticket_statuses()
{
	return array(
		0 => 'OPEN',
		1 => 'ON PROCESS',
		2 => 'CLOSE'
	);
}

function user_levels()
{
	return array(
		1 => 'Level 1',
		2 => 'Level 2',
		3 => 'Level 3'
	);
}

function priorities()
{
	return array(
		1 => 'HIGH',
		2 => 'MEDIUM',
		3 => 'LOW'
	);
}

function currencies()
{
	return array(
		1 => 'IDR',
		2 => 'FOREIGN CURRENCY'
	);
}