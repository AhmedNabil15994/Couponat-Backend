<?php

namespace Modules\Core\Packages\SMS;

class SmsBox
{
    public function __construct()
    {
        $this->username              = config("services.sms.sms_box.username");
        $this->password              = config("services.sms.sms_box.password");
        $this->customerId            = config("services.sms.sms_box.customerId");
        $this->senderText            = config("services.sms.sms_box.senderText");
        $this->defdate               = config("services.sms.sms_box.defdate");
        $this->isBlink               = config("services.sms.sms_box.isBlink");
        $this->isFlash               = config("services.sms.sms_box.isFlash");
    }


    public function send($message, $phone)
    {
        try {
            $phone = preg_replace('/^(\+?965)/', '', $phone, 1);
            $phone =  '965' . $phone;

            $data = [
                "username"      => $this->username ,
                "senderText"    => $this->senderText,
                "password"      => $this->password,
                "customerId"    => $this->customerId,
                "defdate"       => $this->defdate,
                "isBlink"       => $this->isBlink,
                "isFlash"       => $this->isFlash,
                "messageBody"   => __('authentication::api.register.messages.code_send', ["code" => $message]),
                "recipientNumbers" => $phone,
            ];

            $result =  $this->request($data);
            if($result["Result"] != "true") {
                throw new \Exception("Error in phone . ". $phone. " Response : " . json_encode($result));
            }
            return $result;
        } catch (\Exception $e) {
            \Bugsnag\BugsnagLaravel\Facades\Bugsnag::notifyException($e);
            return ["Result" => "false"];
        }
    }

    public function request($data)
    {
        $query = http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.smsbox.com/SMSGateway/Services/Messaging.asmx/Http_SendSMS?".$query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        return $this->parse($result);
    }

    public function parse($result)
    {
        $result = str_replace(array("\n", "\r", "\t"), '', $result);
        $result = trim(str_replace('"', "'", $result));
        $simpleXml = simplexml_load_string($result);

        $json = json_encode($simpleXml);
        return json_decode($json, true);
    }
}
