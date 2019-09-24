$(function(){
  'use strict'

  $(".select_box").click(function (){
    $this = ""; //Reset This

    //Clear Modal
    $("#select-box-form .field_required").val("yes");
    $("#select-box-form .field_input_type").val("text");
    $("#select-box-form textarea[name=field_source]").val("");
    $("#select-box-form input[name=field_id]").val(generateID("select-box-"));
    $("#select-box-form input[name=field_name]").val("");
    $("#select-box-form input[name=field_placeholder]").val("");
    $("#select-box-form input[name=field_value]").val("");
    $('#modalSelectBoxTitle').text($select_box_title);
    $('#modalSelectBox').modal('show');
  });

  $("#select-box-form").on('submit', function(e){
    e.preventDefault();

    //Add Text Field
    var field = {
      'field_required': $.trim($("#select-box-form .field_required").val()),
      'field_source': $.trim($("#select-box-form .field_source").val()),
      'field_type': "select-box",
      'field_id': $.trim($("#select-box-form input[name=field_id]").val()),
      'field_name': $.trim($("#select-box-form input[name=field_name]").val()),
      'field_placeholder': $.trim($("#select-box-form input[name=field_placeholder]").val()),
      'field_value': $.trim($("#select-box-form input[name=field_value]").val())
    };

    if($this == "" && $("#"+field.field_id).length){
      alert($field_id_error);
      $("#select-box-form input[name=field_id]").focus();
    } else {
      if(field.field_placeholder == "") field.field_placeholder = $select+' '+field.field_name;

      //Add UI
      if($this != "") var newHTML = '';
      else var newHTML = '<div class="field col-md-12 mg-b-5">';

      var options = '<option selected value="">'+field.field_placeholder+'</option>';
      var arrayOfLines = $('#select-box-form .field_source').val().split('\n');
      $.each(arrayOfLines, function (index, item) {
        if ($.trim(item) != "") {
          item = item.split(":");
          if (item[0] == field.field_value) var selected = "selected";
          else var selected = "";

          if (item.length > 1)
            options += '<option ' + selected + ' value="' + item[0] + '">' + item[1] + '</option>';
          else
            options += '<option ' + selected + ' value="' + item[0] + '">' + item[0] + '</option>';
        }
      });

      newHTML += '<div class="card bd-0">' +
        '<div class="card-header tx-medium bd-0 tx-white bg-indigo">' +
        field.field_name +
        '</div><!-- card-header -->' +
        '<div class="card-body bd bd-t-0">' +
        '<select readonly class="form-control">' +
        options +
        '</select>' +
        '</div><!-- card-body -->' +
        '<div class="card-footer bd-t">' +
        '<div class="btn-group" role="group">' +
        '<textarea class="field-json" name="field[]" id="' + field.field_id + '" style="display:none;" required>' + JSON.stringify(field) + '</textarea>' +
        '<button class="btn btn-indigo btn-edit-select-box pd-x-25" type="button"><i class="fa fa-edit"></i></button>' +
        '<button class="btn btn-danger btn-delete-select-box pd-x-25" type="button"><i class="fa fa-trash"></i></button>' +
        '</div>' +
        '</div><!-- card-footer -->' +
        '</div><!-- card -->';

      if ($this != "") newHTML += '';
      else newHTML += '</div><!-- input-group --></div>';


      if ($this != "") {
        $($this).parents('.field').first().html(newHTML); //Replace/Edit
      } else $("#design-div").append(newHTML);

      $('#modalSelectBox').modal('hide');
    }
  });

  $(document).on("click",".btn-delete-select-box", function(){
    $(this).parents('.field').first().remove();
  });

  $(document).on("click",".btn-edit-select-box", function(){
    var json = $(this).prev('textarea').val();
    json = JSON.parse(json);

    $this = this; //Set This

    var type = json.field_type;
    var type = type.split("-");

    $("#select-box-form .field_required").val(json.field_required);
    $("#select-box-form .field_source").val(json.field_source);
    $("#select-box-form .field_input_type").val(type[1]);
    $("#select-box-form input[name=field_id]").val(json.field_id);
    $("#select-box-form input[name=field_name]").val(json.field_name);
    $("#select-box-form input[name=field_placeholder]").val(json.field_placeholder);
    $("#select-box-form input[name=field_value]").val(json.field_value);    
    $('#modalSelectBoxTitle').text($select_box_title);
    $('#modalSelectBox').modal('show');
  });
});

function addSelectBox(field){
  if(field.field_placeholder == "") field.field_placeholder = $select+' '+field.field_name;

  //Add UI
  if($this != "") var newHTML = '';
  else var newHTML = '<div class="field col-md-12 mg-b-5">';

  var options = '<option selected value="">'+field.field_placeholder+'</option>';
  var arrayOfLines = field.field_source.split('\n');
  $.each(arrayOfLines, function(index, item) {
    if($.trim(item) != ""){
      item = item.split(":");
      if(item[0] == field.field_value) var selected = "selected";
      else var selected = "";

      if(item.length > 1)
        options += '<option '+selected+' value="'+item[0]+'">'+item[1]+'</option>';
      else
        options += '<option '+selected+' value="'+item[0]+'">'+item[0]+'</option>';
    }
  });

  newHTML += '<div class="card bd-0">'+
    '<div class="card-header tx-medium bd-0 tx-white bg-indigo">'+
      field.field_name +
    '</div><!-- card-header -->' +
    '<div class="card-body bd bd-t-0">'+
      '<select readonly class="form-control">'+
        options +
      '</select>'+
    '</div><!-- card-body -->' +
    '<div class="card-footer bd-t">'+
        '<div class="btn-group" role="group">'+
          '<textarea class="field-json" name="field[]" id="'+field.field_id+'" style="display:none;" required>'+JSON.stringify(field)+'</textarea>'+
          '<button class="btn btn-indigo btn-edit-select-box pd-x-25" type="button"><i class="fa fa-edit"></i></button>'+
          '<button class="btn btn-danger btn-delete-select-box pd-x-25" type="button"><i class="fa fa-trash"></i></button>'+
        '</div>'+
      '</div><!-- card-footer -->'+
    '</div><!-- card -->';

  if($this != "") newHTML += '';
  else newHTML += '</div><!-- input-group --></div>';


  if($this != ""){
    $($this).parents('.field').first().html(newHTML); //Replace/Edit
  } else $("#design-div").append(newHTML);

}
