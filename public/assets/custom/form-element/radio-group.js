$(function(){
  'use strict'

  $(".radio_group").click(function (){
    $this = ""; //Reset This

    //Clear Modal
    $("#radio-group-form .field_required").val("yes");
    $("#radio-group-form .field_source").val("");
    $("#radio-group-form .field_input_type").val("text");
    $("#radio-group-form input[name=field_id]").val(generateID("radio-group-"));
    $("#radio-group-form input[name=field_name]").val("");
    $("#radio-group-form input[name=field_placeholder]").val("");
    $("#radio-group-form input[name=field_value]").val("");
    $('#modalRadioGroupTitle').text($radio_group_title);
    $('#modalRadioGroup').modal('show');
  });

  $("#radio-group-form").on('submit', function(e){
    e.preventDefault();

    //Add Text Field
    var field = {
      'field_required': $.trim($("#radio-group-form .field_required").val()),
      'field_source': $.trim($("#radio-group-form .field_source").val()),
      'field_type': "radio-group",
      'field_id': $.trim($("#radio-group-form input[name=field_id]").val()),
      'field_name': $.trim($("#radio-group-form input[name=field_name]").val()),
      'field_placeholder': $.trim($("#radio-group-form input[name=field_placeholder]").val()),
      'field_value': $.trim($("#radio-group-form input[name=field_value]").val())
    };

    if($this == "" && $("#"+field.field_id).length){
      alert($field_id_error);
      $("#radio-group-form input[name=field_id]").focus();
    } else {
      if(field.field_placeholder == "") field.field_placeholder = $select+' '+field.field_name;

      //Add UI
      if($this != "") var newHTML = '';
      else var newHTML = '<div class="field col-md-12 mg-b-5">';

      var options = '';
      var arrayOfLines = $('#radio-group-form .field_source').val().split('\n');
      $.each(arrayOfLines, function (index, item) {
        if ($.trim(item) != "") {
          item = item.split(":");
          if (item[0] == field.field_value) var checked = "checked";
          else var checked = "";

          if (item.length > 1)
            options += '<label class="rdiobox">' +
              '<input ' + checked + ' readonly name="' + field.field_id + '" value="' + item[0] + '" type="radio">' +
              '<span>' + item[1] + '</span>' +
              '</label>';
          else
            options += '<label class="rdiobox">' +
              '<input ' + checked + ' readonly name="' + field.field_id + '" value="' + item[0] + '" type="radio">' +
              '<span>' + item[0] + '</span>' +
              '</label>';
        }
      });

      newHTML += '<div class="card bd-0">' +
        '<div class="card-header tx-medium bd-0 tx-white bg-indigo">' +
        field.field_name +
        '</div><!-- card-header -->' +
        '<div class="card-body bd bd-t-0">' +
        options +
        '</div><!-- card-body -->' +
        '<div class="card-footer bd-t">' +
        '<div class="btn-group" role="group">' +
        '<textarea class="field-json" name="field[]" id="' + field.field_id + '" style="display:none;" required>' + JSON.stringify(field) + '</textarea>' +
        '<button class="btn btn-indigo btn-edit-radio-group pd-x-25" type="button"><i class="fa fa-edit"></i></button>' +
        '<button class="btn btn-danger btn-delete-radio-group pd-x-25" type="button"><i class="fa fa-trash"></i></button>' +
        '</div>' +
        '</div><!-- card-footer -->' +
        '</div><!-- card -->';

      if ($this != "") newHTML += '';
      else newHTML += '</div><!-- input-group --></div>';


      if ($this != "") {
        $($this).parents('.field').first().html(newHTML); //Replace/Edit
      } else $("#design-div").append(newHTML);

      $('#modalRadioGroup').modal('hide');
    }
  });

  $(document).on("click",".btn-delete-radio-group", function(){
    $(this).parents('.field').first().remove();
  });

  $(document).on("click",".btn-edit-radio-group", function(){
    var json = $(this).prev('textarea').val();
    json = JSON.parse(json);

    $this = this; //Set This

    var type = json.field_type;
    var type = type.split("-");

    $("#radio-group-form .field_required").val(json.field_required);
    $("#radio-group-form .field_source").val(json.field_source);
    $("#radio-group-form .field_input_type").val(type[1]);;
    $("#radio-group-form input[name=field_id]").val(json.field_id);
    $("#radio-group-form input[name=field_name]").val(json.field_name);
    $("#radio-group-form input[name=field_placeholder]").val(json.field_placeholder);
    $("#radio-group-form input[name=field_value]").val(json.field_value);
    $('#modalRadioGroupTitle').text($radio_group_title);
    $('#modalRadioGroup').modal('show');
  });
});

function addRadioGroup(field){
  if(field.field_placeholder == "") field.field_placeholder = $select+' '+field.field_name;

  //Add UI
  if($this != "") var newHTML = '';
  else var newHTML = '<div class="field col-md-12 mg-b-5">';

  var options = '';
  var arrayOfLines = field.field_source.split('\n');
  $.each(arrayOfLines, function (index, item) {
    if ($.trim(item) != "") {
      item = item.split(":");
      if (item[0] == field.field_value) var checked = "checked";
      else var checked = "";

      if (item.length > 1)
        options += '<label class="rdiobox">' +
          '<input ' + checked + ' readonly name="' + field.field_id + '" value="' + item[0] + '" type="radio">' +
          '<span>' + item[1] + '</span>' +
          '</label>';
      else
        options += '<label class="rdiobox">' +
          '<input ' + checked + ' readonly name="' + field.field_id + '" value="' + item[0] + '" type="radio">' +
          '<span>' + item[0] + '</span>' +
          '</label>';
    }
  });

  newHTML += '<div class="card bd-0">' +
    '<div class="card-header tx-medium bd-0 tx-white bg-indigo">' +
    field.field_name +
    '</div><!-- card-header -->' +
    '<div class="card-body bd bd-t-0">' +
    options +
    '</div><!-- card-body -->' +
    '<div class="card-footer bd-t">' +
    '<div class="btn-group" role="group">' +
    '<textarea class="field-json" name="field[]" id="' + field.field_id + '" style="display:none;" required>' + JSON.stringify(field) + '</textarea>' +
    '<button class="btn btn-indigo btn-edit-radio-group pd-x-25" type="button"><i class="fa fa-edit"></i></button>' +
    '<button class="btn btn-danger btn-delete-radio-group pd-x-25" type="button"><i class="fa fa-trash"></i></button>' +
    '</div>' +
    '</div><!-- card-footer -->' +
    '</div><!-- card -->';

  if ($this != "") newHTML += '';
  else newHTML += '</div><!-- input-group --></div>';


  if ($this != "") {
    $($this).parents('.field').first().html(newHTML); //Replace/Edit
  } else $("#design-div").append(newHTML);
}
