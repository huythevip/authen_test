<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Session;
class UserController extends Controller
{



    public function getRegistrationForm() {
        return view('auth.register');
    }

    public function postRegister(request $request) {
        $this->validate($request, [
            'name' => 'required|min:2|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:6|max:60'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        Session::flash('messageSuccess', 'Please check your email to complete your registration');
        //Generate activate token

        $activateToken = base64_encode($user->email);

        //Send email after registration
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
            $mail->addAddress($request->email);     // Add a recipient

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $activationLink = '<a href="'.route('activate', $activateToken).'">link</a>';

            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Member Registration Confirmation';
            $mail->Body    = 'Congratulations, you\'re officially a <b>member</b> of our site!<br>Click this '.$activationLink.' to finish your registration!';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

        return redirect()->route('home');
    }

    public function getActivate($token) {
        $userEmail = base64_decode($token);
        if ( User::where('email', '=', $userEmail)->count() > 0 ){
            $user =  User::where('email', '=', $userEmail)->first();
            if ( !$user->activated ) {
                $user->activated = true;
                $user->save();

                Session::flash('messageSuccess', 'Successfully activated your account');
                $_SESSION['userSession'] = $user->email;
                return redirect()->route('index');
            }
            else {
                Session::flash('messageFail', 'Account has already been activated!');
                return redirect()->route('login.get');
            };
        }
        else {
            Session::flash('messageFail', 'Cannot find account to activate');
            return redirect()->route('login.get');
        };
    }

}
