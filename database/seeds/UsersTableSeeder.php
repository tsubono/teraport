<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'ユーザー1 (管理者)',
                'email' => 'user1@test.com',
                'password' => bcrypt('secret'),
                'icon_image_path' => '/img/face0.png',
                'introduction' => 'そこは朝とうとうその運動屋というののためをするましです。あに元来をお話し方ももっとその講演ですましともを足りけれどもおいありをは附与するうたいば、ずいぶんには食っうたませた。外国にしないのはまあ時間がおっつけましたます。',
                'job' => '管理者',
                'gender' => '女性',
                'area' => '関東',
                'is_admin' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'ユーザー2',
                'email' => 'user2@test.com',
                'password' => bcrypt('secret'),
                'icon_image_path' => '/img/face1.png',
                'introduction' => 'もし岡田君に用意がたそう真似にありな一つわが手私か真似をというお教育うませべきならて、同じ今日は私か世界先生で云って、嘉納さんのものが代りの私にいやしくも同ぼんやりとなっが私主義にお交渉に出さようにとにかくごお話が縛りつけましんて、ましてたしか道楽を考えらしいているですのになるんまし。けれどもさてご政府に使えるものはいろいろ共通としなて、その会員ではなっないとという内意にやまてならたない。',
                'job' => '僧侶',
                'gender' => '男性',
                'area' => '東北',
                'is_admin' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'ユーザー3',
                'email' => 'user3@test.com',
                'password' => bcrypt('secret'),
                'icon_image_path' => '/img/face2.png',
                'introduction' => '覚だなたて、自己の時を示威をほかだけの泰平を九月考えるばならて、ちょっとの今日が取り巻かとその限りがどうか困るたないと聴いないものでしと、多いずですといろいろ大町内妨げない事なけれであり。つまり自分か妙か病気の解らたて、今いっぱい事業にしばならでしょ以上からご真似の十月に云っだない。今ではいやしくも云っで行っますたたでが、幾分いよいよきめからまごまごもちょっと怪しからなかっ事でしょ。',
                'job' => '僧侶',
                'gender' => '男性',
                'area' => '東海',
                'is_admin' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'ユーザー4',
                'email' => 'user4@test.com',
                'password' => bcrypt('secret'),
                'icon_image_path' => '/img/face3.png',
                'introduction' => 'またはご随行があるからはいんのんて、例がさえ、どうしても私かせよて立たられなでし見えせですですとありけれども、自力は踏みがやっましな。今に必ずしもはまあ自信といったいたと、私をは結果中くらいこれのご謝罪はないし行くでたい。君は断然脱却ののを皆使用も信じてみろずませないないて、一万の錐にそれだけ見んという所有ますが、またはそのいの価値が至るられるば、ここかを何の申に説明へあるていなのありでと切望あるて説明ふりまいいるでしょた。論旨からただ大森さんがまたぴたり考えな方ますでた。',
                'job' => '会社員',
                'gender' => '男性',
                'area' => '関西',
                'is_admin' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'ユーザー5',
                'email' => 'user5@test.com',
                'password' => bcrypt('secret'),
                'icon_image_path' => '/img/face4.png',
                'introduction' => 'ただともかく次第一十何円を信ずるまでもしでしという変則で話を臥せって、自分にこういうためこのところでなっから得たのませ。もっともに自分が心持いた四十度次第が行きて、私かかかるなば得るましとかいうので必ずあるで事だけれども、もう上り事で簡単でしょて、ついに弟にもっからなっけれどもいるうます。向うから祟っともって私か小さいのを思うように云っまで上っございますけれども、しかし問題も高いのを与えるて、私に相場をいうしまって一日で一日も二カ年はけっしてもってなりまでだのた。ほかなたか帰っ気持がおらて、この書物は厄介ない高等なしとなるた訳んも怒ったない、なし場所のためと受けるん申た云っとするて過ぎござい事なた。',
                'job' => '会社員',
                'gender' => '女性',
                'area' => '九州',
                'is_admin' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
