$(function(){
  'use strict'

  $(".block_title").click(function (){
    $this = ""; //Reset This

    //Clear Modal
    $("#block-title-form input[name=field_id]").val(generateID("block-title-"));
    $("#block-title-form input[name=field_name]").val("");
    $("#block-title-form textarea[name=field_description]").val("");

    $('#modalBlockTitleTitle').text($block_title_title);
    $('#modalBlockTitle').modal('show');
  });

  $("#block-title-form").on('submit', function(e){
    e.preventDefault();

    //Add Text Field
    var field = {
      'field_type': "block-title",
      'field_id': $.trim($("#block-title-form input[name=field_id]").val()),
      'field_name': $.trim($("#block-title-form input[name=field_name]").val()),
      'field_description': $.trim($("#block-title-form textarea[name=field_description]").val())
    };

    if($this == "" && $("#"+field.field_id).length){
      alert($field_id_error);
      $("#block-title-form input[name=field_id]").focus();
    } else {

      //Add UI
      if($this != "") var newHTML = '';
      else var newHTML = '<div class="field col-md-12 mg-b-5">';

      newHTML += '<div class="card bd-0">'+
        '<div class="card-header tx-medium bd-0 tx-white bg-indigo">'+
          $block_title_title + ': '+ field.field_name+
        '</div><!-- card-header -->';

      if(field.field_description != "")
      newHTML += '<div class="card-body bd bd-t-0">'+
          '<p class="mg-b-0">'+field.field_description+'</p>'+
        '</div><!-- card-body -->';

      newHTML += '<div class="card-footer bd-t">'+
          '<div class="btn-group" role="group">'+
            '<textarea class="field-json" name="field[]" id="'+field.field_id+'" style="display:none;" required>'+JSON.stringify(field)+'</textarea>'+
            '<button class="btn btn-indigo btn-edit-block-title pd-x-25" type="button"><i class="fa fa-edit"></i></button>'+
            '<button class="btn btn-danger btn-delete-block-title pd-x-25" type="button"><i class="fa fa-trash"></i></button>'+
          '</div>'+
        '</div><!-- card-footer -->'+
      '</div><!-- card -->';

      if($this != "") newHTML += '';
      else newHTML += '</div><!-- input-group --></div>';

      if($this != ""){
        $($this).parents('.field').first().html(newHTML); //Replace/Edit
      } else $("#design-div").append(newHTML);

      $('#modalBlockTitle').modal('hide');
    }
  });

  $(document).on("click",".btn-delete-block-title", function(){
    $(this).parents('.field').first().remove();
  });

  $(document).on("click",".btn-edit-block-title", function(){
    var json = $(this).prev('textarea').val();
    json = JSON.parse(json);

    $this = this; //Set This

    $("#block-title-form input[name=field_id]").val(json.field_id);
    $("#block-title-form input[name=field_name]").val(json.field_name);
    $("#block-title-form textarea[name=field_description]").val(json.field_description);

    $('#modalBlockTitleTitle').text($block_title_title);
    $('#modalBlockTitle').modal('show');
  });
});

function addBlockTitle(field){
  //Add UI
  if($this != "") var newHTML = '';
  else var newHTML = '<div class="field col-md-12 mg-b-5">';

  newHTML += '<div class="card bd-0">'+
    '<div class="card-header tx-medium bd-0 tx-white bg-indigo">'+
      $block_title_title + ': '+ field.field_name+
    '</div><!-- card-header -->';

  if(field.field_description != "" && field.field_description != null)
  newHTML += '<div class="card-body bd bd-t-0">'+
      '<p class="mg-b-0">'+field.field_description+'</p>'+
    '</div><!-- card-body -->';

  newHTML += '<div class="card-footer bd-t">'+
      '<div class="btn-group" role="group">'+
        '<textarea class="field-json" name="field[]" id="'+field.field_id+'" style="display:none;" required>'+JSON.stringify(field)+'</textarea>'+
        '<button class="btn btn-indigo btn-edit-block-title pd-x-25" type="button"><i class="fa fa-edit"></i></button>'+
        '<button class="btn btn-danger btn-delete-block-title pd-x-25" type="button"><i class="fa fa-trash"></i></button>'+
      '</div>'+
    '</div><!-- card-footer -->'+
  '</div><!-- card -->';

  if($this != "") newHTML += '';
  else newHTML += '</div><!-- input-group --></div>';

  if($this != ""){
    $($this).parents('.field').first().html(newHTML); //Replace/Edit
  } else $("#design-div").append(newHTML);
}
