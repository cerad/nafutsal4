THIS ONE WORKED: mysql -uimpd -pimpd894 -e 'select * from nafutsal.players_onthehouse where project="NAFUTSAL_Player_2017_summer_season"' | sed 's/\t/,/g' > houseplayers20170525.csv
NONE OF THE OTHERS WORKED.

SELECT * from players_onthehouse
WHERE project = 'NAFUTSAL_Player_2017_summer_season'
INTO OUTFILE './houseteamExport.csv'
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n';

 - OR -

SELECT 
    *
FROM
    players_onthehouse
WHERE
    project = 'NAFUTSAL_Player_2017_summer_season' 
INTO OUTFILE './houseteamExport.csv' 
FIELDS ENCLOSED BY '"' 
TERMINATED BY ',' 
ESCAPED BY '"' 
LINES TERMINATED BY '\r\n';

  -- OR --

mysqldump --tab=./dbexports --fields-terminated-by=, --fields-enclosed-by='"' --lines-terminated-by=0x0d0a --user=impd --password=impd894 nafutsal
