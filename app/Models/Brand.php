<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Brand extends Model
{
    public static $success = 1;
    public static $error = 0;
    public static $success_message = "Data Insert Successfully";
    public static $update_success_message = "Data Updated Successfully";
    public static $delete_success_message = "Data Deleted Successfully";
    use HasFactory;
    protected $fillable = ['category_id', 'name', 'created_by', 'approved_by', 'approved_at', 'updated_by'];

    public static function prepareData($request, $storeORUpdate="store" )
    {
        foreach($request->request as $key => $dd){
            if($key != '_token' && $key != 'id'){
                $data[$key] = $dd;
            }
        }
        if($storeORUpdate != 'update'){
            $data['created_by'] = Auth::user()->id;

            if(Auth::user()->role == 100)
            {
                $data['approved_by'] = Auth::user()->id;
                $data['approved_at'] = date('Y-m-d h:i:s', time());
                $data['status'] = 1;
            }
        }else{
            $data['updated_by'] = Auth::user()->id;
            $data['updated_at'] = date('Y-m-d h:i:s', time());
        }
        
        return $data;
    }

    public static function brands()
    {
        $data = self::query()->get()->where('status', 1);
        return $data;
    }

    public static function store($request)
    {
        $data = self::prepareData($request);
        $res = self::query()->create($data);
        if($res){
            return self::$success;
        }else{
            return self::$error;
        }
    }

    public static function category($id)
    {
        return self::query()->findOrFail($id);
    }
    public static function updateCategory($request)
    {
        $data = self::prepareData($request, 'update');
        $result = self::query()->where('id', $request->id)->update($data);
        return $result;
    }
    public static function deleteCategory($id)
    {
        return self::query()->where('id', $id)->delete();
    }
    public function getNewTabless()
    {
        $tableName = $this->getTable();
        dd($tableName);
    }
}
