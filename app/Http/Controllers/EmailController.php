<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmailController extends Controller
{
    /**
     * Send array of emails, request must contains array of email arrays,
     * each email array contains (recipient email address, email subject, email body, array of attachments)
     * each attachment contains the name of file and the file content as base64
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        try {

            return response()->json([
                'message' => 'Emails queued successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getTrace()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
