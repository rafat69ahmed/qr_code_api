<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\QrCodeInformation;
use App\Promotion;
// use App\Promotion;
use Carbon\Carbon;

class QrCodeController extends Controller
{
    //
    public function home()
    {   
        $merchantId = \Request::get( 'currentUser')->id;
        $fromDate   = Carbon::now()->subWeek()->toDateString();
        $tillDate   = Carbon::tomorrow()->toDateString();
        // $promoCodes = Promotion::all();
        $promoCodes = Promotion::where( 'merchantId', $merchantId )
                                ->WhereBetween('created_at',array($fromDate,$tillDate))->paginate(4);
        // return response()->json($merchantId);
        return response()->json($promoCodes);
    }
    public function store(Request $request)
    {
        $validator = \Validator::make( $request->all(), [
            // 'productId'       => 'required|unique:qr_code_informations',
            'merchantId'      => 'required|string|max:200',
            'validity'        => 'required|string|max:200'
            // 'productId'         => 'required|max:255|unique:qr_code_informations'
        ]);

        if ( $validator->fails() ) {
            return response()->json( $validator->errors(), 422 );
        }
        
        $qr = new QrCodeInformation;
        $qr->productId    = $request->input('productId');
        $qr->merchantId   = $request->input('merchantId');
        $qr->userId       = $request->currentUser->id;
        $qr->validity     = $request->input('validity');

        $productId =  QrCodeInformation::where('productId', $request->input('productId'))->first();
        if($productId != null)
        {   
            // $qId = QrCodeInformation::
            $promo = new Promotion;
            // $promo = new Promotion;
            $promo->status = 0;
            $promo->qrCodeInformationId = $productId->id;
            $qrCodeMain = Promotion::where('qrCodeInformationId',$productId->id)->get();
            // $qrCodeMain = Promotion::where('qrCodeInformationId',$productId->id)->get();
            $qrCodeCount = $qrCodeMain->count();
            $promo->promoCode = uniqid();
            $promo->merchantId   = $request->input('merchantId');
            $promo->userId       = $request->currentUser->id;
            $promo->expire_at     = $qr->validity;
            // $promo->promoCode = uniqid().md5(time());
            if($qrCodeCount == 8)
            {
                return response()->json(['qrCode limit reached', $qrCodeCount]);
            }
            else
            {
                $promo->save();
                return response()->json($promo);
            }
        }
        else
        {
        $validator = \Validator::make( $request->all(), [
            'productId'         => 'required|unique:qr_code_informations'
        ]);
            if ( $validator->fails() ) {
                return response()->json( $validator->errors(), 422 );
            }

            $qr->productId = $request->input('productId');
            $qr->save();
            
            $promo = new Promotion;
            // $promo = new Promotion;
            $promo->status = 0;
            $promo->qrCodeInformationId = $qr->id;
            $promo->promoCode = uniqid();
            $promo->merchantId   = $request->input('merchantId');
            $promo->userId       = $request->currentUser->id;
            $promo->expire_at     = $qr->validity;
            $qrCodeMain = Promotion::where('qrCodeInformationId',$productId->id)->get();
            // $qrCodeMain = Promotion::where('qrCodeInformationId',$productId->id)->get();
            $qrCodeCount = $qrCodeMain->count();
            if($qrCodeCount == 8)
            {
                return response()->json(['qrCode limit reached', $qrCodeCount]);
            }
            else
            {
                $promo->save();
                return response()->json($promo);
            }
        }
        // return response()->json( [$qr,'pro code generated'] );
        // return response()->json( "mara khao" );
    }

    public function profile($id = false)
    {
        if($id){
            return response()->json(User::where('id', $id)->get());
        } else {
            return response()->json(User::all());
        }
    }
    public function test(Request $request)
    {
            // $userType = 
            // $start  = $request->startDate;
            // $end    = $request->endDate;
            $merchantId = $request->currentUser->id;
            $fromDate   = $request->startDate;
            $tillDate   = $request->endDate;
            // return response()->json($request->currentUser->id);
            // return response()->json([$fromDate,$tillDate]);
            // $promoCodes = Promotion::all();
            $promoCodes = Promotion::where( 'merchantId', $merchantId )
                                    ->WhereBetween('created_at',array($fromDate,$tillDate))->paginate(4);
            // return response()->json($tillDate);
            return response()->json($promoCodes);
            // return response()->json($request->currentUser);
    }
    public function promoList()
    {
        $merchantId = \Request::get( 'currentUser')->id;
        $promoCodes = Promotion::where( 'merchantId', $merchantId )->paginate(4);
        // return response()->json($tillDate);
        return response()->json($promoCodes);
    }




    
}
