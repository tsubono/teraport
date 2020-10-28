<?php

use Illuminate\Database\Seeder;

class messageItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('message_items')->insert([
            [
                'message_id' => 1,
                'from_user_id' => 4,
                'to_user_id' => 2,
                'content' => '「勢しきりに一生けん命た。明方うなあ。まっ愉快なくて喜ぶてしまい。まだごうごうと肩の猫などひきましでして。」',
                'created_at' => date('Y-m-d H:i:s', strtotime("1 day")),
                'deleted_at' => null,
            ],

            [
                'message_id' => 2,
                'from_user_id' => 5,
                'to_user_id' => 3,
                'content' => '「い。すこしはんがきれうちた。」ゴーシュはひどくれてすって出したり口を猫でふみたり云っだましてセロを叫びたばはまたうるさいなりわけましで。',
                'created_at' => date('Y-m-d H:i:s', strtotime("2 day")),
                'deleted_at' => null,
            ],
            [
                'message_id' => 2,
                'from_user_id' => 3,
                'to_user_id' => 5,
                'content' => 'とりたはセロはどうもセロのようにぐっとふらふらゴーシュをあるたじ。',
                'created_at' => date('Y-m-d H:i:s', strtotime("2 day")),
                'deleted_at' => null,
            ],

            [
                'message_id' => 3,
                'from_user_id' => 5,
                'to_user_id' => 2,
                'content' => '川はまたいっぱい弾いながらてるましたので、「おいここをわかって来な」と見が何とかしたまし。',
                'created_at' => date('Y-m-d H:i:s', strtotime("3 day")),
                'deleted_at' => null,
            ],
            [
                'message_id' => 3,
                'from_user_id' => 2,
                'to_user_id' => 5,
                'content' => 'ドレミファ考えもまたがらんとしなだて面白く赤を額ホールが三拍つづけてラプソディよりしわたしにこどもが十日飛び立ちて「いきなりゴーシュ。腹から何気ないあげたよ。下を聞えがごらん。」',
                'created_at' => date('Y-m-d H:i:s', strtotime("3 day")),
                'deleted_at' => null,
            ],
            [
                'message_id' => 3,
                'from_user_id' => 5,
                'to_user_id' => 2,
                'content' => '野ねずみも楽長を弾くございようで飛びつきだなきゴーシュにめいめいとくわえたた。',
                'created_at' => date('Y-m-d H:i:s', strtotime("3 day")),
                'deleted_at' => null,
            ],


            [
                'message_id' => 4,
                'from_user_id' => 4,
                'to_user_id' => 3,
                'content' => '「はああ、また弾けましよ。」',
                'created_at' => date('Y-m-d H:i:s', strtotime("4 day")),
                'deleted_at' => null,
            ],
            [
                'message_id' => 4,
                'from_user_id' => 3,
                'to_user_id' => 4,
                'content' => 'ゴーシュ弾きはあげてどうかっこうをあとに一足になってた一つの勢とまわりだござい。',
                'created_at' => date('Y-m-d H:i:s', strtotime("4 day")),
                'deleted_at' => null,
            ],
            [
                'message_id' => 4,
                'from_user_id' => 4,
                'to_user_id' => 3,
                'content' => '「はあ、ゴーシュにくわえ今夜をぴたっと一日するのな。」',
                'created_at' => date('Y-m-d H:i:s', strtotime("4 day")),
                'deleted_at' => null,
            ],
            [
                'message_id' => 4,
                'from_user_id' => 3,
                'to_user_id' => 4,
                'content' => '「下もくそはくっつけか。」',
                'created_at' => date('Y-m-d H:i:s', strtotime("4 day")),
                'deleted_at' => null,
            ],

            [
                'message_id' => 5,
                'from_user_id' => 4,
                'to_user_id' => 2,
                'content' => '「光輝ぽんぽん猫にけりてい。',
                'created_at' => date('Y-m-d H:i:s', strtotime("1 day")),
                'deleted_at' => null,
            ],
            [
                'message_id' => 5,
                'from_user_id' => 2,
                'to_user_id' => 4,
                'content' => '血はへんに来とあかしたり気分を戻って野鼠と思っますでし。
                ',
                'created_at' => date('Y-m-d H:i:s', strtotime("1 day")),
                'deleted_at' => null,
            ],
            [
                'message_id' => 5,
                'from_user_id' => 4,
                'to_user_id' => 2,
                'content' => 'それから兎も入れてばかをがたがた落ちついたた。
                ',
                'created_at' => date('Y-m-d H:i:s', strtotime("1 day")),
                'deleted_at' => null,
            ],
            [
                'message_id' => 5,
                'from_user_id' => 2,
                'to_user_id' => 4,
                'content' => '「云いた、した。このんましましんた。」
                ',
                'created_at' => date('Y-m-d H:i:s', strtotime("1 day")),
                'deleted_at' => null,
            ],
            [
                'message_id' => 5,
                'from_user_id' => 4,
                'to_user_id' => 2,
                'content' => '「よかっなあ。それではそれまぜてごらん。」
                ',
                'created_at' => date('Y-m-d H:i:s', strtotime("1 day")),
                'deleted_at' => null,
            ],

            [
                'message_id' => 6,
                'from_user_id' => 5,
                'to_user_id' => 3,
                'content' => '「いきなりましの。」
                ',
                'created_at' => date('Y-m-d H:i:s', strtotime("2 day")),
                'deleted_at' => null,
            ],

            [
                'message_id' => 7,
                'from_user_id' => 2,
                'to_user_id' => 4,
                'content' => '口は赤へ思いから出してなかなか教えての「虎」とあとわらいないまし。」
                ',
                'created_at' => date('Y-m-d H:i:s', strtotime("3 day")),
                'deleted_at' => null,
            ],
            [
                'message_id' => 7,
                'from_user_id' => 4,
                'to_user_id' => 2,
                'content' => '「おまえ光輝。おまえがドレミファよ。何どもをも、こうして嘴は第一療は気の毒だんうね。」
                ',
                'created_at' => date('Y-m-d H:i:s', strtotime("3 day")),
                'deleted_at' => null,
            ],

            [
                'message_id' => 8,
                'from_user_id' => 3,
                'to_user_id' => 5,
                'content' => '「誰は合せまし。」
                ',
                'created_at' => date('Y-m-d H:i:s', strtotime("4 day")),
                'deleted_at' => null,
            ],
            [
                'message_id' => 8,
                'from_user_id' => 5,
                'to_user_id' => 3,
                'content' => '「いきなり弾いのたら。」
                ',
                'created_at' => date('Y-m-d H:i:s', strtotime("4 day")),
                'deleted_at' => null,
            ],
            [
                'message_id' => 8,
                'from_user_id' => 3,
                'to_user_id' => 5,
                'content' => '「ないんはこれから毎晩つかれるますのが行っんまし。」
                ',
                'created_at' => date('Y-m-d H:i:s', strtotime("4 day")),
                'deleted_at' => null,
            ],
        ]);
    }
}
