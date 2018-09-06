# think5.1-queue

本次使用的是redis

首先安装thinkphp-queue扩展包
	composer require topthink/think-queue
	官方包下载与示例文档：https://github.com/top-think/think-queue

然后配置

	配置文件位于 /config/queue.php

	'connector' => 'Redis',
    'expire'     => 60,
    'default'    => 'default',
    'host'       => '127.0.0.1',
    'port'       => 6379,
    'password'   => '',
    'select'     => 0,
    'timeout'    => 0,
    'persistent' => false,
	注：各个驱动的具体可用配置项在think\queue\connector目录下各个驱动类里的options属性中，写在上面的queue配置里即可覆盖


创建任务类

	单模块项目推荐使用 app\job 作为任务类的命名空间 多模块项目可用使用 app\module\job 作为任务类的命名空间 也可以放在任意可以自动加载到的地方

	任务类不需继承任何类，如果这个类只有一个任务，那么就只需要提供一个fire方法就可以了，如果有多个小任务，就写多个方法，下面发布任务的时候会有区别，每个方法会传入两个参数 think\queue\Job $job（当前的任务对象） 和 $data（发布任务时自定义的数据）

	还有个可选的任务失败执行的方法 failed 传入的参数为$data（发布任务时自定义的数据）

	具体可以查看文件index.php添加任务 与 JobTest.php文件任务类

发布任务

	think\Queue::push($job, $data = '', $queue = null) 和 think\Queue::later($delay, $job, $data = '', $queue = null) 两个方法，前者是立即执行，后者是在$delay秒后执行

	而我为了方便，使用的是函数queue(),直接添加

监听任务并执行：
	命令行输入如下进行监听并执行：

	php think queue:listen

	php think queue:work --daemon（不加--daemon为执行单个任务）

	两种，具体的可选参数可以输入命令加 --help 查看

	可配合supervisor使用，保证进程常驻