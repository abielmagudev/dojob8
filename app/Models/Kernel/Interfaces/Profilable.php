<?php 

namespace App\Models\Kernel\Interfaces;

/**
 * Para modelos que tienen perfiles de usuario.
 */
interface Profilable
{
    /**
     * Obtiene el nombre real del perfil del usuario autenticado
     */
    public function getProfiledNameAttribute(): string;
}
