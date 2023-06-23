# 介绍

Hyperf 是基于 `Swoole 4.5+` 实现的高性能、高灵活性的 PHP 持久化框架，内置协程服务器及大量常用的组件，性能较传统基于 `PHP-FPM` 的框架有质的提升，提供超高性能的同时，也保持着极其灵活的可扩展性，标准组件均以最新的 [PSR 标准](https://www.php-fig.org/psr) 实现，基于强大的依赖注入设计可确保框架内的绝大部分组件或类都是可替换的。
   
框架组件库除了常见的协程版的 `MySQL 客户端`、`Redis 客户端`，还为您准备了协程版的 `Eloquent ORM`、`GRPC 服务端及客户端`、`Zipkin (OpenTracing) 客户端`、`Guzzle HTTP 客户端`、`Elasticsearch 客户端`、`Consul 客户端`、`ETCD 客户端`、`AMQP 组件`、`Apollo 配置中心`、`基于令牌桶算法的限流器`、`通用连接池` 等组件的提供也省去了自己去实现对应协程版本的麻烦，并提供了 `依赖注入`、`注解`、`AOP 面向切面编程`、`中间件`、`自定义进程`、`事件管理器`、`简易的 Redis 消息队列和全功能的 RabbitMQ 消息队列` 等非常便捷的功能，满足丰富的技术场景和业务场景，开箱即用。

# 框架初衷

尽管现在基于 PHP 语言开发的框架处于一个百花争鸣的时代，但仍旧没能看到一个优雅的设计与超高性能的共存的完美框架，亦没有看到一个真正为 PHP 微服务铺路的框架，此为 Hyperf 及其团队成员的初衷，我们将持续投入并为此付出努力，也欢迎你加入我们参与开源建设。

# 设计理念

`Hyperspeed + Flexibility = Hyperf`，从名字上我们就将 `超高速` 和 `灵活性` 作为 Hyperf 的基因。
   
- 对于超高速，我们基于 Swoole 协程并在框架设计上进行大量的优化以确保超高性能的输出。   
- 对于灵活性，我们基于 Hyperf 强大的依赖注入组件，组件均基于 [PSR 标准](https://www.php-fig.org/psr) 的契约和由 Hyperf 定义的契约实现，达到框架内的绝大部分的组件或类都是可替换的。   

基于以上的特点，Hyperf 将存在丰富的可能性，如实现 Web 服务，网关服务，分布式中间件，微服务架构，游戏服务器，物联网（IOT）等。

# 文档

[https://hyperf.wiki/](https://hyperf.wiki/)

## Gitlab CI

如果需要使用 `Gitlab CI`，可以通过以下方式创建 `Gitlab Runner`。

```shell
sudo gitlab-runner register -n \
--url https://gitlab.com/ \
--clone-url http://your-ip/ \
--registration-token REGISTRATION_TOKEN \
--executor docker \
--description "Unit Runner" \
--docker-image "hyperf/docker-ci:latest" \
--docker-volumes /var/run/docker.sock:/var/run/docker.sock \
--docker-volumes /builds:/builds:rw \
--docker-privileged \
--tag-list "unit" \
--docker-pull-policy "if-not-present"
```

