<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Interfaces\AdminJournalInterface;
use App\Contracts\Interfaces\JournalInterface;
use App\Http\Controllers\Controller;
use App\Services\JournalService;
use Illuminate\Http\Request;

class AdminJournalController extends Controller
{
    private JournalInterface $journal;
    private JournalService $service;
    private AdminJournalInterface $adminJournal;

    public function __construct(JournalInterface $journal, JournalService $service, AdminJournalInterface $adminJournal)
    {
        $this->journal = $journal;
        $this->service = $service;
        $this->adminJournal = $adminJournal;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adminJournal = $this->adminJournal->get();
        return view('admin.page.journal', compact('adminJournal'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
