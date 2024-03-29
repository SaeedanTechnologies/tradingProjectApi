<?php
namespace App\Repositories\Api\TradingAccount;

use App\Helpers\PaginationHelper;
use App\Models\TradingAccount;
use App\Services\GenerateRandomService;
use Carbon\Carbon;



class TradingAccountRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new TradingAccount();

    }

    public function createTradingAccount(array $data)
    {
        $loginId = GenerateRandomService::RandomBrand();
        $tradingAccount = $this->model->create([
            
            'public_key' => GenerateRandomService::getCustomerPublicKey($data['brand_id']),
            'login_id' => $loginId,
            'password' => $loginId,
            'leverage' => $data['leverage'],
            'currency' => $data['currency'],
            'registration_time' => Carbon::now(),
            'brand_id' => $data['brand_id'],
            'status'   => $data['status']
        ]);


        return $tradingAccount;
    }

}
