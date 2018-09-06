<?php 
namespace app\job;
use think\queue\Job;
use think\facade\Log;

class JobTest
{
	// 任务执行的真正逻辑函数
	public function fire(Job $job,$data)
	{
		$res = $this->fnNum($data);
		if ($res) {
			$job->delete();
			Log::write('success完成，且删除任务');
		}else{
			// 重发，即时执行
			// $job->release();
			// 重发，延迟 2 秒执行
			$job->release(2);
			// 延迟到 2017-02-18 01:01:01 时刻执行
			// $time2wait = strtotime('2017-02-18 01:01:01') - strtotime('now');
			// $job->release($time2wait);
			Log::write('执行失败！');
		}
	}
	// 任务执行失败之后触发
	public function failed($data)
	{
		Log::write('failed  队列执行失败！');
	}
	private function fnNum($data)
	{
		set_time_limit(0);
    	$num = 50;
    	while ($num > 0) {
    		file_get_contents('http://www.baidu.com');
    		$num--;	
    		Log::write('第' . $num . '次');
    	}
    	return true;
	}
}