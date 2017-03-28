部署要求：
1.修改app目录下database.php中的MySQL用户名和密码以及端口
2.修改app目录下config.php中最后的WEB_ROOT配置，地址为public目录的上一级目录且不带最后一个反斜杠（/）
3.入口文件为public目录下的index.php
4.vote_system.sql为数据库文件，里面默认含有一个等级为4的管理员用户admin，登陆密码为admin，用该用户登录可以添加用户。
5.如果部署到Linux服务器，请修改runtime文件夹和public文件夹下的uploads文件夹（如果没有可手动创建）的权限，使其拥有写入权限。
环境要求：
PHP7.0以上+MySQL+Apache
