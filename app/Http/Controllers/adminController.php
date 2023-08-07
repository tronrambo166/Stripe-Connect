<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Models\Patient;
use App\Models\Procedures;
use App\Models\Treatment;
use App\Models\Diseases;
use App\Models\User;
use Mail;
use Session;
class AdminController extends Controller
{

     public function logout()
    {  
        Session::forget('admin');
        Session::save();
        return redirect('admin/login');
 }

  public function login(){

        return view('admin.login',); 
 }
 
     public function index_admin()
    {          
       
        $admin= DB::table('admins')->where('id',1)->get();
        return view('admin.index_admin', compact( 'admin')); 
 }


 public function patients()
    {           
        $patient= Patient::get();
       return view('admin.patient-list', compact('patient')); 
 }

 public function treatments()
    {       
        $location= Treatment::get(); 
        $diseases= Diseases::get();  
        $procedure= Procedures::get();
          //$cat= DB:: table('categories')->get();

        return view('admin.treatments', compact('location','diseases','procedure'));       
    }

    public function diseases()
    {       
        $location= Diseases::get();   
          //$cat= DB:: table('categories')->get();

        return view('admin.diseases', compact('location'));       
    }

public function procedures()
    {       
        $categories= Procedures::get();  
          //$cat= DB:: table('categories')->get();
        return view('admin.procedures', compact('categories'));       
    }


    public function reports()
    {       
        $categories= Procedures::get();  
          //$cat= DB:: table('categories')->get();
        return view('admin.reports', compact('categories'));       
    }


    //DOCTOR

    public function doctors()
    {       
        $doctor= User::get();

  return view('admin.doctor-list', compact('doctor'));       
    }




 // Locations/Treatment
public function add_treatment(Request $hos)
    {           
          $name=$hos->t_name;
          $disease_id=$hos->disease_id;
          $disease_name=$hos->disease_name;
          $procedure_name=$hos->procedure_name;
          $medic_a=$hos->medic_a;
          $medic_b=$hos->medic_b;
          $medic_c=$hos->medic_c;
          $medic_d=$hos->medic_d;
          $medic_e=$hos->medic_e;

          $location = Treatment::create([
          't_name' =>  $name,
          'disease_id' =>  $disease_id,
          'disease_name' =>  $disease_name,
          'procedure_name' =>  $procedure_name,
          'medic_a' =>  $medic_a,
          'medic_b' =>  $medic_b,
          'medic_c' =>  $medic_c,
          'medic_d' =>  $medic_d,
          'medic_e' =>  $medic_e
      ]);
         return back()->with('success', "Added!"); 
    }
      



public function up_treatment(Request $hos)
    {           
        $id=$hos->id;
       //locations::where('id', 1)->update(['name' => $name, 'location' => $location]);
       Treatment::where('id',$id)->update($hos->except(['_token']));

       return back()->with('success', "Updated!"); 

}


 public function del_treatment($id)
    {           
        $deleted = Treatment::where('id', $id)->delete();
       return back()->with('success', "Deleted!"); 
 }

 // Locations




//PROC
      public function add_procedures(Request $hos)
    {           
          $proc_name=$hos->proc_name;
          $proc_details=$hos->proc_details;
          
          

          $location = Procedures::create([
          'proc_details' =>  $proc_details,
          'proc_name' =>  $proc_name,
          
          
      ]);
         return back()->with('success', "Added!"); 
    }

    public function up_procedure(Request $hos)
    {           
        $id=$hos->id;
       //locations::where('id', 1)->update(['name' => $name, 'location' => $location]);
       Procedures::where('id',$id)->update($hos->except(['_token']));

       return back()->with('success', "Updated!"); 

}


 public function del_procedure($id)
    {           
        $deleted = Procedures::where('id', $id)->delete();
       return back()->with('success', "Deleted!"); 
 }

 //PROC




