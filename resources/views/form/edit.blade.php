<div class="container">
  <div class="az-content-body">
    <div class="az-dashboard-one-title">
      <div>
        <h2 class="az-dashboard-title">Edit Form</h2>
        <p class="az-dashboard-text">
          Forms
        </p>
      </div>
    </div><!-- az-dashboard-one-title -->

    <form method="post" action="{{ route('form.update', $form->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
      <div class="row row-sm mg-b-20">
        <div class="col-lg-3">
          <div class="card card-dashboard-pageviews">
            <div class="card-header">
              <h6 class="card-title">
                Toolbox
              </h6>
            </div><!-- card-header -->
            <div class="card-body">
              <div class="form-group">
                <button type="button" class="mg-4 block_title btn btn-rounded btn-outline-indigo">
                  Block Title
                </button>
                <button type="button" class="mg-4 file_upload btn btn-rounded btn-outline-indigo">
                  File Upload
                </button>
                <button type="button" class="mg-4 text_box btn btn-rounded btn-outline-indigo">
                  Text Box
                </button>
                <button type="button" class="mg-4 text_area btn btn-rounded btn-outline-indigo">
                  Text Area
                </button>
                <button type="button" class="select_box mg-4 btn btn-rounded btn-outline-indigo">
                  Select Box
                </button>
                <button type="button" class="radio_group mg-4 btn btn-rounded btn-outline-indigo">
                  Radio Group
                </button>
                <button type="button" class="list_options mg-4 btn btn-rounded btn-outline-indigo">
                  Check Box
                </button>
              </div><!-- form-group -->
            </div><!-- card-body -->
          </div><!-- card -->

        </div><!-- col -->
        <div class="col-lg-9 mg-t-20 mg-lg-t-0">
          <div class="card">
            <div class="card-header tx-medium bd-0 tx-white bg-indigo">
              Form Design
            </div><!-- card-header -->
            <div class="card-body">
              <div class="form-group">
                <label class="az-content-label tx-11 tx-medium tx-gray-600">
                  Label
                </label>
                <input type="text" name="label"
                value = "<?=isset($_POST['label']) ? $_POST['label'] : $form->label?>"
                class="form-control" required />
                @error('label')
                    <span style="color:red;">{{ $message }}</span>
                @enderror
              </div><!-- form-group -->
              <div class="row">
                <div class="col-md form-group">
                    <label class="az-content-label tx-11 tx-medium tx-gray-600">
                    Action
                    </label>
                    <input type="text" name="action"
                    value = "<?=isset($_POST['action']) ? $_POST['action'] : $form->action?>"
                    class="form-control" required />
                    @error('action')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div><!-- form-group -->

                <div class="col-md form-group">
                    <label class="az-content-label tx-11 tx-medium tx-gray-600">
                    Method
                    </label>
                    <select name="method" class="select2-no-search form-control">
                        <?php 
                            function get_selected($value, $select){
                                if($value == $select) echo "selected";
                            }
                        ?>
                        <option <?=get_selected(isset($_POST['method']) ? $_POST['method'] : $form->method, "get")?> value="get">GET</option>
                        <option <?=get_selected(isset($_POST['method']) ? $_POST['method'] : $form->method, "post")?> value="post">POST</option>
                    <select><!-- form-group -->
                    @error('method')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                    
                </div><!-- form-group -->   
              </div>

              <center>
                <img style="display:none;height:96px;" id="template-loading-image"
                src="{{ URL::asset('assets/img/loading.gif') }}" />
              </center>

              <div id="design-div" class="row">
              </div>
              <span style="color:red;">{{ $field_error ?? '' }}</span>
              <br>
              <div class="form-group ">
                <button class="btn btn-az-primary btn-block">
                  Update Form
                </button>
              </div><!-- form-group -->
            </div><!-- card-body -->
          </div><!-- card-dashboard-four -->
        </div><!-- col -->
      </div><!-- row -->
    </form>
  </div><!-- az-content-body -->
</div>

