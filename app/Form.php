<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Form extends Model
{
    protected $fillable = ['label', 'action', 'method'];

    public static function get_forms()
    {
        $data = Form::orderBy('label', 'ASC')->get();
        return $data;
    }

    public static function get_form($id)
    {
        $data = Form::where('id', $id)->orderBy('label', 'asc')->first();
        return $data;
    }

    public static function delete_form($id)
    {
        Form::where('id', $id)->delete();
        return TRUE;
    }
}
