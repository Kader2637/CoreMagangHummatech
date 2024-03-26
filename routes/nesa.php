<?php

use App\Http\Controllers\Admin\PicketController;
use App\Http\Controllers\Admin\AdminJournalController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentOfline\CourseOfflineController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCourseController;
use App\Http\Controllers\SubCourseOfflineController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('journal', [AdminJournalController::class, 'index']);


Route::get('rfid', function () {
    return view('admin.page.user.rfid');
});

Route::get('reject', function (){
    return view('admin.page.rejected.index');
});


Route::get('picket' , [PicketController::class , 'index']);
Route::post('picket/store',[PicketController::class,'store'])->name('picket.store');
Route::post('picket/{picket}',[PicketController::class,'update'])->name('picket.update');



Route::get('report', function (){
    return view('admin.page.picket.report');
});

Route::get('product',[ProductController::class,'index']);
Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
Route::put('product/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');


// mentor
Route::get('student/absensi', function (){
    return view('mentor.absensi.index');
});

Route::get('student/journal', function (){
    return view('mentor.journal.index');
});

Route::get('student', function (){
    return view('mentor.student.index');
});


// siswa offline
Route::get('siswa-offline/absensi', function (){
    return view('student_offline.absensi.index');
});
// Route::get('/siswa-offline/course', function (){
//     return view('student_offline.course.index');
// });
// Route::get('/siswa-offline/course/detail', function (){
//     return view('student_offline.course.detail');
// });

Route::get('/siswa-offline/course',[CourseOfflineController::class,'index']);
Route::get('/siswa-offline/course/detail/{course}', [CourseOfflineController::class, 'show'])->name('materi.detail');
Route::get('/siswa-offline/course/detail/learn-more/{subCourse}', [CourseOfflineController::class, 'showSub'])->name('submateri.detail');



// Route::get('/siswa-offline/course/detail/learn-more', function (){
//     return view('student_offline.course.learn-more');
// });
Route::get('/siswa-offline/course/detail/answer-detail', function (){
    return view('student_offline.course.answer-detail');
});
Route::get('siswa-offline/transaction/topUp', function (){
    return view('student_offline.transaction.topUp_history');
});
Route::get('siswa-offline/transaction/history', function (){
    return view('student_offline.transaction.transaction_history');
});


Route::get('administrator/course',[CourseController::class,'index']);
Route::post('administrator/course/store', [CourseController::class, 'store'])->name('course.store');
Route::put('administrator/course/{course}', [CourseController::class, 'update'])->name('course.update');


Route::get('/administrator/course/detail/{course}', [CourseController::class, 'show'])->name('course.detail');
Route::delete('administrator/course/detail/{course}', [SubCourseController::class, 'destroy'])->name('subCourse.destroy');
Route::get('/administrator/subcourse/detail/{subCourse}', [SubCourseController::class, 'show'])->name('subCourse.detail');

Route::post('administrator/task/store', [TaskController::class, 'store'])->name('task.store');
