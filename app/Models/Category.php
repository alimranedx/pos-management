<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Category extends Model
{
    public static $success = 1;
    public static $error = 0;
    public static $success_message = "Data Insert Successfully";
    public static $update_success_message = "Data Updated Successfully";
    public static $delete_success_message = "Data Deleted Successfully";
    public static $duplicate_entry_message = "Data Already Exist !!";
    use HasFactory;
    protected $fillable = ['name', 'created_by', 'approved_by', 'approved_at', 'updated_by'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function prepareData($request, $storeORUpdate="store" )
    {
        foreach($request->request as $key => $request_data){
            if($key != '_token' && $key != 'id'){
                $data[$key] = $request_data;
            }
        }
        if($storeORUpdate != 'update'){
            $data['created_by'] = Auth::user()->id;
            $data['is_active'] = 1;
            if(Auth::user()->role == 100)    //super admin 100
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

    public static function categories()
    {
        $data = self::query()->with('user')->where('status', 1)->get();
        return $data;
    }

    public static function duplicateCheck($column_name, $value)   //pass column name and value and the function return's true of false always
    {
        return is_null(self::query()->where($column_name, $value)->first()) ? false : true;
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
}
