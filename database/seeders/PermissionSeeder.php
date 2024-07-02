<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        // DB::table('permissions')->truncate();
        // DB::table('role_has_permissions')->truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::beginTransaction();

        $permissions = [
            'general_settings',
            'language_access',
            'permission_index',
            'permission_create',
            'permission_edit',
            'permission_delete',
            'permission_show',
            'role_index',
            'role_create',
            'role_edit',
            'role_delete',
            'role_show',
            'user_index',
            'user_create',
            'user_edit',
            'user_delete',
            'user_show',
            'post_index',
            'post_create',
            'post_edit',
            'post_delete',
            'post_show',
            'page_index',
            'page_create',
            'page_edit',
            'page_delete',
            'page_show',
            'group_layout_index',
            'group_layout_create',
            'group_layout_edit',
            'group_layout_delete',
            'group_layout_show',
            'layout_index',
            'layout_create',
            'layout_edit',
            'layout_delete',
            'layout_show',
            'category_index',
            'category_create',
            'category_edit',
            'category_delete',
            'category_show',
            'document_index',
            'document_create',
            'document_edit',
            'document_delete',
            'document_show',
            'circular_index',
            'circular_create',
            'circular_edit',
            'circular_delete',
            'circular_show',
            'active_user',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }

        DB::commit();

    }
}
