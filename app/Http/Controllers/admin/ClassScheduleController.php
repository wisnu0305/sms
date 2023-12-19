<?php

namespace App\Http\Controllers\admin;

use App\Course;
use App\LessonHours;
use App\StudentClass;
use App\ClassSchedule;
use App\Days;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClassScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentClass = StudentClass::all();
        // $classSchedules = ClassSchedule::all(); // Mengambil semua data

        // // Kemudian, kirim data tersebut ke view untuk ditampilkan
        // // return view('admin.class-schedule', compact('classSchedules'));
        return view('admin.class-schedule', [
            // 'dump' => dd($studentClass),
            'studentClasses' => ($studentClass)
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
        $days = Days::all();
        $lessonHours = LessonHours::all();
        $courses = Course::all();
        $classes = StudentClass::all();

        return view('admin.create-class-schedule', compact('lessonHours', 'courses', 'classes', 'days'));
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
            'id_lesson_hours.*' => 'integer',
            'id_course.*' => 'integer',
            'id_class.*' => 'integer',
            'hari.*' => 'string',
        ])->validate();
        
        $count = count($validateData['id_lesson_hours']);

        if (
            count($validateData['id_course']) !== $count ||
            count($validateData['id_class']) !== $count ||
            count($validateData['hari']) !== $count
        ) {            
            return redirect()->back()->withErrors(['message' => 'Panjang array tidak sesuai, Mohon isi semua jadwal']);
        }
        
        for ($i = 0; $i < $count; $i++) {
            ClassSchedule::create([
                'id_lesson_hours' => $validateData['id_lesson_hours'][$i],
                'id_course' => $validateData['id_course'][$i],
                'id_class' => $validateData['id_class'][$i],
                'hari' => $validateData['hari'][$i],
            ]);
        }

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
    public function edit(ClassSchedule $id)
    {
        return redirect('/admin/create-class-schedule');
        try {
            $class = ClassSchedule::findOrFail($id);

            return view('admin/edit-class-schedule', [
                'class' => $class,
            ]);
        } catch (ModelNotFoundException $e) {
                        
            return redirect('/admin/create-class-schedule');
        }
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
