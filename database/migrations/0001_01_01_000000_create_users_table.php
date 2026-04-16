<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('BEGIN');

        try {
            DB::statement('CREATE TABLE users (
                id BIGSERIAL PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(191) NOT NULL,
                email_verified_at TIMESTAMP NULL,
                password VARCHAR(255) NOT NULL,
                status VARCHAR(255) DEFAULT \'active\',
                preferred_language VARCHAR(10) DEFAULT \'fr\',
                last_country_id BIGINT UNSIGNED NULL,
                last_city_id BIGINT UNSIGNED NULL,
                remember_token VARCHAR(100) NULL,
                created_at TIMESTAMP NULL,
                updated_at TIMESTAMP NULL
            )');

            DB::statement('CREATE UNIQUE INDEX users_email_unique ON users (email)');

            DB::statement('CREATE TABLE password_reset_tokens (
                email VARCHAR(191) PRIMARY KEY,
                token VARCHAR(255) NOT NULL,
                created_at TIMESTAMP NULL
            )');

            DB::statement('CREATE TABLE sessions (
                id VARCHAR(191) PRIMARY KEY,
                user_id BIGINT UNSIGNED NULL,
                ip_address VARCHAR(45) NULL,
                user_agent TEXT NULL,
                payload LONGTEXT NOT NULL,
                last_activity INT NOT NULL
            )');

            DB::statement('CREATE INDEX sessions_user_id_index ON sessions (user_id)');
            DB::statement('CREATE INDEX sessions_last_activity_index ON sessions (last_activity)');

            DB::statement('COMMIT');
        } catch (\Exception $e) {
            DB::statement('ROLLBACK');
            throw $e;
        }
    }

    public function down(): void
    {
        DB::statement('DROP TABLE IF EXISTS sessions CASCADE');
        DB::statement('DROP TABLE IF EXISTS password_reset_tokens CASCADE');
        DB::statement('DROP TABLE IF EXISTS users CASCADE');
    }
};
