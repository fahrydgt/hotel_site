<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| FL INITIAL CONFIGS 
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SYSTEM_NAME', 'Hotel Web');
define('SYSTEM_SHOTR_NAME', 'H Web');
define('SYSTEM_POWERED_BY', 'Zone Venture');


/*
|--------------------------------------------------------------------------
| FL INITIAL SETUPS
|--------------------------------------------------------------------------
|
| Controlling the process
|
 */
//  1--> enabed; 0-->disabled
define('SYSTEM_LOG_ENABLE', 1);

 /*
|--------------------------------------------------------------------------
| DB Tables
|--------------------------------------------------------------------------
|
| These are used to database table  name
|
*/
//FL TABLE PREFIX
define('TB_PREFIX',      		'');

define('USER_TBL',      		TB_PREFIX.'user_auth');
define('USER_ROLE',      		TB_PREFIX.'user_role');
define('USER',                          TB_PREFIX.'user_details');
define('MODULES',                       TB_PREFIX.'modules');
define('MODULES_ACTION',                TB_PREFIX.'module_actions');
define('MODULE_USER_ROLE_ACT',          TB_PREFIX.'module_user_role');
//define('HOTELS',                        TB_PREFIX.'hotels');
define('COMPANIES',                     TB_PREFIX.'company');
define('COUNTRY_LIST',                  TB_PREFIX.'countries');
define('SYSTEM_LOG',                    TB_PREFIX.'system_log');
define('SYSTEM_LOG_DETAIL',             TB_PREFIX.'system_log_detail');
define('BANNERS',                       TB_PREFIX.'cms_banner');
define('DROPDOWN_LIST',                 TB_PREFIX.'dropdown_list');
define('DROPDOWN_LIST_NAMES',           TB_PREFIX.'dropdown_list_names');
define('FACILITIES',                    TB_PREFIX.'facilities');
define('FACILITIES_CAT',                TB_PREFIX.'facilities_category');
define('PROPERTY_SURROUND',             TB_PREFIX.'property_surrounding');
define('PROPERTY_SURROUND_CAT',         TB_PREFIX.'property_surrounding_category');
define('HOTELS',                        TB_PREFIX.'hotels');
define('HOTEL_RESOURCE',                TB_PREFIX.'hotel_resources');
define('HOTEL_IMAGES_TBL',              TB_PREFIX.'hotel_images');
define('TARRIF_TYPE',                   TB_PREFIX.'tarrif_type');
define('TARRIF_TYPE_CAT',               TB_PREFIX.'tarrif_type_category');
define('ROOMS',                         TB_PREFIX.'rooms');
define('TIME_BASE',                     TB_PREFIX.'time_base');
define('MEALPLAN',                      TB_PREFIX.'mealplan');
define('CURRENCY',                      TB_PREFIX.'currency');
define('PRICEPLAN',                     TB_PREFIX.'price_plan');
define('PRICEPLAN_AMOUNT',              TB_PREFIX.'price_plan_amount');
define('ACTIVITIES',                    TB_PREFIX.'activities');
define('ACTIVITY_RESOURCE',             TB_PREFIX.'activity_resources');
define('ACTIVITY_IMAGES_TBL',           TB_PREFIX.'activity_images');
define('ACTIVITY_EVENTS',               TB_PREFIX.'activity_events');
define('ACTIVITY_PRICE_CAT',            TB_PREFIX.'activity_price_cat');
define('ACTIVITY_PRICEPLAN',            TB_PREFIX.'activity_priceplan');


/*
|--------------------------------------------------------------------------
| MESSAGES
|--------------------------------------------------------------------------
|
| Success Error....messages
|
*/

//define('HOTEL_LOGO',	'./storage/images/company/');
define('RECORD_ADD',	'Record added Successfully');
define('RECORD_UPDATE',	'Record updated Successfully');
define('RECORD_DELETE',	'Record Deleted Successfully');
define('ERROR',	'Error! Something went wrong.');

/*
|--------------------------------------------------------------------------
| STORAGE PLACES 
|--------------------------------------------------------------------------
|
| These are containing all the file storage places
|
*/

//define('HOTEL_LOGO',	'./storage/images/company/');
define('SAMPLE_PIC',	'./storage/images/');
define('COMPANY_LOGO',	'./storage/images/company/');
define('USER_PROFILE_PIC',	'./storage/images/users/profile/');
define('DB_BACKUPS',	'./storage/backups/database_backup/');
define('FILE_BACKUPS',	'./storage/backups/file_backups/');
define('DEFAULT_PIC',	'./storage/images/default/default.jpg');
define('BANNERS_PIC',	'./storage/images/CMS/banners/');
define('HOTEL_LOGO',	'./storage/images/hotels/hotel_logo/');
define('HOTEL_IMAGES',	'./storage/images/hotels/hotel_images/');
define('ROOM_IMAGES',	'./storage/images/rooms/room_images/');
define('ACTIVITY_LOGO',	'./storage/images/activities/activity_logo/');
define('ACTIVITY_IMAGES',	'./storage/images/activities/activity_images/');
/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
