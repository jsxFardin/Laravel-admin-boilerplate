<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\User;

class EmployeeDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user           = User::all()->except([1, 2])->random();
        $branch         = Branch::all()->random();
        $department     = Department::all()->random();
        $designation    = Designation::all()->random();

        return [
            'user_id'               => $user->id,
            'branch_id'             => $branch->id,
            'department_id'         => $department->id,
            'designation_id'        => $designation->id,
            'supervisor_id'         => $user->id,
            'employee_id'           => $this->faker->unique()->randomNumber,
            'mobile'                => $this->faker->numerify('###########'),
            'address'               => $this->faker->paragraph,
            'blood_group'           => $this->faker->bloodGroup,
            'joining_date'          => $this->faker->date('y-m-d'),
            'accommodation_cost'    => $this->faker->numberBetween(1000, 9000),
            'daily_allowance_cost'  => $this->faker->numberBetween(1000, 10000),
        ];
    }
}