<!-- BLOCK TITLE -->
<div id="modalBlockTitle" class="modal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-content-demo">
      <div class="modal-header">
        <h6 id="modalBlockTitleTitle" class="modal-title"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="block-title-form">
          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field ID
          </label>
          <input type="text" name="field_id"
          class="form-control" required /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Name
          </label>
          <input type="text" name="field_name"
          class="form-control" required /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Description
          </label>
          <textarea class="form-control"
          name="field_description"></textarea>
          <!-- form-group -->

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn-submit btn btn-indigo">
            Submit
          </button>
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- FILE UPLOAD -->
<div id="modalFileUpload" class="modal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-content-demo">
      <div class="modal-header">
        <h6 id="modalFileUploadTitle" class="modal-title"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="file-upload-form">
          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field ID
          </label>
          <input type="text" name="field_id"
          class="form-control" required /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Name
          </label>
          <input type="text" name="field_name"
          class="form-control" required /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Description
          </label>
          <textarea class="form-control"
          name="field_description"></textarea>
          <!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Required
          </label>
          <select name="field_required" class="field_required form-control">
            <option value="yes">Yes</option>
            <option value="no">No</option>
          <select><!-- form-group -->
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn-submit btn btn-indigo">
            Submit
          </button>
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- TEXT BOX  -->
<div id="modalTextBox" class="modal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-content-demo">
      <div class="modal-header">
        <h6 id="modalTextBoxTitle" class="modal-title"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="text-box-form">
          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Type
          </label>
          <select name="field_input_type" class="field_input_type form-control">
            <option value="text">Text</option>
            <option value="phone">Phone Number</option>
            <option value="email">E-mail Address</option>
            <option value="date">Date</option>
          <select><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field ID
          </label>
          <input type="text" name="field_id"
          class="form-control" required /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Name
          </label>
          <input type="text" name="field_name"
          class="form-control" required /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Placeholder
          </label>
          <input type="text" name="Field Placeholder"
          class="form-control" /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Placeholder
          </label>
          <input type="text" name="field_value"
          class="form-control" /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Required
          </label>
          <select name="field_required" class="field_required form-control">
            <option value="yes">Yes</option>
            <option value="no">No</option>
          <select><!-- form-group -->
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-submit btn-indigo">
            Submit
          </button>
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- TEXT AREA -->
<div id="modalTextArea" class="modal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-content-demo">
      <div class="modal-header">
        <h6 id="modalTextAreaTitle" class="modal-title"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="text-area-form">
          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field ID
          </label>
          <input type="text" name="field_id"
          
          class="form-control" required /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Name
          </label>
          <input type="text" name="field_name"
          class="form-control" required /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Placeholder
          </label>
          <input type="text" name="Field Placeholder"
          class="form-control" /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Placeholder
          </label>
          <input type="text" name="field_value"
          class="form-control" /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Required
          </label>
          <select name="field_required" class="field_required form-control">
            <option value="yes">Yes</option>
            <option value="no">No</option>
          <select><!-- form-group -->
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-submit btn-indigo">
            Submit
          </button>
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- SELECT BOX  -->
<div id="modalSelectBox" class="modal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-content-demo">
      <div class="modal-header">
        <h6 id="modalSelectBoxTitle" class="modal-title"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="select-box-form">
          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field ID
          </label>
          <input type="text" name="field_id"
          
          class="form-control" required /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Name
          </label>
          <input type="text" name="field_name"
          
          class="form-control" required /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Placeholder
          </label>
          <input type="text" name="Field Placeholder"
          class="form-control" /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Placeholder
          </label>
          <input type="text" name="field_value"
          class="form-control" /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Source
          </label>
          <textarea class="form-control mg-t-5 field_source"
          placeholder="Enter each option on new line. You can add id and name seprated by colon (eg ID:Name)"
          name="field_source"></textarea><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Required
          </label>
          <select name="field_required" class="field_required form-control">
            <option value="yes">Yes</option>
            <option value="no">No</option>
          <select><!-- form-group -->

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-indigo btn-submit">
            Submit
          </button>
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- RADIO GROUP  -->
<div id="modalRadioGroup" class="modal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-content-demo">
      <div class="modal-header">
        <h6 id="modalRadioGroupTitle" class="modal-title"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="radio-group-form">
          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field ID
          </label>
          <input type="text" name="field_id"
          
          class="form-control" required /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Name
          </label>
          <input type="text" name="field_name"
          
          class="form-control" required /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Placeholder
          </label>
          <input type="text" name="Field Placeholder"
          class="form-control" /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Placeholder
          </label>
          <input type="text" name="field_value"
          class="form-control" /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Source
          </label>
          <textarea class="form-control mg-t-5 field_source"
          placeholder="Enter each option on new line. You can add id and name seprated by colon (eg ID:Name)"
          name="field_source"></textarea><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Required
          </label>
          <select name="field_required" class="field_required form-control">
            <option value="yes">Yes</option>
            <option value="no">No</option>
          <select><!-- form-group -->

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-indigo btn-submit">
            Submit
          </button>
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- LIST OPTIONS  -->
<div id="modalListOptions" class="modal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-content-demo">
      <div class="modal-header">
        <h6 id="modalListOptionsTitle" class="modal-title"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="list-options-form">
          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field ID
          </label>
          <input type="text" name="field_id"
          
          class="form-control" required /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Name
          </label>
          <input type="text" name="field_name"
          
          class="form-control" required /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Placeholder
          </label>
          <input type="text" name="Field Placeholder"
          class="form-control" /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Placeholder
          </label>
          <input type="text" name="field_value"
          class="form-control" /><!-- form-group -->

          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Source
          </label>
          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Source
          </label>
          <textarea class="form-control mg-t-5 field_source"
          placeholder="Enter each option on new line. You can add id and name seprated by colon (eg ID:Name)"
          name="field_source"></textarea><!-- form-group -->
          <label class="az-content-label tx-11 tx-medium tx-gray-600">
            Field Required
          </label>
          <select name="field_required" class="field_required form-control">
            <option value="yes">Yes</option>
            <option value="no">No</option>
          <select><!-- form-group -->

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-indigo btn-submit">
            Submit
          </button>
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->


