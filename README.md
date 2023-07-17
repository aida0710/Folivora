# Folivora

- 生さば公式サイト https://nkserver.net
- 自己紹介サイト https://lazyperson0710.tech

## 概要
[なま鯖](https://nkserver.net)のプラグインになります。<br>
現在の構成を維持したまま全ての機能を書き直すことによりプロジェクトの可用性と私の技術向上を目的としています。<br>
空き時間に作業しているため、進捗は遅いです。<br>
## 環境

- PHP 8.1.*
- PocketMine-MP 4.*

## ライセンス
[MIT License](https://github.com/lazyperson0710/Folivora/blob/main/LICENSE)
## Markdown記法の統一

- 改行は可読性を維持するため`<br>`で表現してください
- 箇条書きは`-`で行ってください
- 引用は`>`で行ってください

## コードスタイルの統一
基本的に[CodeStyle.xml](/CodeStyle.xml)を使用しています。<br>
PhpStormのコードスタイルから読み込んでいただけたらと思います。
## cs-fixerに関して
cs-fixerの設定は[.php-cs-fixer.dist.php](/.php-cs-fixer.dist.php)に記述しています。<br>
また、設定を見て頂ければわかる通り`declare(strict_types = 1);`を付与するためだけに存在しています。<br>
## その他コードの記述規約

- 変数名、関数名はキャメルケースで記述してください
- ディレクトリ名はスネークケースで記述してください
- exceptionクラスはエラー内容をexceptionクラス内に定数でメッセージとして記述し統一化を図ってください

## ブランチについて

- main - 安定版(直接のコミット・プッシュ厳禁)
- develop - 開発・作業用ブランチ(直接のコミット・プッシュ基本NG)
- feature - 機能追加etc用 developから切ってdevelopにマージ、マージ後削除
- hotfix - バグ対応用。developから分岐し、全ブランチにマージ。マージ後削除
- release - リリース前に準備や微調整。developから切ってmasterにマージしてdevelopにマージ
