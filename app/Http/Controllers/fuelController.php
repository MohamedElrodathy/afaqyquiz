<?php
/**
 * Fuel controller.
 *
 * the fuel entries, insurance payments,
*and services tables together in one list..
 *
 * @since 23/9/2020
 *
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\fuel;
use DB;
class fuelController extends Controller
{
    /**
 * get all expenxe list  form  three tables function
 *
 * @param $request 
 * 
 * @return Json array 
 */ 
    public function getAllexpenses(Request $request) {
        $expenses = DB::table('vehicle')
        ->select('vehicle.id as id','vehicle.vehicle_name as vehicleName','vehicle.plate_Number as plateNumber',DB::raw("'Fuel' as type"),'fuel_entries.cost as cost','fuel_entries.entry_date as createdAt')
        ->join('fuel_entries', 'vehicle.id', '=', 'fuel_entries.vehicle_id')
        ->where(function($query) use($request){
        $this->filterbyfuel($query,$request);
      });
        $insurance= DB::table('vehicle')
        ->select('vehicle.id as id','vehicle.vehicle_name as vehicleName','vehicle.plate_Number as plateNumber',DB::raw("'insurance' as type"),'insurance_entries.amount as cost','insurance_entries.contract_date as createdAt')
        ->join('insurance_entries', 'vehicle.id', '=', 'insurance_entries.vehicle_id')
        ->where(function($query) use($request){
            $this->filterbyinsurance($query,$request);
          });
        $services= DB::table('vehicle')
        ->select('vehicle.id as id','vehicle.vehicle_name as vehicleName','vehicle.plate_Number as plateNumber',DB::raw("'service' as type"),'services_entries.total as cost','services_entries.created_at as createdAt')
        ->join('services_entries', 'vehicle.id', '=', 'services_entries.vehicle_id')
       
        ->union($insurance)->union($expenses)
        ->where(function($query) use($request){
            $this->filterbyservices($query,$request);
          })
        ->orderBy($request->get('sortBy'), $request->get('direction', 'ASC'))
        ->get()->toJson(JSON_PRETTY_PRINT);
         return response($services, 200);
      }
 /**
 * filter query  by  fuel type
 * @param $request 
 * 
 * @return  string
 */
      private function  filterbyfuel ($query,Request $request){

        if (isset($request->search)) {
            $query->where('vehicle.vehicle_name', 'LIKE', "%{$request->search}%");
            
        }
        if (isset($request->type)) {
            $query->where(DB::raw("'fuel'"), '=', $request->type);
        }

        if (isset($request->mincost)) {
          
            $query->where('fuel_entries.cost', '>' , $request->mincost);
        }
        if (isset($request->maxcost)) {
            $query->where('fuel_entries.cost', '<' , $request->maxcost);
         
        }
        if (isset($request->mindate)) {
            $query->whereDate('fuel_entries.entry_date', '>' , $request->mindate);
         
        }
        if (isset($request->maxdate)) {
            $query->whereDate('fuel_entries.entry_date', '<' , $request->maxdate);
         
        }

      }
      /**
 * filter query  by  insurance type
 * @param $request 
 * 
 * @return  string
 */
      private function  filterbyinsurance ($query,Request $request){

            if (isset($request->search)) {
              $query->where('vehicle.vehicle_name', 'LIKE', "%{$request->search}%");
          }
          if (isset($request->type)) {
              $query->where(DB::raw("'insurance'"), '=', $request->type);
          }
          if (isset($request->mincost)) {
            
              $query->where('insurance_entries.amount', '>' , $request->mincost);
          }
          if (isset($request->maxcost)) {
            
              $query->where('insurance_entries.amount', '<=' , $request->maxcost);
          }
          if (isset($request->mindate)) {
              $query->whereDate('insurance_entries.contract_date', '>' , $request->mindate);
           
          }
          if (isset($request->maxdate)) {
              $query->whereDate('insurance_entries.contract_date', '<' , $request->maxdate);
           
          }
       
      }
      /* filter query  by  services type
      * @param $request 
      * 
      * @return  string
      */
      private function  filterbyservices ($query,Request $request){
            if (isset($request->search)) {
              $query->where('vehicle.vehicle_name', 'LIKE', "%{$request->search}%");
          }
          if (isset($request->type)) {
              $query->where(DB::raw("'service'"), '=', $request->type);
          }
          if (isset($request->mincost)) {
            
              $query->where('services_entries.total', '>' , $request->mincost);
          }
          if (isset($request->maxcost)) {
              $query->where('services_entries.total', '<' , $request->maxcost);
           
          }
          if (isset($request->mindate)) {
              $query->whereDate('services_entries.created_at', '>' , $request->mindate);
           
          }
          if (isset($request->maxdate)) {
              $query->whereDate('services_entries.created_at', '<' , $request->maxdate);
           
          }
   
  }
     

  
}
