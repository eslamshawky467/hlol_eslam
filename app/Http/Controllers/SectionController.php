<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Traits\WebResponce;
use Illuminate\Http\Request;
use App\DataTables\SectionsDataTable;
use App\Repositories\SectionRepository;
use App\Services\FileService;

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
        // return $dataTable->ajax()->content();
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

    public function store(Request $request)
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

    public function update(Request $request, $id)
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
    public function DeleteForever(Request $request)
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

}
