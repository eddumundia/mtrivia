<!-- Modal -->
<div class="modal fade" id="changeSubject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title teachernamemodal" id="myModalLabel"></h4>
      </div>
        <form method="POST" action="{{ url('/users/changeclass') }}">
            <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <label for="question">Change current class</label>
                      <select id="changeclass" name="section_id" required="" class="form-control">
                          <option value="">--Please select--</option>
                          <option value=4>Four</option>
                          <option value=5>Five</option>
                          <option value=6>Six</option>
                          <option value=7>Seven</option>
                          <option value=8>Eight</option>
                      </select>
                      </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Change</button>
            </div>
        </form>
    </div>
  </div>
</div>
