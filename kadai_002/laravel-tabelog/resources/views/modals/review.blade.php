@auth
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-white">
        <div class="modal-header">
            <h5 class="modal-title" id="reviewModalLabel">{{$restaurant->name}}のレビュー</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="review" method="POST" action="{{ route('reviews.store') }}">
                @csrf
                <input type="hidden" name="method" id="form-method" value="POST">
                <input type="hidden" name="review_id" id="review-id" value="">
                <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
                
                <!-- 評価 -->
                <div class="form-group mb-3">
                    <label class="form-label">評価</label>
                    <div class="star-rating">
                        @for ($i = 1; $i <= 5; $i++)
                        <i class="far fa-star" data-index="{{ $i }}"></i>
                        @endfor
                        <input type="hidden" name="rating" id="ratingInput" value="">
                    </div>
                    @error('rating', 'review')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- タイトル -->
                <div class="mb-3">
                    <label for="title" class="form-label">タイトル</label>
                    <input class="form-control nagoyameshi-input" id="title" name="title" type="text" value="{{ old('title') }}" required>
                    @error('title', 'review')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                 </div>
                
                <!-- 内容 -->
                <div class="mb-3">
                    <label for="content" class="form-label">レビュー</label>
                    <textarea class="form-control nagoyameshi-input" id="content" name="content" rows="3" required>{{ old('content') }}</textarea>
                    @error('content', 'review')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
            <button type="submit" class="btn btn-primary nagoyameshi-button" id="review-form-btn" form="review">投稿する</button>
        </div>
        </div>
    </div>
</div>
@endauth

<script>
document.addEventListener('DOMContentLoaded', function () {
  const stars = document.querySelectorAll('.star-rating .fa-star');
  let selectedRating = document.getElementById('ratingInput');
  let ratingInput = document.getElementById('ratingInput');

  stars.forEach((star, index) => {
    star.addEventListener('mousemove', (e) => hoverStars(e, index));
    star.addEventListener('mouseleave', () => clearHover());
    star.addEventListener('click', (e) => selectRating(e, index));
  });

  function hoverStars(e, index) {
    clearHover();
    let isHalf = e.offsetX < e.target.offsetWidth / 2;
    stars.forEach((star, i) => {
      if (i < index || (isHalf && i === index)) {
        star.classList.add('hovered');
      } else if (!isHalf && i === index) {
        star.classList.add('hovered');
      }
    });
  }

  function clearHover() {
    stars.forEach(star => star.classList.remove('hovered'));
  }

  function selectRating(e, index) {
    let isHalf = e.offsetX < e.target.offsetWidth / 2;
    selectedRating = isHalf ? index + 0.5 : index + 1;
    updateStars();
    document.getElementById('ratingInput').value = selectedRating;
  }

  function updateStars() {
    stars.forEach((star, i) => {
      star.classList.remove('fas', 'fa-star-half-alt');
      star.classList.add('far');
      if (i + 1 <= selectedRating) {
        star.classList.add('fas');
      } else if (i + 0.5 === selectedRating) {
        star.classList.add('fas', 'fa-star-half-alt');
      }
    });
  }
});
</script>