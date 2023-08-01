<?php
/**
 * [BcMailSpamFilter] config
 *
 * @link			http://blog.kaburk.com/
 * @author			kaburk
 * @package			BcMailSpamFilter
 * @license			MIT
 */
$title = '簡易スパムフィルタプラグイン';
$description = <<< __TEXT__
	メールフォーム用の簡易スパムフィルタプラグインです。
	メールフォーム管理：メールフィールド一覧より、オプション欄のスパムフィルタ項目に制限したい文字列を追記すると
	フォーム送信時入力値とマッチした場合にスパムと判定して確認画面を表示せずTOPページへリダイレクトします。
	スパム判定時はDBにデータを保存せず、メールも送信されません。
__TEXT__;
$author = 'kaburk';
$url = 'https://blog.kaburk.com/';
