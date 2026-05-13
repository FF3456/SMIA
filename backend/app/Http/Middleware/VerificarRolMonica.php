<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * VerificarRolMonica
 *
 * Middleware de seguridad: restringe el acceso al módulo de cálculo
 * de promedios a los roles autorizados por el GAMLP:
 *   - tecnico          (registra y consulta mediciones)
 *   - encargado_monica (valida mediciones y accede a configuración)
 *
 * Se aplica DESPUÉS del middleware auth:api (JWT verificado).
 *
 * Uso en routes/api.php:
 *   Route::middleware(['auth:api', 'rol.monica'])->group(...)
 */
class VerificarRolMonica
{
    const ROLES_PERMITIDOS = ['tecnico', 'encargado_monica'];

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return response()->json([
                'message' => 'No autenticado.',
                'code'    => 'UNAUTHENTICATED',
            ], 401);
        }

        // El rol se almacena en la tabla users.rol (string)
        // o en una tabla pivot roles — adaptar según implementación
        if (! in_array($user->rol, self::ROLES_PERMITIDOS, true)) {
            return response()->json([
                'message' => 'Acceso denegado. Módulo restringido a Técnico y Encargado de Red MONICA.',
                'code'    => 'FORBIDDEN_ROLE',
                'rol_actual'   => $user->rol,
                'roles_validos' => self::ROLES_PERMITIDOS,
            ], 403);
        }

        return $next($request);
    }
}
