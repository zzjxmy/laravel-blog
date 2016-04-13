<?php
require __DIR__.'/../vendor/autoload.php';
//把所有的全局变量加载为自己的属性   $_POST  $_GET  $_REQUEST  $_SERVER
$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
/*
 * 1、得到request请求信息
 * 2、设置路由 Route
 * 3、封装请求上下文 RequestContext
 * 4、根据request匹配路由 UrlMatcher
 * 5、控制器转换 ControllerResolver
 * 6、反射，参数的设置 getArguments
 * 7、返回信息  reponse
 * */
//test.php?name=zhangzhijan
//echo $request->get('name');  //输出  zhangzhijian
//获取请求路径
//echo $request->getPathInfo();
//new 一个响应对象
// = new \Symfony\Component\HttpFoundation\Response();
//设置响应内容
//$response->setContent('aaaa');
//设置头信息
//$response->headers->set('author','Zhang zhijian');
//发送响应的内容
//$response->send();

//new 一个路由集合
$routes = new \Symfony\Component\Routing\RouteCollection();
//设置路由
$routes->add('/login',new \Symfony\Component\Routing\Route('/login',[
	'_controller'=>function(){
		return 'login ... ';
	}
]));
$routes->add('/logout',new \Symfony\Component\Routing\Route('/logout',[
	'_controller'=>function(){
		return 'logout ... ';
	}
]));

class FooController{
	public function test($id = 1){
		return 'test'.$id;
	}
}

$routes->add('/foo',new \Symfony\Component\Routing\Route('/foo/{id}',[
	'_controller'=>'FooController::test'
]));

//封装请求上下文
$content = new \Symfony\Component\Routing\RequestContext();
//设置请求对象
$content->fromRequest($request);
//new  url匹配器  匹配路由
$macther = new \Symfony\Component\Routing\Matcher\UrlMatcher($routes,$content);
//http://www.laraveldemo.com/test.php/login
//必须的匹配设置的路由，否则会报错  如  /login
$result = $macther->match($request->getPathInfo());
//var_dump($result); //array(2) { ["_controller"]=> object(Closure)#14 (0) { } ["_route"]=> string(6) "/login" }
//调用闭包函数
//echo $result['_controller'](); //login ...

//把匹配的路由放入到request中，以便控制器转换
$request->attributes->add($result);


//封装请求
class Httpkenel{
	public function handle(\Symfony\Component\HttpFoundation\Request $request){

		//如果路由不是闭包函数，则需要引入控制器转换
		$resolver = new \Symfony\Component\HttpKernel\Controller\ControllerResolver();

		//传递请求信息 返回转换后的路由
		//http://www.laraveldemo.com/test.php/foo
		$controller = $resolver->getController($request);
		//var_dump($controller); //array(2) { [0]=> object(FooController)#20 (0) { } [1]=> string(4) "test" }
		//call_user_func_array 把第一个参数作为回调函数调用

		//参数反射，看函数中需要哪些参数  参数的依赖注入
		$params = $resolver->getArguments($request,$controller);
		//var_dump($params);exit;
		//echo call_user_func_array($controller,$params); //test

		$content = call_user_func_array($controller,$params); //test
		//如果是响应对象，则直接返回响应对象
		if($content instanceof \Symfony\Component\HttpFoundation\Response ){
			return $content;
		}
		$response = new \Symfony\Component\HttpFoundation\Response();
		$response->setContent($content);
		return $response;
	}
}

$kernel = new Httpkenel();
$response = $kernel->handle($request);
$response->send();