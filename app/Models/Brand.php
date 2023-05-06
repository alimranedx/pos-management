<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Brand extends Model
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
        // dd($request->all());
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
        $data = self::query()->with('user')->where('status', 1)->get();
        return $data;
    }

    public static function imageUpload(array $files = [])
    {
        $extention = $files['image']->extension();
        $name = 'Brand_Icon_Image_'.random_int(100000, 999999).time().'.'.$extention;
        $path = $files['image']->storeAS('public/brandImage',$name);
        // dd($path);
    }

    public static function store($request)
    {
        // if($request->hasFile('image'))
        // {
        //     $files = [
        //         'image' =>$request->file('image') ?? ""
        //     ];
        //     $image_upload_result = self::imageUpload($files);
        // }
        
        $data = self::prepareData($request);
        // dd($data);
        DB::beginTransaction();

        try {
            $res = self::query()->create($data);
            // dd($res->id);
            if($res->id){
                BrandCategory::insert([
                    ['category_idss'=> 1, 'brand_id' => 2],
                    ['category_id'=> 3, 'brand_id' => 2]
                ]);
            }

            DB::commit();
            // all good
        } catch (\Exception $e) {
            // dd('ddddee');
            DB::rollback();
            // something went wrong
        }
        // $res = self::query()->create($data);
        if($res){
            return self::$success;
        }else{
            return self::$error;
        }
    }

    public static function brand($id)
    {
        return self::query()->findOrFail($id);
    }
    public static function updateBrand($request)
    {
        $data = self::prepareData($request, 'update');
        $result = self::query()->where('id', $request->id)->update($data);
        return $result;
    }
    public static function deleteBrand($id)
    {
        return self::query()->where('id', $id)->delete();
    }

    public static function duplicateCheck($column_name, $value)   //pass column name and value and the function return's true of false always
    {
        return is_null(self::query()->where($column_name, $value)->first()) ? false : true;
    } 

    public static function updateDuplicateCheck($column_name, $value, $id)
    {
        return is_null(self::query()->where('id', '!=', $id)->where($column_name, $value)->first()) ? false : true;
    }
    
}
