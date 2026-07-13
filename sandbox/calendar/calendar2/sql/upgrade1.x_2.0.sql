ALTER TABLE webcfg
  modify langcode varchar(30) NOT NULL default 'english',
  ADD datetype varchar(30) NOT NULL default 'yymmdd',
  ADD firstweek char(3) NOT NULL default 'sun',
  ADD theme varchar(40) NOT NULL default 'default';
