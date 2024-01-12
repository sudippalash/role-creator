<?php

namespace Sudip\RoleCreator\Traits;

trait RoleUtility
{
    public function cssGenerate()
    {
        $cssClass = config('role-creator.css');
        
        $cssClass['container'] = isset($cssClass['container']) ? $cssClass['container'] : 'container-fluid';

        $cssClass['card'] = isset($cssClass['card']) ? $cssClass['card'] : 'card';

        $cssClass['input'] = isset($cssClass['input']) ? $cssClass['input'] : 'form-control';

        $cssClass['btn'] = isset($cssClass['btn']) ? $cssClass['btn'] : 'btn-secondary';

        $cssClass['table'] = isset($cssClass['table']) ? $cssClass['table'] : null;

        $cssClass['table_action_col_width'] = isset($cssClass['table_action_col_width']) ? $cssClass['table_action_col_width'] : null;
        
        $cssClass['table_action_btn'] = isset($cssClass['table_action_btn']) ? $cssClass['table_action_btn'] : 'btn-secondary';
        
        return $cssClass;
    }

    private function prettyPrint($string, $module = null)
    {
        if (! empty($module)) {
            $string = str_replace($module, ' ', $string);
        }


        $separator = config('role-creator.role_permission_name_separator');
        if (is_array($separator)) {
            $string = trim(str_replace($separator, ' ', $string));
        }

        return ucwords($string);
    }
}