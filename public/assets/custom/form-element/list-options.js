$(function(){
  'use strict'

  $(".list_options").click(function (){
    $this = ""; //Reset This

    //Clear Modal
    $("#list-options-form .field_required").val("yes");
    $("#list-options-form .field_source").val("");
    $("#list-options-form .field_input_type").val("text");
    $("#list-options-form input[name=field_id]").val(generateID("list-options-area-"));
    $("#list-options-form input[name=field_name]").val("");
    $("#list-options-form input[name=field_placeholder]").val("");
    $("#list-options-form input[name=field_value]").val("");
    $('#modalListOptionsTitle').text($list_options_title);
    $('#modalListOptions').modal('show');
  });

  $("#list-options-form").on('submit', function(e){
    e.preventDefault();

    //Add Text Field
    var field = {
      'field_required': $.trim($("#list-options-form .field_required").val()),
      'field_source': $.trim($("#list-options-form .field_source").val()),
      'field_type': "list-options",
      'field_id': $.trim($("#list-options-form input[name=field_id]").val()),
      'field_name': $.trim($("#list-options-form input[name=field_name]").val()),
      'field_placeholder': $.trim($("#list-options-form input[name=field_placeholder]").val()),
      'field_value': $.trim($("#list-options-form input[name=field_value]").val())
    };

    if($this == "" && $("#"+field.field_id).length){
      alert($field_id_error);
      $("#list-options-form input[name=field_id]").focus();
    } else {
      if(field.field_placeholder == "") field.field_placeholder = $select+' '+field.field_name;

      //Add UI
      if($this != "") var newHTML = '';
      else var newHTML = '<div class="field col-md-12 mg-b-5">';

      var options = '';
      var arrayOfLines = $('#list-options-form .field_source').val().split('\n');
      $.each(arrayOfLines, function (index, item) {
        if ($.trim(item) != "") {
          item = item.split(":");
          if (item[0] == field.field_value) var checked = "checked";
          else var checked = "";

          if (item.length > 1)
            options += '<label class="ckbox mg-5">' +
              '<input ' + checked + ' readonly name="' + field.field_id + '" value="' + item[0] + '" type="checkbox">' +
              '<span>' + item[1] + '</span>' +
              '</label>';
          else
            options += '<label class="ckbox mg-5">' +
              '<input ' + checked + ' readonly name="' + field.field_id + '" value="' + item[0] + '" type="checkbox">' +
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
        '<button class="btn btn-indigo btn-edit-list-options pd-x-25" type="button"><i class="fa fa-edit"></i></button>' +
        '<button class="btn btn-danger btn-delete-list-options pd-x-25" type="button"><i class="fa fa-trash"></i></button>' +
        '</div>' +
        '</div><!-- card-footer -->' +
        '</div><!-- card -->';

      if ($this != "") newHTML += '';
      else newHTML += '</div><!-- input-group --></div>';


      if ($this != "") {
        $($this).parents('.field').first().html(newHTML); //Replace/Edit
      } else $("#design-div").append(newHTML);

      $('#modalListOptions').modal('hide');
    }
  });

  $(document).on("click",".btn-delete-list-options", function(){
    $(this).parents('.field').first().remove();
  });

  $(document).on("click",".btn-edit-list-options", function(){
    var json = $(this).prev('textarea').val();
    json = JSON.parse(json);

    $this = this; //Set This

    var type = json.field_type;
    var type = type.split("-");

    $("#list-options-form .field_required").val(json.field_required);
    $("#list-options-form .field_source").val(json.field_source);
    $("#list-options-form .field_source_attribute").val(json.field_source_attribute);
    $("#list-options-form .field_input_type").val(type[1]);
    $("#list-options-form input[name=field_id]").val(json.field_id);
    $("#list-options-form input[name=field_name]").val(json.field_name);
    $("#list-options-form input[name=field_placeholder]").val(json.field_placeholder);
    $("#list-options-form input[name=field_value]").val(json.field_value);
    $('#modalListOptionsTitle').text($list_options_title);
    $('#modalListOptions').modal('show');
  });
});

function addListOptions(field){
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
        options += '<label class="ckbox mg-5">' +
          '<input ' + checked + ' readonly name="' + field.field_id + '" value="' + item[0] + '" type="checkbox">' +
          '<span>' + item[1] + '</span>' +
          '</label>';
      else
        options += '<label class="ckbox mg-5">' +
          '<input ' + checked + ' readonly name="' + field.field_id + '" value="' + item[0] + '" type="checkbox">' +
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
    '<button class="btn btn-indigo btn-edit-list-options pd-x-25" type="button"><i class="fa fa-edit"></i></button>' +
    '<button class="btn btn-danger btn-delete-list-options pd-x-25" type="button"><i class="fa fa-trash"></i></button>' +
    '</div>' +
    '</div><!-- card-footer -->' +
    '</div><!-- card -->';

  if ($this != "") newHTML += '';
  else newHTML += '</div><!-- input-group --></div>';

  if ($this != "") {
    $($this).parents('.field').first().html(newHTML); //Replace/Edit
  } else $("#design-div").append(newHTML);
}
