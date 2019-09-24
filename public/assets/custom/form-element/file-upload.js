$(function(){
  'use strict'

  $(".file_upload").click(function (){
    $this = ""; //Reset This

    //Clear Modal
    $("#file-upload-form .field_required").val("yes");
    $("#file-upload-form input[name=field_id]").val(generateID("file-upload-"));
    $("#file-upload-form input[name=field_name]").val("");
    $("#file-upload-form textarea[name=field_description]").val("");

    $('#modalFileUploadTitle').text($file_upload_title);
    $('#modalFileUpload').modal('show');
  });

  $("#file-upload-form").on('submit', function(e){
    e.preventDefault();

    //Add Text Field
    var field = {
      'field_required': $.trim($("#text-box-form .field_required").val()),
      'field_type': "file-upload",
      'field_id': $.trim($("#file-upload-form input[name=field_id]").val()),
      'field_name': $.trim($("#file-upload-form input[name=field_name]").val()),
      'field_description': $.trim($("#file-upload-form textarea[name=field_description]").val())
    };

    if($this == "" && $("#"+field.field_id).length){
      alert($field_id_error);
      $("#file-upload-form input[name=field_id]").focus();
    } else {

      //Add UI
      if($this != "") var newHTML = '';
      else var newHTML = '<div class="field col-md-12 mg-b-5">';

      newHTML += '<div class="card bd-0">'+
        '<div class="card-header tx-medium bd-0 tx-white bg-indigo">'+
          field.field_name+
        '</div><!-- card-header -->'+
        '<div class="card-body bd bd-t-0">'+
          '<p>'+field.field_description+'</p>'+
          '<input type="file" readonly class="form-control" placeholder="'+field.field_placeholder+'" />'+
        '</div><!-- card-body -->' +
        '<div class="card-footer bd-t">'+
          '<div class="btn-group" role="group">'+
            '<textarea class="field-json" name="field[]" id="'+field.field_id+'" style="display:none;" required>'+JSON.stringify(field)+'</textarea>'+
            '<button class="btn btn-indigo btn-edit-file-upload pd-x-25" type="button"><i class="fa fa-edit"></i></button>'+
            '<button class="btn btn-danger btn-delete-file-upload pd-x-25" type="button"><i class="fa fa-trash"></i></button>'+
          '</div>'+
        '</div><!-- card-footer -->'+
      '</div><!-- card -->';

      if($this != "") newHTML += '';
      else newHTML += '</div><!-- input-group --></div>';

      if($this != ""){
        $($this).parents('.field').first().html(newHTML); //Replace/Edit
      } else $("#design-div").append(newHTML);

      $('#modalFileUpload').modal('hide');
    }
  });

  $(document).on("click",".btn-delete-file-upload", function(){
    $(this).parents('.field').first().remove();
  });

  $(document).on("click",".btn-edit-file-upload", function(){
    var json = $(this).prev('textarea').val();
    json = JSON.parse(json);

    $this = this; //Set This
    $("#file-upload-form .field_required").val(json.field_required);
    $("#file-upload-form input[name=field_id]").val(json.field_id);
    $("#file-upload-form input[name=field_name]").val(json.field_name);
    $("#file-upload-form textarea[name=field_description]").val(json.field_description);

    $('#modalFileUploadTitle').text($file_upload_title);
    $('#modalFileUpload').modal('show');
  });
});

function addFileUpload(field){
  //Add UI
  if($this != "") var newHTML = '';
  else var newHTML = '<div class="field col-md-12 mg-b-5">';

  if(field.field_description == null) field.field_description = "";

  newHTML += '<div class="card bd-0">'+
    '<div class="card-header tx-medium bd-0 tx-white bg-indigo">'+
      field.field_name+
    '</div><!-- card-header -->'+
    '<div class="card-body bd bd-t-0">'+
      '<p>'+field.field_description+'</p>'+
      '<input type="file" readonly class="form-control" placeholder="'+field.field_placeholder+'" />'+
    '</div><!-- card-body -->' +
    '<div class="card-footer bd-t">'+
      '<div class="btn-group" role="group">'+
        '<textarea class="field-json" name="field[]" id="'+field.field_id+'" style="display:none;" required>'+JSON.stringify(field)+'</textarea>'+
        '<button class="btn btn-indigo btn-edit-file-upload pd-x-25" type="button"><i class="fa fa-edit"></i></button>'+
        '<button class="btn btn-danger btn-delete-file-upload pd-x-25" type="button"><i class="fa fa-trash"></i></button>'+
      '</div>'+
    '</div><!-- card-footer -->'+
  '</div><!-- card -->';

  if($this != "") newHTML += '';
  else newHTML += '</div><!-- input-group --></div>';

  if($this != ""){
    $($this).parents('.field').first().html(newHTML); //Replace/Edit
  } else $("#design-div").append(newHTML);

}
