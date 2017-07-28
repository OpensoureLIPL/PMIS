<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserType;
use App\Designation;
use App\Menu;
use App\PrisonType;
use App\PrisonWing;
use App\PrisonerType;
use App\Http\Requests\UserTypeRequest;
use App\Http\Requests\DesignationRequest;
use App\Http\Requests\MenuRequest;
use App\Http\Requests\PrisonTypeRequest;
use App\Http\Requests\PrisonWingRequest;
use App\Http\Requests\PrisonerTypeRequest;
use Session;
use Input;
use Validator;
use App\Common;
use Uuid;


class MasterController extends Controller{
 public function __construct() {
      //$this->middleware('revalidate'); 
      //$this->middleware('auth');
   }
    public function index(){
        
    }
    /**
     * Show the form for creating a new User Typr.
     *
     * @return \Illuminate\Http\Response
     */
    public function usertypecreate()
    {
        $userType = new UserType;
        return view('master.usertypecreate', ['UserType' => $userType,'title'=>'Add User Type' ]); 
    }
    /*
    *User Type list
    *
    */
    public function usertypelist(){
        $usertypedata = DB::table('user_types')->where('is_trash',0)->paginate(15);
       
        return view('master.usertypelist', ['usertypedata' => $usertypedata  ,'title'=>'User Type List']);
    }
    /**
     * [usertypedit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function usertypedit($id){
        $userType = UserType::findOrFail($id);
        return view('master.usertypecreate', ['UserType' => $userType,'title'=>'Update User Type' ]); 
    }
    
    public function usertypedelete($id){
        $userType = UserType::find($id);
        $userType->is_trash = 1;
        $userType->save();
        if($userType->save()){
            \Session()->flash('flash_message', 'User Type deleted successfully!');
        }else{
            \Session()->flash('error_message', 'Invalid request, please try again!');
        }
        return redirect('usertypelist');
    }
    
    /*
    *Action to enable or disable
    */
    public function usertypeaction($id){
        $userType = UserType::find($id);
        if(isset($userType->is_enable) && $userType->is_enable == 1){
            $userType['is_enable'] = 0;
        }else{
            $userType['is_enable'] = 1;
        }
        if($userType->save()){
            if($userType->is_enable == 0){
                \Session()->flash('flash_message', 'User Type de-activated successfully!');
            }else{
                \Session()->flash('flash_message', 'User Type activated successfully!');
            }
        }else{
            \Session()->flash('error_message', 'Invalid request, please try again!');
        }
        return redirect('usertypelist');
    }  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function usertypesave(UserTypeRequest $request)
    {
        //return $request->user();
            $data = $request->all();
            if(isset($data['id']) && (int)$data['id'] != 0){
                $userType = UserType::find($data['id']);
            }else{
                $userType = new UserType();
            }
            if($userType->fill($data)->save()){
                \Session()->flash('flash_message', 'User Types saved successfully!');
            }else{
                \Session()->flash('error_message', 'Invalid request, please try again!');
            }
            return redirect('usertypelist');
    }
    /**
     * Show the form for creating a new Designation
     *
     * @return \Illuminate\Http\Response
     */
    public function designationcreate()
    {
        $designation = new Designation;
        return view('master.designationcreate', ['designation' => $designation,'title'=>'Add Designation' ]); 
    }
    /*
    *Designation
    *
    */
    public function designationlist(){
        $designation = DB::table('designations')->where('is_trash',0)->paginate(15);
       
        return view('master.designationlist', ['designationdata' => $designation  ,'title'=>'Designation List']);
    }
    /**
     * [usertypedit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function designationedit($id){
        $designation = Designation::findOrFail($id);
        return view('master.designationcreate', ['designation' => $designation,'title'=>'Update Designation' ]); 
    }
    
    public function designationdelete($id){
        $designation = Designation::find($id);
        $designation->is_trash = 1;
        $designation->save();
        if($designation->save()){
            \Session()->flash('flash_message', 'Designation deleted successfully!');
        }else{
            \Session()->flash('error_message', 'Invalid request, please try again!');
        }
        return redirect('designationlist');
    }
    
    /*
    *Action to enable or disable
    */
    public function designationaction($id){
        $designation = Designation::find($id);
        if(isset($designation->is_enable) && $designation->is_enable == 1){
            $designation['is_enable'] = 0;
        }else{
            $designation['is_enable'] = 1;
        }
        if($designation->save()){
            if($designation->is_enable == 0){
                \Session()->flash('flash_message', 'Designation disabled successfully!');
            }else{
                \Session()->flash('flash_message', 'Designation enabled successfully!');
            }
        }else{
            \Session()->flash('error_message', 'Invalid request, please try again!');
        }
        return redirect('designationlist');
    }  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function designationsave(DesignationRequest $request)
    {
        //return $request->user();
            $data = $request->all();
            if(isset($data['id']) && (int)$data['id'] != 0){
                $designation= Designation::find($data['id']);
            }else{
                $designation = new Designation();
            }
            if($designation->fill($data)->save()){
                \Session()->flash('flash_message', 'Designation saved successfully!');
            }else{
                \Session()->flash('error_message', 'Invalid request, please try again!');
            }
            return redirect('designationlist');
    }

