<?php

namespace App\Notifications;

use App\Models\CourseEnrollment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EnrollmentRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $enrollment;

    /**
     * Create a new notification instance.
     */
    public function __construct(CourseEnrollment $enrollment)
    {
        $this->enrollment = $enrollment;
    }

    /**
     * Summary of payload
     */
    protected function payload(): array
    {
        return [
            'enrollment_id' => $this->enrollment->id,
            'student_id' => $this->enrollment->student_id,
            'student_name' => $this->enrollment->student->name,
            'student_email' => $this->enrollment->student->email,
            'course_id' => $this->enrollment->course_id,
            'course_title' => $this->enrollment->course->title,
            'enrolled_at' => $this->enrollment->enrolled_at->toDateTimeString(),
            'message' => "{$this->enrollment->student->name} has requested to enroll in {$this->enrollment->course->title}",
            'action_url' => route('enrollments.pending'),
        ];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return $this->payload();
    }

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->payload());
    }
}

