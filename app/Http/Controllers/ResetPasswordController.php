<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Session;
use App\User;
use App\ResetPassword;
class ResetPasswordController extends Controller
{

    public function __construct() {
        $this->middleware('auth.manual');
    }

    public function postResetPassword(request $request) {
        if ( User::where('email', '=', $request->recoveryEmail)->count() > 0 ) {
            $user = User::where('email', '=', $request->recoveryEmail)->first();
            $recoveryToken = $user->password;

            $userForgotPassword = new ResetPassword;
            $userForgotPassword->email = $request->recoveryEmail;
            $userForgotPassword->token = $recoveryToken;
            $userForgotPassword->save();

            //Send recovery email
            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'huy.thevip@gmail.com';                 // SMTP username
                $mail->Password = 'hellokitty123';                           // SMTP password
                $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('huy.thevip@gmail.com', 'Andy Devstic');
                $mail->addAddress($request->recoveryEmail);     // Add a recipient

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                //Content
                $content = "<h2>Please click the link below to change your password</h2><br><a href="."'".route('reset.password')."/token=".$recoveryToken."'>Link</a>";
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Authentication Site\'s password recovery email!!';
                $mail->Body    = $content;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Recovery email has been sent';
            } catch (Exception $e) {
                echo 'Recovery email could not be sent. Mailer Error: ', $mail->ErrorInfo;
            };

            Session::flash('messageSuccess', 'Please check your email for password change');
            return redirect()->back();
        }
        else {
            Session::flash('messageFail', 'Email not found');
            return redirect()->back();
        };
    }

    public function getSetNewPassword($token) {
        if ( ResetPassword::where('token', '=', $token)->count() > 0 ) {
            $user = ResetPassword::where('token', '=', $token)->first();
            return view('auth.resetpassword', [
               'user' => $user,
               'token' =>$token,
            ]);
        }
    }

    public function postUpdatePassword(request $request) {
        $this->validate($request, [
           'password' => 'required|min:6|max:60|confirmed',
        ]);
        $user = User::where('email', '=', $request->userChangePassword)->first();
        $user->password = md5($request->password);
        $user->save();

        //Clear Password reset table for security
        ResetPassword::where('email', '=', $user->email)->delete();

        Session::flash('messageSuccess', 'Updated Password Successfully');
        return redirect()->route('login.get');
    }
}
