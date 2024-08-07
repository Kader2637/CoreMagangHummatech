<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;

interface StudentChallengeInterface extends GetInterface, StoreInterface, UpdateInterface, DeleteInterface
{
    public function getByStatus(string $status) :mixed;
    public function whereChallenge(mixed $id) : mixed;
    public function whereStudentChallenge(mixed $mentor, mixed $challenge, mixed $student): mixed;
    public function whereChallengePending(mixed $student);
    public function whereChallengeDone(mixed $student);
}
