<?php
/**
 * [BcMailSpamFilter] CakeSchema
 *
 * @link			http://blog.kaburk.com/
 * @author			kaburk
 * @package			BcMailSpamFilter
 * @license			MIT
 */
class BcMailSpamFiltersSchema extends CakeSchema {

	public $file = 'bc_mail_spam_filters.php';
	public $connection = 'default';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {

	}

	public $bc_mail_spam_filters = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary', 'comment' => 'ID'),
		'mail_field_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => 'メールフィールドID'),
		'filter' => array('type' => 'string', 'null' => true, 'default' => null, 'comment' => 'スパムフィルタ文字列'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '更新日'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '作成日'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
		),
	);

}