    /**
     * Show the form for creating a new Menu
     *
     * @return \Illuminate\Http\Response
     */
    public function menucreate()
    {
        $menu = new Menu;
         $parent_menu= new Menu();
        $parents   = [''=>'--Select Parent--'] + $parent_menu->where('parent_id',0)->where('is_trash',0)->where('is_enable',1)->lists('name', 'id')->toArray();
        return view('master.menucreate', ['menu' => $menu,'parentsList'=>$parents,'parent'=>' ','title'=>'Add Menu' ]); 
    }
    /*
    * Menu
    *
    */
    public function menulist(){
  
       
         $menu = DB::table('menus')
            ->join('menus as parent', 'parent.id', '=', 'menus.parent_id','left')
           ->select('menus.*', 'parent.name as parent_name')
             ->where('menus.is_trash',0)->paginate(15);
           
        return view('master.menulist', ['menudata' => $menu , 'title'=>'Menu List']);
    }

    /**
     * [usertypedit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function menuedit($id){
        $menu = Menu::findOrFail($id);
        $parent_menu= new Menu();
        $parents   = [''=>'--Select Parent--'] + $parent_menu->where('parent_id',0)->where('is_trash',0)->where('is_enable',1)->lists('name', 'id')->toArray();
        $parent=$menu->parent_id;
        return view('master.menucreate', ['menu' => $menu,'parentsList'=>$parents,'parent'=>$parent,'title'=>'Update Menu' ]); 
    }
    
    public function menudelete($id){
        $menu = Menu::find($id);
        $menu->is_trash = 1;
        $menu->save();
        if($menu->save()){
            \Session()->flash('flash_message', 'Menu deleted successfully!');
        }else{
            \Session()->flash('error_message', 'Invalid request, please try again!');
        }
        return redirect('menulist');
    }
    
    /*
    *Action to enable or disable
    */
    public function menuaction($id){
        $menu = Menu::find($id);
        if(isset($menu->is_enable) && $menu->is_enable == 1){
            $menu['is_enable'] = 0;
        }else{
            $menu['is_enable'] = 1;
        }
        if($menu->save()){
            if($menu->is_enable == 0){
                \Session()->flash('flash_message', 'Menu disabled successfully!');
            }else{
                \Session()->flash('flash_message', 'Menu enabled successfully!');
            }
        }else{
            \Session()->flash('error_message', 'Invalid request, please try again!');
        }
        return redirect('menulist');
    }  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function menusave(MenuRequest $request)
    {
        //return $request->user();
            $data = $request->all();
            if(isset($data['id']) && (int)$data['id'] != 0){
                $menu= Menu::find($data['id']);
            }else{
                $menu = new Menu();
            }
            if($menu->fill($data)->save()){
                \Session()->flash('flash_message', 'Menu saved successfully!');
            }else{
                \Session()->flash('error_message', 'Invalid request, please try again!');
            }
            return redirect('menulist');
    }
    /**
     * Show the form for creating a new Prison Type
     *
     * @return \Illuminate\Http\Response
     */
    public function createPrisonType()
    {
        $prisonType = new PrisonType;
        
        return view('master.prisontypecreate', ['prisonType' => $prisonType,'title'=>'Add Prision Type' ]); 
    }
    /*
    * Prison type list
    *
    */
    public function prisonTypeList()
    {
       $prisiontype= DB::table('prison_types')->where('is_trash',0)->get();

        return view('master.prisiontypelist', ['prisiontypes' => $prisiontype  ,'title'=>'Prison Type List']);
    }
    /**
     * To save the newly creted prison type or Update the 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function prisonTypeSave(PrisonTypeRequest $request)
    {
        //return $request->user();
            $data = $request->all();
            if(isset($data['id']) && (int)$data['id'] != 0){
                $prisontype= PrisonType::find($data['id']);
            }else{
                $prisontype = new PrisonType();
            }
            if($prisontype->fill($data)->save()){
                \Session()->flash('flash_message', 'Prison Type saved successfully!');
            }else{
                \Session()->flash('error_message', 'Invalid request, please try again!');
            }
            return redirect('prisontypelist');
    }
    /**
     * [editPrisonType description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function editPrisonType($id){
        $prisontype = PrisonType::findOrFail($id);
        
        return view('master.prisontypecreate', ['prisonType' => $prisontype,'title'=>'Update Prison Type' ]); 
    }
    /*
    *Prison Type Delete
    */
    public function deletePrisonType($id){
        $prisontype = PrisonType::find($id);
        $prisontype->is_trash = 1;
        $prisontype->save();
        if($prisontype->save()){
            \Session()->flash('flash_message', 'Prison type deleted successfully!');
        }else{
            \Session()->flash('error_message', 'Invalid request, please try again!');
        }
        return redirect('prisontypelist');
    }
    
