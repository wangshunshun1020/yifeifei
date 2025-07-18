FROM php:7.4-apache


# 安装GD扩展及依赖
# 更换 apt 源为阿里云 & 升级为 bullseye
# 替换为阿里云 Debian 源，兼容性更强
# 使用 archive.debian.org 代替官方源，避免 404 和 Release 过期问题
# 安装扩展（默认源即可）
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        libfreetype6-dev \
        libjpeg-dev \
        libpng-dev \
        libzip-dev \
        zip unzip && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd pdo pdo_mysql zip && \
    apt-get clean && rm -rf /var/lib/apt/lists/*
# 复制项目代码到容器
COPY . /var/www/html

# 设置 Apache 的根目录为 public
RUN sed -i 's#/var/www/html#/var/www/html/public#g' /etc/apache2/sites-available/000-default.conf

# 设置工作目录
WORKDIR /var/www/html/public

# 开启 Apache mod_rewrite
RUN a2enmod rewrite

# 设置权限（避免权限问题）
RUN chown -R www-data:www-data /var/www/html

# 设置 URL 重写规则（可选）
COPY ./public/.htaccess /var/www/html/public/.htaccess

EXPOSE 80
CMD ["apache2-foreground"]
