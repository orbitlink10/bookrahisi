<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string('meta_title', 160)->nullable()->after('author_name');
            $table->string('heading_two', 160)->nullable()->after('title');
            $table->string('image_alt_text', 255)->nullable()->after('cover_image_url');
            $table->string('content_type', 40)->default('post')->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn([
                'meta_title',
                'heading_two',
                'image_alt_text',
                'content_type',
            ]);
        });
    }
};
