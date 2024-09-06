<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Storage;

class SendFileNotification extends Notification
{
     use Queueable;

    
    public $name;
    public $email;
    public $phone;

  

    /**
     * Create a new notification instance.
     */
    public function __construct($name, $email, $phone)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        
        $pdfPath = asset('storage/global_brochure.pdf');

        return (new MailMessage)
        ->subject('The Global Address Brochure ')
        ->greeting('Hello, '. $this->name)
        ->line('Here is your Brochure File')
        ->line('You can download it using the button below:')
        ->action('Download Brochure', $pdfPath)  // Use the URL here
        ->line('Thank you')
        ->salutation('Best regards,')
        ->salutation('The Global Address');
    }
    

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }
}
