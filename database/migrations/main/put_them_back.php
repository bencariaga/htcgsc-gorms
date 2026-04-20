<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // ------------------------------------------------------------------
        // 1. persons
        // ------------------------------------------------------------------
        $persons = [
            ['person_id' => 1, 'type' => 'Administrator', 'last_name' => 'Cariaga', 'first_name' => 'Benhur', 'middle_name' => 'Leproso', 'suffix' => null, 'email_address' => 'bencariaga13@gmail.com', 'phone_number' => '09939597683', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-04-13 01:50:48'],
            ['person_id' => 2, 'type' => 'Employee', 'last_name' => 'Santos', 'first_name' => 'Danilo', 'middle_name' => 'Datu', 'suffix' => 'VI', 'email_address' => 'caproban@gmail.com', 'phone_number' => '09897932384', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['person_id' => 3, 'type' => 'Employee', 'last_name' => 'Reyes', 'first_name' => 'Althea', 'middle_name' => 'Bituin', 'suffix' => null, 'email_address' => 'althea@gmail.com', 'phone_number' => '09264338327', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['person_id' => 4, 'type' => 'Employee', 'last_name' => 'Cruz', 'first_name' => 'Efren', 'middle_name' => 'Alab', 'suffix' => null, 'email_address' => 'efren@gmail.com', 'phone_number' => '09502884197', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['person_id' => 5, 'type' => 'Employee', 'last_name' => 'Bautista', 'first_name' => 'Faith', 'middle_name' => 'Diwa', 'suffix' => null, 'email_address' => 'faith@gmail.com', 'phone_number' => '09693993751', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['person_id' => 6, 'type' => 'Employee', 'last_name' => 'Ocampo', 'first_name' => 'Ernesto', 'middle_name' => 'Magiting', 'suffix' => 'IV', 'email_address' => 'ernesto@gmail.com', 'phone_number' => '09582097494', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['person_id' => 7, 'type' => 'Employee', 'last_name' => 'Garcia', 'first_name' => 'Diwa', 'middle_name' => 'Luningning', 'suffix' => 'III', 'email_address' => 'diwa@gmail.com', 'phone_number' => '09592307816', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['person_id' => 8, 'type' => 'Employee', 'last_name' => 'Mendoza', 'first_name' => 'Isagani', 'middle_name' => 'Makisig', 'suffix' => null, 'email_address' => 'isagani@gmail.com', 'phone_number' => '09062862089', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['person_id' => 9, 'type' => 'Employee', 'last_name' => 'Torres', 'first_name' => 'Luningning', 'middle_name' => 'Tala', 'suffix' => null, 'email_address' => 'luningning@gmail.com', 'phone_number' => '09862803482', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['person_id' => 10, 'type' => 'Employee', 'last_name' => 'Tomas', 'first_name' => 'Makisig', 'middle_name' => 'Bayani', 'suffix' => null, 'email_address' => 'makisig@gmail.com', 'phone_number' => '09342117067', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['person_id' => 11, 'type' => 'Employee', 'last_name' => 'Aquino', 'first_name' => 'Marisol', 'middle_name' => 'Mayumi', 'suffix' => null, 'email_address' => 'marisol@gmail.com', 'phone_number' => '09821480865', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['person_id' => 12, 'type' => 'Employee', 'last_name' => 'Dizon', 'first_name' => 'Nestor', 'middle_name' => 'Lakan', 'suffix' => 'V', 'email_address' => 'nestor@gmail.com', 'phone_number' => '09328230664', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['person_id' => 13, 'type' => 'Employee', 'last_name' => 'Pascua', 'first_name' => 'Sampaguita', 'middle_name' => 'Hiraya', 'suffix' => null, 'email_address' => 'sampaguita@gmail.com', 'phone_number' => '09093844609', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['person_id' => 14, 'type' => 'Employee', 'last_name' => 'Villanueva', 'first_name' => 'Rizal', 'middle_name' => 'Agimat', 'suffix' => null, 'email_address' => 'rizal@gmail.com', 'phone_number' => '09505822317', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['person_id' => 15, 'type' => 'Employee', 'last_name' => 'Ramos', 'first_name' => 'Tala', 'middle_name' => 'Malaya', 'suffix' => null, 'email_address' => 'tala@gmail.com', 'phone_number' => '09535940812', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['person_id' => 16, 'type' => 'Employee', 'last_name' => 'Castro', 'first_name' => 'Jejomar', 'middle_name' => 'Dakila', 'suffix' => null, 'email_address' => 'jejomar@gmail.com', 'phone_number' => '09481117450', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['person_id' => 17, 'type' => 'Employee', 'last_name' => 'Del Rosario', 'first_name' => 'Amihan', 'middle_name' => 'Ligaya', 'suffix' => null, 'email_address' => 'amihan@gmail.com', 'phone_number' => '09841027019', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['person_id' => 18, 'type' => 'Employee', 'last_name' => 'Guzman', 'first_name' => 'Bayani', 'middle_name' => 'Kidlat', 'suffix' => null, 'email_address' => 'bayani@gmail.com', 'phone_number' => '09852110555', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-23 16:19:52'],
            ['person_id' => 19, 'type' => 'Employee', 'last_name' => 'Salvador', 'first_name' => 'Dalisay', 'middle_name' => 'Mutya', 'suffix' => null, 'email_address' => 'dalisay@gmail.com', 'phone_number' => '09644622948', 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-23 16:19:12'],
            ['person_id' => 20, 'type' => 'Employee', 'last_name' => 'Ferrer', 'first_name' => 'Crisanto', 'middle_name' => 'Matikas', 'suffix' => null, 'email_address' => 'crisanto@gmail.com', 'phone_number' => '09549303819', 'created_at' => '2026-02-18 22:42:11', 'updated_at' => '2026-02-18 22:42:11'],
            ['person_id' => 21, 'type' => 'Student', 'last_name' => 'Santos', 'first_name' => 'Agapito', 'middle_name' => 'Bautista', 'suffix' => null, 'email_address' => 'agapito.santos793@online.htcgsc.edu.ph', 'phone_number' => '09683124975', 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['person_id' => 22, 'type' => 'Student', 'last_name' => 'Villanueva', 'first_name' => 'Dalisay', 'middle_name' => 'Reyes', 'suffix' => null, 'email_address' => 'dalisay.villanueva395@online.htcgsc.edu.ph', 'phone_number' => '09305291383', 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['person_id' => 23, 'type' => 'Student', 'last_name' => 'Quizon', 'first_name' => 'Luningning', 'middle_name' => 'Ferrer', 'suffix' => null, 'email_address' => 'luningning.quizon885@online.htcgsc.edu.ph', 'phone_number' => '09359286460', 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['person_id' => 24, 'type' => 'Student', 'last_name' => 'Torres', 'first_name' => 'Ligaya', 'middle_name' => 'Abad', 'suffix' => null, 'email_address' => 'ligaya.torres122@online.htcgsc.edu.ph', 'phone_number' => '09767266718', 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['person_id' => 25, 'type' => 'Student', 'last_name' => 'Abad', 'first_name' => 'Efren', 'middle_name' => 'Torres', 'suffix' => null, 'email_address' => 'efren.abad918@online.htcgsc.edu.ph', 'phone_number' => '09344262690', 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['person_id' => 26, 'type' => 'Student', 'last_name' => 'Mendoza', 'first_name' => 'Luningning', 'middle_name' => 'Quizon', 'suffix' => null, 'email_address' => 'luningning.mendoza762@online.htcgsc.edu.ph', 'phone_number' => '09110857441', 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['person_id' => 27, 'type' => 'Student', 'last_name' => 'Cruz', 'first_name' => 'Honorio', 'middle_name' => 'Bautista', 'suffix' => null, 'email_address' => 'honorio.cruz772@online.htcgsc.edu.ph', 'phone_number' => '09238180074', 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['person_id' => 28, 'type' => 'Student', 'last_name' => 'Santos', 'first_name' => 'Bituin', 'middle_name' => 'Quizon', 'suffix' => null, 'email_address' => 'bituin.santos903@online.htcgsc.edu.ph', 'phone_number' => '09116017768', 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['person_id' => 29, 'type' => 'Student', 'last_name' => 'Villanueva', 'first_name' => 'Sampaguita', 'middle_name' => 'Torres', 'suffix' => 'Sr.', 'email_address' => 'sampaguita.villanueva647@online.htcgsc.edu.ph', 'phone_number' => '09296055179', 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['person_id' => 30, 'type' => 'Student', 'last_name' => 'Mendoza', 'first_name' => 'Danilo', 'middle_name' => 'Hernandez', 'suffix' => null, 'email_address' => 'danilo.mendoza259@online.htcgsc.edu.ph', 'phone_number' => '09359665334', 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-04 02:42:06'],
            ['person_id' => 31, 'type' => 'Student', 'last_name' => 'Bohol', 'first_name' => 'Raymond', 'middle_name' => 'Carcueva', 'suffix' => null, 'email_address' => '2023_cete_boholray@online.htcgsc.edu.ph', 'phone_number' => '09123456789', 'created_at' => '2026-03-15 05:23:26', 'updated_at' => '2026-03-15 05:23:26'],
            ['person_id' => 32, 'type' => 'Student', 'last_name' => 'Cariaga', 'first_name' => 'Benhur', 'middle_name' => 'Leproso', 'suffix' => null, 'email_address' => '2022_cete_cariagabl@online.htcgsc.edu.ph', 'phone_number' => '09987654321', 'created_at' => '2026-03-15 05:23:26', 'updated_at' => '2026-03-15 05:23:26'],
        ];
        DB::table('persons')->insert($persons);

        // ------------------------------------------------------------------
        // 2. students
        // ------------------------------------------------------------------
        $students = [
            ['student_id' => 1, 'person_id' => 21, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['student_id' => 2, 'person_id' => 22, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['student_id' => 3, 'person_id' => 23, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['student_id' => 4, 'person_id' => 24, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['student_id' => 5, 'person_id' => 25, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['student_id' => 6, 'person_id' => 26, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['student_id' => 7, 'person_id' => 27, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['student_id' => 8, 'person_id' => 28, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['student_id' => 9, 'person_id' => 29, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['student_id' => 10, 'person_id' => 30, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['student_id' => 11, 'person_id' => 31, 'created_at' => '2026-03-15 05:23:27', 'updated_at' => '2026-03-15 05:23:27'],
            ['student_id' => 12, 'person_id' => 32, 'created_at' => '2026-03-15 05:23:27', 'updated_at' => '2026-03-15 05:23:27'],
        ];
        DB::table('students')->insert($students);

        // ------------------------------------------------------------------
        // 3. users
        // ------------------------------------------------------------------
        $users = [
            ['user_id' => 1, 'person_id' => 1, 'account_status' => 'Active', 'password' => '$2y$12$V./F3vsZMgY.36oLDY0GKOUF31FtEo0l3AGhYy1dvuCJ4SzEiW.3S', 'profile_picture' => 'profile-pictures/7GEF7BkrSjbQzlKuHUUHkbClFvPb6P6a5BagaN8d.jpg', 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-03-21 02:22:40'],
            ['user_id' => 2, 'person_id' => 2, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-03-17 01:37:07'],
            ['user_id' => 3, 'person_id' => 3, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['user_id' => 4, 'person_id' => 4, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['user_id' => 5, 'person_id' => 5, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['user_id' => 6, 'person_id' => 6, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['user_id' => 7, 'person_id' => 7, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['user_id' => 8, 'person_id' => 8, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['user_id' => 9, 'person_id' => 9, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['user_id' => 10, 'person_id' => 10, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['user_id' => 11, 'person_id' => 11, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['user_id' => 12, 'person_id' => 12, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['user_id' => 13, 'person_id' => 13, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['user_id' => 14, 'person_id' => 14, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['user_id' => 15, 'person_id' => 15, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['user_id' => 16, 'person_id' => 16, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['user_id' => 17, 'person_id' => 17, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-18 22:42:10'],
            ['user_id' => 18, 'person_id' => 18, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-23 16:19:52'],
            ['user_id' => 19, 'person_id' => 19, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:10', 'updated_at' => '2026-02-23 16:19:12'],
            ['user_id' => 20, 'person_id' => 20, 'account_status' => 'Inactive', 'password' => '$2y$12$cS0slgIglgWOCM5nD2l/jOEkQLuQI27SjZfqpNqxpxF.rBCiH/WwO', 'profile_picture' => null, 'remember_token' => null, 'created_at' => '2026-02-18 22:42:11', 'updated_at' => '2026-03-04 02:50:10'],
        ];
        DB::table('users')->insert($users);

        // ------------------------------------------------------------------
        // 4. referrers
        // ------------------------------------------------------------------
        $referrers = [
            ['referrer_id' => 1, 'student_id' => 7, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['referrer_id' => 2, 'student_id' => 1, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['referrer_id' => 3, 'student_id' => 3, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['referrer_id' => 4, 'student_id' => 4, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['referrer_id' => 5, 'student_id' => 10, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['referrer_id' => 6, 'student_id' => 11, 'created_at' => '2026-03-15 05:23:27', 'updated_at' => '2026-03-15 05:23:27'],
        ];
        DB::table('referrers')->insert($referrers);

        // ------------------------------------------------------------------
        // 5. referrals (new schema has referrer_id, set to NULL for now)
        // ------------------------------------------------------------------
        $referrals = [
            ['referral_id' => 1, 'student_id' => 2, 'referrer_id' => null, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['referral_id' => 2, 'student_id' => 9, 'referrer_id' => null, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['referral_id' => 3, 'student_id' => 8, 'referrer_id' => null, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['referral_id' => 4, 'student_id' => 5, 'referrer_id' => null, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['referral_id' => 5, 'student_id' => 10, 'referrer_id' => null, 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-02 12:14:17'],
            ['referral_id' => 6, 'student_id' => 12, 'referrer_id' => null, 'created_at' => '2026-03-15 05:23:27', 'updated_at' => '2026-03-15 05:23:27'],
        ];
        DB::table('referrals')->insert($referrals);

        // ------------------------------------------------------------------
        // 6. appointments
        // ------------------------------------------------------------------
        $appointments = [
            ['appointment_id' => 1, 'referrer_id' => 1, 'referral_id' => 1, 'referral_type' => 'Someone Else', 'reason' => 'Showing signs of severe anxiety', 'appointment_date' => '2026-03-06', 'appointment_time' => '8:30 AM - 9:30 AM', 'appointment_status' => 'Missed', 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-15 10:25:10'],
            ['appointment_id' => 2, 'referrer_id' => 2, 'referral_id' => 2, 'referral_type' => 'Someone Else', 'reason' => 'Frequent absences from major subjects', 'appointment_date' => '2026-03-06', 'appointment_time' => '9:30 AM - 10:30 AM', 'appointment_status' => 'Missed', 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-15 10:25:10'],
            ['appointment_id' => 3, 'referrer_id' => 3, 'referral_id' => 3, 'referral_type' => 'Someone Else', 'reason' => 'I have a problem with her behavior in class', 'appointment_date' => '2026-03-06', 'appointment_time' => '10:30 AM - 11:30 AM', 'appointment_status' => 'Missed', 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-15 10:25:10'],
            ['appointment_id' => 4, 'referrer_id' => 4, 'referral_id' => 4, 'referral_type' => 'Someone Else', 'reason' => 'We have a dispute with my friend', 'appointment_date' => '2026-03-06', 'appointment_time' => '1:30 PM - 2:30 PM', 'appointment_status' => 'Missed', 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-15 10:25:10'],
            ['appointment_id' => 5, 'referrer_id' => 5, 'referral_id' => 5, 'referral_type' => 'Yourself', 'reason' => 'He has a problem with academics. His grades does not look good.', 'appointment_date' => '2026-03-12', 'appointment_time' => '9:30 AM - 10:30 AM', 'appointment_status' => 'Missed', 'created_at' => '2026-03-02 12:14:17', 'updated_at' => '2026-03-16 22:29:42'],
            ['appointment_id' => 7, 'referrer_id' => 6, 'referral_id' => 6, 'referral_type' => 'Someone Else', 'reason' => 'Benhur has a problem with procrastination', 'appointment_date' => '2026-04-06', 'appointment_time' => '1:30 PM - 2:30 PM', 'appointment_status' => 'Missed', 'created_at' => '2026-03-25 01:27:30', 'updated_at' => '2026-04-06 08:38:54'],
        ];
        DB::table('appointments')->insert($appointments);

        // ------------------------------------------------------------------
        // 7. reports
        // ------------------------------------------------------------------
        $reports = [
            ['report_id' => 1, 'title' => 'Report 1', 'start_date' => '2026-04-17', 'end_date' => '2026-04-17', 'data_category' => 'Users', 'file_output_format' => 'PDF Document', 'created_at' => '2026-04-11 18:39:39', 'updated_at' => '2026-04-17 21:33:46'],
            ['report_id' => 2, 'title' => 'Report 3', 'start_date' => '2026-04-17', 'end_date' => '2026-04-17', 'data_category' => 'Form Submissions', 'file_output_format' => 'PDF Document', 'created_at' => '2026-04-11 18:39:39', 'updated_at' => '2026-04-17 21:34:21'],
            ['report_id' => 3, 'title' => 'Report 2', 'start_date' => '2026-04-17', 'end_date' => '2026-04-17', 'data_category' => 'Students', 'file_output_format' => 'PDF Document', 'created_at' => '2026-04-11 18:39:39', 'updated_at' => '2026-04-17 21:34:05'],
        ];
        DB::table('reports')->insert($reports);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Delete in reverse order to respect foreign keys
        DB::table('reports')->truncate();
        DB::table('appointments')->truncate();
        DB::table('referrals')->truncate();
        DB::table('referrers')->truncate();
        DB::table('users')->truncate();
        DB::table('students')->truncate();
        DB::table('persons')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
