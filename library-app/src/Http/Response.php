<?php

namespace Http;

class Response
{

    public function success(array $data = []): void {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
    
        $response = ['result' => 'ok'];
    
        if (!empty($data)) {
            $response['data'] = $data;
        }
    
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        return;
    }

    public function error($message, $code = 400): void
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($code);
        echo json_encode([
            'status' => 'error',
            'message' => $message
        ], JSON_UNESCAPED_UNICODE);
    }
}
