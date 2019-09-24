$(function(){
  'use strict'

  if($temp_form_metadata != "") $form_metadata = $temp_form_metadata;

  //Load Fields
  $.each($form_metadata, function(key, $field) {
    //Parse if required
    try {
        $field = JSON.parse($field);
    } catch (e) {
        console.log(e);
    }

    $this = "";
    if($field.field_type == "block-title") addBlockTitle($field);
    else if($field.field_type == "file-upload") addFileUpload($field);
    else if($field.field_type == "text-text") addTexBox($field);
    else if($field.field_type == "text-phone") addTexBox($field);
    else if($field.field_type == "text-email") addTexBox($field);
    else if($field.field_type == "text-date") addTexBox($field);
    else if($field.field_type == "text-area") addTextArea($field);
    else if($field.field_type == "select-box") addSelectBox($field);
    else if($field.field_type == "radio-group") addRadioGroup($field);
    else if($field.field_type == "list-options") addListOptions($field);
  });
});
