use brk3269;
drop table IF EXISTS station;
drop table IF EXISTS tides;
drop table IF EXISTS wind;
drop table IF EXISTS air_temperature;
drop table IF EXISTS water_temperature;
drop table IF EXISTS air_pressure;
drop table IF EXISTS log_station;

create table station
	(latitude		varchar(11),
	 longitude	varchar(11),
	 location		varchar(30) not null,
	 primary key (location)
  ) ENGINE = INNODB;  

create table log_station
	(latitude		varchar(11),
	 longitude	varchar(11),
	 location		varchar(30) not null,
	 foreign key(location) references station(location)
	 on update cascade on delete cascade
  ) ENGINE = INNODB;  

create table tides
	(element                  decimal(6,1) not null,
	 location	varchar(30) not null,
         high1		timestamp not null,
         low1	 	timestamp not null,	
	 high2          timestamp not null,	
         low2           timestamp not null,	
	 tdate		date not null,
  	 primary key(element),
	 foreign key(location) references station(location)
	 on update cascade on delete cascade
  ) ENGINE = INNODB; 

create table wind
	(element                  decimal(5,1) not null,
	 ttime			varchar(25) not null,
	 speed			decimal(5,1) not null,
	 direction	varchar(25) not null,
   	 location		varchar(30) not null,
	 primary key (element),
	 foreign key(location) references station(location)
	 on update cascade on delete cascade
  ) ENGINE = INNODB; 

create table air_temperature
	(element                  decimal(5,1) not null,
	 ttime							varchar(25) not null,
	 air_temperature		decimal(5,1) not null,
	 location						varchar(30) not null,
	 primary key (element),
	 foreign key(location) references station(location)
	 on update cascade on delete cascade
  ) ENGINE = INNODB; 

create table water_temperature
	(element                  decimal(5,1) not null,
	 ttime							varchar(25) not null,
	 water_temperature	decimal(5,1) not null,
	 location						varchar(30) not null,
	 primary key (element),
	 foreign key(location) references station(location)
	 on update cascade on delete cascade
  ) ENGINE = INNODB; 

create table air_pressure
	(element                  decimal(5,1) not null,
	 ttime							varchar(25) not null,
	 air_pressure				decimal(5,1) not null,
	 location						varchar(30) not null,
	 primary key (element),
	 foreign key(location) references station(location)
	 on update cascade on delete cascade
  ) ENGINE = INNODB; 

drop procedure IF EXISTS Air_Pressure_Wrightsville;
delimiter //
create procedure Air_Pressure_Wrightsville ()
begin
select ttime, air_pressure from air_pressure where location='Wrightsville Beach';
end//
delimiter ;

drop procedure IF EXISTS Air_Pressure_Beaufort;
delimiter //
create procedure Air_Pressure_Beaufort ()
begin
select ttime, air_pressure from air_pressure where location='Beaufort';
end//
delimiter ;

drop procedure IF EXISTS Wind_Wrightsville;
delimiter //
create procedure Wind_Wrightsville ()
begin
select ttime, speed from wind where location='Wrightsville Beach';
end//
delimiter ;

drop procedure IF EXISTS Wind_Beaufort;
delimiter //
create procedure Wind_Beaufort ()
begin select ttime, speed from wind where location='Beaufort';
end//
delimiter ;

drop function IF EXISTS AirTempLevel;
delimiter // 
create function AirTempLevel(air_temperature double) RETURNS VARCHAR(10)
    deterministic
begin	
    declare temp_condition varchar(10);
    if (air_temperature > 80) then
        set temp_condition = 'HOT';
    elseif (air_temperature <= 80 and air_temperature >= 65) then
        set temp_condition = 'MODERATE';
    elseif (air_temperature < 65) then
        set temp_condition = 'COLD';
    end if;
    return (temp_condition);
end//
delimiter ;

drop function IF EXISTS WaterTempLevel;
delimiter // 
create function WaterTempLevel(water_temperature double) RETURNS VARCHAR(10)
    deterministic
begin	
    declare temp_condition varchar(10);
    if (water_temperature > 80) then
        set temp_condition = 'HOT';
    elseif (water_temperature <= 80 and water_temperature >= 65) then
        set temp_condition = 'MODERATE';
    elseif (water_temperature < 65) then
        set temp_condition = 'COLD';
    end if;
    return (temp_condition);
end//
delimiter ;

drop trigger IF EXISTS after_insert_stations;
delimiter //
create trigger after_insert_stations
after insert on station 
for each row
begin
    insert into log_station (latitude, longitude, location)
	values (new.latitude, new.longitude, new.location);
end//
delimiter ;
