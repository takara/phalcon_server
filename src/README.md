# 作成手順
# マイグレーション
## phalcon-devtools

```
phalcon migration generate
```
上記のコマンドを叩くと現在のDBが1.0.0、1.0.1のようなディレクトリが作成されバックアップのような感じで作られる。
これって動きにいくつか問題がある。

+ マイグレーションの名前が勝手に決まるのは良いが、複数の開発者がいるとコマンドをそれぞれの環境で叩けない
+ マイグレーションが当てられているバージョンの管理がファイル(.phalcon/migration-version)になっている。複数環境有るとズレが生じる。


## phpmigインストール

純正のマイグレーションツールは諦めphpmigを使ってみる（中立な感じなので他のフレームワークでも使えそう）

### インストール

```
composer require davedevelopment/phpmig
vendor/bin/phpmig init
```

初期化すると[phpmig.php](https://github.com/takara/phalcon_server/blob/master/src/phpmig.php)というファイルが作られるので、phalconと連動できるように書き換える。

+ フォルダの書き換え `migrations` → `app/migrations`
+ デフォルトでは現在のバージョンをファイルで管理されるのでDBの中で管理するように変更
+ 専用のクラスで記述される

## テーブル追加
```
phpmig generate AddPlayer
```
上記コマンドだと以下のようなファイル名で作られる
`app/migrations/20180726183618_AddPlayer.php`

使ってみてこちらの方が良さそうである。

+ 名前と作った日付で作られる（開発者が複数いてもコマンドを叩ける)
+ どのファイルをあてたか、DBで管理される（というかそうした、これにりより複数の環境を最新に保てる）
+ SQLを直接記述するようにした（学習コストが低くなる）

# ユニットテスト
## phpunitインストール

以下のドキュメントで進めたが下のようなエラーになる。phalcon自体のバージョンは3.4.0だから駄目なのかな？
最初から動くようにUnitTestに対応してほしいなぁ

[ユニットテスト — Phalcon 3.0.2 ドキュメント](https://phalcon-docs-ja.readthedocs.io/ja/stable/reference/unit-testing.html)

```
# phpunit
PHP Fatal error:  Class 'Tests\Behat\Gherkin\Keywords\KeywordsTest' not found in /var/www/server/vendor/behat/gherkin/tests/Behat/Gherkin/Keywords/ArrayKeywordsTest.php on line 9

Fatal error: Class 'Tests\Behat\Gherkin\Keywords\KeywordsTest' not found in /var/www/server/vendor/behat/gherkin/tests/Behat/Gherkin/Keywords/ArrayKeywordsTest.php on line 9
```

`Phalcon` と `PHPUnit` は相性悪いのかなぁ？
何回かやってるけどうまく動かない・・・