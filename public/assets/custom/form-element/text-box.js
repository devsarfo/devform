$(function(){
  'use strict'

  $(".text_box").click(function (){
    $this = ""; //Reset This

    //Clear Modal
    $("#text-box-form .field_required").val("yes");
    $("#text-box-form .field_input_type").val("text");
    $("#text-box-form input[name=field_id]").val(generateID("text-box-"));
    $("#text-box-form input[name=field_name]").val("");
    $("#text-box-form input[name=field_placeholder]").val("");
    $("#text-box-form input[name=field_value]").val("");

    $('#modalTextBoxTitle').text($text_box_title);
    $('#modalTextBox').modal('show');
  });

  $("#text-box-form").on('submit', function(e){
    e.preventDefault();

    //Add Text Field
    var field = {
      'field_required': $.trim($("#text-box-form .field_required").val()),
      'field_type': "text-" + $.trim($("#text-box-form .field_input_type").val()),
      'field_id': $.trim($("#text-box-form input[name=field_id]").val()),
      'field_name': $.trim($("#text-box-form input[name=field_name]").val()),
      'field_placeholder': $.trim($("#text-box-form input[name=field_placeholder]").val()),
      'field_value': $.trim($("#text-box-form input[name=field_value]").val())
    };

    if($this == "" && $("#"+field.field_id).length){
      alert($field_id_error);
      $("#text-box-form input[name=field_id]").focus();
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
          '<input type="text" readonly class="form-control" placeholder="'+field.field_placeholder+'">'+
        '</div><!-- card-body -->' +
        '<div class="card-footer bd-t">'+
            '<div class="btn-group" role="group">'+
              '<textarea class="field-json" name="field[]" id="'+field.field_id+'" style="display:none;" required>'+JSON.stringify(field)+'</textarea>'+
              '<button class="btn btn-indigo btn-edit-text-box pd-x-25" type="button"><i class="fa fa-edit"></i></button>'+
              '<button class="btn btn-danger btn-delete-text-box pd-x-25" type="button"><i class="fa fa-trash"></i></button>'+
            '</div>'+
          '</div><!-- card-footer -->'+
        '</div><!-- card -->';

      if($this != "") newHTML += '';
      else newHTML += '</div><!-- input-group --></div>';


      if($this != ""){
        $($this).parents('.field').first().html(newHTML); //Replace/Edit
      } else $("#design-div").append(newHTML);

      $('#modalTextBox').modal('hide');
    }
  });

  $(document).on("click",".btn-delete-text-box", function(){
    $(this).parents('.field').first().remove();
  });

  $(document).on("click",".btn-edit-text-box", function(){
    var json = $(this).prev('textarea').val();
    json = JSON.parse(json);

    $this = this; //Set This

    var type = json.field_type;
    var type = type.split("-");

    $("#text-box-form .field_required").val(json.field_required);
    $("#text-box-form .field_input_type").val(type[1]);
    $("#text-box-form input[name=field_id]").val(json.field_id);
    $("#text-box-form input[name=field_name]").val(json.field_name);
    $("#text-box-form input[name=field_placeholder]").val(json.field_placeholder);
    $("#text-box-form input[name=field_value]").val(json.field_value);

    $('#modalTextBoxTitle').text($text_box_title);
    $('#modalTextBox').modal('show');
  });
});

function addTexBox(field){
  if(field.field_placeholder == "") field.field_placeholder = field.field_value;

  //Add UI
  if($this != "") var newHTML = '';
  else var newHTML = '<div class="field col-md-12 mg-b-5">';

  newHTML += '<div class="card bd-0">'+
    '<div class="card-header tx-medium bd-0 tx-white bg-indigo">'+
      field.field_name +
    '</div><!-- card-header -->' +
    '<div class="card-body bd bd-t-0">'+
      '<input type="text" readonly class="form-control" placeholder="'+field.field_placeholder+'">'+
    '</div><!-- card-body -->' +
    '<div class="card-footer bd-t">'+
        '<div class="btn-group" role="group">'+
          '<textarea class="field-json" name="field[]" id="'+field.field_id+'" style="display:none;" required>'+JSON.stringify(field)+'</textarea>'+
          '<button class="btn btn-indigo btn-edit-text-box pd-x-25" type="button"><i class="fa fa-edit"></i></button>'+
          '<button class="btn btn-danger btn-delete-text-box pd-x-25" type="button"><i class="fa fa-trash"></i></button>'+
        '</div>'+
      '</div><!-- card-footer -->'+
    '</div><!-- card -->';

  if($this != "") newHTML += '';
  else newHTML += '</div><!-- input-group --></div>';


  if($this != ""){
    $($this).parents('.field').first().html(newHTML); //Replace/Edit
  } else $("#design-div").append(newHTML);
}
