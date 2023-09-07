<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Traits\WebResponce;
use Illuminate\Http\Request;
use App\Services\FileService;
use App\Http\Requests\DeleteRequest;
use App\DataTables\SectionsDataTable;
use App\Http\Requests\SectionRequest;
use App\Repositories\SectionRepository;
use App\Http\Requests\SectionAllRequest;

class SectionController extends Controller
{
    use WebResponce;
    private $sectionRepository;
    private $fileService;

    public function __construct(SectionRepository $sectionRepository, FileService $fileService)
    {
        $this->sectionRepository = $sectionRepository;
        $this->fileService = $fileService;
    }

    public function index(SectionsDataTable $dataTable)
    {
        // return Section::all();
        // return request();
        if (request()->ajax()) {
            return $dataTable->ajax()->content();
        }
        return view('admin.sections.index');
    }

    public function ArchivedSections(SectionsDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->with('trash', 1)->ajax()->content();
        }
        return view('admin.sections.trashed');
    }


    public function create()
    {
        $section = new Section;
        return view('admin.sections.create', compact('section'));
    }

    public function store(SectionRequest $request)
    {
        try {
            $this->sectionRepository->StoreNew($request);

            return $this->success("تم اضافه القسم بنجاح", 'sections.index');
        } catch (\Exception $e) {
            return $this->error("حدث خطا ما يرجى المحاوله لاحقا", "sections.index");

        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $section = $this->sectionRepository->GetById($id);
        return view('admin.sections.edit', compact('section'));
    }

    public function update(SectionRequest $request, $id)
    {
        try {
            $section = $this->sectionRepository->Update($request);
            return $this->success("تم التحديث بنجاح", 'sections.index');

        } catch (\Exception $e) {
            return $this->error("حدث خطا ما", "sections.index");

        }
    }

    public function destroy($id)
    {
        try {
            $this->sectionRepository->Delete($id);
            return $this->success("تم ارشفه العنصر بنجاح", 'sections.index');

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), "sections.index");

        }
    }
    public function DeleteForever(DeleteRequest $request)
    {

        try {
            $this->sectionRepository->ForeverDelete($request->id);
            return $this->success("تم حذف العنصر بنجاح", 'sections.index');

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), "sections.index");

        }
    }

    public function RestoreElement($id)
    {

        try {
            $this->sectionRepository->Restore($id);
            return $this->success("تم استعاده العنصر بنجاح", 'sections.index');

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), "sections.index");

        }
    }

    public function ArchiveAll(SectionAllRequest $request)
    {
        try {
            if ($request->action == 'archive') {
                $this->sectionRepository->ArchiveAll($request->section_ids);
                return $this->success("تم ارشفه العناصر بنجاح", 'sections.index');
            }
            if ($request->action == 'delete') {
                $this->sectionRepository->DeleteAll($request->section_ids);
                return $this->success("تم حذف العناصر بنجاح", 'sections.index');
            }

            return redirect()->back();

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), "sections.index");

        }
    }
    public function RestoreAll(SectionAllRequest $request)
    {
        // return $request;
        try {
            $this->sectionRepository->RestoreAll($request->section_ids);
            return $this->success("تم استعاده العناصر بنجاح", 'sections.index');

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), "sections.index");

        }
    }

}
