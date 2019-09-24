$(function(){
  'use strict'

  $(".text_area").click(function (){
    $this = ""; //Reset This

    //Clear Modal
    $("#text-area-form .field_required").val("yes");
    $("#text-area-form input[name=field_id]").val(generateID("text-area-"));
    $("#text-area-form input[name=field_name]").val("");
    $("#text-area-form input[name=field_placeholder]").val("");
    $("#text-area-form input[name=field_value]").val("");

    $('#modalTextAreaTitle').text($text_area_title);
    $('#modalTextArea').modal('show');
  });

  $("#text-area-form").on('submit', function(e){
    e.preventDefault();

    //Add Text Field
    var field = {
      'field_required': $.trim($("#text-area-form .field_required").val()),
      'field_type': "text-area",
      'field_id': $.trim($("#text-area-form input[name=field_id]").val()),
      'field_name': $.trim($("#text-area-form input[name=field_name]").val()),
      'field_placeholder': $.trim($("#text-area-form input[name=field_placeholder]").val()),
      'field_value': $.trim($("#text-area-form input[name=field_value]").val())
    };

    if($this == "" && $("#"+field.field_id).length){
      alert($field_id_error);
      $("#text-area-form input[name=field_id]").focus();
    } else {
      if(field.field_placeholder == "") field.field_placeholder = field.field_value;

      //Add UI
      if($this != "") var newHTML = '';
      else var newHTML = '<div class="field col-md-12 mg-b-5">';

      newHTML += '<div class="card bd-0">'+
        '<div class="card-header tx-medium bd-0 tx-white bg-indigo">'+
          field.field_name +
        '</div><!-- card-header -->' +
        '<div class="card-body bd bd-t-0">'+
          '<textarea readonly class="form-control" placeholder="'+field.field_placeholder+'"></textarea>'+
        '</div><!-- card-body -->' +
        '<div class="card-footer bd-t">'+
            '<div class="btn-group" role="group">'+
              '<textarea class="field-json" name="field[]" id="'+field.field_id+'" style="display:none;" required>'+JSON.stringify(field)+'</textarea>'+
              '<button class="btn btn-indigo btn-edit-text-area pd-x-25" type="button"><i class="fa fa-edit"></i></button>'+
              '<button class="btn btn-danger btn-delete-text-area pd-x-25" type="button"><i class="fa fa-trash"></i></button>'+
            '</div>'+
          '</div><!-- card-footer -->'+
        '</div><!-- card -->';

      if($this != "") newHTML += '';
      else newHTML += '</div><!-- input-group --></div>';

      if($this != ""){
        $($this).parents('.field').first().html(newHTML); //Replace/Edit
      } else $("#design-div").append(newHTML);

      $('#modalTextArea').modal('hide');
    }
  });

  $(document).on("click",".btn-delete-text-area", function(){
    $(this).parents('.field').first().remove();
  });

  $(document).on("click",".btn-edit-text-area", function(){
    var json = $(this).prev('textarea').val();
    json = JSON.parse(json);

    $this = this; //Set This

    $("#text-area-form input[name=field_id]").val(json.field_id);
    $("#text-area-form input[name=field_name]").val(json.field_name);
    $("#text-area-form input[name=field_placeholder]").val(json.field_placeholder);
    $("#text-area-form input[name=field_value]").val(json.field_value);

    $('#modalTextAreaTitle').text($text_area_title);
    $('#modalTextArea').modal('show');
  });
});

function addTextArea(field){
  if(field.field_placeholder == "") field.field_placeholder = field.field_value;

  //Add UI
  if($this != "") var newHTML = '';
  else var newHTML = '<div class="field col-md-12 mg-b-5">';

  newHTML += '<div class="card bd-0">'+
    '<div class="card-header tx-medium bd-0 tx-white bg-indigo">'+
      field.field_name +
    '</div><!-- card-header -->' +
    '<div class="card-body bd bd-t-0">'+
      '<textarea readonly class="form-control" placeholder="'+field.field_placeholder+'"></textarea>'+
    '</div><!-- card-body -->' +
    '<div class="card-footer bd-t">'+
        '<div class="btn-group" role="group">'+
          '<textarea class="field-json" name="field[]" id="'+field.field_id+'" style="display:none;" required>'+JSON.stringify(field)+'</textarea>'+
          '<button class="btn btn-indigo btn-edit-text-area pd-x-25" type="button"><i class="fa fa-edit"></i></button>'+
          '<button class="btn btn-danger btn-delete-text-area pd-x-25" type="button"><i class="fa fa-trash"></i></button>'+
        '</div>'+
      '</div><!-- card-footer -->'+
    '</div><!-- card -->';

  if($this != "") newHTML += '';
  else newHTML += '</div><!-- input-group --></div>';

  if($this != ""){
    $($this).parents('.field').first().html(newHTML); //Replace/Edit
  } else $("#design-div").append(newHTML);
}
