<!-- ボタン・リンククリック後に表示される画面の内容 -->
<div class="modal fade" id="serchModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">検索</h4></h4>
            </div>
            <form method="post" action="/admin/serch">
                @csrf
                <div class="row mb-3 mt-3">
                    <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('曜日') }}</label>

                    <div class="col-md-6">
                        <select id="week-select" class="form-control" name='week'>
                            <option value="">選択してください</option>
                            <option value="1">月曜日</option>
                            <option value="2">火曜日</option>
                            <option value="3">水曜日</option>
                            <option value="4">木曜日</option>
                            <option value="5">金曜日</option>
                            <option value="6">土曜日</option>
                            <option value="7">日曜日</option>
                        </select>
                        @error('week')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="period" class="col-md-4 col-form-label text-md-end">{{ __('何限目') }}</label>

                    <div class="col-md-6">
                        <select id="period-select" class="form-control" name='period'>
                            <option value="">選択してください</option>
                            <option value="1">１限目</option>
                            <option value="2">２限目</option>
                            <option value="3">３限目</option>
                            <option value="4">４限目</option>
                            <option value="5">５限目</option>
                            <option value="6">６限目</option>
                        </select>
                        @error('period')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="room" class="col-md-4 col-form-label text-md-end">{{ __('教室') }}</label>

                    <div class="col-md-6">
                        <select id="room" class="form-control" name='room'>
                            <option value="">選択してください</option>
                            @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                        @error('room')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="room" class="col-md-4 col-form-label text-md-end">{{ __('講師') }}</label>
                    <div class="col-md-6">
                        <select id="user_id" class="form-control" name='user_id'>
                            <option value="">選択してください</option>
                            @foreach ($userData as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('room')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('並び替え') }}
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
