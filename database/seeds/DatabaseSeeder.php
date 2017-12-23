<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = [
            ['name' => \App\Game\Pc28::NAME],
            ['name' => \App\Game\Pc28v25::NAME],
        ];

        array_map(function ($game) {
            \App\Game::create($game);
        }, $games);


        $bank_list = [
            '支付宝',
            '微信',
            '工商银行',
            '建设银行',
            '招商银行',
            '交通银行',
            '中信银行',
            '民生银行',
            '兴业银行',
            '华夏银行',
            '北京银行',
            '中国邮政',
            '南京银行',
            '中国银行',
            '上海银行',
            '宁波银行',
            '浙商银行',
            '平安银行',
            '渤海银行',
            '上海浦东发展银行',
            '北京农村商业银行',
            '广东发展银行',

        ];

        foreach ($bank_list as $bank) {
            \App\Bank::create(['name' => $bank]);
        }

        \App\Admin::create([
            'username' => 'baozouxi',
            'password' => bcrypt('123456'),
        ]);

        \App\Ad::create([
            'body' => '刘晓明在872355期红包接龙中夺得运气王!',
        ]);


        $this->call(UsersSeeder::class);

    }
}