 // Diseases
public function add_disease(Request $hos)
    {           
          $d_name=$hos->d_name;
          $procedure_name=$hos->procedure_name;
          $sym_a=$hos->sym_a;
          $sym_b=$hos->sym_b;
          $sym_c=$hos->sym_c;
          $sym_d=$hos->sym_d;
          $sym_e=$hos->sym_e;

          $location = Diseases::create([
          'd_name' =>  $d_name,
          'sym_a' =>  $sym_a,
          'sym_b' =>  $sym_b,
          'sym_c' =>  $sym_c,
          'sym_d' =>  $sym_d,
          'sym_e' =>  $sym_e
      ]);
         return back()->with('success', "Added!"); 
    }
      



public function up_disease(Request $hos)
    {           
         $id=$hos->id;
       //locations::where('id', 1)->update(['name' => $name, 'location' => $location]);
       Diseases::where('id',$id)->update($hos->except(['_token']));

       return back()->with('success', "Updated!"); 

}


 public function del_disease($id)
    {           
        $deleted = Diseases::where('id', $id)->delete();
       return back()->with('success', "Deleted!"); 
 }

 // Diseases



 // Doctors
public function add_doctor(Request $hos)
    {           
          $name=$hos->name;
          $email=$hos->email;
          $password=$hos->password;
          $category_id=$hos->category_id;
          $hospital_id=$hos->hospital_id;
          $clinic_id=$hos->clinic_id;
          $gender=$hos->gender;
          $phone=$hos->phone;
          $rate=$hos->rate;
          $location=$hos->location;
          $available=$hos->available;
            $exps=$hos->exps;

            //SINGLE IMG
          if($hos->image!=''){
          $image=$hos->file('image');
          $uniqid=hexdec(uniqid());
          $ext=strtolower($image->getClientOriginalExtension());
          $create_name=$uniqid.'.'.$ext; 
          $loc='assets_admin/img/doctors';
          $image->move($loc, $create_name);
          //DB::table('products')->where('Id',$id)->update($datas);

          $location = doctors::create([
          'name' =>  $name,
          'email' =>  $email,
          'password' =>  $password,
          'category_id' =>  $category_id,
          'hospital_id' =>  $hospital_id,
          'clinic_id' =>  $clinic_id,
          'gender' =>  $gender,
          'phone' =>  $phone,
          'exps' =>  $exps,
          'rate' =>  $rate,
          'location' =>  $location,
          'available' =>  $available,
          'image' =>  $create_name
          
          ]);

          //Slots adding

          $last_doc = doctors::orderBy('id','DESC')->first();
          $last_doc_id=$last_doc->id;
          for($i=1;$i<=15;$i++)
          DB::table('slot_dates')->insert([ 'slot_id'=>$last_doc_id ]);

          //Slots adding

         return back()->with('success', "Brand Added!"); 
    }

    $location = doctors::create([
          'name' =>  $name,
          'email' =>  $email,
          'password' =>  $password,
          'category_id' =>  $category_id,
          'hospital_id' =>  $hospital_id,
          'clinic_id' =>  $clinic_id,
          'gender' =>  $gender,
          'phone' =>  $phone,
          'rate' =>  $rate,
          'location' =>  $location,
          'available' =>  $available,
          'exps' =>  $exps
          
          ]);

    //Slots adding

          $last_doc = doctors::orderBy('id','DESC')->first();
          $last_doc_id=$last_doc->id;
          for($i=1;$i<=15;$i++)
          DB::table('slot_dates')->insert([ 'slot_id'=>$last_doc_id ]);

          //Slots adding

      return back()->with('success', "Brand Added!");  
    }





public function up_doctor(Request $hos)
    {           
        $id=$hos->id;
        $offday=$hos->offday; //return $offday;
       doctors::where('id', $id)->update(['offday' => $offday]);
       doctors::where('id',$id)->update($hos->except(['_token']));

        //SINGLE IMG
          if($hos->image!=''){
          $image=$hos->file('image');
          $uniqid=hexdec(uniqid());
          $ext=strtolower($image->getClientOriginalExtension());
          $create_name=$uniqid.'.'.$ext; 
          $loc='assets_admin/img/doctors';
          $image->move($loc, $create_name);

        $datas['image']=$create_name;
       DB::table('doctors')->where('id',$id)->update($datas);
       return back()->with('success', "Brand Added!"); 
 }
 return back()->with('success', "Brand Added!"); 
 }



