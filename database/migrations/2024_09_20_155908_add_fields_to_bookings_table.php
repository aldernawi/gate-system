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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('title')->after('owner_id');  
            $table->text('des')->after('title');  
            $table->date('delivery_date')->nullable()->after('description');
            $table->decimal('price', 8, 2)->nullable()->after('delivery_date');  
        });
    }
    
    
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['title', 'description', 'delivery_date', 'price']);
        });
    }
    
};
