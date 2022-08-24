<!-- ボタン・リンククリック後に表示される画面の内容 -->
<div class="modal fade" id="sortModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">並び替え</h4></h4>
            </div>
            <form method="post" action="/admin/sort">
                @csrf
                <div class="row mb-3 mt-3">
                    <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('並び替え項目') }}</label>

                    <div class="col-md-6">
                        <select id="selected-select" class="form-control" name='selected'>
                            <option value="">選択してください</option>
                            <option value="week">曜日</option>
                            <option value="period">時限</option>
                            <option value="room">教室</option>
                            <option value="created_at">登録順</option>
                            <option value="user_id">講師</option>
                        </select>
                        @error('selected')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('並び替え順') }}</label>

                    <div class="col-md-6">
                        <select id="order-select" class="form-control" name='order'>
                            <option value="asc">昇順</option>
                            <option value="desc">降順</option>
                        </select>
                        @error('order')
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
