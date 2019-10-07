<?php

namespace Tasawk\TasawkComponent\Common\Support;

class API {

    static function ApiValidation($Request = [], $rules = [], $except = [], $messages = []) {
        $errors = [];
        $validator = \Validator::make($Request, $rules, $messages);
        if ($validator->fails()) {
            foreach ($validator->errors()->toArray() as $k => $v) {
                if (in_array($k, $except)) {
                    continue;
                }
                $errors[] = [
                    'key' => $k,
                    'value' => __($v[0])
                ];
            }
        }
        return $errors;
    }

    static function ApiSuccessResponse($data = [], $message = '') {
        return self::ApiResponse(200, $data, $message);
    }

    static function ApiAuthResponse($errors = [], $message = 'Unauthorized') {
        return self::ApiResponse(401, [MsgError('Unauthorized', 'please login')], $message);
    }

    static function ApiErrorResponse($errors = [], $message = 'please login') {
        if (isset($errors[0]['value'])) {
            $message = $errors[0]['value'];
        }
        return self::ApiResponse(400, $errors, $message);
    }

    static function ApiResponse($status = 200, $data = [], $message = "") {
        $record['status'] = $status;
        $record['message'] = $message;
        $record['success'] = ($status == 200) ? true : false;
        $record['data'] = $data;
        if (env('APP_API_DEBUG')) {
            $reflector = new \ReflectionClass(explode('@', request()->route()->getActionName())[0]);
            $record['debug']['route'] = [
                'controller' => request()->route()->getAction(),
                'path' => $reflector->getFileName(),
            ];
            //$record['debug']['stack'] = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        }
        return response()->json($record, $status);
    }

}
