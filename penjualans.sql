/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     11/4/2020 9:23:25 PM                         */
/*==============================================================*/


drop table if exists ARUSKAS;

drop table if exists BARANG;

drop table if exists PELANGGAN;

drop table if exists PELUNASAN;

drop table if exists PESANAN;

drop table if exists USER;

drop table if exists VENDOR;

/*==============================================================*/
/* Table: ARUSKAS                                               */
/*==============================================================*/
create table ARUSKAS
(
   ID_TRANSAKSI         varchar(6) not null,
   ID_USER              varchar(4),
   TANGGAL              date,
   KETERANGAN           varchar(50),
   STATUS               varchar(15),
   JENIS_TRANSAKSI      varchar(7),
   JUMLAH_TUNAI         int,
   primary key (ID_TRANSAKSI)
);

/*==============================================================*/
/* Table: BARANG                                                */
/*==============================================================*/
create table BARANG
(
   ID_BARANG            varchar(5) not null,
   ID_USER              varchar(4),
   KODE_BARANG          varchar(5),
   NAMA_BARANG          varchar(30),
   JENIS_BARANG         varchar(20),
   SATUAN               varchar(7),
   QTY                  int,
   HARGA_JUAL           int,
   HARGA_BELI           int,
   HARGA_PERITEM        int,
   primary key (ID_BARANG)
);

/*==============================================================*/
/* Table: PELANGGAN                                             */
/*==============================================================*/
create table PELANGGAN
(
   ID_PELANGGAN         varchar(5) not null,
   ID_USER              varchar(4),
   NAMA_PELANGGAN       varchar(15),
   ALAMAT_PELANGGAN     varchar(30),
   EMAIL_PELANGGAN      varchar(20),
   NO_TELP              varchar(15),
   primary key (ID_PELANGGAN)
);

/*==============================================================*/
/* Table: PELUNASAN                                             */
/*==============================================================*/
create table PELUNASAN
(
   ID_PELUNASAN         varchar(5) not null,
   ID_PESANAN           varchar(5),
   ID_USER              varchar(4),
   ID_PELANGGAN         varchar(5),
   NAMA                 varchar(15),
   TGL_PESAN            date,
   TGL_PELUNASAN        date,
   PESANAN              varchar(30),
   JUMLAH               int,
   DISKON               float,
   HARGA_PERPCS         int,
   HARGA_TOTAL          int,
   KET                  varchar(15),
   primary key (ID_PELUNASAN)
);

/*==============================================================*/
/* Table: PESANAN                                               */
/*==============================================================*/
create table PESANAN
(
   ID_PESANAN           varchar(5) not null,
   ID_PELANGGAN         varchar(5),
   ID_USER              varchar(4),
   ID_BARANG            varchar(5),
   TGL_PESANAN          date,
   TGL_JADI             date,
   JENIS_PESANAN        varchar(50),
   UKURAN               varchar(6),
   JUMLAH_PESANAN       int,
   JENIS_KAIN           varchar(30),
   JUMLAH_WARNA         int,
   DISC                 float,
   TOTAL_HARGA          int,
   UANG_MUKA            int,
   PEMBAYARAN           int,
   primary key (ID_PESANAN)
);

/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USER
(
   ID_USER              varchar(4) not null,
   USERNAME             varchar(10),
   PASSWORD             varchar(6),
   JABATAN              varchar(5),
   NAMA_USER            varchar(20),
   primary key (ID_USER)
);

/*==============================================================*/
/* Table: VENDOR                                                */
/*==============================================================*/
create table VENDOR
(
   ID_VENDOR            varchar(5) not null,
   ID_USER              varchar(4),
   NAMA_VENDOR          varchar(30),
   ALAMAT_VENDOR        varchar(30),
   EMAIL_VENDOR         varchar(20),
   NO_TELEPON           varchar(15),
   primary key (ID_VENDOR)
);

alter table ARUSKAS add constraint FK_MENGINPUTKAN foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table BARANG add constraint FK_MENGOLAH_DATA foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table PELANGGAN add constraint FK_MELAYANI foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table PELUNASAN add constraint FK_MEMBAYAR foreign key (ID_PELANGGAN)
      references PELANGGAN (ID_PELANGGAN) on delete restrict on update restrict;

alter table PELUNASAN add constraint FK_MENDAPAT_DATA foreign key (ID_PESANAN)
      references PESANAN (ID_PESANAN) on delete restrict on update restrict;

alter table PELUNASAN add constraint FK_MENGELOLA foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table PESANAN add constraint FK_MELAKUKAN foreign key (ID_PELANGGAN)
      references PELANGGAN (ID_PELANGGAN) on delete restrict on update restrict;

alter table PESANAN add constraint FK_MENCATAT foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table PESANAN add constraint FK_MENGAMBIL_DATA foreign key (ID_BARANG)
      references BARANG (ID_BARANG) on delete restrict on update restrict;

alter table VENDOR add constraint FK_MEMESAN foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

