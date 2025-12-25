<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeederr extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans=[
            ["name"=>"Starter","stripe_plan_id"=>"prod_TfNThVvyhc3I7J","stripe_price_id"=>"price_1Si2iTDee8lfP295kYvKLkVm"],
            ["name"=>"Company","stripe_plan_id"=>"prod_TfNTWem44QRKXe","stripe_price_id"=>"price_1Si2ipDee8lfP2950WUJFuvG"],
            ["name"=>"Enterprise","stripe_plan_id"=>"prod_TfNTWN0t7GodvY","stripe_price_id"=>"price_1Si2j0Dee8lfP295xE24zHlr"]
        ];
        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
