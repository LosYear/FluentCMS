<?php

class FacebookApi
{

    public static $access_token = "CAAIlZBGaQGRMBAOQNFHy4zR6xZACVgEQfbiZAuyOIBtiyS5tn5ZBrEj4Ws5kdfmExLS1TS5dqeX4NN655xNnoWLw0S4LImR40o96tMECSfUWkCIGglBZBPznZCYXMnwZCPUARmyVibZCt7sgcg5PbfRpu9oam0eIWWMq0qvRO3ZCnF6OwIUTzcVdo";
    public static $publicID = "1449076551981244";
    public static $pageAccessToken = "CAAIlZBGaQGRMBADRFpBX8Bd6pvSCqlVIC0jIKtW68LuyAHwtfA6iclJ6aMCH2wbZAX7D8NrK9DFAukMUeH4cmraDrhbMvbzYJfIRPRKYHyFbxsI6XqMHvTUm8H6W2ExkSu6MSOBla76AZCxZABRgW5iPvf3NLdxLmGlNNIZCqmbjVNyQRBivl0zZAwaPur8wQZD";
    public static $apiURL = "https://graph.facebook.com/";

    public static function postLink($link, $name = null, $description = null, $picture = null)
    {
        $curl = curl_init();
        $params = array(
            'access_token' => FacebookApi::$pageAccessToken,
            'link' => $link,
        );
        if (!is_null($name)) {
            $params['name'] = $name;
        }
        if (!is_null($description)) {
            $params['description'] = $description;
        }
        if (!is_null($picture)) {
            $params['picture'] = $picture;
        }

        curl_setopt($curl, CURLOPT_URL, FacebookApi::$apiURL . FacebookApi::$publicID . '/feed');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        $data = curl_exec($curl);
        //$data = json_decode($data, true);
        curl_close($curl);
    }
}
?>