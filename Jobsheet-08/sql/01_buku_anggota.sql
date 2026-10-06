-- Jobsheet 8: skema awal database simpus_mini (PostgreSQL)
-- Jalankan setelah membuat database, misal:
--   createdb simpus_mini
--   psql -d simpus_mini -f sql/01_buku_anggota.sql

create table if not exists buku (
    id serial primary key,
    judul varchar(255) not null,
    pengarang varchar(255) not null,
    tahun integer not null,
    isbn varchar(50),
    stok integer not null default 0,
    kategori varchar(50)
);

create table if not exists anggota (
    id serial primary key,
    nama varchar(255) not null,
    no_anggota varchar(50) not null unique,
    alamat varchar(255) not null,
    no_hp varchar(30) not null
);