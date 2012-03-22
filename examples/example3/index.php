<?php
/**
*
* LICENSE:	MIT License
*
* slf PHP is an php micro-framework released under MIT License
* You should have received a copy of the MIT License along with this program.
* If not, see http://www.opensource.org/licenses/mit-license.php
*
*
* @copyright  2011 Ben Doran
* @author     Ben Doran - ben.doran@bdoran.co.uk
* @license    http://www.opensource.org/licenses/mit-license.php
* @version    1.0
* @link       http://bdoran.co.uk/slf-php
*/

// ------------------------------------------------------------------------

/**
 * MVC ( With MySQL ) Example
 */
//Set the Timezone
date_default_timezone_set( "Europe/London" );

//Include the Framework
include_once '../../core/slf.php';
$slf = slf::get_instance(); 

//Set Up the DB Connection
$slf->set_config( slf::$CONFIG_DB, array(
	'server' => 'localhost',
	'username' => 'root',
	'password' => 'password',
	'database' => 'slf_examples' 
));

//Set Some Pre-Configuration
$slf->set_config( slf::$CONFIG_CORE_LOCATION, "../../core" );

//Boot the Framework
$slf->boot();
