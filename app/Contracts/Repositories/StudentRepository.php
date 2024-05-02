<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\StudentInterface;
use App\Enum\InternshipTypeEnum;
use App\Enum\StudentStatusEnum;
use App\Models\Student;

class StudentRepository extends BaseRepository implements StudentInterface
{
    /**
     * __construct
     *
     * @param  mixed $student
     * @return void
     */
    public function __construct(Student $student)
    {
        $this->model = $student;
    }

    /**
     * listAttendance
     *
     * @return mixed
     */
    public function listAttendance(): mixed
    {
        $date = now();
        return $this->model->query()
            ->whereNotNull('rfid')
            ->where('internship_type', InternshipTypeEnum::ONLINE->value)
            ->withCount(['attendances' => function ($query) {
                $query->whereDate('created_at', now());
            }])
            ->with(['attendances' => function ($query) use ($date) {
                $query->whereDate('created_at', $date);
            }])
            ->whereNull('status')
            ->orderByDesc('attendances_count')
            ->get();
    }

    /**
     * listOflineAttendance
     *
     * @return mixed
     */
    public function listOflineAttendance(): mixed
    {
        $date = now();
        return $this->model->query()
            ->whereNotNull('rfid')
            ->where('internship_type', InternshipTypeEnum::OFFLINE->value)
            ->withCount(['attendances' => function ($query) {
                $query->whereDate('created_at', now());
            }])
            ->with(['attendances' => function ($query) use ($date) {
                $query->whereDate('created_at', $date);
            }])
            ->whereNull('status')
            ->orderByDesc('attendances_count')
            ->get();
    }


    /**
     * getByRfid
     *
     * @param  mixed $cardId
     * @return void
     */
    public function getByRfid(mixed $cardId)
    {
        return $this->model->query()
            ->where('rfid', $cardId)
            ->firstOrFail();
    }

    /**
     * Get Data
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->model->query()->get();
    }

    /**
     * Store data to database
     *
     * @param  array $data
     * @return mixed
     */
    public function store(array $data): mixed
    {
        return $this->model->query()->create($data);
    }

    /**
     * Show data Into Database
     *
     * @param  mixed $id
     * @return mixed
     */
    public function show(mixed $id): mixed
    {
        return $this->model->query()->findOrFail($id);
    }

    /**
     * Update data to database
     *
     * @param  mixed $id
     * @param  array $data
     * @return mixed
     */
    public function update(mixed $id, array $data): mixed
    {
        return $this->model->query()->findOrFail($id)->update($data);
    }

    /**
     * Delete data to database
     *
     * @param  mixed $id
     * @return mixed
     */
    public function delete(mixed $id): mixed
    {
        return $this->model->query()->findOrFail($id)->delete($id);
    }

    /**
     * Where Status Accepted
     *
     * @return mixed
     */
    public function where(): mixed
    {
        return $this->model->query()
            ->where('status', 'accepted')
            ->where('acepted', '1')
            ->get();
    }

    /**
     * Pluck Collumn From Database
     *
     * @param  mixed $column
     * @return mixed
     */
    public function  pluck(mixed $column): mixed
    {
        return $this->model->query()->pluck($column);
    }

    /**
     * List All Student
     *
     * @return mixed
     */
    public function listStudent(): mixed
    {
        return $this->model->query()
            ->whereNotIn('status', ['pending', 'banned'])
            ->get();
    }

    /**
     * Show Student To Warning Letter
     *
     * @param  mixed $id
     * @return mixed
     */
    public function sp(mixed $id): mixed
    {
        return $this->model->query()
        ->where('id', $id)
        ->firstOrFail();
    }

    /**
     * Count Student Offline
     *
     * @return mixed
     */
    public function countStudentOffline(): mixed
    {
        return $this->model->query()
        ->where('internship_type', InternshipTypeEnum::OFFLINE->value)
        ->where('status', 'accepted')
        ->count();
    }

    /**
     * List Student Offline
     *
     * @return mixed
     */
    public function listStudentOffline(): mixed
    {
        return $this->model->query()
        ->where('internship_type', InternshipTypeEnum::OFFLINE->value)
        ->where('status', 'accepted')
        ->get();
    }

    /**
     * List Student Online
     *
     * @return mixed
     */
    public function listStudentOnline(): mixed
    {
        return $this->model->query()
        ->where('internship_type', InternshipTypeEnum::ONLINE->value)
        ->where('status', 'accepted')
        ->get();
    }

    /**
     * Get Student By Status Banned
     *
     * @return mixed
     */
    public function getstudentdeclined(): mixed
    {
        return $this->model->query()
        ->where('status', StudentStatusEnum::DECLINED->value)
        ->get();
    }

    /**
     * Get Student By Status Banned
     *
     * @return mixed
     */
    public function getstudentbanned(): mixed
    {
        return $this->model->query()
        ->where('status', StudentStatusEnum::BANNED->value)
        ->get();
    }

    /**
     * Get Student By Status Accepted
     *
     * @param  mixed $id
     * @return mixed
     */
    public function getstudentmentorplacement(mixed $id): mixed
    {
        return $this->model->query()
        ->where('internship_type', InternshipTypeEnum::ONLINE->value)
        ->where('status', 'accepted')
        ->whereNotIn('id', $id)
        ->get();
    }

    /**
     * Get Student By Status Accepted
     *
     * @param  mixed $id
     */
    public function getstudentoffexceptauth(mixed $id): mixed
    {
        return $this->model->query()
        ->where('internship_type', 'offline')
        ->where('id', '!=', $id)
        ->get();
    }

    /**
     * Get Student for Division Placement
     *
     * @return mixed
     */
    public function getstudentdivisionplacement(): mixed
    {
        return $this->model->query()
        ->where('internship_type', InternshipTypeEnum::OFFLINE->value)
        ->where('status', 'accepted')
        ->where('division_id', null)
        ->get();
    }

    /**
     * Get Edit Student Mentor Placement
     *
     * @param  mixed $id
     * @return mixed
     */
    public function geteditstudentmentorplacement(mixed $id): mixed
    {
        return $this->model->query()
        ->where('internship_type', InternshipTypeEnum::ONLINE->value)
        ->where('status', 'accepted')
        ->whereIn('id', $id)
        ->get();
    }

    /**
     * Get Edit Student Division Placement
     *
     * @return mixed
     */
    public function getstudentdivisionplacementedit(): mixed
    {
        return $this->model->query()
            ->where('internship_type', InternshipTypeEnum::OFFLINE->value)
            ->where('status', 'accepted')
            ->where('division_id', '!=', null)
            ->get();
    }

    public function whereStudentDivision(mixed $id): mixed
    {
        return $this->model->query()->where('division_id', $id)->get();;
    }

    public function whereRfidNull(): mixed
    {
        return $this->model->query()->whereNull('rfid')->get();
    }

    public function listRfid(): mixed
    {
        return $this->model->query()->whereNotNull('rfid')->get();
    }
}
