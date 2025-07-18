FROM php:7.2-apache

# 安装扩展
RUN docker-php-ext-install pdo pdo_mysql

# 复制项目代码到容器
COPY . /var/www/html

# 设置 Apache 的根目录为 public
RUN sed -i 's#/var/www/html#/var/www/html/public#g' /etc/apache2/sites-available/000-default.conf

# 设置工作目录
WORKDIR /public

# 开启 Apache mod_rewrite
RUN a2enmod rewrite

# 设置 URL 重写规则（可选）
COPY ./public/.htaccess /var/www/html/public/.htaccess

EXPOSE 80
CMD ["apache2-foreground"]
