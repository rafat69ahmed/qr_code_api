<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\QrCodeInformation;
use App\Promotion;
use Carbon\Carbon;

class QrCodeController extends Controller
{
    //
    public function home()
    {
        $fromDate = Carbon::now()->subWeek()->toDateString();
        $tillDate = Carbon::now()->toDateString();
        $promoCodes = Promotion::WhereBetween('created_at',array($fromDate,$tillDate))->get();
        return response()->json($promoCodes);
        // return response()->json([$fromDate,$tillDate]);
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
        $qr->validity     = $request->input('validity');

        $productId =  QrCodeInformation::where('productId', $request->input('productId'))->first();
        if($productId != null)
        {   
            // $qId = QrCodeInformation::
            $promo = new Promotion;
            $promo->status = 0;
            $promo->qrCodeInformationId = $productId->id;
            $qrCodeMain = Promotion::where('qrCodeInformationId',$productId->id)->get();
            $qrCodeCount = $qrCodeMain->count();
            $promo->promoCode = uniqid().md5(time());
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
            $promo->status = 0;
            $promo->qrCodeInformationId = $qr->id;
            $promo->promoCode = uniqid().md5(time());
            $qrCodeMain = Promotion::where('qrCodeInformationId',$productId->id)->get();
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
}
