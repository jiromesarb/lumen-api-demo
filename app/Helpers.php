<?php

function apiReturn ($data = [], $message = 'Success', $status = 'success', $errors = []) {

    $return = [
        'data' => $data,
        'message' => $message,
        'status' => $status,
    ];

    if(!empty($errors)){
        $return['errors'] = $errors;
    }

    return response()->json($return);
}
