<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormMeta extends Model
{
    //

    public static function get_form_meta($id)
    {
        $data = FormMeta::where('form_id', $id)->orderBy('field_order', 'asc')->get();
        return $data;
    }

    public static function delete_form_meta($id)
    {
        FormMeta::where('form_id', $id)->delete();
        return TRUE;
    }
}
