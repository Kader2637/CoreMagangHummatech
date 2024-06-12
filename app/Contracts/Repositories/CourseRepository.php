<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\CourseInterface;
use App\Contracts\Interfaces\JournalInterface;
use App\Enum\StatusCourseEnum;
use App\Models\Course;
use App\Models\Journal;
use Illuminate\Http\Request;

class CourseRepository extends BaseRepository implements CourseInterface
{
    public function __construct(Course $course)
    {
        $this->model = $course;
    }

    public function paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null): mixed
    {
        return $this->model->query()->paginate($perPage, $columns, $pageName, $page);
    }
    public function get(): mixed
    {
        return $this->model->query()->get();
    }

    public function getUnpaidCourse()
    {
        return $this->model->query()->doesntHave('courseUnlock')->paginate(12);
    }

    public function store(array $data): mixed
    {
        return $this->model->query()->create($data);
    }
    public function update(mixed $id, array $data): mixed
    {
        return $this->model->query()->findOrFail($id)->update($data);
    }
    public function show(mixed $id): mixed
    {
        return $this->model->query()
            ->with(['subCourses' => function ($query) {
                $query->orderBy('position');
            }, 'courseAssignments'])
            ->findOrFail($id);
    }
    public function delete(mixed $id): mixed
    {
        return $this->model->query()->findOrFail($id)->delete();
    }
    public function count(): mixed
    {
        return $this->model->query()->count();
    }

    public function GetWhere(mixed $id): mixed
    {
        return $this->model->query()->where('division_id' , $id)->where('status' , 'subcribe')->get();
    }

    /**
     * countByMentor
     *
     * @param  mixed $id
     * @return int
     */
    public function countByMentor(mixed $id): int
    {
        return $this->model->query()
            ->where('division_id', $id)
            ->count();
    }

    public function getPaid()
    {
        return $this->model->query()->where('status' , 'paid')->get();
    }

    public function getCourseByStatus(mixed $status): mixed
    {
        return $this->model->query()->where('status' , $status)->get();
    }

    public function whereDivision(mixed $id): mixed
    {
        return $this->model->query()->where('division_id', $id)->get();
    }

    /**
     * getSubscribeByDivision
     *
     * @param  mixed $division
     * @return mixed
     */
    public function getSubscribeByDivision(mixed $division): mixed
    {
        return $this->model->query()
            ->where('status', 'subcribe')
            ->where('division_id', $division)
            ->get();
    }

    /**
     *
     * get latest position by division
     * @param mixed $id
     * @return mixed
     *
     */
    public function getLatestPositionByDivision(mixed $id): mixed
    {
        return $this->model->query()
            ->where('division_id', $id)
            ->orderByDesc('position')
            ->first();
    }

    /**
     * getNonactiveCourse
     *
     * @param  mixed $divisionId
     * @param  mixed $studentId
     * @return void
     */
    public function getNonactiveCourse(mixed $divisionId, mixed $studentId)
    {
        return $this->model->query()
            ->with('subCourses')
            ->where('division_id', $divisionId)
            ->where('status', StatusCourseEnum::PAID->value)
            ->whereDoesntHave('activeCourses', function ($query) use ($studentId) {
                $query->where('student_id', $studentId);
            })
            ->get();
    }

    public function search(Request $request):mixed
    {
        $query = $this->model->query();

        $query->when($request->title, function ($query) use ($request) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        });

        return $query;
    }
}
