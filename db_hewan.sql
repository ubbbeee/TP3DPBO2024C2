/*
 Navicat Premium Data Transfer

 Source Server         : koneksi 1
 Source Server Type    : MySQL
 Source Server Version : 100428
 Source Host           : localhost:3306
 Source Schema         : db_hewan

 Target Server Type    : MySQL
 Target Server Version : 100428
 File Encoding         : 65001

 Date: 25/04/2024 23:11:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ciri
-- ----------------------------
DROP TABLE IF EXISTS `ciri`;
CREATE TABLE `ciri`  (
  `ciri_id` int NOT NULL AUTO_INCREMENT,
  `ciri_nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ciri_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ciri
-- ----------------------------
INSERT INTO `ciri` VALUES (1, 'Herbivora');
INSERT INTO `ciri` VALUES (4, 'Karnivora');
INSERT INTO `ciri` VALUES (5, 'Omnivora');
INSERT INTO `ciri` VALUES (6, 'Granivora');
INSERT INTO `ciri` VALUES (7, 'Frugivora');
INSERT INTO `ciri` VALUES (8, 'Insektivora');

-- ----------------------------
-- Table structure for hewan
-- ----------------------------
DROP TABLE IF EXISTS `hewan`;
CREATE TABLE `hewan`  (
  `hewan_id` int NOT NULL AUTO_INCREMENT,
  `hewan_foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `hewan_nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `hewan_populasi` int NULL DEFAULT NULL,
  `hewan_nama_latin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ciri_id` int NULL DEFAULT NULL,
  `jenis_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`hewan_id`) USING BTREE,
  INDEX `fk_ciri`(`ciri_id`) USING BTREE,
  INDEX `fk_jenis`(`jenis_id`) USING BTREE,
  CONSTRAINT `fk_ciri` FOREIGN KEY (`ciri_id`) REFERENCES `ciri` (`ciri_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_jenis` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`jenis_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hewan
-- ----------------------------
INSERT INTO `hewan` VALUES (1, 'gambar_rusa.jpg', 'Rusa', 100, 'Cervidae', 1, 1);
INSERT INTO `hewan` VALUES (2, 'gambar_beruang.jpg', 'Beruang Madu', 1000, 'Ursus arctos', 5, 1);
INSERT INTO `hewan` VALUES (8, 'gambar_kenari.jpg', 'Burung Kenari', 200000, 'Serinus canaria', 6, 4);
INSERT INTO `hewan` VALUES (9, 'gambar_hiu2.jpg', 'Hiu Putih', 3000000, 'Carcharodon carcharias', 4, 5);
INSERT INTO `hewan` VALUES (10, 'gambar_harimau.jpg', 'Harimau Sumatera', 10000, 'Panthera tigris sumatrae', 4, 1);
INSERT INTO `hewan` VALUES (11, 'gambar_ular.jpg', 'Ular Kobra', 400000, 'Naja', 4, 6);

-- ----------------------------
-- Table structure for jenis
-- ----------------------------
DROP TABLE IF EXISTS `jenis`;
CREATE TABLE `jenis`  (
  `jenis_id` int NOT NULL AUTO_INCREMENT,
  `jenis_nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`jenis_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jenis
-- ----------------------------
INSERT INTO `jenis` VALUES (1, 'Mamalia');
INSERT INTO `jenis` VALUES (4, 'Aves');
INSERT INTO `jenis` VALUES (5, 'Pisces');
INSERT INTO `jenis` VALUES (6, 'Reptile');
INSERT INTO `jenis` VALUES (7, 'Arthropoda');
INSERT INTO `jenis` VALUES (8, 'Amfibi test');

SET FOREIGN_KEY_CHECKS = 1;
