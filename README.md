weatherAPI
==========

前一阵写应用玩，想找个天气的接口直接调用，[找了半天](http://lihua.net.blog.163.com/blog/static/2707299120122825251513/)还是感觉“[中国天气网](http://www.weather.com.cn/)”的数据全点：

* 六日天气：http://m.weather.com.cn/data/101050101.html
* 实时天气：http://www.weather.com.cn/data/sk/101010100.html

正打算用时发现它的接口不是 jsonp 的，JS 无法直接调用，唉...无奈啊不会后端。

继续找啊找，发现这篇帖子“[宋体代码介绍一个JSONP 跨域访问代理API](http://blog.csdn.net/javawebsoa/article/details/8853997)”，Yahoo 的 [YQL](http://developer.yahoo.com/yql/) 可以做跨域代理，我真是 out 了。立即用之，开始很爽，后来发现它的服务器在国外，加载太慢了......

搞个天气预报怎么这么悲催，我看别人挺 easy 的呀！

无耐继续找啊找......换个策略，看看有没有 php 写的 jsonp 接口，我找个服务器托管；啊哈，发现了这位哥的代码：[https://github.com/lyonna/php-weather-info-cn](https://github.com/lyonna/php-weather-info-cn)，可是还不是 jsonp 的，唉...想省力好难啊，请教请教朋友，自己改个 jsonp 接口吧。

以下是我改完的 jsonp 接口（接口托管在 BAE 上）：

```js
/*
* cid: 城市代码
* callback: 回调函数
*/
```

* 六日天气接口：
http://jinlongz.duapp.com/weather.php?cid=101010100&callback=cb

* 实时接口：
http://jinlongz.duapp.com/weatherLive.php?cid=101010100&callback=cb

>再次感谢这位兄台：[lyonna](https://github.com/lyonna/php-weather-info-cn)




