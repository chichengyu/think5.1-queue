<?php
namespace app\index\controller;
use app\job\JobTest;
use think\facade\Log;

class Index
{
    public function index()
    {	
        // $redis = new \Redis();
        // $redis->connect('127.0.0.1',6379);
        // $redis->setex('name',15,'小二');
        // $redis->set('name','小三',15);
        // $redis->ttl('name');
        // $redis->set('age',18);
        // $redis->clear();
        // $redis->del('name');
        // dump($redis->ttl('name'));// 查看还剩下多少时间过期
        // dump($redis->get('name'));
    }
    public function test()
    {
    	// set_time_limit(0);
    	// $num = 500;
    	// while ($num > 0) {
    	// 	file_get_contents('http://www.baidu.com');
    	// 	$num--;	
    	// }
    	// 添加一个任务队列
    	queue(JobTest::class,'');
    	echo "执行完成";
    }
}
