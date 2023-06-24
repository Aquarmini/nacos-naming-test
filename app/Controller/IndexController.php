<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use App\RPC\CalculatorServiceInterface;

class IndexController extends Controller
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();
        $res = di()->get(CalculatorServiceInterface::class)->calculate(1, 2);
        return $this->response->success([
            'user' => $user,
            'method' => $method,
            'message' => 'Hello Hyperf.',
            'ret' => $res,
        ]);
    }
}
