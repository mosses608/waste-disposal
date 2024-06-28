<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Message;
use App\Models\News;
use App\Models\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Omnipay\Omnipay;
use App\Models\Transaction;
use Alphaolomi\Azampay\AzampayService as BaseAzampayService;
use GuzzleHttp\Client;
use App\Models\Payment;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function index(){
        return view('welcome');
    }

    public function dashboard(){

         $customersPerDistrict = Customer::select('district', DB::raw('count(*) as total'))
                                    ->groupBy('district')
                                    ->pluck('total', 'district')
                                    ->toArray();

    // Prepare data for charting
    $districts = array_keys($customersPerDistrict);
    $customerCounts = array_values($customersPerDistrict);

        return view('admin-dashboard',[
            'messages' => Message::all(),
            'customers' => Customer::all(),
            'notifications' => Notification::latest()->paginate(5),
            'customerss' => Customer::all(),
        'transactionss' => Transaction::all(),
        'notificationss' => Notification::all(),
        ], compact('districts', 'customerCounts'));
    }

    public function login(Request $request){
        $loginCredentials=$request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::guard('web')->attempt($loginCredentials)){

            $request->session()->regenerateToken();

            return redirect('/admin-dashboard')->with('message','Congratulations, logged in successfully');

        }
        elseif(Auth::guard('customer')->attempt($loginCredentials)){

            $request->session()->regenerateToken();

            return redirect('/casts/cast-dashboard')->with('customer_message','Customer logged in successfully');

        }

        else{
            return redirect()->back()->with('error','Incorrect username or password!');
        }
    }

    public function my_profile(){
        return view('my-profile',[
            'messages' => Message::all(),
            'notifications' => Notification::latest()->paginate(5),
            'customerss' => Customer::all(),
        'transactionss' => Transaction::all(),
        'notificationss' => Notification::all(),
        ]);
    }

    public function delete_message(Request $request , Message $message){
        $message->delete();
        return redirect()->back();
    }


    public function profile_picture(Request $request , User $user){
        $profilePic=$request->validate([
            'profile' => 'required',
        ]);

        if($request->hasFile('profile')){
            $profilePic['profile'] = $request->file('profile')->store('profiles','public');
        }

        $user->update($profilePic);

        return redirect()->back()->with('updated_profile_pic','Profile picture updated successfully');
    }

    public function upadate_profile_data(Request $request , User $user){
        $allProfileData=$request->validate([
            'full_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $user->update($allProfileData);

        return redirect()->back()->with('all_updated','Profile updated successfully');
    }

    public function store_users(Request $request){
        try{
            $userData=$request->validate([
                'full_name' => 'required',
                'email' => 'required',
                'user_role' => 'required',
                'phone_number' => ['required', Rule::unique('users','phone_number')],
                'profile' => 'nullable',
                'username' => ['required', Rule::unique('users','username')],
                'password' => 'required',
            ]);

            if($request->hasFile('profile')){
                $userData['profile'] = $request->file('profile')->store('profiles','public');
            }

            User::create($userData);

            return redirect()->back()->with('user_created','New user created successfully');

        }
        catch(\Exception $e){
           return redirect()->back();
        }
    }

    public function user_logout(Request $request){
        Auth::guard('web')->logout();

        Auth::guard('customer')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('logout_flash_message','User logged out successfully');
    }

    public function store_messages(Request $request){
        $mesageContent=$request->validate([
            'profile' => 'nullable',
            'sender_name' => 'required',
            'message' => 'required',
            'user_role' => 'required',
        ]);

        Message::create($mesageContent);

        return redirect()->back();
    }

    public function create_customer(){
        return view('register-customer',[
            'messages' => Message::all(),
            'notifications' => Notification::latest()->paginate(5),
            'customerss' => Customer::all(),
        'transactionss' => Transaction::all(),
        'notificationss' => Notification::all(),
        ]);
    }

    public function store_customers(Request $request){
        $customerData=$request->validate([
            'full_name' => 'required',
            'phone_number' => ['required', Rule::unique('customers','phone_number')],
            'district' => 'required',
            'street' => 'nullable',
            'street_n' => 'nullable',
            'profile' => 'nullable',
            'house_number' => ['required', Rule::unique('customers','house_number')],
            'registration_date' => 'required',
            'email_value' => 'required',
            'email' => 'nullable',
            'username' => 'required',
            'password' => 'required',
        ]);

        if($request->hasFile('profile')){
            $customerData['profile'] = $request->file('profile')->store('customers','public');
        }

        Customer::create($customerData);

        //dd($request);

        return redirect()->back()->with('customer_created','Customer registered successfully!');
    }

    public function get_customers(){
        return view('view-customers',[
            'customers' => Customer::latest()->paginate(15),
            'messages' => Message::all(),
            'notifications' => Notification::latest()->paginate(5),
            'customerss' => Customer::all(),
        'transactionss' => Transaction::all(),
        'notificationss' => Notification::all(),
        ]);
    }

    public function show_single_account($id){
        return view('customer-account',[
            'customer' => Customer::find($id),
            'messages' => Message::all(),
            'notifications' => Notification::latest()->paginate(5),
            'customerss' => Customer::all(),
        'transactionss' => Transaction::all(),
        'notificationss' => Notification::all(),
        ]);
    }

    public function edit_account(Request $request , Customer $customer){
        $customerAccountDetails=$request->validate([
            'full_name' => 'required',
            'phone_number' => 'required',
            'district' => 'required',
            'street' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required|min:7',
        ]);

        $customer->update($customerAccountDetails);

        //dd($request);

        return redirect()->back()->with('customer_edited','Customer account updated successfully');
    }

    public function delete_account(Request $request , Customer $customer){

        $customer->delete();

        return redirect('/view-customers')->with('delete_message','Customer account deleted successfully');
    }

    public function payment_processing(){
        return view('transaction-processing',[
            'customers' => Customer::latest()->paginate(15),
            'messages' => Message::all(),
            'notifications' => Notification::latest()->paginate(5),
            'customerss' => Customer::all(),
        'transactionss' => Transaction::all(),
        'notificationss' => Notification::all(),
        ]);
    }

    public function payments($id){
        return view('payments',[
            'customer'=> Customer::find($id),
            'messages' => Message::all(),
            'notifications' => Notification::latest()->paginate(5),
            'customerss' => Customer::all(),
        'transactionss' => Transaction::all(),
        'notificationss' => Notification::all(),
        ]);
    }

    public function news_updates(){
        return view('post-news-updates',[
            'messages' => Message::all(),
            'news' => News::latest()->paginate(2),
            'notifications' => Notification::latest()->paginate(5),
            'customerss' => Customer::all(),
        'transactionss' => Transaction::all(),
        'notificationss' => Notification::all(),
        ]);
    }

    public function store_news(Request $request){
        $newsDetails=$request->validate([
            'news_content' => 'required',
            'attachment' => 'nullable',
        ]);

        if($request->hasFile('attachment')){
            $newsDetails['attachment'] = $request->file('attachment')->store('attachments','public');
        }

        News::create($newsDetails);

        return redirect()->back()->with('news_posted','News upadstes posted successfully!');
    }

    public function update_news(Request $request, News $updates){
        $updates->delete();
        return redirect()->back();
    }


    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function process_payments(Request $request){
        try {
            $response = $this->gateway->purchase([
                'amount' => $request->amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('cancel')
            ])->send();

            if ($response->isRedirect()) {
                return $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }


    public function success(Request $request){
        if($request->input('paymentId') && $request->input('PayerID')){
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));

            $response= $transaction->send();

            if($response->isSuccessful()){
                $arr = $response->getData();

                $payment =new Transaction();
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email= $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency= env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];

                $payment->save();

                return redirect()->back()->with('success' , 'Payment successfully processed. Payment is successfull with a transaction id : '.$arr['id']);
            }else{
                return $response->getMessage();
            }
        }else{
            return "Payment declined!";
    }
}

    public function cancel(){
        return "User declined the payment!";
    }

    public function view_payments(){
        return view('view-payments',[
            'notifications' => Notification::latest()->paginate(5),
            'messages' => Message::all(),
            'customers' => Customer::paginate(15),
            'transactions' => Transaction::latest()->paginate(15),
            'customerss' => Customer::all(),
        'transactionss' => Transaction::all(),
        'notificationss' => Notification::all(),
        ]);
    }

    public function outdated_transaction(Request $request, Transaction $transaction){
        $transaction->delete();

        return redirect()->back()->with('outdated_transaction','Transaction history deleted successfully');
    }

    public function all_nitications(){
        return view('view-notifications',[
            'customers' => Customer::all(),
            'notifications' => Notification::paginate(10),
            'messages' => Message::all(),
            'customerss' => Customer::all(),
            'transactionss' => Transaction::all(),
            'notificationss' => Notification::all(),
        ]);
    }


    //CUSTOMER SETUPS
    public function customer_dashboard(){
        return view('casts.cast-dashboard',[
            'notifications' => Notification::paginate(10),
            'messages' => Message::all(),
            'news' => News::latest()->paginate(5),
            'customerss' => Customer::all(),
            'transactionss' => Transaction::all(),
            'notificationss' => Notification::all(),
        ]);
    }

    public function customer_pay(){
        return view('casts.payments',[
            'messages' => Message::all(),
            'notifications' => Notification::paginate(10),
            'news' => News::latest()->paginate(5),
            'customerss' => Customer::all(),
            'transactionss' => Transaction::all(),
            'notificationss' => Notification::all(),
        ]);
    }

    public function payment_history(){
        return view('casts.my-payment-history',[
            'messages' => Message::all(),
            'notifications' => Notification::paginate(10),
            'news' => News::latest()->paginate(5),
            'transactions' => Transaction::latest()->paginate(5),
            'customerss' => Customer::all(),
            'transactionss' => Transaction::all(),
            'notificationss' => Notification::all(),
        ]);
    }

    public function notifications(){
        return view('casts.send-notifications',[
            'messages' => Message::all(),
            'notifications' => Notification::paginate(10),
            'news' => News::latest()->paginate(5),
            'transactions' => Transaction::latest()->get(),
            'customerss' => Customer::all(),
            'transactionss' => Transaction::all(),
            'notificationss' => Notification::all(),
        ]);
    }

    public function store_notifications(Request $request){
        $customerNotifications=$request->validate([
            'full_name' => 'required',
            'phone_number' => 'required',
            'payment_status' => 'nullable',
            'date_paid' => 'nullable',
            'notification_content' => 'required',
            'profile' => 'nullable',
        ]);

        Notification::create($customerNotifications);

        //dd($request);

        return redirect()->back()->with('notification_sent','Notification sent successfully');

    }

    public function my_suggestions(){
        return view('casts.my-suggestions',[
            'messages' => Message::all(),
            'notifications' => Notification::paginate(5),
            'news' => News::latest()->paginate(5),
            'transactions' => Transaction::latest()->get(),
            'customerss' => Customer::all(),
            'transactionss' => Transaction::all(),
            'notificationss' => Notification::all(),
        ]);
    }

    public function show_profile($id){
        return view('casts.my-profile',[
            'messages' => Message::all(),
            'notifications' => Notification::paginate(5),
            'news' => News::latest()->paginate(5),
            'transactions' => Transaction::latest()->get(),
            'customer' => Customer::find($id),
            'customerss' => Customer::all(),
            'transactionss' => Transaction::all(),
            'notificationss' => Notification::all(),
        ]);
    }

    public function update_profile_pic(Request $request, Customer $customer){
        $profilePic=$request->validate([
            'profile' => 'required',
        ]);

        if($request->hasFile('profile')){
            $profilePic['profile'] = $request->file('profile')->store('customers','public');
        }

        $customer->update($profilePic);

        return redirect()->back();
    }

    public function update_customer_data(Request $request, Customer $customer){
        $cudtomerData=$request->validate([
            'full_name' => 'required',
            'phone_number' => 'required',
            'district' => 'required',
            'street' => 'nullable',
            'street_n' => 'nullable',
            'house_number' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $customer->update($cudtomerData);

        return redirect()->back()->with('customer_updated','Profile updated successfully');
    }



/*
    protected $azampay;

    public function __construct(BaseAzampayService $azampay)
    {
        $this->azampay = $azampay;
    }

    public function mobileCheckout(Request $request)
    {
        $data = $this->azampay->mobileCheckout([
            'amount' => $request->amount,
            'currency' => 'TZS',
            'accountNumber' => $request->accountNumber,
            'externalId' => $request->externalId,
            'provider' => 'Mpesa',
        ]);

        // Process response and return appropriate view or JSON response
    }

    public function getPaymentPartners()
    {
        $data = $this->azampay->getPaymentPartners();

        // Process response and return appropriate view or JSON response
    }

    public function postCheckout(Request $request)
    {
        $data = $this->azampay->postCheckout([
            'appName' => env('AZAMPAY_APP_NAME'),
            'clientId' => env('AZAMPAY_CLIENT_ID'),
            'vendorId' => env('AZAMPAY_CLIENT_SECRET'),
            'language' => 'en',
            'currency' => 'TZS',
            'externalId' => $request->externalId,
            'requestOrigin' => 'wastedemoapp.000webhostapp.com',
            'redirectFailURL' => route('failure'),
            'redirectSuccessURL' => route('success'),
            'vendorName' => 'wastedemoapp',
            'amount' => $request->amount,
            'cart' => [
                'items' => [
                    [
                        'name' => 'wastedemoapp',
                    ],
                ],
            ],
        ]);

        /
    }

    public function success(Request $request)
    {

        Payment::create([
            'amount' => $request->amount,
            'status' => 'success',
        ]);


        return redirect()->back();
    }

    public function failure()
    {

        return "Transaction declined";
    }
*/

public function payment_report(){
    return view('generate-report',[
        'notifications' => Notification::paginate(10),
        'messages' => Message::all(),
        'transactions' => Transaction::latest()->filter(request(['search']))->paginate(10),
        'customerss' => Customer::all(),
        'transactionss' => Transaction::all(),
        'notificationss' => Notification::all(),
    ]);
}
}
