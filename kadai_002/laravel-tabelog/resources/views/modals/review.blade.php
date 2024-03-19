@auth
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="reviewModalLabel">{{$restaurant->name}}のレビュー</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="review" method="POST" action="{{ route('reviews.store') }}">
                @csrf
                <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
                <!-- 星評価 -->
                <div class="mb-3">
                    <label class="form-label">星評価:</label>
                    <div class="star-rating">
                    @component('components.star_rating')
                    @endcomponent
                    </div>
                </div>
                
                <!-- 内容 -->
                <div class="mb-3">
                    <label for="content" class="form-label">レビュー:</label>
                    <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
            <button type="submit" class="btn btn-primary nagoyameshi-button" form="review">投稿する</button>
        </div>
        </div>
    </div>
</div>
@endauth