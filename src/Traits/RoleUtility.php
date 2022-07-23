<?php

namespace Sudip\RoleCreator\Traits;

trait RoleUtility
{
    public function cssGenerate()
    {
        $cssClass = config('role-creator.css');
        if (!isset($cssClass['container']) && $cssClass['container'] == null) {
            $cssClass['container'] = 'container-fluid';
        }
        
        if (!isset($cssClass['card']) && $cssClass['card'] == null) {
            $cssClass['card'] = 'card';
        }
        
        if (!isset($cssClass['input']) && $cssClass['input'] == null) {
            $cssClass['input'] = 'form-control';
        }
        
        if (!isset($cssClass['btn']) && $cssClass['btn'] == null) {
            $cssClass['btn'] = 'btn-secondary';
        }
        
        return $cssClass;
    }
}