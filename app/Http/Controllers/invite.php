<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;

class invite extends Controller
{

    public function list(){


        $limit = 20;
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
        $start_from = ($page-1) * $limit;

        $lists = DB::table('invites')
                ->where('status', 1)
                ->orderBy('time', 'DESC')
                ->offset($start_from)
                ->limit($limit)
                ->get();

        $total_records = DB::table('invites')
                        ->where('status', 1)
                        ->count();

        $totalPages = ceil($total_records / $limit);
        $jm = $page - 1;
        $jp = $page + 1;


        return view('list', ['pagetitle' => "Lists", 'lists' => $lists, 'page' => $page, 'jm' => $jm, 'jp' => $jp, 'totalPages' => $totalPages, ]);
    }



    public function package(Request $request){
        if($request == null){
            return redirect()->route('get.invite');
        }

        $validatedData = $request->validate([
            'fullname' => 'required',
            'nickname' => 'required',
            'email' => 'required|email:rfc,dns,strict,spoof,filter',
            'phone' => 'required|max:11',
            'gender' => 'required',
            'state' => 'required',
            'picture' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $fullname = $request->fullname;
        $nickname = $request->nickname;
        $email = $request->email;
        $phone = $request->phone;
        $gender = $request->gender;
        $state = $request->state;
        $picture = $request->file('picture');
        $picturepath = $picture->path();
        $picturexe = $request->picture->extension();
        $picturencode = base64_encode(file_get_contents($picturepath));
        $picture = 'data:image/' . $picturexe . ';base64,' . $picturencode;

        $length = 10;
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet);

       for ($i=0; $i < $length; $i++) {
           $token .= $codeAlphabet[random_int(0, $max-1)];
       }



        $results = DB::table('invites')->where('email', $email)->count();
        if($results == 1){
            $status = DB::table('invites')->where('email', $email)->value('status');
            if($status == 0){
                $affected = DB::update("update invites set fullname = '$fullname' where email = ?", [$email]);
                $affected = DB::update("update invites set nickname = '$nickname' where email = ?", [$email]);
                $affected = DB::update("update invites set phone = '$phone' where email = ?", [$email]);
                $affected = DB::update("update invites set gender = '$gender' where email = ?", [$email]);
                $affected = DB::update("update invites set state = '$state' where email = ?", [$email]);
                $affected = DB::update("update invites set picture = '$picture' where email = ?", [$email]);
                $tokens = DB::select('select * from invites where email = :id', ['id' => $email]);
                foreach ($tokens as $token) {
                    $token = $token->code;
                }

            }else{
                return $this->sendFailedResponse("This e-mail has already gotten an invite.");
            }

        }else{
            $checkcount = DB::table('invites')->where('code', $token)->count();



            if($checkcount == 0){
                $t=time();
                $insert = DB::table('invites')->insert(
                    ['fullname' => $fullname, 'nickname' => $nickname, 'email' => $email, 'phone' => $phone, 'gender' => $gender, 'state' => $state, 'picture' => $picture, 'code' => $token, 'time' => date("Y-m-d", $t)]
                );
            }else{
                return $this->sendFailedResponse();
            }

        }

        $malesoldoutnoroom = DB::table('invites')->where('gender', 'Male')->where('package', 'Haves')->where('status', 1)->count();
        $malesoldoutroom = DB::table('invites')->where('gender', 'Male')->where('package', 'Elite')->where('status', 1)->count();
        $femalesoldout = DB::table('invites')->where('gender', 'Female')->where('status', 1)->count();

        return view('package', ['pagetitle' => 'Select Package', 'code' => $token, 'gender' => $gender, 'malesoldoutnoroom' => $malesoldoutnoroom, 'malesoldoutroom' => $malesoldoutroom, 'femalesoldout' => $femalesoldout]);
    }

    public function confirm(Request $request){
        if($request == null){
            return redirect()->route('get.invite');
        }
        $code = $request->code;
        $package = $request->package;

        $results = DB::table('invites')->where('code', $code)->count();
        if($results == 1){
            if($package === "Haves" || $package === "Elite" || $package === "Free"){
                $affected = DB::update("update invites set package = '$package' where code = ?", [$code]);

                $datas = DB::select('select * from invites where code = :id', ['id' => $code]);
            }else{
                return $this->sendFailedResponse();
            }
        }else{
            return $this->sendFailedResponse();
        }

        foreach ($datas as $data) {
            $fullname = $data->fullname;
            $nickname = $data->nickname;
            $email = $data->email;
            $phone = $data->phone;
            $state = $data->state;
            $gender = $data->gender;
            $id = $data->id;
            $package = $data->package;
            $code = $data->code;
        }

        return view('confirm', ['pagetitle' => 'Confirm', 'fullname' => $fullname, 'nickname' => $nickname, 'email' => $email, 'phone' => $phone, 'state' => $state, 'gender' => $gender, 'id' => $id, 'package' => $package, 'code' => $code, ]);

    }


    public function done($id){
        $code = $id;
        $results = DB::table('invites')->where('code', $code)->count();
        $data = DB::table('invites')->where('code', $code)->first();
        if($results == 0){
            return redirect()->route('home');
        }
        if($data->status == 0){
            return view('done', ['pagetitle' => 'Activate Your Invite', 'gender' => $data->gender, 'code' => $code, 'status' => $data->status, 'nickname' => $data->nickname, 'barcode' => $data->barcode, 'id' => $data->id]);
        }else{
            return view('done', ['pagetitle' => "$data->nickname's Barcode", 'gender' => $data->gender, 'code' => $code, 'status' => $data->status, 'nickname' => $data->nickname, 'barcode' => $data->barcode, 'id' => $data->id]);
        }


    }

    public function picture($id){
        $code = $id;
        $results = DB::table('invites')->where('code', $code)->count();
        $data = DB::table('invites')->where('code', $code)->first();
        if($results == 0){
            return redirect()->route('home');
        }

            return view('picture', ['pagetitle' => "$data->nickname's Picture", 'picture' => $data->picture, 'id' => $data->id, 'nickname' => $data->nickname]);



    }


    public function img($id){
        $results = DB::table('invites')->where('id', $id)->count();
        $data = DB::table('invites')->where('id', $id)->first();
        if($results == 0){
            return redirect()->route('home');
        }

        if($data->save_image !== null){
            header("Content-type: image/png");
            echo Storage::get("b$data->id.png");
            exit();
        }



        $code_base64 = $data->barcode;
        $code_base64 = explode(';base64,', $code_base64);
        $code_base64 = $code_base64[1];
        $code_binary = base64_decode($code_base64);
        header("Content-type: image/png");

        $file = fopen("$id.png", "wb");
        fwrite($file, $code_binary);
        echo $code_binary;
        fclose($file);


    }

    public function proimg($id){
        $results = DB::table('invites')->where('id', $id)->count();
        $data = DB::table('invites')->where('id', $id)->first();
        if($results == 0){
            return redirect()->route('home');
        }

        if($data->save_image !== null){
            header("Content-type: image/png");
            echo Storage::get("p$data->save_image");
            exit();
        }

        $code_base64 = $data->picture;
        $code_base64 = explode(';base64,', $code_base64);
        $code_base64 = $code_base64[1];
        $code_binary = base64_decode($code_base64);
        $f = finfo_open();
        $mime_type = finfo_buffer($f, $code_binary, FILEINFO_MIME_TYPE);
        $mime_type = explode('/', $mime_type);
        $mime_type = $mime_type[1];

        header("Content-type: image/$mime_type");

        $file = fopen("$data->nickname.$mime_type", "wb");
        fwrite($file, $code_binary);
        echo $code_binary;
        fclose($file);
    }



    public function check(Request $request){
        if($request == null){
            return redirect()->route('get.invite');
        }
        $code = $request->code;
        $pin = $request->pin;
        $resultspin = DB::table('pin')->where('pin', $pin)->where('status', 1)->count();
        if($resultspin !== 1){
            return $this->sendFailedResponseAct('Access Denied');
        }


        $results = DB::table('invites')->where('code', $code)->count();

        $data = DB::table('invites')->where('code', $code)->first();


        if($results == 1){


        if($data->package == "Haves"){
            $malesoldoutnoroom = DB::table('invites')->where('gender', 'Male')->where('package', 'Haves')->where('status', 1)->count();
            if($malesoldoutnoroom >= 70){
                return $this->sendFailedResponseAct('This package has been sold out');
            }
        }elseif($data->package == "Elite"){
            $malesoldoutroom = DB::table('invites')->where('gender', 'Male')->where('package', 'Elite')->where('status', 1)->count();
            if($malesoldoutroom >= 5){
                return $this->sendFailedResponseAct('This package has been sold out');
            }

        }elseif($data->package == "Free"){
            $femalesoldout = DB::table('invites')->where('gender', 'Female')->where('status', 1)->count();
            if($femalesoldout >= 201){
                return $this->sendFailedResponseAct('This package has been sold out');
            }
        }



            if($data->status == 0){
                return view('activate', ['pagetitle' => "Activate $data->nickname", 'fullname' => $data->fullname, 'nickname' => $data->nickname, 'email' => $data->email, 'phone' => $data->phone, 'state' => $data->state, 'gender' => $data->gender, 'package' => $data->package, 'picture' => $data->picture, 'code' => $data->code, 'id' => $data->id, ]);
            }else{
                return $this->sendFailedResponseAct('This Reference Code Has Been Activated');
            }
        }else{
            return $this->sendFailedResponseAct('Reference Code Not Found');
        }


    }

    public function activation(Request $request){
        if($request == null){
            return redirect()->route('get.invite');
        }
        $pin = $request->pin;
        $email = $request->email;
        $resultspin = DB::table('pin')->where('pin', $pin)->where('status', 1)->count();

        if($resultspin !== 1){
            return $this->sendFailedResponseAct('Access Denied');
        }
        $resultsuser = DB::table('pin')->where('pin', $pin)->where('status', 1)->first();

        if(isset($email)){
            $resultscheck = DB::table('invites')->where('email', "$email")->where('status', 0)->count();

            if($resultscheck == 1){

                $dataz = DB::table('invites')->where('email', $email)->first();

                $arr = array(
                    'gradient_stop_color' => '#248316',
                    'fill_style' => 'linearGradient',
                    'inner_eye_style' => 'leaf',
                    'style' => 'classic',
                    'style_color' => '#2F72AE',
                    'inner_eye_color' => '#927d0e',
                    'outer_eye_color' => '#ef4f89',
                    'image' => 'https://i.imgur.com/faKcpfQ.png',
                    'outer_eye_style' => 'leaf',
                    'ec_level' => 'M',
                    'bg_color' => '#FFFFFF',
                    'size' => '1024',
                    'remove_background' => 'false',
                    'format' => 'png',
                    'gradient_angle' => '5',
                    'quiet_zone' => '4',
                    'text' => "https://toffs.ng/p/$dataz->code",
                );
                $arr = http_build_query($arr);
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://qrcode3.p.rapidapi.com/generateQR?" . $arr,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "x-rapidapi-host: qrcode3.p.rapidapi.com",
                        "x-rapidapi-key: ac3666abccmshf6e11c6df4053fap1c86e0jsn582e94c1c942"
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);
                $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);

                if ($err) {
                    return $this->sendFailedResponseAct();
                } else {
                    if($httpCode == 200){
                        $picturencode = base64_encode($response);
                        $barcode = 'data:image/png;base64,' . $picturencode;
                        $affected = DB::update("update invites set barcode = '$barcode' where email = ?", [$email]);

                        $barcodcheck = DB::table('invites')->where('email', "$email")->first();

                        if($barcodcheck->barcode !== null){

                        $affected = DB::update("update invites set status = 1 where email = ?", [$email]);
                        $affected = DB::update("update invites set userACT = '$resultsuser->id' where email = ?", [$email]);
                        }else{
                            return $this->sendFailedResponseAct();
                        }

                    }else{
                        return $this->sendFailedResponseAct();
                    }


                }


                return $this->sendFailedResponseAct("The Invite code $dataz->code has been activated.");

            }else{
                return $this->sendFailedResponseAct();
            }


        }else{
            return $this->sendFailedResponseAct('Access Denied');
        }


    }

    public function count(){
        $malesoldoutnoroom = DB::table('invites')->where('gender', 'Male')->where('package', 'Haves')->where('status', 1)->count();
        $malesoldoutroom = DB::table('invites')->where('gender', 'Male')->where('package', 'Elite')->where('status', 1)->count();
        $femalesoldout = DB::table('invites')->where('gender', 'Female')->where('status', 1)->count();
        $total = DB::table('invites')->where('gender', 'Female')->where('status', 1)->count();

        return view('count', ['pagetitle' => "Count", 'malesoldoutnoroom' => $malesoldoutnoroom, 'malesoldoutroom' => $malesoldoutroom, 'femalesoldout' => $femalesoldout, 'total' => $total]);

    }


    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('get.invite')
            ->withErrors(['msg' => $msg ?: 'An error occured. Please, try again.']);
    }

    protected function sendFailedResponseAct($msg = null)
    {
        return redirect()->route('check')
            ->withErrors(['msg' => $msg ?: 'An error occured. Please, try again.']);
    }


    public function fetch(){



            $results = DB::table('invites')->where('status', 1)->where('save_image', null)->whereNotNull('picture')->whereNotNull('barcode')->count();
            $data = DB::table('invites')->where('status', 1)->where('save_image', null)->whereNotNull('picture')->whereNotNull('barcode')->first();

            if($results == 0){
                exit();
            }




            $code_base64 = $data->barcode;
            $code_base64 = explode(';base64,', $code_base64);
            $code_base64 = $code_base64[1];
            $code_binary = base64_decode($code_base64);
            $f = finfo_open();
            $mime_type = finfo_buffer($f, $code_binary, FILEINFO_MIME_TYPE);
            $mime_type = explode('/', $mime_type);
            $mime_type = $mime_type[1];

            header("Content-type: image/$mime_type");
            $file_name = "b$data->id.$mime_type";
            $file = fopen("$file_name", "wb");
            fwrite($file, $code_binary);

            Storage::disk('local')->put($file_name, $code_binary);

            fclose($file);

            $code_base64 = $data->picture;
            $code_base64 = explode(';base64,', $code_base64);
            $code_base64 = $code_base64[1];
            $code_binary = base64_decode($code_base64);
            $f = finfo_open();
            $mime_type = finfo_buffer($f, $code_binary, FILEINFO_MIME_TYPE);
            $mime_type = explode('/', $mime_type);
            $mime_type = $mime_type[1];

            header("Content-type: image/$mime_type");
            $file_name = "p$data->id.$mime_type";
            $file = fopen("$file_name", "wb");
            fwrite($file, $code_binary);

            Storage::disk('local')->put($file_name, $code_binary);

            fclose($file);


            $affected = DB::update("update invites set save_image = '$data->id.$mime_type' where id = ?", [$data->id]);




    }

    public function sms(){


                $arr = array(
                    'apikey' => '29dd558b-67f2-4471-a0cf-6cbedf418c8e',
                    'bodyHtml' => "
                                        <img src='https://toffs.ng/images/TOFFS-EMAIL.jpg' width='100%' height='auto' />
                                   ",
                    'from' => 'no-reply@56475844.toffs.ng',
                    'fromName' => 'TOFFS TEAM',
                    'isTransactional' => true,
                    'sender' => 'no-reply@56475844.toffs.ng',
                    'senderName' => 'TOFFS TEAM',
                    'subject' => "TOFFS VENUE",
                    'to' => "victemige@gmail.com",
                );

                $arr = http_build_query($arr);
                $curl = curl_init();


                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.elasticemail.com/v2/email/send?" . $arr,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);
                $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);

                if ($err) {
                    return "error";
                } else {
                    echo  $response;
                    }

    }

    public function qrcode($id){
        $code = $id;
        $results = DB::table('invites')->where('code', $code)->count();
        $data = DB::table('invites')->where('code', $code)->first();
        //return "party hard";
        if($results == 0){
            return redirect()->route('home');
        }

            return view('qrcode', ['pagetitle' => "$data->nickname's QR Code", 'id' => $data->id, 'nickname' => $data->nickname, 'fullname' => $data->fullname, 'email' => $data->email, 'phone' => $data->phone, 'state' => $data->state, 'gender' => $data->gender, 'status' => $data->status, 'package' => $data->package, 'deactivate' => $data->deactivate]);



    }


    public function searchAction(Request $request){
        $limit = 20;
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
        $start_from = ($page-1) * $limit;

        $lists = DB::table('invites')->where('nickname', 'LIKE', "%{$request->search}%")->get();
        $total_records = DB::table('invites')->where('nickname', 'LIKE', "%{$request->search}%")->count();

        $totalPages = ceil($total_records / $limit);
        $jm = $page - 1;
        $jp = $page + 1;

        return view('search', ['pagetitle' => "Search", 'lists' => $lists, 'page' => $page, 'jm' => $jm, 'jp' => $jp, 'totalPages' => $totalPages, ]);

    }


}
