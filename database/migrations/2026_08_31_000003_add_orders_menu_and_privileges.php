<?php

use App\Modules\Menu\Models\Menu;
use App\Modules\Privilege\Models\Privilege;
use App\Modules\Role\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $management = DB::table('menu')->where('menu', 'Management Menu')->where('level', 0)->first();

        $exists = DB::table('menu')->where('module', 'orders')->where('routing', 'orders.management')->exists();

        if (! $exists) {
            $id = (string) Str::uuid();

            DB::table('menu')->insert([
                'id' => $id,
                'menu' => 'Status Pesanan',
                'module' => 'orders',
                'routing' => 'orders.management',
                'is_tampil' => 1,
                'icon' => 'fa-clipboard-list',
                'urutan' => 99,
                'parent_id' => $management?->id ?? 0,
                'level' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach (Role::all() as $role) {
                $existingPrivilege = DB::table('privilege')
                    ->where('id_role', $role->id)
                    ->where('id_menu', $id)
                    ->exists();

                if (! $existingPrivilege) {
                    DB::table('privilege')->insert([
                        'id' => (string) Str::uuid(),
                        'id_role' => $role->id,
                        'id_menu' => $id,
                        'show_menu' => 1,
                        'create' => 0,
                        'read' => 1,
                        'show' => 0,
                        'update' => 1,
                        'delete' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $menu = DB::table('menu')->where('module', 'orders')->where('routing', 'orders.management')->first();

        if ($menu) {
            DB::table('privilege')->where('id_menu', $menu->id)->delete();
            DB::table('menu')->where('id', $menu->id)->delete();
        }
    }
};
