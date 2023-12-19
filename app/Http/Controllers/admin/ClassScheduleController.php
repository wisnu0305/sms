<?php

namespace App\Http\Controllers\admin;

use App\ClassSchedule;
use App\LessonHours;
use App\Course;
use App\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student_class = StudentClass::all();
        // $classSchedules = ClassSchedule::all(); // Mengambil semua data

        // // Kemudian, kirim data tersebut ke view untuk ditampilkan
        // // return view('admin.class-schedule', compact('classSchedules'));
        return view('admin.class-schedule', [
            'student_class' => ($student_class)
        ]);
        // return view('admin/class-schedule');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lessonHours = LessonHours::all();
        $courses = Course::all();
        $classes = StudentClass::all();

        return view('admin.create-class-schedule', compact('lessonHours', 'courses', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = validator($request->all(), [
            'id_lesson_hours' => 'integer',
            'id_course' => 'integer',
            'id_class' => 'integer',
        ])->validate();

        $class_schedule = new ClassSchedule($validateData);
        $class_schedule->save();

        return redirect(route('admin.class-schedule'))->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_class)
{
    $class = ClassSchedule::find($id_class); // Mengambil kelas berdasarkan ID
    
    return view('admin/edit-class-schedule', [
        'class' => $class // Mengirimkan kelas ke view
    ]);
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
