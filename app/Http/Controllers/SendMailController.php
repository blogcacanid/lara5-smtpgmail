<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;
use Illuminate\Http\Request;

class SendMailController extends Controller
{
    public function index(){
        return view('formmail');
    }

    public function send(Request $request){
        try{
            Mail::send('isiemail', array('pesan' => $request->pesan) , function($pesan) use($request){
                $pesan->to($request->penerima)->subject('Send Email Dengan SMTP Gmail Laravel 5');
                $pesan->from(env('MAIL_USERNAME','blog.cacan.id@gmail.com'),'BLOG Cacan');
                $pesan->attach('https://i.imgur.com/JVLQCHr.jpg');
	            //dd("Sukses ! Email berhasil dikirim");
            });
        }catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }
}
