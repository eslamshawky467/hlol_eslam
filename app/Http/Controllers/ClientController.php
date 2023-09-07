<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Section;
use App\Traits\WebResponce;
use Illuminate\Http\Request;
use App\Services\FileService;
use App\DataTables\ClientsDataTable;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\DeleteRequest;
use App\DataTables\SectionsDataTable;
use App\Http\Requests\SectionRequest;
use App\Repositories\ClientRepository;
use App\Http\Requests\ClientAllRequest;
use App\Http\Requests\SectionAllRequest;

class ClientController extends Controller
{
    use WebResponce;
    private $clientRepository;
    private $fileService;

    public function __construct(ClientRepository $clientRepository, FileService $fileService)
    {
        $this->clientRepository = $clientRepository;
        $this->fileService = $fileService;
    }

    public function index(ClientsDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax()->content();
        }
        return view('admin.clients.index');
    }

    public function SatatusSection(ClientsDataTable $dataTable, $status)
    {

        if (request()->ajax()) {
            return $dataTable->with('status', $status)->ajax()->content();
        }
        return view('admin.clients.status-filter');
    }
    public function IsRegisterSection(ClientsDataTable $dataTable, $is_registered)
    {

        if (request()->ajax()) {
            return $dataTable->with('is_registered', $is_registered)->ajax()->content();
        }
        return view('admin.clients.is-register-filter');
    }

    public function create()
    {
        $client = new Client();
        return view('admin.clients.create', compact('client'));
    }

    public function store(ClientRequest $request)
    {
        try {
            $this->clientRepository->StoreNew($request);

            return $this->success("تم اضافه القسم بنجاح", 'clients.index');
        } catch (\Exception $e) {
            return $this->error("حدث خطا ما يرجى المحاوله لاحقا", "clients.index");

        }
    }

    public function show($id)
    {
        try {
            $client = $this->clientRepository->ShowClient($id);
            return view('admin.clients.details', compact('client'));

        } catch (\Exception $e) {
            return $this->error("حدث خطا ما", "clients.index");

        }

    }

    public function edit($id)
    {
        $client = $this->clientRepository->GetById($id);
        return view('admin.clients.edit', compact('client'));
    }

    public function update(ClientRequest $request, $id)
    {
        try {
            $section = $this->clientRepository->Update($request);
            return $this->success("تم التحديث بنجاح", 'clients.index');

        } catch (\Exception $e) {
            return $this->error("حدث خطا ما", "clients.index");

        }
    }
    public function destroy($id)
    {
    }
    public function changeStatus($id)
    {
        try {
            $this->clientRepository->ChangeStatus($id);
            return $this->success("تم تغير حاله العميل بنجاح", 'clients.index');

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), "clients.index");

        }
    }
    public function ChangeStatusAll(ClientAllRequest $request)
    {
        try {
            $this->clientRepository->ChangeStatusAll($request->clients_ids);
            return $this->success("تم تغير حاله العملاء بنجاح", 'clients.index');

        } catch (\Exception $e) {
            return $this->error('يوجد خطا ما يرجى المحاوله لاحقا', "clients.index");

        }
    }

}
