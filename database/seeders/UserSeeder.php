<?php

namespace Database\Seeders;

use Illuminate\{Database\Seeder, Support\Arr, Support\Facades\DB,  Support\Facades\Hash, Support\Str};

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $piDigits = '14159265358979323846264338327950288419716939937510582097494459230781640628620899862803482534211706798214808651328230664709384460955058223172535940812848111745028410270193852110555964462294895493038196';

        $names = [
            ['first' => 'Benhur', 'last' => 'Cariaga', 'middle' => 'Leproso'],
            ['first' => 'Danilo', 'last' => 'Santos', 'middle' => 'Datu'],
            ['first' => 'Althea', 'last' => 'Reyes', 'middle' => 'Bituin'],
            ['first' => 'Efren', 'last' => 'Cruz', 'middle' => 'Alab'],
            ['first' => 'Faith', 'last' => 'Bautista', 'middle' => 'Diwa'],
            ['first' => 'Ernesto', 'last' => 'Ocampo', 'middle' => 'Magiting'],
            ['first' => 'Diwa', 'last' => 'Garcia', 'middle' => 'Luningning'],
            ['first' => 'Isagani', 'last' => 'Mendoza', 'middle' => 'Makisig'],
            ['first' => 'Luningning', 'last' => 'Torres', 'middle' => 'Tala'],
            ['first' => 'Makisig', 'last' => 'Tomas', 'middle' => 'Bayani'],
            ['first' => 'Marisol', 'last' => 'Aquino', 'middle' => 'Mayumi'],
            ['first' => 'Nestor', 'last' => 'Dizon', 'middle' => 'Lakan'],
            ['first' => 'Sampaguita', 'last' => 'Pascua', 'middle' => 'Hiraya'],
            ['first' => 'Rizal', 'last' => 'Villanueva', 'middle' => 'Agimat'],
            ['first' => 'Tala', 'last' => 'Ramos', 'middle' => 'Malaya'],
            ['first' => 'Jejomar', 'last' => 'Castro', 'middle' => 'Dakila'],
            ['first' => 'Amihan', 'last' => 'Del Rosario', 'middle' => 'Ligaya'],
            ['first' => 'Bayani', 'last' => 'Guzman', 'middle' => 'Kidlat'],
            ['first' => 'Dalisay', 'last' => 'Salvador', 'middle' => 'Mutya'],
            ['first' => 'Crisanto', 'last' => 'Ferrer', 'middle' => 'Matikas'],
        ];

        $suffixes = ['Sr.', 'Jr.', 'II', 'III', 'IV', 'V', 'VI'];
        $password = Hash::make('12345678');

        $piArray = Str::of($piDigits)->split(1)->toArray();
        $piIndex = 0;
        $nextSuffixAt = (int) $piArray[$piIndex];

        foreach ($names as $index => $name) {
            $phoneChunk = Str::substr($piDigits, $index * 10, 9);
            $phoneNumber = "09{$phoneChunk}";

            $suffix = null;
            if ($index === $nextSuffixAt) {
                $suffix = Arr::random($suffixes);
                $piIndex++;
                $nextSuffixAt += (int) $piArray[$piIndex];
            }

            $personId = DB::table('persons')->insertGetId([
                'type' => 'Employee',
                'last_name' => $name['last'],
                'first_name' => $name['first'],
                'middle_name' => $name['middle'],
                'suffix' => $suffix,
                'email_address' => Str::lower($name['first']) . '@gmail.com',
                'phone_number' => $phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('users')->insert([
                'person_id' => $personId,
                'account_status' => 'Inactive',
                'password' => $password,
                'profile_picture' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
