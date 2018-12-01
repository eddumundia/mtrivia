<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use \App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new \App\User;
        if(\Auth::user()->role_id == 1 || \Auth::user()->role_id ==2){
            return redirect("users/profile");
        }
        
        $data =  $model->getcounts();
        $records = $model->getRecords();
        $lava = new \Khill\Lavacharts\Lavacharts();
        $clerks = $lava->DataTable();
        
        $teachers = $lava->DataTable();
        
        $teachers->addStringColumn('Verified')
                ->addNumberColumn('Percent')
                ->addRow(array('Kiswahili (Purity Wangu)', $model->getSubjectVerified(1, 31)))
                ->addRow(array('Mathematics (Pauline Mwatsuma)', $model->getSubjectVerified(2, 34)))
                ->addRow(array('English (Grace Mtanje)', $model->getSubjectVerified(3, 28)))
                ->addRow(array('Social studies and religion (Grace Jumbale)', $model->getSubjectVerified(4, 30)))
                ->addRow(array('Kiswahili (Fredrick Nderi)', $model->getSubjectVerified(1, 35)))
                ->addRow(array('Science (John Koi)', $model->getSubjectVerified(5, 29)));
        
        $clerks->addStringColumn('Data entry')
                ->addNumberColumn('Percent')
                ->addRow(array('Kiswahili (Purity Wangu)', $model->getSubjectRecord(1, 31)))
                ->addRow(array('Mathematics (Pauline Mwatsuma)', $model->getSubjectRecord(2, 34)))
                ->addRow(array('English (Grace Mtanje)', $model->getSubjectRecord(3, 28)))
                ->addRow(array('Social studies and religion (Grace Jumbale)', $model->getSubjectRecord(4, 30)))
                ->addRow(array('Kiswahili (Fredrick Nderi)', $model->getSubjectRecord(1, 35)))
                ->addRow(array('Science (John Koi)', $model->getSubjectRecord(5, 29)));
    
        $lava->PieChart('Stocks', $clerks, [
                'title' => 'Subjects and user counts'
            ]);

        return view('home', compact('data', 'lava', 'lava2', 'records'));
    }
}
