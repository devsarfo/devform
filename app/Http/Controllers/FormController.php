<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;
use App\FormMeta;

class FormController extends Controller
{
    //

    public function index(){
        $data = array();
        $data['forms'] = Form::get_forms();
        $data['subview'] = 'form.index';
        $data['page_title'] = 'Forms';
        return view('layout', $data);
    }

    public function add(){
        $data = array();
        $data['subview'] = 'form.add';
        $data['page_title'] = 'Create New Form';
        return view('layout', $data);
    }

    public function edit($id){
        $data = array();

        //Verify ID
        $data['form'] = Form::findOrFail($id);
        if($data['form']){
            //Load Meta
            $data['form_meta'] = FormMeta::get_form_meta($id);
            $data['subview'] = 'form.edit';
            $data['page_title'] = 'Edit Form';
            return view('layout', $data);
        } else return redirect('/form')->with('error', 'Invalid Form ID!');    
    }

    public function delete($id){
        $data = array();

        //Verify ID
        $data['form'] = Form::findOrFail($id);
        if($data['form']){
            Form::delete_form($id); //Delete 
            FormMeta::delete_form_meta($id); //Delete 
            
            return redirect('/form')->with('success', 'Form was deleted successfully!');
        } else return redirect('/form')->with('error', 'Invalid Form ID!');    
    }

    public function view($id){
        $html = "";
        
        //Verify ID
        $form = Form::findOrFail($id);
        if($form){
            //Load Meta
            $form_meta = FormMeta::get_form_meta($id);
            foreach($form_meta as $field){
                $html .= $this->build($field);
            }
        } 

        $data = array('html' => $html, 'form' => $form); 
        return view('preview', $data);
    }

    public function html($id){
        $html = "";
        
        //Verify ID
        $form = Form::findOrFail($id);
        if($form){
            //Load Meta
            $form_meta = FormMeta::get_form_meta($id);
            foreach($form_meta as $field){
                $html .= $this->build($field);
            }
        } 
        
        return $html;
    }

