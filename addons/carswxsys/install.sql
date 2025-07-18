CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_adv`  (
  `id` bigint(16) NOT NULL AUTO_INCREMENT,
  `advname` varchar(60)  NULL DEFAULT NULL,
  `link` varchar(255)  NULL DEFAULT '',
  `thumb` varchar(255)  NULL DEFAULT '',
  `sort` bigint(16) NULL DEFAULT 0,
  `enabled` bigint(16) NULL DEFAULT 0,
  `toway` varchar(30)  NULL DEFAULT NULL,
  `appid` varchar(50)  NULL DEFAULT NULL,
  `cityid` bigint(16) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `indx_enabled`(`enabled`) USING BTREE,
  INDEX `indx_displayorder`(`sort`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 225 DEFAULT CHARSET=utf8mb4 ;


CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_province`  (
  `id` bigint(16) NOT NULL AUTO_INCREMENT COMMENT '地区id',
  `name` varchar(100) NULL DEFAULT NULL,
  `pid` bigint(16) NULL DEFAULT NULL COMMENT '父id',
  `level` tinyint(1) NULL DEFAULT NULL COMMENT '1:省  2:市  3:区',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4480 DEFAULT CHARSET=utf8mb4 ;



CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_city`  (
  `id` bigint(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(50)  NULL DEFAULT '',
  `sort` bigint(16) NULL DEFAULT 0,
  `enabled` bigint(16) NULL DEFAULT 0,
  `firstname` varchar(30)  NULL DEFAULT NULL,
  `ison` tinyint(10) NULL DEFAULT 0,
  `ishot` tinyint(10) NOT NULL DEFAULT 0,
  `update_time` bigint(16) NOT NULL DEFAULT 0,
  `create_time` bigint(16) NOT NULL DEFAULT 0,
  `pid` bigint(16) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `indx_enabled`(`enabled`) USING BTREE,
  INDEX `indx_displayorder`(`sort`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1834 DEFAULT CHARSET=utf8mb4 ;

CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_area`  (
  `id` bigint(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(50)  NULL DEFAULT '',
  `sort` bigint(16) NULL DEFAULT 0,
  `enabled` bigint(16) NULL DEFAULT 0,
  `cityid` bigint(16) NULL DEFAULT 0,
  `update_time` bigint(16) NOT NULL DEFAULT 0,
  `create_time` bigint(16) NOT NULL DEFAULT 0,
  `pid` bigint(16) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `indx_enabled`(`enabled`) USING BTREE,
  INDEX `indx_displayorder`(`sort`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3207 DEFAULT CHARSET=utf8mb4 ;



CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_sysinit`  (
  `id` bigint(16) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(30)  NULL DEFAULT NULL,
  `view` bigint(16) NOT NULL DEFAULT 0,
  `content` text  NULL,
  `rate1` float(10, 2) NOT NULL DEFAULT 0.00,
  `rate2` float(10, 2) NOT NULL DEFAULT 0.00,
  `rate3` float(10, 2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 53 DEFAULT CHARSET=utf8mb4 ;


CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_user`  (
  `id` bigint(16) NOT NULL AUTO_INCREMENT,
  `openid` varchar(50)  NOT NULL,
  `nickname` varchar(50) NULL DEFAULT NULL,
  `extend` varchar(255) NULL DEFAULT NULL,
  `delete_time` bigint(16) NULL DEFAULT NULL,
  `create_time` bigint(16) NULL DEFAULT NULL COMMENT '注册时间',
  `update_time` bigint(16) NULL DEFAULT NULL,
  `avatarUrl` varchar(200) NULL DEFAULT NULL,
  `tid` bigint(16) NOT NULL DEFAULT 0,
  `fxuid1` bigint(16) NOT NULL DEFAULT 0,
  `fxuid2` bigint(16) NULL DEFAULT 0,
  `tel` varchar(60) NULL DEFAULT NULL,
  `rectid` bigint(16) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `openid`(`openid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 157 DEFAULT CHARSET=utf8mb4 ;


CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_nav`  (
  `id` bigint(16) NOT NULL AUTO_INCREMENT,
  `advname` varchar(50)  NULL DEFAULT '',
  `link` varchar(255)  NULL DEFAULT '',
  `thumb` varchar(255)  NULL DEFAULT '',
  `sort` bigint(16) NULL DEFAULT 0,
  `enabled` bigint(16) NULL DEFAULT 0,
  `appid` varchar(60)  NULL DEFAULT NULL,
  `innerurl` varchar(255)  NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `indx_enabled`(`enabled`) USING BTREE,
  INDEX `indx_displayorder`(`sort`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 368 DEFAULT CHARSET=utf8mb4 ;



CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_cate`  (
  `id` bigint(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(50)  NULL DEFAULT '',
  `sort` bigint(16) NULL DEFAULT 0,
  `enabled` bigint(16) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `indx_enabled`(`enabled`) USING BTREE,
  INDEX `indx_displayorder`(`sort`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 848 DEFAULT CHARSET=utf8mb4 ;


CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_news`  (
  `id` bigint(16) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(200)  NULL DEFAULT NULL,
  `createtime` bigint(16) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `content` text  NOT NULL COMMENT '文章内容',
  `sort` bigint(16) NULL DEFAULT 0,
  `hits` bigint(16) NULL DEFAULT 0,
  `status` tinyint(10) NULL DEFAULT 0,
  `thumb` varchar(200)  NULL DEFAULT NULL,
  `cateid` bigint(16) NULL DEFAULT 0,
  `type` tinyint(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 65 DEFAULT CHARSET=utf8mb4 ;


CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_lookrole`  (
  `id` bigint(16) NOT NULL AUTO_INCREMENT,
  `title` varchar(30)  NULL DEFAULT NULL,
  `money` decimal(10, 2)  DEFAULT 0.00,
  `sort` bigint(16) NULL DEFAULT 0,
  `enabled` bigint(16) NULL DEFAULT 0,
  `days` bigint(16) NULL DEFAULT 0,
  `isinit` tinyint(10) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `indx_enabled`(`enabled`) USING BTREE,
  INDEX `indx_displayorder`(`sort`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 128 DEFAULT CHARSET=utf8mb4 ;




CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_carsave`  (
  `id` bigint(16) NOT NULL AUTO_INCREMENT,
  `uid` bigint(16) NULL DEFAULT 0,
  `carid` bigint(16) NULL DEFAULT 0,
  `createtime` bigint(16) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `status` tinyint(10) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 248 DEFAULT CHARSET=utf8mb4 ;



CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_brandcars`  (
  `id` bigint(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NULL DEFAULT '',
  `sort` bigint(16) NULL DEFAULT 0,
  `enabled` bigint(16) NULL DEFAULT 0,
  `thumb` varchar(100) NULL DEFAULT NULL,
  `pid` bigint(16) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `indx_enabled`(`enabled`) USING BTREE,
  INDEX `indx_displayorder`(`sort`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 290 DEFAULT CHARSET=utf8mb4 ;



CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_cars`  (
  `id` bigint(16) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(200)  NULL DEFAULT NULL,
  `money` float(10, 2) NULL DEFAULT 0.00,
  `newmoney` float(10, 2) NULL DEFAULT NULL,
  `carkm` varchar(30)  NOT NULL DEFAULT '0.00',
  `cartype` varchar(30)  NULL DEFAULT NULL,
  `carnumdate` varchar(10)  NULL DEFAULT NULL,
  `brandid` bigint(16) NULL DEFAULT 0,
  `carchange` varchar(30)  NULL DEFAULT NULL,
  `carrate` varchar(30)  NULL DEFAULT NULL,
  `carcolor` varchar(30)  NULL DEFAULT NULL,
  `status` tinyint(10) NULL DEFAULT 0,
  `thumb` varchar(200)  NULL DEFAULT NULL,
  `isrecommand` tinyint(10) NULL DEFAULT 0,
  `sort` bigint(16) NULL DEFAULT 0,
  `createtime` bigint(16) NULL DEFAULT 0,
  `content` text  NULL,
  `thumb_url` text  NULL,
  `carspl` bigint(16) NULL DEFAULT 0,
  `ischeck` tinyint(10) NULL DEFAULT 0,
  `uid` bigint(16) NULL DEFAULT 0,
  `cityid` bigint(16) NOT NULL DEFAULT 0,
  `shopid` bigint(16) NOT NULL DEFAULT 0,
  `areaid` bigint(16) NOT NULL DEFAULT 0,
  `carage` bigint(16) NOT NULL DEFAULT 0,
  `carpos` varchar(30)  NULL DEFAULT NULL,
  `per` varchar(30)  NULL DEFAULT NULL,
  `carfuel` varchar(30)  NULL DEFAULT NULL,
  `chatlink` varchar(200)  NULL DEFAULT NULL,
  `issale` tinyint(10) NOT NULL DEFAULT 0,
  `tel` varchar(60)  NULL DEFAULT NULL,
  `sbrandid` bigint(16) NOT NULL DEFAULT 0,
  `provinceid` bigint(16) NULL DEFAULT NULL,
  `special` varchar(200)  NULL DEFAULT NULL,
  `toptime` bigint(16) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 291 DEFAULT CHARSET=utf8mb4 ;



CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_order`  (
  `id` bigint(16) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(20)  NOT NULL COMMENT '订单号',
  `user_id` bigint(16) NOT NULL COMMENT '外键，用户id，注意并不是openid',
  `delete_time` bigint(16) NULL DEFAULT NULL,
  `create_time` bigint(16) NULL DEFAULT NULL,
  `total_price` decimal(6, 2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:未支付， 2：已支付，3：已发货 , 4: 已支付，但库存不足',
  `snap_img` varchar(255)  NULL DEFAULT NULL COMMENT '订单快照图片',
  `snap_name` varchar(80)  NULL DEFAULT NULL COMMENT '订单快照名称',
  `total_count` bigint(16) NOT NULL DEFAULT 0,
  `update_time` bigint(16) NULL DEFAULT NULL,
  `snap_items` text  NULL COMMENT '订单其他信息快照（json)',
  `snap_address` varchar(500)  NULL DEFAULT NULL COMMENT '地址快照',
  `prepay_id` varchar(100)  NULL DEFAULT NULL COMMENT '订单微信支付的预订单id（用于发送模板消息）',
  `ordertype` varchar(30)  NULL DEFAULT NULL,
  `companyid` int(10) NOT NULL DEFAULT 0,
  `pid` bigint(16) NULL DEFAULT 0,
  `roleid` bigint(16) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `order_no`(`order_no`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 292 DEFAULT CHARSET=utf8mb4 ;


CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_ploite`  (
  `id` bigint(16) NOT NULL AUTO_INCREMENT,
  `type` tinyint(10) NULL DEFAULT 0,
  `content` varchar(200)  NULL DEFAULT NULL,
  `uid` bigint(16) NULL DEFAULT 0,
  `createtime` bigint(16) NULL DEFAULT 0,
  `enabled` bigint(16) NULL DEFAULT 0,
  `pid` bigint(16) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `indx_enabled`(`enabled`) USING BTREE,
  INDEX `indx_displayorder`(`createtime`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 293 DEFAULT CHARSET=utf8mb4 ;


CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_brand`  (
  `id` bigint(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(50)  NULL DEFAULT '',
  `sort` bigint(16) NULL DEFAULT 0,
  `enabled` bigint(16) NULL DEFAULT 0,
  `thumb` varchar(100)  NULL DEFAULT NULL,
  `firstname` varchar(30)  NULL DEFAULT NULL,
  `pinyin` varchar(30)  NULL DEFAULT NULL,
  `isrecommend` bigint(16) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `indx_enabled`(`enabled`) USING BTREE,
  INDEX `indx_displayorder`(`sort`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 294 DEFAULT CHARSET=utf8mb4 ;


CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_carprice`  (
  `id` bigint(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(50)  NULL DEFAULT '',
  `beginprice` bigint(16) NULL DEFAULT 0,
  `endprice` bigint(16) NULL DEFAULT 0,
  `sort` bigint(16) NULL DEFAULT 0,
  `enabled` bigint(16) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `indx_enabled`(`enabled`) USING BTREE,
  INDEX `indx_displayorder`(`sort`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 295 DEFAULT CHARSET=utf8mb4 ;


CREATE TABLE IF NOT EXISTS `__PREFIX__carswxsys_guest`  (
  `id` bigint(16) NOT NULL AUTO_INCREMENT,
  `uid` bigint(16) NULL DEFAULT 0,
  `carid` bigint(16) NULL DEFAULT 0,
  `createtime` bigint(16) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `status` tinyint(10) NULL DEFAULT 0,
  `num` bigint(10) NULL DEFAULT 0,
  `updatetime` bigint(10) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 298 DEFAULT CHARSET=utf8mb4 ;

-- 1.0.4 --

ALTER TABLE `__PREFIX__carswxsys_cars` ADD COLUMN `per` varchar(16) NULL DEFAULT ''  COMMENT '排量单位' AFTER `toptime`;










