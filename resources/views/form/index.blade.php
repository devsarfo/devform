<div class="container">
  <div class="az-content-left az-content-left-contacts">

    <div class="az-content-breadcrumb lh-1 mg-b-2">
      <span>Forms</span>
      <span>All Forms</span>
    </div>
    <h2 class="az-content-title tx-24 mg-b-30">
      Forms
    </h2>

    <nav class="nav az-nav-line az-nav-line-chat">
        <a href="{{ url('/form/add') }}" class="nav-link active">
            Create New Form
        </a>
    </nav>
    
    <div id="azContactList" class="az-contacts-list">
        @foreach ($forms as $form)
            <div class="az-contact-item" data-info='<?=json_encode((array) $form->attributesToArray())?>'>
              <div class="az-img-user online"><img src="https://via.placeholder.com/500x500" alt=""></div>
              <div class="az-contact-body">
                <h6>{{ $form->label }}</h6>
                <span>Action: <b>{{ strtoupper($form->method) }}</b></span>
              </div><!-- az-contact-body -->
            </div><!-- az-contact-item -->
        @endforeach
    </div><!-- az-contacts-list -->
  </div><!-- az-content-left -->

  <!-- az-content-info -->
  <div style="display:none;" class="az-content-body az-content-body-contacts info-div">
    <div class="az-contact-info-header">
      <div class="media">
        <div class="media-body">
          <h4 class="name-div"></h4>
          <p class="type-code-div"></p>
          <a target="_blank" class="view-link-div" href=""><i class="typcn typcn-eye"></i>
            View Form
          </a>
        </div><!-- media-body -->
      </div><!-- media -->
      <div class="az-contact-action">
        <a class="edit-link-div" href=""><i class="typcn typcn-edit"></i>
            Edit Form
        </a>
        <a class="delete-link-div btn-del" href=""><i class="typcn typcn-trash"></i>
            Delete Form
        </a>
      </div><!-- az-contact-action -->

    </div><!-- az-contact-info-header -->
    <div class="az-contact-info-body">
      <div class="media-list">
        <div class="media">
          <div class="media-icon"><i class="fas fa-info-circle"></i></div>
          <div class="media-body">
            <div>
              <label>Label</label>
              <span class="tx-medium label-div"></span>
            </div>
            <div>
              <label>Action</label>
              <span class="tx-medium action-div"></span>
            </div>
            <div>
              <label>Method</label>
              <span class="tx-medium method-div"></span>
            </div>
          </div><!-- media-body -->
        </div><!-- media -->
        <div class="media">
          <div class="media-icon"><i class="far fa-clock"></i></div>
          <div class="media-body">
            <div>
              <label>Date Created</label>
              <span class="tx-medium create_date-div"></span>
            </div>
            <div>
              <label>Date Modified</label>
              <span class="tx-medium modify_date-div"></span>
            </div>
          </div><!-- media-body -->
        </div><!-- media -->
      </div><!-- media-list -->
      <center>
        <img style="display:none;height:96px;" id="template-loading-image"
        src="{{ URL::asset('assets/img/loading.gif') }}" />
      </center>
      <div class="card">
        <div class="card-header">
          <b>Form Design</b>
        </div><!-- card-header -->
        <div class="card-body">
          <div class="design-div"></div>
        </div><!-- card-body -->
      </div><!-- card --><br>
    </div><!-- az-contact-info-body -->
  </div><!-- az-content-body -->

  <!-- az-content-no-info -->
  <div class="az-content-body az-content-body-contacts no-info-div">
    <div class="az-contact-info-body">
      <div class="az-error-wrapper">
        <br><br><br>
        <h1><i class="far fa-edit"></i></h1>
        <h2>Select a form to view design</h2>
      </div>
    </div><!-- az-contact-info-body -->
  </div><!-- az-content-body -->
</div>
<script>
  function view_data($data){
      console.log($data);
      
    try {
      var $data = JSON.parse($data);
    } catch(err) {
      //Ignore
    }

    //Prepare View
    $(".name-div").html($data.label);
    $(".view-link-div").attr("href", "{{ url('/form/view') }}/"+$data.id);
    $(".edit-link-div").attr("href", "{{ url('/form/edit') }}/"+$data.id);
    $(".delete-link-div").attr("href", "{{ url('/form/delete') }}/"+$data.id);
    $(".label-div").html($data.label);
    $(".action-div").html($data.action);
    $(".method-div").html($data.method);
    $(".create_date-div").html($data.created_at);
    $(".modify_date-div").html($data.modified_at);

    $(".no-info-div").hide();
    $(".info-div").show();

    //Load Form
    $(".template-loading-image").show();
    $(".design-div").html("");
    $.ajax({
      url : "{{ url('/form/html/') }}/"+$data.id,
      type : "get",
      async: false,
      success : function(html) {
        $(".template-loading-image").hide();
        $(".design-div").html(html);
      },
      error: function() {
        $(".template-loading-image").hide();
        $(".design-div").html("");
      }
    });
  }
  
    $(function(){
    'use strict'

        new PerfectScrollbar('#azContactList', {
          suppressScrollX: true
        });

        new PerfectScrollbar('.az-contact-info-body', {
          suppressScrollX: true
        });

        $('.az-contact-item').on('click touch', function() {
          $(this).addClass('selected');
          $(this).siblings().removeClass('selected');

          //Prepare View
          view_data($(this).data("info"));

          $('body').addClass('az-content-body-show');
        });
    });
    </script>
