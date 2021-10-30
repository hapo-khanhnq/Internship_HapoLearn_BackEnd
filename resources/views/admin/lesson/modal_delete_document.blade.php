<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete this document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">
                Are you sure you want to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <form action="#" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="user_id" id="userID" value="0">
                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
