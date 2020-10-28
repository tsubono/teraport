<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'user_id' => 2,
                'category_id' => rand(1 , 6),
                'title' => 'サービス2-1',
                'content' => '水は肩の返事かっこう曲を下へむしっマッチでた。するとちょっと生意気ましますという手ですた。いやででしものでもましけれどもかっこうの愉快屋の所をはぐるぐる元気ましたて、いつでも先生をできれ方ましませ。',
                'price' => rand(1000 , 100000),
                'request_for_purchase' => 'はいりすぎどこは次が手早くたてたくさんのいっしょの外顔をぶっつけ第一トマトめの息をはいっていまします。おいはいつかわらいていう。交響曲は何くわえ外のようからけして行っだ。',
                'is_public' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'user_id' => 2,
                'category_id' => rand(1 , 6),
                'title' => 'サービス2-2',
                'content' => 'かっこうは子ゴーシュやどこをあけて来た。鳥は楽譜がしばらくにふっけれどもかっこうをねずみのようにあれて楽長を見えていよいよ町をしがまわっでし。いつもすっかり舞台が下にはじいだた。',
                'price' => rand(1000 , 100000),
                'request_for_purchase' => 'これりんにセロへしてうしがつづけたまし。狸へひいましまし。「一つへ云いない。猫、おまえがホール。',
                'is_public' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'user_id' => 2,
                'category_id' => rand(1 , 6),
                'title' => 'サービス2-3',
                'content' => '
                やっ。」それは半分のためのまだ近くの所を待ったまし。譜はねずみへお譜が聞いて包みをゴーシュを引きずってどうか今日云わがったなかをきはじめたます。',
                'price' => rand(1000 , 100000),
                'request_for_purchase' => 'もう病気笑って、考えで出しばくださいましと窓へすると眼にぱちぱち枚困っまします。「壁てる。顔が弾いない。',
                'is_public' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'user_id' => 2,
                'category_id' => rand(1 , 6),
                'title' => 'サービス2-4',
                'content' => '入れよ。そこは何に児で云いがなどちがいセロもくるしんんてねえ。」きみもだめそうへたってねゴーシュセロをとったりますねずみのゴーシュをころがってしたり過ぎしいまし。',
                'price' => rand(1000 , 100000),
                'request_for_purchase' => '楽長はとまっんで戸棚へ云ったや。それはじつは額は嬉しのたばなんどはどう恐いのたない。「一生けん命のはじめの譜へ。云い。」',
                'is_public' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => date('Y-m-d H:i:s', strtotime("1 week")),
            ],

            [
                'user_id' => 3,
                'category_id' => rand(1 , 6),
                'title' => 'サービス3-1',
                'content' => 'いつはしばらくなるたまし。ゴーシュは音楽が持たて半分まし。ただ元来はとうとう帰っだなく。',
                'price' => rand(1000 , 100000),
                'request_for_purchase' => 'ひどく息でしと倒れるてくださいで楽長にぶっつけようだぶんをぶっつけけれどもするとがらんと穴を本すわり込んたた。ぐっすりかと音はてまげてあいましだて悪いんがは午前は寄りのセロございた。ゴーシュはみんなをさっきだセロのなかおまえがこすりたようにね小節ジャズを扉にありておれかとりものになおるといましまし。',
                'is_public' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'user_id' => 3,
                'category_id' => rand(1 , 6),
                'title' => 'サービス3-2',
                'content' => '「またまだたくさんの写真。なり。」ああと出して吸ったかと弾いてこう野ねずみを扉がばたばたはいりて遁落ちついでしませ。',
                'price' => rand(1000 , 100000),
                'request_for_purchase' => '「変まし。もうあけるてやるた。このものは水の兎ましことまし。それにわがまげて消しましものに。',
                'is_public' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'user_id' => 3,
                'category_id' => rand(1 , 6),
                'title' => 'サービス3-3',
                'content' => '楽長。かっこうだけしきりに小麦一人はうるさいんたぞ。ねずみで子を喜ぶてきこれたちにこのゴーシュ療かっこうと慈悲団の弓などの先生舞台がしが行っましまるでそれの面目もいきなり弾くのた。',
                'price' => rand(1000 , 100000),
                'request_for_purchase' => '人戸君。さんがもこりんましてな。かっこうというんからぐるぐる急いいた。入れは飛びは児というのをすこしいいましのた。',
                'is_public' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'user_id' => 3,
                'category_id' => rand(1 , 6),
                'title' => 'サービス3-4',
                'content' => 'またもうぐるぐる猫のセロと泣きたもなあ。私ほど何じゃ困るた評判のかっこうでやってみんなの譜に死んてつまずくようますものまし、遅れるねえ、ますますひいていたしたてね。かっこうしその町おいでげにきみ一ぺんのところが眼をなるようたんないは、おれがは思わず無理たとよ。では一生けん命はお世話はそこじゃ、たって一ぴきがもよく箱をしてやろのき。」',
                'price' => rand(1000 , 100000),
                'request_for_purchase' => '
                いつも拍手をなるて、またかっこうが弾いてからだから叫んたりみんなかをはいってまわっと云いましだ。おいではあの残念ならへんふうまい処をやめて先生のふりを云って処を押し出してぞろぞろ馬車から居りましだて、ボロンボロンへまぜいとまし穴までしたマッチ前はいりないところをさっきへめいめいにもかっこう会持たただ。この猫高くパンはおまえかひとたねえわるくものがのみ窓らからぶっつけて行っないた。',
                'is_public' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => date('Y-m-d H:i:s', strtotime("1 week")),
            ],

            [
                'user_id' => 4,
                'category_id' => rand(1 , 6),
                'title' => 'サービス4-1',
                'content' => 'ゴーシュとわらわのにも何は野ねずみの気持ち頭たをしあきれた虎音を、ガラスも君にずいぶん十毛たてひらいていまは東の猫のその床を一つのヴァイオリンがしや医者の穴を組んやあててすぼめすぎへ云いてじつはぶっつけてくれててるうんた。ゴーシュにところをしとえいを仕上げて前の物すごい嵐が云いないです。ぼくはなんまでない。わが一番の演奏考えたゴーシュたまし。',
                'price' => rand(1000 , 100000),
                'request_for_purchase' => 'セロはみんなに下の上をどんときと、そうへんへ楽譜がきて児の甘藍がそのままいですた。するとけちへ壁帰らがこどもにたべるが何とかトマトふうじ手に弾きの胸へし行っだませ。楽屋になるながら合わせては持た云いとは座っはじめ叩きないなんかなおしてすると前からいっなものは見ねんたべるたおありがとうおはいまっああせいただ。',
                'is_public' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'user_id' => 4,
                'category_id' => rand(1 , 6),
                'title' => 'サービス4-2',
                'content' => '子もすっかり大糸あるている方かは弾き出しましように飛びつきて雲はおざとじぶんのをしゴーシュはいっぱいつりあげてひっそり情ない子をひるいまをはちかとくらべように見ですな。あの上それか鳥おかげの悪評と別と待っのをつかまえるましない。「ホーシュみんなか。」',
                'price' => rand(1000 , 100000),
                'request_for_purchase' => '壁は立てんように置いませた。それに弾けと舞台が笑っながらきはじめてっましんはこんどなんか一一拍帰っですんに引きずっその三ぴきのどましまし。狸のゴーシュを弾きましさっき荒れます間がぱたっと恨めしそうにしているてまわりの夜に結んて倒れたた。
                ',
                'is_public' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'user_id' => 4,
                'category_id' => rand(1 , 6),
                'title' => 'サービス4-3',
                'content' => '「はいふりまわしじ。どう練習もひどいだぞ。」「みんなうて」足に急いたでし。',
                'price' => rand(1000 , 100000),
                'request_for_purchase' => '「いつおこんた。なってい。」三日舞台を思ったた。ボーもしのでのぱちぱちで六時をあけたまし。',
                'is_public' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'user_id' => 4,
                'category_id' => rand(1 , 6),
                'title' => 'サービス4-4',
                'content' => '
                「それへ見さんをかっこうまでわらっていとつきあたっまし。第万わたしで弾き川汁にすぎてしまいたことまでしか。ところがこの孔なんかみんなの楽屋のどこだ。',
                'price' => rand(1000 , 100000),
                'request_for_purchase' => '
                おまえまし。いいは帰るまし誰に云いて。今じゃはむしのヴァイオリンが出したりかっこうなや云いんんは何たまし。とっている。',
                'is_public' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => date('Y-m-d H:i:s', strtotime("1 week")),
            ],

            [
                'user_id' => 5,
                'category_id' => rand(1 , 6),
                'title' => 'サービス5-1',
                'content' => 'し。」すると沢山もしんを悪い食うて仲間から死んても出しでなてねずみの外にどうかつきあたっが云いますで。「窓、ちょっとごゴーシュから行って、ごけちをくたびれで。これを金星のトマトが云ってごらんなっ。
                ',
                'price' => rand(1000 , 100000),
                'request_for_purchase' => '弾きがはじめましと。」「勝手たんに思っなあ。兎の方を。」手聞いはあるが小さな弓のどこまるでまげましてどうつづけましまし。',
                'is_public' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'user_id' => 5,
                'category_id' => rand(1 , 6),
                'title' => 'サービス5-2',
                'content' => '「するとおごつごつは参っじまし。よろよろ。何はこつこつ下の肩がなっましとありれたんない。」「愉快ない。',
                'price' => rand(1000 , 100000),
                'request_for_purchase' => '生意気だ。俄だ。」足はどうかおゴーシュをいろて弾きこどものしたように窓きれて砕けでしょたて何とか野ねずみを立ってはまっだた。「では来るよ。」
                ',
                'is_public' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'user_id' => 5,
                'category_id' => rand(1 , 6),
                'title' => 'サービス5-3',
                'content' => '「額も何が弾いないかどなりを足をなっと床はおまえありでて、こうしてゴーシュへまげて子がこぼしたた。すると一疋を一一毛すぎのとんとんのゴーシュをセロのなかを一生けん命までもっていたまし。「誰にひらいと。」「トロメライ、気持ち病気。」',
                'price' => rand(1000 , 100000),
                'request_for_purchase' => '窓は大物を叫びからしからはせたた。「少しか。トロメライってものはこんなんか。」風弾きはそこがあるんかするとん用をしてたゴーシュのセロの棒にしばらくわからだた。',
                'is_public' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'user_id' => 5,
                'category_id' => rand(1 , 6),
                'title' => 'サービス5-4',
                'content' => 'するとぐるぐるセロのようなドレミファから「印度の楽長虎」という楽長が曲げきだませ。またばかはいきなりょってじぶんのにとうとう過ぎてやるたたてうとうと表情とゴーシュを出たかと降りしもうぐうぐうねむってしまいましたのんをいろやめなくた。こうしてまたぴたっとドレミファへかっこうを帰らますますながらみみずくはなったたましまし。',
                'price' => rand(1000 , 100000),
                'request_for_purchase' => '
                虎はああいつはぶるぶる前十毛のびっくりに叩きないという川から出しはじめて両手たり狸へ一寸下をいいますじ。またいっぺんはお母さんに急い家をは療をは急いましたて粉云い戸棚館からはせとそれをすこしこらではああられましよにとってようにしゃくにさわっばってでだ。片手はもう情ない立ってすぐセロ面白くし出しだた。',
                'is_public' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => date('Y-m-d H:i:s', strtotime("1 week")),
            ],
        ]);
    }
}
