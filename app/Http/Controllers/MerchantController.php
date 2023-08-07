<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\User;
use App\Models\Affiliate;
use App\Services\AffiliateService;
use App\Services\MerchantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MerchantController extends Controller
{
    public function __construct(
        MerchantService $merchantService
    ) {}

    public function index(){
        $merchants = Merchant::with('user')->get();

        return view('Merchant.merchant', compact('merchants'));
    }

    public function create(){
        return view('Merchant.addMerchant');
    }

    public function registerMerchant(
        Request $request,
        MerchantService $merchantService
    ) {
        $data = $request->all();
        $merchantService->register($data);
        
        return redirect()->route('merchant');
    }

    public function editMerchant($id){
        $merchant = Merchant::with('user')->where('id', $id)->first();
        return view('Merchant.addMerchant',compact('merchant'));
    }

    public function updateMerchat(
        Request $request, $id,
        MerchantService $merchantService)
    {
        $merchant = Merchant::where('id', $id)->first();
        $user = User::select('id','name','email','type')->where('id',$merchant->user_id)->first();
        $data = $request->all();

        $merchantService->updateMerchant($user, $data);
        return redirect()->route('merchant');
    }

    public function searchMerchant(
        Request $request,
        MerchantService $merchantService)
    {
        $email = $request->q;
        $merchants =  $merchantService->findMerchantByEmail($email);
        dd($merchants);
        return view('Merchant.merchant', compact('merchants'));
    }

    public function affiliateIndex(){
        $affiliates = Affiliate::with('user', 'merchant')->get();
        return view('Affiliate.affiliate', compact('affiliates'));
    }
    public function affiliateCreate(){
        $merchents = Merchant::all();
        return view('Affiliate.addAffiliate', compact('merchents'));
    }
    public function affiliateStore(
        Request $request,
        AffiliateService $affiliateService
    ) {
        $merchant = Merchant::where('id', $request->merchant_id)->first();
        $email = $request->email;
        $name = $request->name;
        $comission_rate = $request->commission_rate;

        $affiliate =  $affiliateService->register($merchant, $email, $name, $comission_rate);
        
        return redirect()->route('affiliate');
    }
    /**
     * Useful order statistics for the merchant API.
     * 
     * @param Request $request Will include a from and to date
     * @return JsonResponse Should be in the form {count: total number of orders in range, commission_owed: amount of unpaid commissions for orders with an affiliate, revenue: sum order subtotals}
     */
    public function orderStats(Request $request): JsonResponse
    {
        // Retrieve 'from' and 'to' date from the request
        $fromDate = $request->input('from');
        $toDate = $request->input('to');

        // Get total number of orders in the specified range
        $orderCount = Order::whereBetween('created_at', [$fromDate, $toDate])->count();

        // Calculate sum of order subtotals (revenue)
        $revenue = Order::whereBetween('created_at', [$fromDate, $toDate])->sum('subtotal_price');

        // Calculate amount of unpaid commissions for orders with an affiliate
        $unpaidCommissions = Order::where('status', 'unpaid')
            ->whereHas('affiliate')
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->sum(function ($order) {
                return $order->subtotal_price * ($order->affiliate->commission_rate / 100);
            });

        return response()->json([
            'count' => $orderCount,
            'commission_owed' => $unpaidCommissions,
            'revenue' => $revenue,
        ]);
    }
}
