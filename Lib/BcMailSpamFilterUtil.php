<?php
/**
 * [BcMailSpamFilter] Util
 *
 * @link			http://blog.kaburk.com/
 * @author			kaburk
 * @package			BcMailSpamFilter
 * @license			MIT
 */
class BcMailSpamFilterUtil extends Object {

	/**
	 * オプション項目をチェック
	 *
	 * @param type $fields
	 * @param type $data
	 * @return boolean
	 */
	public static function checkFilter($fields, $data) {

		foreach ($fields as $field) {

			$filter = '';
			if (isset($field['BcMailSpamFilter']['filter'])) {
				$filter = $field['BcMailSpamFilter']['filter'];
			} else {
				$BcMailSpamFilterModel = ClassRegistry::init('BcMailSpamFilter.BcMailSpamFilter');
				$BcMailSpamFilter = $BcMailSpamFilterModel->find('first', array(
					'conditions' => array(
						'BcMailSpamFilter.mail_field_id' => $field['MailField']['id'],
					)
				));
				if (isset($BcMailSpamFilter['BcMailSpamFilter']['filter'])) {
					$filter = $BcMailSpamFilter['BcMailSpamFilter']['filter'];
				}
			}

			if (isset($field['MailField'])) {
				$field = $field['MailField'];
			}

			if ($filter) {
				$pattern = str_replace('*', '(.*?)', $filter);
				$pattern = str_replace('/', '\/', $filter);
				$fieldName = $field['field_name'];
				if (preg_match("/(.*?)${pattern}(.*?)/si", $data[$fieldName])) {
					// マッチングしたらスパム判定とする

					// ログへ出力
					$request = Router::getRequest();
					CakeLog::write('spam', print_r([
						'url' => $request->url,
						'IPAddress' => $request->ClientIp(false),
						'UserAgent' => $request->header('User-Agent'),
						'Referer' => $request->referer(),
					], true));
					CakeLog::write('spam', print_r($request->data['MailMessage'], true));

					return false;
				}
			}
		}
		return true;
	}

}