 public function del_doctor($id)
    {           
        $deleted = doctors::where('id', $id)->delete();
       return back()->with('success', "Brand Added!"); 
 }

 // Doctors



 



    //** Login attempt Admin

 public function adminLogin(Request $formData)
{       
$email = $formData->email;
$password = $formData->password;
$user= DB::table('admins')->where('email', $email)->get(); 
$check_user=json_decode($user);
//print_r($check_user); echo $check_user[0]->password; exit;

if($user->count() >0 ) {
$db_password=$check_user[0]->password; //opd_admin
if(password_verify($password, $db_password)) { 
    Session::put('admin','Logged!');
    return redirect('admin/index_admin'); }
else{
    echo "Password wrong!";
   

}
    }

       else { echo "user don't exist"; }

}

//** Forgot

public function forgot($remail)
    { 

         return view('admin.forgot_password',compact('remail'));
     
    }


public function send_reset_email(Request $request)
    {

        $remail=$request->email;   
        

        // Send Email

        $info=['Name'=>'Dele', 'email' => $remail];
        $user['to']= $remail;
        Mail::send('admin.mail', $info, function($msg) use ($user){

            $msg->to($user['to']);
            $msg->subject('Test Mail');

        });

        echo "Check your email"; exit;

        // Send Email

    }


public function reset(Request $request, $remail)
    { echo "hello";

       $email=$remail;
       $password_1=$request->password; 
       $password=$request->c_password; 

       if($password_1==$password) {
     $password_1= Hash::make($password_1);
     $update= DB::table('admins')->where('email', $email)
     -> limit(1)->update(['password'=> $password_1]);

     if($update) {Session::put('reset', 'password reset success!');return redirect('admin/login'); }
       }    
          else {
            Session::put('wrong_pwd', 'password do not match! try again');
          return redirect()->back();
      }

    }


//______________________________________________________________________________



    public function adminLogout(Request $request)
{
    Auth::guard('admin')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('admin/login');
}

    //** Login attempt and Custom Authentication




// Remove special chars
    function clean($string) {
   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}


// update everyday slots

public function edit_slots(Request $hos)
    {     
        $doc_id=$hos->id;     
        $day_one=  DB::table('slot_dates')->where('slot_id', $doc_id)->first();
        $day_one_id=$day_one->id;

       for($i=1;$i<=15;$i++){
        //input names
        $slot_one='m_slots'.$i;
        $slot_twp='af_slots'.$i;
        $slot_three='ev_slots'.$i;

        $m_slot=$hos->$slot_one;
        $af_slots=$hos->$slot_twp;
        $ev_slots=$hos->$slot_three;
       DB::table('slot_dates')->where('id', $day_one_id)
        ->update([ 'm_slots' => $m_slot, 'af_slots' => $af_slots, 'ev_slots' => $ev_slots ]);
        $day_one_id++;
    }

    return redirect()->back();
}
      

      public function get_slots($diff,$doc_id)
    {         
        $day_one=  DB::table('slot_dates')->where('slot_id', $doc_id)->first();
        $day_one_id=$day_one->id;
        $to_day_id=$day_one_id+$diff;
        $result=  DB::table('slot_dates')->where('id', $to_day_id)->first();

         return response()->json(['data' => $result]);
}
     

      public function get_sugges($sText) {   
      $searchName=$sText; 
      $cat=DB::table('categories')->where('name', 'like', '%'.$searchName.'%')->get();
      $cats=DB::table('categories')->where('name', 'like', '%'.$searchName.'%')->first();

      if($cat->count()>0) $cat_doc_id=$cats->id; else $cat_doc_id=0;

      $result=DB::table('doctors')->where('name', 'like', '%'.$searchName.'%')->
      orWhere('category_id',$cat_doc_id)->get();

         return response()->json([ 'data'=>$result ]);

     }


}