<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderInquiryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::info("order_job");
        if ($this->order->order_status_id !== 2) {
            \Log::info("Skipping CheckTransactionStatus for order ID {$this->order->id} as it is not 2.");
            return;
        }
        $setting = Setting::first();
        $merchent = @$setting->merchent;
        try {
            $data = [
                "merchant_id" => $merchent,
                "authority" => $this->order->ref_id,
            ];
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.zarinpal.com/pg/v4/payment/inquiry.json',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Accept: application/json'
                ),
            ));
            $result = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                \Log::error('Error in Bank (CURL): ' . $err);
                $this->order->update([
                    'order_status_id' => 9,
                ]);
            }
            if ($result === false || is_null($result)) {
                \Log::error('Error in Bank: Response is null');
                return;
            }
            $result = json_decode($result, true);
            if (!$result) {
                \Log::error('Error in Bank: JSON decode failed');
                return;
            }
            \Log::info('Result from Bank1: ', $result);
            if (isset($result['data']['code']) && !$result['data']['code'] == 100) {
                \Log::info('Result from Bank2: ', $result);
                $this->order->update([
                    'order_status_id' => 9,
                ]);
            }
            if ($this->order->order_status_id == 2) {
                if (isset($result['data']) && ($result['data']['status'] == 'VERIFIED' || $result['data']['status'] == 'PAID')) {
                    if ($this->order->ref_id == null) {
                        $this->order->update([
                            'order_status_id' => 3,
                            'ref_id' => @$result["data"]["authority"] ? $result["data"]["authority"] : null,
                        ]);
                    } else {
                        $this->order->update([
                            'order_status_id' => 3,
                        ]);
                    }
                } elseif (isset($result['data']) && ($result['data']['status'] == 'FAILED' || $result['data']['status'] == 'REVERSED' || $result['data']['status'] == 'IN_BANK')) {
                    $this->order->update([
                        'order_status_id' => 9,
                    ]);
                }
            }
        } catch (\Exception $e) {
            \Log::error('Error in Bank: ' . $e->getMessage());
            $this->order->update([
                'order_status_id' => 9,
            ]);
        }
    }
}
