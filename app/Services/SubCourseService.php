<?php

namespace App\Services;

use App\Enum\TypeEnum;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\StoreJournalRequest;
use App\Http\Requests\StoreLogoRequest;
use App\Services\Traits\UploadTrait;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\StoreStructureRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\StoreSubCourseRequest;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Requests\UpdateJournalRequest;
use App\Http\Requests\UpdateLogoRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Requests\UpdateStructureRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\UpdateSubCourseRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Course;
use App\Models\Journal;
use App\Models\Logo;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Service;
use App\Models\Structure;
use App\Models\Student;
use App\Models\SubCourse;
use App\Models\Team;
use Illuminate\Support\Facades\Log;

class SubCourseService
{
    use UploadTrait;

    /**
     * Handle custom upload validation.
     *
     * @param string $disk
     * @param object $file
     * @param string|null $old_file
     * @return string
     */
    public function validateAndUpload(string $disk, object $file, string $old_file = null): string
    {
        if ($old_file) $this->remove($old_file);

        return $this->upload($disk, $file);
    }

    /**
     * Handle store data event to models.
     *
     * @param StoreSaleRequest $request
     *
     * @return array|bool
     */
    public function store(StoreSubCourseRequest $request): array|bool
    {
        $data = $request->validated();

        if ($request->hasFile('image_course') && $request->file('image_course')->isValid() || $request->hasFile('video_course') && $request->file('video_course')->isValid() || $request->hasFile('file_course') && $request->file('file_course')->isValid()) {
            $data['image_course'] = $request->file('image_course')->store(TypeEnum::IMAGE_COURSE->value, 'public');
            $data['file_course'] = $request->file('file_course')->store(TypeEnum::FILE_COURSE->value, 'public');
            return $data;
        }
        return false;
    }

    /**
     * Handle update data event to models.
     *
     * @param Sale $sale
     * @param UpdateSaleRequest $request
     *
     * @return array|bool
     */
    public function update(SubCourse $subCourse, UpdateSubCourseRequest $request): array|bool
    {
        $data = $request->validated();

        if ($request->hasFile('image_course') && $request->file('image_course')->isValid()) {
            $data['image_course'] = $request->file('image_course')->store(TypeEnum::IMAGE_COURSE->value, 'public');
        }elseif ($request->hasFile('file_course') && $request->file('file_course')->isValid()) {
            $data['file_course'] = $request->file('file_course')->store(TypeEnum::FILE_COURSE->value, 'public');
        }else {
            $data['image_course'] = $subCourse->image_course;
            $data['file_course'] = $subCourse->file_course;
        }
        return $data;
    }

    public function delete(SubCourse $subCourse)
    {
        $this->remove($subCourse->image_course);
        $this->remove($subCourse->file_course);
    }
}
