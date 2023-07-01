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
        /* return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!'); */
    }


    protected function buildPayload($notifiable, Notification $notification)
    {
        return [
            'id' => $notification->id,
            'type' => method_exists($notification, 'databaseType')
                        ? $notification->databaseType($notifiable)
                        : get_class($notification),
            'data' => $this->getData($notifiable, $notification),
            'read_at' => null,
        ];
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

        if ($notice->notice_sub_type == 1) {
            $data = [
                'notice_id' => $notifiable->notice_id,
                'notice_type_id' => '1',
                'notice_type' => 'Academic Notice',
                'notice_sub_type_id' => '1',
                'notice_sub_type' => 'Admission Notice',
                'details' => $notice->details,
                'session' => $notice->session,
                'department' => $notice->department->course_for,
                'department_id' => $notice->department_id,
                'start_date' => $notice->start_date,
                'end_date' => $notice->exp_date,
            ];
        } elseif($notice->notice_sub_type == 2) {
            $data = [
                'notice_id' => $notifiable->notice_id,
                'notice_type_id' => '1',
                'notice_type' => 'Academic Notice',
                'notice_sub_type_id' => '2',
                'notice_sub_type' => 'College Notice',
                'details' => $notice->details,
                'start_date' => $notice->start_date,
                'end_date' => $notice->exp_date,
            ];
        } elseif ($notice->notice_sub_type == 3) {
            $data = [
                'notice_id' => $notifiable->notice_id,
                'notice_type_id' => '1',
                'notice_type' => 'Academic Notice',
                'notice_sub_type_id' => '3',
                'notice_sub_type' => 'Student Notice',
                'details' => $notice->details,
                'start_date' => $notice->start_date,
                'end_date' => $notice->exp_date,
            ];
        }else{
            $data = [
                'notice_id' => $notifiable->notice_id,
                'notice_type_id' => '1',
                'notice_type' => 'Academic Notice',
                'notice_sub_type_id' => '4',
                'notice_sub_type' => 'Event Notice',
                'details' => $notice->details,
                'start_date' => $notice->start_date,
                'end_date' => $notice->exp_date,
            ];
        }


        return $data;
    }
}
