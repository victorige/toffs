<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {

            $emailcount = DB::table('invites')->where('status', 1)->where('emailsent', 0)->count();
            if($emailcount !== 0){
                $emailsent = DB::table('invites')->where('status', 1)->where('emailsent', 0)->first();
                $code = $emailsent->code;
                $email = $emailsent->email;
                $id = $emailsent->id;
                $nickname = $emailsent->nickname;

                $arr = array(
                    'apikey' => '29dd558b-67f2-4471-a0cf-6cbedf418c8e',
                    'bodyHtml' => "<b>
                                    <center>
                                        <p>Hi <b>$nickname</b>, here is your invite.</p>
                                        <p><img height='300px' width='300px' src='https://toffs.ng/img/$id.png'/></p>
                                    </center>
                                    </b>",
                    'from' => 'no-reply@7068659887.toffs.ng',
                    'fromName' => 'TOFFS TEAM',
                    'isTransactional' => true,
                    'sender' => 'no-reply@7068659887.toffs.ng',
                    'senderName' => 'TOFFS TEAM',
                    'subject' => "Your invite $code has been activated.",
                    'to' => "$email",
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
                    $result = json_decode($response, true);
                    if($result['success'] == true){
                        $msgid = $result['data']['messageid'];
                        $affected = DB::update("update invites set emailsent = 1 where id = ?", [$id]);
                        $affected = DB::update("update invites set emailIDD = '$msgid' where id = ?", [$id]);
                    }

                }
            }



            $emailcount = DB::table('invites')->where('status', 1)->where('venue', 0)->count();
            if($emailcount !== 0){
                $emailsent = DB::table('invites')->where('status', 1)->where('venue', 0)->first();
                $code = $emailsent->code;
                $email = $emailsent->email;
                $id = $emailsent->id;
                $nickname = $emailsent->nickname;

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
                    'to' => "$email",
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
                    $result = json_decode($response, true);
                    if($result['success'] == true){
                        $msgid = $result['data']['messageid'];
                        $affected = DB::update("update invites set venue = 1 where id = ?", [$id]);
                        $affected = DB::update("update invites set venueidd = '$msgid' where id = ?", [$id]);
                    }

                }
            }














            $emailcount = DB::table('invites')->where('status', 9)->where('emailsent', 1)->count();
            if($emailcount !== 0){
                $emailsent = DB::table('invites')->where('status', 9)->where('emailsent', 1)->first();
                $code = $emailsent->code;
                $email = $emailsent->email;
                $id = $emailsent->id;
                $nickname = $emailsent->nickname;

                $arr = array(
                    'apikey' => '29dd558b-67f2-4471-a0cf-6cbedf418c8e',
                    'bodyHtml' => "
                                        <p>Hi <b>$nickname</b>, your invite has been deactivated.</p>
                                        <p>This is because the picture uploaded by you is not showing your face and it will be an issue at the gate of the venue.</p>
                                        <p>Kindly visit https://toffs.ng and re-register with a clear picture showing your face.</p>
                                        <p>Sorry for any inconveniences, Thanks in anticipation.</p>
                                   ",
                    'from' => 'no-reply@8038575112.toffs.ng',
                    'fromName' => 'TOFFS TEAM',
                    'isTransactional' => true,
                    'sender' => 'no-reply@8038575112.toffs.ng',
                    'senderName' => 'TOFFS TEAM',
                    'subject' => "Your invite $code has been deactivated.",
                    'to' => "$email",
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
                    $result = json_decode($response, true);
                    if($result['success'] == true){
                        $msgid = $result['data']['messageid'];
                        $affected = DB::update("update invites set emailsent = 1 where id = ?", [$id]);
                        $affected = DB::update("update invites set emailIDD = '$msgid' where id = ?", [$id]);
                        $affected = DB::update("update invites set deactivate = 1 where id = ?", [$id]);
                        $affected = DB::update("update invites set barcode = null where id = ?", [$id]);
                        $affected = DB::update("update invites set userACT = 0 where id = ?", [$id]);
                        $affected = DB::update("update invites set status = 0 where id = ?", [$id]);
                    }

                }
            }


            $emailcount = DB::table('invites')->where('status', 7)->where('emailsent', 1)->count();
            if($emailcount !== 0){
                $emailsent = DB::table('invites')->where('status', 7)->where('emailsent', 1)->first();
                $code = $emailsent->code;
                $email = $emailsent->email;
                $id = $emailsent->id;
                $nickname = $emailsent->nickname;

                $arr = array(
                    'apikey' => '29dd558b-67f2-4471-a0cf-6cbedf418c8e',
                    'bodyHtml' => "
                                        <p>Hi <b>$nickname</b>, we at TOFFS are sending this email to inform of the deactivation of your invite due to information reaching us that you won't be available for TOFFS.</p>
                                        <p>It is with due respect and regret that we wont be having you at TOFFS.</p>
                                        <p>We hope to see you at our future event.</p>
                                        <p>Thanks you,</p>
                                        <p>TOFFS MANAGEMENT.</p>
                                   ",
                    'from' => 'no-reply@68120334.toffs.ng',
                    'fromName' => 'TOFFS TEAM',
                    'isTransactional' => true,
                    'sender' => 'no-reply@68120334.toffs.ng',
                    'senderName' => 'TOFFS TEAM',
                    'subject' => "Your invite $code has been deactivated.",
                    'to' => "$email",
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
                    $result = json_decode($response, true);
                    if($result['success'] == true){
                        $msgid = $result['data']['messageid'];
                        $affected = DB::update("update invites set emailsent = 1 where id = ?", [$id]);
                        $affected = DB::update("update invites set emailIDD = '$msgid' where id = ?", [$id]);
                        $affected = DB::update("update invites set deactivate = 1 where id = ?", [$id]);
                        $affected = DB::update("update invites set barcode = null where id = ?", [$id]);
                        $affected = DB::update("update invites set userACT = 0 where id = ?", [$id]);
                        $affected = DB::update("update invites set status = 0 where id = ?", [$id]);
                    }

                }
            }










            $smscount = DB::table('invites')->where('status', 1)->where('sms', 0)->count();
        if($smscount !== 0){
                $smscount = DB::table('invites')->where('status', 1)->where('sms', 0)->first();
                $code = $smscount->code;
                $phone = $smscount->phone;
                $id = $smscount->id;

        $message = "Hello, you can check your TOFFS invite at https://toffs.ng/a/$code";
        $senderid = 'TOFFS.NG';
        $to = "$phone";
        $token = 'z12Xqex7uTsv6jvaFgDeJML1yg1ZL3mxGXudYHyHCeP8NlK4nqOWrCPWOqpVDihlru13hGk153LzUf8INz8NnTxbzDi5EI5KilVX';
        $baseurl = 'https://smartsmssolutions.com/api/json.php?';

        $sms_array = array
        (
        'sender' => $senderid,
        'to' => $to,
        'message' => $message,
        'type' => '0',
        'routing' => 3,
        'token' => $token
        );

        $params = http_build_query($sms_array);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$baseurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

        $response = curl_exec($ch);

        curl_close($ch);
        $result = json_decode($response, true);
        $rcode = $result['code'];
        $affected = DB::update("update invites set sms = '$rcode' where id = ?", [$id]);


        }




        })->everyMinute()->name('sendemail')->withoutOverlapping();



    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
