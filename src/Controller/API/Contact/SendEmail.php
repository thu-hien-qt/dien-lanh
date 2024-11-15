<?php
namespace App\Ecommerce\Controller\API\Contact;

use App\Ecommerce\Services\MailService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class SendEmail
{
    private $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function __invoke(Request $request, Response $response)
    {
        $data = json_decode($request->getBody()->getContents(), true);
    
        if (is_null($data)) {
            $response->getBody()->write(json_encode([
                'status' => 'error',
                'message' => 'Invalid JSON data'
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $requiredFields = ['name', 'phone', 'address', 'productId'];
        
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                $response->getBody()->write(json_encode([
                    'status' => 'error',
                    'message' => "Missing required field: $field"
                ]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
            }
        }
        
        $name = htmlspecialchars($data['name'] ?? '');
        $phone = htmlspecialchars($data['phone'] ?? '');
        $address = htmlspecialchars($data['address'] ?? '');
        $productId = htmlspecialchars($data['productId'] ?? '');

        $subject = "Thông tin liên hệ mới";
        $message = "Tên: $name\nSố điện thoại: $phone\nđịa chỉ: $address\nproductId: $productId";
        $headers = "example@ecommerce.com";


        $emailSent = $this->mailService->sendMail($headers, $subject, $message);

        $response->getBody()->write(json_encode([
            'message' => 'Thông tin đã được gửi thành công!',
            'email_sent' => $emailSent
        ]));
        
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
    }
}
