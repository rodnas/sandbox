SELECT DAYOFMONTH(insertWhen) dom, DATE(insertWhen) AS day, count(*) AS number,SUM(value2) AS dist,SUM(value3) AS kcal 
FROM `personal` 
WHERE topicID=15 AND YEAR(insertWhen) ='2015' 
GROUP BY date(insertWhen)


SELECT LEFT(DATE(insertWhen),7) AS dom, count(*) AS number,SUM(value2) AS dist,SUM(value3) AS kcal 
FROM `personal` 
WHERE topicID=15 AND YEAR(insertWhen) ='2015'
GROUP BY LEFT(DATE(insertWhen),7)
ORDER BY LEFT(DATE(insertWhen),7) DESC


SELECT YEAR(insertWhen) AS dom, COUNT(*) AS number,SUM(value2) AS dist,SUM(value3) AS kcal 
FROM `personal` 
WHERE topicID=15 
GROUP BY YEAR(insertWhen)
ORDER BY YEAR(insertWhen) DESC


SELECT DAYOFMONTH(insertWhen) dom, DATE(insertWhen) AS day, count(*) AS number,SUM(value2) AS dist,SUM(value3) AS kcal 
FROM `personal` 
WHERE topicID=15 AND YEAR(insertWhen) ='2015' 
GROUP BY date(insertWhen)
ORDER BY kcal DESC limit 1


SELECT LEFT(DATE(insertWhen),7) AS dom, count(*) AS number,SUM(value2) AS dist,SUM(value3) AS kcal 
FROM `personal` 
WHERE topicID=15 AND YEAR(insertWhen) ='2015'
GROUP BY LEFT(DATE(insertWhen),7)
ORDER BY kcal DESC limit 1



SELECT LEFT(DATE(insertWhen),7) AS dom, sum(number) as number0, count(*) AS number,SUM(dist) AS dist,SUM(kcal) AS kcal
from
(SELECT DAYOFMONTH(insertWhen) dom, insertWhen, DATE(insertWhen) AS day, count(*) AS number,SUM(value2) AS dist,SUM(value3) AS kcal 
FROM personal 
WHERE topicID=15
GROUP BY date(insertWhen) DESC) w
GROUP BY LEFT(DATE(insertWhen),7)
ORDER BY LEFT(DATE(insertWhen),7) DESC
