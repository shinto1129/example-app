<!-- ボタン・リンククリック後に表示される画面の内容 -->
<div class="modal fade" id="testModalx{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">編集画面</h4></h4>
            </div>
            <form method="post" action="/admin/roomEdit">
                @csrf
                <input type="hidden" value="{{ $d->user_id }}" name="user_id">
                <input type="hidden" value="{{ $d->id }}" name="register_id">

                <div class="row mb-3 mt-3">
                    <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('曜日') }}</label>

                    <div class="col-md-6">
                        <select id="week-select" class="form-control" name='week'>
                            <option value="1" @if($d->week == 1) selected @endif>月曜日</option>
                            <option value="2" @if($d->week == 2) selected @endif>火曜日</option>
                            <option value="3" @if($d->week == 3) selected @endif>水曜日</option>
                            <option value="4" @if($d->week == 4) selected @endif>木曜日</option>
                            <option value="5" @if($d->week == 5) selected @endif>金曜日</option>
                            <option value="6" @if($d->week == 6) selected @endif>土曜日</option>
                            <option value="7" @if($d->week == 7) selected @endif>日曜日</option>
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
                            <option value="1" @if($d->period == 1) selected @endif>１限目</option>
                            <option value="2" @if($d->period == 2) selected @endif>２限目</option>
                            <option value="3" @if($d->period == 3) selected @endif>３限目</option>
                            <option value="4" @if($d->period == 4) selected @endif>４限目</option>
                            <option value="5" @if($d->period == 5) selected @endif>５限目</option>
                            <option value="6" @if($d->period == 6) selected @endif>６限目</option>
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
                            @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" @if($d->room == $room->id) selected @endif>{{ $room->name }}</option>
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
                    <label for="item" class="col-md-4 col-form-label text-md-end">{{ __('必要なもの') }}</label>

                    <div class="col-md-6">
                        @foreach ($itemData as $item)
                        <div>
                            <label for="checkbox{{ $item->id }}">{{ $item->name }}</label>
                            <input type="checkbox" id="checkbox{{ $item->id }}" name="item{{ $item->id }}" value="{{ $item->id }}"
                            @foreach ($items as $i)
                                @if ($i->register_id == $d->id)
                                    @if ($item->id == $i->item_id)
                                        checked
                                        @break
                                    @endif
                                @endif
                            @endforeach>
                        </div>
                        @endforeach
                        @error('item')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" id="adminedit">
                            {{ __('編集') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
