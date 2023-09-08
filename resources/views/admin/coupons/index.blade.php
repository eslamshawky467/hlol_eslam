<x-admin title="الخصومات">
    <x-slot name="breadcrumbs">
        <div class="content-wrapper">
            <div class="content-header row">
                <x-bread-crumbs title="الخصومات">

                </x-bread-crumbs>
                <div class="content-header-right col-md-6 col-12">
                    <div class=" float-md-right">
                        <a href="{{ route('coupons.create') }}" class="btn btn-primary round btn-glow px-2"
                            type="button">انشاء خصم جديد</a>

                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <section id="html5">
        @include('admin.alerts.errors')
        @include('admin.alerts.success')
        @include('admin.alerts.validation')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">قائمه الخصومات</h4>
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
                    <div class="card-content collapse show">
                        <x-multivalidation name="clients_ids" />
                        <div class="card-body card-dashboard">

                            <button onClick="checkAll(this)"
                                class="btn btn-outline-secondary ml-1 mb-3 float-lg-right">اختيار
                                الكل</button>
                            <button onClick="deCheckAll(this)"
                                class="btn btn-outline-info ml-1 mb-3 float-lg-right">تصفيه</button>
                            <form action="{{ route('coupons.all') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary ml-1 mb-3 float-lg-right"
                                    name="action" value="status"> تفعيل /تعطيل الكل</button>
                                <button type="submit" class="btn btn-outline-warning ml-1 mb-3 float-lg-right"
                                    name="action" value="delete"> ارشفه الكل</button>
                                <button type="submit" class="btn btn-outline-danger ml-1 mb-3 float-lg-right"
                                    name="action" value="force-delete"> حذف الكل نهائيا</button>
                                <table class="table table-striped table-bordered banners-tabl">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>الكميه</th>
                                            <th>النوع</th>
                                            <th> الحاله</th>
                                            <th> يبدا من</th>
                                            <th> ينتهى فى</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                </table>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.coupons.delete-modal')
        </div>
    </section>
    @push('css')
        <link rel="stylesheet" type="text/css"
            href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    @endpush
    @push('js')
        <script type="text/javascript" src="{{ asset('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}" type="text/javascript">
        </script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}" type="text/javascript">
        </script>
        <script src="{{ asset('app-assets/js/scripts/tables/datatables-extensions/datatable-button/datatable-html5.js') }}"
            type="text/javascript"></script>

        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('.banners-tabl').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: true,
                    dom: 'Blfrtip',
                    buttons: [
                        'copy',
                        'print',
                        'excel'
                    ],
                    ajax: "{{ route('coupons.index') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'amount',
                            name: 'amount'
                        },
                        {
                            data: 'type',
                            name: 'type'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'start_at',
                            name: 'start_at'
                        },
                        {
                            data: 'end_at',
                            name: 'end_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    order: [
                        [0, 'desc']
                    ]
                });
            });
        </script>
        <script>
            $('#defaultSize').on('shown.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var coupon_name = button.data('name')
                console.log(id);
                var modal = $(this)
                document.getElementById('coupon_id').value = id;
                document.getElementById('coupon_name_id').textContent = "  هل متاكد من ارشفه الخصم : " + coupon_name

            });
        </script>
        <script language="JavaScript">
            function checkAll(source) {
                var ele = document.getElementsByName('coupons_ids[]');
                for (var i = 0; i < ele.length; i++) {
                    if (ele[i].type == 'checkbox')
                        ele[i].checked = true;
                }
            }

            function deCheckAll() {
                var ele = document.getElementsByName('coupons_ids[]');
                for (var i = 0; i < ele.length; i++) {
                    if (ele[i].type == 'checkbox')
                        ele[i].checked = false;

                }
            }
        </script>
    @endpush
</x-admin>
