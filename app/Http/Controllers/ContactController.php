<?php


namespace App\Http\Controllers;


use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        return view('pages.contact', $this->data);
    }

    public function send(ContactRequest $request){

        try{
            $model=new Contact();
            $model->sendMewssage($request);
            session()->flash('alert-success', 'Message sent successfully');
            return redirect(url('/contact'));
        }catch(\Exception $e){
            \Log::error("There was an error while sending a message: " . $e->getMessage());
            session()->flash('alert-danger',"Error while sending message");
            return redirect()->back();
        }
    }
}
