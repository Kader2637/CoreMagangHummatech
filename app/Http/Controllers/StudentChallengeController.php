<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\ChallengeInterface;
use App\Contracts\Interfaces\StudentChallengeInterface;
use App\Models\StudentChallenge;
use App\Http\Requests\StoreStudentChallengeRequest;
use App\Http\Requests\UpdateStudentChallengeRequest;
use App\Services\StudentChallengeService;

class StudentChallengeController extends Controller
{
    private StudentChallengeInterface $studentChallenge;
    private StudentChallengeService $serviceStudentChallenge;
    private ChallengeInterface $challenge;
    public function __construct(StudentChallengeInterface $studentChallenge, StudentChallengeService $serviceStudentChallenge, ChallengeInterface $challenge)
    {
        $this->studentChallenge = $studentChallenge;
        $this->serviceStudentChallenge = $serviceStudentChallenge;
        $this->challenge = $challenge;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $challenges = $this->challenge->getUnsubmittedChallenges();
        $challengePendings = $this->studentChallenge->getByStatus('pending');
        return view('student_offline.challenge.index', compact('challenges', 'challengePendings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentChallengeRequest $request)
    {
        $data = $this->serviceStudentChallenge->store($request);
        $this->studentChallenge->store($data);
        return back()->with('success' , 'Berhasil Mengumpulkan challenge');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentChallenge $studentChallenge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentChallenge $studentChallenge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentChallengeRequest $request, StudentChallenge $studentChallenge)
    {
        $data = $this->serviceStudentChallenge->update($studentChallenge, $request);
        $this->studentChallenge->update($studentChallenge->id, $data);
        return back()->with('success' , 'Berhasi Memperbarui Jawaban');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentChallenge $studentChallenge)
    {
        //
    }
}