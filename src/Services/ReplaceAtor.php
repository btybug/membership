<?php
/**
 * Created by PhpStorm.
 * User: menq
 * Date: 20.12.2017
 * Time: 13:39
 */

namespace BtyBugHook\Membership\Services;


class ReplaceAtor
{


    public static function replace(string $html, $field)
    {
        $replecables = self::replecables($field);
        foreach ($replecables as $key=>$replecable){
            $html=str_replace($key,$replecable,$html);
        }
        return $html;
    }

    public static function replecables($field)
    {
        $id = $field->id;
        return [
            '{!! $field[\'id\'] !!}' => $id,
            '$field[\'id\']' => $id,
            '$field[\'column_name\']' => "get_field_attr($id,'column_name')",
            '$field[\'table_name\']' => "get_field_attr($id,'table_name')",
            '$field[\'placeholder\']' => "get_field_attr($id,'placeholder')",
            '$field[\'label\']' => "get_field_attr($id,'label')",
        ];
    }
}