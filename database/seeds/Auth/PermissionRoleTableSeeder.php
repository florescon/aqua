<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles
        $admin = Role::create(['name' => config('access.users.admin_role')]);
        $executive = Role::create(['name' => 'ejecutivo']);
        $user = Role::create(['name' => config('access.users.default_role')]);

        // Create Permissions
        $permissions = ['ver panel', 'reglamento', 'tipo de clase', 'secciones', 'clases', 'suscripciones', 'mensualidades', 'metodos de pago', 'instituciones', 'etiquetas de clases', 'etiquetas de mensualidades', 'cms soporte', 'cms galeria', 'cms personal', 'cms paginas', 'cms eventos', 'cms planes', 'cms horario', 'productos', 'servicios', 'generar venta', 'ver ventas', 'ingresos', 'categorias de ingresos', 'egresos', 'categorias de egresos', 'notas generales', 'corte de caja', 'caja chica', 'configuraciones generales', 'clientes'];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // ALWAYS GIVE ADMIN ROLE ALL PERMISSIONS
        $admin->givePermissionTo(Permission::all());

        // Assign Permissions to other Roles
        $executive->givePermissionTo('ver panel', 'reglamento');

        $this->enableForeignKeys();
    }
}
