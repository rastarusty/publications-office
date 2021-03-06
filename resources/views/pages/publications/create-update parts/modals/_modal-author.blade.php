<div class="modal fade" id="modal-newAuthor" tabindex="-1" 
    role="dialog" aria-labelledby="New Author">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <!-- HEADER -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="text-align: center;">
          ADD NEW AUTHOR TO THE DATABASE
        </h4>
      </div>

      <!-- BODY -->
      <div class="modal-body">
       <form id="form-newAuthor" data-parsley-validate method="POST" 
       action="{{ route('authors.store') }}">
        
        {{ csrf_field() }}

        <p id="id" hidden></p>
        
        <!-- FORM -->
        <div class="form-group">
          @include('pages/authors/create-update parts/_form')
        </div>

        <!-- ADDITIONAL FORM -->
        <div class="form-group" id="div-authorData"></div>
        </form>
      </div>

      <!-- FOOTER -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" value="Add Author" form="form-newAuthor" 
        class="btn btn-success">
        <input type="hidden" value="{{ Session::token() }}" form="form-newAuthor" 
        name="_token">
      </div>

    </div>
  </div>
</div>