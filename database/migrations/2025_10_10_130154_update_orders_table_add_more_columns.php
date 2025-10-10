<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('country')->default('US')->after('zip');
            $table->text('notes')->nullable()->after('country');
            $table->decimal('subtotal', 10, 2)->default(0)->after('notes');
            $table->decimal('shipping', 10, 2)->default(0)->after('subtotal');
            $table->decimal('tax', 10, 2)->default(0)->after('shipping');
            $table->decimal('total', 10, 2)->change(); // change existing total precision
            $table->string('status')->default('pending')->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['country', 'notes', 'subtotal', 'shipping', 'tax']);
        });
    }
};
