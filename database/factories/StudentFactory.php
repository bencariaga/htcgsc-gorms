<?php

namespace Database\Factories;

use App\{Actions\Data\GenerateDatabaseTableRowId, Models\Person, Models\Student};
use Illuminate\{Database\Eloquent\Factories\Factory, Support\Arr, Support\Str};

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        $filipinoSurnames = ['Abad', 'Bautista', 'Cruz', 'Dela Cruz', 'Garcia', 'Reyes', 'Santos', 'Torres', 'Villanueva', 'Pascua', 'Quizon', 'Mendoza', 'Laxamana', 'Hernandez', 'Ferrer'];
        $boyNames = ['Agapito', 'Bonifacio', 'Crisanto', 'Danilo', 'Efren', 'Honorio', 'Isagani', 'Jejomar', 'Lakan', 'Makisig'];
        $girlNames = ['Amihan', 'Bituin', 'Dalisay', 'Diwa', 'Hiraya', 'Ligaya', 'Luningning', 'Mayumi', 'Sampaguita', 'Tala'];

        $firstName = fake()->randomElement(Arr::collapse([$boyNames, $girlNames]));
        $lastName = fake()->randomElement($filipinoSurnames);

        return [
            'student_id' => fn () => GenerateDatabaseTableRowId::execute('students', 'student_id'),
            'person_id' => Person::factory()->create([
                'type' => 'Student',
                'first_name' => $firstName,
                'last_name' => $lastName,
                'middle_name' => fake()->randomElement($filipinoSurnames),
                'email_address' => Str::lower("{$firstName}.{$lastName}") . fake()->numberBetween(100, 999) . '@online.htcgsc.edu.ph',
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
