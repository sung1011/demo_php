<?php
namespace App;

class Application extends BaseClient
{
    /**
     * 运行
     *
     * @return void
     */
    public function run()
    {
        $crawler = $this->request('GET', 'http://symfony.com');
    }
    
    /**
     * 响应处理
     *
     * @param array $request 请求
     * @return void
     */
    protected function doRequest($request)
    {
        dump($request);
        // ... convert request into a response
        $content = [
            'a', 'b', 'c'
        ];
        $status = 200;
        $headers = [

        ];
        
        return new Response($content, $status, $headers);
    }
}