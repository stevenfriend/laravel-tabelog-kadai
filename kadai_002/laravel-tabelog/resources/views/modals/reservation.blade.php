@auth
<div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="reservationModalLabel">{{$restaurant->name}}の予約</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="reservation" method="POST" action="{{ route('reservations.store') }}">
                @csrf
                <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
                <!-- 日付ピッカー -->
                <div class="mb-3">
                    <label for="reservation_date" class="form-label">日付</label>
                    <input type="date" class="form-control" id="reservationDate" name="reservation_date" required>
                </div>
                
                <!-- 時間選択 -->
                <div class="mb-3">
                    <label for="reservation_time" class="form-label">時間</label>
                    <select class="form-select" id="reservationTime" name="reservation_time" required>
                    <option selected>選択...</option>
                    @php
                        $start = strtotime($restaurant->opening_time);
                        $end = strtotime($restaurant->closing_time) - 3600;
                    @endphp
                    @for ($time = $start; $time <= $end; $time += 3600)
                        echo <option value="{{date('H:i', $time)}}">{{date('H:i', $time)}}</option>
                    @endfor
                    </select>
                </div>

                <!-- 人数選択 -->
                <div class="mb-3">
                    <label for="number_of_people" class="form-label">人数</label>
                    <input type="number" class="form-control" id="number_of_people" name="number_of_people" required min="1" max="{{$restaurant->seating_capacity}}" value="1">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
            <button type="submit" class="btn btn-primary nagoyameshi-button" form="reservation">予約する</button>
        </div>
        </div>
    </div>
    </div>
</div>
@endauth