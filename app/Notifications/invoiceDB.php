<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class invoiceDB extends Notification
{
  use Queueable;
  protected $invoice_id;
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
    return ['database'];
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toDatabase(object $notifiable): array
  {
    return [
      "id" => $this->invoice_id,
      "title" => "تم اضافة فاتورة جديد بواسطة:",
      "user_add" => \Illuminate\Support\Facades\Auth::user()->name
    ];
  }
}
