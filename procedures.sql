DELIMITER $$
CREATE PROCEDURE make_intervals(startdate timestamp, enddate timestamp, intval integer, unitval varchar(10))
BEGIN
-- *************************************************************************
-- Procedure: make_intervals()
--    Author: Raj Abishek
--      Date: 01/08/2015
--
-- Description:
-- This procedure creates a temporary table named time_intervals with the
-- interval_start and interval_end fields specifed from the startdate and
-- enddate arguments, at intervals of intval (unitval) size.
-- *************************************************************************
  declare thisDate timestamp;
  declare nextDate timestamp;
  set thisDate = startdate;

  -- *************************************************************************
  -- Drop / create the temp table
  -- *************************************************************************
  drop temporary table if exists time_intervals;
  create temporary table if not exists time_intervals
     (
     interval_start timestamp,
     interval_end timestamp
     );

  -- *************************************************************************
  -- Loop through the startdate adding each intval interval until enddate
  -- *************************************************************************
  repeat
     select
        case unitval
           when 'MICROSECOND' then timestampadd(MICROSECOND, intval, thisDate)
           when 'SECOND'      then timestampadd(SECOND, intval, thisDate)
           when 'MINUTE'      then timestampadd(MINUTE, intval, thisDate)
           when 'HOUR'        then timestampadd(HOUR, intval, thisDate)
           when 'DAY'         then timestampadd(DAY, intval, thisDate)
           when 'WEEK'        then timestampadd(WEEK, intval, thisDate)
           when 'MONTH'       then timestampadd(MONTH, intval, thisDate)
           when 'QUARTER'     then timestampadd(QUARTER, intval, thisDate)
           when 'YEAR'        then timestampadd(YEAR, intval, thisDate)
        end into nextDate;

     insert into time_intervals select thisDate, timestampadd(MICROSECOND, -1, nextDate);
     set thisDate = nextDate;
  until thisDate >= enddate
  end repeat;

END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `donations_statistics`(startdate timestamp, enddate timestamp, intval integer, unitval varchar(10))
BEGIN

call make_intervals(startdate,enddate,intval,unitval);

SELECT 
DATE(interval_start) as day,

(SELECT COUNT(DISTINCT(donated_at)) from donations WHERE status = 'donated' AND donated_at >= interval_start AND donated_at <= interval_end) as donated_donations,

(SELECT COUNT(DISTINCT(cancelled_at)) from donations WHERE status = 'disinterested' AND cancelled_at >= interval_start AND cancelled_at <= interval_end) as cancelled_donations,

(SELECT COALESCE(SUM(donations.donated_amount),0) FROM donations WHERE status = 'donated' AND donated_at >= interval_start AND donated_at <= interval_end  ) as raised


FROM time_intervals;


END$$
DELIMITER ;
-- CALL donations_statistics('2015-07-31','2015-08-03',1,'DAY');
-- SELECT COUNT(DISTINCT(donated_at)) as donated_donations from donations WHERE status = 'donated';
-- SELECT COUNT(DISTINCT(cancelled_at)) as disinterested_donations from donations WHERE status = 'disinterested';
-- SELECT COALESCE(SUM(donations.donated_amount),0) as raised FROM donations WHERE status = 'donated';