    /*
    *Action to enable or disable
    */
    public function prisonTypeAction($id){
        $prisontype = PrisonType::find($id);
        if(isset($prisontype->is_enable) && $prisontype->is_enable == 1){
            $prisontype['is_enable'] = 0;
        }else{
            $prisontype['is_enable'] = 1;
        }
        if($prisontype->save()){
            if($prisontype->is_enable == 0){
                \Session()->flash('flash_message', 'Prison type disabled successfully!');
            }else{
                \Session()->flash('flash_message', 'Prison type enabled successfully!');
            }
        }else{
            \Session()->flash('error_message', 'Invalid request, please try again!');
        }
        return redirect('prisontypelist');
    }  
    /**
     * Show the form for creating a new Prison Wing
     *
     * @return \Illuminate\Http\Response
     */
    public function createPrisonWing()
    {
        $prisonWing = new PrisonWing;
        
        return view('master.prisonwingcreate', ['prisonWing' => $prisonWing,'title'=>'Add Prision Wings' ]); 
    }
    /*
    * Prison wing list
    *
    */
    public function prisonWingList()
    {
       $prisionWing= DB::table('prison_wings')->where('is_trash',0)->get();

        return view('master.prisionwinglist', ['prisionwings' => $prisionWing  ,'title'=>'Prison Wings List']);
    }
    /**
     * To save the newly creted prison wing or Update  
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function prisonWingSave(PrisonWingRequest $request)
    {
        //return $request->user();
            $data = $request->all();
            if(isset($data['id']) && (int)$data['id'] != 0){
                $prisonwing= PrisonWing::find($data['id']);
            }else{
                $prisonwing = new PrisonWing();
            }
            if($prisonwing->fill($data)->save()){
                \Session()->flash('flash_message', 'Prison wing saved successfully!');
            }else{
                \Session()->flash('error_message', 'Invalid request, please try again!');
            }
            return redirect('prisonwinglist');
    }
    /**
     * [editPrisonWing description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function editPrisonWing($id){
        $prisonwing = PrisonWing::findOrFail($id);
        
        return view('master.prisonwingcreate', ['prisonWing' => $prisonwing,'title'=>'Update Prison Wings' ]); 
    }
    /*
    *Prison Wing Delete
    */
    public function deletePrisonWing($id){
        $prisonwing = Prisonwing::find($id);
        $prisonwing->is_trash = 1;
        $prisonwing->save();
        if($prisonwing->save()){
            \Session()->flash('flash_message', 'Prison wing deleted successfully!');
        }else{
            \Session()->flash('error_message', 'Invalid request, please try again!');
        }
        return redirect('prisonwinglist');
    }
    
