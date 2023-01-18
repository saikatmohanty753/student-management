<?php

namespace App\Notifications;

use App\Models\Notice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UucNotice extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];

    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $notice = Notice::find($notifiable->notice_id);

        if ($notice->notice_type == 1) {
            $data = [
                'notice_type' => 'Admission Notice',
                'notice_id' => $notifiable->notice_id,
                'details' => $notice->details,
                'department' => $notice->department->course_for,
                'department_id' => $notice->department_id,
                'start_date' => $notice->start_date,
                'end_date' => $notice->exp_date,
            ];
        } elseif($notice->notice_type == 2) {
            $data = [
                'notice_type' => 'Exam Notice',
                'notice_id' => $notifiable->notice_id,
                'details' => $notice->details,
                'department' => $notice->department->course_for,
                'department' => $notice->department->course_for,
                'department_id' => $notice->department_id,
                'course' => $notice->course_id,
                'start_date' => $notice->start_date,
                'end_date' => $notice->exp_date,
            ];
        }else{
            $data = [
                'notice_type' => 'Other Notice',
                'notice_id' => $notifiable->notice_id,
                'details' => $notice->details,
                'department' => $notice->department->course_for,
                'start_date' => $notice->start_date,
                'end_date' => $notice->exp_date,
            ];
        }


        return $data;
    }
}
