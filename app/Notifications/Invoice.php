<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Invoice extends Notification
{
  use Queueable;
  private $invoice_id;
  /**
   * Create a new notification instance.
   */
  public function __construct($invoice_id)
  {
    $this->invoice_id = $invoice_id;
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
  public function toMail($notifiable): MailMessage
  {
    $url = url("/invoiceDateils/" . $this->invoice_id);
    return (new MailMessage)
      ->greeting('مرحبا بك!')
      ->action('روئية فاتورة الجديدة', $url)
      ->line('شكرا لاستخدامك تجربتي');
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toArray(object $notifiable): array
  {
    return [
      //
    ];
  }
}
