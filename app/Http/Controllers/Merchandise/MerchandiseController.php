<?php

namespace App\Http\Controllers\merchandise;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator; //驗證器
use Illuminate\Support\Facades\Storage;

// use Log;
// model
use App\Models\Merchandise;
use App\Models\ProductAblum;
use Illuminate\Http\Resources\Json\JsonResource;

class MerchandiseController extends Controller
{   
    //商品列表
    public function merchandiseList()
    {
        $get_data = Merchandise::get();
        foreach($get_data as $key=>$value){
            $photo=$value['photo'];
            $img_route=$this->img_route($photo);
            $get_data[$key]['photo'] = $img_route;
        }
        return view('Merchandise.product_list_index',['data'=>$get_data]);
    }

    //商品頁面
    public function productIndex()
    {
        //
    }
    //創建商品頁面
    public function createProductPage()
    {
        return view ('Merchandise.createProductPage');
    }
    //創建商品程序
    public function createProductProcess(Request $request)
    {

        // 存圖片
        if(count($_FILES)>0){
            foreach($_FILES as $key =>$file){
            $save_img_status=$this->saveimg($file,$key,$request->id,$request->$key); // saveimg($img,$img_order,$id,$file)
            }
            return response()->json($save_img_status);
        }
        //檢查商品名稱是否重複
            $product_name=Merchandise::pluck('name')->all();
            if($product_name){
                foreach($product_name as $name){
                    if($name == $request['name']){
                        $msg="商品名稱以重複";
                        $response_data=[
                            'status'=>"fail",
                            'msg'=>$msg
                        ];
                        return response()->json($response_data);
                    }
                }
            }

        
        //存商品資料
        $product_data=[
            'status' =>(isset($request['open_status'])?"1":"0"),
            'name' =>$request->name,
            'name_en'=>$request->name_en,
            'introduction'=>$request->introduction,
            'price'=>$request->price,
            'count'=>$request->count,
            'photo'=>'default_img.jpeg' //沒有圖片給一個預設圖
        ];

        Log::info("insert_data");
        Log::info($product_data);

        $create_product=Merchandise::create($product_data)->id;
        
        log::notice($create_product);

        $response_data=[
            'status'=>"success",
            'insert_id'=>$create_product,
        ];

        return response()->json($response_data);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Merchandise $Merchandise)
    {
        //
    }
    //商品編輯頁面
    public function edit($id)
    {
        $product_data=Merchandise::where('id',$id)->first();
        //封面圖
        $product_data['photo']=$this->img_route($product_data['photo']);

        //商品相簿
        $product_ablum=ProductAblum::where('merchandise_id',$id)->get();
        foreach($product_ablum as $key=>$value){
            $product_ablum[$key]['rotue']=$this->img_route($value['photo_name']);
        }
        // dd($product_ablum->toArray());


        return view('merchandise.editProductIndex',['data'=>$product_data,'photo_ablum'=>$product_ablum]);
    }

    public function productUpdateProcess(Request $request, Merchandise $Merchandise)
    {
        // log::info(count($_FILES));
        log::info($request->file());

        if(count($_FILES)>0){
            foreach($_FILES as $key=>$file){
                $update_img=$this->saveimg($file,$key,$request['target_id'],$request->$key);
                log::info($update_img);
            }
        }
        
        //
        $updata=[
            'status'=>($request['open_status'] == "1"?"1":"0"),
            'id'=>$request['id'],
            'name'=>$request['name'],
            'name_en'=>$request['name_en'],
            'count'=>$request['count'],
            'price'=>$request['price'],
            'introduction'=>$request['introduction'],
            'introduction_en'=>$request['introduction_en']
        ];

        $update_product = Merchandise::where('id',$request['id'])->update($updata);
        if($update_product){
            log::info("success");
            $data=[
                "status"=>'200',
                "mag"=>'update_success',
            ];
        }else{
            log::info("fail");
            $data=[
                "status"=>'500',
                "mag"=>'update_fail',
            ];       
        }
        return response()->json(['data'=>$data]);

    }

    public function destroy(Merchandise $Merchandise)
    {
        //
    }

    //存圖片 、修改圖片
    public function saveimg($img,$img_order,$id,$file){

        $file_type=explode('/',$img["type"])[0];
        $file_format=explode('/',$img["type"])[1];
        $file_size=($img["size"]/1048576);//換算成mb;
        $file_name = time().$img_order.".". $file_format;

        //格式判斷
        if($file_type !== "image"){
            $response_data=[
                "msg"=>"請上傳圖片檔案",
            ];
        }else if($file_size > 5){
            $response_data=[
                "msg"=>"上傳檔案過大，請小於5MB",
            ];
        }else{
            //判斷更新圖片這裡做
                $search_img=ProductAblum::where('merchandise_id',$id)->where("photo_order",$img_order)->first();

                if($search_img){

                    $del_img=unlink(base_path('public/product_img/').$search_img["photo_name"]);
                    $data=[
                        "photo_name"=>$file_name,
                        "photo_origin_name"=>$img['name']
                    ];
                    log::warning($search_img);
                    log::warning($data);

                    $update=ProductAblum::find($search_img['id'])->update(["photo_name"=>$file_name,
                    "photo_origin_name"=>$img['name']]);
                    $file->move(base_path('public/product_img/'),$file_name);
                    $response_data=[
                        "status"=>"success",
                        "msg"=>"圖片更新成功"
                    ];
                }else{
                    // 新增圖片這裡做
                    $file->move(base_path('public/product_img/'),$file_name);
                    $photo_info=[
                        'merchandise_id'=>$id,
                        'photo_name'=>$file_name,
                        'photo_origin_name'=>$img['name'],
                        'photo_order'=>$img_order,
                    ];
                    ProductAblum::create($photo_info);

                    $response_data=[
                        "status"=>"success",
                        "msg"=>"圖片上傳成功"
                    ];
                }
        }
        return  $response_data;

    }
    //封面圖片路徑
    public function img_route($photo){
        $img_route ="" ;
        if($photo == "default_img.jpeg"){
            $img_route="../../../public/img/default_img.jpeg";
        }else{
            $img_route = "../../../public/product_img/".$photo;
        }
        return $img_route;
    }
}
