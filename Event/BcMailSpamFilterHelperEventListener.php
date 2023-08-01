<?php
/**
 * [BcMailSpamFilter] HelperEventListener
 *
 * @link			http://blog.kaburk.com/
 * @author			kaburk
 * @package			BcMailSpamFilter
 * @license			MIT
 */
class BcMailSpamFilterHelperEventListener extends BcHelperEventListener {

	/**
	 * 登録イベント
	 *
	 * @var array
	 */
	public $events = array(
		'Form.afterForm',
	);

	/**
	 * formAfterEnd
	 *
	 * @param CakeEvent $event
	 * @return string
	 */
	public function formAfterForm(CakeEvent $event) {

		$View = $event->subject();

		if (BcUtil::isAdminSystem()) {

			// メールフィールドにスパムフィルタ項目を追加
			if ($View->request->params['controller'] == 'mail_fields' &&
				($event->data['id'] == 'MailFieldAdminEditForm' ||
				 $event->data['id'] == 'MailFieldAdminAddForm' ||
				 $event->data['id'] == 'MailFieldEditForm' ||
				 $event->data['id'] == 'MailFieldAddForm')) {
					$View = $event->subject();
					$input = $View->BcForm->input('BcMailSpamFilter.filter', ['type' => 'text', 'size' => '50' ,'class' => 'bca-textbox__input']);
					$event->data['fields'][] = [
						'title' => 'スパムフィルター文字列',
						'input' => $input,
					];
			}
		}
	}

}
