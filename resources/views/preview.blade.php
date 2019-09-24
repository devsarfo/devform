<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    @include('components.header')
  </head>
  <body class="az-dashboard">
    <div class="az-content az-content-app az-content-contacts pd-b-0">
    <div class="container">
  <div class="az-content-body">
    <div class="az-dashboard-one-title">
      <div>
        <h2 class="az-dashboard-title">{{ $form->label}}</h2>
      </div>
    </div><!-- az-dashboard-one-title -->

    <form method="{{ $form->method }} " action="{{ $form->action }} " enctype="multipart/form-data">
        @csrf
      <div class="row row-sm mg-b-20">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <b>{{ $form->label}}</b>
            </div><!-- card-header -->
            <div class="card-body">
                @php
                echo $html;
                @endphp
                <br>
            <div class="modal-footer">
                <button type="submit" class="btn-submit btn btn-indigo">
                    Submit
                </button>
                <button type="reset" class="btn btn-outline-light" data-dismiss="modal">
                    Cancel
                </button>
            </div>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->
      </div><!-- row -->
    </form>
  </div><!-- az-content-body -->
</div>

      
    </div><!-- az-content -->

    <div class="az-footer">
      <div class="container">
        <span>&copy; <?=date('Y')?> DevSaaS</span>
        <span>Powered by <a target='_blank' href="http://devsarfo.com/">DevSarfo</a></span>
      </div><!-- container -->
    </div><!-- az-footer -->

    <script>
      $(function(){
        'use strict'
        
        // Set active state on menu element
	      var current_url = window.location.href;
        
        $("ul.nav li a").each(function(index, value) {
          if (current_url == $(this).attr('href')) {
            $(this).parents('li').addClass('active');
          } else if (current_url.startsWith($(this).attr('href'))) {
            $(this).parents('li').addClass('active');
          }
        });
      });
    </script>

    <div id="errorModal" class="modal">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
          <div class="modal-body tx-center pd-y-20 pd-x-20">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
            <h4 class="tx-danger mg-b-20">Oops! An Error Occured</h4>
            <p class="mg-b-20 mg-x-20" id="errorMessage"></p>
            <button type="button" class="btn btn-danger pd-x-25" data-dismiss="modal" aria-label="Close">Continue</button>
          </div><!-- modal-body -->
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <div id="successModal" class="modal">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body tx-center pd-y-20 pd-x-20">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <i class="icon ion-ios-checkmark-circle-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
            <h4 class="tx-success mg-b-20">Success!</h4>
            <p class="mg-b-20 mg-x-20" id="successMessage"></p>
            <button type="button" class="btn btn-success pd-x-25" data-dismiss="modal" aria-label="Close">Ok</button>
          </div><!-- modal-body -->
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <div id="deleteModal" class="modal">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">Confirm Deletion</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h6>Are you sure you want to delete record?</h6>
            <p>This action cannot be undone</p>
          </div>
          <div class="modal-footer">
            <a id="deleteUrl">
              <button type="button" class="btn btn-danger">
                Delete
              </button>
            </a>
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">
              Cancel
            </button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
    <script>
      var success = "{{ Session::get('success') }}";
      var error = "{{ Session::get('error') }}";

      if(success != "") successAlert(success);
      if(error != "") errorAlert(error);

      function successAlert(msg){
        $('#successMessage').text(msg);
        $('#successModal').addClass("effect-flip-vertical");
        $('#successModal').modal('show');
      }

      function errorAlert(msg){
        $('#errorMessage').text(msg);
        $('#errorModal').addClass("effect-flip-vertical");
        $('#errorModal').modal('show');
      }

      // DELETE MSG
      $(".btn-del").click(function(e) {
        //URI
        var uri = this.href;
        $('#deleteUrl').attr("href", uri);
        $('#deleteModal').addClass("effect-just-me");
        $('#deleteModal').modal('show');
        e.preventDefault();
      });
    </script>
  </body>
</html>
