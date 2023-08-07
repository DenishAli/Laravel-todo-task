<?php

namespace App\Services;

use App\Exceptions\AffiliateCreateException;
use App\Mail\AffiliateCreated;
use App\Models\Affiliate;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AffiliateService
{
    public function __construct(
        protected ApiService $apiService
    ) {}

    /**
     * Create a new affiliate for the merchant with the given commission rate.
     *
     * @param  Merchant $merchant
     * @param  string $email
     * @param  string $name
     * @param  float $commissionRate
     * @return Affiliate
     */
    public function register(Merchant $merchant, string $email, string $name, float $commissionRate): Affiliate
    {
        // Create a new User
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->type = User::TYPE_AFFILIATE;
        $user->save();

        $discountCode = $this->apiService->createDiscountCode($merchant);

        // Create a new Merchant
        $affiliate = new Affiliate();
        $affiliate->user_id = $user->id;
        $affiliate->merchant_id = $merchant->id;
        $affiliate->commission_rate = $commissionRate;
        $affiliate->discount_code = $discountCode['code'];
        $affiliate->save();

        return $affiliate;
    }
}
