ADDING A COLUMN TO A DATABASE TABLE:
1. in NetBeans, in src/Cerad/Bundle/XYZBundle/Entity/Player.php, add the new column and the correlated get and set methods
2. in NetBeans, in .../XYZBundle/Resources/config/doctrine/Player.orm.yml, add the new column
3. in Git Bash shell window, in the code folder, do the following:
app/console doctrine:schema:update --dump-sql //this just looks at the changes to be made
app/console doctrine:schema:update --force    //this does it
4. you may check this in MySQL using Describe and Select statements.
5. in .../XYZBundle/FormType/PlayerRegisterFormType.php, add the new field.
6. in .../XYZBundle/Resources/views/Player/Register/PlayerRegisterForm.html.twig, add the new field.

SAVING CODE CHANGES in NetBeans:
1. Commit/push changes to local repository: 
    - right mouse click on nafutsal at top of Files tree
    - pick Git --> Commit
    - add comments about the changes and click Commit
2. Push changes up to BitBucket:
    - right mouse click on nafutsal at top of Files tree
    - pick Git --> Remote --> Push
    - click Next, Next, Finish, using all defaults
3. Pull changes out of BitBucket and into Production:
    - open Git Bash
    - do the following commands:
        $ ssh ahundiak@zayso.org
        (enter password when prompted)
        $ cd zayso2016/nafutsal
        $ git pull origin master
        (enter password when prompted)
        $ cd app
        $ ./clearcache
        The file clearcache contains:
php console cache:clear --env=prod --no-debug
php console assets:install ../web
php console assetic:dump   ../web

CREATING THE DATABASE INITIALLY:
mysql -uroot
create database nafutsal;
create user "nafutsal"@"localhost" identified by "nafutsal";
grant all on nafutsal.* to "nafutsal"@"localhost";
source (((some file created as a dump of the production database)));

RUNNING MYSQL ON MY LAPTOP:
mysql -unafutsal -pnafutsal nafutsal

RUNNING MYSQL ON ZAYSO.ORG:
mysql -uimpd -pimpd894 nafutsal

CONFIGURING TO SEND EMAIL:
1. Add function sendMail
2. app/config/parameters.yml
   mailer_transport: gmail
   mailer_host: localhost
   mailer_user: admin@zayso.org
   mailer_password: XXXX
3. The above parameters.yml changs must also be done on telavant