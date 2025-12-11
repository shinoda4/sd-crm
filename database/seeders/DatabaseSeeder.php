<?php
/*
 * Copyright (c) 2025 Shunde
 * All rights reserved.
 *
 * This source code is strictly confidential and proprietary.
 * The content of this file may not be disclosed to third parties, copied or
 * duplicated in any form, in whole or in part, without the prior written
 * permission of Shunde.
 *
 * Use of this source code is governed by the terms of the license agreement
 * contained in the LICENSE file found in the root directory of this source tree.
 * If no LICENSE file is found, use is strictly prohibited.
 */

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Deal;
use App\Models\PipelineStage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 创建多个用户
        $users = User::factory(3)->create()->each(function ($user, $index) {
            $user->name = 'User' . ($index + 1);
            $user->email = 'user' . ($index + 1) . '@example.com';
            $user->password = bcrypt('1234567890'); // 默认密码
            $user->save();

            // 为每个用户创建 Pipeline Stages（全局也可以只创建一次）
            $stages = ['初步接触', '需求分析', '方案设计', '报价', '成交'];
            foreach ($stages as $sIndex => $name) {
                PipelineStage::firstOrCreate(['name' => $name], ['order' => $sIndex]);
            }

            // 为每个用户创建客户
            Customer::factory(3)->create()->each(function ($customer) use ($user) {
                $customer->owner_id = $user->id;
                $customer->save();

                // 联系人
                $contactCount = rand(1, 5);
                Contact::factory($contactCount)->create([
                    'customer_id' => $customer->id
                ]);

                // 随机数量的 Deals
                $dealCount = rand(5, 15);
                Deal::factory($dealCount)->create([
                    'customer_id' => $customer->id,
                    'owner_id' => $user->id,
                    'pipeline_stage_id' => PipelineStage::inRandomOrder()->first()->id
                ]);
            });

            // 创建活动
            $activityCount = rand(3, 10);
            Activity::factory($activityCount)->create([
                'user_id' => $user->id,
                'related_type' => function () {
                    $types = [Customer::class, Contact::class, Deal::class];
                    return $types[array_rand($types)];
                },
                'related_id' => function (array $attrs) {
                    // 根据 related_type 随机选择一个 id
                    if ($attrs['related_type'] === Customer::class) {
                        return Customer::inRandomOrder()->first()->id;
                    } elseif ($attrs['related_type'] === Contact::class) {
                        return Contact::inRandomOrder()->first()->id;
                    } else {
                        return Deal::inRandomOrder()->first()->id;
                    }
                },
                'type' => ['call', 'email', 'note'][array_rand(['call', 'email', 'note'])],
                'content' => '模拟操作内容'
            ]);

        });
    }
}