    private function build($field){
        $html = $required = '';
    if($field->field_type == "block-title"){
      $html = '<div class="col-md-12 mg-t-5"><div class="card bd-0">';
      $html .= '<div class="card-header tx-medium bd-0 tx-white bg-indigo"><center>';
      $html .= $field->field_name;
      $html .= '</center></div><!-- card-header -->';
      if($field->field_description != "") $html .= '<div class="card-body bd bd-t-0"><p class="mg-b-0">'.
      $field->field_description.'</p></div><!-- card-body -->';
      $html .= '</div><!-- card --></div><!-- col -->';
    } else if($field->field_type == "file-upload"){
      if($field->field_required == "yes") $required = "required";
      $html = '<div class="col-md-12 mg-t-5">';
      $html .= '<label class="az-content-label tx-11 tx-medium tx-gray-600">';
      $html .= $field->field_name;
      $html .= '</label>';
      $html .= '<input type="file" name="'.$field->field_id.'"';
      $html .= 'value="'.$field->field_value.'" placeholder="'.$field->field_placeholder.'"';
      $html .= 'class="form-control" '.$required.' /><!-- form-group -->';
      if($field->field_description != "") $html .= '<span class="error">'.$field->field_description.'</span>';
      $html .= '</div><!-- col -->';
    } else if($field->field_type == "text-text" || $field->field_type == "text-phone" || $field->field_type == "text-email" || $field->field_type == "text-date"){
      $type = explode("-", $field->field_type);
      if($type[1] == "phone") $type = "tel";
      else $type = $type[1];

      if($field->field_required == "yes") $required = "required";

      $html = '<div class="col-md-12 mg-t-5">';
      $html .= '<label class="az-content-label tx-11 tx-medium tx-gray-600">';
      $html .= $field->field_name;
      $html .= '</label>';
      $html .= '<input type="'.$type.'" name="'.$field->field_id.'"';
      $html .= 'value="'.$field->field_value.'" placeholder="'.$field->field_placeholder.'"';
      $html .= 'class="form-control" '.$required.' /><!-- form-group -->';
      if($field->field_description != "") $html .= '<span class="error">'.$field->field_description.'</span>';
      $html .= '</div><!-- col -->';
    } else if($field->field_type == "text-area"){
      if($field->field_required == "yes") $required = "required";
      $html = '<div class="col-md-12 mg-t-5">';
      $html .= '<label class="az-content-label tx-11 tx-medium tx-gray-600">';
      $html .= $field->field_name;
      $html .= '</label>';
      $html .= '<textarea placeholder="'.$field->field_placeholder.'" name="'.$field->field_id.'" ';
      $html .= 'class="form-control" '.$required.'>'.$field->field_value.'</textarea><!-- form-group -->';
      if($field->field_description != "") $html .= '<span class="error">'.$field->field_description.'</span>';
      $html .= '</div><!-- col -->';
    } else if($field->field_type == "select-box"){
      if($field->field_required == "yes") $required = "required";

      $html = '<div class="col-md-12 mg-t-5">';
      $html .= '<label class="az-content-label tx-11 tx-medium tx-gray-600">';
      $html .= $field->field_name;
      $html .= '</label>';
      $html .= '<select class="form-control select2-no-search" '.$required.' name="'.$field->field_id.'">';
      $html .= '<option value="">'.$field->field_placeholder.'</option>';
      foreach(explode("\n", $field->field_source) as $line) {
          $option = explode(":", $line);
          if(count($option) > 1)
            $html .= '<option value="'.$option[0].'">'.$option[1].'</option>';
          else
            $html .= '<option value="'.$option[0].'">'.$option[0].'</option>';
        }
      $html .= '</select><!-- form-group -->';
      if($field->field_description != "") $html .= '<span class="error">'.$field->field_description.'</span>';
      $html .= '</div><!-- col -->';
    } else if($field->field_type == "radio-group"){
      if($field->field_required == "yes") $required = "required";

      $html = '<div class="col-md-12 mg-t-5">';
      $html .= '<label class="az-content-label tx-11 tx-medium tx-gray-600">';
      $html .= $field->field_name;
      $html .= '</label>';
      $html .= '<div class="row">';
      foreach(explode("\n", $field->field_source) as $line) {
          $option = explode(":", $line);
          if(count($option) > 1){
            $html .= '<div class="col-md-3 mg-t-5"><label class="rdiobox">';
            $html .= '<input type="radio" value="'.$option[0].'" name="'.$field->field_id.'">';
            $html .= '<span>'.$option[1].'</span></label></div>';
          } else {
            $html .= '<div class="col-md-3 mg-t-5"><label class="rdiobox">';
            $html .= '<input type="radio" value="'.$option[0].'" name="'.$field->field_id.'">';
            $html .= '<span>'.$option[0].'</span></label></div>';
          }
        }

      $html .= '</div><!-- form-group -->';
      if($field->field_description != "") $html .= '<span class="error">'.$field->field_description.'</span>';
      $html .= '</div><!-- col -->';
    } else if($field->field_type == "list-options"){
      if($field->field_required == "yes") $required = "required";

      $html = '<div class="col-md-12 mg-t-5">';
      $html .= '<label class="az-content-label tx-11 tx-medium tx-gray-600">';
      $html .= $field->field_name;
      $html .= '</label>';
      $html .= '<div class="row">';
      foreach(explode("\n", $field->field_source) as $line) {
          $option = explode(":", $line);
          if(count($option) > 1){
            $html .= '<div class="col-md-3 mg-t-5"><label class="ckbox">';
            $html .= '<input type="checkbox" value="'.$option[0].'" name="'.$field->field_id.'">';
            $html .= '<span>'.$option[1].'</span></label></div>';
          } else {
            $html .= '<div class="col-md-3 mg-t-5"><label class="ckbox">';
            $html .= '<input type="checkbox" value="'.$option[0].'" name="'.$field->field_id.'">';
            $html .= '<span>'.$option[0].'</span></label></div>';
          }
        }
      $html .= '</div><!-- form-group -->';
      if($field->field_description != "") $html .= '<span class="error">'.$field->field_description.'</span>';
      $html .= '</div><!-- col -->';
    }

    return $html;
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'label' => 'required|max:255',
            'action' => 'required',
            'method' => 'required',
        ]);
        
        $form = Form::create($validatedData);
        
        //Save Fields
        if($request->has('field')){
            $fields_array = array(); $i = 0;
            foreach($request->input('field') as $field){
                $field = json_decode($field, true);
                $fields_array[] = array(
                    'form_id' => $form->id,
                    'field_id' => isset($field['field_id']) ? $field['field_id'] : NULL,
                    'field_name' => isset($field['field_name']) ? $field['field_name'] : NULL,
                    'field_type' => isset($field['field_type']) ? $field['field_type'] : NULL,
                    'field_value' => isset($field['field_value']) ? $field['field_value'] : NULL,
                    'field_placeholder' => isset($field['field_placeholder']) ? $field['field_placeholder'] : NULL,
                    'field_source' => isset($field['field_source']) ? $field['field_source'] : NULL,
                    'field_required' => isset($field['field_required']) ? $field['field_required'] : 'no',
                    'field_order' => $i,
                );
            }
            FormMeta::insert($fields_array);
        }
        return redirect('/form')->with('success', 'Form was created successfully!');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'label' => 'required|max:255',
            'action' => 'required',
            'method' => 'required',
        ]);
        
        Form::whereId($id)->update($validatedData);
        
        //Save Fields
        if($request->has('field')){
            $fields_array = array(); $i = 0;
            foreach($request->input('field') as $field){ $i++;
                $field = json_decode($field, true);
                $fields_array[] = array(
                    'form_id' => $id,
                    'field_id' => isset($field['field_id']) ? $field['field_id'] : NULL,
                    'field_name' => isset($field['field_name']) ? $field['field_name'] : NULL,
                    'field_type' => isset($field['field_type']) ? $field['field_type'] : NULL,
                    'field_value' => isset($field['field_value']) ? $field['field_value'] : NULL,
                    'field_placeholder' => isset($field['field_placeholder']) ? $field['field_placeholder'] : NULL,
                    'field_source' => isset($field['field_source']) ? $field['field_source'] : NULL,
                    'field_required' => isset($field['field_required']) ? $field['field_required'] : 'no',
                    'field_order' => $i,
                );
            }
            FormMeta::delete_form_meta($id); //Delete Old
            FormMeta::insert($fields_array);
        }
        return redirect('/form')->with('success', 'Form was updated successfully!');
    }
}
