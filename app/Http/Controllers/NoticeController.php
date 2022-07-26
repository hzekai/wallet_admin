<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use  App\Models\Notice;
use  App\Models\NoticeCategory;

class NoticeController extends Controller
{
    protected function rules(): array
    {
        return [
            'create' => [
                'category_id'   => ['exists:notice_category,id'],
                'title'         => ['required', 'min:2', 'max:255'],
                'content'       => ['required', 'min:2', 'max:25'],
                // 'created_by'    => ['required', 'numeric']
            ],
            'update' => [
                // 'id'            => ['required', 'numeric'],
                'category_id'   => ['exists:notice_category,id'],
                'title'         => ['sometimes:required', 'min:2', 'max:255'],
                'content'       => ['sometimes:required', 'min:2', 'max:25'],
            ],
        ];
    }


    protected function validator(array $data, $key)
    {
        return Validator::make($data, $this->rules()[$key]);
    }


    public function create(Request $request)
    {
        Log::info("1111111111111111");
        $input = $request->all();
        // $this->validator($input, 'create')->validate();
        Log::info("33333333");
        $input['is_publish'] = 0;
        $input['updated_at'] = date("Y-m-d h:i:s");
        $input['created_at'] = date("Y-m-d h:i:s");
        $input['updated_at'] = $input['created_at'];

        $obj = new Notice();
        foreach ($input as $key => $val) {
            $obj[$key] = $val;
        }
        $obj->save();
        return response()->json(['data' => $input, "code" => 0, "message" => "success"]);
    }


    public function index(Request $request)
    {
        $type = $request->input("type");
        $flag = $request->input("flag") or 0;
        $content = $request->input("content");
        $pageNo = $request->input("page") ?? 1;
        $pageSize = $request->input("pageSize") ?? 10;

        $notice = null;
        if ($type != null) {
            $field = "content";
            if ($type == 'title') {
                $field = "title";
            }
            if ($flag == 0) {
                $content = '%' . $content . '%';
            }
            $notice = Notice::where('title', 'like', $content);
        }
        if ($type == null) {
            $notice = Notice::orderBy('id', 'DESC');
        } else {
            $notice = $notice->orderBy('id');
        }

        $notices = $notice->paginate($pageSize)->withQueryString();
        var_dump(compact('notices'));
        return view('notices.cc', compact('notices'));
    }


    public function update(Request $request, string $id)
    {
        $obj = Notice::find($id);
        if (!$obj) {
            return response()->json(["code" => -1, "msg" => "record miss"]);
        }

        $input = $request->all();
        // $this->validator($input, 'update')->validate();
        if ($input['is_publish'] == null) $input['is_publish'] = 0;
        $input['updated_at'] = date("Y-m-d h:i:s");
        foreach ($input as $key => $val) {
            $obj[$key] = $val;
        }

        $obj->save();
        return response()->json(['data' => $obj, "code" => 0, "message" => "success"]);
    }


    public function delete(string $id)
    {
        $obj = Notice::find($id);
        if (!$obj) {
            return response()->json(["code" => -1, "msg" => "record miss"]);
        }
        $obj->delete();
        return response()->json(['data' => $obj, "code" => 0, "message" => "success"]);
    }

}
