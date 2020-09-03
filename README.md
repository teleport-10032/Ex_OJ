# 一个尚不成熟的onlineJudge系统

>​	这是一个基于lamp环境的在线判题系统。前端使用Bootstrap，后台使用php，judger使用python,部分地方使用了开源项目[Lo-runner](https://github.com/dojiong/Lo-runner)。
>
>​	功能方面有问题列表，比赛列表，rank，admin等等常规的东西。
>
>​	目前仅仅是能用的地步，各方面都不完善，也可能充斥着难以言喻的bug。空出时间来就维护维护，也有可能咕咕咕。
>
>​	您也可以下载下来玩玩但**千万不要用于生产环境**。



### 如果您要安装试用，请使用以下步骤

1.安装docker，这里我的机器是ubuntu18，用的是以下脚本:

`curl -sSL https://get.daocloud.io/docker | sh`

**您应当根据自己的系统版本进行安装。**



2.拉取镜像。建议配置加速器

`docker pull yuukiiiqwq/ex_oj:v8.7`



3.找一个空间充足的路径，下载数据库文件并解压,给足权限。我图方便直接777了，各位爷看着点给

` wget test.k423.tech/ex_oj_mysql_data.zip&&unzip ex_oj_mysql_data.zip&&chmod -R 777 ex_oj_mysql_data`



4.运行拉取的镜像

> 参数解释：
>
> * -d 后台运行 
>
> * –name 指定生成容器的名字
>
> * -p 容器端口映射，下面是将容器的80，3306端口映射到本机的81，3301端口
>
> * -v 文件映射。将本地的文件(夹)与容器内的同步。[]内根据自身情况填写本机ex_oj_mysql_data文件夹的路径，如-v /home/ex_oj_mysql_data:/var/lib/mysql
> * 请根据自身情况设定参数

`docker run -d --name ex_oj -p 81:80 -p 3301:3306 -v []:/var/lib/mysql yuukiiiqwq/ex_oj:v8.7`



5.进入docker容器。开启判题服务

```
docker exec -it ex_oj bash
chmod -R 777 /var/www/html/judger/
nohup python3 /var/www/html/judger/demo/judger.py				
```



注:请不要ctrl+C结束判题服务，**直接关闭终端窗口**以保持判题服务的后台运行。

***

至此完成。

判题日志保存在容器中/var/www/html/judger/demo/路径下



请使用localhost:81(或您设置的端口号)访问

默认管理员用户名密码：[root@qq.com](mailto:root@qq.com) rootroot，及时更改





>后记
>
>目前只支持C，其实C++原理是一样的，JAVA可能稍麻烦点
>
>没有演示站，太穷了
>
>////////////////
