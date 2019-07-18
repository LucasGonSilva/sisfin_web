CREATE DATABASE  IF NOT EXISTS `sisfin_web` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sisfin_web`;
-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sisfin_web
-- ------------------------------------------------------
-- Server version	5.7.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_bairro`
--

DROP TABLE IF EXISTS `tb_bairro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_bairro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(155) NOT NULL,
  `id_cidade` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_bairro_tb_cidade1_idx` (`id_cidade`),
  CONSTRAINT `fk_tb_bairro_tb_cidade1` FOREIGN KEY (`id_cidade`) REFERENCES `tb_cidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bairro`
--

LOCK TABLES `tb_bairro` WRITE;
/*!40000 ALTER TABLE `tb_bairro` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bairro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_categoria_financeira`
--

DROP TABLE IF EXISTS `tb_categoria_financeira`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_categoria_financeira` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(155) NOT NULL,
  `created` date NOT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_categoria_financeira`
--

LOCK TABLES `tb_categoria_financeira` WRITE;
/*!40000 ALTER TABLE `tb_categoria_financeira` DISABLE KEYS */;
INSERT INTO `tb_categoria_financeira` VALUES (1,'FIES','2019-07-17','2019-07-17'),(2,'Água/Luz','2019-07-17',NULL),(3,'Impostos/Taxas','2019-07-17',NULL),(4,'Compras (Supermercado, Feira, Açougue)','2019-07-17','2019-07-17'),(5,'Cartão de Crédito (Banco do Brasil, BV Financeira)','2019-07-17','2019-07-17'),(6,'Telefone (Fixo/Internet)','2019-07-17','2019-07-17'),(7,'Telefone (Celular)','2019-07-17',NULL),(8,'Diversos (Gasolina, Farmácia, Padaria, Lanchonete)','2019-07-17','2019-07-17'),(9,'Passagem','2019-07-17',NULL),(10,'Pensão Alimentícia','2019-07-17',NULL),(11,'Empréstimo','2019-07-17',NULL),(12,'Gás','2019-07-17',NULL),(13,'TV por assinatura (SKY, NET, Claro, Vivo, GVT)','2019-07-17',NULL);
/*!40000 ALTER TABLE `tb_categoria_financeira` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_cidade`
--

DROP TABLE IF EXISTS `tb_cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_cidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(155) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_cidade`
--

LOCK TABLES `tb_cidade` WRITE;
/*!40000 ALTER TABLE `tb_cidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_cidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_despesas_fixas`
--

DROP TABLE IF EXISTS `tb_despesas_fixas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_despesas_fixas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(155) DEFAULT NULL,
  `pago_a` varchar(45) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `categoria` varchar(45) DEFAULT NULL,
  `situacao` varchar(45) DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_despesas_fixas`
--

LOCK TABLES `tb_despesas_fixas` WRITE;
/*!40000 ALTER TABLE `tb_despesas_fixas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_despesas_fixas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_perfil_usuario`
--

DROP TABLE IF EXISTS `tb_perfil_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_perfil_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(220) NOT NULL,
  `created` date NOT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_perfil_usuario`
--

LOCK TABLES `tb_perfil_usuario` WRITE;
/*!40000 ALTER TABLE `tb_perfil_usuario` DISABLE KEYS */;
INSERT INTO `tb_perfil_usuario` VALUES (1,'Administrador','2019-07-17',NULL),(2,'Visitante','2019-07-17',NULL),(3,'Financeiro','2019-07-17',NULL);
/*!40000 ALTER TABLE `tb_perfil_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_prioridade`
--

DROP TABLE IF EXISTS `tb_prioridade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_prioridade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(155) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_prioridade`
--

LOCK TABLES `tb_prioridade` WRITE;
/*!40000 ALTER TABLE `tb_prioridade` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_prioridade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_prioridade_tarefa`
--

DROP TABLE IF EXISTS `tb_prioridade_tarefa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_prioridade_tarefa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(155) NOT NULL,
  `created` date NOT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_prioridade_tarefa`
--

LOCK TABLES `tb_prioridade_tarefa` WRITE;
/*!40000 ALTER TABLE `tb_prioridade_tarefa` DISABLE KEYS */;
INSERT INTO `tb_prioridade_tarefa` VALUES (1,'Alta','2019-07-17',NULL),(2,'Média','2019-07-17',NULL),(3,'Baixa','2019-07-17',NULL),(4,'Normal','2019-07-17',NULL),(5,'Altíssima','2019-07-17',NULL);
/*!40000 ALTER TABLE `tb_prioridade_tarefa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_recebimentos`
--

DROP TABLE IF EXISTS `tb_recebimentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_recebimentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(155) NOT NULL,
  `recebido_de` varchar(45) NOT NULL,
  `valor` float NOT NULL,
  `categoria` varchar(45) NOT NULL,
  `situacao` varchar(45) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_recebimentos`
--

LOCK TABLES `tb_recebimentos` WRITE;
/*!40000 ALTER TABLE `tb_recebimentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_recebimentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_situacao_financeira`
--

DROP TABLE IF EXISTS `tb_situacao_financeira`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_situacao_financeira` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(155) NOT NULL,
  `created` date NOT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_situacao_financeira`
--

LOCK TABLES `tb_situacao_financeira` WRITE;
/*!40000 ALTER TABLE `tb_situacao_financeira` DISABLE KEYS */;
INSERT INTO `tb_situacao_financeira` VALUES (1,'Paga','2019-07-17','2019-07-17'),(2,'À Pagar','2019-07-17',NULL),(3,'À Receber','2019-07-17',NULL),(4,'Recebido','2019-07-17',NULL);
/*!40000 ALTER TABLE `tb_situacao_financeira` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_situacao_tarefa`
--

DROP TABLE IF EXISTS `tb_situacao_tarefa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_situacao_tarefa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(155) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_situacao_tarefa`
--

LOCK TABLES `tb_situacao_tarefa` WRITE;
/*!40000 ALTER TABLE `tb_situacao_tarefa` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_situacao_tarefa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_status`
--

DROP TABLE IF EXISTS `tb_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) NOT NULL,
  `created` date NOT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_status`
--

LOCK TABLES `tb_status` WRITE;
/*!40000 ALTER TABLE `tb_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_status_tarefa`
--

DROP TABLE IF EXISTS `tb_status_tarefa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_status_tarefa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(155) NOT NULL,
  `created` date NOT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_status_tarefa`
--

LOCK TABLES `tb_status_tarefa` WRITE;
/*!40000 ALTER TABLE `tb_status_tarefa` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_status_tarefa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_tarefa`
--

DROP TABLE IF EXISTS `tb_tarefa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_tarefa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarefa` varchar(155) NOT NULL,
  `descricao` text,
  `created` date NOT NULL,
  `prazo` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  `id_prioridade_tarefa` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_status_tarefa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_tarefa_tb_prioridade_tarefa1_idx` (`id_prioridade_tarefa`),
  KEY `fk_tb_tarefa_tb_usuario1_idx` (`id_usuario`),
  KEY `fk_tb_tarefa_tb_status_tarefa1_idx` (`id_status_tarefa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tarefa`
--

LOCK TABLES `tb_tarefa` WRITE;
/*!40000 ALTER TABLE `tb_tarefa` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_tarefa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_usuario`
--

DROP TABLE IF EXISTS `tb_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `email` varchar(520) NOT NULL,
  `password` varchar(155) DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_usuario`
--

LOCK TABLES `tb_usuario` WRITE;
/*!40000 ALTER TABLE `tb_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-18 10:02:32
