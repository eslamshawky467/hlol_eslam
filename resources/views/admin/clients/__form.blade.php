<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput1">اسم العميل </label>
                <div class="col-md-9">
                    <input type="text" id="projectinput1" class="form-control" placeholder="اسم العميل"
                        name="client_name" value="{{ old('client_name', $client->name ?? '') }}">
                    <x-form.validation name='client_name' />

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput2"> توكن الجهاز</label>
                <div class="col-md-9">
                    <input type="text" id="projectinput2" class="form-control" placeholder="توكن الجهاز"
                        name="device_token" value="{{ old('device_token', $client->device_token ?? '') }}">
                    <x-form.validation name='device_token' />

                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput2">البريد الالكترونى</label>
                <div class="col-md-9">
                    <input type="email" id="projectinput2" class="form-control" placeholder="البريد الالكترونى"
                        name="email" value="{{ old('email', $client->email ?? '') }}">
                    <x-form.validation name='email' />

                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput2">رقم الهاتف</label>
                <div class="col-md-9">
                    <input type="numper" id="projectinput2" class="form-control" placeholder="رقم الهاتف"
                        name="client_phone_number"
                        value="{{ old('client_phone_number', $client->phone_number ?? '') }}">
                    <x-form.validation name='client_phone_number' />

                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="issueinput5">الجنس</label>
                <div class="col-md-9">
                    <select id="issueinput5" name="gender" class="form-control" data-toggle="tooltip"
                        data-trigger="hover" data-placement="top">
                        <option value="male" selected>ذكر</option>
                        <option value="female">انثى</option>
                    </select>
                    <x-form.validation name='gender' />

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control">رفع ملف</label>
                <div class="col-md-9">
                    <label id="projectinput8" class="file center-block">
                        <input type="file" id="file" name="client_image">
                        <span class="file-custom"></span>
                    </label>
                    <x-form.validation name='client_image' />

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control">مسجل</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <div class="d-inline-block custom-control custom-radio mr-1">
                            <input type="radio" name="is_registered" class="custom-control-input" value="1"
                                id="yes-reg" @if ($client->is_registered == 1) checked @endif>
                            <label class="custom-control-label" for="yes-reg">مسجل</label>
                        </div>
                        <div class="d-inline-block custom-control custom-radio">
                            <input type="radio" name="is_registered" class="custom-control-input" id="no-req"
                                value="0" @if ($client->is_registered == 0) checked @endif>
                            <label class="custom-control-label" for="no-req">غير مسجل</label>
                        </div>
                        <x-form.validation name='active' />

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control">الحاله</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <div class="d-inline-block custom-control custom-radio mr-1">
                            <input type="radio" name="status" class="custom-control-input" value="active"
                                id="yes" @if ($client->status == 'active') checked @endif>
                            <label class="custom-control-label" for="yes">مفعل</label>
                        </div>
                        <div class="d-inline-block custom-control custom-radio">
                            <input type="radio" name="status" class="custom-control-input" id="no"
                                value="inactive" @if ($client->status == 'inactive') checked @endif>
                            <label class="custom-control-label" for="no">غير مفعل</label>
                        </div>
                        <x-form.validation name='active' />

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
