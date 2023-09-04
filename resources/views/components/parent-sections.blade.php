<div class="col-md-6">
    <div class="form-group row">
        <label class="col-md-3 label-control" for="issueinput5">نوع القسم</label>
        <div class="col-md-9">
            <select id="issueinput5" name="parent_id" class="form-control" data-toggle="tooltip" data-trigger="hover"
                data-placement="top">
                <option value="" selected>قسم اساسى</option>
                @foreach ($parent_sections as $item)
                    <option value="{{ $item->id }}">{{ $item->translate('ar')->section_name }}</option>
                @endforeach
            </select>
            <x-form.validation name='parent_id' />

        </div>
    </div>
</div>
