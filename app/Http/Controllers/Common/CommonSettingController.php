<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Statusmange;

class CommonSettingController extends Controller
{   
    public function checkRecord($table = '',$fieldname = 'id', $id) {
        try {
            return DB::table($table)->where($fieldname,$id)->first();
        } catch (\Exception $e) {
         
        }
    }   

    public function getStatus(){
        try {
            return Statusmange::where('status','!=','0')->get();
        } catch (\Exception $e) {
            
        }
    }

    public function editEnv($data = null)
    {
        try {
            $envFile = app()->environmentFilePath(); // get env file path
            $str = file_get_contents($envFile); // get content of file
            foreach ($data as $key => $value) {
                // echo $key .'<br>';
                $str .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$key}=");
                
                if($keyPosition) {
                    $trimeValue = preg_replace('/\s+/', '', $value);
                   $endOfLinePosition = strpos($str, PHP_EOL, $keyPosition);
                   
                   $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                   $trimeValue = str_replace('#','',$trimeValue);
                   $str = str_replace($oldLine, "{$key}={$trimeValue}", $str);
                   $str = substr($str, 0, -1);
                   
                }
                // else {
                //     // return $Response =['message'=>'Key not avilable.','color'=>'danger'];
                //     break;
                // }
                
            }

            $fp = fopen($envFile, 'w');
            fwrite($fp, $str);
            fclose($fp);
            return $Response =['message'=>'Setting changes saved.','color'=>'success'];
            
        } catch (\Exception $e) {
            return $Response =['message'=>$e->getMessage(),'color'=>'danger'];
        }
    }
}
