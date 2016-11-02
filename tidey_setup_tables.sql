use brk3269;
drop table IF EXISTS station;
drop table IF EXISTS tides;
drop table IF EXISTS wind;
drop table IF EXISTS tempPressure;
drop table IF EXISTS air_temp;
drop table IF EXISTS water_temp;
drop table IF EXISTS air_pressure;

create table station
	(latitude		varchar(11),
	 longitude	varchar(11),
	 location		varchar(30) not null,
	 primary key (location)
  );

create table tides
	(location		varchar(30) not null,
	 high1			decimal(5,1) not null,
	 low1				decimal(5,1) not null,
	 high2			decimal(5,1) not null,
	 low2				decimal(5,1) not null,
	 tdate			date not null,
   primary key(tdate)
  );

create table wind
	(tdate			date not null,
	 speed			decimal(5,1) not null,
	 direction	varchar(25) not null,
   location		varchar(30) not null,
	 ttime			varchar(25) not null,
	 primary key (ttime)
  );

create table tempPressure
	(tdate							date not null,
	 air_temperature		decimal(5,1) not null,
	 water_temperature	decimal(5,1) not null,
	 pressure						decimal(5,1) not null,
   location						varchar(30) not null,
	 ttime							varchar(25) not null,
	 primary key (ttime)
  );

create table air_temp
	(ttime							varchar(25) not null,
	 air_temperature		decimal(5,1) not null,
	 location						varchar(30) not null,
	 primary key (ttime),
	 foreign key (location) references station(location)
	 ON UPDATE CASCADE ON DELETE RESTRICT
  );

create table water_temp
	(ttime							varchar(25) not null,
	 water_temperature	decimal(5,1) not null,
	 location						varchar(30) not null,
	 primary key (ttime),
	 foreign key (location) references station(location)
	 ON UPDATE CASCADE ON DELETE RESTRICT
  );

create table air_pressure
	(ttime							varchar(25) not null,
	 air_pressure				decimal(5,1) not null,
	 location						varchar(30) not null,
	 primary key (ttime),
	 foreign key (location) references station(location)
	 ON UPDATE CASCADE ON DELETE RESTRICT
  );
