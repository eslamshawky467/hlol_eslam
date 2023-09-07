<x-admin title="العملاء">
    <x-slot name="breadcrumbs">
        <div class="content-wrapper">
            <div class="content-header row">
                <x-bread-crumbs title="العملاء">

                </x-bread-crumbs>
                <div class="content-header-right col-md-6 col-12">
                    <div class=" float-md-right">
                        <a href="{{ route('clients.create') }}" class="btn btn-primary round btn-glow px-2"
                            type="button">انشاء عميل جديد</a>

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
                        <h4 class="card-title">قائمه العملاء</h4>
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
                                class="btn btn-outline-warning ml-1 mb-3 float-lg-right">اختيار
                                الكل</button>
                            <button onClick="deCheckAll(this)"
                                class="btn btn-outline-info ml-1 mb-3 float-lg-right">تصفيه</button>
                            <form action="{{ route('clients.change.status.all') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger ml-1 mb-3 float-lg-right"
                                    name="action" value="delete"> تفعيل /تعطيل الكل</button>
                                <table class="table table-striped table-bordered clients-table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            {{-- <th>الاميل</th> --}}
                                            <th>الهاتف</th>
                                            <th> مسجل</th>
                                            <th> الحاله</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                </table>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                $('.clients-table').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: true,
                    dom: 'Blfrtip',
                    buttons: [
                        'copy',
                        'print',
                        'excel'
                    ],
                    ajax: "{{ route('clients.index') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        // {
                        //     data: 'email',
                        //     name: 'email'
                        // },
                        {
                            data: 'phone_number',
                            name: 'phone_number'
                        },
                        {
                            data: 'is_registered',
                            name: 'is_registered'
                        },
                        {
                            data: 'status',
                            name: 'status'
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
                var section_name = button.data('name')
                console.log(id);
                var modal = $(this)
                document.getElementById('section_id').value = id;
                document.getElementById('section_name').textContent = "  هل متاكد من حذف القسم : " + section_name

            });
        </script>
        <script language="JavaScript">
            function checkAll(source) {
                var ele = document.getElementsByName('clients_ids[]');
                for (var i = 0; i < ele.length; i++) {
                    if (ele[i].type == 'checkbox')
                        ele[i].checked = true;
                }
            }

            function deCheckAll() {
                var ele = document.getElementsByName('clients_ids[]');
                for (var i = 0; i < ele.length; i++) {
                    if (ele[i].type == 'checkbox')
                        ele[i].checked = false;

                }
            }
        </script>
    @endpush
</x-admin>
