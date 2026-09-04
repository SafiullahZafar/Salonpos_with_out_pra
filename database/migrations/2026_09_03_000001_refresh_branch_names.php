<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('branches')->where('id', 1)->update(['name' => 'Aurora Avenue']);
        DB::table('branches')->where('id', 2)->update(['name' => 'Violet Courtyard']);
    }

    public function down(): void
    {
        DB::table('branches')->where('id', 1)->update(['name' => 'Green Avenue Branch']);
        DB::table('branches')->where('id', 2)->update(['name' => 'Pearl City Branch']);
    }
};
