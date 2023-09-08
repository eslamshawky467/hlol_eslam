<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput1">اسم الخصم</label>
                <div class="col-md-9">
                    <input type="text" id="projectinput1" class="form-control" placeholder="اسم الخصم"
                        name="coupon_name" value="{{ old('coupon_name', $coupon->name ?? '') }}">
                    <x-form.validation name='coupon_name' />

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput1">قيمه الخصم</label>
                <div class="col-md-9">
                    <input type="text" id="projectinput1" class="form-control" placeholder="قيمه الخصم"
                        name="coupon_amount" value="{{ old('coupon_amount', $coupon->amount ?? '') }}">
                    <x-form.validation name='coupon_amount' />

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput1">نوع الخصم</label>
                <div class="col-md-9">
                    <select id="issueinput5" name="coupon_type" class="form-control" data-toggle="tooltip"
                        data-trigger="hover" data-placement="top">
                        <option value="number">رقم</option>
                        <option value="percentage">نسبه مؤيه</option>
                    </select>
                    <x-form.validation name='coupon_amount' />

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput1">يبدا من</label>
                <div class="col-md-9">
                    <input type="datetime-local" id="projectinput1" class="form-control" placeholder="يبدا من"
                        name="coupon_start_at" value="{{ old('coupon_start_at', $coupon->start_at ?? '') }}">
                    <x-form.validation name='coupon_start_at' />

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput1">ينتهى فى</label>
                <div class="col-md-9">
                    <input type="datetime-local" id="projectinput1" class="form-control" placeholder="ينتهى فى"
                        name="coupon_end_at" value="{{ old('coupon_end_at', $coupon->end_at ?? '') }}">
                    <x-form.validation name='coupon_end_at' />

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control">الحاله</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <div class="d-inline-block custom-control custom-radio mr-1">
                            <input type="radio" name="coupon_status" class="custom-control-input" value="1"
                                id="yes" @if ($coupon->status == 1) checked @endif>
                            <label class="custom-control-label" for="yes">مفعل</label>
                        </div>
                        <div class="d-inline-block custom-control custom-radio">
                            <input type="radio" name="coupon_status" class="custom-control-input" id="no"
                                value="0" @if ($coupon->status == 0) checked @endif>
                            <label class="custom-control-label" for="no">غير مفعل</label>
                        </div>
                        <x-form.validation name='coupon_status' />

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
