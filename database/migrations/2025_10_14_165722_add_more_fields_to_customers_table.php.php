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
        Schema::table('customers', function (Blueprint $table) {
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('name');

            $table->string('mobile')->nullable()->after('gender');
            $table->string('house_no')->nullable()->after('address');
            $table->string('locality')->nullable()->after('house_no');
            $table->string('landmark')->nullable()->after('locality');
            $table->string('state')->nullable()->after('city');
            $table->string('pincode')->nullable()->after('state');
            $table->string('country')->nullable()->after('pincode');

            $table->text('shipping_address')->nullable()->after('country');
            $table->text('billing_address')->nullable()->after('shipping_address');
            $table->string('whatsapp_number')->nullable()->after('billing_address');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'mobile_no',
                'house_no',
                'locality',
                'landmark',
                'state',
                'pincode',
                'country',
                'shipping_address',
                'billing_address',

            ]);
        });
    }
};
