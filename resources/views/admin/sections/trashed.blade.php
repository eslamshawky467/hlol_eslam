<x-admin title="الاقسام المؤرشف">
    <x-slot name="breadcrumbs">
        <x-bread-crumbs title="الاقسام المؤرشف">

        </x-bread-crumbs>
        <section id="html5">
            @include('admin.alerts.errors')
            @include('admin.alerts.success')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">قائمه الاقسام المؤرشفه</h4>
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
                            <div class="card-body card-dashboard">
                                <button onClick="checkAll(this)"
                                    class="btn  btn-warning ml-1 mb-3 float-lg-right btn-xs">اختيار
                                    الكل</button>
                                <button onClick="deCheckAll(this)"
                                    class="btn btn-info ml-1 mb-3 float-lg-right">تصفيه</button>
                                <form action="{{ route('sections.muliple.restore') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary ml-1 mb-3 float-lg-right">استعاده
                                        الكل</button>
                                    <table class="table table-striped table-bordered sections-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الاسم</th>
                                                <th>نوع القسم</th>
                                                <th>الحاله</th>
                                                <th> الصوره</th>
                                                <th>العمليات</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.sections.delete-modal')
            </div>
        </section>
    </x-slot>
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
                $('.sections-table').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    dom: 'Blfrtip',
                    buttons: [
                        'copy',
                        'print',
                        'excel'
                    ],
                    ajax: "{{ route('sections.archived.sections') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'section_name',
                            name: 'section_name'
                        },
                        {
                            data: 'parent_id',
                            name: 'parent_id'
                        },
                        {
                            data: 'active',
                            name: 'active'
                        },
                        {
                            data: 'image',
                            name: 'image'
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
        <script language="JavaScript">
            function checkAll(source) {
                var ele = document.getElementsByName('section_ids[]');
                for (var i = 0; i < ele.length; i++) {
                    if (ele[i].type == 'checkbox')
                        ele[i].checked = true;
                }
            }

            function deCheckAll() {
                var ele = document.getElementsByName('section_ids[]');
                for (var i = 0; i < ele.length; i++) {
                    if (ele[i].type == 'checkbox')
                        ele[i].checked = false;

                }
            }
        </script>
    @endpush
</x-admin>
