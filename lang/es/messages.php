<?php

return [
    'crud' => [
        'created' => 'Registro creado exitosamente!',
        'updated' => 'Registro actualizado exitosamente!',
        'deleted' => 'Registro eliminado exitosamente!'
    ],
    'reservations' => [
        'change_state' => [
            'no_changes' => 'No se registraron cambios!',
            'success' => 'Reserva actualizada con éxito!',
            'error' => 'La reserva contiene horas ya pagadas por otro cliente!'
        ],
        'header_days' => [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miercoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sabado',
            'Sunday' => 'Domingo'
        ],
        'fixed' => [
            'not_available' => 'Existen horas ya reservadas dentro de las fechas seleccionadas!'
        ]
    ]
];
