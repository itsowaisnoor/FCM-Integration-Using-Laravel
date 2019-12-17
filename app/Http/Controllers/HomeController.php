<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
       return view('home')->with('users', $users);
    }

    public function sendToSingleUser(Request $request)
    {
        $optionBuilder = new OptionsBuilder();
         $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('FCM Integration using Laravel FCM');
         $notificationBuilder->setBody('I Code to Inspire. I Code to Thrive.')
                            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData([
            'title' => 'FCM Integration using Laravel FCM',
            'body'  => 'I Code to Inspire. I Code to Thrive.',
            'image' => 'https://owaisnoor.info/blog/wp-content/uploads/2019/12/for-web-marketing.jpg',
            'icon'  => 'https://owaisnoor.info/img/favicon.png'
            ]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        // This is the DEVICE ID, you have to get it from your database, every time when user is logging in

        // $user = User::findOrFail($request->id);
        //  use this device id as token
        // $device_id = $user->device_id;

        // $token = "dDQ1aSoT5WQ:APA91bFAeyULoGWCVHWnC2GDTih9gyd3fym6ZqybH3OJtORO_tZkxXcvXpREhnpBj69GBcv0vNfcce84UT8S1LR_I546H9PuiYmIz-fBI_YRmNkpuH0EXES9TmUGNS-dWyBSd-CAcdxJ";

        $token = "cGt2Z_g6WU0:APA91bEDTILdHthOSZr7j3KHuCzUKCJNrYZZbKDC_SCG5UegKgoYwqYDyIhJqSTE0jb4e6rs7L5skrStdVdn-cEGtbZjffCA8cQSNeZDwLyXFIDQ7SQuyF52701GxcREibo48JnTR7pm";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $downstreamResponse->numberSuccess();

       return redirect()->back();
    }

    public function sendAllSingleUsers(Request $request)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('FCM Integration using Laravel FCM');
        $notificationBuilder->setBody('I Code to Inspire. I Code to Thrive.')
                           ->setSound('default');

       $dataBuilder = new PayloadDataBuilder();
       $dataBuilder->addData([
            'title' => 'FCM Integration using Laravel FCM',
            'body'  => 'I Code to Inspire. I Code to Thrive.',
            'image' => 'https://owaisnoor.info/blog/wp-content/uploads/2019/12/for-web-marketing.jpg',
            'icon'  => 'https://owaisnoor.info/img/favicon.png'
        ]);

       $option = $optionBuilder->build();
       $notification = $notificationBuilder->build();
       $data = $dataBuilder->build();

       // This is the DEVICE ID, you have to get it from your database, every time when user is logging in

        $user = User::all();
       //  use this device id as token
       // $device_id = $user->device_id;


       foreach($user as $user){
        $token = "cGt2Z_g6WU0:APA91bEDTILdHthOSZr7j3KHuCzUKCJNrYZZbKDC_SCG5UegKgoYwqYDyIhJqSTE0jb4e6rs7L5skrStdVdn-cEGtbZjffCA8cQSNeZDwLyXFIDQ7SQuyF52701GxcREibo48JnTR7pm";
        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        $downstreamResponse->numberSuccess();
       }
      return redirect()->back();
    }
}
