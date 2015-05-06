<?php
class ManageLevel{
    const ROOT = 'diretor';
    const ADMIN = 'gestor';
    const COMUM = 'aluno';
    
    private $niveisUsuario;
    
    public static function getLevel($nivelUsuario)
    {
        $niveisUsuario['ROOT'] = 'diretor';
        $niveisUsuario['ADMIN'] = 'gestor';
        $niveisUsuario['COMUM'] = 'aluno';
        return isset($niveisUsuario[$nivelUsuario]) ? $niveisUsuario[$nivelUsuario] : null;
    }
}