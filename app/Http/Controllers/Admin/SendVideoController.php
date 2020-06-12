<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Repository\VideoRepositoryInterface; 
use Log;
use App\Models\Video;
use Illuminate\Support\Arr;

class SendVideoController extends Controller
{
    /**
     * send post request to example url with guzzle http client.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendWithGuzzle()
    {
        $client = new Client(['verify' => false]);
        try{
            $data = $this->getVideoMap();

            /**
             * Change path from .env with key UAEBARQ_PATH
             * You will find url on uaebarq.php in config directory
             */
            $url = config('uaebarq.path');
            $response = $client->post($url, 
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => json_encode($data)
                ]);

            Log::info($response->getBody()->getContents());
        }catch(RequestException $e){
            Log::error($e->getMessage());
        }

    }

    /**
     * send post request to example url with curl http.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendWithCurl()
    {
        
        $url = config('uaebarq.path');

        $data = $this->getVideoMap();

        //url-ify the data for the POST
        $data_string = http_build_query($data);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

        // for Linux/Mac
        curl_setopt($ch, CURLOPT_CAINFO, '/home/petehouston/certs/cacert.pem');
        // for Windows
        curl_setopt($ch, CURLOPT_CAINFO, 'D:/certs/cacert.pem');            
        
        // In real life you should use something like:
        // curl_setopt($ch, CURLOPT_POSTFIELDS, 
        //          http_build_query(array('postvar1' => 'value1')));
        
        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Skip SSL Verification
        
        //execute post
        $server_output = curl_exec($ch);
        
        if(curl_errno($ch)) {
            echo 'Error: '.curl_error($ch);
        } else {
            echo $result;
        }

        //close connection
        curl_close ($ch);


    }

    /**
     * Get video and map it to array
     * 
     * @return array
     */
    private function getVideoMap()
    {
        $videos = Video::with('user')->get()->groupBy('user.name');

        $videosMap = $videos->map(function ($item, $key) {
            return [
                'option' => $key,
                'value' => $item->count()
            ];
        });

        return $videosMap->values()->all();
    }
}
