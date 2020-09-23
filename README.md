run  project  

1-first download and  import  database from  this  url  
https://drive.google.com/file/d/14h7-ouoeovbiUhY-p93FjbHWEbLX-FZW/view?usp=sharing
2-change config  tou  your phpmyadmin config  from  .env file 
3-then  run php artisan serve to  start server 


end point example

http://127.0.0.1:8000/api/expenses?sortBy=cost&direction=desc&mindate=2019-01-3&type=fuel&search=bmw&maxcost=20

search paramter as "vehicle name" seach  with all word or  part  of word 
///
sortby paramter "cost" and  "creation date"   
direction paramter "ASC or DESC"
//////
mindate parmater return  data above this date

maxdate parmater return  data under  this date
/////
mincost parmater return  data above this cost
maxcost maxdate parmater return  data less  this cost

///
typeparamter  "fuel" OR "insurance" OR "service" 

///
The endpoint can not be exposed more than 5 times per minute.


exmple for this request  will be  

[
    {
        "id": 1,
        "vehicleName": "BMW x6",
        "plateNumber": 12345,
        "type": "Fuel",
        "cost": "6.00",
        "createdAt": "2019-12-20 11:53:05"
    },
    {
        "id": 1,
        "vehicleName": "BMW x6",
        "plateNumber": 12345,
        "type": "Fuel",
        "cost": "3.00",
        "createdAt": "2020-01-20 11:53:05"
    },
    {
        "id": 1,
        "vehicleName": "BMW x6",
        "plateNumber": 12345,
        "type": "Fuel",
        "cost": "3.00",
        "createdAt": "2019-11-20 11:53:05"
    }
]


