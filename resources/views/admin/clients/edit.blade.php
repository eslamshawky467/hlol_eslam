<x-admin title="تعديل القسم">
    <x-slot name="breadcrumbs">
        <x-bread-crumbs title=" تعديل القسم">

        </x-bread-crumbs>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="horz-layout-basic">تعديل القسم </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <form method="POST" action="{{ route('clients.update', $client->id) }}"
                                enctype="multipart/form-data" class="form form-horizontal">
                                @csrf
                                @method('PUT')
                                @include('admin.clients.__form')
                                @if ($client->file->first->count())
                                    <div class="col-md-12">
                                        <div class="form-group row d-flex justify-content-center">
                                            <img style='width:150px; height:100px' class=""
                                                src='{{ asset('/storage/' . $client->file->first()->file_name) }}' />
                                        </div>
                                    </div>
                                @endif
                                <input type="hidden" name="id" value="{{ $client->id }}">
                                <div class="form-actions">
                                    <button type="button" class="btn btn-warning mr-1">
                                        <i class="ft-x"></i> الغاء
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> تحديث
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-admin>
