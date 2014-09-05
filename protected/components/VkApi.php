<?php

class VkApi
{
    public static $accessToken = "9bb31833d0c7176a665f6d4deb32194731b80e2d41b703f70a1e8b17ed2ec1021ef9127ac9e3f8e57057b";
    public static $publicID = "63615166";
    public static $apiUrl = "https://api.vk.com/method/";

    public static function post($text, $link, $img = null){
        // Uploading photo
        $attachmentID = null;
        if($img != null){
            // Getting upload URL
            $imgCurl = curl_init();
            $params = array(
                'group_id' => VkApi::$publicID,
                'access_token' => VkApi::$accessToken
            );

            $url = VkApi::$apiUrl."photos.getWallUploadServer?".http_build_query($params);
            curl_setopt($imgCurl, CURLOPT_URL, $url);
            curl_setopt($imgCurl, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($imgCurl);
            curl_close($imgCurl);

            $data = json_decode($data, true);
            $url = $data["response"]["upload_url"];

            // Uploading photo
            $uploadCurl = curl_init();
            $params = array(
                'file1' => '@'.$img,
            );
            curl_setopt($uploadCurl, CURLOPT_URL, $url);
            curl_setopt($uploadCurl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($uploadCurl, CURLOPT_POST, true);
            curl_setopt($uploadCurl, CURLOPT_POSTFIELDS, $params);
            $data = curl_exec($uploadCurl);
            $data = json_decode($data, true);
            curl_close($uploadCurl);


            // Saving uploaded photo
            $saveCurl = curl_init();
            $params = array(
                'server' => $data['server'],
                'photo' => $data['photo'],
                'hash' => $data['hash'],
                'access_token' => VkApi::$accessToken,
                'group_id' => VkApi::$publicID,
            );
            $url = VkApi::$apiUrl."photos.saveWallPhoto?".http_build_query($params);
            curl_setopt($saveCurl, CURLOPT_URL, $url);
            curl_setopt($saveCurl, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($saveCurl);
            curl_close($saveCurl);
            $data = json_decode($data, true);

           // print_r($data);die;

            $attachmentID = $data["response"][0]["id"];
        }

        // Initializing cURL
        $curl = curl_init();

        $params = array(
            'owner_id' => '-'.VkApi::$publicID,
            'from_group' => 1,
            'message' => $text,
            'access_token' => VkApi::$accessToken
        );

        if($img != null){
            $params["attachments"] = $attachmentID.','.$link;
        }
        else{
            $params["attachments"] = $link;
        }

        $url = VkApi::$apiUrl."wall.post?".http_build_query($params);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($curl);

        curl_close($curl);
    }
}
