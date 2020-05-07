<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\UserDetails;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class RegisterController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function index()
    {
        return view('auth.register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        $this->validate(request(), [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'city' => 'required',
        ]);

        $otp = rand(1000,9999);
        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        $user_details = new UserDetails();
        $user_details->user_id = $user->id;
        $user_details->email = $request->email;
        $user_details->dob = $request->dob;
        $user_details->city = $request->city;
        $user_details->otp = $otp;
        $user_details->save();

        $mail = new PHPMailer(true);
        try{
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;// Enable SMTP authentication
            $mail->Username = env("MAIL_USERNAME"); // SMTP username
            $mail->Password = env("MAIL_PASSWORD"); // SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom(env("MAIL_FROM_ADDRESS"), 'Mailer');
            $mail->addAddress($request->email, $request->username);	// Add a recipient, Name is optional

            //Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Codegreen OTP';
            $mail->Body    = "Your OTP is $otp"; // message

            $mail->send();
        }
        catch(phpmailerException $e){
            dd($e);
        }catch(Exception $e){
            dd($e);
        }
        if($mail){
            return view("auth.otp")->with("user_id", $user->id);
        }else{
            return view("auth.register")->with("result","failed")->with("title","Failed");
        }
    }
}
