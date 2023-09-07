<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput1">اسم اللافته </label>
                <div class="col-md-9">
                    <input type="text" id="projectinput1" class="form-control" placeholder="اسم اللافته"
                        name="banner_name" value="{{ old('banner_name', $banner->name ?? '') }}">
                    <x-form.validation name='banner_name' />

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control">رفع ملف</label>
                <div class="col-md-9">
                    <label id="projectinput8" class="file center-block">
                        <input type="file" id="file" name="banner_image">
                        <span class="file-custom"></span>
                    </label>
                    <x-form.validation name='banner_image' />

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control">الحاله</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <div class="d-inline-block custom-control custom-radio mr-1">
                            <input type="radio" name="status" class="custom-control-input" value="1"
                                id="yes" @if ($banner->status == 1) checked @endif>
                            <label class="custom-control-label" for="yes">مفعل</label>
                        </div>
                        <div class="d-inline-block custom-control custom-radio">
                            <input type="radio" name="status" class="custom-control-input" id="no"
                                value="0" @if ($banner->status == 0) checked @endif>
                            <label class="custom-control-label" for="no">غير مفعل</label>
                        </div>
                        <x-form.validation name='status' />

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
