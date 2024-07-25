<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Payement;
use Carbon\Carbon;

class USSDController extends Controller
{
    public function handleUSSD(Request $request)
    {
        $sessionId   = $request->input("sessionId");
        $serviceCode = $request->input("serviceCode");
        $phoneNumber = $request->input("phoneNumber");
        $text        = $request->input("text");

        $response = "";
        $textArray = explode('*', $text);
        $userResponse = trim(end($textArray));
                
        switch ($text) {
            case "":
                // This is the first request. Note how we start the response with CON
                $response  = "CON Welcome to Ifm charity \n";
                $response .= "1. Transaction \n";
                $response .= "2. My phone number \n";
                $response .= "3. Pay for Table \n";
                $response .= "4. Pay for Hall";
                break;

            case "1":
                // Business logic for first level response
                $response = "CON Choose account information you want to view \n";
                $response .= "1. Send Money \n";
                break;

            case "2":
                // Business logic for first level response
                // This is a terminal request. Note how we start the response with END
                $response = "END Your phone number is ".$phoneNumber;
                break;

            case "3":
                // Business logic for table payment
                $response = "CON Choose the type of table \n";
                $response .= "1. Round \n";
                $response .= "2. Square";
                break;

            case "4":
                // Business logic for hall payment
                $response = "CON Choose the type of hall \n";
                $response .= "1. Serengeti \n";
                $response .= "2. Kilimanjaro";
                break;

            case "3*1":
                // Asking for amount for round table payment
                $response = "CON Enter the amount you want to pay for Round Table (TZS)";
                break;

            case "3*2":
                // Asking for amount for square table payment
                $response = "CON Enter the amount you want to pay for Square Table (TZS)";
                break;

            case "4*1":
                // Asking for amount for Serengeti hall payment
                $response = "CON Enter the amount you want to pay for Serengeti Hall (TZS)";
                break;

            case "4*2":
                // Asking for amount for Kilimanjaro hall payment
                $response = "CON Enter the amount you want to pay for Kilimanjaro Hall (TZS)";
                break;

            default:
                // Handle payments confirmation for tables and halls
                if ((isset($textArray[0]) && ($textArray[0] == "3" || $textArray[0] == "4")) && isset($textArray[1]) && isset($textArray[2]) && is_numeric($textArray[2]) && !isset($textArray[3])) {
                    $amount = $textArray[2];
                    if ($amount >= 10) {
                        $itemType = ($textArray[0] == "3" ? ($textArray[1] == "1" ? "Round Table" : "Square Table") : ($textArray[1] == "1" ? "Serengeti Hall" : "Kilimanjaro Hall"));
                        $response = "CON Please confirm the payment for $itemType from $phoneNumber of $amount TZS \n";
                        $response .= "1. Confirm \n";
                        $response .= "2. Cancel";
                    } else {
                        $response = "END Payment cancelled.";
                    }
                } elseif ((isset($textArray[0]) && ($textArray[0] == "3" || $textArray[0] == "4")) && isset($textArray[1]) && isset($textArray[2]) && is_numeric($textArray[2]) && isset($textArray[3])) {
                    $amount = $textArray[2];
                    $confirmation = $textArray[3];
                    $itemType = ($textArray[0] == "3" ? ($textArray[1] == "1" ? "Round Table" : "Square Table") : ($textArray[1] == "1" ? "Serengeti Hall" : "Kilimanjaro Hall"));
                    if ($confirmation == "1") {
                        // Call the method to process the payment
                        $responses = $this->makePayment($phoneNumber, $amount);
                        $response = "END Payment $responses.";
                    } elseif ($confirmation == "2") {
                        $response = "END Payment cancelled.";
                    } else {
                        $response = "END Invalid choice.";
                    }
                } else {
                    $response = "END Invalid choice.";
                }
                break;
        }


        return response($response)->header('Content-type', 'text/plain');
    }

    public function makePayment($phoneNumber, $amount)
    {
        try {
            $createPayment = new Payement();
            $createPayment->status = 'paid';
            $createPayment->phoneNumber = $phoneNumber;
            $createPayment->amount = $amount;
            $createPayment->transaction_id = $this->generateTransactionId();
            $createPayment->created_at = now();
            $createPayment->updated_at = now();
            

            if ($createPayment->save()) {
                $response = "success and transaction id {$createPayment->transaction_id}";
            } else {
                $response= "failed to create payment";
            }
        } catch (\Exception $e) {
            return $response ="failed to create payment: " . $e->getMessage();
        }
        return $response;
    }

    private function generateTransactionId()
    {
        return mt_rand(100000, 999999);
    }

    private function sessions()
    {
        return mt_rand();
    }

}
