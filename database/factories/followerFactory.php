<?php

namespace Database\Factories;

use App\Models\follower;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\follower>
 */
class followerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users=User::pluck('id')->toArray();        
        $userElement1=$this->faker->randomElement($users);
        if (($clave = array_search($userElement1, $users)) !== false) { unset($users[$clave]);}
        $userElement2=$this->faker->randomElement($users);

        return [
            "user_id" => $userElement1,
            "follower_id"=> $userElement2
        ];
    }
}
