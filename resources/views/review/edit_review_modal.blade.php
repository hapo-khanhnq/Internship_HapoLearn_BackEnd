<!-- Modal -->
<div class="modal fade" id="editReviewModal{{ $review->id }}" tabindex="-1" role="dialog" aria-labelledby="editReviewModal{{ $review->id }}Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered edit-review-modal" role="document">
        <div class="modal-content p-3">
            <div class="modal-header p-0">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit your review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('review.update') }}" method="POST" id="{{ $review->id }}FormEditReview" class="form-edit-review">
                    <div class="add-review-message mt-3">Message</div>
                    @csrf
                    <input type="hidden" name="id" value="{{ $review->id }}">
                    <input type="hidden" name="rating_value" class="rating_value" id="{{ $review->id }}-edit-star" value="{{ isset($review->rate) ? $review->rate : 0 }}">
                    <textarea name="edit_review_message" id="{{ $review->id }}reviewMessage" cols="30" rows="5" class="review-message form-control mt-2">{{ $review->content }}</textarea>
                    <div class="vote-star-review d-flex align-items-center mt-3">
                        <div class="vote">Vote</div>
                        <div class="rating ml-3">
                            <input class="rate" type="radio" name="rate" id="{{ $review->id }}-edit-star-5" value="{{ config('variables.rate.fiv_star') }}">
                            <label for="{{ $review->id }}-edit-star-5" class="mb-0 mt-1">5 stars</label>
                            <input class="rate" type="radio" name="rate" id="{{ $review->id }}-edit-star-4" value="{{ config('variables.rate.four_star') }}">
                            <label for="{{ $review->id }}-edit-star-4" class="mb-0 mt-1">4 stars</label>
                            <input class="rate" type="radio" name="rate" id="{{ $review->id }}-edit-star-3" value="{{ config('variables.rate.three_star') }}">
                            <label for="{{ $review->id }}-edit-star-3" class="mb-0 mt-1">3 stars</label>
                            <input class="rate" type="radio" name="rate" id="{{ $review->id }}-edit-star-2" value="{{ config('variables.rate.two_star') }}">
                            <label for="{{ $review->id }}-edit-star-2" class="mb-0 mt-1">2 stars</label>
                            <input class="rate" type="radio" name="rate" id="{{ $review->id }}-edit-star-1" value="{{ config('variables.rate.one_star') }}">
                            <label for="{{ $review->id }}-edit-star-1" class="mb-0 mt-1">1 stars</label>
                        </div>
                        <div class="stars-text ml-3">(stars)</div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="delete-review-button" data-dismiss="modal">Close</button>
                        <button type="submit" class="ml-2 edit-review-button">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
