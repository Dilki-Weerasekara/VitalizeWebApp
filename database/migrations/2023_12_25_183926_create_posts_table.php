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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->uuid("uuid");   //show specific post
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();   //constrained() allows rely on the database to ensure integrity,accuracy,reliability     
            $table->longText("content");
            $table->boolean("is_public")->default(1);
            $table->enum("status", ["published", "pending", "rejected"])->default("pending");
            $table->unsignedBigInteger("likes")->default(0);
            $table->unsignedBigInteger("comments")->default(0);
            $table->boolean("is_page_post")->default(0);
            $table->foreignId("page_id")->nullable()->constrained()->cascadeOnDelete();   //cascadeOnDelete(), when corresponding (Parent) page delete,the (child) post also automatically removed.
            $table->boolean("is_group_post")->default(0);
            $table->foreignId("group_id")->nullable()->constrained()->cascadeOnDelete(); //cascadeOnDelete(), database foreign key constraint option that automatically removes the dependant rows.
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
