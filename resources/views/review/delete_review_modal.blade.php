<!-- Modal -->
<div class="modal fade" id="deleleReviewModal{{ $review->id }}" tabindex="-1" role="dialog" aria-labelledby="deleleReviewModal{{ $review->id }}Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered edit-review-modal" role="document">
        <div class="modal-content p-3">
            <div class="modal-header p-0">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete your review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-5">
                Are you sure you want to delete this review?
            </div>
            <div class="modal-footer">
                <button type="button" class="delete-review-button" data-dismiss="modal">No</button>
                <form action="{{ route('review.destroy') }}" method="POST">

                    @csrf
                    @method('delete')
                    <input type="hidden" name="id" value="{{ $review->id }}">
                    <button type="submit" class="ml-2 edit-review-button">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
