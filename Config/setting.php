<?php
/**
 * [BcMailSpamFilter] Config
 *
 * @link			http://blog.kaburk.com/
 * @author			kaburk
 * @package			BcMailSpamFilter
 * @license			MIT
 */
App::uses('BcMailSpamFilterUtil', 'BcMailSpamFilter.Lib');

$config = array();

CakeLog::config('spam', array(
	'engine' => 'BcFile',
));
