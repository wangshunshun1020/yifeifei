FROM php:7.2-apache

# 安装依赖
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# 开启 rewrite 模块
RUN a2enmod rewrite

# 复制项目代码
COPY . /var/www/html

# 设置权限（可选）
RUN chown -R www-data:www-data /var/www/html

# 设置工作目录为 public
WORKDIR /var/www/html/public

# 设置 Apache 的运行目录为 public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# 启用 .htaccess 支持
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
