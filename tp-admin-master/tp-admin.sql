/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tp-admin

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-12-20 16:37:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ta_auth_access
-- ----------------------------
DROP TABLE IF EXISTS `ta_auth_access`;
CREATE TABLE `ta_auth_access` (
  `role_id` mediumint(8) unsigned NOT NULL COMMENT '角色',
  `rule_id` mediumint(8) unsigned NOT NULL COMMENT '规则唯一英文标识,全小写',
  KEY `role_id` (`role_id`),
  KEY `rule_name` (`rule_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限授权表';

-- ----------------------------
-- Records of ta_auth_access
-- ----------------------------
INSERT INTO `ta_auth_access` VALUES ('2', '3');
INSERT INTO `ta_auth_access` VALUES ('1', '2');
INSERT INTO `ta_auth_access` VALUES ('2', '1');
INSERT INTO `ta_auth_access` VALUES ('3', '2');

-- ----------------------------
-- Table structure for ta_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `ta_auth_rule`;
CREATE TABLE `ta_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `rule_val` varchar(255) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识,全小写',
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '父类ID',
  `update_time` int(11) DEFAULT NULL COMMENT '账户最后更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='权限规则表';

-- ----------------------------
-- Records of ta_auth_rule
-- ----------------------------
INSERT INTO `ta_auth_rule` VALUES ('1', '内容管理', 'admin/index/index', '3', '1484209924', null);
INSERT INTO `ta_auth_rule` VALUES ('2', '用户管理', 'admin/user/index', '6', '1484145913', null);
INSERT INTO `ta_auth_rule` VALUES ('3', 'Admin/Index', 'admin/index', '0', '1483502713', null);
INSERT INTO `ta_auth_rule` VALUES ('4', 'Admin/Sdd', 'admin/sdd', '0', '1484131420', null);
INSERT INTO `ta_auth_rule` VALUES ('6', 'Admin/User', 'admin/user', '0', '1484145913', null);
INSERT INTO `ta_auth_rule` VALUES ('7', 'niu', 'admin/user/index', '6', null, null);

-- ----------------------------
-- Table structure for ta_bank
-- ----------------------------
DROP TABLE IF EXISTS `ta_bank`;
CREATE TABLE `ta_bank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(20) DEFAULT NULL COMMENT '用户id',
  `BankID` varchar(50) DEFAULT NULL COMMENT '银行名称',
  `Address_P` text COMMENT '开户省',
  `Address_C` text COMMENT '开户市',
  `RealName` varchar(100) DEFAULT '1' COMMENT '开户人姓名',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `BankNum` int(100) DEFAULT '0' COMMENT '银行卡号',
  `update_time` int(11) DEFAULT NULL COMMENT '最后更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='用户提现账户表';

-- ----------------------------
-- Records of ta_bank
-- ----------------------------
INSERT INTO `ta_bank` VALUES ('14', '1', '1', '1', '0', '112', '1511430665', '123', '1511430665', null);
INSERT INTO `ta_bank` VALUES ('15', '2', '1', '1', '0', '112', '1511430702', '123', '1511430702', null);
INSERT INTO `ta_bank` VALUES ('16', '3', '1', '0', '0', '1', '1511430883', '1', '1511430883', null);
INSERT INTO `ta_bank` VALUES ('17', '5', '0', '福建', '厦门', '111', '1512727721', '111', '1512727721', null);

-- ----------------------------
-- Table structure for ta_log_record
-- ----------------------------
DROP TABLE IF EXISTS `ta_log_record`;
CREATE TABLE `ta_log_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `os` varchar(18) DEFAULT NULL,
  `browser` varchar(30) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COMMENT='后台操作日志记录';

-- ----------------------------
-- Records of ta_log_record
-- ----------------------------
INSERT INTO `ta_log_record` VALUES ('1', '1', '222.27.239.218', 'Mac OS X 10_12_', 'chrome-55', '登录成功', '1484060254');
INSERT INTO `ta_log_record` VALUES ('2', '1', '222.27.239.218', 'Mac OS X 10_12_', 'safari-602', '登录成功', '1484060459');
INSERT INTO `ta_log_record` VALUES ('3', '1', '222.27.239.218', 'Mac OS X 10_12_', 'chrome-55', '登录成功', '1484060708');
INSERT INTO `ta_log_record` VALUES ('4', '1', '113.222.206.111', 'Windows 7', 'ie-9', '登录成功', '1484060921');
INSERT INTO `ta_log_record` VALUES ('5', '1', '139.207.155.229', 'Mac OS X', 'weixin-unknow', '登录成功', '1484061486');
INSERT INTO `ta_log_record` VALUES ('6', '1', '182.97.181.146', 'Linux', 'chrome-37', '登录成功', '1484062192');
INSERT INTO `ta_log_record` VALUES ('7', '1', '113.222.206.111', 'Linux', 'safari-537', '登录成功', '1484062207');
INSERT INTO `ta_log_record` VALUES ('8', '1', '123.120.79.206', 'Mac OS X', 'weixin-unknow', '登录成功', '1484062408');
INSERT INTO `ta_log_record` VALUES ('9', '1', '125.86.6.113', 'Mac OS X', 'weixin-unknow', '登录成功', '1484063111');
INSERT INTO `ta_log_record` VALUES ('10', '1', '222.27.239.238', 'Mac OS X', 'weixin-unknow', '登录成功', '1484063143');
INSERT INTO `ta_log_record` VALUES ('11', '1', '61.148.244.238', 'Linux', 'chrome-37', '登录成功', '1484064316');
INSERT INTO `ta_log_record` VALUES ('12', '1', '123.139.67.253', 'Mac OS X', 'weixin-unknow', '登录成功', '1484064900');
INSERT INTO `ta_log_record` VALUES ('13', '1', '123.139.67.253', 'Mac OS X', 'weixin-unknow', '登录成功', '1484064944');
INSERT INTO `ta_log_record` VALUES ('14', '1', '139.207.155.229', 'Mac OS X', 'weixin-unknow', '登录成功', '1484066819');
INSERT INTO `ta_log_record` VALUES ('15', '1', '139.207.155.229', 'Mac OS X', 'safari-602', '登录成功', '1484066888');
INSERT INTO `ta_log_record` VALUES ('16', '1', '223.104.38.32', 'Linux', 'chrome-37', '登录成功', '1484083750');
INSERT INTO `ta_log_record` VALUES ('17', '1', '223.104.3.242', 'Mac OS X', 'weixin-unknow', '登录成功', '1484088069');
INSERT INTO `ta_log_record` VALUES ('18', '1', '113.5.2.39', 'Linux', 'chrome-37', '登录成功', '1484094131');
INSERT INTO `ta_log_record` VALUES ('19', '1', '171.210.178.136', 'Mac OS X', 'weixin-unknow', '登录成功', '1484096723');
INSERT INTO `ta_log_record` VALUES ('20', '1', '183.38.245.12', 'Windows 7', 'chrome-55', '登录成功', '1484100769');
INSERT INTO `ta_log_record` VALUES ('21', '1', '183.38.245.14', 'Windows 7', 'chrome-55', '登录成功', '1484102239');
INSERT INTO `ta_log_record` VALUES ('22', '1', '183.38.245.14', 'Windows 7', 'firefox-50', '登录成功', '1484102289');
INSERT INTO `ta_log_record` VALUES ('23', '1', '183.38.245.12', 'Windows 7', 'chrome-45', '登录成功', '1484102304');
INSERT INTO `ta_log_record` VALUES ('24', '1', '58.38.116.152', 'Mac OS X', 'firefox-41', '登录成功', '1484105088');
INSERT INTO `ta_log_record` VALUES ('25', '1', '106.117.103.55', 'Windows 7', 'chrome-55', '登录成功', '1484106130');
INSERT INTO `ta_log_record` VALUES ('26', '1', '115.197.247.63', 'Windows 7', 'chrome-50', '登录成功', '1484119618');
INSERT INTO `ta_log_record` VALUES ('27', '1', '115.218.170.230', 'Windows 10', 'chrome-54', '登录成功', '1484120310');
INSERT INTO `ta_log_record` VALUES ('28', '1', '101.227.12.253', 'Windows 7', 'chrome-55', '登录成功', '1484121590');
INSERT INTO `ta_log_record` VALUES ('29', '1', '113.15.4.121', 'Windows NT', 'ie-7', '登录成功', '1484123500');
INSERT INTO `ta_log_record` VALUES ('30', '1', '36.47.163.248', 'Windows 7', 'chrome-55', '登录成功', '1484126769');
INSERT INTO `ta_log_record` VALUES ('31', '1', '183.16.5.35', 'Windows 10', 'ie-7', '登录成功', '1484127187');
INSERT INTO `ta_log_record` VALUES ('32', '1', '139.207.177.235', 'Mac OS X', 'weixin-unknow', '登录成功', '1484130280');
INSERT INTO `ta_log_record` VALUES ('33', '1', '115.206.55.15', 'Windows 7', 'ie-7', '登录成功', '1484130601');
INSERT INTO `ta_log_record` VALUES ('34', '1', '115.206.55.15', 'Windows 7', 'chrome-45', '登录成功', '1484131585');
INSERT INTO `ta_log_record` VALUES ('35', '1', '117.136.7.253', 'Linux', 'chrome-37', '登录成功', '1484133230');
INSERT INTO `ta_log_record` VALUES ('36', '1', '222.27.239.216', 'Mac OS X 10_12_2', 'chrome-55', '登录成功', '1484134228');
INSERT INTO `ta_log_record` VALUES ('37', '1', '222.137.71.212', 'Linux', 'firefox-45', 'Login succeed', '1484137092');
INSERT INTO `ta_log_record` VALUES ('38', '1', '222.27.239.210', 'Mac OS X 10_12_2', 'chrome-55', '登录成功', '1484144296');
INSERT INTO `ta_log_record` VALUES ('39', '1', '121.31.153.106', 'Windows NT', 'chrome-45', '登录成功', '1484145800');
INSERT INTO `ta_log_record` VALUES ('40', '1', '115.181.78.228', 'Windows 10', 'chrome-49', '登录成功', '1484145832');
INSERT INTO `ta_log_record` VALUES ('41', '1', '121.31.153.106', 'Windows NT', 'chrome-45', 'Login succeed', '1484145985');
INSERT INTO `ta_log_record` VALUES ('42', '1', '115.181.78.100', 'Windows 10', 'chrome-49', '登录成功', '1484149306');
INSERT INTO `ta_log_record` VALUES ('43', '1', '111.199.31.7', 'Windows 7', 'firefox-50', '登录成功', '1484150334');
INSERT INTO `ta_log_record` VALUES ('44', '1', '120.4.179.43', 'Windows 7', 'chrome-54', '登录成功', '1484152588');
INSERT INTO `ta_log_record` VALUES ('45', '1', '222.218.172.138', 'Windows NT', 'chrome-45', '登录成功', '1484162312');
INSERT INTO `ta_log_record` VALUES ('46', '1', '222.218.172.138', 'Windows NT', 'chrome-45', '登录成功', '1484167336');
INSERT INTO `ta_log_record` VALUES ('47', '1', '222.218.172.138', 'Windows NT', 'chrome-45', '登录成功', '1484168026');
INSERT INTO `ta_log_record` VALUES ('48', '1', '218.56.44.108', 'Windows XP', 'chrome-49', '登录成功', '1484180327');
INSERT INTO `ta_log_record` VALUES ('49', '1', '60.248.7.91', 'Windows 7', 'chrome-53', 'Login succeed', '1484187360');
INSERT INTO `ta_log_record` VALUES ('50', '1', '218.7.248.102', 'Windows 7', 'chrome-55', '登录成功', '1484187697');
INSERT INTO `ta_log_record` VALUES ('51', '1', '121.8.157.19', 'Windows 7', 'chrome-54', '登录成功', '1484187700');
INSERT INTO `ta_log_record` VALUES ('52', '1', '120.236.167.91', 'Windows 7', 'chrome-53', '登录成功', '1484187945');
INSERT INTO `ta_log_record` VALUES ('53', '1', '113.92.35.179', 'Windows 7', 'chrome-55', '登录成功', '1484189716');
INSERT INTO `ta_log_record` VALUES ('54', '1', '60.18.143.27', 'Windows 10', 'ie-7', '登录成功', '1484190994');
INSERT INTO `ta_log_record` VALUES ('55', '1', '218.201.15.125', 'Windows 7', 'chrome-50', '登录成功', '1484191773');
INSERT INTO `ta_log_record` VALUES ('56', '1', '60.29.103.62', 'Windows 7', 'ie-7', '登录成功', '1484192406');
INSERT INTO `ta_log_record` VALUES ('57', '1', '222.188.158.64', 'Windows 7', 'chrome-45', '登录成功', '1484195890');
INSERT INTO `ta_log_record` VALUES ('58', '1', '42.89.6.254', 'Windows 10', 'chrome-39', '登录成功', '1484198735');
INSERT INTO `ta_log_record` VALUES ('59', '1', '223.104.17.187', 'Mac OS X 10_12_2', 'chrome-55', '登录成功', '1484198947');
INSERT INTO `ta_log_record` VALUES ('60', '1', '223.104.17.187', 'Mac OS X 10_12_2', 'chrome-55', '登录成功', '1484199092');
INSERT INTO `ta_log_record` VALUES ('61', '1', '218.76.215.195', 'Windows 7', 'chrome-51', '登录成功', '1484199236');
INSERT INTO `ta_log_record` VALUES ('62', '1', '119.251.145.175', 'Mac OS X', 'chrome-50', '登录成功', '1484201783');
INSERT INTO `ta_log_record` VALUES ('63', '1', '27.17.18.214', 'Windows 10', 'chrome-49', '登录成功', '1484201906');
INSERT INTO `ta_log_record` VALUES ('64', '1', '223.104.17.187', 'Mac OS X 10_12_2', 'chrome-55', 'Login succeed', '1484202347');
INSERT INTO `ta_log_record` VALUES ('65', '1', '31.205.31.23', 'Windows 10', 'chrome-55', 'Login succeed', '1484203248');
INSERT INTO `ta_log_record` VALUES ('66', '1', '14.116.36.240', 'Windows 7', 'chrome-49', '登录成功', '1484204457');
INSERT INTO `ta_log_record` VALUES ('67', '1', '119.79.20.203', 'Windows 10', 'chrome-55', '登录成功', '1484206953');
INSERT INTO `ta_log_record` VALUES ('68', '1', '58.48.90.209', 'Windows 7', 'chrome-47', '登录成功', '1484208571');
INSERT INTO `ta_log_record` VALUES ('69', '1', '114.82.164.168', 'Windows XP', 'ie-6', '登录成功', '1484208914');
INSERT INTO `ta_log_record` VALUES ('70', '1', '125.77.47.212', 'Windows 10', 'chrome-57', '登录成功', '1484209773');
INSERT INTO `ta_log_record` VALUES ('71', '1', '101.227.12.253', 'Windows 7', 'chrome-55', '登录成功', '1484214426');
INSERT INTO `ta_log_record` VALUES ('72', '1', '222.27.239.240', 'Mac OS X 10_12_2', 'chrome-55', '登录成功', '1484298597');
INSERT INTO `ta_log_record` VALUES ('73', '1', '14.158.210.227', 'Windows 7', 'firefox-50', '登录成功', '1484300863');
INSERT INTO `ta_log_record` VALUES ('74', '1', '27.223.75.102', 'Mac OS X', 'chrome-55', '登录成功', '1484362129');
INSERT INTO `ta_log_record` VALUES ('75', '1', '119.2.128.227', 'Windows 7', 'chrome-49', '登录成功', '1484368985');
INSERT INTO `ta_log_record` VALUES ('76', '1', '36.251.128.136', 'Windows 7', 'firefox-50', '登录成功', '1484373991');
INSERT INTO `ta_log_record` VALUES ('77', '1', '110.184.47.193', 'Mac OS X 10_12_2', 'chrome-55', '登录成功', '1484444938');
INSERT INTO `ta_log_record` VALUES ('78', '1', '110.184.40.9', 'Mac OS X 10_12_2', 'chrome-55', '登录成功', '1484448904');
INSERT INTO `ta_log_record` VALUES ('79', '4', '110.184.40.9', 'Mac OS X 10_12_2', 'chrome-55', '登录成功', '1484449096');
INSERT INTO `ta_log_record` VALUES ('80', '1', '110.184.40.9', 'Mac OS X 10_12_2', 'chrome-55', '登录成功', '1484449112');
INSERT INTO `ta_log_record` VALUES ('81', '1', '127.0.0.1', 'Windows 10', 'firefox-56', '登录成功', '1510734255');
INSERT INTO `ta_log_record` VALUES ('82', '1', '127.0.0.1', 'Windows 10', 'chrome-55', '登录成功', '1510734325');
INSERT INTO `ta_log_record` VALUES ('83', '1', '127.0.0.1', 'Windows 10', 'chrome-55', '登录成功', '1510735366');
INSERT INTO `ta_log_record` VALUES ('84', '1', '127.0.0.1', 'Windows 10', 'chrome-55', '登录成功', '1510735419');
INSERT INTO `ta_log_record` VALUES ('85', '1', '127.0.0.1', 'Windows 10', 'firefox-56', '登录成功', '1510740657');
INSERT INTO `ta_log_record` VALUES ('86', '1', '127.0.0.1', 'Windows 10', 'firefox-56', '登录成功', '1510741100');
INSERT INTO `ta_log_record` VALUES ('87', '1', '127.0.0.1', 'Windows 10', 'firefox-56', '登录成功', '1510796699');
INSERT INTO `ta_log_record` VALUES ('88', '0', '127.0.0.1', 'Mac OS X', 'safari-601', '登录成功', '1510828291');
INSERT INTO `ta_log_record` VALUES ('89', '0', '127.0.0.1', 'Mac OS X', 'safari-601', '登录成功', '1510885680');
INSERT INTO `ta_log_record` VALUES ('90', '0', '127.0.0.1', 'Mac OS X', 'safari-601', '登录成功', '1510885738');
INSERT INTO `ta_log_record` VALUES ('91', '0', '127.0.0.1', 'Mac OS X', 'safari-601', '登录成功', '1510885807');
INSERT INTO `ta_log_record` VALUES ('92', '1', '127.0.0.1', 'Windows 10', 'chrome-55', '登录成功', '1510887078');
INSERT INTO `ta_log_record` VALUES ('93', '1', '127.0.0.1', 'Mac OS X', 'safari-601', '登录成功', '1511402666');
INSERT INTO `ta_log_record` VALUES ('94', '1', '127.0.0.1', 'Mac OS X', 'safari-601', '登录成功', '1511423589');
INSERT INTO `ta_log_record` VALUES ('95', '1', '127.0.0.1', 'Mac OS X', 'safari-601', '登录成功', '1511753115');
INSERT INTO `ta_log_record` VALUES ('96', '1', '127.0.0.1', 'Mac OS X', 'safari-601', '登录成功', '1511841139');
INSERT INTO `ta_log_record` VALUES ('97', '1', '127.0.0.1', 'Mac OS X', 'safari-601', '登录成功', '1511856541');
INSERT INTO `ta_log_record` VALUES ('98', '1', '127.0.0.1', 'Mac OS X', 'safari-601', '登录成功', '1512035880');
INSERT INTO `ta_log_record` VALUES ('99', '1', '127.0.0.1', 'Mac OS X', 'safari-601', '登录成功', '1512122698');
INSERT INTO `ta_log_record` VALUES ('100', '1', '127.0.0.1', 'Mac OS X', 'safari-601', '登录成功', '1512445687');
INSERT INTO `ta_log_record` VALUES ('101', '1', '127.0.0.1', 'Windows 10', 'chrome-55', '登录成功', '1512459913');
INSERT INTO `ta_log_record` VALUES ('102', '1', '127.0.0.1', 'Windows 10', 'chrome-55', '登录成功', '1512524416');
INSERT INTO `ta_log_record` VALUES ('103', '1', '127.0.0.1', 'Windows 10', 'firefox-57', '登录成功', '1512634449');
INSERT INTO `ta_log_record` VALUES ('104', '1', '127.0.0.1', 'Mac OS X', 'safari-601', '登录成功', '1512725529');
INSERT INTO `ta_log_record` VALUES ('105', '1', '127.0.0.1', 'Mac OS X', 'safari-601', '登录成功', '1512725566');
INSERT INTO `ta_log_record` VALUES ('106', '1', '127.0.0.1', 'Mac OS X', 'safari-601', '登录成功', '1512726344');
INSERT INTO `ta_log_record` VALUES ('107', '1', '127.0.0.1', 'Mac OS X', 'safari-601', '登录成功', '1512727787');
INSERT INTO `ta_log_record` VALUES ('108', '0', '127.0.0.1', 'Windows 10', 'chrome-63', '登录成功', '1513346483');
INSERT INTO `ta_log_record` VALUES ('109', '1', '127.0.0.1', 'Windows 10', 'chrome-63', '登录成功', '1513431015');
INSERT INTO `ta_log_record` VALUES ('110', '1', '127.0.0.1', 'Windows 10', 'firefox-57', '登录成功', '1513432200');

-- ----------------------------
-- Table structure for ta_lottery
-- ----------------------------
DROP TABLE IF EXISTS `ta_lottery`;
CREATE TABLE `ta_lottery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lotteryname` varchar(16) DEFAULT NULL COMMENT '彩票名称',
  `status` int(11) DEFAULT '1' COMMENT '状态 （0禁止 1可用）',
  `create_time` int(11) DEFAULT NULL COMMENT '帐号创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '账户最后更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='彩票表';

-- ----------------------------
-- Records of ta_lottery
-- ----------------------------
INSERT INTO `ta_lottery` VALUES ('1', '大乐透', '1', '1478252401', '1484214600', null);
INSERT INTO `ta_lottery` VALUES ('3', '双色球', '1', '1483423025', '1483423039', '1483423039');
INSERT INTO `ta_lottery` VALUES ('2', '管理员', '1', '1482835627', '1484148776', null);
INSERT INTO `ta_lottery` VALUES ('4', 'aierui', '1', '1484448977', '1484448977', null);
INSERT INTO `ta_lottery` VALUES ('5', 'test', '1', '1484449210', '1484449239', '1484449239');
INSERT INTO `ta_lottery` VALUES ('6', '111', '0', '1511418621', '1511418621', null);
INSERT INTO `ta_lottery` VALUES ('7', '123', '1', '1511418813', '1511418813', null);
INSERT INTO `ta_lottery` VALUES ('8', '1231', '1', '1511419152', '1511419152', null);
INSERT INTO `ta_lottery` VALUES ('9', '1232', '1', '1511419171', '1511419171', null);
INSERT INTO `ta_lottery` VALUES ('10', '234', '1', '1511419211', '1511419211', null);
INSERT INTO `ta_lottery` VALUES ('11', '222', '1', '1511419454', '1511419454', null);
INSERT INTO `ta_lottery` VALUES ('12', '115', '1', '1511419550', '1511419550', null);
INSERT INTO `ta_lottery` VALUES ('13', '1154', '1', '1511419580', '1511419580', null);

-- ----------------------------
-- Table structure for ta_lottery_winning
-- ----------------------------
DROP TABLE IF EXISTS `ta_lottery_winning`;
CREATE TABLE `ta_lottery_winning` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lotteryid` int(16) DEFAULT NULL COMMENT '彩票id',
  `periodsid` bigint(20) NOT NULL COMMENT '彩票期数',
  `lotterynumbers` varchar(100) DEFAULT NULL COMMENT '开奖号码',
  `status` int(11) DEFAULT '0' COMMENT '0未开奖，1已开奖',
  `create_time` int(11) DEFAULT NULL COMMENT '帐号创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '账户最后更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='彩票开奖表';

-- ----------------------------
-- Records of ta_lottery_winning
-- ----------------------------
INSERT INTO `ta_lottery_winning` VALUES ('1', '1', '1018013', '1,5,5', '1', '1513646674', '1513677094', null);
INSERT INTO `ta_lottery_winning` VALUES ('14', '1', '1018014', '5,6,4', '1', '1513646959', '1513677133', null);
INSERT INTO `ta_lottery_winning` VALUES ('16', '1', '1018015', '5,5,1', '1', '1513677133', '1513677143', null);
INSERT INTO `ta_lottery_winning` VALUES ('17', '1', '1018016', '6,6,5', '1', '1513677143', '1513677150', null);
INSERT INTO `ta_lottery_winning` VALUES ('18', '1', '1018017', '6,6,5', '1', '1513677150', '1513677195', null);
INSERT INTO `ta_lottery_winning` VALUES ('19', '1', '1018018', '', '0', '1513677195', '1513677195', null);

-- ----------------------------
-- Table structure for ta_recharge
-- ----------------------------
DROP TABLE IF EXISTS `ta_recharge`;
CREATE TABLE `ta_recharge` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(10) DEFAULT '0' COMMENT '0失败，1成功',
  `userid` int(20) DEFAULT NULL COMMENT '用户id',
  `Rebate` varchar(20) DEFAULT '0' COMMENT '返点',
  `Money` varchar(50) DEFAULT NULL COMMENT '充值金额',
  `PayUser` varchar(100) DEFAULT '1' COMMENT '姓名',
  `create_time` int(11) DEFAULT NULL COMMENT '帐号创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '账户最后更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  `playtype` varchar(20) DEFAULT '1' COMMENT '充值渠道1银行卡，2微信，3，支付宝',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='充值表';

-- ----------------------------
-- Records of ta_recharge
-- ----------------------------
INSERT INTO `ta_recharge` VALUES ('14', '1', '1', '234', '693', '112', '1512028136', '1512729284', null, '1');
INSERT INTO `ta_recharge` VALUES ('15', '1', '2', '0', '23', '112', '1512028136', '1512636494', null, '1');
INSERT INTO `ta_recharge` VALUES ('16', '1', '3', '0', '4', '1', '1512028136', '1513432446', null, '1');
INSERT INTO `ta_recharge` VALUES ('17', '1', '4', '0', '12', '456ssdd方法', '1512028136', '1513433802', null, '1');
INSERT INTO `ta_recharge` VALUES ('18', '0', '1', '0', '123', '345', '1511837793', '1512636487', '1512636487', 'wechat');
INSERT INTO `ta_recharge` VALUES ('19', '1', '1', '0', '232', '22', '1511837820', '1512636489', null, 'bank');
INSERT INTO `ta_recharge` VALUES ('20', '1', '2', '0', '22', '123', '1511837839', '1512729281', null, 'alipaly');
INSERT INTO `ta_recharge` VALUES ('21', '1', null, '0', '12', '123', '1512727405', '1512727405', null, 'bank');
INSERT INTO `ta_recharge` VALUES ('22', '1', '5', '0', '222', '222', '1512727634', '1513432214', null, 'bank');

-- ----------------------------
-- Table structure for ta_role
-- ----------------------------
DROP TABLE IF EXISTS `ta_role`;
CREATE TABLE `ta_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '角色名称',
  `pid` smallint(6) DEFAULT NULL COMMENT '父角色ID',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '状态',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `parentId` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of ta_role
-- ----------------------------
INSERT INTO `ta_role` VALUES ('1', '超级管理员1', '0', '1', '网站最高管理员权限！', '1329633709', '1329633709');
INSERT INTO `ta_role` VALUES ('2', '测试角色', null, '0', '测试角色', '1482389092', '0');

-- ----------------------------
-- Table structure for ta_tixian
-- ----------------------------
DROP TABLE IF EXISTS `ta_tixian`;
CREATE TABLE `ta_tixian` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(20) DEFAULT NULL COMMENT '用户id',
  `Money` varchar(50) DEFAULT NULL COMMENT '体现金额',
  `create_time` int(11) DEFAULT NULL COMMENT '帐号创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '账户最后更新时间',
  `status` int(10) DEFAULT '1' COMMENT '0失败，1成功',
  `playtype` varchar(10) DEFAULT '1' COMMENT '体现渠道1银行卡，2微信，3，支付宝',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='用户体现申请表';

-- ----------------------------
-- Records of ta_tixian
-- ----------------------------
INSERT INTO `ta_tixian` VALUES ('14', '2', '1', '1512028136', '1513433889', '1', '1', null);
INSERT INTO `ta_tixian` VALUES ('15', '2', '2', '1511430702', '1513433348', '1', '1', null);
INSERT INTO `ta_tixian` VALUES ('16', '2', '1', '1511430883', '1513433895', '1', '1', null);
INSERT INTO `ta_tixian` VALUES ('17', '5', '1', '1512727793', '1512727793', '1', '1', null);

-- ----------------------------
-- Table structure for ta_user
-- ----------------------------
DROP TABLE IF EXISTS `ta_user`;
CREATE TABLE `ta_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) DEFAULT NULL COMMENT '昵称',
  `balance` double(50,0) DEFAULT '0' COMMENT '余额',
  `username` varchar(16) DEFAULT NULL COMMENT '账号',
  `Gender` varchar(10) DEFAULT NULL COMMENT '性别',
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL COMMENT '手机号',
  `password` varchar(32) DEFAULT NULL COMMENT '密码',
  `status` int(11) DEFAULT '1' COMMENT '状态 （0禁止 1可用）',
  `create_time` int(11) DEFAULT NULL COMMENT '帐号创建时间',
  `administrator` int(1) DEFAULT '0' COMMENT '是否超级管理员，1是 0否',
  `role_id` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) DEFAULT NULL COMMENT '账户最后更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  `BirthDay` varchar(50) DEFAULT NULL COMMENT '生日',
  `head_pic` varchar(200) DEFAULT NULL COMMENT '头像',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of ta_user
-- ----------------------------
INSERT INTO `ta_user` VALUES ('1', '123123456', '9999', '石金融', '男', '11331@qq.com', '15810672003', '4c3c8afaf91b4dd81bcf68ba519fa2f6', '1', '1478252401', '1', '2', '1512121147', null, '2017-12-21', null);
INSERT INTO `ta_user` VALUES ('3', '33', '460', '程斌', null, null, '15116041105', '4c3c8afaf91b4dd81bcf68ba519fa2f6', '1', '1483423025', '0', '0', '1513432446', null, null, null);
INSERT INTO `ta_user` VALUES ('2', '22', '38', '管理员', null, null, '15100000000', '4c3c8afaf91b4dd81bcf68ba519fa2f6', '1', '1482835627', '0', '0', '1513433895', null, null, null);
INSERT INTO `ta_user` VALUES ('4', '33', '12', 'aierui', null, null, '13330613322', '4c3c8afaf91b4dd81bcf68ba519fa2f6', '1', '1484448977', '0', '0', '1513433802', null, null, null);
INSERT INTO `ta_user` VALUES ('5', '55', '100000221', 'test', null, null, '13330613012', '298ee882980e7bd803f8fe1ba43ecaac', '1', '1484449210', '0', '0', '1513432214', null, null, null);
INSERT INTO `ta_user` VALUES ('6', '66', '0', '111', null, null, null, '298ee882980e7bd803f8fe1ba43ecaac', '0', '1511418621', '0', '0', '1511418621', null, null, null);
INSERT INTO `ta_user` VALUES ('7', '77', '0', '123', null, null, null, '298ee882980e7bd803f8fe1ba43ecaac', '1', '1511418813', '0', '0', '1511418813', null, null, null);
INSERT INTO `ta_user` VALUES ('14', null, '0', '222', null, null, null, '298ee882980e7bd803f8fe1ba43ecaac', '1', '1512122686', '1', '0', '1512637220', '1512637220', null, null);
INSERT INTO `ta_user` VALUES ('15', null, '0', '15810672003', null, null, null, '3ba900d50569c487e9bb0ba954a66304', '1', '1512445655', '0', '0', '1512445655', null, null, '10');

-- ----------------------------
-- Table structure for ta_user_lottery
-- ----------------------------
DROP TABLE IF EXISTS `ta_user_lottery`;
CREATE TABLE `ta_user_lottery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(20) DEFAULT NULL COMMENT '用户id',
  `periodsid` bigint(20) DEFAULT NULL COMMENT '彩票期数',
  `lotteryid` int(20) DEFAULT NULL COMMENT '彩票id',
  `lottery_number` varchar(30) DEFAULT NULL COMMENT '下注号码',
  `bettingmoney` double(32,0) DEFAULT NULL COMMENT '投注金额',
  `ifwining` double(255,2) DEFAULT '0.00' COMMENT '如果中奖得钱数',
  `status` int(11) DEFAULT '1' COMMENT '0未开奖，1已开奖',
  `create_time` int(11) DEFAULT NULL COMMENT '帐号创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '账户最后更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='用户购彩记录表';

-- ----------------------------
-- Records of ta_user_lottery
-- ----------------------------
INSERT INTO `ta_user_lottery` VALUES ('45', '5', null, '1', '双', '12', '23.16', '0', '1513332967', '1513332967', null);

-- ----------------------------
-- Table structure for ta_user_lottery_winning
-- ----------------------------
DROP TABLE IF EXISTS `ta_user_lottery_winning`;
CREATE TABLE `ta_user_lottery_winning` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(20) DEFAULT NULL COMMENT '用户id',
  `periodsid` bigint(20) DEFAULT NULL COMMENT '彩票期数',
  `lotteryid` int(20) DEFAULT NULL COMMENT '彩票期数',
  `bettingmoney` double(32,0) DEFAULT '0' COMMENT '投注金额',
  `winningmoney` double(20,0) DEFAULT '0' COMMENT '中奖金额',
  `create_time` int(11) DEFAULT NULL COMMENT '帐号创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '账户最后更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='用户购彩记录表';

-- ----------------------------
-- Records of ta_user_lottery_winning
-- ----------------------------
INSERT INTO `ta_user_lottery_winning` VALUES ('1', '15', null, '1', '4', '11', '1512032139', '1484214600', null);
INSERT INTO `ta_user_lottery_winning` VALUES ('3', '15', null, '1', '4', '22', '1512032139', '1483423039', null);
INSERT INTO `ta_user_lottery_winning` VALUES ('2', '1', null, '1', '4', '33', '1512032139', '1484148776', null);
INSERT INTO `ta_user_lottery_winning` VALUES ('4', '1', null, '1', '4', '44', '1512032139', '1484448977', null);
INSERT INTO `ta_user_lottery_winning` VALUES ('5', '1', null, '1', '4', '55', '1512032139', '1484449239', null);
INSERT INTO `ta_user_lottery_winning` VALUES ('6', '1', null, '1', '298', '63', '1512032139', '1511418621', null);
INSERT INTO `ta_user_lottery_winning` VALUES ('7', '2', null, '1', '298', '66', '1512032139', '1511418813', null);
INSERT INTO `ta_user_lottery_winning` VALUES ('8', '3', null, '1', '0', '77', '1512032139', '1511419152', null);
INSERT INTO `ta_user_lottery_winning` VALUES ('9', '4', null, '1', '298', '88', '1512032139', '1511419171', null);
INSERT INTO `ta_user_lottery_winning` VALUES ('10', '5', null, '1', '8', '123', '1512032139', '1511419211', null);
INSERT INTO `ta_user_lottery_winning` VALUES ('11', '6', null, '1', '8', '345', '1512032139', '1511419454', null);
INSERT INTO `ta_user_lottery_winning` VALUES ('12', '7', null, '1', '298', '567', '1512032139', '1511419550', null);
INSERT INTO `ta_user_lottery_winning` VALUES ('13', '8', null, '1', '298', '789', '1512032139', '1511419580', null);
