<x-admin title="تفاصيل العميل">
    <x-slot name="breadcrumbs">
        <x-bread-crumbs title="تفاصيل العميل">

        </x-bread-crumbs>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="horz-layout-basic">تفاصيل العميل : {{ $client->name }} </h4>
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
                        <section>
                            <div class="container py-5">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card mb-4 border border-light rounded" style="height: 360px">
                                            <div class="card-body text-center">
                                                <img style="height: 250px" class=" rounded-circle"
                                                    src='{{ asset('/storage/' . $client->file->first()->file_name) }}'
                                                    alt="avatar" class="rounded-circle img-fluid"
                                                    style="width: 150px;">
                                                <h5 class="my-3">{{ $client->name }}</h5>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card mb-4 border border-light rounded">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">الاسم بالكامل</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $client->name }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">البريد الالكترونى</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $client->email }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">رقم التليفون</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $client->phone_number }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        توكن الجهاز </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $client->device_token }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">الحاله</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            @if ($client->is_registered == 'active')
                                                                مفعل
                                                            @else
                                                                غير مفعل
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        الجنس </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            @if ($client->gender == 'male')
                                                                ذكر
                                                            @else
                                                                انثى
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        حاله التسجيل </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            @if ($client->is_registered == 1)
                                                                مسجل
                                                            @else
                                                                غير مسجل
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>
                        {{-- <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput1">اسم العميل :
                                            </label>
                                            <div class="col-md-9">
                                                <span class="">{{ $client->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput2"> توكن
                                                الجهاز : </label>
                                            <div class="col-md-9">
                                                <span class="">{{ $client->device_token }}</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput2">البريد
                                                الالكترونى : </label>
                                            <div class="col-md-9">
                                                <span class="">{{ $client->email }}</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput2">رقم الهاتف : </label>
                                            <div class="col-md-9">
                                                <span class="">{{ $client->phone_number }}</span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="issueinput5">الجنس : </label>
                                            <div class="col-md-9">
                                                <span class="">
                                                    @if ($client->gender == 'male')
                                                        ذكر
                                                    @else
                                                        انثى
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control">حاله التسجيل :</label>
                                            <div class="col-md-9">
                                                <span class="">
                                                    @if ($client->is_registered == 1)
                                                        مسجل
                                                    @else
                                                        غير مسجل
                                                    @endif

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control">الحاله : </label>
                                            <div class="col-md-9">
                                                <span class="">
                                                    @if ($client->is_registered == 'active')
                                                        مفعل
                                                    @else
                                                        غير مفعل
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            @if ($client->file->first->count())
                                                <div class="col-md-12">
                                                    <div class="form-group row d-flex justify-content-center">
                                                        <img style='width:150px; height:100px' class=""
                                                            src='{{ asset('/storage/' . $client->file->first()->file_name) }}' />
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
</x-admin>
