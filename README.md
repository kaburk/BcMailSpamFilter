# BcMailSpamFilter （簡易スパムフィルタプラグイン）

メールフォーム用の簡易スパムフィルタプラグインです。
baserCMS4系で動作します。

## Installation

1. 圧縮ファイルを解凍後、BASERCMS/app/Plugin/BcMailSpamFilter に配置します。
2. 管理システムのプラグイン管理に入って、表示されている BcMailSpamFilter プラグイン を有効化して下さい。
3. メールフォーム管理：メールフィールド一覧より、制限をかけたいフィールドの編集画面を表示します。
4. スパムフィルター文字列 項目に制限したい文字列を追記します。
5. お問合せフォームでフォーム送信時に上記で設定した値とマッチした場合にはスパムと判定されます。
6. その場合、確認画面を表示せずそのままTOPページへリダイレクトします。

## Caution

* スパム判定された場合はデータベースにデータを保存する設定にしていても保存されず、メールも送信されません。
* また、スパム判定された場合は app/tmp/logs/spam.log へ送信内容を記録します。

## TODO

気が向いたら作るかも？

* カンマ区切りなどで複数のキーワードを設定可能にする
* スパム判定されたときに通知する手法を検討する
* ログではなく管理画面上でスパム判定結果を確認できるようにする
* 何度もアタックしてくるBOTをIPアドレスなどで判別してロックかけるような仕組み

## Thanks

- [http://basercms.net/](http://basercms.net/)
- [http://wiki.basercms.net/](http://wiki.basercms.net/)
- [http://cakephp.jp](http://cakephp.jp)
- [Semantic Versioning 2.0.0](http://semver.org/lang/ja/)
