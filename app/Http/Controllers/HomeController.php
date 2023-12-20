<?php
namespace App\Http\Controllers;

use App\User;
use Modules\Hotel\Models\Hotel;
use Modules\Location\Models\LocationCategory;
use Modules\Page\Models\Page;
use Modules\News\Models\NewsCategory;
use Modules\Booking\Events\BookingCreatedEvent;
use Modules\News\Models\Tag;
use Illuminate\Support\Facades\Log;
use Modules\News\Models\News;
use Modules\Location\Models\Location;
use Modules\Booking\Models\Booking;
use Modules\Tour\Models\Tour;
use Modules\Booking\Models\BookingPassenger;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Modules\User\Events\SendMailUserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     protected $booking;
    public function __construct(Booking $booking)
    {

        $this->booking = $booking;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $home_page_id = setting_item('home_page_id');
        if($home_page_id && $page = Page::where("id",$home_page_id)->where("status","publish")->first())
        {
         
            $this->setActiveMenu($page);
            $translation = $page->translate();
            $seo_meta = $page->getSeoMetaWithTranslation(app()->getLocale(), $translation);
            $seo_meta['full_url'] = url("/");
            $seo_meta['is_homepage'] = true;
            $data = [
                'row'=>$page,
                "seo_meta"=> $seo_meta,
                'translation'=>$translation,
                'is_home' => true,
            ];
            return view('Page::frontend.detail',$data);
        }
        $model_News = News::where("status", "publish");
        $data = [
            'rows'=>$model_News->paginate(5),
            'model_category'    => NewsCategory::where("status", "publish"),
            'model_tag'         => Tag::query(),
            'model_news'        => News::where("status", "publish"),
            'breadcrumbs' => [
                ['name' => __('News'), 'url' => url("/news") ,'class' => 'active'],
            ],
            "seo_meta" => News::getSeoMetaForPageList()
        ];
        return view('News::frontend.index',$data);
    }

    public function checkConnectDatabase(Request $request){
        $connection = $request->input('database_connection');
        config([
            'database' => [
                'default' => $connection."_check",
                'connections' => [
                    $connection."_check" => [
                        'driver' => $connection,
                        'host' => $request->input('database_hostname'),
                        'port' => $request->input('database_port'),
                        'database' => $request->input('database_name'),
                        'username' => $request->input('database_username'),
                        'password' => $request->input('database_password'),
                    ],
                ],
            ],
        ]);
        try {
            DB::connection()->getPdo();
            $check = DB::table('information_schema.tables')->where("table_schema","performance_schema")->get();
            if(empty($check) and $check->count() == 0){
                return $this->sendSuccess(false , __("Access denied for user!. Please check your configuration."));
            }
            if(DB::connection()->getDatabaseName()){
                return $this->sendSuccess(false , __("Yes! Successfully connected to the DB: ".DB::connection()->getDatabaseName()));
            }else{
                return $this->sendSuccess(false , __("Could not find the database. Please check your configuration."));
            }
        } catch (\Exception $e) {
            return $this->sendError( $e->getMessage() );
        }
    }

    public function indexWizard(){


        

        return view('home_wizard');

    }


    public function indexTickets(){
        return view('home_wizard_tickets');

    }

    public function indexMorchid(){

        return view('home_wizard_morchid');

    }
    public function getHotelsMadina(){

        $data = Hotel::select('bravo_hotels.*','media_files.file_path')
        ->leftJoin('media_files','media_files.id','=','bravo_hotels.image_id')
        ->get();



return response()->json($data);



    }

    public function getHotelsMekkah(){

        $data = Hotel::select('bravo_hotels.*','media_files.file_path')
        ->leftJoin('media_files','media_files.id','=','bravo_hotels.image_id')
        ->get();
        
        
        
        return response()->json($data);
        
    }

    public function getVillages(){


        $dataLocations = Location::where('type_location',false)->get();


        return response()->json($dataLocations);


    }

    public function getMazarat(){
        $dataLocations = Tour::where('type',2)->get();


        return response()->json($dataLocations);

    }


    public function getNusuk(){
        $dataLocations = Tour::where('type',3)->get();


        return response()->json($dataLocations);

    }

    public function bookingTachira(Request $request){

    //$vendor = $request->user()->id;
    $booking  =  $this->booking ;
    $booking->first_name = $request->input('first_name');
    $booking->last_name = $request->input('last_name');
    $booking->email = $request->input('email');
    $booking->phone = $request->input('phone');
   
    $booking->city = $request->input('residance');
    //$booking->state = $request->input('state');
    //$booking->zip_code = $request->input('zip_code');
    $booking->country = $request->input('nationality');
    $booking->total_guests =  $request->input('nb_person'); 
    $booking->object_id =   $request->input('ticket_type');
    $booking->object_model =   'tour';
    $booking->gateway =  'offline_payment'; 
    $booking->gateway =  'offline_payment'; 
    $booking->status = 'processing';
    $booking->customer_notes = $request->input('ticket_type');


    $this->checkOrCreate($request) ; 
  $this->savePassengers($booking,$request);
    //$booking->gateway = $payment_gateway;
   // $booking->wallet_credit_used = floatval($credit);
   // $booking->wallet_total_used = floatval($wallet_total_used);
    //$booking->pay_now = floatval((int)$booking->deposit == null ? $booking->total : (int)$booking->deposit);
    event(new BookingCreatedEvent($booking));
    $booking->save();

    return response()->json(true);

    }
