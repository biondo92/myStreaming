<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // generiche
        Schema::create('languages', function (Blueprint $table) {
            $table->id("id");
            $table->string("description");
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id("id");
            $table->string("code");
            $table->string("key");
            $table->string("value");
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id("id");
            $table->string("name");
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id('id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id("id");
            $table->timestamps();
            $table->softDeletes();
        });
        // generiche

        // utenti
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string("lastName")->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger("roleId")->default(2);
            $table->unsignedBigInteger("languageId")->default(1);
            $table->double("credits")->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamps();

            $table->foreign('roleId')->references('id')->on('roles');
            $table->foreign('languageId')->references('id')->on('languages');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        // fine utenti

        // cache
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
        // fine cache

        // jobs
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
        // fine jobs

        // pat
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
        // fine pat

        Schema::create('role_descriptions', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('languageId');
            $table->unsignedBigInteger('roleId');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('languageId')->references('id')->on('languages');
            $table->foreign('roleId')->references('id')->on('roles');
        });

        Schema::create('category_descriptions', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('languageId');
            $table->unsignedBigInteger('categoryId');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('languageId')->references('id')->on('languages');
            $table->foreign('categoryId')->references('id')->on('categories');
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->id("id");
            $table->unsignedBigInteger("cityId");
            $table->unsignedBigInteger("userId");
            $table->string("address");
            $table->string("postalCode");
            $table->string("state");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cityId')->references('id')->on('cities');
            $table->foreign('userId')->references('id')->on('users');
        });

        Schema::create('films', function (Blueprint $table) {
            $table->id("id");
            $table->unsignedBigInteger('categoryId');
            $table->string('title');
            $table->unsignedInteger('duration');
            $table->unsignedInteger('rating');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('categoryId')->references('id')->on('categories');
        });

        Schema::create('series', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('categoryId');
            $table->string('title');
            $table->unsignedInteger('rating');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('categoryId')->references('id')->on('categories');
        });

        Schema::create('seasons', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('serieId');
            $table->string('title');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('serieId')->references('id')->on('series');
        });

        Schema::create('episodes', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('seasonId');
            $table->string('title');
            $table->unsignedBigInteger('duration');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('seasonId')->references('id')->on('seasons');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // utenti
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');

        // cache
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');

        // jobs
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');

        // pat
        Schema::dropIfExists('personal_access_tokens');

        Schema::dropIfExists('episodes');
        Schema::dropIfExists('seasons');
        Schema::dropIfExists('series');
        Schema::dropIfExists('films');
        Schema::dropIfExists('categoryDescriptions');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('users_addresses');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roleDescriptions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('languages');
    }
};
