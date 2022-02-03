<?php

namespace App\Http\Controllers\Internal\Infosessions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\infosessionquestions;

class QuestionController extends Controller
{
    public function readquestion(Request $request)
    {
        $id = $request['id'];
        
        if(!empty($id)){
            $datas = infosessionquestions::where('form_id',$id)->get();
        }else{
            $datas = infosessionquestions::all();
        }

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' =>$no,
                'question_id' => $d['id'],
                'program_id' => $d['program_id'],
                'type' => $d['type'],
                'file' => $d['file'],
                'text' => $d['text'],
                'description' => $d['description'],
                'option' => $d['option'],
                'section_id' => $d['section_id'],
            );
        }

        $pesan = 'Read Question Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);

    }

    public function createquestion(Request $request)
    {
       $form_id = $request['form_id'];
       $type = $request['type'];
       $file = $request['file'];
       $text = $request['text'];
       $description = $request['description'];
       $option = $request['option'];
       $section_id = $request['section_id'];

       $files = '';
        if(!empty($file)){
            $destinationPath = 'assets/internal/files/infosession/question/';
            $files = 'file_'.$file->getClientOriginalName();
            $file->move($destinationPath, $files);
        }

        $data = array(
            'form_id' => $form_id,
            'type' => $type,
            'file' => $files,
            'text' => $text,
            'description' => $description,
            'option' => $option,
            'section_id' => $section_id,
        );

        infosessionquestions::create($data);
        
        $pesan = 'Insert question Success.';
        $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    } 

    public function updatequestion(Request $request)
    {
        $column = $request['column'];
        $question_id = $request['question_id'];
        $value = $request['value'];

        $data = array(
            $column => $value
        );

        infosessionquestions::where('id',$question_id)->update($data);
        
        $pesan = 'Update Question Success.';
        // $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }
}
