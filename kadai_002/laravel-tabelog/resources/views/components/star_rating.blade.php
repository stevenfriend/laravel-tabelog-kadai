@error('rating')
    <strong>星評価を入力してください</strong>
@enderror

<div class="star-rating">
    @for ($i = 1; $i <= 5; $i++)
       <i class="far fa-star" data-index="{{ $i }}"></i>
    @endfor

    <!-- Hidden input for the rating value -->
    <input type="hidden" name="rating" id="ratingInput" value="">
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const stars = document.querySelectorAll('.star-rating .fa-star');
  let selectedRating = 0; // Tracks the selected rating

  stars.forEach((star, index) => {
    star.addEventListener('mousemove', (e) => hoverStars(e, index));
    star.addEventListener('mouseleave', () => clearHover());
    star.addEventListener('click', (e) => selectRating(e, index));
  });

  function hoverStars(e, index) {
    clearHover();
    let isHalf = e.offsetX < e.target.offsetWidth / 2;
    stars.forEach((star, idx) => {
      if (idx < index || (isHalf && idx === index)) {
        star.classList.add('hovered');
      } else if (!isHalf && idx === index) {
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

    // Update the hidden input's value
    document.getElementById('ratingInput').value = selectedRating;
  }

  function updateStars() {
    stars.forEach((star, idx) => {
      star.classList.remove('fas', 'fa-star-half-alt');
      star.classList.add('far');
      if (idx + 1 <= selectedRating) {
        star.classList.add('fas');
      } else if (idx + 0.5 === selectedRating) {
        star.classList.add('fas', 'fa-star-half-alt');
      }
    });
  }
});
</script>