public function bookingMorchid(Request $request){

    $checkUser = false ; 

    if($request->input('morchid_mazart') !== 0){
 //$vendor = $request->user()->id;
 $checkUser = true ; 
 $booking  =  $this->booking ;
 $booking->first_name = $request->input('first_name');
 $booking->last_name = $request->input('last_name');
 $booking->email = $request->input('email');
 $booking->phone = $request->input('phone');

 $booking->city = $request->input('residance');
 //$booking->state = $request->input('state');
 //$booking->zip_code = $request->input('zip_code');
 $booking->country = $request->input('nationality');
 $booking->total_guests =  $request->input('nb_person'); 
 $booking->object_id =   $request->input('morchid_mazart');
 $booking->object_model =   'tour';
 $booking->gateway =  'offline_payment'; 
 $booking->gateway =  'offline_payment'; 
 $booking->status = 'processing';

 $booking->customer_notes = $request->input('morchid_mazart');


 $this->checkOrCreate($request) ; 
$this->savePassengers($booking,$request);
 //$booking->gateway = $payment_gateway;
// $booking->wallet_credit_used = floatval($credit);
// $booking->wallet_total_used = floatval($wallet_total_used);
 //$booking->pay_now = floatval((int)$booking->deposit == null ? $booking->total : (int)$booking->deposit);
 event(new BookingCreatedEvent($booking));
 $booking->save();


    }



    if($request->input('morchid_nusuk') !== 0){
 //$vendor = $request->user()->id;
 $bookingTwo  =   $this->booking ;
 $bookingTwo->first_name = $request->input('first_name');
 $bookingTwo->last_name = $request->input('last_name');
 $bookingTwo->email = $request->input('email');
 $bookingTwo->phone = $request->input('phone');

 $bookingTwo->city = $request->input('residance');
 //$booking->state = $request->input('state');
 //$booking->zip_code = $request->input('zip_code');
 $bookingTwo->country = $request->input('nationality');
 $bookingTwo->total_guests =  $request->input('nb_person'); 
 $bookingTwo->object_id =   $request->input('morchid_nusuk');
 $bookingTwo->object_model =   'tour';
 $bookingTwo->gateway =  'offline_payment'; 
 $bookingTwo->gateway =  'offline_payment'; 
 $bookingTwo->status = 'processing';

 $bookingTwo->customer_notes = $request->input('morchid_nusuk');

if($checkUser == false ){

    $this->checkOrCreate($request) ; 

}

$this->savePassengers($bookingTwo,$request);
 //$booking->gateway = $payment_gateway;
// $booking->wallet_credit_used = floatval($credit);
// $booking->wallet_total_used = floatval($wallet_total_used);
 //$booking->pay_now = floatval((int)$booking->deposit == null ? $booking->total : (int)$booking->deposit);
 event(new BookingCreatedEvent($bookingTwo));
 $bookingTwo->save();


    }

 return response()->json(true);



}
    public function checkOrCreate($request){



        if(Auth::check()) {
            $user = auth()->user();
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address_line_1');
            $user->address2 = $request->input('address_line_2');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->zip_code = $request->input('zip_code');
            $user->country = $request->input('country');
            $user->save();

        }elseif (!empty($confirmRegister)){

            $user = new User();
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address_line_1');
            $user->address2 = $request->input('address_line_2');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->zip_code = $request->input('zip_code');
            $user->country = $request->input('country');
            $user->password = bcrypt($request->input('password'));
            $user->save();
            event(new Registered($user));
            Auth::loginUsingId($user->id);
            try {
                event(new SendMailUserRegistered($user));
            } catch (\Matrix\Exception $exception) {
                Log::warning("SendMailUserRegistered: " . $exception->getMessage());
            }
            $user->assignRole(setting_item('user_role'));
        }

    }

    protected function savePassengers(Booking $booking,Request $request){
        $booking->passengers()->delete();
        if($totalPassenger = $booking->calTotalPassenger())
        {
            $input = $request->input('passengers',[]);
            for($i = 1 ; $i <= $totalPassenger ; $i ++)
            {
                $passenger = new BookingPassenger();
                $data = [
                    'booking_id'=>$booking->id,
                    'first_name'=>$input[$i]['first_name'] ?? '',
                    'last_name'=>$input[$i]['last_name'] ?? '',
                    'email'=>$input[$i]['email'] ?? '',
                    'phone'=>$input[$i]['phone'] ?? '',
                ];
                $passenger->fillByAttr(array_keys($data),$data);
                $passenger->save();
            }
        }
    }

    public function getVisas(){

        $data = Tour::select('bravo_tours.*')
        ->where('type',1)
        ->get();
        
        
        
        return response()->json($data);


    }
}
