<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;

class SubscriptionRenew extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:renew';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking subscriptions status, auto renew if expired';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expiredSubscriptions = Subscription::where('subscribe_till', '<', now())
            ->where('is_subscribed', 1)
            ->get();

        if (count($expiredSubscriptions) > 0) {
            foreach ($expiredSubscriptions as $sub) {
                $sub->update([
                    'subscribe_till' => now()->addMonth(),
                ]);
            }
        }
    }
}
