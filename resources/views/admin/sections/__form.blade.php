<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput1">اسم بالعربى </label>
                <div class="col-md-9">
                    <input type="text" id="projectinput1" class="form-control" placeholder="الاسم بالعربى"
                        name="section_name_ar"
                        value="{{ old('section_name_ar', $section->translate('ar')->section_name ?? '') }}">
                    <x-form.validation name='section_name_ar' />

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput2">اسم بالانجليزى</label>
                <div class="col-md-9">
                    <input type="text" id="projectinput2" class="form-control" placeholder="اسم بالانجليزى"
                        name="section_name_en"
                        value="{{ old('section_name_en', $section->translate('en')->section_name ?? '') }}">
                    <x-form.validation name='section_name_en' />

                </div>

            </div>
        </div>
        <x-parent-sections id="{{ $section->id }}" />
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control">رفع ملف</label>
                <div class="col-md-9">
                    <label id="projectinput8" class="file center-block">
                        <input type="file" id="file" name="section_image">
                        <span class="file-custom"></span>
                    </label>
                    <x-form.validation name='section_image' />

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-3 label-control">الحاله</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <div class="d-inline-block custom-control custom-radio mr-1">
                            <input type="radio" name="active" class="custom-control-input" value="1"
                                id="yes" @if ($section->active == 1) checked @endif>
                            <label class="custom-control-label" for="yes">مفعل</label>
                        </div>
                        <div class="d-inline-block custom-control custom-radio">
                            <input type="radio" name="active" class="custom-control-input" id="no"
                                value="0" @if ($section->active == 0) checked @endif>
                            <label class="custom-control-label" for="no">غير مفعل</label>
                        </div>
                        <x-form.validation name='active' />

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
