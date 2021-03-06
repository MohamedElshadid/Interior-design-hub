<?php

namespace App\Http\Controllers\CompanyAdmin;
use App\Http\Controllers\Controller;
use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendQuizMail;
use Uuid;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        return view('CompanyAdmin.quizzes',['data'=>Quiz::all()]);
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return response()->json(['message' => 'User status updated successfully.']);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

           $quiz =  new Quiz ;

           $quiz->area = $request->area;

           $quiz->timeOfRsponse = $request->timeOfRsponse;

           $quiz->customerPhoneNo = $request->customerPhoneNo;


           $quiz->customerName = $request->customerName;

           $quiz->contactTybe = $request->contactTybe;

           $quiz->participateState = $request->participateState;


           $quiz->styles =implode(" \n ", $request->styles);
           $quiz->design = $request->design ;


                $response1='';
              if ($files = $request->file('file'))
              {

                foreach($request->file('file') as $file)
                {
                             $uuid =Uuid::generate()->string;
                              $path=$uuid.".".$file->getClientOriginalExtension();
                              $desti='quizimages/';
                              $file->move($desti,$path);
                              $response1 =   $quiz->images()->create(['image'=>$path]);
                }


              }
              $response=$quiz->save();
            //   Mail::to('yassminelbialy@gmail.com')
            //   ->send(new SendQuizMail ($quiz));

         return response()->json( ['mydata'=> $request->all(),'myresponse'=> $response,'opject'=>$quiz,'images'=>$quiz->images] );

        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect(route('company.quizzes.index'));
    }
}
