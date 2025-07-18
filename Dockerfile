# 使用 PHP 7.2 + Apache 官方镜像
FROM php:7.2-apache

# 开启 Apache 的 rewrite 模块
RUN a2enmod rewrite

# 设置工作目录（可根据你实际代码目录调整）
WORKDIR /var/www/html

# 拷贝代码到容器中（假设当前目录为项目根目录）
COPY . /var/www/html/

# 设置 Apache 虚拟主机配置，启用伪静态
RUN echo '<Directory /var/www/html/>' > /etc/apache2/sites-available/000-default.conf && \
    echo '    AllowOverride All' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    Require all granted' >> /etc/apache2/sites-available/000-default.conf && \
    echo '</Directory>' >> /etc/apache2/sites-available/000-default.conf

# 设置默认端口
EXPOSE 80

# 启动 Apache
CMD ["apache2-foreground"]
