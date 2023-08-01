# SourceDart-test
realisation du test du entreprise source d'art 

the commands to install dependencies of the project

 composer install

 npm install

 Yarn

 cp .env.example .env

 php artisan key:generate
 
 php artisan migrate:fresh --seed

 php artisan serve 


the commands line of the category


 php artisan category:create "parentCategory"
 php artisan category:create "Subcategory" --parent=1
 # --parent for adding a parent category

 php artisan category:delete 2


php artisan product:create "Laptop" "Powerful laptop with Intel i7 processor" 1200 --category_ids=1,2  --image="C:\Users\poste\Downloads\team-1.jpg"
# -- category_ids accept the ids of categories separate by comma
# --image accept a path of image from your disque dur 
php artisan product:delete 1


 