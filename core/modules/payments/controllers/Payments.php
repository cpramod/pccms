<?php

class Payments extends Common_Controller{
    function __construct(){
        parent::__construct();
        $this->config->load('khalti');
    }

    public function makePayment($id,$postedData){
        $method = $postedData['payment'];
        if($method == 'esewa'){
            $this->esewa($id);
        }
    }

    protected function esewa($id){
        $this->config->load('payments/esewa');
        $url = "https://ir-user.esewa.com.np/epay/main";
        $data = [
            'amt' => 100,
            'pdc' => 0,
            'psc' => 0,
            'txAmt' => 0,
            'tAmt' => 100,
            'pid' => 'job-'.$id,
            'scd' => config('scd'),
            'su' => config('su'),
            'fu' => config('fu')
        ];

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);
    }


    /**
     * khalti verification process
     */
    public function khaltiVerification(){
        $token = $this->input->post('token');
        $amount = $this->input->post('amount');

        $args = http_build_query(array(
            'token' => $token,
            'amount' => $amount
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        //# Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Authorization: Key '.config('khalti_secret')];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        echo json_encode($status_code);
        exit;
    }
}

?>