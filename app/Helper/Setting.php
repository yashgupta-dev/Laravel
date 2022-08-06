<?php
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Models\Setting;

if (! function_exists('editSetting')) {
    function editSetting($code, $data,$store = 0) {
        try{
            \DB::table('settings')->where('code', $code)->delete();

            foreach ($data as $key => $value) {
                if (substr($key, 0, strlen($code)) == $code) {
                    if (!is_array($value)) {
                        \DB::table('settings')->insert([
                            'code' => $code,
                            'key' => $key,
                            'value' => $value,
                            'serialized' => 0,
                        ]);
                    } else {
                        \DB::table('settings')->insert([
                            'code' => $code,
                            'key' => $key,
                            'value' => json_encode($value),
                            'serialized' => 1,
                        ]);
                    }
                } 
            }
            return $code.' configuration saved.';
        } catch (\Exception $e) {
            return $e->getMessage(); 
        }
    }
}

if (! function_exists('getSetting')) {
    function getSetting($code,$store = 0) {
        $setting_data = array();

        $query = \DB::table('settings')->where('code', $code)->get();
        foreach ($query as $result) {
			if (!$result->serialized) {
                $setting_data[$result->key] = $result->value;
			} else {
                $setting_data[$result->key] = json_decode($result->value, true);
			}
		}
        
		return $setting_data;
    }
}