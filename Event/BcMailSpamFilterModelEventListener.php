<?php
/**
 * [BcMailSpamFilter] ModelEventListener
 *
 * @link			http://blog.kaburk.com/
 * @author			kaburk
 * @package			BcMailSpamFilter
 * @license			MIT
 */
class BcMailSpamFilterModelEventListener extends BcModelEventListener {

	public $events = array(
		'Mail.MailField.beforeFind',
		'Mail.MailField.afterSave',
	);
	public $BcMailSpamFilterModel = null;

	/**
	 * モデル初期化
	 *
	 * @return void
	 */
	private function setUpModel() {
		if (ClassRegistry::isKeySet('BcMailSpamFilter.BcMailSpamFilter')) {
			$this->BcMailSpamFilterModel = ClassRegistry::getObject('BcMailSpamFilter.BcMailSpamFilter');
		} else {
			$this->BcMailSpamFilterModel = ClassRegistry::init('BcMailSpamFilter.BcMailSpamFilter');
		}
	}

	/**
	 * mailMailFieldBeforeFind
	 *
	 * @param CakeEvent $event
	 * @return array
	 */
	public function mailMailFieldBeforeFind(CakeEvent $event) {

		$Model = $event->subject();
		$Model->bindModel(array(
			'hasOne' => array(
				'BcMailSpamFilter' => array(
					'className' => 'BcMailSpamFilter.BcMailSpamFilter',
					'foreignKey' => 'mail_field_id',
				)
			),
			), true);

		return $event->data;
	}

	/**
	 * mailMailFieldAfterSave
	 *
	 * @param CakeEvent $event
	 */
	public function mailMailFieldAfterSave(CakeEvent $event) {

		if (!BcUtil::isAdminSystem()) {
			return true;
		}

		$Model = $event->subject();

		$params = Router::getParams();
		if ($params['action'] != 'admin_add' &&
			$params['action'] != 'admin_edit') {
			// 新規作成、編集以外は保存しない。
			return true;
		}

		$this->setUpModel();
		$Model->data['BcMailSpamFilter']['mail_field_id'] = $Model->id;
		if (!$this->BcMailSpamFilterModel->save($Model->data['BcMailSpamFilter'])) {
			$this->log(sprintf('メールフィールドID：%s のスパムフィルタの保存に失敗', $Model->id));
			return false;
		}
	}
}
