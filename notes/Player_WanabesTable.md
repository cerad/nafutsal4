+-------------------------+-------------+------+-----+---------+
+
| Field                   | Type        | Null | Key | Default |
|
+-------------------------+-------------+------+-----+---------+
+
| id                      | int(11)     | NO   | PRI | NULL    |
|
| season_desired          | varchar(80) | NO   |     | NULL    |
|
| project                 | varchar(80) | NO   |     | NULL    |
|
| name_first_player       | varchar(80) | NO   |     | NULL    |
|
| initial_player          | varchar(3)  | YES  |     | NULL    |
|
| name_last_player        | varchar(80) | NO   |     | NULL    |
|
| gender                  | varchar(8)  | NO   |     | NULL    |
|
| dob                     | date        | YES  |     | NULL    |
|
| street                  | varchar(80) | YES  |     | NULL    |
|
| city                    | varchar(80) | YES  |     | NULL    |
|
| state                   | varchar(20) | YES  |     | NULL    |
|
| zip_code                | varchar(20) | YES  |     | NULL    |
|
| phone_player            | varchar(20) | NO   |     | NULL    |
|
| phone_parent            | varchar(20) | YES  |     | NULL    |
|
| phone_doctor            | varchar(20) | YES  |     | NULL    |
|
| phone_emergency_contact | varchar(20) | YES  |     | NULL    |
|
| indoor_experience       | varchar(10) | YES  |     | NULL    |
|
| outdoor_experience      | varchar(10) | YES  |     | NULL    |
|
| jersey_number           | int(11)     | YES  |     | NULL    |
|
| email_address           | varchar(80) | NO   |     | NULL    |
|
| name_first_parent       | varchar(80) | YES  |     | NULL    |
|
| name_last_parent        | varchar(80) | YES  |     | NULL    |
|
| relationship            | varchar(80) | YES  |     | NULL    |
|
| medical_conditions      | varchar(80) | YES  |     | NULL    |
|
| name_doctor             | varchar(80) | YES  |     | NULL    |
|
| name_emergency_contact  | varchar(80) | YES  |     | NULL    |
|
| volunteerism            | longtext    | YES  |     | NULL    |
|
| status                  | varchar(20) | NO   |     | NULL    |
|
| shirt_size              | varchar(40) | YES  |     | NULL    |
|
+-------------------------+-------------+------+-----+---------+