# SourceDart-test
realisation du test du entreprise source d'art 

documentation of the project
1 - turn On the server and Mysql (Xampp , wamp ...)
2 clone the project 
 git clone https://github.com/Abdelfatah-errazy1/SourceDart-test.git
 cd SourceDart-test

3  install dependencies of the project

 composer install

 npm install

 Yarn

 cp .env.example .env

 php artisan key:generate
 
 php artisan migrate:fresh --seed

 php artisan serve 

4 navigate on the local host
  http://127.0.0.1:8000/products

5 commands line
 5.1 create category using command lines in terminal

 php artisan category:create "parentCategory"
 php artisan category:create "Subcategory" --parent=1
 # --parent for adding a parent category

5.2  delete category ...
 php artisan category:delete 2

5.3 create product using command lines
php artisan product:create "Laptop" "Powerful laptop with Intel i7 processor" 1200 --category_ids=1,2  --image="C:\Users\poste\Downloads\team-1.jpg"
# -- category_ids accept the ids of categories separate by comma
# --image accept a path of image from your disque dur 
5.3  delete category 
php artisan product:delete 1


 