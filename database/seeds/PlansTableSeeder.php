<?php

use Illuminate\Database\Seeder;
use App\Plan;
class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $plan = new Plan;
    $plan->name = "Basic Package";
    $plan->capacity=3;
    $plan->price=0;
    $plan->detail="default package can 3 subordinate and 7 day left";
    $plan->exprie=7;
    $plan->save();

    $plan = new Plan;
    $plan->name = "Account Package";
    $plan->capacity=1;
    $plan->price=100;
    $plan->detail="default package can 1 subordinate and 30 day left";
    $plan->exprie=30;
    $plan->save();

    $plan = new Plan;
    $plan->name = "Pro Package/Month";
    $plan->capacity=9999;
    $plan->price=1000;
    $plan->detail="default package can unlimited subordinate and 30 day left";
    $plan->exprie=30;
    $plan->save();

    $plan = new Plan;
    $plan->name = "Pro Package/Year";
    $plan->capacity=9999;
    $plan->price=10000;
    $plan->detail="default package can unlimited subordinate and 1 year left";
    $plan->exprie=356;
    $plan->save();
    }
}
