<?php
/**
 * [BcMailSpamFilter] ControllerEventListener
 *
 * @link			http://blog.kaburk.com/
 * @author			kaburk
 * @package			BcMailSpamFilter
 * @license			MIT
 */
class BcMailSpamFilterControllerEventListener extends BcControllerEventListener {

	public $events = array(
		'Mail.Mail.beforeRender',
	);

	public function mailMailBeforeRender(CakeEvent $event) {

		$Controller = $event->subject();

		// 送信確認→完了画面の場合にスパムフィルタでチェックする
		if ($Controller->request->action == 'confirm' || $Controller->request->action == 'submit') {

			if (isset($Controller->dbDatas['mailFields'])) {

				$result = BcMailSpamFilterUtil::checkFilter(
					$Controller->dbDatas['mailFields'],
					$Controller->request->data['MailMessage']
				);

				if (!$result) {
					// エラーメッセージ等を削除
					CakeSession::delete('Message.flash');

					// サイトTOPへリダイレクト
					$url = siteUrl();
					if ($url) {
						$Controller->redirect($url);
					}
				}

				return $result;
			}
		}
	}

}
