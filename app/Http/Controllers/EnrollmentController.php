<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Notifications\EnrollmentAcceptedNotification;
use App\Notifications\EnrollmentRejectedNotification;
use App\Notifications\EnrollmentRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    /**
     * Student enrolls in a course
     */
    public function enroll(Course $course)
    {
        $student = Auth::user();

        // Check if already enrolled
        $existingEnrollment = CourseEnrollment::where('course_id', $course->id)
            ->where('student_id', $student->id)
            ->first();

        if ($existingEnrollment) {
            return redirect()->back()
                ->with('error', 'You have already enrolled in this course.');
        }

        // Check max students limit
        if ($course->max_students) {
            $acceptedCount = $course->enrollments()->where('status', 'accepted')->count();
            if ($acceptedCount >= $course->max_students) {
                return redirect()->back()
                    ->with('error', 'This course has reached its maximum capacity.');
            }
        }

        // Create enrollment
        $enrollment = CourseEnrollment::create([
            'course_id' => $course->id,
            'student_id' => $student->id,
            'status' => 'pending',
            'enrolled_at' => now(),
        ]);

        // Send notification to teacher via Reverb
        $course->teacher->notify(new EnrollmentRequestNotification($enrollment));

        return redirect()->route('courses.show', $course)
            ->with('success', 'Enrollment request sent! Waiting for teacher approval.');
    }

    /**
     * Teacher accepts enrollment
     */
    public function accept(CourseEnrollment $enrollment)
    {
        $this->authorize('manage', $enrollment->course);

        if ($enrollment->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'This enrollment has already been processed.');
        }

        DB::transaction(function () use ($enrollment) {
            $enrollment->update([
                'status' => 'accepted',
            ]);

            // Send notification to student via Reverb
            $enrollment->student->notify(new EnrollmentAcceptedNotification($enrollment));
        });

        return redirect()->back()
            ->with('success', 'Enrollment accepted successfully!');
    }

    /**
     * Teacher rejects enrollment
     */
    public function reject(CourseEnrollment $enrollment)
    {
        $this->authorize('manage', $enrollment->course);

        if ($enrollment->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'This enrollment has already been processed.');
        }

        DB::transaction(function () use ($enrollment) {
            $enrollment->update([
                'status' => 'rejected',
            ]);

            // Send notification to student via Reverb
            $enrollment->student->notify(new EnrollmentRejectedNotification($enrollment));
        });

        return redirect()->back()
            ->with('success', 'Enrollment rejected.');
    }

    /**
     * View student's enrollments
     */
    public function myEnrollments()
    {
        $enrollments = Auth::user()->enrollments()
            ->with('course.teacher')
            ->latest()
            ->paginate(10);

        return view('enrollments.my-enrollments', compact('enrollments'));
    }

    /**
     * View pending enrollments for teacher's courses
     */
    public function pending()
    {
        $teacher = Auth::user();

        $pendingEnrollments = CourseEnrollment::whereHas('course', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })
            ->with(['course', 'student'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view('enrollments.pending', compact('pendingEnrollments'));
    }
}
