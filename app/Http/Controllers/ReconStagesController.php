<?php
//------------------------------------------------------------
// Nicolas Henry
// SI-T1a
// ReconStagesController.php
//------------------------------------------------------------


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Faker\Provider\DateTime;
use App\Contractstates;
use App\Internship;
use Carbon\Carbon;
use App\Params;
use App\Persons;

class ReconStagesController extends Controller
{
    // index, base route
    public function index()
    {
        $states = $this->getContract(1);
        $internships = Internship::all()->whereIn('contractstate_id', $states);

        return view('reconstages.reconstages')->with(compact("internships"));
    }

    /* Get the contract */
    public function getContract($value) {
        $contractStates = Contractstates::all();
        foreach ($contractStates as $contract) {
            if ($contract->openForRenewal === $value) {
                $states[] = $contract->id;
            }
        }
        /* Contract states by openForRenewal */
        return $states;
    }

    /* Page called by reconstages.reconmade */
    public function reconducted(Request $request) {
        /* Count number of reconductible data */
        $i = 0;

        /* 
            Prendre mois stage en cours et check avec mois start db
            comparer, si egale, changer, sinon, utiliser la date de la db
            Attention à l'année dans la db est à 2000, changer pour la date de stage.
        */

        $month = $this->getMonthInternship(Params::getParamByName('internship1Start'));

        dd($month);
        foreach($request->internships as $value) {
            $i++;
            $chosen[] = $value;
            // if($current == $date) {
            //     $newDate = $date+1;

            // }
            
            /* Get value of chosen */
            $old = Internship::find($value);

            /* Create new internship with old value */
            $new = new Internship();
            $new->companies_id = $old->companie->id;
            $new->beginDate = $old->beginDate;
            $new->endDate = $old->endDate;
            $new->responsible_id = $old->responsible->id;
            $new->admin_id = $old->admin->id;
            $new->intern_id = $old->student->id;
            $new->contractstate_id = 2;
            $new->previous_id = $value;
            $new->internshipDescription = $old->internshipDescription;
            $new->grossSalary = 1650;
            $new->contractGenerated = 0;
            $new->save();
        }

        $last = Internship::orderBy('id', 'desc')->take($i)->get();
        $selected = Internship::all()->whereIn('id', $chosen);
        return view('reconstages.reconmade')->with(compact('selected', 'last'));
    }

    /**
     * Get date who's be converted to string and return only the month
     * @param value mixed value
     * 
     * @author Benjamin Delacombaz
     * @return STRING string with month
     */

    public function getMonthInternship($value) {
        $splitTimeStamp = explode(" ",$value);
        $date = $splitTimeStamp[0];
        $date = explode('-', $date);
        return $date[1];
    }

    //Send value to reconMade page with function displayRecon()
    public function reconStages(Request $request){


        $keys = $request->all();
        $ids = [];

        foreach ($keys as $key => $value) {
            if ($key != '_token') {
                // Push id user in ids array
                array_push($ids, $value);
            }
        }

        
        $internships = $this->getInternships();
        $new = $this->displayRecon($ids, $internships);

        //return data to the view reconmade
        return view('reconstages/reconmade')->with(
            [
                "internships" => $new
            ]
        );

    }


    //get values from input in an array
    public function displayRecon($ids, $internships){
        //define table
        $beginDate = null;
        $endDate = null;
        $salary = 0;
        //get date from the table param in the function getParamByName()
        $paramBeginDate[] = $this->getParamByName('internship1Start')->paramValueDate;
        $paramBeginDate[] = $this->getParamByName('internship2Start')->paramValueDate;
        $paramEndDate[] = $this->getParamByName('internship1End')->paramValueDate;
        $paramEndDate[] = $this->getParamByName('internship2End')->paramValueDate;
        $newInternships = [];

        //Get all internships
        foreach ($internships as $internship) {
            //Get id of internships
            foreach($ids as $id){
                //check if the ID are correct
                if($internship->id==$id){

                    // Switch for stage begin date
                    switch (date('m',strtotime($internship->beginDate))){
                        // february
                        case date('m',strtotime($paramBeginDate[0])):
                        // Construct the date (begin, end) for the reconductible internship
                            $beginDate =  date('Y',strtotime($internship->beginDate)) . '-' . date('m-d',strtotime($paramBeginDate[1]));
                            $endDate = date('Y',strtotime($beginDate)) + 1 . '-' . date('m-d',strtotime($paramEndDate[1]));
                        break;

                        // September
                        case date('m',strtotime($paramBeginDate[1])):
                        // Construct the date (begin, end) for the reconductible internship
                            $beginDate =  date('Y',strtotime($internship->beginDate)) + 1 . '-' . date('m-d',strtotime($paramBeginDate[0]));
                            $endDate = date('Y',strtotime($beginDate)) . '-' . date('m-d',strtotime($paramEndDate[0]));
                        break;

                        default:
                        // do if the internship begin date is different of the 2 other case
                        $monthDiff1 = date('m',strtotime($paramBeginDate[0]))-date('m',strtotime($internship->endDate));  
                        $monthDiff2 = date('m',strtotime($paramBeginDate[1]))-date('m',strtotime($internship->endDate));
                        //check the value of the date
                        if($monthDiff1 < 0)
                        {
                            $monthDiff1 += 12;
                        }
                        if($monthDiff2 < 0)
                        {
                            $monthDiff2 += 12;
                        }
                        if($monthDiff1 < $monthDiff2)
                        {
                            $beginDate =  date('Y',strtotime($internship->beginDate)) + 1 . '-' . date('m-d',strtotime($paramBeginDate[0]));
                            $endDate = date('Y',strtotime($beginDate)) . '-' . date('m-d',strtotime($paramEndDate[0]));
                        }
                        else
                        {
                            $beginDate =  date('Y',strtotime($internship->beginDate)) + 1 . '-' . date('m-d',strtotime($paramBeginDate[1]));
                            $endDate = date('Y',strtotime($beginDate)) + 1 . '-' . date('m-d',strtotime($paramEndDate[1]));
                        }
                    }

                    // Salary
                    // Test if internship is from etat de vaud
                    
                    $monthBeginDate = date('m',strtotime($internship->beginDate));
                    if($internship->contracts_id == 4 && $monthBeginDate == date('m',strtotime($paramBeginDate[0])) )
                    {
                        // Add upgrade salary for trainee from Etat de Vaud
                        $salary = $this->getParamByName('internship2Salary')->paramValueInt;
                    }
                    elseif($internship->contracts_id == 4 && $monthBeginDate == date('m',strtotime($paramBeginDate[1])))
                    {
                        $salary = $this->getParamByName('internship1Salary')->paramValueInt;
                    }
                    else
                    {
                        // Keep the previous salary
                        $salary = $internship->grossSalary;
                    }
                    // display value on reconmade.blade
                    array_push($newInternships, $internship);

                    // Insert in dataBase
                    $insert = [
                        'companies_id'              => $internship->companies_id,
                        'beginDate'                 => $beginDate,
                        'endDate'                   => $endDate,
                        'responsible_id'            => $internship->responsible_id,
                        'admin_id'                  => $internship->admin_id,
                        'contractstate_id'          => '2',
                        'previous_id'               => $internship->id,
                        'internshipDescription'     => $internship->internshipDescription,
                        'grossSalary'               => $salary
                    ];
                    DB::table('internships')->insert($insert);
                }
            }
        }
        
        return $newInternships;

        
    }

    //get params by name and show the first
    private function getParamByName($name)
    {
        $param = Params::where('paramName', $name)
        ->first();
        return $param;
    }


}
