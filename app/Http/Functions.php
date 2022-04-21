<?php
// Key Value From Json
function kvfj($json, $key){
    if($json == null):
        return null;
    else:
        $json = $json;
        $json = json_decode($json, true);
        if(array_key_exists($key, $json)):
            return $json[$key];
        else:
            return null;
        endif;
    endif;
}

function getRoleUserArray($mode, $id){
    $roles = ['0' => 'Usuario', '1' => 'Administrador'];
    if(!is_null($mode)):
        return $roles;
    else:
        return $roles[$id];
    endif;
}

function getUserStatusArray($mode, $id){
    $status = ['1' => 'ACTIVO', '0' => 'SUSPENDIDO'];
    if(!is_null($mode)):
        return $status;
    else:
        return $status[$id];
    endif;
}

function user_permissions(){
    $p = [
        'dashboard' => [
            'icon'  => '<i class="side-menu__icon fe fe-home"></i> ',
            'title' => 'Módulo Dashboard',
            'keys'  => [
                        'dashboard' => 'Puede ver el dashboard.',
            ]
        ],

        'enterprises' => [
            'icon'  => '<i class="side-menu__icon fe fe-briefcase"></i>',
            'title' => 'Módulo Empresas',
            'keys'  => [
                'enterprise_list'   => 'Puede ver listado de empresas.',
                'enterprise_add'    => 'Puede agregar empresas.',
                'enterprise_edit'   => 'Puede editar empresas.',
                'enterprise_search' => 'Puede buscar empresas.',
            ]
        ],

        'employees' => [
            'icon'  => '<i class="side-menu__icon fe fe-users"></i>',
            'title' => 'Módulo Empleados',
            'keys'  => [
                'employee_list'    => 'Puede ver listado de empleados.',
                'employee_add'      => 'Puede agregar empleados.',
                'employee_edit'     => 'Puede editar empleados.',
                'employee_search'   => 'Puede buscar empleados.',
            ]
        ],

        'attendances' => [
            'icon'  => '<i class="side-menu__icon fe fe-clock"></i>',
            'title' => 'Módulo Asistencia',
            'keys'  => [
                'attendance_list'    => 'Puede ver listado de asistencia.',
                'attendance_add'     => 'Puede agregar asistencia.',
                'attendance_edit'    => 'Puede editar asistencia.',
                'attendance_check'   => 'Puede marcar horario.',
            ]
        ],

        'records' => [
            'icon'  => '<i class="side-menu__icon fe fe-clock"></i>',
            'title' => 'Módulo Marcación',
            'keys'  => [
                'record_list'    => 'Puede ver listado de marcaciones.',
            ]
        ],

        'reports' => [
            'icon'  => '<i class="side-menu__icon fe fe-file"></i>',
            'title' => 'Módulo Reportes',
            'keys'  => [
                'employees_total_report'    => 'Puede ver reportte de empleados',
            ]
        ],

        'departments' => [
            'icon'  => '<i class="side-menu__icon fe fe-database"></i>',
            'title' => 'Módulo Departamentos',
            'keys'  => [
                'department_list'     => 'Puede ver listado de departamentos.',
                'department_add'      => 'Puede agregar departamentos.',
                'department_edit'     => 'Puede editar departamentos.',
            ]
        ],

        'designations' => [
            'icon'  => '<i class="side-menu__icon fe fe-database"></i>',
            'title' => 'Módulo Cargos',
            'keys'  => [
                'designation_list'    => 'Puede ver listado de cargos.',
                'designation_add'      => 'Puede agregar cargos.',
                'designation_edit'     => 'Puede editar cargos.',
            ]
        ],

        'users' => [
            'icon'  => '<i class="fas fa-user-friends"></i> ',
            'title' => 'Módulo Usuarios',
            'keys'  => [
                'user_list'         => 'Puede ver listado de usuarios.',
                'user_add'          => 'Puede agregar usuarios.',
                'user_edit'         => 'Puede editar usuarios.',
                'user_suspend'       => 'Puede suspender usuarios.',
                'user_permissions'  => 'Puede administrar permisos de usuarios.'
            ]
        ],
    ];

    return $p;
}

function getGenderEmployeeArray($mode, $id){
    $gender = ['0' => 'Seleccione Género', '1' => 'Femenino', '2' => 'Masculino'];
    if(!is_null($mode)):
        return $gender;
    else:
        return $gender[$id];
    endif;
}

function getCiviStatusEmployeeArray($mode, $id){
    $civil_status = ['0' => 'Seleccione estado', '1' => 'Soltero', '2' => 'Casado', '3' => 'Viudo', '4' => 'Divorciado'];
    if(!is_null($mode)):
        return $civil_status;
    else:
        return $civil_status[$id];
    endif;
}
