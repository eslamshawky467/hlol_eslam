<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Traits\WebResponce;
use Illuminate\Http\Request;
use App\DataTables\ServiceDataTable;
use App\Http\Requests\ServiceRequest;
use App\Repositories\ServiceRepository;
use App\Http\Requests\DeleteServiceRequest;
use App\Http\Requests\DeleteAllServiceRequest;

class ServicesController extends Controller
{
    use WebResponce;
    private $serviceRepository;
    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index(ServiceDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax()->content();
        }
        return view('admin.services.index');
    }
    public function ArchivedServices(ServiceDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->with('trash', 1)->ajax()->content();
        }
        return view('admin.services.trashed');
    }

    public function create()
    {
        $service = new Service();
        return view('admin.services.create', compact('service'));
    }

    public function store(ServiceRequest $request)
    {
        try {
            $this->serviceRepository->StoreNew($request);

            return $this->success("تم اضافه الخدمه بنجاح", 'services.index');
        } catch (\Exception $e) {
            return $this->error("حدث خطا ما يرجى المحاوله لاحقا", "services.index");

        }
    }

    public function edit($id)
    {
        $service = $this->serviceRepository->GetById($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(ServiceRequest $request)
    {
        try {
            $this->serviceRepository->Update($request);
            return $this->success("تم التحديث بنجاح", 'services.index');

        } catch (\Exception $e) {
            return $this->error("حدث خطا ما", "services.index");

        }
    }
    public function show($id)
    {
        try {
            $service = $this->serviceRepository->ShowService($id);
            return view('admin.services.details', compact('service'));

        } catch (\Exception $e) {
            return $this->error("حدث خطا ما", "services.index");

        }

    }
    public function destroy(DeleteServiceRequest $request)
    {
        try {
            $this->serviceRepository->Delete($request->id);
            return $this->success("تم حذف  الخدمه بنجاح", 'services.index');

        } catch (\Exception $e) {
            return $this->error('يوجد خطا ما يرجى المحاوله لاحقا', "services.index");

        }
    }
    public function Restore(DeleteServiceRequest $request)
    {
        try {
            $this->serviceRepository->Restore($request->id);
            return $this->success("تم استعاده  الخدمه بنجاح", 'services.index');

        } catch (\Exception $e) {
            return $this->error('يوجد خطا ما يرجى المحاوله لاحقا', "services.index");

        }
    }
    public function DeleteAll(Request $request)
    {
        try {
            $this->serviceRepository->DeleteAll($request->services_ids);
            return $this->success("تم حذف  الخدمات بنجاح", 'services.index');

        } catch (\Exception $e) {
            return $this->error('يوجد خطا ما يرجى المحاوله لاحقا', "services.index");

        }
    }
    public function changeStatus($id)
    {
        try {
            $this->serviceRepository->ChangeStatus($id);
            return $this->success("تم تغير حاله الخدمه بنجاح", 'services.index');

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), "services.index");

        }
    }
    public function ServicesAll(DeleteAllServiceRequest $request)
    {

        try {
            $this->serviceRepository->ServicesAll($request);
            return $this->success("تم الحدث بنجاح", 'services.index');

        } catch (\Exception $e) {
            return $this->error('يوجد خطا ما يرجى المحاوله لاحقا', "services.index");

        }
    }

    public function SatatusService(ServiceDataTable $dataTable, $status)
    {

        if (request()->ajax()) {
            return $dataTable->with('status', $status)->ajax()->content();
        }
        return view('admin.services.status-filter');
    }

}
