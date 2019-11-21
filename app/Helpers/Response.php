<?php
/**
 * Manage response to be returned in json fomate.
 */

 /* succes response  */
  function successResponse($message = null)
   {
        return response()->json(
            [
                'success' => true,
                'status_code' => 200,
                'message' => $message
            ]
            , 200);
   }
   
    /* success response with data **/
    function successResponseWithData($data, $message = null)
    {
        $data = [
            'success' => true,
            'status_code' => 200,
            'data' => $data,
            'message' => $message
        ];
        return response()->json($data, 200);
    }

    /* validation errors */
    function validationErrors($errors, $message = null)
    {
        $data = [
                        'status' => false,
                        'message' => (empty($message)) ? __('response.invalid_data') : $message,
                        'errors' => $errors,
                    ];
        
                return response()->json($data, 422);
    }

    function notFoundResponse($message)
    {
        return response()->json(['status' => 'error', 'message' => $message], 404);
    }
