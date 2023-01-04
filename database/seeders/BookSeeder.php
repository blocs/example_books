<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 全件削除.
        Book::truncate();

         Book::factory()->create([
             'id' => 1,
             'title' => '独習PHP 第4版',
             'price' => 3740,
             'abstract' => 'PHP8でWebアプリケーションを開発する際に必要な基礎的な知識、PHPの基礎構文から、クラス、データ連携、セキュリティまで、詳細かつ丁寧に解説します。'
         ]);

         Book::factory()->create([
             'id' => 2,
             'title' => 'PHP本格入門[上] ~プログラミングとオブジェクト指向の基礎からデータベース連携まで',
             'price' => 3938,
             'abstract' => 'Webアプリケーションの定番言語であるPHPの基礎から実践までを、上下巻のフルボリュームで集大成。'
         ]);

         Book::factory()->create([
             'id' => 3,
             'title' => 'PHPフレームワーク Laravel入門 第2版',
             'price' => 2673,
             'abstract' => 'PHPフレームワークのロングセラー定番解説書が、新バージョン対応で改訂！ 本書は、Laravelのインストールから、フレームワークの中心になるModel-View-Controller（MVC）の使い方、開発に役立つ各種機能をわかりやすく解説した入門書です。'
         ]);

         Book::factory()->create([
             'id' => 4,
             'title' => '初心者からちゃんとしたプロになる PHP基礎入門〈PHP8対応〉',
             'price' => 2750,
             'abstract' => '変数、演算子、条件分岐、配列、ループ処理といったPHPの基本的な文法と使い方をマスターしたあと、シンプルなWebアプリケーションを作成しながら、PHPプログラミングの考え方と書き方を実践的に学んでいくことができます。'
         ]);
    }
}