    /*
    *Action to enable or disable
    */
    public function prisonWingAction($id){
        $prisonwing = PrisonWing::find($id);
        if(isset($prisonwing->is_enable) && $prisonwing->is_enable == 1){
            $prisonwing['is_enable'] = 0;
        }else{
            $prisonwing['is_enable'] = 1;
        }
        if($prisonwing->save()){
            if($prisonwing->is_enable == 0){
                \Session()->flash('flash_message', 'Prison wing disabled successfully!');
            }else{
                \Session()->flash('flash_message', 'Prison wing enabled successfully!');
            }
        }else{
            \Session()->flash('error_message', 'Invalid request, please try again!');
        }
        return redirect('prisonwinglist');
    }  
    
    /**
     * Show the form for creating a new Prisoner Type
     *
     * @return \Illuminate\Http\Response
     */
    public function createPrisonerType()
    {
        $prisonerType = new PrisonerType;
        
        return view('master.prisonertypecreate', ['prisonerType' => $prisonerType,'title'=>'Add Prisioner Type' ]); 
    }
    /*
    * Prison type list
    *
    */
    public function prisonerTypeList()
    {
       $prisionertype= DB::table('prisoner_types')->where('is_trash',0)->get();

        return view('master.prisionertypelist', ['prisionertypes' => $prisionertype  ,'title'=>'Prisoner Type List']);
    }
    /**
     * To save the newly creted prison type or Update the 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function prisonerTypeSave(PrisonerTypeRequest $request)
    {
        //return $request->user();
            $data = $request->all();
            $data['prisoner_type_uuid']=Uuid::generate();
            if(isset($data['id']) && (int)$data['id'] != 0){
                $prisonertype= PrisonerType::find($data['id']);
            }else{
                $prisonertype = new PrisonerType();
            }
            if($prisonertype->fill($data)->save()){
                \Session()->flash('flash_message', 'Prisoner Type saved successfully!');
            }else{
                \Session()->flash('error_message', 'Invalid request, please try again!');
            }
            return redirect('prisonertypelist');
    }
    /**
     * [editPrisonType description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function editPrisonerType($uuid){
       $prisonertype = PrisonerType::where('prisoner_type_uuid',$uuid)->first();
        return view('master.prisonertypecreate', ['prisonerType' => $prisonertype,'title'=>'Update Prisoner Type' ]); 
    }
    /*
    *Prison Type Delete
    */
    public function deletePrisonerType($uuid){
        $prisonertype = PrisonerType::where('prisoner_type_uuid',$uuid)->first();
        $prisonertype->is_trash = 1;
        $prisonertype->save();
        if($prisonertype->save()){
            \Session()->flash('flash_message', 'Prisoner type deleted successfully!');
        }else{
            \Session()->flash('error_message', 'Invalid request, please try again!');
        }
        return redirect('prisonertypelist');
    }
    
    /*
    *Action to enable or disable
    */
    public function prisonerTypeAction($uuid){
        $prisonertype = PrisonerType::where('prisoner_type_uuid',$uuid)->first();
        if(isset($prisonertype->is_enable) && $prisonertype->is_enable == 1){
            $prisonertype['is_enable'] = 0;
        }else{
            $prisonertype['is_enable'] = 1;
        }
        if($prisonertype->save()){
            if($prisonertype->is_enable == 0){
                \Session()->flash('flash_message', 'Prisoner type disabled successfully!');
            }else{
                \Session()->flash('flash_message', 'Prisoner type enabled successfully!');
            }
        }else{
            \Session()->flash('error_message', 'Invalid request, please try again!');
        }
        return redirect('prisonertypelist');
    }  
}