<script>
  var $this = "";
   var $this = "";
  var $field_id_error = "Field ID already exists!";
  var $file_upload_title = "File Upload";
  var $block_title_title = "Block Title";
  var $text_box_title = "Single Line Text Field";
  var $text_area_title = "Multiline Text Field";
  var $select_box_title = "Select Box";
  var $radio_group_title = "Radio Group";
  var $list_options_title = "Check Box";
  
  var $select = "Select";
  var $temp_form_metadata = <?=isset($_POST['field']) ? json_encode($_POST['field']):"''"?>;
  
  var $form_metadata = <?=json_encode($form_meta)?>;

  var COL_WIDTH = 62 // should be calculated dynamically, and recalculated at window resize
  var GUTTER_WIDTH = 30

  var COL_WIDTHS = {
    750: 62,
    970: 81,
    1170: 97
  }

  $(function() {
    'use strict'

    var d = dragula({
      invalid: function(el, target) {
        return $(el).hasClass('ui-resizable-handle')
      }
    })
    $('#design-div').each(function() {
      d.containers.push(this)
    })

    $('.field').resizable({
      grid: COL_WIDTH - GUTTER_WIDTH,
      handles: 'se',
      resize: function(e, ui) {
        console.log('resized', ui.size)
        $(this).css('width', '').removeClass(function(index, css) {
          return (css.match (/(^|\s)col-sm-\S+/g) || []).join(' ')
        })
        .addClass('col-sm-' + Math.max(1, Math.round(ui.size.width / COL_WIDTH)))
      }
    })

    var colWidth = COL_WIDTHS[$('.container').width()] || COL_WIDTHS[0]
    $(window).resize(function() {
      colWidth = COL_WIDTHS[$('.container').width()] || COL_WIDTHS[0]
      console.log('set colWidth to', colWidth, $('.container').width())
    })
  });
</script>

<script src="{{ URL::asset('assets/custom/form-element/file-upload.js') }}"></script>
<script src="{{ URL::asset('assets/custom/form-element/block-title.js') }}"></script>
<script src="{{ URL::asset('assets/custom/form-element/text-box.js') }}"></script>
<script src="{{ URL::asset('assets/custom/form-element/text-area.js') }}"></script>
<script src="{{ URL::asset('assets/custom/form-element/select-box.js') }}"></script>
<script src="{{ URL::asset('assets/custom/form-element/radio-group.js') }}"></script>
<script src="{{ URL::asset('assets/custom/form-element/list-options.js') }}"></script>
<script src="{{ URL::asset('assets/custom/form-element/form-builder.js') }}"></script>
